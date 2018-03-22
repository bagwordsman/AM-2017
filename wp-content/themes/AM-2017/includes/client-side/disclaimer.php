<?php
// disclaimer shortcode
// - just wraps content in a green bordered div

add_shortcode('disclaimer', 'disclaimer_shortcode_handler');

function disclaimer_shortcode_handler($atts, $content=null) {

	// remove p tags from inside the disclaimer
	remove_filter( 'the_content', 'wpautop' );
	add_filter( 'the_content', 'wpautop' , 99);
	remove_filter( 'acf_the_content', 'wpautop' );
	add_filter( 'acf_the_content', 'wpautop' , 99);

	return '<div class="disclaimer">' .$content. '</div>';

} // end shortcode handler

?>