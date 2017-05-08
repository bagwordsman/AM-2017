<?php
/**
 * Template Name: Home Page
 *
 * Description: Template for displaying the Home Page, with a full width image slider
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
<?php if ( function_exists( 'soliloquy_slider' ) ) soliloquy_slider( '70' ); ?>
<div class="widget-caption">
<?php 
 if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Slider Caption') ) : ?>
<?php endif;?>
</div><!-- .widget-caption -->
	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="entry-page-image">
						<?php the_post_thumbnail(); ?>
					</div><!-- .entry-page-image -->
				<?php endif; ?>

				<?php get_template_part( 'content', 'page' ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->
<div id="secondary" class="widget-area" role="complementary">
<?php 
 if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Page') ) : ?>
<?php endif;?>
</div><!-- #secondary -->
<?php get_footer(); ?>