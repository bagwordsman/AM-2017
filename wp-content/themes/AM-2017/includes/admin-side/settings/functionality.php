<?php
// functionality

// File Contents:

// 1 - google analytics
// 2 - lazyloading


// _______________________________________________________
// 1 - google analytics
function sandbox_theme_intialize_google_analytics_options() {
    // if google_analytics options don't exist, create them.
    if ( false == get_option( 'sandbox_theme_google_analytics_options' ) ) {
        add_option( 'sandbox_theme_google_analytics_options' );
    }
	add_settings_section(
    	'google_analytics_settings_section', // section ID
    	'Google Analytics', // section title
    	'sandbox_google_analytics_options_callback', // callback
    	'sandbox_theme_google_analytics_options' // add to settings page
	);
	add_settings_field(
    	'google_analytics',
    	'<i class="fa fa-bar-chart" aria-hidden="true"></i>Tracking ID',
    	'sandbox_google_analytics_callback',
    	'sandbox_theme_google_analytics_options',
    	'google_analytics_settings_section'
	);
	register_setting(
    	'sandbox_theme_google_analytics_options',
    	'sandbox_theme_google_analytics_options',
    	'sandbox_theme_sanitize_google_analytics_options'
	);
} // end sandbox_theme_intialize_google_analytics_options
add_action( 'admin_init', 'sandbox_theme_intialize_google_analytics_options' );

// sanitise options: text field 'google_analytics'
function sandbox_theme_sanitize_google_analytics_options( $input ) {
    $output = array();
    foreach( $input as $key => $val ) {
        if ( isset ( $input[$key] ) ) {
            $output[$key] = sanitize_text_field( $input[$key] );
        }
    }
    return apply_filters( 'sandbox_theme_sanitize_google_analytics_options', $output, $input );
}

// callback: message
function sandbox_google_analytics_options_callback() {
	echo '
	<p>Paste your Google Analytics Tracking ID into the text field to add Google Analytics tracking to your website.</p>
	<p>Leave this field empty to omit tracking.</p>';
}

// callback: tracking ID and instruction
function sandbox_google_analytics_callback() {
    $options = get_option( 'sandbox_theme_google_analytics_options' );
    $url = '';
    if ( isset( $options['google_analytics'] ) ) {
        $url = $options['google_analytics'];
    }
	echo '
	<input type="text" id="google_analytics" name="sandbox_theme_google_analytics_options[google_analytics]" value="' . $options['google_analytics'] . '" />
	<i title="How do I find the Google Analytics Tracking ID?" class="fa fa-question" aria-hidden="true"></i>
	<div class="google_analytics--info hidden">
		<img src="'. get_bloginfo('stylesheet_directory'). '/img/admin-img/google_analytics-info.jpg"/>
		<p>When logged in to Google Analytics, Click the \'All Web Site Data\' Drop Down in the top left of the screen, then copy and paste the ID under your business name <span class="green--text">(underlined above in green)</span> into the above text field.</p>
	</div>';
}







// _______________________________________________________
// 2 - lazyloading
function sandbox_theme_intialize_lazyloading_options() {
    // if lazyloading options don't exist, create them.
    if ( false == get_option( 'sandbox_theme_lazyloading_options' ) ) {
        add_option( 'sandbox_theme_lazyloading_options' );
    }
	add_settings_section(
    	'lazyloading_settings_section', // section ID
    	'Lazyload Images', // section title
    	'sandbox_lazyloading_options_callback', // callback
    	'sandbox_theme_lazyloading_options' // add to settings page
	);
	add_settings_field(
    	'lazyloading',
    	'<i class="fa fa-picture-o" aria-hidden="true"></i>Toggle Lazyloading',
    	'checkbox_callback', // sandbox_lazyloading_callback
    	'sandbox_theme_lazyloading_options',
		'lazyloading_settings_section',
		array( // the $args array - tailor the callback function
			'lazyloading', 
			'sandbox_theme_lazyloading_options' // section ID
		)
	);
	register_setting(
    	'sandbox_theme_lazyloading_options',
    	'sandbox_theme_lazyloading_options',
    	'sandbox_theme_sanitize_lazyloading_options'
	);
}
add_action( 'admin_init', 'sandbox_theme_intialize_lazyloading_options' );


// sanitise options: checkbox 'lazyloading'
function sandbox_theme_sanitize_lazyloading_options( $input ) {
    $output = array();
    foreach( $input as $key => $val ) {
        if ( isset ( $input[$key] ) ) {
            if ( $key == 'lazyloading' ) {
                $output[$key] = filter_var( $input[$key], FILTER_SANITIZE_NUMBER_INT );
			}
        }
    }
    return apply_filters( 'sandbox_theme_sanitize_lazyloading_options', $output, $input );
}


// callback: message
function sandbox_lazyloading_options_callback() {
    echo '
	<p>Allow all in-page image assets to be lazy-loaded. This can help reduce the load time of image-heavy pages.</p>
    <p>Images will only be loaded when they come into view, when the user scrolls.</p>';
}


// callback: enqueue scripts / add to page
$lazyload = get_option( 'sandbox_theme_lazyloading_options' );
$lazyload_on = $lazyload['lazyloading'];

// if the checkbox is marked, add lazyloading
if ($lazyload_on != '') {

	// load script
	function enqueue_lazyload() {
		wp_enqueue_script('jquery_lazy_load', get_stylesheet_directory_uri() . '/js/lib/jquery.lazyload.min.js', array('jquery'), '1.0');
	}
	add_action('wp_enqueue_scripts', 'enqueue_lazyload');

	// add embedded script to footer
	function footer_lazyload() {
	echo '
	<script type="text/javascript">
	jQuery(document).ready(function( $ ) {
		$(function() {
			$("img.lazy").lazyload({
				load : function(elements_left, settings) {
					$(this).removeClass("loading-icon");
				}
			});
		});
	});
	</script>
	';
	}
	add_action('wp_footer', 'footer_lazyload');

	// filter the_content and acf_the_content
	function filter_lazyload($content) {
		return preg_replace_callback('/(<\s*img[^>]+)(src\s*=\s*"[^"]+")([^>]+>)/i', 'preg_lazyload', $content);
	}
	add_filter('the_content', 'filter_lazyload');
	add_filter('acf_the_content', 'filter_lazyload');
	// gallery filter doesn't work here - need to come up with a new solution
	// add_filter('post_gallery', 'filter_lazyload');

	// add the class '.lazy' to images that will be lazy loaded
	function preg_lazyload($img_match) {
		// $img_replace = $img_match[1] . 'src="' . get_stylesheet_directory_uri() . '/img/loading-icon.gif" class="loading-icon" data-original' . substr($img_match[2], 3) . $img_match[3];
		$img_replace = $img_match[1] . ' class="loading-icon" data-original' . substr($img_match[2], 3) . $img_match[3];
		$img_replace = preg_replace('/class\s*=\s*"/i', 'class="lazy ', $img_replace);
		$img_replace .= '<noscript>' . $img_match[0] . '</noscript>';
		return $img_replace;
	}

// end lazyload on
}

?>