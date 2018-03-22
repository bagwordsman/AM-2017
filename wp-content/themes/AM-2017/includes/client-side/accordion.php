<?php
// accordion shortcode
// - works on both acf_the_content and the_content filters
// - this adds the WP function that automatically adds <p> tags later, with a low priority
// - uses a sample of jquery accordion css

add_shortcode('accordion', 'accordion_shortcode_handler');

function accordion_shortcode_handler($atts, $content=null) {

	// remove p tags from inside the accordion
	remove_filter( 'the_content', 'wpautop' );
	add_filter( 'the_content', 'wpautop' , 99);
	remove_filter( 'acf_the_content', 'wpautop' );
	add_filter( 'acf_the_content', 'wpautop' , 99);

	// split up sections - defined by <hr> tags
	$accordion_content = preg_split('/<hr[^>]*>/', $content);

	// declare an empty result - for use with 'return'
	$result = '';
	foreach ($accordion_content as $section) {

		// split header(h3) and contents each section
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
			$( ".accordion:nth-child(1n)" ).accordion({
				heightStyle: "content"
			});
		} );
	});
	</script>
	';

} // end shortcode handler

?>