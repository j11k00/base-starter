# Changelog

What has changed in the scaffold, so that when you start the *next* project you
know what's new since the last one — and so a fix worth back-porting by hand to
a live site is findable.

Projects take a copy of this repo and keep no link to it, so nothing here is
something you "pull". If an entry matters to a site already in flight, read the
diff and apply it:

```sh
git remote add starter https://github.com/j11k00/base-starter.git
git fetch starter
git diff HEAD:<path> starter/main:<path>
```

The kit has its own changelog; this one covers only what lives in this repo.

An entry that turns out to matter to *every* project is a hint it belonged in
`muoto/base-kit` instead — where it would have propagated on its own.

## Unreleased

### Security
- vite `^5` → `^6.4.3` — clears three dev-server advisories (path traversal in
  optimized-deps `.map` handling, `server.fs.deny` bypass, esbuild
  any-origin-request). Build output and block classes verified unchanged.
  vite 7/8 were tried and rejected; see README "Why vite is pinned to ^6".
- `npm audit fix` for nanoid and postcss (both transitive, non-breaking).
- `mcp/sdk` v0.7.0 → v0.7.1 (CVE-2026-53965). require-dev only, so it was never
  installed in production by `composer install --no-dev`.
