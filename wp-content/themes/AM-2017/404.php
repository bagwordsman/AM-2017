<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 */

get_header(); ?>

<div id="content" role="main">

		<div class="hero">
				<?php echo '<img src="'. get_bloginfo('stylesheet_directory'). '/img/default-hero/able-default-hero.jpg" alt="'.get_bloginfo('name').'"/>'; ?>
				<div <?php if ($heromesh) echo 'class="mesh"'; ?>>
						<div class="container">
								<h1><?php _e( '404: Page Not found', 'AM2017' ); ?></h1>
						</div>
				</div>
				<span class="hero-divider"></span>
		</div><!-- hero -->


		<div class="container raw-heading">
				<h2><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'AM2017' ); ?></h2>
				<div class="searchcontainer">
						<?php get_search_form(); ?>
				</div><!-- .searchcontainer -->
		</div><!-- container -->

</div><!-- #content -->
<?php get_footer(); ?>
