<?php
/**
 * Template Name: Our Mediators
 *
 * Description: Displays Biographical Info and a Profile Image when information is entered into the 'Your profile' section of the user admin panel. Should only be used on the 'Our Mediators' page.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

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


<?php  // display author image, name, and description
// Get the authors from the database ordered by user nicename
	global $wpdb;
	$query = "SELECT ID, user_nicename from $wpdb->users ORDER BY user_nicename";
	$author_ids = $wpdb->get_results($query);
// Loop through each author
	foreach($author_ids as $author) :
	// Get user data
		$curauth = get_userdata($author->ID);
		$authorID = $curauth->ID;
	// If user level is less than admin (10), display profile
		if($curauth->user_level < 10) :
?>

<section class="profile">
    <div class="profile-left"> 
         <?php if ( get_the_author_meta('image', $curauth->ID) != null){
			 echo '<img src="'.esc_attr(get_the_author_meta('image', $curauth->ID)).'" alt="'.$curauth->display_name.', Mediator at Able Mediation"/>';
		 }else{
			 echo '<img src="'.get_bloginfo('stylesheet_directory'). '/images/profile-default.png'.'" alt="no profile picture"/>';
		 }?>
    </div><!-- .profile-left -->
    <div class="profile-right">
    	<?php if ( $curauth->display_name ) 
			echo '<h2>'.$curauth->display_name.'</h2>';
			if ( $curauth->user_description ) :
			the_author_meta( description, $authorID);?>
    	<?php endif; ?>
    </div><!-- .profile-right -->
    <a class="button" title="Click to read more">Click to read more</a>  
</section><!-- .profile -->
 
<?php endif; ?>
<?php endforeach; ?>            

		</div><!-- #content -->
	</div><!-- #primary -->
    
    
    <?php // functions sidebar linked image
		$sidebarheading = get_the_block('Sidebar Image Heading', array(
		'type' => 'one-liner',
		'apply_filters' => false
		) );
		$sidebarimage = get_the_block('Sidebar Image (do not link the image)', array(
		'apply_filters' => false
		) ); 
		$sidebarcaption = get_the_block('<span class="greenspan">Sidebar Image Caption</span>', array(
		'type' => 'one-liner',
		'apply_filters' => false
		) );
		$sidebarlink = get_the_block('Sidebar Image Link (full url e.g. <span class="red">http://www.ablemediation.com/</span>)', array(
		'type' => 'one-liner',
		'apply_filters' => false
		) );
		$sidebarlinktitle = get_the_block('Sidebar Image Link Title (title tag displayed when image is hovered over)', array(
		'type' => 'one-liner',
		'apply_filters' => false
		) ); ?>
        
        
    <?php // Sidebar Image - start container
	    if ($sidebarimage != '')
		echo '<div id="secondary" class="widget-area" role="complementary">
			      <aside class="widget image-widget">'; ?>
                  
                  <?php // Heading
                      if ($sidebarheading != '')
					  echo '<h3 class="widget-title">'.html_entity_decode($sidebarheading).'</h3>';
					  // Image 
					  // a) box
					  if ($sidebarimage != '')
					  echo '<div class="box">';
					  	// b) wrapping link
					  	if ($sidebarlink != '')
					  	echo '<a href="'.html_entity_decode($sidebarlink).'" title="'.html_entity_decode($sidebarlinktitle).'">';
					  		// c) caption
					  		if ($sidebarcaption != '')
					  		echo '<h3 class="greenspan">'.html_entity_decode($sidebarcaption).'</h3>';
							// d) image
					  		echo html_entity_decode($sidebarimage); ?>
                      
                  	<?php // b) wrapping link
					  	if ($sidebarimage != '')
					  	echo '</div>';
						// a) box
					  if ($sidebarlink != '')
					  echo '</a>'; ?>


    <?php // Sidebar Image - end container
	    if ($sidebarimage != '')
		    echo '</aside><!-- .widget -->
		     </div><!-- #secondary -->'; ?>    
    

<?php get_footer(); ?>