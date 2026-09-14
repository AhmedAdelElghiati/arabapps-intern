#!/usr/bin/env node
/**
 * Tawseel Postman collection builder.
 *
 * Assembles a single Postman v2.1 collection from small, reviewable JSON
 * "fragments" so the collection can be hand-documented and version-controlled
 * without wrestling a 700KB generated file.
 *
 * It does NOT touch `postman/Auro.postman_collection.json` (the legacy export).
 * Output is written to `postman/TmsIntern.postman_collection.json`.
 *
 * Run it with `node postman/build/build.mjs`, or via the cross-platform
 * wrappers `postman/build.sh` (bash) and `postman/build.ps1` (PowerShell).
 *
 * ---------------------------------------------------------------------------
 * Directory layout
 * ---------------------------------------------------------------------------
 *   build/
 *     collection.json            collection-level info, variables, default auth
 *     fragments/
 *       <area>/                  -> a top-level folder (users, business, drivers)
 *         _folder.json           { name, description?, order?, auth? }
 *         <NN-folder>/           -> a sub-folder, ordered by its NN prefix
 *           _folder.json
 *           <NN-endpoint>.json   -> a single request, ordered by its NN prefix
 *
 * ---------------------------------------------------------------------------
 * Endpoint fragment schema (see fragments/users/01-authentication/* for live
 * examples). Only `method` + `path` are strictly required.
 * ---------------------------------------------------------------------------
 *   {
 *     "name": "Send OTP to phone number",
 *     "method": "POST",
 *     "path": "users/auth/send-otp",      // appended to {{base_url}}; "/" splits segments
 *     "auth": "none",                      // "none" | "bearer" | "refresh" | omit=inherit
 *     "description": ["markdown", "lines"],// string OR array of lines (joined with \n)
 *     "headers": [ { "key": "X", "value": "y" } ], // optional; sensible defaults otherwise
 *     "query":   [ { "key": "page", "value": "1", "description": "...", "disabled": true } ],
 *     "body":    { "phone": "01012345678" },        // object/array -> raw JSON; string -> raw text
 *     "prerequest": ["// js", "// lines"],          // optional pre-request script
 *     "test":       ["// js", "// lines"],          // optional test script
 *     "responses": [
 *       { "name": "200 OK", "code": 200, "status": "OK", "body": { ... } }
 *     ]
 *   }
 */

import { createHash } from 'node:crypto';
import { readdirSync, readFileSync, statSync, writeFileSync } from 'node:fs';
import { dirname, join, resolve } from 'node:path';
import { fileURLToPath } from 'node:url';

const HERE = dirname(fileURLToPath(import.meta.url));
const FRAGMENTS_DIR = join(HERE, 'fragments');
const COLLECTION_META = join(HERE, 'collection.json');
const OUTPUT = resolve(HERE, '..', 'TmsIntern.postman_collection.json');

/* ------------------------------------------------------------------ helpers */

/** Deterministic UUID-shaped id so rebuilds produce stable diffs. */
function uid(seed) {
  const h = createHash('sha1').update(seed).digest('hex');
  return `${h.slice(0, 8)}-${h.slice(8, 12)}-${h.slice(12, 16)}-${h.slice(16, 20)}-${h.slice(20, 32)}`;
}

/** Allow descriptions / scripts to be authored as an array of lines. */
function text(value) {
  if (value == null) return undefined;
  return Array.isArray(value) ? value.join('\n') : String(value);
}

function readJson(file) {
  try {
    return JSON.parse(readFileSync(file, 'utf8'));
  } catch (err) {
    throw new Error(`Failed to parse ${file}: ${err.message}`);
  }
}

function isDir(p) {
  return statSync(p).isDirectory();
}

/** A fragment's sort key: its numeric "NN-" filename/dirname prefix, else name. */
function sortKey(name) {
  const m = name.match(/^(\d+)/);
  return m ? Number(m[1]) : Number.POSITIVE_INFINITY;
}

function sortByPrefix(names) {
  return [...names].sort((a, b) => sortKey(a) - sortKey(b) || a.localeCompare(b));
}

/* ----------------------------------------------------------------- builders */

function buildAuth(auth) {
  if (!auth || auth === 'inherit') return undefined; // inherit from parent/collection
  if (auth === 'none') return { type: 'noauth' };
  if (auth === 'bearer') {
    return { type: 'bearer', bearer: [{ key: 'token', value: '{{accessToken}}', type: 'string' }] };
  }
  if (auth === 'refresh') {
    return { type: 'bearer', bearer: [{ key: 'token', value: '{{refreshToken}}', type: 'string' }] };
  }
  // Allow a fully-specified Postman auth object to pass through untouched.
  if (typeof auth === 'object') return auth;
  throw new Error(`Unknown auth shorthand: ${JSON.stringify(auth)}`);
}

