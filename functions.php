<?php

// The client site's own code. Everything shared across every client site
// lives in the parent theme (wp_devbase_parent_theme) and is not repeated here.
//
// ───────────────────────────────────────────────────────────────────────────
// READ THIS BEFORE ADDING ANYTHING TO THIS FILE
// ───────────────────────────────────────────────────────────────────────────
//
// WordPress includes THIS file BEFORE the parent theme's functions.php
// (wp-includes/load.php's wp_get_active_and_valid_themes() puts the
// stylesheet before the template, and wp-settings.php includes them in
// that order). That is not a quirk to work around — it is what makes
// overriding work — but it has one hard consequence:
//
//   *** No parent theme function exists yet while this file is running. ***
//
// So:
//
//   ✗ NEVER call a devbase_* function at the top level of this file or
//     anything it requires. It will fatal with "undefined function" on
//     every single page load.
//
//   ✗ NEVER guard such a call with function_exists(). It will be false,
//     the code will silently do nothing, and you will spend an afternoon
//     wondering why. Silent degradation is the single most common failure
//     mode in this codebase's history — see the parent theme's
//     inc/dependencies/AGENT.md.
//
//   ✓ DO register filters and actions at the top level. add_filter() and
//     add_action() only store a callable; they invoke nothing. By the time
//     the hook fires, the parent theme is fully loaded.
//
//   ✓ DO use after_setup_theme (or later) if you genuinely need to CALL a
//     parent function rather than hook one.
//
// Every stub in inc/ below follows that rule. Copy their shape.

// Payment kill switch (switch and settings live in inc/suspension/config.php). Follows the Warden
// licence status; inert until this site has a licence key. See inc/suspension/AGENT.md.
require_once __DIR__ . '/inc/suspension/suspension.php';

// Client-specific overrides of parent theme defaults.
require_once __DIR__ . '/inc/overrides/ase.php';
require_once __DIR__ . '/inc/overrides/admin-menu.php';
require_once __DIR__ . '/inc/overrides/woocommerce.php';
require_once __DIR__ . '/inc/overrides/developers.php';

// This client site's own content: forms, post types, extra schema types.
require_once __DIR__ . '/inc/content/forms.php';
require_once __DIR__ . '/inc/content/post-types.php';
require_once __DIR__ . '/inc/content/schema.php';

// Loads this child theme's own translations, if any exist.
require_once __DIR__ . '/languages/i18n.php';

// Front-end assets for this site.
add_action( 'wp_enqueue_scripts', function () {
	$css = get_stylesheet_directory() . '/assets/css/main.css';

	// get_stylesheet_* is correct HERE — in child theme code it resolves to
	// this theme. (Parent theme code uses get_template_* for the opposite
	// reason; see the parent's own AGENT.md.) Versioned by file mtime so a
	// deploy busts the cache without anyone bumping a number by hand.
	if ( file_exists( $css ) ) {
		wp_enqueue_style(
			'devbase-child',
			get_stylesheet_directory_uri() . '/assets/css/main.css',
			array(),
			(string) filemtime( $css )
		);
	}
} );
