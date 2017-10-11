<?php
// ------------------------------------------------------------------------
// Functionality Options
// 1/ Google Analytics Options
// 2/ Lazyloading Options


// ------------------------------------------------------------------------
// 1/ Google Analytics Options
function sandbox_theme_intialize_google_analytics_options() {
    // If the google_analytics options don't exist, create them.
    if( false == get_option( 'sandbox_theme_google_analytics_options' ) ) {
        add_option( 'sandbox_theme_google_analytics_options' );
    } // end if
	add_settings_section(
    	'google_analytics_settings_section',          // ID used to identify this section and with which to register options
    	'Google Analytics',                           // Title to be displayed on the administration page
    	'sandbox_google_analytics_options_callback',  // Callback used to render the description of the section
    	'sandbox_theme_google_analytics_options'      // Page on which to add this section of options
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


// sanitise google_analytics options - output tracking ID
function sandbox_theme_sanitize_google_analytics_options( $input ) {
    $output = array();
    foreach( $input as $key => $val ) {
        if( isset ( $input[$key] ) ) {
            $output[$key] = sanitize_text_field( $input[$key] );
        } // end if
    } // end foreach
    // Return the new collection
    return apply_filters( 'sandbox_theme_sanitize_google_analytics_options', $output, $input );
} // end sandbox_theme_sanitize_google_analytics_options


function sandbox_google_analytics_options_callback() {
    echo '<p>Paste your Google Analytics Tracking ID into the text field to add Google Analytics tracking to your website.</p>
		<p>Leave this field empty to omit tracking.</p>';
} // end sandbox_google_analytics_options_callback


function sandbox_google_analytics_callback() {
    $options = get_option( 'sandbox_theme_google_analytics_options' );
    $url = '';
    if( isset( $options['google_analytics'] ) ) {
        $url = $options['google_analytics'];
    } // end if
    // Render the output
    echo '<input type="text" id="google_analytics" name="sandbox_theme_google_analytics_options[google_analytics]" value="' . $options['google_analytics'] . '" />
		<i title="How do I find the Google Analytics Tracking ID?" class="fa fa-question" aria-hidden="true"></i>
		<div class="google_analytics--info hidden">
		<img src="'. get_bloginfo('stylesheet_directory'). '/img/admin-img/google_analytics-info.jpg"/>
		<p>When logged in to Google Analytics, Click the \'All Web Site Data\' Drop Down in the top left of the screen, then copy and paste the ID under your business name <span class="green--text">(underlined above in green)</span> into the above text field.</p>
		</div>';
} // end sandbox_google_analytics_callback















// ------------------------------------------------------------------------
// 2/ Lazyloading Options
function sandbox_theme_intialize_lazyloading_options() {
    // If the lazyloading options don't exist, create them.
    if( false == get_option( 'sandbox_theme_lazyloading_options' ) ) {
        add_option( 'sandbox_theme_lazyloading_options' );
    } // end if
	add_settings_section(
    	'lazyloading_settings_section',          // ID used to identify this section and with which to register options
    	'Lazyloading of Images',                   // Title to be displayed on the administration page
    	'sandbox_lazyloading_options_callback',  // Callback used to render the description of the section
    	'sandbox_theme_lazyloading_options'      // Page on which to add this section of options
	);
	add_settings_field(
    	'lazyloading',
    	'<i class="fa fa-picture-o" aria-hidden="true"></i>Toggle Lazyloading',
    	'sandbox_lazyloading_callback',
    	'sandbox_theme_lazyloading_options',
    	'lazyloading_settings_section'
	);
	register_setting(
    	'sandbox_theme_lazyloading_options',
    	'sandbox_theme_lazyloading_options',
    	'sandbox_theme_sanitize_lazyloading_options'
	);
} // end sandbox_theme_intialize_lazyloading_options
add_action( 'admin_init', 'sandbox_theme_intialize_lazyloading_options' );




// sanitise lazyloading options - checkbox and textfield
function sandbox_theme_sanitize_lazyloading_options( $input ) {
    $output = array();
    // loop over lazyloading options
    foreach( $input as $key => $val ) {
        // if key is set, sanitise and output it
        if( isset ( $input[$key] ) ) {
            // if input key is a checkbox, sanitise if differently
            if ( $key == 'lazyloading' ) {
                $output[$key] = filter_var( $input[$key], FILTER_SANITIZE_NUMBER_INT );
            } else {
                $output[$key] = sanitize_text_field( $input[$key] );
            }
        } // end if set
    } // end foreach
    return apply_filters( 'sandbox_theme_sanitize_lazyloading_options', $output, $input );
} // end sandbox_theme_sanitize_lazyloading_options




// construct the lazyloading options form
// 1 - the intro message
function sandbox_lazyloading_options_callback() {
    echo '
		<p>Allow in-page image assets to be lazy-loaded. This can help reduce the load time of image-heavy pages.</p>
    <p>Images below the viewport will only be loaded once the user scrolls down.</p>';
} // end sandbox_lazyloading_options_callback


// 2 - toggle lazyloading
function sandbox_lazyloading_callback() {
    $options = get_option( 'sandbox_theme_lazyloading_options' );
    if( isset( $options['lazyloading'] ) ) {
        $options['lazyloading'];
    } // end if
    // Render the output
    echo '<input type="checkbox" id="lazyloading" name="sandbox_theme_lazyloading_options[lazyloading]" value="1" ' . checked( 1, isset( $options['lazyloading'] ) ? $options['lazyloading'] : 0, false ) . ' />';
} // end sandbox_lazyloading_callback


// 3 - enable lazyloading on the front end
$lazyload = get_option( 'sandbox_theme_lazyloading_options' );
$lazyload_on = $lazyload['lazyloading'];

// if the checkbox is marked, add lazyloading
if ($lazyload_on != '') {

		// Lazyloading
		function enqueue_lazyload() {
		    wp_enqueue_script('jquery_lazy_load', get_stylesheet_directory_uri() . '/js/lib/jquery.lazyload.min.js', array('jquery'), '1.0');
		}
		add_action('wp_enqueue_scripts', 'enqueue_lazyload');


		function footer_lazyload() {
		echo '
		<script type="text/javascript">
		jQuery(document).ready(function( $ ) {
			$(function() {
			    $("img.lazy").lazyload({
					    load : function(elements_left, settings) {
					        //console.log(this, elements_left, settings);
					        $(this).removeClass("loading-icon");
					    }
					});
			});
		});
		</script>
		';
		}
		add_action('wp_footer', 'footer_lazyload');


		// filter the_content, acf_the_content, and
		function filter_lazyload($content) {
		    return preg_replace_callback('/(<\s*img[^>]+)(src\s*=\s*"[^"]+")([^>]+>)/i', 'preg_lazyload', $content);
		}
		add_filter('the_content', 'filter_lazyload');
		add_filter('acf_the_content', 'filter_lazyload');
		// gallery filter doesn't work here - need to come up with a new solution
		// add_filter('post_gallery', 'filter_lazyload');

		function preg_lazyload($img_match) {

		    //$img_replace = $img_match[1] . 'src="' . get_stylesheet_directory_uri() . '/img/loading-icon.gif" class="loading-icon" data-original' . substr($img_match[2], 3) . $img_match[3];
				$img_replace = $img_match[1] . ' class="loading-icon" data-original' . substr($img_match[2], 3) . $img_match[3];

		    $img_replace = preg_replace('/class\s*=\s*"/i', 'class="lazy ', $img_replace);

		    $img_replace .= '<noscript>' . $img_match[0] . '</noscript>';
		    return $img_replace;
		}

// end lazyload on
}

?>
