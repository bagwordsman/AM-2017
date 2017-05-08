<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">


			<header class="entry-header">
            	<h1 class="entry-title"><?php _e( '404: Page Not found', 'twentytwelve' ); ?></h1>
                <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentytwelve' ); ?></p>
            	<div id="pagesearch">
                    <div class="searchcontainer">
						<?php get_search_form(); ?>
                    </div><!-- #pagesearch -->
                </div>
            </header>


        </div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>