<?php
/**
 * Template Name: Our Services Page
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
					
					// functions for boxes
					$box1heading = get_the_block('First Box Heading', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$box1image = get_the_block('First Box Image (do not link the image)', array(
					'apply_filters' => false
					) );
					$box1link = get_the_block('First Box Link - Enter link in (child-page) format, e.g. the red text here: http://www.ablemediation.com/our-services/<span class="red">children-in-mediation</span>.', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					
					$box2heading = get_the_block('Second Box Heading (leave blank for full width linked box)', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$box2image = get_the_block('Second Box Image (do not link the image)', array(
					'apply_filters' => false
					) );
					$box2link = get_the_block('Second Box Link. Enter link in (child-page) format, e.g. the bold text here: http://www.ablemediation.com/our-services/<span class="red">children-in-mediation</span>.', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					
					$box3heading = get_the_block('Third Box Heading', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$box3image = get_the_block('Third Box Image (do not link the image)', array(
					'apply_filters' => false
					) );
					$box3link = get_the_block('Third Box Link - Enter link in (child-page) format, e.g. the bold text here: http://www.ablemediation.com/our-services/<span class="red">children-in-mediation</span>.', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					
					$box4heading = get_the_block('Fourth Box Heading', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$box4image = get_the_block('Fourth Box Image (do not link the image)', array(
					'apply_filters' => false
					) );
					$box4link = get_the_block('Fourth Box Link - Enter link in (child-page) format, e.g. the bold text here: http://www.ablemediation.com/our-services/<span class="red">children-in-mediation</span>.', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					
					$box5heading = get_the_block('Fifth Box Heading', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$box5image = get_the_block('Fifth Box Image (do not link the image)', array(
					'apply_filters' => false
					) );
					$box5link = get_the_block('Fifth Box Link - Enter link in (child-page) format, e.g. the red text here: http://www.ablemediation.com/our-services/<span class="red">children-in-mediation</span>.', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					
					$box6heading = get_the_block('Sixth Box Heading', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$box6image = get_the_block('Sixth Box Image (do not link the image)', array(
					'apply_filters' => false
					) );
					$box6link = get_the_block('Sixth Box Link - Enter link in (child-page) format, e.g. the bold text here: http://www.ablemediation.com/our-services/<span class="red">children-in-mediation</span>.', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					
					// functions for footer content
					$footerheader = get_the_block('Footer Heading', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$footercontent = get_the_block('Footer Content', array(
					'apply_filters' => false
					) );
					?>
	
					<?php $maincontent = the_content();
					if ($maincontent != '')
					echo '<article class="wrapper">'.
						  $maincontent
						.'</article><!-- .wrapper -->';?>
                        
 
                    <?php // Row 1: linked boxes
					if ($box1heading != '' && $box2heading != '')
					echo '<article class="wrapper no-border">
							<div class="left box">
							  	<a href="'.html_entity_decode($box1link).'">
									<h2 class="greenspan">'.html_entity_decode($box1heading).'</h2>'.
									html_entity_decode($box1image).'
								</a>
							</div><!-- .left -->
                            <div class="right box">
								<a href="'.html_entity_decode($box2link).'">
									<h2 class="greenspan">'.html_entity_decode($box2heading).'</h2>'.
									html_entity_decode($box2image).'
								</a>
                            </div><!-- .right -->
					      </article><!-- .wrapper -->';
						  
					if ($box1heading != '' && (empty($box2heading)))
					echo '<article class="wrapper no-border">
							<div class="box wide">
								<a href="'.html_entity_decode($box1link).'">
									<h2 class="greenspan">'.html_entity_decode($box1heading).'</h2>'.
									html_entity_decode($box1image).'
								</a>
							</div>
					      </article><!-- .wrapper -->';?>
                          

                    <?php // Row 2: linked boxes
					if ($box3heading != '' && $box4heading != '')
					echo '<article class="wrapper no-border">
							<div class="left box">
							  	<a href="'.html_entity_decode($box3link).'">
									<h2 class="greenspan">'.html_entity_decode($box3heading).'</h2>'.
									html_entity_decode($box3image).'
								</a>
							</div><!-- .left -->
                            <div class="right box">
								<a href="'.html_entity_decode($box4link).'">
									<h2 class="greenspan">'.html_entity_decode($box4heading).'</h2>'.
									html_entity_decode($box4image).'
								</a>
                            </div><!-- .right -->
					      </article><!-- .wrapper -->';
						  
					if ($box3heading != '' && (empty($box4heading)))
					echo '<article class="wrapper no-border">
							<div class="box wide">
								<a href="'.html_entity_decode($box3link).'">
									<h2 class="greenspan">'.html_entity_decode($box3heading).'</h2>'.
									html_entity_decode($box3image).'
								</a>
							</div>
					      </article><!-- .wrapper -->';?>
                          
                    <?php // Row 3: linked boxes
					if ($box5heading != '' && $box6heading != '')
					echo '<article class="wrapper no-border">
							<div class="left box">
							  	<a href="'.html_entity_decode($box5link).'">
									<h2 class="greenspan">'.html_entity_decode($box5heading).'</h2>'.
									html_entity_decode($box5image).'
								</a>
							</div><!-- .left -->
                            <div class="right box">
								<a href="'.html_entity_decode($box6link).'">
									<h2 class="greenspan">'.html_entity_decode($box6heading).'</h2>'.
									html_entity_decode($box6image).'
								</a>
                            </div><!-- .right -->
					      </article><!-- .wrapper -->';
						  
					if ($box5heading != '' && (empty($box6heading)))
					echo '<article class="wrapper no-border">
							<div class="box wide">
								<a href="'.html_entity_decode($box5link).'">
									<h2 class="greenspan">'.html_entity_decode($box5heading).'</h2>'.
									html_entity_decode($box5image).'
								</a>
							</div>
					      </article><!-- .wrapper -->';?>
                          
                    <?php if ($footercontent != '')
					echo '<article class="wrapper">';
						  if ($footerheader != '') echo '<h3>'.html_entity_decode($footerheader).'</h3>';
						  if ($footercontent != '')
						  echo html_entity_decode($footercontent)
						.'</article><!-- .wrapper -->';?>                             

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