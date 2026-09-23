import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";

// Static single-page build. Output goes to dist/ and can be served by any
// static host (Cloudflare Pages, GitHub Pages, Netlify, ...) with no server
// runtime. `base` is overridable for GitHub Pages project sites, which serve
// from /<repo-name>/ rather than the domain root.
export default defineConfig({
  base: process.env.BASE_PATH ?? "/",
  plugins: [react()],
  build: {
    outDir: "dist",
    assetsDir: "build",
  },
});
