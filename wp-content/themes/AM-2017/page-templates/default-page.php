<?php
/**
 * Template Name: Able Default Page
 * Description: Template for displaying Default Pages
 */

get_header(); ?>

<div id="content" role="main">

			<div class="hero">
						<?php
						$styling_options = get_option ( 'sandbox_theme_styling_options' );
						$heromesh = $styling_options['heromesh'];
						// hero image - post thumbnail (if set)
						if (has_post_thumbnail()) {
								the_post_thumbnail('full');
						// output default img from theme (if not set)
						} else {
								echo '<img src="'. get_bloginfo('stylesheet_directory'). '/img/default-hero/able-default-hero.jpg" alt="'.get_bloginfo('name').'"/>';
						}
						?>
						<div <?php if ($heromesh) echo 'class="mesh"'; ?>>
								<div class="container">
										<h1><?php
										// display the <h1> heading with ACF
										if (get_field('h1_heading')) {
											echo get_field('h1_heading');
										} else {
											the_title();
										}
										?></h1>
								</div>
						</div>
						<span class="divider white"></span>
			</div><!-- hero -->



			<?php
			// main content area - first section
			while ( have_posts() ) : the_post(); ?>

			<div class="wrapper-white">
					<?php
					$sidebar_1 = get_field('first_section_sidebar');
					$sidebar_1_colour = get_field('first_section_sidebar_colour');
					$logos_1 = get_field('first_section_logos');
					// content and sidebar
					if ($sidebar_1) : ?>
					<div class="container">
							<div class="seven columns">
									<?php the_content(); ?>
							</div>
							<?php echo '
							<div class="five columns'. ( $sidebar_1_colour ? ( ' '. $sidebar_1_colour .'"' )  : '"') .'>
									'. $sidebar_1 .'
							</div>
							'; ?>
					</div><!-- container -->

					<?php elseif ($sidebar_1 == '') : ?>
					<div class="container">
							<?php the_content(); ?>
					</div><!-- container -->
					<?php endif  ?>

					<?php if ($logos_1) {
							echo '
							<div class="container container--center container-narrow">
									'. $logos_1 .'
							</div>';
					}
					?>
			<span class="divider grey"></span>
			</div><!-- wrapper-white -->

			<?php
			// end main content area
			endwhile;
			?>




			<?php
			// grey coloured content area - second section
			$id_2 = get_field('second_section_id');
			$header_2 = get_field('second_section_header');
			$content_2 = get_field('second_section_content');
			$columns_2 = get_field('second_section_columns');

			// all columns
			$all_columns = explode('<hr />', $columns_2);
			$columns_count = count($all_columns);

			// get columns classname - to reduce amount of code
			$columns_class = array(
			  '1'  => 'twelve ',
			  '2' => 'six ',
				'3' => 'four ',
				'4' => 'three ',
				'5' => 'twopointfive ',
				'6' => 'two '
			);
			$columns_class = strtr($columns_count, $columns_class);
			//var_dump($columns_class);


			if ($header_2 || $content_2) {
			echo '<div class="wrapper-grey"'.( $id_2 ? (' id="'.$id_2.'" ')  : '').'>';
			}

			// grey coloured content area - header and intro
			echo ( $header_2 ? ('<div class="container container--center container-narrow"><h2>'. $header_2 .'</h2>' . $content_2 . '</div>')  : '');


			// column container
			echo '<div class="container">';

			// columns
			foreach($all_columns as $column) {
					echo '<div class="'. $columns_class .' columns">'.$column.'</div>';
			} // end foreach

			echo '</div>';


			if ($header_2 || $content_2) {
			echo '<span class="divider white"></span></div>';
			}








			// for columns, I want to compose one row at a time, using the <hr/> dividers
			// can add up to 6 rows, but splitting content into columns
			// 	- can designate parts of the text to be hidden with the editor
			//	- need to split image and content

			// note: this needs to handle 3 step process on family mediation page, and the profiles


			// second content area - if it exists, run the following code
			$second_content_area = get_field('second_content_area');
			if ($second_content_area) {

					// split second content area up
					$columns = explode('<hr />', $second_content_area);

					// var_dump($columns[0]);

					// count the columns
					// var_dump(count($columns));
					$even_odd = count($columns);

					// - - - - - -
					// even columns
					if ($even_odd % 2 == 0) {

							// wrap with container
							echo '<div class="container">';

							$i = 0;
							foreach($columns as $column) {
									 echo '<div class="six columns">'.$column.'</div>';
									 $i++;
									 // if counter divisible by 2, and is not the number of columns yet: start new container
									 if ($i % 2 == 0 && $i != count($columns)) {
											 echo '</div><div class="container">';
									 }
							} // end foreach

							echo '</div>';


					// - - - - - -
					// odd columns
					} else {

							// one item only
							if ($even_odd < 2) {
									foreach($columns as $column) {
											echo '<div class="container">'.$column.'</div>';
									}
							}
							// more than 2 items
							if ($even_odd > 2) {

									// pop off last item - to add at the end
									$lastitem = array_pop($columns);

									echo '<div class="container">';

											$i = 0;
											foreach($columns as $column) {
													 echo '<div class="six columns">'.$column.'</div>';
													 $i++;
													 // if counter divisible by 2, and is not the number of columns yet: start new container
													 if ($i % 2 == 0 && $i != count($columns)) {
															 echo '</div><div class="container">';
													 }
											} // end foreach

									echo '</div><div class="container">'.$lastitem.'</div>';


							} // end more than 2 items
					} // end odd columns

			} // end second content area




			// 3rd section - last content
			$id_3 = get_field('last_section_id');
			$header_3 = get_field('last_header');
			$content_3 = get_field('last_content');
			$fullwidth_3 = get_field('last_section_-_full_width');



			// output header
			echo ( $header_3 ? ('<div class="container container--center container-narrow"'.( $id_3 ? (' id="'.$id_3.'" ')  : '').'><h3>'. $header_3 .'</h3></div>') : '');
			// fullwidth option applies to content only
			echo ( $content_3 ? ('<div'. ( $fullwidth_3 ? ('') : ' class="container container--center container-narrow"') . '>' . $content_3 . '</div>')  : '');
			//. ( $header_3 ? ('<h3>'. $header_3 .'</h3>') : '') .
			//. ( $fullwidth_3 ? ('') : ' class="container container--center container-narrow"') .



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
