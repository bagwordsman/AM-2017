<?php
/**
 * Template Name: Home Page with Slider
 *
 * Description: Template for displaying the Home Page, with inbuilt image slider
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
<?php // slides (need to remove wordpress default p tags)
	  $slide1 = get_the_block('Slide 1 image', array(
	  'apply_filters' => false
	  ) );
	  $slide2 = get_the_block('Slide 2 image', array(
	  'apply_filters' => false
	  ) );
	  $slide3 = get_the_block('Slide 3 image', array(
	  'apply_filters' => false
	  ) );
	  $slide4 = get_the_block('Slide 4 image', array(
	  'apply_filters' => false
	  ) );
	  $slide5 = get_the_block('Slide 5 image', array(
	  'apply_filters' => false
	  ) );
	  $slide6 = get_the_block('Slide 6 image', array(
	  'apply_filters' => false
	  ) );
	  $slide7 = get_the_block('Slide 7 image', array(
	  'apply_filters' => false
	  ) );
	  $slide8 = get_the_block('Slide 8 image', array(
	  'apply_filters' => false
	  ) );
	  $slide9 = get_the_block('Slide 9 image', array(
	  'apply_filters' => false
	  ) );
	  $slide10 = get_the_block('Slide 10 image', array(
	  'apply_filters' => false
	  ) );
	  
	  // caption
	  $green = get_the_author_meta('captiongreentext',1);
	  $main = get_the_author_meta('captiontext',1);
	  $link = get_the_author_meta('captionlink',1);
	  $linktext = get_the_author_meta('captionlinktext',1);
	  $main2 = get_the_author_meta('captiontext2',1);
	  $logo = get_the_author_meta('logotoggle',1);
	  
	  $green = get_the_block('Image Slider Caption <span class="greenspan">Green Text</span>', array(
	  'type'          => 'one-liner',
	  'apply_filters' => false
	  ) );
	  $main = get_the_block('Image Slider Caption <span class="grey">Main Text</span>', array(
	  'type'          => 'one-liner',
	  'apply_filters' => false
	  ) );
	  $link = get_the_block('Caption Link (enter full url, for example: <span class="red">http://www.ablemediation.com/family-mediation</span>)', array(
	  'type'          => 'one-liner',
	  'apply_filters' => false
	  ) );
	  $linktext = get_the_block('Caption Link Text Link Text (text that the above url links from)', array(
	  'type'          => 'one-liner',
	  'apply_filters' => false
	  ) );
	  $main2 = get_the_block('<span class="grey">Text after the link</span>', array(
	  'type'          => 'one-liner',
	  'apply_filters' => false
	  ) );
	  $logo = get_the_block('Toggle Legal Aid Logo (enter any text to toggle legal aid logo)', array(
	  'type'          => 'one-liner',
	  'apply_filters' => false
	  ) );
	  ?>
      

<div class="slider-container">

	<div class="flexslider">
    	<ul id="slider" class="slides">
		<?php if ($slide1 != '') echo '<li>'.html_entity_decode($slide1).'</li>';
			  if ($slide2 != '') echo '<li>'.html_entity_decode($slide2).'</li>';
			  if ($slide3 != '') echo '<li>'.html_entity_decode($slide3).'</li>';
			  if ($slide4 != '') echo '<li>'.html_entity_decode($slide4).'</li>';
			  if ($slide5 != '') echo '<li>'.html_entity_decode($slide5).'</li>';
			  if ($slide6 != '') echo '<li>'.html_entity_decode($slide6).'</li>';
			  if ($slide7 != '') echo '<li>'.html_entity_decode($slide7).'</li>';
			  if ($slide8 != '') echo '<li>'.html_entity_decode($slide8).'</li>';
			  if ($slide9 != '') echo '<li>'.html_entity_decode($slide9).'</li>';
			  if ($slide10 != '') echo '<li>'.html_entity_decode($slide10).'</li>'; ?>
		</ul><!-- #slider -->
	</div><!-- .flexslider -->
    
    <?php if ($main != '') echo '
	<div class="widget-caption">
	<aside class="widget">
		<p>'; if ($green != '') echo '<span class="highlight">'.$green.'</span> ';
		echo $main .'</br>';
		if ($link != '' && $linktext != '') echo '<span class="highlight"><a href="'.$link.'">'.$linktext.'</a></span> ';
		if ($main2 != '') echo $main2;
		if ($main != '') echo '
		</p>';
		if ($logo != '') echo '<img src="'.get_bloginfo('stylesheet_directory').'/images/legal-aid-logo-small.png" alt="Qualify for Legal Aid in Family Mediation" />';
	if ($main != '') echo '
	</aside><!-- .widget -->
</div><!-- .widget-caption -->'; ?>  
    
</div><!-- .slider-container -->



	<div id="primary" class="site-content">
		<div id="content" role="main">
        
        
        	<?php while ( have_posts() ) : the_post(); ?>
            
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                	<header class="entry-header intro">
                    	<h1 class="entry-title"><?php the_title(); ?></h1>
                        <?php
                        $maincontent = the_content();
						$callnow = get_the_block('Call Now Text', array(
						'type'          => 'one-liner',
						'apply_filters' => false
						) );
						if ($maincontent != '') {echo $maincontent;} 
						if ($callnow != '') {echo '<span class="orangespan phone">'.$callnow.'</span>';}?>
                    </header>
                    <div class="entry-content wrapper">
                    
                    
					<?php // functions for content blocks			  
					
					$highlight = get_the_block('First Column Heading (Highlighted Text)', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$column1heading = get_the_block('First Column Heading', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$column1content = get_the_block('First Column Content', array(
					'apply_filters' => false
					) );
					$fb = get_the_block('Facebook Link (full url)', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$column2heading = get_the_block('Second Column Heading', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$column2content = get_the_block('Second Column Content (leave blank for full width column)', array(
					'apply_filters' => false
					) );
					
					
					
					$box1heading = get_the_block('First Box Heading', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					$box1image = get_the_block('First Box Image (do not link the image)', array(
					'apply_filters' => false
					) );
					$box1link = get_the_block('First Box Link - Enter link in (parent-page/child-page) format, e.g. the red text here: http://www.ablemediation.com/<span class="red">our-services/children-in-mediation</span>.', array(
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
					$box2link = get_the_block('Second Box Link. Enter link in (parent-page/child-page) format, e.g. the red text here: http://www.ablemediation.com/<span class="red">our-services/children-in-mediation</span>.', array(
					'type'          => 'one-liner',
					'apply_filters' => false
					) );
					?>


                    <?php // Row 1: text columns
					if ($column1content != '' || $column2content != '')
					echo '<article class="wrapper">';
						// left and right divs if both present
                    	if ($column1content != '' && $column2content != '')
						echo '<div class="left">'; ?>
                        
								<?php
                                // column 1  a) fb
								if ($column1content != '' && $fb != '') echo '
							  	<h3><span class="highlight">'.html_entity_decode($highlight).'</span>'.html_entity_decode($column1heading).'</h3>'.
								html_entity_decode($column1content).'
								<div class="fb-like">
									<a href="'.html_entity_decode($fb).'" target="_blank" title="Like Our Facebook Page">Like us</a>
								</div>'; 
								// b) no fb
								if ($column1content != '' && $fb = '') echo '
							  	<h3><span class="highlight">'.html_entity_decode($column1heading).'</span></h3>'.
								html_entity_decode($column1content);?>
                                
						<?php // left and right divs
                    	if ($column1content != '' && $column2content != '')
						echo '</div><!-- .left -->
							  <div class="right">
							  	 <h3>'.html_entity_decode($column2heading).'</h3>'.
								 html_entity_decode($column2content).'
						      </div><!-- .right -->';
					if ($column1content != '' || $column2content != '')
					echo '</article><!-- .wrapper -->'; ?>
                    
                    
                    
                    <?php // Row 2: linked boxes
					if ($box1heading != '' && $box2heading != '')
					echo '<article class="wrapper">
							<div class="left box">
							  	<a href="'.html_entity_decode($box1link).'">
									<h2 class="greyspan">'.html_entity_decode($box1heading).'</h2>'.
									html_entity_decode($box1image).'
								</a>
							</div><!-- .left -->
                            <div class="right box">
								<a href="'.html_entity_decode($box2link).'">
									<h2 class="greyspan">'.html_entity_decode($box2heading).'</h2>'.
									html_entity_decode($box2image).'
								</a>
                            </div><!-- .right -->
					      </article><!-- .wrapper -->';
						  
					if ($box1heading != '' && $box2heading = '')
					echo '<article class="wrapper">
							<a href="'.html_entity_decode($box1link).'">
								<h2 class="greyspan">'.html_entity_decode($box1heading).'</h2>'.
								html_entity_decode($box1image).'
							</a>
					      </article><!-- .wrapper -->';?>
                  
                    </div><!-- .entry-content wrapper -->
                    <footer class="entry-meta">
						<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
                    </footer><!-- .entry-meta -->
                    
                </article><!-- #post -->
			<?php endwhile; // end of the loop. ?>
		</div><!-- #content -->
	</div><!-- #primary -->
    
	
    
    <div id="secondary" class="widget-area" role="complementary">
		<?php
        	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Page') ) : ?>
		<?php endif;?>
	</div><!-- #secondary -->

<?php get_footer(); ?>