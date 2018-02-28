<?php
/**
 * Template Name: Able Services Parent Page
 * Description: Template for displaying Services Parent Page
 

* - auto populate services child pages here
* - try and set priority with menu position
* - try and add extra info in appearance > menus

* - might want to look at markup for personal website here - tiles useful
*
*/

get_header(); ?>

<div id="content" role="main">

	<?php
	// main content area - first section
	while ( have_posts() ) : the_post(); ?>

	<div class="serviceswrapper">

		

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
				$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "medium_large" );
				if (has_post_thumbnail()) {
					$thumbnail_url = $thumbnail[0];
				} else {
					$thumbnail_url = get_bloginfo('stylesheet_directory'). '/img/default-hero/able-home-hero.jpg';
				}

				// compose the thumbnail
				echo '<div class="thumbnail third" style="background-image:url('.$thumbnail_url.');">';
				?>
				<a class="overlay" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" style="background-color:#70bf44"><!-- add bg colour based on image average -->
					<div class="assistive-text">
						<span class="h2"><?php the_title(); ?></span>
					</div>
				</a>

				<div class="info">
					<div class="title">
						<h2><?php the_title(); ?></h2>
						<div class="button">Summary<i class="fa fa-chevron-down"></i></div>
					</div>
					<div class="description">
						<?php
						$excerpt = $post->post_excerpt;
						if ($excerpt) {
							echo '<p>'.$excerpt.'</p><a class="button orange" href="'.get_the_permalink().'">Go to Page<i class="fa fa-chevron-right"></i></a>';
						} else {
							$edit_link = get_edit_post_link( $post->post_id );
							echo 'Site Admin to add post excerpt in:<br> <a class="red-text" href="'.$edit_link.'">page editor > excerpt</a>';
						}
						?>
					</div>
				</div>
			</div><!-- thumbnail -->

			<?php endwhile; ?>

		<?php endif; wp_reset_query(); ?>
		</div>


		<span class="divider white"></span>
	</div><!-- services wrapper -->








	<div class="wrapper-white">
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

		<span class="divider grey"></span>
	</div><!-- wrapper-white -->

	
	
	
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


	echo '<div class="wrapper-grey">';



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