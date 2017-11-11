<?php
/**
 * Template Name: Mediation Process Page
 * Description: Template for Mediation Process Presentation
 */

get_header(); ?>

<div id="content" role="main">

			<div class="presentation-cover">
						<div>
								<div class="container">
										<h1><?php
										// display the <h1> heading with ACF
										if (get_field('h1_heading')) {
											echo get_field('h1_heading');
										} else {
											the_title();
										}
										?></h1>
										<?php
										// main content area - first section
										while ( have_posts() ) : the_post();
											the_content();
										endwhile;
										?>
								</div><!-- container -->
						</div>			
			</div><!-- presentation-cover -->


			<div class="wrapper-white gradient-white-green">







				<div id="MIAMS">
						<div class="container">
								<div class="six columns">


										<svg class="MIAMS" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="597.273px" height="534.5px" viewBox="0 0 597.273 534.5" enable-background="new 0 0 597.273 534.5" xml:space="preserve">
											<path id="MIAMS__line" fill="none" stroke="#000000" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="
												M2.5,2.5c0,0,0,477.5,0,499S13.625,532,33,532c9,0,16.375-2,24.5-5c3.313-1.223,234.664-91.045,234.664-91.045l46.307-162.811
												l43.311,128.2l212.992-82.278"/>

												<polyline id="MIAMS__m-one" fill="none" stroke="#000000" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="
												48.5,529.833 94.807,367.021 138.218,495.239 184.525,332.428 227.835,460.628 	"/>

												<line id="MIAMS__i" fill="none" stroke="#000000" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="259.5" y1="308" x2="259.5" y2="448"/>

												<polyline id="MIAMS__m-two" fill="none" stroke="#000000" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="
												415.164,387.705 461.471,224.894 504.883,353.111 551.189,190.3 594.5,318.5 	"/>

										</svg>


								</div>
						</div><!-- container -->
				</div>




				<script>

				'use strict';


				// MIAMs Line
				let miamsLine = document.getElementById('MIAMS__line');
				let length = miamsLine.getTotalLength();


				// The start position of the drawing
				miamsLine.style.strokeDasharray = length;

				// Hide the MIAMs line by offsetting dash. Remove this line to show the triangle before scroll draw
				miamsLine.style.strokeDashoffset = length;

				// Find scroll percentage on scroll (using cross-browser properties), and offset dash same amount as percentage scrolled
				window.addEventListener('scroll', miamsLineDraw);

				function miamsLineDraw() {

					// find out how much the user has scrolled
					let scrollpercent = (document.body.scrollTop + document.documentElement.scrollTop) / (document.documentElement.scrollHeight - document.documentElement.clientHeight);

				  let draw = length * scrollpercent;

				  // Reverse the drawing (when scrolling upwards)
				  miamsLine.style.strokeDashoffset = length - draw;




					// add fixed positioning to container
					let miamsContainer = document.getElementById('MIAMS');

					// needs to be more than .25 and less than 1  (scrollpercent > 0.25 && scrollpercent < 1)
					// better to use strokeDashoffset (can add fixed when at bottom of vertical height)
					if (miamsLine.style.strokeDashoffset < 815) {
						miamsContainer.className += ' fixed';
					} else {
						miamsContainer.className -= ' fixed';
					}



				}
				</script>









			</div><!-- wrapper-white gradient-white-green -->


<?php get_footer(); ?>
