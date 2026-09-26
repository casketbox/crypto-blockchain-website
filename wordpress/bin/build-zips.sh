#!/usr/bin/env bash
# 管理画面からアップロードするための zip を wordpress/dist/ に作る。
set -euo pipefail
cd "$(dirname "$0")/.."
mkdir -p dist
rm -f dist/tovus.zip dist/tovus-core.zip
(cd themes && zip -rq ../dist/tovus.zip tovus -x '*.DS_Store')
(cd plugins && zip -rq ../dist/tovus-core.zip tovus-core -x '*.DS_Store')
ls -lh dist/*.zip
