#!/usr/bin/env pwsh
# Build the Tawseel Postman collection from fragments.
# Usage: pwsh postman/build.ps1   (or: powershell -File postman\build.ps1)
$ErrorActionPreference = 'Stop'

$ScriptDir = Split-Path -Parent $MyInvocation.MyCommand.Path

if (-not (Get-Command node -ErrorAction SilentlyContinue)) {
    Write-Error 'node is required but was not found on PATH.'
    exit 1
}

node (Join-Path $ScriptDir 'build/build.mjs')
