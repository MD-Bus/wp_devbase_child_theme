<?php

// Who counts as the developer on a site built from this starter. The parent theme
// hides the settings a client has no use for (the Credit tab, the Licence page's
// Remote setup tab) from everyone NOT on this list; with an empty list nothing is
// hidden. The parent holds no logins itself, so each agency names its own here.
//
// Put the WordPress usernames of the people who maintain the site:
//
//     return array( 'jane', 'john' );
//
// (Or define DEVBASE_DEVELOPER_LOGINS in wp-config.php instead.) The logins appear in
// this file, so if the repository is public, prefer the wp-config.php constant.

add_filter( 'devbase/developer_logins', function () {
	return array( 'momardia1', 'momardia54' );
} );
