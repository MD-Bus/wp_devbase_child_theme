<?php

// WooCommerce. OFF by default: a site that is not a shop never gets it.
//
// To make this site a shop, change `false` to `true` below. The parent theme
// (1.15.0+) then installs the WooCommerce it ships into wp-content/plugins/ the
// first time an administrator opens wp-admin, activates it, and keeps it
// active: WordPress can no longer update, deactivate or delete it, and only a
// parent theme release changes its version (it never downgrades). Switching
// to a theme that doesn't need it removes WooCommerce's files and leaves the
// shop's orders and products in the database.
//
// This is a filter, so it is safe to register at the top level while the
// parent has not loaded yet; the parent calls it later. Do not call any
// devbase_* function from here. Full rules:
// ../../../wp_devbase_parent_theme/inc/bundled-plugins/AGENT.md

add_filter( 'devbase/required_plugins', function ( array $plugins ) {
	$is_shop = false;

	if ( $is_shop ) {
		$plugins[] = 'woocommerce';
	}

	return $plugins;
} );
