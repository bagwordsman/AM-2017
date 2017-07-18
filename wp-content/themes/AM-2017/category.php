<?php
get_header(); ?>

<div id="content" role="main">


		<?php if ( have_posts() ) : ?>

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
									<h1><?php printf( __( 'Posts in the Category: %s', 'AM2017' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>
							</div>
					</div>
					<span class="divider white"></span>
		</div><!-- hero -->


		<?php $desc = category_description();
		if ($desc) {
			echo '
			<div class="container archive category no-top">
					'. $desc .'
			</div><!-- container -->
			';
		}


			// display the posts
			$marker = 1;
			while ( have_posts() ) : the_post(); ?>

            <div class="container postid-<?php the_ID() ?><?php if ($marker == 1 && $desc == '') {echo ' no-top';$marker = 0;}?>">

            	<?php if (has_post_thumbnail()) : ?>
            	<div class="four columns">
                	<?php the_post_thumbnail('thumbnail'); ?>
              </div><!-- four columns -->


              <div class="eight columns">
                	<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
									<!-- rel="bookmark" alt='<?php the_title() ?>' title='<?php the_title() ?>' -->
            		<?php the_excerpt(); ?>
              </div><!-- eight columns -->


              <?php else: ?>
                	<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
            	<?php the_excerpt(); ?>


							<?php endif; ?>

            </div><!-- container -->
			<?php endwhile;

			// number of posts per page - defined in settings > general
			$posts_per_page = get_option( 'posts_per_page' );
			$posts_per_page = (int)$posts_per_page;

			// number of posts in the category
			$category = get_the_category();
			$posts_in_category = $category[0]->category_count;
			$posts_in_category = (int)$posts_in_category;

			if ($posts_in_category > $posts_per_page == 'true') {

					echo '<div class="container">';
					// Previous/next page navigation.
					// doesn't work
					the_posts_pagination( array(
						'prev_text'          => __( 'Previous page', 'AM2017' ),
						'next_text'          => __( 'Next page', 'AM2017' ),
						'screen_reader_text' => __( 'Blog Post Navigation' ),
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'AM2017' ) . ' </span>',
					) );

					echo '</div><!-- container -->';

			}
			endif;
			?>

</div><!-- #content -->

<?php
// widgets just above the footer area
echo blog_widget_area();
?>

<?php get_footer(); ?>
