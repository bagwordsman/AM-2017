<?php
// setup

// File Contents:

// 1 - register post formats, menus, post thumbnails, set thumbnail size
// 2 - menus - modify html
// a) primary menu
// b) footer services menu
// c) footer quick links menu
// 3 - current class on wp_list_pages()



// _______________________________________________________
// 1) register post formats, menus, post thumbnails, set thumbnail size
function AM2017_setup() {

	// support a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );
	// register default menu and footer menu
	register_nav_menu( 'primary', __( 'Primary Menu', 'AM2017') );
	register_nav_menu('services-menu',__( 'Footer Services Menu', 'AM2017' ));
	register_nav_menu('quicklinks-menu',__( 'Footer Quick Links Menu', 'AM2017' ));
	// custom image size for featured images, displayed on "standard" posts
	add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 660, 9999 ); // unlimited height, soft crop. was at 624
    add_post_type_support( 'page', 'excerpt' );
}
add_action( 'after_setup_theme', 'AM2017_setup' );




// _______________________________________________________
// 2 - menus - modify html - remove the default <div> and <ul>

// a) primary menu
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

// b) footer services menu
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

// c) footer quick links menu
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




// _______________________________________________________
// 3 - current class on wp_list_pages()
// - not used in menus, but this could be useful on the sitemap page
function my_page_css_class( $css_class, $page ) {
    global $post;
    if ( $post->ID == $page->ID ) {
        $css_class[] = 'current_page_item';
    }
    return $css_class;
}
add_filter( 'page_css_class', 'my_page_css_class', 10, 2 );




// _______________________________________________________
// 4 - blog - set post excerpt length and add 'read more'
function custom_excerpt_length( $length ) {
    return 60;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
function new_excerpt_more( $more ) {
    return '...<br/> <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">Read More > </a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );




// _______________________________________________________
// 5 - custom excerpt lengths
function custom_read_more() {
    return '...<br/> <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">Read More > </a>';
}
function excerpt($limit) {
    return wp_trim_words(get_the_excerpt(), $limit, custom_read_more());
}

?>