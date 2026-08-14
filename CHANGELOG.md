# Changelog

Scaffold changes, so a project on an older clone can decide in ten seconds
whether it wants them. The kit has its own changelog — this one only covers
what lives in this repo.

Tag each entry with the tier, because that's what determines whether pulling it
is trivial or a judgement call:

- **`[infra]`** — build config, deploy script, webroot, gitignore, lockfiles.
  A project almost never edits these, so `git merge starter/main` lands clean.
  Pull freely.
- **`[layer]`** — `site/snippets/**`, `site/templates/**`, `src/css/blocks/**`.
  Shared presentation a project may well have rewritten. Worth having, but read
  the diff first; cherry-picking one commit often beats a merge.
- **`[seed]`** — `content/**`, tokens, fonts, `home.php`, languages, README.
  Exists to be replaced. Don't pull these into a live project.

Note which files an entry touches — that's usually enough to tell whether it
conflicts with your project without fetching anything.

Pull with:

```sh
git fetch starter
git log --oneline HEAD..starter/main
git merge starter/main          # or: git cherry-pick <sha>
```

## Unreleased