/** An explicit Postman body spec carries a `mode` string ("formdata" etc.). */
function isExplicitBody(body) {
  return body && typeof body === 'object' && typeof body.mode === 'string';
}

function defaultHeaders(frag) {
  const headers = [
    { key: 'Accept', value: 'application/json' },
    { key: 'lang', value: '{{lang}}', description: 'Response language: ar | en (defaults to ar)' },
  ];
  const method = (frag.method || 'GET').toUpperCase();
  const body = frag.body;
  // form-data / urlencoded bodies get their Content-Type (incl. multipart boundary)
  // set by Postman automatically — only declare JSON ourselves.
  const formish = isExplicitBody(body) && (body.mode === 'formdata' || body.mode === 'urlencoded');
  if (body !== undefined && method !== 'GET' && !formish) {
    headers.unshift({ key: 'Content-Type', value: 'application/json' });
  }
  return headers;
}

function buildBody(body) {
  if (body === undefined) return undefined;
  if (typeof body === 'string') {
    return { mode: 'raw', raw: body };
  }
  if (isExplicitBody(body)) {
    if (body.mode === 'formdata') {
      return { mode: 'formdata', formdata: body.formdata || body.fields || [] };
    }
    if (body.mode === 'urlencoded') {
      return { mode: 'urlencoded', urlencoded: body.urlencoded || [] };
    }
    if (body.mode === 'raw') {
      const raw = typeof body.raw === 'string' ? body.raw : JSON.stringify(body.raw, null, 2);
      return { mode: 'raw', raw, options: body.options || { raw: { language: 'json' } } };
    }
  }
  return {
    mode: 'raw',
    raw: JSON.stringify(body, null, 2),
    options: { raw: { language: 'json' } },
  };
}

function buildUrl(frag) {
  const segments = String(frag.path).replace(/^\/+|\/+$/g, '').split('/').filter(Boolean);
  const query = (frag.query || []).map((q) => ({
    key: q.key,
    value: q.value ?? '',
    description: text(q.description),
    disabled: q.disabled === true ? true : undefined,
  }));

  const rawQuery = query
    .filter((q) => !q.disabled)
    .map((q) => `${q.key}=${q.value}`)
    .join('&');

  // Segments starting with ":" are Postman path variables, e.g. "users/orders/:orderId".
  // Example values come from the fragment's optional "pathVariables" map.
  const pathVariables = frag.pathVariables || {};
  const variables = segments
    .filter((s) => s.startsWith(':'))
    .map((s) => {
      const key = s.slice(1);
      const def = pathVariables[key];
      return {
        key,
        value: String(def && typeof def === 'object' ? def.value ?? '' : def ?? ''),
        description: text(def && typeof def === 'object' ? def.description : undefined),
      };
    });

  const url = {
    raw: `{{base_url}}/${segments.join('/')}${rawQuery ? `?${rawQuery}` : ''}`,
    host: ['{{base_url}}'],
    path: segments,
  };
  if (query.length) url.query = query;
  if (variables.length) url.variable = variables;
  return url;
}

function buildRequest(frag) {
  const request = {
    method: (frag.method || 'GET').toUpperCase(),
    header: frag.headers ?? defaultHeaders(frag),
    url: buildUrl(frag),
  };

  const description = text(frag.description);
  if (description) request.description = description;

  const auth = buildAuth(frag.auth);
  if (auth) request.auth = auth;

  const body = buildBody(frag.body);
  if (body) request.body = body;

  return request;
}

function buildEvents(frag) {
  const events = [];
  if (frag.prerequest) {
    events.push({
      listen: 'prerequest',
      script: { type: 'text/javascript', exec: Array.isArray(frag.prerequest) ? frag.prerequest : [frag.prerequest] },
    });
  }
  if (frag.test) {
    events.push({
      listen: 'test',
      script: { type: 'text/javascript', exec: Array.isArray(frag.test) ? frag.test : [frag.test] },
    });
  }
  return events;
}

