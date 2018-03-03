<?php
/**
 * The main template file
 *
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 */

get_header(); ?>

<div id="content" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="container">
            <?php
						$maintitle = get_the_title();
					  if ($maintitle != '') echo '<h1>' . $maintitle . '</h1>';
						the_content();
						?>
				</div><!-- container -->
			<?php endwhile; ?>

		<?php else : ?>
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


<?php get_footer(); ?>
