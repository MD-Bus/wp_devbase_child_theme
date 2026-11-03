#!/usr/bin/env bash
# Packages this child theme into a clean, installable .zip for upload to
# Warden as a release of this client's own track.
#
# Much simpler than the parent theme's equivalent, because a child theme
# has none of the things that make that one complicated: no vendor/, no
# Composer, no test suite, no release gate. It's this client's own code and
# nothing else.
#
# The theme slug is read from the DIRECTORY NAME rather than hardcoded, so
# a renamed copy of this starter ("duplicate both, rename the child for the
# client") packages correctly with no edit to this script. The zip's
# top-level folder is what WordPress installs the theme as, and it must
# keep matching the directory name on disk, or an update would install
# alongside the existing copy instead of replacing it.

# Repository-only files are stripped: README, CHANGELOG, ROADMAP, SECURITY
# and docs/ (which carries screenshots — ~1.9MB that has no business on a
# client's server). The excludes are anchored with a leading slash so they
# only match this theme's own copies, never third-party ones inside vendor/.
#
# LICENSE is deliberately KEPT. This theme is GPLv2+ and bundles GPLv2+ code
# (Secure Custom Fields, Admin Site Enhancements); the GPL requires the
# licence text to travel with the distributed work. The licence files inside
# vendor/ stay for the same reason — they are other projects' licences and
# removing them would be a compliance problem, not a tidy-up.
#
set -euo pipefail

THEME_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
THEME_SLUG="$(basename "$THEME_DIR")"
VERSION="$(grep -m1 '^Version:' "$THEME_DIR/style.css" | sed 's/Version: *//' | tr -d '\r')"
TEMPLATE="$(grep -m1 '^Template:' "$THEME_DIR/style.css" | sed 's/Template: *//' | tr -d '\r')"

if [ -z "$VERSION" ]; then
	echo "BUILD ABORTED: no Version: header in style.css."
	echo "Warden compares the installed version against the release version — without one, no update can ever be offered."
	exit 1
fi

if [ -z "$TEMPLATE" ]; then
	echo "BUILD ABORTED: no Template: header in style.css."
	echo "A child theme without one is not a child theme — WordPress would treat it as a standalone theme with none of the base theme's functionality."
	exit 1
fi

echo "==> Building $THEME_SLUG-$VERSION.zip (child of: $TEMPLATE)"

BUILD_ROOT="$(mktemp -d)"
BUILD_DIR="$BUILD_ROOT/$THEME_SLUG"
trap 'rm -rf "$BUILD_ROOT"' EXIT

mkdir -p "$BUILD_DIR"

rsync -a "$THEME_DIR/" "$BUILD_DIR/" \
	--exclude='.git' \
	--exclude='.gitignore' \
	--exclude='.gitattributes' \
	--exclude='* 2.*' \
	--exclude='* 2' \
	--exclude='.DS_Store' \
	--exclude='bin' \
	--exclude='*.zip' \
	--exclude='AGENT.md' \
	--exclude='/README.md' \
	--exclude='/CHANGELOG.md' \
	--exclude='/ROADMAP.md' \
	--exclude='/SECURITY.md' \
	--exclude='/docs' \
	--exclude='.gitignore' \
	--exclude='/languages/*.po' \
	--exclude='/languages/*.pot'

OUTPUT_ZIP="$THEME_DIR/../$THEME_SLUG-$VERSION.zip"
rm -f "$OUTPUT_ZIP"

( cd "$BUILD_ROOT" && zip -rq "$OUTPUT_ZIP" "$THEME_SLUG" )

echo "==> Done: $(cd "$(dirname "$OUTPUT_ZIP")" && pwd)/$(basename "$OUTPUT_ZIP")"
echo "    Upload this to Warden as a release on this client's track."
echo "    Note .po/.pot sources are excluded; compiled .mo files are included."
