# Changelog

All notable changes to this starter theme are documented here.

The format follows [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project uses [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

Note this is a **starter**: each client site is a copy with its own
version history from the point it was copied. This changelog covers the
starter itself.

## [Unreleased]

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
