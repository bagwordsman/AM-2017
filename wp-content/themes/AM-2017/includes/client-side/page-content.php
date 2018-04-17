<?php
// repeated in page content
// - edit html here, rather than x number of times in page templates





// ––––––––––––––––––––––––––––––––––––––––––––––––––
// hero
function heroSection($hero_content, $hero_right, $hero_right_bg) {
    $heromesh = get_option ( 'sandbox_theme_styling_options' )['heromesh'];

    $heroImg = get_the_post_thumbnail(get_the_id(), 'full');
    $defaultImg = '<img src="'. get_bloginfo('stylesheet_directory'). '/img/default-hero/able-default-hero.jpg" alt="'.get_bloginfo('name').'"/>';
    
    // if hero_right is present, output extra content for the home page
    echo '
    <div class="hero-section">
        <div class="hero-image">
            '. ( $heroImg != '' ? $heroImg : $defaultImg ) .'
            <div'. ( $heromesh ? ' class="mesh"' : '') .'>
                <div class="container">
                    <h1>'.get_the_title().'</h1>
                </div>
            </div>
            <span class="divider white"></span>
        </div>
        '.( $hero_right ? '
        <div class="hero-content">
            <div class="container">
                <div class="seven columns" role="main">
                    '.$hero_content.'
                </div>
                <div class="five columns" role="complementary">
                    <div class="hero-sidebar'. ( $hero_right_bg !== 'transparent' ? ' '.$hero_right_bg : '' ) .'">
                        '.$hero_right.'
                    </div>
                </div>
            </div>
        </div>
        ' : '').'
    </div>
    ';

}






// ––––––––––––––––––––––––––––––––––––––––––––––––––
// end of page call to action (cta)
function pageCta() {
    // linked page
    $title = get_field('linked_page_header');
    $text = get_field('linked_page_text');
    $image = get_field('linked_page_image');
    $link = get_field('linked_page_link');
    $color = get_field('linked_page_colour');

    // new version:
    // - old version wrapped contents in an anchor tag
    // - lazyloading duplicated image
    // - see functionality.php

    if ($title && $link && $image) {
        echo '
        <div class="in-page-cta'. ( $color ? ( ' '. $color )  : '') .'">
            <a class="overlay" href="'.$link.'"><span class="hidden">'.$title.'</span></a>
            <div class="cta-title" style="background-image:url('.$image.');">
                <h3>'. $title .'</h3>
                <div class="divider"></div>
            </div>
            <div class="cta-text">
                '. ( $text ? $text  : 'View > ') .'
            </div>
        </div>
        ';
    }

}


?>