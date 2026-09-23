# 暗号通貨とブロックチェーン (Crypto & Blockchain)

日本語で暗号通貨とブロックチェーンの基礎を解説するウェブサイトのソースコード一式です。

もともと [Higgsfield](https://higgsfield.ai) のウェブサイトビルダーで作成したものですが、
**Higgsfield 固有のビルド基盤への依存を取り除き、単体でビルド・デプロイできる構成に移行しました。**
現在は Vite + React だけで動作し、特定のサービスやレンタルサーバーを必要としません。

- **公開URL（移行前のオリジナル）**: https://crypto-blockchain.higgsfield.app

## 動かす

```bash
cd app
npm install
npm run dev      # 開発サーバ (http://localhost:5173)
npm run build    # 型チェック + 本番ビルド → app/dist/
npm run preview  # ビルド結果をローカル確認
```

Node.js 20 以上が必要です。ビルド成果物 `app/dist/` は完全な静的ファイルなので、
静的ホスティングであればどこにでも置けます。

## デプロイ

サーバーサイドの実行環境は不要です。いずれも無料枠で運用できます。

### GitHub Pages（公開中）

公開URL: https://casketbox.github.io/crypto-blockchain-website/

`main` ブランチへの push で `.github/workflows/pages.yml` が動き、自動で公開されます。
Actions タブの *Deploy to GitHub Pages* から手動実行もできます。

プロジェクトサイトはサブディレクトリ配信になりますが、ベースパスはワークフローが
`actions/configure-pages` の出力から決めるため、リポジトリ名を書く必要はありません。

> **リポジトリを作り直した場合・フォークした場合は、最初に一度だけ手動設定が必要です。**
> Settings → Pages → **Build and deployment** → **Source** を *GitHub Actions* に変更してください。
> これを行わないと、初回のワークフローが `Configure Pages` ステップで次のように失敗します。
>
> ```
> Get Pages site failed.    Error: Not Found
> Create Pages site failed. Error: Resource not accessible by integration
> ```
>
> ワークフローには `enablement: true` を指定してありますが、Actions の `GITHUB_TOKEN` には
> Pages サイトを新規作成する権限がないため、自動での有効化はできません。
> 有効化さえ済んでいれば、以降このステップは既存サイトを検出して通ります。

### そのほか

| ホスティング | 設定 |
|---|---|
| Cloudflare Pages | ルートディレクトリ `app` / ビルドコマンド `npm run build` / 出力ディレクトリ `dist` |
| Netlify | 同上 |
| Vercel | 同上 |

これらはドメイン直下配信なので、`BASE_PATH` の指定は不要です。
手元でサブディレクトリ配信を再現したい場合のみ `BASE_PATH=/<パス>/ npm run build` を使います。

## 画像アセットについて

生成画像（ヒーロー画像・図版・OG画像・アプリアイコン）はリポジトリに同梱済みです。
クローンすればそのままビルド・公開できます。

配信元から取り直したい場合は次を実行します。

```bash
cd app
npm run fetch-assets
# 別のホストから取得する場合:
ASSET_BASE_URL=https://example.com npm run fetch-assets
```

取得対象の一覧は `app/scripts/fetch-assets.mjs` にあります。

## リポジトリ構成

```
.github/workflows/pages.yml    GitHub Pages への自動デプロイ
app/
├── index.html                 ページの <head>（title / OGP / favicon / manifest）
├── vite.config.ts             ビルド設定（BASE_PATH でベースパス切り替え）
├── tsconfig.json
├── scripts/fetch-assets.mjs   画像アセット取得スクリプト
├── public/                    そのまま配信される静的ファイル（画像・favicon・manifest）
├── design-brief.md            デザインブリーフ（配色・タイポグラフィ・セクション構成）
└── src/
    ├── main.tsx               エントリポイント
    ├── App.tsx                ページ本体（ナビ、ヒーローのパララックス演出、6セクション）
    ├── styles.css             サイト独自のデザイントークンとコンポーネントCSS
    └── assets/                ビルド時にバンドルされる画像
```

依存パッケージは React / React DOM / Vite / TypeScript のみです。
Tailwind やUIキットなどのフレームワークは使わず、`styles.css` の手書きCSSだけで
すべてのスタイルを構成しています。

## サイトの構成

1. ヒーロー（パララックス演出、コイン/チェーンのビジュアル）
2. ブロックチェーンとは
3. 暗号通貨とは
4. 3つの原理（分散化・暗号技術・合意形成）
5. 活用事例（送金・資産・NFT・DeFi）
6. 安全に使うために
7. フッター/CTA

配色はネイビー（`#10142B`）とアンティークゴールド（`#D9B76B`）、書体は Noto Sans JP + IBM Plex Mono。
アニメーション演出（スクロールで動画が再生される「スクロールスクラブ」型）は、動画生成に有料プランが必要だったため非採用とし、代わりに静止画レイヤーによるパララックス演出を採用しています（詳細は `app/design-brief.md` を参照）。

## 免責事項

本サイトは教育目的の情報提供であり、投資助言ではありません。
