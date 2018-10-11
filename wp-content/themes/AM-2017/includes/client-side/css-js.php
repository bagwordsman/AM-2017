<?php
// css and js for client side

// File Contents:
// 1 - css
// 2 - js
// 3 - lazyloading

// _______________________________________________________
// 1 - css
function load_css() {
	// style.css
	// - combined reset followed by theme styles
	wp_register_style('main_css', get_stylesheet_directory_uri() . '/style.css' );
	wp_enqueue_style( 'main_css');


	// _______________
	//  - required by theme, resides in the root, acts as a reset
	// wp_register_style('reset', get_stylesheet_directory_uri() . '/style.css' );
	// wp_enqueue_style( 'reset');

	// // complied css for all pages
	// wp_register_style( 'compiled-css', get_stylesheet_directory_uri(). '/css/style.css' );
	// wp_enqueue_style('compiled-css' );

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
		
		// _______________
		// add jQuery from CDN for production
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js', null, null, true );
		wp_enqueue_script('jquery');

		// _______________
		// lib > jquery-ui
		// wp_enqueue_script('jquery-ui', get_stylesheet_directory_uri(). '/js/lib/jquery-ui.min.js', array('jquery'), '1.0', true );
		
		// jQuery UI CDN (for live):		
		wp_enqueue_script('jquery-ui', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js', null, null, true );
		
		// _______________
		// lib > cookies
		// wp_enqueue_script('jquery-cookie', get_stylesheet_directory_uri(). '/js/lib/jquery.cookie.js', array('jquery'), '1.0', true  );
		// // lib > twitter
		// wp_enqueue_script('twitter', get_stylesheet_directory_uri(). '/js/lib/twitterfeed.js', array('jquery'), '1.0', true  );
		// // main js
		// wp_enqueue_script('main', get_stylesheet_directory_uri(). '/js/main.js', array('jquery','jquery-cookie'), '1.0', true  );

		// theme JS - combined and minified the above 3 scripts (for live):
		wp_enqueue_script('main_bundle', get_stylesheet_directory_uri(). '/js/main_bundle.js', array('jquery'), '1.0', true );

	}
}
add_action('wp_enqueue_scripts', 'load_scripts');


// defer loading of all scripts
function js_async_attr($tag){
	
	// exclude some scripts from deferral by adding their tags here:
	$scripts_to_exclude = array('https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js');

	foreach($scripts_to_exclude as $exclude_script) {
		if(true == strpos($tag, $exclude_script ) )
		return $tag;
	}

	// defer or async all remaining scripts not excluded above
	return str_replace( ' src', ' defer="defer" src', $tag );
}
add_filter( 'script_loader_tag', 'js_async_attr', 10 );





// _______________________________________________________
// 3 - lazyloading
// callback: enqueue scripts / add to page
$lazyload = get_option( 'sandbox_theme_lazyloading_options' );
$lazyload_on = $lazyload['lazyloading'];

// if the checkbox is marked, add lazyloading
if ($lazyload_on != '') {

	// load script(s)
	function enqueue_lazyload() {
		wp_enqueue_script('jquery_lazy_load', get_stylesheet_directory_uri() . '/js/lib/jquery.lazyload.min.js', array('jquery'), '1.0');
	}
	add_action('wp_enqueue_scripts', 'enqueue_lazyload');
	// add lazyload class to .page - in header.php.
	// - this could allow script to be fired from main.js or main_bundle.js if a class is present
	// - note: may not have worked previously because main_bundle is loaded in the footer, and lazyload in the header
	// - also because script needs to fire to prevent the DOM from fully loading


	// filter the_content and acf_the_content
	function filter_lazyload($content) {
		return preg_replace_callback('/(<\s*img[^>]+)(src\s*=\s*"[^"]+")([^>]+>)/i', 'preg_lazyload', $content);
	}
	add_filter('the_content', 'filter_lazyload');
	add_filter('acf_the_content', 'filter_lazyload');
	// gallery filter doesn't work here - need to come up with a new solution
	// add_filter('post_gallery', 'filter_lazyload');

	// note:
	// - image wrapped in an anchor tag got duplicated in cta section
	// - old version of in page cta used img, new version uses background img

	// add the class '.lazy' to images that will be lazy loaded
	function preg_lazyload($img_match) {
		// $img_replace = $img_match[1] . 'src="' . get_stylesheet_directory_uri() . '/img/loading-icon.gif" class="loading-icon" data-original' . substr($img_match[2], 3) . $img_match[3];
		$img_replace = $img_match[1] . ' class="loading-icon" data-original' . substr($img_match[2], 3) . $img_match[3];
		$img_replace = preg_replace('/class\s*=\s*"/i', 'class="lazy loading-icon ', $img_replace);
		$img_replace .= '<noscript>' . $img_match[0] . '</noscript>';
		return $img_replace;
	}

// end lazyload on
}


?>
