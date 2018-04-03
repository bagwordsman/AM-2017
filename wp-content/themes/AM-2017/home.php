<?php
/**
 * blog posts index page
 * @link https://www.rarst.net/wordpress/front-page-logic/
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 */

 // from settings:
 // - advert: title, content, ctas (text, url, button colour), image
 // - advert: position amongst the posts

get_header(); ?>

<div id="content" role="main">

	<?php
	// blog page title and content - no more hero any more!
	$blogtitle = get_the_title( get_option('page_for_posts', true) );
	$blogcontent = get_the_content( get_option('page_for_posts', true) );

	// widget area title
	$widget_area_title = get_option ( 'sandbox_theme_blog_options' )['blog_widget_title'];
	// widgets.php - html for advert + footer widget area


	
	// _______________________________________________________
	// check to see that there are posts
	if ( have_posts() ) :

		// page count = $paged;
		$even_pages = $paged % 2 == 0;
		$odd_pages = $paged % 2 == 1;
		
		// keep track of the post count - per page basis
		$index = 0;

		// use index to get colour - use in while loop
		$colours = array(' green', ' orange', ' blue', ' red');
		$seq = $index - 1;

		// sidebar - classes.php
		$blog_sidebar = new blogSidebar('blog_sidebar');

		// advert adds .wrapper-white and wrapper-grey containers + advert
		// - look for $ad_enabled
		$ad_enabled = get_option ( 'sandbox_theme_blog_options' )['blog_ad_check'];
		
		
		
		// ___________________________
		// wrapping

		// all pages after home / 1st page
		if ($paged > 0) {
			
			// even pages don't ever show an advert
			if ($even_pages) {
				echo '
				<div class="container pad-top">
					<div class="seven columns">';
			}
			// odd pages:
			// - with advert: add wrapper-white
			// - no advert: add pad-top
			if ($odd_pages) {
				echo 
				($ad_enabled ? '<div class="wrapper-white">' : '') . '
					<div class="container'. ( $ad_enabled ? '' : ' pad-top') .'">
						<div class="seven columns">';
			}

		}

		
		
		// _________________________________________________________________________________
		// start the posts loop:
		while ( have_posts() ) : the_post();
		
		
		// ___________________________
		// post variables
		// a) top border colour
		$seq ++;
		if ($seq % 4 == 0) {
			$seq = 0;	
		}
		$borderTop = $colours[$seq];
		// b) thumbmails - index posts
		if (has_post_thumbnail()) {
			$thumbImg = '<div class="thumb">'.get_the_post_thumbnail().'<span class="divider white"></span></div>';
		}
		else {
			$thumbImg = '';
		}
		// c) linked headings
		$postHeading = '<a href="'.get_the_permalink().'">'.get_the_title().'</a>';

		

		
		// ___________________________
		// home / 1st page + most recent 4 posts 
		if ($paged == 0 && $index < 4) {

			// left column
			if ($index == 0) {
				// wrapper
				// - with advert: add wrapper-white
				// - no advert: add pad-top
				echo 
				($ad_enabled ? '<div class="wrapper-white">' : '') . '
					<div class="container'. ( $ad_enabled ? '' : ' pad-top') .'">
						<div class="seven columns">
							<div class="post latest">
								<h3>Latest Post</h3>
								<div>
									<div class="thumb">'. ( has_post_thumbnail() ? ( get_the_post_thumbnail() ) : '<div>add a thumbnail / featured image for this post</div>') .'</div>
									<h1>'.$postHeading.'</h1>
									<p>'.get_the_excerpt().'</p>
								</div>
							</div>
						</div>';
			}
			// right column
			if ($index == 1) {
				echo '
				<div class="five columns">
					<h2>Recent Posts:</h2>
				';
			}
			if ($index > 0 && $index < 4) {
				echo '
				<div class="post recent'.$borderTop.'">
					<h3>'.$postHeading.'</h3>
					<p>'.excerpt(18).'</p>
				</div>';
			}
			if ($index == 3) {
				echo '
						</div>
					</div>'; // close .right.column and .container
					if ($ad_enabled) {
						echo '<span class="divider grey"></span>
						</div>'; // close .wrapper-white
					}
			}
		}


		// ___________________________
		// wrapping: after 4th post - home page
		// - add optional advert and open next posts container
		if ($paged == 0 && $index == 4) {
			echo blog_advert(). '
			<div class="container">
				<div class="seven columns">';
		}




		// ___________________________
		// regular list of posts - all pages
		if ($paged > 0 || $index > 3) {	
			echo '
			<div class="post index'.$borderTop.'">
				'.$thumbImg.'
				<h3>'.$postHeading.'</h3>
				<p>'.excerpt(36).'</p>
			</div>';
		}



		// ___________________________
		// wrapping: all pages AFTER 1st page
		if ($paged > 0 && $index == 4) {
			// even pages: do nothing
			// odd pages - no advert: do nothing
			
			// odd pages - with advert:
			// 	 - close: .seven.columns, .container .wrapper-white
			//   - add: sidebar, advert, next container
			if (($odd_pages) && $ad_enabled) {
				echo '
						</div>
						<div class="five columns">';
							$blog_sidebar->add_sidebar();
							echo '
						</div>
					</div>
					<span class="divider grey"></span>
				</div>';
				echo blog_advert(). '
				<div class="container">
					<div class="seven columns">';
			}
		}
		
		// increment loop by 1 (move to next post)
		$index++;
		endwhile;
		
		
		


		// _________________________________________________________________________________
		// wrapping: after page posts ended

		// odd pages: 3, 5, 7, etc.
		// - add sidebar if ad disabled
		if (($odd_pages) || ($paged == 0)) {
			echo '
				</div>
				<div class="five columns">
					';
					if ($paged == 0 || !$ad_enabled) {
						$blog_sidebar->add_sidebar();
					}
					echo '
				</div>
			</div>';
		}

		// even pages:
		// - add sidebar
		if (($even_pages) && ($paged > 0)) {
			echo '
				</div>
				<div class="five columns">
					';
					$blog_sidebar->add_sidebar();
					echo '
				</div>
			</div>';
		}








	// ___________________________
	// posts page navigation
	echo '<div class="container">';
	the_posts_pagination( array(
		'prev_text'          => __( 'Previous page', 'AM2017' ),
		'next_text'          => __( 'Next page', 'AM2017' ),
		'screen_reader_text' => __( 'Blog Post Navigation' ),
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'AM2017' ) . ' </span>',
	) );
	echo '</div><!-- container -->';
	?>


	
	
	
	
	<?php
	// _______________________________________________________
	// No posts section. Needs testing
	else : ?>
		<div class="container">

		<?php if ( current_user_can( 'edit_posts' ) ) :
		// Show a different message to a logged-in user who can add posts.
		?>
			<h1><?php _e( 'No posts to display', 'AM2017' ); ?></h1>
			<p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'AM2017' ), admin_url( 'post-new.php' ) ); ?></p>

		<?php else :
		// Show the default message to everyone else.
		?>
			<h1><?php _e( 'Nothing Found', 'AM2017' ); ?></h1>
			<p><?php _e( 'No results were found. Perhaps searching will help you to find your page.', 'AM2017' ); ?></p>

			<?php get_search_form(); ?>
		<?php endif; // end current_user_can() check ?>

		</div><!-- container -->

	<?php endif; // end have_posts() check ?>

</div><!-- #content -->

<?php
// widgets just above the footer area
echo blog_widget_area();

get_footer(); ?>
