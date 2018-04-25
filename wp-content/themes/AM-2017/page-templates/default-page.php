<?php
/**
 * Template Name: Able Default Page
 * Description: Template for displaying Default Pages
 */

get_header(); ?>

<div id="content" role="main">

	
	
	<?php
	
	?>



	<?php
	// SECTION 1
	// main content area - first section
	while ( have_posts() ) : the_post();
	
	// hero - page-content.php
	heroSection($hero_content = '', $hero_right = '', $hero_right_bg = '');
	
	?>



	<div class="wrapper white-bg">
		<?php
		$sidebar_1 = get_field('first_section_sidebar');
		$sidebar_1_colour = get_field('first_section_sidebar_colour');
		$logos_1 = get_field('first_section_logos');
		// width and center
		$content_1_format = get_field('first_section_content_formatting');
		$narrow = $content_1_format[0];
		$center = $content_1_format[1];


		// has sidebar
		if ($sidebar_1) {
			echo '
			<div class="container">
				<div class="seven columns">'
				;?><?php the_content(); ?><?php echo ' 
				</div>
				<div class="five columns'. ( $sidebar_1_colour ? ( ' '. $sidebar_1_colour .'"' )  : '"') .'">
					'. $sidebar_1 .'
				</div>
			</div>
			';
		}
		// no sidebar
		else {
			echo '
			<div class="container'.( $narrow ? (' container-narrow')  : '').( $center ? (' container--center')  : '').'">'
			;?><?php the_content(); ?><?php echo '
			</div>
			';
		}
		// logos
		if ($logos_1) {
			echo '
			<div class="container'.( $narrow ? (' container-narrow')  : '').( $center ? (' container--center')  : '').'">
				'. $logos_1 .'
			</div>';
		}
		

		?>




	<span class="divider grey"></span>
	</div><!-- wrapper white-bg -->

	<?php
	// end main content area
	endwhile;
	?>








	<?php
	// SECTION 2

	// ___________________________________________
	// grey coloured content area - second section
	$id_2 = get_field('second_section_id');
	$header_2 = get_field('second_section_header');
	$content_2 = get_field('second_section_content');
	$content_2_format = get_field('second_section_content_formatting');
	// sidebar
	$sidebar_2 = get_field('second_section_sidebar');
	$sidebar_2_colour = get_field('second_section_sidebar_colour');
	// columns - can't be narrow
	$columns_2 = get_field('second_section_columns');
	$columns_staged = get_field('second_section_staged_columns');
	// separate out columns
	$all_columns = explode('<hr />', $columns_2);
	$columns_count = count($all_columns);
	// get columns classname from the column count
	$columns_class = array(
		'1'  => 'twelve ',
		'2' => 'six ',
		'3' => 'four ',
		'4' => 'three ',
		'5' => 'twopointfive ',
		'6' => 'two '
	);
	$columns_class = strtr($columns_count, $columns_class);

	


	// ____________________________________
	// content area
	// - start grey wrapped
	if ($header_2 || $content_2 || $columns_2) {
	echo '<div class="wrapper grey-bg"'.( $id_2 ? (' id="'.$id_2.'" ')  : '').'>';
	}

	
	// _______________
	// has sidebar
	if ($sidebar_2) {
		echo '
		<div class="container">
			<div class="five columns'. ( $sidebar_2_colour ? ( ' '. $sidebar_2_colour .'"' )  : '"') .'>
				'. $sidebar_2 .'
			</div>
			<div class="seven columns">
				<h2>'. $header_2 .'</h2> ' . $content_2 . '
			</div>
		</div>';
	}
	// no sidebar
	else {
		$narrow = $content_2_format[0];
		$center = $content_2_format[1];
		echo '
		<div class="container'.( $narrow ? (' container-narrow')  : '').( $center ? (' container--center')  : '').'">
			<h2>'. $header_2 .'</h2>'. $content_2 . '
		</div>';

	}



	// ____________
	// if staged columns > add arrows
	// - .container--center on main container
	// - .stage to columns
	// - .columns--divider div as last child of all but 1st columns
	echo '<div class="container'. ( $columns_staged ? (' container--center') : '') .'">';

	// columns
	$i = 0;
	foreach($all_columns as $column) {
		$i++;
		echo '<div class="'. $columns_class .' columns'. ( $columns_staged ? (' stage') : '') .'">'.$column;
		if ($columns_staged && $i > 1) {
			echo '<div class="columns--divider"></div>';
		}
		echo '</div>';
	} // end foreach

	echo '</div>';

	// end grey wrapper
	if ($header_2 || $content_2 || $columns_2) {
	echo '<span class="divider white"></span></div>';
	}




	// ___________________
	// second content area
	// - can split image and content in WYSIWYG with <hr>
	$second_content_area = get_field('second_content_area');
	if ($second_content_area) {

		// split second content area up
		$columns = explode('<hr />', $second_content_area);

		// count the columns
		$even_odd = count($columns);

		// even columns
		if ($even_odd % 2 == 0) {
			echo '<div class="container">';
			// output columns
			$i = 0;
			foreach($columns as $column) {
				echo '<div class="six columns">'.$column.'</div>';
				$i++;
				// if counter divisible by 2, and is not the number of columns yet: start new container
				if ($i % 2 == 0 && $i != count($columns)) {
						echo '</div><div class="container">';
				}
			}
			echo '</div>';

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




	
	
	// ____________________________________
	// SECTION 3
	// 3rd section - last content
	$id_3 = get_field('last_section_id');
	$header_3 = get_field('last_header');
	// content separate from header
	$content_3 = get_field('last_content');
	$content_3_format = get_field('last_content_formatting');
	$narrow = $content_3_format[0];
	$center = $content_3_format[1];
	// full width for map - overrides everything else
	$fullwidth_3 = get_field('last_section_-_full_width');



	// output header - in a separate container, needs to work on map page
	echo ( $header_3 ? ('<div class="container'.( $narrow ? (' container-narrow')  : '').( $center ? (' container--center')  : '').'"'.( $id_3 ? (' id="'.$id_3.'" ')  : '').'><h3>'. $header_3 .'</h3></div>') : '');

		
	// fullwidth option applies to content only
	echo ( $content_3 ? ('<div'. ( $fullwidth_3 ? ('') : ' class="container'.( $narrow ? (' container-narrow')  : '').( $center ? (' container--center')  : '').'"') . '>' . $content_3 . '</div>')  : '');




	?>

</div><!-- #content -->







<?php
// in page cta - page-content.php
pageCta();
?>

<?php get_footer(); ?>
