<?php
/**
 * blog posts index page
 * @link https://www.rarst.net/wordpress/front-page-logic/
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
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
										<?php
										$blogtitle = get_the_title( get_option('page_for_posts', true) );
										$blogcontent = get_the_content( get_option('page_for_posts', true) );
										echo '<h1>' . $blogtitle . '</h1>';
										?>
								</div>
						</div>
						<span class="divider white"></span>
			</div><!-- hero -->






		<?php if ( have_posts() ) :
			$marker = 1;
			while ( have_posts() ) : the_post(); ?>

            <div class="container<?php if ($marker == 1) {echo ' no-top';$marker = 0;}?>">

            	<?php if (has_post_thumbnail()) : ?>
            	<div class="four columns">
                	<?php the_post_thumbnail('thumbnail'); ?>
              </div><!-- four columns -->


              <div class="eight columns">
                	<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
									<!-- rel="bookmark" alt='<?php the_title() ?>' title='<?php the_title() ?>' -->
            		<?php the_excerpt(); ?>
              </div><!-- eight columns -->


              <?php else: ?>
                	<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
            	<?php the_excerpt(); ?>


							<?php endif; ?>

            </div><!-- container -->
			<?php endwhile;

			echo '<div class="container">';

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'AM2017' ),
				'next_text'          => __( 'Next page', 'AM2017' ),
				'screen_reader_text' => __( 'Blog Post Navigation' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'AM2017' ) . ' </span>',
			) );

			echo '</div><!-- container -->';
			?>


		<?php
		// no posts:
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
            		<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help you to find your page.', 'AM2017' ); ?></p>

						<?php get_search_form(); ?>
            <?php endif; // end current_user_can() check ?>

            </div><!-- container -->

		<?php endif; // end have_posts() check ?>

</div><!-- #content -->

<?php
// widgets just above the footer area
echo blog_widget_area();
?>

<?php get_footer(); ?>
