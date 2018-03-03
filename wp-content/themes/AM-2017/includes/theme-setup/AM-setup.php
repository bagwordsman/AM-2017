<?php

// ------------------------------------------------------------------------
// Menus, Post Formats, Post Thumnails, Page Markers, Blog




// 1) register menus, post formats, and post thumbnails, add post excerpt
function AM2017_setup() {

	// support a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );
	// register default menu and footer menu
	register_nav_menu( 'primary', __( 'Primary Menu', 'AM2017') );
	register_nav_menu('services-menu',__( 'Footer Services Menu', 'AM2017' ));
	register_nav_menu('quicklinks-menu',__( 'Footer Quick Links Menu', 'AM2017' ));
	// custom image size for featured images, displayed on "standard" posts
	add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
    add_post_type_support( 'page', 'excerpt' );
}
add_action( 'after_setup_theme', 'AM2017_setup' );






// 2) remove the default <div> and <ul> which wrap menus by default
// Primary Menu / primary
function wp_nav_menu_unwrap() {
    $options = array(
        'echo' => false,
        'container' => false,
        'theme_location' => 'primary',
        'fallback_cb'=> 'fall_back_menu'
    );

    $menu = wp_nav_menu($options);
    echo preg_replace(array(
        '#^<ul[^>]*>#',
        '#</ul>$#'
    ), '', $menu);
}
function fall_back_menu(){
    return;
}





// Footer Services Menu / services-menu
function wp_services_menu_unwrap() {
    $options = array(
        'echo' => false,
        'container' => false,
        'theme_location' => 'services-menu',
        'fallback_cb'=> 'fall_back_menu'
    );

    $menu = wp_nav_menu($options);
    echo preg_replace(array(
        '#^<ul[^>]*>#',
        '#</ul>$#'
    ), '', $menu);
}

// Footer Quick Links Menu / quicklinks-menu
function wp_quicklinks_menu_unwrap() {
    $options = array(
        'echo' => false,
        'container' => false,
        'theme_location' => 'quicklinks-menu',
        'fallback_cb'=> 'fall_back_menu'
    );

    $menu = wp_nav_menu($options);
    echo preg_replace(array(
        '#^<ul[^>]*>#',
        '#</ul>$#'
    ), '', $menu);
}






// 3) add current class to wp_list_pages()
// not used in menus, but this could be useful on the sitemap page
function my_page_css_class( $css_class, $page ) {
    global $post;
    if ( $post->ID == $page->ID ) {
        $css_class[] = 'current_page_item';
    }
    return $css_class;
}
add_filter( 'page_css_class', 'my_page_css_class', 10, 2 );





// 4) blog - set post excerpt length and add 'read more'
function custom_excerpt_length( $length ) {
	return 40;}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
      function new_excerpt_more( $more ) {
	return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '"> ...View Full Blog Post Here > </a>';}
add_filter( 'excerpt_more', 'new_excerpt_more' );




?>
