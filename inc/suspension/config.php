<?php

// SUSPENDING AND RESTORING THE SITE.
//
// Normally you do nothing here. The site follows its Warden licence status: set
// the licence to Suspended in Warden and the site shows the message below at
// its next licence check (an expired licence does NOT suspend it); set it back to Active or Completed
// and it is restored. No update needs to be published or installed.
//
// A failed check never changes anything: a suspended site stays suspended and an
// active site stays active when Warden cannot be reached.
//
// Logic: ../suspension/suspension.php and licence.php. Docs: AGENT.md next to this file.
return array(
	// Manual override, independent of the licence. Keep it false in releases.
	//   true   every public page is replaced by the message below
	//   false  the licence status decides
	'suspended' => false,

	// Follow the Warden licence status (true), or ignore it (false).
	'licence_lock' => true,

	// Warden statuses that suspend the site: only "suspended". Every other status
	// (active, completed, expired, pending ...) and every other reason Warden might
	// report a licence as "not valid" (an unknown domain, an unknown key) never does.
	'lock_statuses' => array( 'suspended' ),

	// The stored answer is the cache. A page request that finds it older than this refreshes
	// it after the page has been sent (nobody waits for Warden). A scheduled task does it too.
	'check_hours' => 6,

	// After a failed check, wait this long before trying again (minutes).
	'retry_minutes' => 15,

	// Shown on the blocked page. Plain text.
	'title'     => 'Website temporarily unavailable',
	'message'   => 'If you are the owner of this website, please contact the developer.',

	// The button under the message: an email address or a full https:// address.
	// Leave 'contact' empty to hide the button.
	'contact'       => '',
	'contact_label' => 'Contact the developer',

	// Small status line shown above the title.
	'status'        => 'Service unavailable',
);
