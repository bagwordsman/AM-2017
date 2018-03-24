<?php
/**
 * The Template for displaying all single posts.
 *
 */

get_header(); ?>
<div id="content" role="main">

    <?php while ( have_posts() ) : the_post(); ?>

      <div class="hero">
            <?php
            $styling_options = get_option ( 'sandbox_theme_styling_options' );
            $heromesh = $styling_options['heromesh'];
            // hero image - post thumbnail (if set)
            if (has_post_thumbnail()) {
                the_post_thumbnail('full');
            // output default img from theme (if not set)
            } else {
                echo '<img src="'. get_bloginfo('stylesheet_directory'). '/img/default-hero/able-default-hero.jpg" alt="'.get_bloginfo('name').'"/>';
            }
            ?>
            <div <?php if ($heromesh) echo 'class="mesh"'; ?>>
                <div class="container">
                    <h1><?php the_title(); ?></h1>
                </div>
            </div>
            <span class="divider white"></span>
        </div><!-- hero -->


    <div class="container">
      <?php the_content(); ?>
    </div>

    <?php endwhile; ?>


    <!-- posts nav -->
    <?php
    // parameter set to 'false' to show all posts - not limited to category
    // doesn't work though
    $prevPost = get_previous_post(false);
    $nextPost = get_next_post(false);

    if($prevPost || $nextPost) {
      echo '
      <div class="nav-single">
          <div class="container">
              <h3 class="nav-single--title">Blog Post Navigation</h3>
          </div>';

      // previous post
      if($prevPost) {
          $args = array(
              'posts_per_page' => 1,
              'include' => $prevPost->ID
          );
          $prevPost = get_posts($args);
          foreach ($prevPost as $post) {
              setup_postdata($post);

          $post_thumbnail_id = get_post_thumbnail_id( $post );
          $img = wp_get_attachment_image_url( $post_thumbnail_id, $size );

          //echo '
          //<a '.( has_post_thumbnail() ? ('style="background-image:url(\'' . $img . '\');" ') : '').'class="nav-previous'.( has_post_thumbnail() ? (' has_thumb') : ' no_thumb').'" href="'. get_the_permalink() .'">
          //    <div class="container"><h3>'. get_the_title() .'</h3></div>
          //</a>

          if (has_post_thumbnail()) {
            echo '
            <div style="background-image:url(\'' . $img . '\');" class="nav-previous has_thumb">
                <a href="'. get_the_permalink() .'"><div class="assistive-text">'. get_the_title() .'</div></a>
                <div class="container"><h3>'. get_the_title() .'</h3></div>
            </div>
            ';
          } else {
            echo '
            <a href="'. get_the_permalink() .'" class="nav-previous no_thumb">
                <div class="container"><h3>'. get_the_title() .'</h3></div>
            </a>
            ';
          }

          wp_reset_postdata();

          } //end foreach
      } // end if


      // next post
      $nextPost = get_next_post(true);
      if($nextPost) {
          $args = array(
              'posts_per_page' => 1,
              'include' => $nextPost->ID
          );
          $nextPost = get_posts($args);
          foreach ($nextPost as $post) {
              setup_postdata($post);

          $post_thumbnail_id = get_post_thumbnail_id( $post );
          $img = wp_get_attachment_image_url( $post_thumbnail_id, $size );

          if (has_post_thumbnail()) {
            echo '
            <div style="background-image:url(\'' . $img . '\');" class="nav-next has_thumb">
                <a href="'. get_the_permalink() .'"><div class="assistive-text">'. get_the_title() .'</div></a>
                <div class="container"><h3>'. get_the_title() .'</h3></div>
            </div>
            ';
          } else {
            echo '
            <a href="'. get_the_permalink() .'" class="nav-next no_thumb">
                <div class="container"><h3>'. get_the_title() .'</h3></div>
            </a>
            ';
          }

          wp_reset_postdata();

          } //end foreach
      } // end if




      echo '</div><!-- container -->';
    }
    // end posts nav
    ?>

    <?php if( have_comments() ) : ?>
    <div class="container">
        <?php comments_template( '', true ); ?>
    </div><!-- container -->
    <?php endif; ?>


</div><!-- #content -->

<?php
// widgets just above the footer area
echo blog_widget_area();
?>

<?php get_footer(); ?>
