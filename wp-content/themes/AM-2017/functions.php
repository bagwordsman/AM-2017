<?php
$themename = 'AM2017';



// _______________________________________________________
// PHP Includes - split up functionality, keep self sane




// _______________________________________________________
// 1 - Front End

// -------- Css and Js --------
// 1) add global stylesheets
// 2) add global scripts
require_once( __DIR__ . '/includes/theme-setup/AM-css-js.php');


// -------- Fonts --------
// 1) add google fonts
// 2) add IE google fonts for ie8 and below
require_once( __DIR__ . '/includes/theme-setup/AM-fonts.php');


// -------- Menus, Post Formats, Post Thumnails, Page Markers, Blog --------
// 1) register menus, post formats, and post thumbnails
// 2) remove the default <div> and <ul> which wrap menus by default
// 3) add current class to wp_list_pages()
// 4) blog - set post excerpt length and add 'read more'
require_once( __DIR__ . '/includes/theme-setup/AM-setup.php');


// -------- Mediation Presentation --------
require_once( __DIR__ . '/includes/theme-setup/AM-mediation-presentation.php');


// -------- Mediator Profiles --------
require_once( __DIR__ . '/includes/theme-setup/AM-mediator-profiles.php');


// -------- Google Map Shortcode --------
require_once( __DIR__ . '/includes/theme-setup/AM-google-map.php');


// -------- Accordion Shortcode --------
require_once( __DIR__ . '/includes/theme-setup/AM-accordion.php');










// _______________________________________________________
// 2 - Admin Side


// -------- Admin Css and Js --------
// 1) add admin stylesheets
// 2) add admin scripts
require_once( __DIR__ . '/includes/admin-includes/AM-admin-css-js.php');


// -------- Widgets --------
// 1) register widgets - Blog Page Widgets, Cookies Notice, Header Opening Times,
// 2) cookies widget
require_once( __DIR__ . '/includes/admin-includes/AM-widgets.php');


// -------- Admin Setup --------
// 1) add 2nd theme administrator
// 2) redirect login for subscribers to /sample-page
// 3) add meta fields to media uploader for attachment pages
// 4) webmaster credits at bottom of admin panel
require_once( __DIR__ . '/includes/admin-includes/AM-admin-setup.php');








// _______________________________________________________
// 3 - Create Theme Options Page


// -------- Theme Options Page --------
// 1) Company Options
// 2) logo Options
// 3) Social Options
// 4) Tweet
// 5) Styling Options
// 5) affiliates Options
require_once( __DIR__ . '/includes/theme-options/AM-theme-options.php');

// -------- In Page Options --------
// 1) Google Map of Location
// 2) Blog Styling
require_once( __DIR__ . '/includes/theme-options/AM-in-page-options.php');

// -------- Functionality Options --------
// 1/ Google Analytics Options
// 2/ Lazyloading Options
require_once( __DIR__ . '/includes/theme-options/AM-functionality-options.php');


?>
