<?php
/**
 * Template Name: Contact Page
 *
 * Description: Add Addresses Here
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
                    
                    

					<?php $maincontent = the_content();							  
					$mapsheading = get_the_block('Maps Heading', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					
					
					$location1heading = get_the_block('Location 1 Heading', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$location1id = get_the_block('Location 1 ID (remove id to hide map)', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$location1 = get_the_block('Location 1', array(
					'apply_filters' => true
					) );
					
					
					$location2heading = get_the_block('Location 2 Heading', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$location2id = get_the_block('Location 2 ID (remove id to hide map)', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$location2 = get_the_block('Location 2', array(
					'apply_filters' => true
					) );
					
					
					$location3heading = get_the_block('Location 3 Heading', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$location3id = get_the_block('Location 3 ID (remove id to hide map)', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$location3 = get_the_block('Location 3', array(
					'apply_filters' => true
					) );
					
					
					$location4heading = get_the_block('Location 4 Heading', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$location4id = get_the_block('Location 4 ID (remove id to hide map)', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$location4 = get_the_block('Location 4', array(
					'apply_filters' => true
					) );
					
					
					$location5heading = get_the_block('Location 5 Heading', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$location5id = get_the_block('Location 5 ID (remove id to hide map)', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$location5 = get_the_block('Location 5', array(
					'apply_filters' => true
					) );
					
					
					$location6heading = get_the_block('Location 6 Heading', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$location6id = get_the_block('Location 6 ID (remove id to hide map)', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$location6 = get_the_block('Location 6', array(
					'apply_filters' => true
					) );

					?>
                    
                    <?php if ($maincontent != '')
						echo html_entity_decode($maincontent);
						if ($mapsheading != '')
						echo '<h2>'.html_entity_decode($mapsheading).'</h2>'; ?>
                                               
                        
					<?php if ($location1heading != '' && $location1 != '' && $location1id != '')
						echo '<article class="wrapper">
							  	<h3>'.html_entity_decode($location1heading).'</h3>
								'.html_entity_decode($location1).'
								<div class="map" id="'.html_entity_decode($location1id).'"></div>
						      </article>'; ?>
                              
					<?php if ($location2heading != '' && $location2 != '' && $location2id != '')
						echo '<article class="wrapper">
							  	<h3>'.html_entity_decode($location2heading).'</h3>
								'.html_entity_decode($location2).'
								<div class="map" id="'.html_entity_decode($location2id).'"></div>
						      </article>'; ?>
                              
					<?php if ($location3heading != '' && $location3 != '' && $location3id != '')
						echo '<article class="wrapper">
							  	<h3>'.html_entity_decode($location3heading).'</h3>
								'.html_entity_decode($location3).'
								<div class="map" id="'.html_entity_decode($location3id).'"></div>
						      </article>'; ?>
                              
					<?php if ($location4heading != '' && $location4 != '' && $location4id != '')
						echo '<article class="wrapper">
							  	<h3>'.html_entity_decode($location4heading).'</h3>
								'.html_entity_decode($location4).'
								<div class="map" id="'.html_entity_decode($location4id).'"></div>
						      </article>'; ?>
                              
					<?php if ($location5heading != '' && $location5 != '' && $location5id != '')
						echo '<article class="wrapper">
							  	<h3>'.html_entity_decode($location5heading).'</h3>
								'.html_entity_decode($location5).'
								<div class="map" id="'.html_entity_decode($location5id).'"></div>
						      </article>'; ?>
                              
					<?php if ($location6heading != '' && $location6 != '' && $location6id != '')
						echo '<article class="wrapper">
							  	<h3>'.html_entity_decode($location6heading).'</h3>
								'.html_entity_decode($location6).'
								<div class="map" id="'.html_entity_decode($location6id).'"></div>
						      </article>'; ?>
                              
                                    
  
                    </div><!-- .entry-content wrapper -->
                    
                    <footer class="entry-meta">
						<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
                    </footer><!-- .entry-meta -->
                    
                    
                
                </article><!-- #post -->

			<?php endwhile; // end of the loop. ?>
            
            


		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar( ); ?>
<?php get_footer(); ?>