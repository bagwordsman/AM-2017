<?php
// single posts template
// - update the posts nav to look better

get_header(); ?>

<div id="content" role="main">

    <?php
    
    // _______________________________________________________
    // check to see that there is a post:
    while ( have_posts() ) : the_post();



    // ___________________________
    // post variables
    // the_post_thumbnail('full');
    if (has_post_thumbnail()) {
        $thumbImg = '<div class="thumb">'.get_the_post_thumbnail().'<span class="divider white"></span></div>';
    }
    else {
        $thumbImg = '';
    }
    // sidebar - classes.php
    $blog_sidebar = new blogSidebar('blog_sidebar');
    

    // author and date
    $author = get_the_author();
    $date = get_the_date('l, j F, Y');

    // show author and date - if checked
    $meta_enabled = get_option ( 'sandbox_theme_blog_options' )['single_meta_check'];

    // show tags - if checked
    $tag_enabled = get_option ( 'sandbox_theme_blog_options' )['single_tag_check'];
    // get tags
    $post_id = get_the_id();
    $post_tags = wp_get_post_tags($post_id);

    // global $post;
    $tag_slugs = wp_get_post_tags( $post_id, array( 'fields' => 'slugs' ) );
    $tag_names = wp_get_post_tags( $post_id, array( 'fields' => 'names' ) );

    $i = 0;
    foreach ($tag_names as $name) {
        // get posts per tag
        $term = get_term_by('slug', $tag_slugs[$i], 'post_tag');
        $tag_count = $term->count;
        $tag_count .= ' post';
        if ($tag_count > 1) {
            $tag_count .= 's';
        }
        // output tags
        $tags .= '<a class="tag" href="'. esc_url( home_url( '/' ) ) .'tag/'.$tag_slugs[$i].'">'.$name.' ('.$tag_count.')</a>';

        $i++; 
    }


    
    // ___________________________
    // output the post, followed by widget area
    // - css puts widget area on the left
    echo '
        <div class="container container--right pad-top">
            <div class="seven columns">
                '.$thumbImg.'
                <h1>'.get_the_title().'</h1>' .
                ($meta_enabled ? '
                <div class="post meta">
                    <div class="author">By: <span>' . $author . '</span></div>
                    <div class="date">On: ' . $date . '</div>
                </div>
                ' : '')
                . get_the_content() .
                ( ($tag_enabled) && $post_tags ? '
                <div class="post tags">
                    <div class="related">Related Topics:</div>
                    '.$tags.'
                </div>
                ' : '') . '
            </div>
            <div class="five columns">
                <h2>More from the Blog:</h2>';
                $blog_sidebar->add_sidebar();
                echo '
            </div>
        </div>';

    endwhile;




    
    
    // _________________________________________________________________________________
    // posts nav
    // - shows next and previous posts - by date, can't filter by category or tag
    // - uses same style as post pages nav

    // check if nav is enabled in theme settings
    $nav_enabled = get_option ( 'sandbox_theme_blog_options' )['single_nav_check'];

    // get prev and next posts
    $prevPost = get_previous_post();
    $nextPost = get_next_post();

    if ($prevPost || $nextPost) {

        // prev link
        if ($prevPost) {
            $args = array(
                'posts_per_page' => 1,
                'include' => $prevPost->ID
            );
            $prevPost = get_posts($args);
            foreach ($prevPost as $post) {
                setup_postdata($post);
                $prev = '<a class="prev page-numbers" href="'. get_the_permalink() .'">Previous Post</a>';
                wp_reset_postdata();
            }
        }

        // next link
        if ($nextPost) {
            $args = array(
                'posts_per_page' => 1,
                'include' => $nextPost->ID
            );
            $nextPost = get_posts($args);
            foreach ($nextPost as $post) {
                setup_postdata($post);
                $next = '<a class="next page-numbers" href="'. get_the_permalink() .'">Next Post</a>';
                wp_reset_postdata();
            }
        }

        // output the nav
        if ($nav_enabled) {
            echo '
            <div class="container">
                <nav role="navigation">
                    <h2 class="screen-reader-text">Single Post Navigation</h2>
                </nav>
                <div class="nav-links">
                    ' . $prev . '
                    <span class="page-numbers current">
                        <span class="meta-nav screen-reader-text">
                            ' . get_the_title() . '
                        </span>
                    </span>
                    ' . $next . '
                </div> 
            </div>';
        }
        
    }
    ?>







    <?php if ( have_comments() ) : ?>
    <div class="container">
        <?php //comments_template( '', true ); ?>
    </div><!-- container -->
    <?php endif; ?>









</div><!-- #content -->

<?php
// widgets just above the footer area
echo blog_widget_area();

get_footer(); ?>