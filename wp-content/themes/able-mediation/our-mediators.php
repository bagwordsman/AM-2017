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
	// If user level is less than admin (10), display profile
		if($curauth->user_level < 10) :
?>
<section class="profile">
    <div class="profile-left"> 
         <img src="<?php if ( get_the_author_meta('image', $curauth->ID) != null): ?>
         <?php echo esc_attr(get_the_author_meta('image', $curauth->ID)).'" alt=" Mediator at Able Mediation">' ?>
         <?php else: ?>
         <?php echo bloginfo('stylesheet_directory'). '/images/profile-default.png'.'" alt="no profile picture">' ?>
         <?php endif; ?> " />
    </div><!-- .profile-left -->
    <div class="profile-right">
    <?php if ( $curauth->display_name ) : ?>
        <h3><?php echo $curauth->display_name; ?></h3>
    <?php endif; ?>
    <?php if ( $curauth->user_description ) : ?>
        <?php
$authorID = $curauth->ID;
the_author_meta( description, $authorID);
	?>
    <?php endif; ?>
    </div><!-- .profile-right -->
    <button type="button" class="button" title="Click to read more">Click to read more</button>
    
</section><!-- .profile --> 
<?php endif; ?>
<?php endforeach; ?>            

		</div><!-- #content -->
	</div><!-- #primary -->
<div id="secondary" class="widget-area" role="complementary">
<?php 
 if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Our Mediators Page') ) : ?>
<?php endif;?>
</div><!-- #secondary -->
<?php get_footer(); ?>