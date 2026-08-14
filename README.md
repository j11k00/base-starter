# base-starter

The scaffold every muoto Kirby project starts from, and the dev harness for the
[base-kit](https://github.com/j11k00/base-kit) plugin.

Stack: Kirby 5 · [Vite](https://vitejs.dev/) via
[kirby-vite](https://github.com/arnoson/kirby-vite) · [Tailwind](https://tailwindcss.com/) v4 ·
[kirby-seo](https://github.com/tobimori/kirby-seo) · Alpine.js.

## The three layers

| Layer | Lives in | Updated by |
|---|---|---|
| **Kit** — blueprints, blocks, models, page/site methods, collections, controllers, taxonomies, translations, CLI | `muoto/base-kit`, composer-installed into `site/plugins/base-kit` | `composer update muoto/base-kit` |
| **Scaffold** — build config, entry points, templates, chrome snippets, CSS structure, deploy script | this repo, cloned into each site | `git merge starter/main` |
| **Site** — content, brand assets, fonts, tokens, config, overrides | the site repo only | never propagates |

The line that settles every "where does this go?":

> **The kit ships anything Kirby resolves by name** — blueprint, snippet,
> collection, controller, model, page/site method, translation, block, CLI
> command — plus the PHP behind it. **The site ships anything a designer touches
> or a build tool consumes** — templates, chrome snippets, CSS, JS, tokens,
> fonts, images.

Kirby options are the exception, since a plugin can't register them: the kit
ships them as `config.php` and the site merges it (see
[site/config/config.php](site/config/config.php)).

Promote a site feature into the kit only when a second site needs it.

## Start a new project

Clone rather than using GitHub's "Use this template" — a clone shares history
with the starter, so later `git merge starter/main` is a clean three-way merge
instead of `--allow-unrelated-histories` guesswork.

```sh
git clone https://github.com/j11k00/base-starter.git ~/Sites/acme
cd ~/Sites/acme
git remote rename origin starter
gh repo create j11k00/acme --private --source=.

# swap the harness's path repo for the real package — the repositories entry is
# keyed "base-kit", so this replaces it rather than appending a second one
composer config repositories.base-kit --json \
  '{"type":"vcs","url":"https://github.com/j11k00/base-kit.git"}'
composer require muoto/base-kit:^1.0

npm install && npm run dev
```

`composer config repositories.base-kit` is the important line. The starter's
`repositories` is a **keyed object**, not a list, so passing the same key
`base-kit` replaces the harness's local path repo instead of appending a second
entry next to it. (`composer config --unset repositories.0` silently does
nothing — don't reach for it.)

### Rename it for the project

The clone still calls itself `base-starter` in five places. Folder name alone
isn't enough — `SITE=acme`, then:

```sh
sed -i '' "s|muoto/base-starter|muoto/$SITE|" composer.json
sed -i '' "s|@muoto/base-starter|@muoto/$SITE|g" package.json package-lock.json
git mv site/config/config.base-starter.test.php "site/config/config.$SITE.test.php"
sed -i '' "s|^Title: Kirby Starter|Title: ${SITE}|" content/site.fi.txt
composer update --lock          # the root name is in the lock's content-hash
```

The host config filename must match your Herd/Valet hostname, which comes from
the **folder** name — so rename the folder and that file together or the
per-host overrides silently stop loading.

Also replace `LICENSE.md` (the starter is MIT; client work usually isn't) and
this `README.md` with something about the project. Keep `CHANGELOG.md` — it's
how you'll see what a later `git merge starter/main` is offering.

### Then make it yours

1. `site/config/config.php` — set `canonicalBase`, `locale`, `debug`.
2. `site/languages/` — the starter ships `fi` (default) + `sv`.
3. `src/assets/fonts/` + `src/css/fonts.css` — brand faces, and a
   `<link rel="preload">` per face in `site/snippets/global/head.php`.
4. `src/css/tokens/` — colours, spacing, typography.
5. `site/templates/home.php` + `site/blueprints/pages/home.yml` — the bespoke
   front page. Rewrite both; they're a starting point, not a contract.
6. `content/` — delete the seed pages once real content exists. Keep the UUIDs
   `home`, `posts`, `events` on the pages that keep those roles; the kit's
   collections resolve by UUID, never by slug. `content/styleguide/` is worth
   keeping until launch — it renders every block through your tokens.

## Develop

```sh
composer install
npm install
npm run dev      # vite dev server + php -S localhost:8888
npm run build    # production assets -> public/dist
npm run preview  # build, then serve it
```

Visit `localhost:8888` — Vite's dev server only serves js/css/assets.

Frontend entry is `src/index.js` / `src/index.css`. Tailwind scans this repo's
`site/` **and** the installed plugin's markup. Composer installs the kit to
`site/plugins/base-kit`, **not** `vendor/` — the `@source` glob in
[src/css/index.css](src/css/index.css) must point there or every `m-*` block
class is purged from the build.

### Developing the kit itself

This repo doubles as the kit's harness. Clone
[base-kit](https://github.com/j11k00/base-kit) as a sibling
(`~/Sites/base-kit`); the committed `composer.json` already declares it as a
path repository with `symlink: true`, so `site/plugins/base-kit` is a symlink
into your working copy and edits are live with no reinstall.

The kit's own docs live in that repo: `README.md`, `CONTRACT.md` (the versioned
API surface), `blocks/README.md`.

## Keep a site up to date

**Kit:** `composer update muoto/base-kit` — scoped, not a bare `composer
update`, which would bump Kirby and everything else in the same breath and
leave you unable to tell which change broke things. Then read the kit's
`CHANGELOG.md`; a major bump means something in `CONTRACT.md` moved.

**Scaffold:** don't merge on a schedule — merge when [CHANGELOG.md](CHANGELOG.md)
says there's something you want.

```sh
git fetch starter
git log --oneline HEAD..starter/main
git merge starter/main          # or: git cherry-pick <sha>
```

How painful this is depends entirely on which tier the change is in — the
changelog tags each one:

- **infra** (`vite.config.js`, `bin/deploy.sh`, `public/`, `.gitignore`) — a
  project never edits these, so merges land clean. Pull freely.
- **layer** (`site/snippets/**`, `site/templates/**`, `src/css/blocks/**`) —
  where the real fixes live *and* where your project has most likely diverged.
  Read the diff; cherry-picking one commit often beats merging.
- **seed** (`content/**`, tokens, fonts, `home.php`, languages) — meant to be
  replaced. Don't pull these into a live project.

Conflicts appear only in files the site has also edited — that's the signal, not
a failure. Lockfiles conflict routinely; resolve them by regenerating rather
than merging:

```sh
git checkout --ours composer.json package.json   # keep the site's deps
composer update --lock && npm install
```

Sites created before this workflow have unrelated histories and need
`--allow-unrelated-histories` on the first merge; cherry-picking the one changed
file is usually saner.

## Deploy (Ploi)

Point the site's Ploi deploy script at [bin/deploy.sh](bin/deploy.sh):

```sh
cd /home/ploi/example.fi && bash bin/deploy.sh
```

Webroot is `public/`. `content/` lives on the server and is not in git — sync it
with rsync, never with a deploy. Assets are built on the server, so `public/dist`
stays gitignored.

## What the site owns

The kit ships **zero frontend CSS/JS, no templates, no page shell**. Of the
visual layer it ships only block markup (`snippets/blocks/*`, semantic and
BEM-classed). This repo provides the rest as a starting point, and the site owns
it outright:

- **Templates** — [site/templates](site/templates): `home` (bespoke — see
  below), `builder`, `default`, `error`, `event(s)`, `post(s)` and the `.json`
  representations.
- **Blueprints** — [site/blueprints](site/blueprints): only `pages/home.yml`.
  Everything else comes from the kit; add files here to override a kit
  blueprint via `extends: base-kit/…`.
- **Snippets** — [site/snippets](site/snippets): the shell
  `layouts/default` + `layouts`, chrome `global/{head,nav,footer,theme-toggle,
  lang-switcher}`, and components `card`, `cards`, `image`,
  `pagination`, `post`, `prevnext`. **`card` and `image` are not optional** —
  the kit's block snippets call them by name.
- **Block CSS** — [src/css/blocks](src/css/blocks), one file per block, styling
  the classes the plugin emits (`m-list`, `m-gallery`, `m-links`,
  `m-align-*`, `data-width`, `--col-min`, `--gap`).
- **Design tokens** — [src/css/tokens](src/css/tokens): `--spacing-*`,
  `--text-*`, `--color-*`, `--font-*`, `--gap`, `--col-min`, `--muoto-col`.
- **Alpine** — bundled and started from [src/index.js](src/index.js). Block
  snippets use `x-data` / `x-intersect`.

The full inbound/outbound list is the kit's `CONTRACT.md`.

## Overriding the kit

Kirby resolves the site root first, the plugin second.

- **Blueprint** — `site/blueprints/pages/event.yml` with
  `extends: base-kit/pages/event`. Every kit blueprint has a `base-kit/` alias
  for exactly this. Use **named columns and named sections**; a bare `fields:`
  or a list-style `columns:` silently wipes the override instead of merging.
- **Controller / collection / block snippet** — same filename in the
  corresponding `site/` folder wins.
- **Strings** — add a `translations` array to `site/languages/fi.php`;
  language-file translations beat plugin translations.

Templates, chrome snippets and frontend assets aren't overrides — the site owns
them outright.

## The home page is bespoke

Every top-level page uses `builder` and is composed from blocks — **except
home**. Most projects want a tailored front page, and a block canvas fights
that rather than helping, so base-kit deliberately ships no `home` blueprint or
template. The starter provides both site-side, to rewrite per project:

- [site/blueprints/pages/home.yml](site/blueprints/pages/home.yml) — hero title,
  lede, CTA structure, cover, plus a `contentBlocks` field so editors keep the
  flexible part below the hero.
- [site/templates/home.php](site/templates/home.php) — hand-written hero markup,
  then `contentBlocks` rendered underneath.

Neither is a contract. Replace the fields with whatever the project's front page
actually needs; the rest of the kit doesn't care.

## Styleguide

[`/styleguide`](content/styleguide) is an unlisted `builder` page composed from
**real base-kit blocks** — headings, text (including multi-column and alignment
variants), quote, markdown, code, lists, table, line, single images at two
widths, a gallery grid and a reel, links in both default and button styles, an
accordion, and both listing blocks.

Because it's blocks rather than hardcoded markup, it renders through the same
snippets and CSS as production pages: change a token in
[src/css/tokens](src/css/tokens) and this page shows you the result against
every element at once. It's also the fastest smoke test that a kit upgrade
didn't break a block. Edit it in the Panel like any other page.

It's unlisted, so it stays out of the nav and listings. Delete
`content/styleguide/` before launch if you don't want it public.

## Seed content

`content/` ships a minimal set so a fresh checkout renders and exercises the
kit: a bespoke `home` (hero + posts/events listing blocks), a `posts` archive
with one post, an `events` archive with one event, one `default` page, the
styleguide, an `error` page, and one `category` taxonomy with two terms. Delete
it once the project has real content — but keep the `home`, `posts` and `events`
UUIDs on whatever pages take over those roles.
