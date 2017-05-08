<?php
/**
 * Template Name: Self Referral Forms Page
 *
 * Description: Add linked images to subpages for our services
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
                
                	<header class="entry-header">
                    	<h1 class="entry-title"><?php the_title(); ?></h1>
                    </header>
                    
                    <div class="entry-content wrapper">
					<?php 
					
					// functions for forms
					$form1text = get_the_block('First Form Button Text', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$form1link = get_the_block('First Form Button Link (from form ID)', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$form1 = get_the_block('First Form (shortcode)', array(
					'apply_filters' => true
					) );
					$form1 = do_shortcode( $form1 );
					
					$form2text = get_the_block('Second Form Button Text', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$form2link = get_the_block('Second Form Button Link (from form ID)', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$form2 = get_the_block('Second Form (shortcode)', array(
					'apply_filters' => true
					) );
					$form2 = do_shortcode( $form2 );

					?>
	
					<?php $maincontent = the_content();
					if ($maincontent != '')
					echo $maincontent;?>
                        
 
                    <?php // Row 1: form buttons
					if ($form1link != '' && $form2link != '')
					echo '<article class="wrapper no-border">
							<div class="left">
							  	<a class="button" href="'.html_entity_decode($form1link).'">'
									.html_entity_decode($form1text).'
								</a>
							</div><!-- .left -->
                            <div class="right">
								<a class="button" href="'.html_entity_decode($form2link).'">'
									.html_entity_decode($form2text).'
								</a>
                            </div><!-- .right -->
					      </article><!-- .wrapper -->';?>
                          

                    <?php // form 1
					if ($form1 != '')
					echo '<article class="wrapper no-border">'.
							$form1.'<a href="#post-'.get_the_ID().'">Back to the top ↑</a>
					      </article><!-- .wrapper -->';?>
                          
                    <?php // form 2
					if ($form2 != '')
					echo '<article class="wrapper no-border">'.
							$form2.'<a href="#post-'.get_the_ID().'">Back to the top ↑</a>
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