<?php

// ------------------------------------------------------------------------
// Css and Js for all pages



// 1) add global stylesheets
// to be audited / redone with SASS
function load_css() {
	// ie css in header.php

	// style.css - required by theme
	// NOTE: this is in the root of the theme, and acts as a reset
	wp_register_style('style', get_stylesheet_directory_uri() . '/style.css' );
	wp_enqueue_style( 'style');

	// // skeleton.css - most styles
	// wp_register_style('newskeleton', get_stylesheet_directory_uri() . '/css/skeleton.css' );
	// wp_enqueue_style( 'newskeleton');
	// // nav.css - better to separate out
	// wp_register_style('oldnav', get_stylesheet_directory_uri() . '/css/nav.css' );
	// wp_enqueue_style( 'oldnav');
	// // font awesome icons - loaded from theme, not a CDN
	// wp_register_style( 'fa-icons', get_stylesheet_directory_uri(). '/css/font-awesome.min.css' );
	// wp_enqueue_style('fa-icons' );

	wp_register_style( 'new-compiled-default', get_stylesheet_directory_uri(). '/css/style.css' );
	wp_enqueue_style('new-compiled-default' );

	// add print css
	wp_register_style('print', get_stylesheet_directory_uri() . '/css/print/AM2017-print.css', false, false, 'print');
	wp_enqueue_style( 'print');
}
add_action('wp_enqueue_scripts', 'load_css');





// 2) add global scripts


// // use a cdn to load jquery instead
// function replace_jquery() {
//     wp_deregister_script( 'jquery' );
//     wp_enqueue_script( 'jquery', '//code.jquery.com/jquery-2.2.3.min.js', array(), '2.2.3' );
// }
// add_action( 'wp_enqueue_scripts', 'replace_jquery' );

// could try this too:
// https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js





// jQuery scripts on front end
function load_scripts() {
if (!is_admin()) {
	//  all pages and posts  //
	// i) jquery ui plugin - needed for scrolltop and accordion //
	// was: jquery-ui-1.10.3.custom.min.js
	wp_enqueue_script('jquery-ui', get_stylesheet_directory_uri(). '/js/lib/jquery-ui.min.js', array('jquery'), '1.0', true );


	// ii)
	// cookies script for cookie bar, and learning page markers for visited page background images
	wp_enqueue_script('jquery-cookie', get_stylesheet_directory_uri(). '/js/lib/jquery.cookie.js', array('jquery'), '1.0', true  );
	
	
	// iii) twitter
	wp_enqueue_script('twitter', get_stylesheet_directory_uri(). '/js/lib/twitterfeed.js', array('jquery'), '1.0', true  );


	// iv) main js (includes tooltip) //
	wp_enqueue_script('main', get_stylesheet_directory_uri(). '/js/main.js', array('jquery','jquery-cookie'), '1.0', true  ); // 'jquery-ui'

}
}  // end load scripts //
add_action('wp_enqueue_scripts', 'load_scripts');


?>
