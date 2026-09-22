#!/usr/bin/env node
/**
 * Download the site's image assets into public/.
 *
 * The images are generated artwork that is not committed to this repository
 * (see README). Placeholder files ship in public/assets/ so the site builds
 * and renders straight after a clone; running this script replaces them with
 * the real artwork from the deployed site.
 *
 *   npm run fetch-assets
 *   ASSET_BASE_URL=https://example.com npm run fetch-assets
 */
import { mkdir, writeFile } from "node:fs/promises";
import { dirname, join, resolve } from "node:path";
import { fileURLToPath } from "node:url";

const BASE_URL = (process.env.ASSET_BASE_URL ?? "https://crypto-blockchain.higgsfield.app").replace(/\/$/, "");
const APP_DIR = resolve(dirname(fileURLToPath(import.meta.url)), "..");

// [remote path, local destination]. Most assets are served straight out of
// public/; the section texture is imported by styles.css instead, so Vite can
// hash it and rewrite its URL for whatever base path the site is built with.
const ASSETS = [
  ["assets/brand/monogram-96.png", "public/assets/brand/monogram-96.png"],
  ["assets/hero/plate-back.jpg", "public/assets/hero/plate-back.jpg"],
  ["assets/hero/plate-mid.jpg", "public/assets/hero/plate-mid.jpg"],
  ["assets/hero/hero-subject.png", "public/assets/hero/hero-subject.png"],
  ["assets/sections/diagram.jpg", "public/assets/sections/diagram.jpg"],
  ["assets/sections/crypto.jpg", "public/assets/sections/crypto.jpg"],
  ["assets/meta/og.png", "public/assets/meta/og.png"],
  ["icons/icon-192.png", "public/icons/icon-192.png"],
  ["icons/icon-512.png", "public/icons/icon-512.png"],
  ["icons/icon-512-maskable.png", "public/icons/icon-512-maskable.png"],
  ["assets/texture/icon-motif.jpg", "src/assets/texture/icon-motif.jpg"],
];

let failed = 0;

for (const [asset, destination] of ASSETS) {
  const url = `${BASE_URL}/${asset}`;
  const target = join(APP_DIR, destination);
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`HTTP ${response.status}`);
    }
    const body = Buffer.from(await response.arrayBuffer());
    await mkdir(dirname(target), { recursive: true });
    await writeFile(target, body);
    console.log(`  ok    ${asset} (${body.length} bytes)`);
  } catch (error) {
    failed += 1;
    console.error(`  FAIL  ${asset} — ${error.message}`);
  }
}

if (failed > 0) {
  console.error(`\n${failed} of ${ASSETS.length} assets could not be downloaded from ${BASE_URL}.`);
  console.error("The placeholders that ship with the repo are still in place; the site will build and run with them.");
  process.exit(1);
}

console.log(`\nAll ${ASSETS.length} assets downloaded from ${BASE_URL}.`);
