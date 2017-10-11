<?php
/**
 * Template Name: Able Services Parent Page
 * Description: Template for displaying Services Parent Page
 */

get_header(); ?>

<div id="content" role="main">

			<?php
			// main content area - first section
			while ( have_posts() ) : the_post(); ?>

			<div class="serviceswrapper">



					<!--
					auto populate services child pages here
						- try and set priority with menu position
						- try and add extra info in appearance > menus

						- might want to look at markup for personal website here - tiles useful
					-->



					<div>
					<?php
					// id="parent-<?php the_ID();
					$args = array(
					    'post_type'      => 'page',
					    'posts_per_page' => -1,
					    'post_parent'    => $post->ID,
					    'order'          => 'ASC',
					    'orderby'        => 'menu_order'
				 	);
					$parent = new WP_Query( $args );

					if ( $parent->have_posts() ) :

							// create counter - left or right containers
							$count = 0;
							// start loop
							while ( $parent->have_posts() ) : $parent->the_post();

									// thumbnail function
									$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "large" );
									if (has_post_thumbnail()) {
										$thumbnail_url = $thumbnail[0];
									} else {
										$thumbnail_url = get_bloginfo('stylesheet_directory'). '/img/default-hero/able-home-hero.jpg';
									}

									// compose the thumbnail
									echo '<div class="thumbnail ' . (++$count%2 ? "half__left" : "half__right") . '" style="background-image:url('.$thumbnail_url.');">';
									?>
											<a class="overlay" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" style="background-color:#70bf44"><!-- add bg colour based on image average -->
													<div class="assistive-text">
															<span class="h2"><?php the_title(); ?></span>
													</div>
											</a>
											<div class="info">
													<div class="title"><h2><?php the_title(); ?></h2><i class="fa fa-plus"></i></div>
													<p class="description">description to go here</p>
											</div>
					        </div><!-- thumbnail -->

					    <?php endwhile; ?>

					<?php endif; wp_reset_query(); ?>
					</div>


					<span class="divider white"></span>
			</div><!-- services wrapper -->








			<div class="whitewrapper">

					<div class="container container--center narrow">
							<h1><?php
							// display the <h1> heading with ACF
							if (get_field('h1_heading')) {
								echo get_field('h1_heading');
							} else {
								the_title();
							}
							?></h1>
							<?php the_content(); ?>
					</div><!-- container -->

					<span class="divider grey"></span>
			</div><!-- whitewrapper -->

			<?php
			// end main content area
			endwhile;
			?>










			<?php

			// 3rd section - last content
			$id_3 = get_field('last_section_id');
			$header_3 = get_field('last_header');
			$content_3 = get_field('last_content');
			$fullwidth_3 = get_field('last_section_-_full_width');


			echo '<div class="greywrapper">';



			// output header
			echo ( $header_3 ? ('<div class="greywrapper"><div class="container container--center narrow"'.( $id_3 ? (' id="'.$id_3.'" ')  : '').'><h3>'. $header_3 .'</h3></div>') : '');
			// fullwidth option applies to content only
			echo ( $content_3 ? ('<div'. ( $fullwidth_3 ? ('') : ' class="container container--center narrow"') . '>' . $content_3 . '</div>')  : '');
			//. ( $header_3 ? ('<h3>'. $header_3 .'</h3>') : '') .
			//. ( $fullwidth_3 ? ('') : ' class="container container--center narrow"') .


			echo '</div>';



			?>

</div><!-- #content -->







<?php
// linked page
$header_5 = get_field('linked_page_header');
$link_5 = get_field('linked_page_link');
$content_5 = get_field('linked_page_content');
$linked_contents = explode('<hr />', $content_5);
$color_5 = get_field('linked_page_colour');

if ($header_5 && $link_5 && $content_5) {
	echo '
	<a href="'. $link_5 .'" id="secondary" role="complementary"'. ( $color_5 ? ( 'class="'. $color_5 .'"' )  : '') .'>
			<div class="thumbnail">
					<h3>'. $header_5 .'</h3>'. strip_tags($linked_contents[0], '<img>') .'
					<div class="secondary--divider"></div>
			</div>
			<div class="text">
					'. strip_tags($linked_contents[1], '<p>') .'
			</div>
	</a><!-- #secondary -->
	';
}
?>

<?php get_footer(); ?>
