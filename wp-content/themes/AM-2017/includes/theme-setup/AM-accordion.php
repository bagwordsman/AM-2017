<?php

// ------------------------------------------------------------------------
// Accordion Shortcode


// remove auto <p> tags from acf_the_content and the_content filters
// this adds the WP function that automatically adds <p> tags later, with a low priority

// note: adding the_content filter here stops google map shortcode from working correctly


// Court Forms (etc) content filter - accordion
add_shortcode('accordion', 'accordion_shortcode_handler');

function accordion_shortcode_handler($atts, $content=null) {


		// remove p tags from inside the accordion
		remove_filter( 'the_content', 'wpautop' );
		add_filter( 'the_content', 'wpautop' , 99);
		remove_filter( 'acf_the_content', 'wpautop' );
		add_filter( 'acf_the_content', 'wpautop' , 99);

		
		
		// jquery ui - for accordion styles. Could extract the necessary styles from here
		// NOTE: removed from here - don't want to add another instance of stylesheet for each accordion

		// wp_register_style( 'jquery-ui-css', get_stylesheet_directory_uri(). '/css/jquery-ui.min.css' );
		// wp_enqueue_style( 'jquery-ui-css');

		

		// split up sections
		$accordion_content = preg_split('/<hr[^>]*>/', $content);

		// declare an empty result - for use with 'return'
		$result = '';
		foreach ($accordion_content as $section) {

				// split header(h3) and contents each section
				//$section_header = explode('<h3></h3>', $section); - didn't really work
				$section_detail = explode('<!--more-->', $section);

				// if section is not empty, compile the result
				if ($section != '') {
						$result .= $section_detail[0] .'<div>'. $section_detail[1] .'</div>';
				}
		}

		// return the result
		// NOTE: only want to return one iteration of the jquery code if multiple accordions present
		return '<div class="accordion">' .$result. '</div>
		<script>
		jQuery(document).ready(function( $ ) {
			$( function() {
				$( ".accordion:nth-child(1n)" ).accordion();
			} );
		});
		</script>
		';

}// end shortcode handler


?>
