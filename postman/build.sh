#!/usr/bin/env bash
# Build the Tawseel Postman collection from fragments.
# Usage: bash postman/build.sh   (or ./postman/build.sh)
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

if ! command -v node >/dev/null 2>&1; then
  echo "✘ node is required but was not found on PATH." >&2
  exit 1
fi

node "$SCRIPT_DIR/build/build.mjs"
