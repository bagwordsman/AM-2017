<?php

// ------------------------------------------------------------------------
// Disclaimer Shortcode

// Court Forms (etc) content filter - disclaimer
add_shortcode('disclaimer', 'disclaimer_shortcode_handler');

function disclaimer_shortcode_handler($atts, $content=null) {


		// remove p tags from inside the disclaimer
		remove_filter( 'the_content', 'wpautop' );
		add_filter( 'the_content', 'wpautop' , 99);
		remove_filter( 'acf_the_content', 'wpautop' );
		add_filter( 'acf_the_content', 'wpautop' , 99);


		// split up sections
		$disclaimer_content = $content;

		// declare an empty result - for use with 'return'
		// $result = '';
		// foreach ($disclaimer_content as $section) {

		// 		// split header(h3) and contents each section
		// 		//$section_header = explode('<h3></h3>', $section); - didn't really work
		// 		$section_detail = explode('<!--more-->', $section);

		// 		// if section is not empty, compile the result
		// 		if ($section != '') {
		// 				$result .= $section_detail[0] .'<div>'. $section_detail[1] .'</div>';
		// 		}
		// }

		// return the result
		// NOTE: only want to return one iteration of the jquery code if multiple disclaimers present
		return '<div class="disclaimer">' .$content. '</div>';

}// end shortcode handler


?>
