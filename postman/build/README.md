# Postman collection builder

This folder generates a single Postman v2.1 collection from small, reviewable
JSON **fragments** — one file per endpoint — instead of editing a 700 KB export
by hand.

The legacy export `postman/Auro.postman_collection.json` is **left untouched**.
The build writes a fresh file to `postman/Tawseel.postman_collection.json`.

## Build it

From the repo root, run **either**:

```bash
# bash / macOS / Linux / Git Bash
bash postman/build.sh
```

```powershell
# PowerShell (Windows / pwsh)
pwsh postman/build.ps1
```

Both wrappers just run `node postman/build/build.mjs` (zero npm dependencies),
so `node postman/build/build.mjs` works directly too. Then import
`postman/Tawseel.postman_collection.json` into Postman.

## Layout

```
build/
  collection.json              collection info, variables, default auth
  fragments/
    users/                     -> top-level folder "Users"          (order: 1)
      _folder.json
      01-authentication/       -> sub-folder "01. Authentication"
        _folder.json
        01-send-otp.json       -> one request each, ordered by NN- prefix
        02-verify-otp.json
        ...
    business/                  -> top-level folder "Business" (in progress)
    drivers/                   -> top-level folder "Drivers"  (in progress)
```

- **Folders** are any directory containing a `_folder.json`.
- **Requests** are any other `*.json` file.
- Ordering: top-level areas by `_folder.json` `order`; everything else by the
  numeric `NN-` prefix on the file/dir name.
- IDs are derived deterministically from each item's path, so rebuilds produce
  clean diffs (no random churn).

## `_folder.json`

```json
{
  "name": "01. Authentication",
  "order": 1,
  "description": ["markdown", "lines (array joined with \\n) or a plain string"],
  "auth": "bearer"
}
```

`order` only matters for the three top-level areas. `auth` is optional and
accepts the same shorthands as endpoints (below).

## Endpoint fragment schema

Only `method` and `path` are required. Full example:

```json
{
  "name": "Send OTP (login)",
  "method": "POST",
  "path": "users/auth/send-otp",
  "auth": "none",
  "description": ["markdown", "lines"],
  "headers": [{ "key": "X-Custom", "value": "1" }],
  "query": [{ "key": "page", "value": "1", "description": "...", "disabled": true }],
  "body": { "phone": "01012345678", "type": "customer" },
  "prerequest": ["// js lines"],
  "test": ["// js lines"],
  "responses": [
    { "name": "200 — OK", "code": 200, "body": { "success": true } }
  ]
}
```

| Field | Notes |
| --- | --- |
| `path` | Appended to `{{baseUrl}}`; `/` splits URL segments. A segment starting with `:` (e.g. `:orderId`) becomes a Postman path variable. |
| `pathVariables` | Map of `:segment` → example. Value can be a string, or `{ "value": "1", "description": "..." }`. |
| `auth` | `"none"`, `"bearer"` (→ `{{accessToken}}`), `"refresh"` (→ `{{refreshToken}}`), or omit to inherit the collection default. A full Postman auth object also passes through. |
| `description` | String, or an array of lines joined with `\n`. Markdown renders in Postman. |
| `headers` | Optional. Omit to get sensible defaults: `Accept: application/json`, `lang: {{lang}}`, and `Content-Type: application/json` for a JSON body (skipped for form-data). |
| `body` | Object/array → raw JSON. String → raw text. For files/multipart use an explicit body (below). |
| `query` | Array of `{ key, value, description?, disabled? }`. |
| `prerequest` / `test` | Array of JS lines (or a string). |
| `responses` | Saved Postman examples; `body` is an object (→ pretty JSON) or string. |

### Path variables & file uploads

```json
{
  "method": "POST",
  "path": "users/customer/orders/:orderId/cancel",
  "pathVariables": { "orderId": { "value": "1024", "description": "Order id" } },
  "body": {
    "mode": "formdata",
    "formdata": [
      { "key": "description", "value": "A4 envelope", "type": "text" },
      { "key": "attachments[]", "type": "file", "src": [], "description": "Optional file" }
    ]
  }
}
```

`body.mode` may be `formdata`, `urlencoded`, or `raw` for full control; any other
object value is treated as raw JSON.

## Variables

Set in `collection.json`:

| Variable | Purpose |
| --- | --- |
| `baseUrl` | API root incl. version, e.g. `http://localhost:8000/api/v1`. |
| `accessToken` | Auto-saved by the `Verify OTP` and `Refresh token` test scripts. |
| `refreshToken` | Same. |
| `lang` | Sent as the `lang` header (`ar` / `en`); defaults to `ar`. |

## Adding endpoints later

1. Drop a new `NN-name.json` fragment into the right folder (create the folder
   with a `_folder.json` if needed).
2. Re-run the build.
3. Commit the fragment(s) **and** the regenerated
   `postman/Tawseel.postman_collection.json`.

Business and driver folders are scaffolded and ready for fragments. Zone
endpoints are intentionally excluded.
