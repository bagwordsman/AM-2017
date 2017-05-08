<?php
/**
 * Template Name: Family Mediation Page
 *
 * Description: Add questions and answers that link when clicked if using id fm(id).
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
							  
					$question1heading = get_the_block('First Question', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$question1 = get_the_block('First Answer', array(
					'apply_filters' => true
					) );
					$question1id = get_the_block('First Question ID', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					
					$question2heading = get_the_block('Second Question', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$question2 = get_the_block('Second Answer', array(
					'apply_filters' => true
					) );
					$question2id = get_the_block('Second Question ID', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					
					$question3heading = get_the_block('Third Question', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$question3 = get_the_block('Third Answer', array(
					'apply_filters' => true
					) );
					$question3id = get_the_block('Third Question ID', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					
					$question4heading = get_the_block('Fourth Question', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$question4 = get_the_block('Fourth Answer', array(
					'apply_filters' => true
					) );
					$question4id = get_the_block('Fourth Question ID', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
                    
                    $question5heading = get_the_block('Fifth Question', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$question5 = get_the_block('Fifth Answer', array(
					'apply_filters' => true
					) );
					$question5id = get_the_block('Fifth Question ID', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					
					$question6heading = get_the_block('Sixth Question', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$question6 = get_the_block('Sixth Answer', array(
					'apply_filters' => true
					) );
					$question6id = get_the_block('Sixth Question ID', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					
					$question7heading = get_the_block('Seventh Question', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$question7 = get_the_block('Seventh Answer', array(
					'apply_filters' => true
					) );
					$question7id = get_the_block('Seventh Question ID', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					
					$question8heading = get_the_block('Eigth Question', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$question8 = get_the_block('Eigth Answer', array(
					'apply_filters' => true
					) );
					$question8id = get_the_block('Eigth Question ID', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					
					$question9heading = get_the_block('Ninth Question', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$question9 = get_the_block('Ninth Answer', array(
					'apply_filters' => true
					) );
					$question9id = get_the_block('Ninth Question ID', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					
					$question10heading = get_the_block('Tenth Question', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$question10 = get_the_block('Tenth Answer', array(
					'apply_filters' => true
					) );
					$question10id = get_the_block('Tenth Question ID', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					
					$question11heading = get_the_block('Eleventh Question', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$question11 = get_the_block('Eleventh Answer', array(
					'apply_filters' => true
					) );
					$question11id = get_the_block('Eleventh Question ID', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					
					$question12heading = get_the_block('Twelfth Question', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$question12 = get_the_block('Twelfth Answer', array(
					'apply_filters' => true
					) );
					$question12id = get_the_block('Twelfth Question ID', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					
					?>

	  
						<article class="wrapper">
						
						<?php if ( has_post_thumbnail())
						echo '<div class="left">';
							if ($maincontent != '') {echo $maincontent;}?>
                            
								<ul id="fm-menu">
								<?php if ($question1heading != '' && $question1 != '' && $question1id != '')
									echo '<li><a title="'.$question1heading.'" href="'.get_permalink().'#'.$question1id.'">'.$question1heading.'</a></li>';
									if ($question2heading != '' && $question2 != '' && $question2id != '')
									echo '<li><a title="'.$question2heading.'" href="'.get_permalink().'#'.$question2id.'">'.$question2heading.'</a></li>';
									if ($question3heading != '' && $question3 != '' && $question3id != '')
									echo '<li><a title="'.$question3heading.'" href="'.get_permalink().'#'.$question3id.'">'.$question3heading.'</a></li>';
									if ($question4heading != '' && $question4 != '' && $question4id != '')
									echo '<li><a title="'.$question4heading.'" href="'.get_permalink().'#'.$question4id.'">'.$question4heading.'</a></li>';
									if ($question5heading != '' && $question5 != '' && $question5id != '')
									echo '<li><a title="'.$question5heading.'" href="'.get_permalink().'#'.$question5id.'">'.$question5heading.'</a></li>';
									if ($question6heading != '' && $question6 != '' && $question6id != '')
									echo '<li><a title="'.$question6heading.'" href="'.get_permalink().'#'.$question6id.'">'.$question6heading.'</a></li>';
									if ($question7heading != '' && $question7 != '' && $question7id != '')
									echo '<li><a title="'.$question7heading.'" href="'.get_permalink().'#'.$question7id.'">'.$question7heading.'</a></li>';
									if ($question8heading != '' && $question8 != '' && $question8id != '')
									echo '<li><a title="'.$question8heading.'" href="'.get_permalink().'#'.$question8id.'">'.$question8heading.'</a></li>';
									if ($question9heading != '' && $question9 != '' && $question9id != '')
									echo '<li><a title="'.$question9heading.'" href="'.get_permalink().'#'.$question9id.'">'.$question9heading.'</a></li>';
									if ($question10heading != '' && $question10 != '' && $question10id != '')
									echo '<li><a title="'.$question10heading.'" href="'.get_permalink().'#'.$question10id.'">'.$question10heading.'</a></li>';
									if ($question11heading != '' && $question11 != '' && $question11id != '')
									echo '<li><a title="'.$question11heading.'" href="'.get_permalink().'#'.$question11id.'">'.$question11heading.'</a></li>';
									if ($question12heading != '' && $question12 != '' && $question12id != '')
									echo '<li><a title="'.$question12heading.'" href="'.get_permalink().'#'.$question12id.'">'.$question12heading.'</a></li>'; ?>
                            	</ul><!-- #fm-menu -->

						<?php if ( has_post_thumbnail()):?>
							</div><!-- .left -->
                            <div class="right">
								<?php the_post_thumbnail()?>
                            </div><!-- .left -->
						<?php endif; ?>
                            
                        </article><!-- .wrapper -->
                        
                        
					<?php if ($question1heading != '' && $question1 != '' && $question1id != '')
						echo '<article class="'.$question1id.'">
							  	<h3>'.html_entity_decode($question1heading).'</h3><div>
								'.html_entity_decode($question1).'</div><a href="'.get_permalink().'#fm-menu">Back to the top ↑</a>
						      </article>'; ?>
					<?php if ($question2heading != '' && $question2 != '' && $question2id != '')
						echo '<article class="'.$question2id.'">
							  	<h3>'.html_entity_decode($question2heading).'</h3><div>
								'.html_entity_decode($question2).'</div><a href="'.get_permalink().'#fm-menu">Back to the top ↑</a>
						      </article>'; ?>
					<?php if ($question3heading != '' && $question3 != '' && $question3id != '')
						echo '<article class="'.$question3id.'">
							  	<h3>'.html_entity_decode($question3heading).'</h3><div>
								'.html_entity_decode($question3).'</div><a href="'.get_permalink().'#fm-menu">Back to the top ↑</a>
						      </article>'; ?>
					<?php if ($question4heading != '' && $question4 != '' && $question4id != '')
						echo '<article class="'.$question4id.'">
							  	<h3>'.html_entity_decode($question4heading).'</h3><div>
								'.html_entity_decode($question4).'</div><a href="'.get_permalink().'#fm-menu">Back to the top ↑</a>
						      </article>'; ?>
					<?php if ($question5heading != '' && $question5 != '' && $question5id != '')
						echo '<article class="'.$question5id.'">
							  	<h3>'.html_entity_decode($question5heading).'</h3><div>
								'.html_entity_decode($question5).'</div><a href="'.get_permalink().'#fm-menu">Back to the top ↑</a>
						      </article>'; ?>
					<?php if ($question6heading != '' && $question6 != '' && $question6id != '')
						echo '<article class="'.$question6id.'">
							  	<h3>'.html_entity_decode($question6heading).'</h3><div>
								'.html_entity_decode($question6).'</div><a href="'.get_permalink().'#fm-menu">Back to the top ↑</a>
						      </article>'; ?>
					<?php if ($question7heading != '' && $question7 != '' && $question7id != '')
						echo '<article class="'.$question7id.'">
							  	<h3>'.html_entity_decode($question7heading).'</h3><div>
								'.html_entity_decode($question7).'</div><a href="'.get_permalink().'#fm-menu">Back to the top ↑</a>
						      </article>'; ?>
					<?php if ($question8heading != '' && $question8 != '' && $question8id != '')
						echo '<article class="'.$question8id.'">
							  	<h3>'.html_entity_decode($question8heading).'</h3><div>
								'.html_entity_decode($question8).'</div><a href="'.get_permalink().'#fm-menu">Back to the top ↑</a>
						      </article>'; ?>
					<?php if ($question9heading != '' && $question9 != '' && $question9id != '')
						echo '<article class="'.$question9id.'">
							  	<h3>'.html_entity_decode($question9heading).'</h3><div>
								'.html_entity_decode($question9).'</div><a href="'.get_permalink().'#fm-menu">Back to the top ↑</a>
						      </article>'; ?>
					<?php if ($question10heading != '' && $question10 != '' && $question10id != '')
						echo '<article class="'.$question10id.'">
							  	<h3>'.html_entity_decode($question10heading).'</h3><div>
								'.html_entity_decode($question10).'</div><a href="'.get_permalink().'#fm-menu">Back to the top ↑</a>
						      </article>'; ?>
					<?php if ($question11heading != '' && $question11 != '' && $question11id != '')
						echo '<article class="'.$question11id.'">
							  	<h3>'.html_entity_decode($question11heading).'</h3><div>
								'.html_entity_decode($question11).'</div><a href="'.get_permalink().'#fm-menu">Back to the top ↑</a>
						      </article>'; ?>
					<?php if ($question12heading != '' && $question12 != '' && $question12id != '')
						echo '<article class="'.$question12id.'">
							  	<h3>'.html_entity_decode($question12heading).'</h3><div>
								'.html_entity_decode($question12).'</div><a href="'.get_permalink().'#fm-menu">Back to the top ↑</a>
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