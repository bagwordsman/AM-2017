<?php
$themename = 'AM2017';

// php includes
//	- split up functionality, keep self sane

// File Contents:

// 1 - Client Side
// a) css and js
// b) fonts
// c) theme setup
// d) menus
// e) mediator profiles
// f) google map shortcode
// g) accordion shortcode
// h) disclaimer shortcode

// 2 - Admin Side
// a) css and js
// b) widgets
// c) admin setup
// d) classes
// e) theme settings page




// _______________________________________________________
// 1 - Client Side

// a) css and js
require_once( __DIR__ . '/includes/client-side/css-js.php');

// b) fonts
require_once( __DIR__ . '/includes/client-side/fonts.php');

// c) theme setup
// i) register menus, post formats, and post thumbnails
// ii) remove the default <div> and <ul> which wrap menus by default
// iii) add current class to wp_list_pages()
// iv) blog - set post excerpt length and add 'read more'
require_once( __DIR__ . '/includes/client-side/setup.php');

// d) menus
require_once( __DIR__ . '/includes/client-side/menus.php');

// e) mediator profiles
require_once( __DIR__ . '/includes/client-side/mediator-profiles.php');

// f) google map shortcode
require_once( __DIR__ . '/includes/client-side/google-map.php');

// g) accordion shortcode
require_once( __DIR__ . '/includes/client-side/accordion.php');

// h) disclaimer shortcode
require_once( __DIR__ . '/includes/client-side/disclaimer.php');

// page content
// - in page cta
require_once( __DIR__ . '/includes/client-side/page-content.php');





// _______________________________________________________
// 2 - Admin Side

// a) css and js
require_once( __DIR__ . '/includes/admin-side/admin-css-js.php');

// b) widgets
// i) register widget areas - blog, cookies
// ii) cookies widget
require_once( __DIR__ . '/includes/admin-side/widgets.php');

// c) admin setup
// - 2nd theme admin, webmaster credits, anything site-wide
require_once( __DIR__ . '/includes/admin-side/admin-setup.php');

// d) classes
// - allows theme settings includes to be more readable
require_once( __DIR__ . '/includes/admin-side/classes.php');


// e) theme settings page
require_once( __DIR__ . '/includes/admin-side/settings/form-setup.php');
// i) header and footer
require_once( __DIR__ . '/includes/admin-side/settings/header-and-footer.php');
// ii) in page
require_once( __DIR__ . '/includes/admin-side/settings/in-page.php');
// iii) functionality
require_once( __DIR__ . '/includes/admin-side/settings/functionality.php');


// f) callback functions
require_once( __DIR__ . '/includes/admin-side/settings/callbacks.php');



// header and footer, in page, functionality
// - best separated into components within an 'admin settings' folder
// - look at what parts of the admin each include focuses on
// - make a classes include
// - make a callbacks include


?>
