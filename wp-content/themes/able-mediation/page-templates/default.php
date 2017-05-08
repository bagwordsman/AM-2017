<?php
/**
 * Template Name: Default Page
 *
 * Description: Default Page with left column for images
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
            
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
					<?php 
					
					// functions for articles
					$maintitle = get_the_title();
					$maincontent = get_the_content();
					$maincontentimage = get_the_block('Main Content Image (left column, leave empty for full width)', array(
					'apply_filters' => false
					) );
					
					$article2heading = get_the_block('Article 2 Heading', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$article2content = get_the_block('Article 2 Content', array(
					'apply_filters' => true
					) );
					$article2image = get_the_block('Article 2 Image (left column, leave empty for full width)', array(
					'apply_filters' => false
					) );
					
					$article3heading = get_the_block('Article 3 Heading', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$article3content = get_the_block('Article 3 Content', array(
					'apply_filters' => true
					) );
					$article3image = get_the_block('Article 3 Image (left column, leave empty for full width)', array(
					'apply_filters' => false
					) );
					
					$article4heading = get_the_block('Article 4 Heading', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$article4content = get_the_block('Article 4 Content', array(
					'apply_filters' => true
					) );
					$article4image = get_the_block('Article 4 Image (left column, leave empty for full width)', array(
					'apply_filters' => false
					) );
					
					$article5heading = get_the_block('Article 5 Heading', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$article5content = get_the_block('Article 5 Content', array(
					'apply_filters' => true
					) );
					$article5image = get_the_block('Article 5 Image (left column, leave empty for full width)', array(
					'apply_filters' => false
					) );
					?>
                    
                    <header class="entry-header">
                    	<?php if (empty($maincontentimage)){
							echo '<h1 class="entry-title">'.$maintitle.'</h1>';
						}else{
							echo '<div class="right default"><h1 class="entry-title">'.$maintitle.'</h1></div>';
							}; ?>
                    </header>
                    
                    <div class="entry-content wrapper">
	
					<?php
					
					if ($maincontent != '' &&  (empty($maincontentimage)))
					echo '<article class="wrapper">'.
						  $maincontent
						.'</article><!-- .wrapper -->';
					if ($maincontent != '' && $maincontentimage !='')
					echo '<article class="wrapper">
						  	<div class="left default">'.
						  		html_entity_decode($maincontentimage)
						  .'</div>
						   <div class="right default">'.
						  		$maincontent
						  .'</div>
						  </article><!-- .wrapper -->';?>
                        
 
                    <?php // Article 2
					if ($article2content != '' && (empty($article2image)))
					echo '<article class="wrapper">';
						  if ($article2heading != '' && (empty($article2image))) echo '<h2>'.$article2heading.'</h2>';
						  		html_entity_decode($article2content)
						.'</article><!-- .wrapper -->';
					if ($article2content != '' && $article2image !='')
					echo '<article class="wrapper">
						  	<div class="left default">'.
						  		html_entity_decode($article2image)
						  .'</div>
						   <div class="right default">';
						  	if ($article2heading != '' && $article2image !='') echo '<h2>'.html_entity_decode($article2heading).'</h2>';
								$article2content
						  .'</div>
						  </article><!-- .wrapper -->';?>
                           

                    </div><!-- .entry-content wrapper -->
                    
                    <footer class="entry-meta">
						<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
                    </footer><!-- .entry-meta -->


                </article><!-- #post -->

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>