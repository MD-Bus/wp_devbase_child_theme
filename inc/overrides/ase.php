<?php

// Admin Site Enhancements settings for THIS client site.
//
// The parent theme ships a baseline in
// inc/dependencies/ase/ase-settings.php's devbase_ase_default_settings().
// This is the only place that baseline should ever be adjusted per client
// — never by editing the parent, and never by hand in the DB.
//
// There are two hooks, and picking the wrong one is the usual mistake:
//
// 'devbase/ase/defaults'  — fill a GAP. Applied with
//     array_merge( defaults, stored ), so a stored value always wins. On a
//     brand-new site this sets the value; on a site where that ASE key has
//     ever been saved (by an admin, or by ASE's own settings form), it does
//     NOTHING. Use it to change what a fresh install starts with.
//
// 'devbase/ase/enforced'  — WIN, always. Reasserted on every admin page
//     load, overwriting whatever is stored. Use it when this client's
//     configuration is non-negotiable.
//
// Why the parent can't just always overwrite: ASE registers every module
// as a field in one giant form, so saving that form with a stale page open
// resets every unchecked field. The parent theme cannot tell that apart
// from "the client deliberately turned this off", so it never reasserts.
// A child theme naming one specific key removes that ambiguity — which is
// exactly why 'enforced' is safe here and wouldn't be there.
//
// Cost of enforcing: the setting can no longer be changed from ASE's own
// page in wp-admin (it reverts on the next load), which is confusing for
// whoever tries. Enforce deliberately, not by default.

add_filter( 'devbase/ase/defaults', function ( array $defaults ) {
	// Example — a fresh site for this client starts with the login limit
	// at 5 failed attempts instead of the base theme's default of 3:
	//
	// $defaults['login_fails_allowed'] = 5;

	return $defaults;
} );

add_filter( 'devbase/ase/enforced', function ( array $enforced ) {
	// Example — this client is contractually required to keep the file
	// editor disabled, so it must not be re-enablable from wp-admin:
	//
	// $enforced['disable_plugin_theme_editor'] = true;

	return $enforced;
} );
