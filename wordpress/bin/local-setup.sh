#!/usr/bin/env bash
# ローカルの WordPress を初期化し、tovus テーマと tovus Core プラグインを有効化する。
set -euo pipefail
cd "$(dirname "$0")/.."

wp() { docker compose run --rm cli wp "$@"; }

# WordPress のファイルが展開されるまで待つ
for _ in $(seq 1 30); do
	docker compose exec -T wordpress test -f /var/www/html/wp-config.php && break
	sleep 2
done

if ! wp core is-installed 2>/dev/null; then
	wp core install \
		--url="http://localhost:8080" \
		--title="tovus" \
		--admin_user=admin --admin_password=admin \
		--admin_email=admin@example.com --skip-email
fi

wp language core install ja --activate || echo "（日本語パックを取得できなかったため英語のままにします）"
wp option update timezone_string "Asia/Tokyo"
wp option update blogdescription "暗号通貨とブロックチェーンを、はじめから丁寧に。"
wp theme activate tovus
wp plugin activate tovus-core

echo "準備ができました → http://localhost:8080  （admin / admin）"
