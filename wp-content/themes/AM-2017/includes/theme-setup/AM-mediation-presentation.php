<?php

// ------------------------------------------------------------------------
// Mediation Presentation


// styles and scripts for Mediation Presentation
function mediation_animation() {
	if ( !is_admin() && is_page_template( 'page-templates/mediation-page.php' ) ) {

		// css
		wp_register_style('animation-css', get_stylesheet_directory_uri() . '/css/mediation-animation.css');
		wp_enqueue_style( 'animation-css');


		// - - - - - -
		// js

		// Greensock
		//wp_enqueue_script( 'Greensock', '//cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/jquery.gsap.min.js', array(), '1.20.2' );

		// Tween
		//wp_enqueue_script( 'Tween', '//cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/TimelineMax.min.js', array(), '1.20.2' );

		// ScrollMagic
		//wp_enqueue_script( 'ScrollMagic', '//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js', array(), '2.0.5' );
		//wp_enqueue_script( 'ScrollMagicIndicators', '//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.min.js', array(), '2.0.5' );


		// make stuff happen
		//wp_register_script('animation-js', get_stylesheet_directory_uri() . '/js/mediation-animation.js');
		//wp_enqueue_script( 'animation-js');





	} // end conditional


}  // end load scripts //
add_action('wp_enqueue_scripts', 'mediation_animation');


?>
