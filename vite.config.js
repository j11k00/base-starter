// vite.config.js
import { resolve } from "path";
import kirby from "vite-plugin-kirby";
import tailwindcss from "@tailwindcss/vite";

export default ({ mode }) => ({
  root: "src",
  // Assets are served from <webroot>/dist (outDir below), so the built CSS's
  // internal url() refs need the /dist/ prefix too. Dev server serves at /.
  base: mode === "development" ? "/" : "/dist/",
  server: {
    cors: true,
    port: 5174,
  },
  build: {
    outDir: resolve(process.cwd(), "public/dist"),
    emptyOutDir: true,
    rollupOptions: { input: resolve(process.cwd(), "src/index.js") },
  },
  plugins: [kirby(), tailwindcss()],
});
