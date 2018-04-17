<?php
/**
 * Template Name: Able Services Parent Page
 * Description: Template for displaying Services Parent Page
*/
// - auto populate with child services page info (titles, excerpts, thumbnails)
// - if a manual excerpt is not available, use the excerpt(length) function
// - uses .card class (from featured post widget)
// - option to increment colour for each container > add in theme options

get_header(); ?>

<div id="content" role="main">

	<?php
	// main content area - first section
	while ( have_posts() ) : the_post(); ?>

	<div class="wrapper-white">
		<div class="container pad-top">

		<?php
		// get the child posts
		$args = array(
			'post_type'      => 'page',
			'posts_per_page' => -1,
			'post_parent'    => $post->ID,
			'order'          => 'ASC',
			'orderby'        => 'menu_order'
		);
		$parent = new WP_Query( $args );

		if ( $parent->have_posts() ) :

			// create counter - container
			$count = 0;


			// loop through posts:
			while ( $parent->have_posts() ) : $parent->the_post();

			// page / section variables
			// - title is taken from appearance > menus, 'Main Menu'
			// - fallback is page title
			$postHeading = ( menu_label($post->ID, 'Main Menu') ? menu_label($post->ID, 'Main Menu') : get_the_title() );

			$postLink = get_the_permalink();
			$thumbImg = get_the_post_thumbnail($post_id, 'widget-thumbnail');
			// $thumbImgLink = get_edit_post_link( $post->post_id );
			$excerpt = $post->post_excerpt;

			echo '
			<div class="four columns card green">
				<a class="overlay" href="' . $postLink . '"><span class="hidden">' . $postHeading . '</span></a>
				<div class="card-thumb">'. ( $thumbImg ? $thumbImg : '<div>add a thumbnail / featured image for this page.</div>') .'</div>
				<div class="card-content">
					<h2>' . $postHeading . '</h2>
					<p>'. ( $excerpt ? $excerpt : excerpt(20) ) .'
					</p>
					<p><span class="read-more faux">Read More ></span></p>
				</div>
			</div>';

			if (($count + 1) % 3 == 0) {
				echo '
				</div><div class="container">
				';
			}
			$count ++;


			endwhile; // end loop
			endif; // end posts
			wp_reset_query();

			?>
		</div><!-- container -->


		<span class="divider grey"></span>
	</div><!-- wrapper -->








	<div class="wrapper-grey">
		<?php
		$heading_1 = get_field('h1_heading');
		$title_1 = get_the_title();
		// width and center
		$content_1_format = get_field('first_section_content_formatting');
		$narrow = $content_1_format[0];
		$center = $content_1_format[1];

		echo '
		<div class="container'.( $narrow ? (' container-narrow')  : '').( $center ? (' container--center')  : '').'">
			<h1>'.( $heading_1 ? ($heading_1)  : $title_1).'</h1>'
		;?><?php the_content(); ?><?php echo '
		</div>
		';?>

		<span class="divider white"></span>
	</div>

	
	
	
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


	echo '<div class="wrapper-white">';



	// output header
	echo ( $header_3 ? ('<div class="container container--center container-narrow"'.( $id_3 ? (' id="'.$id_3.'" ')  : '').'><h3>'. $header_3 .'</h3></div>') : '');
	// fullwidth option applies to content only
	echo ( $content_3 ? ('<div'. ( $fullwidth_3 ? ('') : ' class="container container--center container-narrow"') . '>' . $content_3 . '</div>')  : '');
	//. ( $header_3 ? ('<h3>'. $header_3 .'</h3>') : '') .
	//. ( $fullwidth_3 ? ('') : ' class="container container--center container-narrow"') .


	echo '</div>';



	?>

</div><!-- #content -->







<?php
// in page cta - page-content.php
pageCta();
?>

<?php get_footer(); ?>