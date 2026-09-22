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

| ホスティング | 手順 |
|---|---|
| Cloudflare Pages | ビルドコマンド `npm run build`、出力ディレクトリ `dist`、ルートディレクトリ `app` |
| Netlify | 同上 |
| Vercel | 同上 |
| GitHub Pages | `BASE_PATH=/<リポジトリ名>/ npm run build` でビルドし、`app/dist/` を公開 |

GitHub Pages のプロジェクトサイトのようにサブディレクトリ配信になる場合のみ、
環境変数 `BASE_PATH` を指定してください。画像・CSS・JS の参照パスがまとめて書き換わります。
独自ドメインやユーザーサイト（`<username>.github.io`）ではそのままで構いません。

## 画像アセットについて

生成画像（ヒーロー画像・図版・OG画像・アプリアイコン）はリポジトリに含めていません。
代わりに、サイトの配色に合わせた**プレースホルダ画像**を同梱しているため、
クローン直後でもビルドが通り、レイアウトを確認できます。

本物の画像に差し替えるには、ネットワークから取得できる環境で次を実行します。

```bash
cd app
npm run fetch-assets
# 別のホストから取得する場合:
ASSET_BASE_URL=https://example.com npm run fetch-assets
```

取得対象は `app/scripts/fetch-assets.mjs` に一覧があります。
手動で差し替える場合は、同じパスに同じファイル名で置いてください。

## リポジトリ構成

```
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
