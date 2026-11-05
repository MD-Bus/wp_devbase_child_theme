# Changelog

All notable changes to this starter theme are documented here.

The format follows [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project uses [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

Note this is a **starter**: each client site is a copy with its own
version history from the point it was copied. This changelog covers the
starter itself.

## [Unreleased]

### Security

- **XML-RPC is off while the site is suspended.** `xmlrpc.php` bypassed the blocked page, the admin-ajax/admin-post check and the REST API check.

### Fixed

- `bin/bump-version.sh` works on Linux and in CI (it used the BSD-only `sed -i ''`).

## [1.4.0] — 2026-11-03

### Removed

- `inc/overrides/developers.php` (added in 1.3.0). The parent theme dropped its developer-logins list in 1.22.0, in favour of a
  "Lock remote setup" switch under Theme Settings > Miscellaneous > Management, so nothing reads the list any more.

## [1.3.0] — 2026-11-03

Requires the parent theme 1.21.0 or later.

### Added

- **`inc/overrides/developers.php`**: names the developer logins once (`devbase/developer_logins`). From the parent's
  1.21.0 the Credit tab and the Licence page's Remote setup tab are hidden from everyone else. Edit the list for
  your own agency, or use `DEVBASE_DEVELOPER_LOGINS` in `wp-config.php` if the repository is public.

## [1.2.1] — 2026-11-03

Requires the parent theme 1.18.0 or later for the single licence key.

### Changed

- README: a site has ONE Warden licence key (parent 1.18.0), carrying two apps tagged `parent-theme` and `child-theme`.

## [1.2.0] — 2026-11-03

### Added

- **The payment kill switch is part of the starter** (`inc/suspension/`), taken from the OCWOF site and made
  generic (`devbase_child_*` names, neutral blocked page, no contact address until you set one in
  `config.php`). The site follows its Warden licence status: Suspended in Warden means public visitors get a
  503 page, `wp-admin` and `wp-login.php` stay open, only `suspended` locks, and a failed check changes
  nothing. It lives in the child on purpose so a parent release cannot remove it. Inert until the site has a
  licence key.

### Changed

- README: the shop switch and the kill switch.

## [1.1.1] — 2026-11-03

### Changed

- The ASE override example in `inc/overrides/ase.php` used a key that does not exist
  (`login_attempts_limit`); it now shows the real one, `login_fails_allowed`.
- `.gitignore` ignores stray Finder duplicates (`forms 2.php`) and `CLAUDE.md`; `bin/build-zip.sh` leaves
  such duplicates out of the zip; a `.gitattributes` keeps repository-only files out of the package a
  release tag publishes (the parent theme already does this).
- README: the optional shop switch and the payment kill switch, and how to turn each on.

## [1.1.0] — 2026-11-03

Requires the parent theme 1.15.0 or later for the shop switch to do anything.

### Added

- **`inc/overrides/woocommerce.php`**, the switch that makes a client site a shop. **Off by default**: set
  `$is_shop` to `true` and the parent theme installs WooCommerce, activates it and keeps it active (WordPress
  can't update, deactivate or delete it; only a parent release changes it). See the parent's
  `inc/bundled-plugins/AGENT.md`.

## [1.0.0] — 2026-10-11

Initial release.

### Added

- Child theme scaffold binding to the Dev Base Parent Theme, with the
  directory structure a client site grows into.
- `inc/overrides/` — commented stubs for the two admin-hardening filters
  and the admin-menu filter, documenting which to use and why choosing
  wrongly fails silently.
- `inc/content/` — commented stubs for registering this site's forms, post
  types and extra schema types, including the hook timing the base theme's
  archive and MCP features depend on.
- `views/index.twig` — a starting front-end template calling the four
  hooks base-theme features output through.
- `assets/css/main.css`, enqueued with `filemtime()` versioning so deploys
  bust the cache automatically.
- `languages/i18n.php` using `load_child_theme_textdomain()`, with the
  `.mo` naming rule that silently breaks translations when got wrong.
- `bin/build-zip.sh`, reading the theme slug from the directory name so a
  renamed copy packages correctly with no edit.
- `bin/bump-version.sh`, which refuses to move a version backwards.

[Unreleased]: https://github.com/momardia54/devbase-child-theme/compare/v1.0.0...HEAD
[1.0.0]: https://github.com/momardia54/devbase-child-theme/releases/tag/v1.0.0
