<?php
// css and js for client side

// File Contents:
// 1 - css
// 2 - js

// _______________________________________________________
// 1 - css
function load_css() {
	// style.css
	//  - required by theme, resides in the root, acts as a reset
	wp_register_style('reset', get_stylesheet_directory_uri() . '/style.css' );
	wp_enqueue_style( 'reset');

	// complied css for all pages
	wp_register_style( 'compiled-css', get_stylesheet_directory_uri(). '/css/style.css' );
	wp_enqueue_style('compiled-css' );

	// add print css
	// wp_register_style('print', get_stylesheet_directory_uri() . '/css/print/AM2017-print.css', false, false, 'print');
	// wp_enqueue_style( 'print');

	// add ie css (should be in the header html conditionals)
}
add_action('wp_enqueue_scripts', 'load_css');





// _______________________________________________________
// 2 - js (jquery)
function load_scripts() {
	if (!is_admin()) {
		
		// lib > jquery-ui
		wp_enqueue_script('jquery-ui', get_stylesheet_directory_uri(). '/js/lib/jquery-ui.min.js', array('jquery'), '1.0', true );
		// lib > cookies
		wp_enqueue_script('jquery-cookie', get_stylesheet_directory_uri(). '/js/lib/jquery.cookie.js', array('jquery'), '1.0', true  );
		// lib > twitter
		wp_enqueue_script('twitter', get_stylesheet_directory_uri(). '/js/lib/twitterfeed.js', array('jquery'), '1.0', true  );
		// main js
		wp_enqueue_script('main', get_stylesheet_directory_uri(). '/js/main.js', array('jquery','jquery-cookie'), '1.0', true  ); // 'jquery-ui'

	}
}
add_action('wp_enqueue_scripts', 'load_scripts');


?>
