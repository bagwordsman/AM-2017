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
		<h2>404: Sorry! Your page was not found. Perhaps it can be found below:</h2>
		<ul id="sitemap-list">
			<?php wp_list_pages( array( 'title_li' => '' ) ); ?>
		</ul>
	</div><!-- container -->

</div><!-- #content -->
<?php get_footer(); ?>
