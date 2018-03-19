<?php

// ------------------------------------------------------------------------
// Admin Css and Js

// a) add admin stylesheets
function load_admin_css() {
	// css for all admin pages - includes jquery ui and font awesome
	wp_register_style( 'admin', get_stylesheet_directory_uri(). '/css/admin-style.css' );
	wp_enqueue_style( 'admin');
	// google fonts - required if not installed on user's machine
	wp_register_style('googleFonts', 'https://fonts.googleapis.com/css?family=Asap:400,400i,700,700i|Lato:300i,400');
	wp_enqueue_style( 'googleFonts');
}
add_action( 'admin_enqueue_scripts', 'load_admin_css' );



// b) add admin scripts
function load_admin_js($hook) {

	// load jquery ui - required for sliders etc.
	wp_enqueue_script('jquery-ui-js', get_stylesheet_directory_uri(). '/js/lib/jquery-ui.min.js', false, false, true );

	//
	// remove default non WSIWYG editor for user profile
	if ( $hook == 'profile.php' || $hook == 'user-edit.php' ) {
		wp_enqueue_script('admin-profile-js', get_stylesheet_directory_uri(). '/js/admin/admin-profile.js', false, false, true );
	}

	// load js for page templates (pages created with ACF PLugin)
	wp_enqueue_script('admin-pages-js', get_stylesheet_directory_uri(). '/js/admin/admin-pages.js', false, false, true );

	// load js for Able Mediation Theme Settings
	wp_enqueue_script('admin-settings-js', get_stylesheet_directory_uri(). '/js/admin/admin-settings.js', false, false, true );

	// thickbox is also added after admin settings section. Search for 'thickbox' - perhaps is can be added here

}
add_action( 'admin_enqueue_scripts', 'load_admin_js' );


?>