function buildResponses(frag, request, seed) {
  return (frag.responses || []).map((res, i) => {
    const body = typeof res.body === 'string' ? res.body : JSON.stringify(res.body ?? {}, null, 2);
    return {
      id: uid(`${seed}:response:${i}:${res.name || res.code}`),
      name: res.name || `${res.code} response`,
      originalRequest: {
        method: request.method,
        header: request.header,
        url: request.url,
        ...(request.body ? { body: request.body } : {}),
      },
      status: res.status || statusText(res.code),
      code: res.code ?? 200,
      _postman_previewlanguage: 'json',
      header: [{ key: 'Content-Type', value: 'application/json' }],
      cookie: [],
      body,
    };
  });
}

function statusText(code) {
  const map = {
    200: 'OK',
    201: 'Created',
    204: 'No Content',
    401: 'Unauthorized',
    403: 'Forbidden',
    404: 'Not Found',
    422: 'Unprocessable Entity',
    500: 'Internal Server Error',
  };
  return map[code] || 'OK';
}

function buildEndpoint(file) {
  const frag = readJson(file);
  if (!frag.method || !frag.path) {
    throw new Error(`Fragment ${file} is missing required "method"/"path".`);
  }
  const seed = `request:${frag.path}:${frag.method}:${frag.name || ''}`;
  const request = buildRequest(frag);

  const item = {
    id: uid(seed),
    name: frag.name || `${frag.method} ${frag.path}`,
    request,
    response: buildResponses(frag, request, seed),
  };

  const events = buildEvents(frag);
  if (events.length) item.event = events;

  item.protocolProfileBehavior = { disableBodyPruning: true };
  return item;
}

/** Recursively build a folder from a fragments directory. */
function buildFolder(dir) {
  const meta = readJson(join(dir, '_folder.json'));
  const entries = readdirSync(dir).filter((n) => n !== '_folder.json');

  const subDirs = sortByPrefix(entries.filter((n) => isDir(join(dir, n))));
  const files = sortByPrefix(
    entries.filter((n) => n.endsWith('.json') && !isDir(join(dir, n)))
  );

  const children = [
    ...subDirs.map((n) => buildFolder(join(dir, n))),
    ...files.map((n) => buildEndpoint(join(dir, n))),
  ];

  const folder = {
    id: uid(`folder:${dir}`),
    name: meta.name,
    item: children,
  };
  const description = text(meta.description);
  if (description) folder.description = description;
  const auth = buildAuth(meta.auth);
  if (auth) folder.auth = auth;

  return folder;
}

/* --------------------------------------------------------------------- main */

function build() {
  const meta = readJson(COLLECTION_META);

  const topLevel = sortByPrefix(
    readdirSync(FRAGMENTS_DIR).filter((n) => isDir(join(FRAGMENTS_DIR, n)))
  )
    // Order top-level areas by their _folder.json "order", then name.
    .map((n) => ({ name: n, dir: join(FRAGMENTS_DIR, n) }))
    .sort((a, b) => {
      const oa = readJson(join(a.dir, '_folder.json')).order ?? 999;
      const ob = readJson(join(b.dir, '_folder.json')).order ?? 999;
      return oa - ob || a.name.localeCompare(b.name);
    });

  const collection = {
    info: {
      _postman_id: uid('collection:tawseel'),
      name: meta.info.name,
      description: text(meta.info.description),
      schema: meta.info.schema || 'https://schema.getpostman.com/json/collection/v2.1.0/collection.json',
    },
    item: topLevel.map((t) => buildFolder(t.dir)),
    variable: meta.variable || [],
  };

  if (meta.auth) collection.auth = buildAuth(meta.auth);
  if (meta.event) collection.event = meta.event;

  writeFileSync(OUTPUT, `${JSON.stringify(collection, null, 2)}\n`, 'utf8');
  return { collection, topLevel };
}

function summarize(collection) {
  let folders = 0;
  let requests = 0;
  const walk = (items, depth, prefix) => {
    for (const it of items) {
      if (Array.isArray(it.item)) {
        folders += 1;
        console.log(`${'  '.repeat(depth)}${prefix}${it.name}  (${it.item.length})`);
        walk(it.item, depth + 1, prefix);
      } else {
        requests += 1;
        const m = it.request?.method || '?';
        console.log(`${'  '.repeat(depth)}- [${m}] ${it.name}`);
      }
    }
  };
  console.log('');
  walk(collection.item, 0, '');
  console.log(`\n${folders} folders, ${requests} requests`);
}

try {
  const { collection } = build();
  console.log(`✔ Wrote ${OUTPUT}`);
  summarize(collection);
} catch (err) {
  console.error(`✘ Build failed: ${err.message}`);
  process.exit(1);
}
