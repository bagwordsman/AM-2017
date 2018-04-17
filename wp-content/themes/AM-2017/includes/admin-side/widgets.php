<?php
// widgets

// File Contents:

// 1 - register widget areas (sidebars)
// a) blog - footer
// b) blog - sidebar
// c) cookies widget area - in header

// 2 - compose widgets
// a) blog - footer. Uses 'blog_widget_area()' to output on the front end
// b) blog - advert. Uses blog_advert(). NOT ACTUALLY A WIDGET.
// c) custom widget - cookies
// d) custom widget - blog posts with thumbnails


// _______________________________________________________
// 1 - register widget areas

// a) blog - footer
// note: before and after args don't seem to work on custom featured widget
if ( function_exists('register_sidebar') )
     register_sidebar( array(
    'name' => __( 'Blog - Footer'),
    'id' => 'blogpages',
    'description' => __( 'Widgets placed here will appear in the blog footer. Suitable for up to 3 widgets only.' ),
    'before_widget' => '<div class="four columns widget %2$s">',
    'after_widget' => '</div>',
    'before_title'  => '<h4>',
	'after_title'   => '</h4>'
) );

// b) blog - sidebar
if ( function_exists('register_sidebar') )
     register_sidebar( array(
    'name' => __( 'Blog - Sidebar'),
    'id' => 'blog_sidebar',
    'description' => __( 'Widgets placed here will appear in the blog sidebar' ),
    'before_widget' => '<div class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title'  => '<h4>',
	'after_title'   => '</h4>'
) );

// c) cookies widget area
if ( function_exists('register_sidebar') )
    register_sidebar( array(
	'name' => __( 'Cookies Notice'),
	'id' => 'cookies',
	'description' => __( 'Drag Google Analytics Cookies Notice here if running Google Analytics on your blog.' ),
	'before_widget' => '<div class="cookies"><div class="container">',
	'after_widget' => '</div></div>',
) );



// _______________________________________________________
// 2 - compose widgets

// a) blog - footer
function blog_widget_area() {
	$blog_options = get_option ( 'sandbox_theme_blog_options' );
	// title
	$widget_title = $blog_options['blog_widget_title'];
	$widget_align = $blog_options['blog_widget_title_align'];
	// background
	$widget_colour = $blog_options['blog_widget_bg_colour'];
	$widget_theme = $blog_options['blog_widget_theme'];
	$widget_image = $blog_options['blog_widget_bg_image'];
	$widget_image_opacity = $blog_options['blog_widget_bg_image_opacity'];
	// opacity for overlay (inverse of image)
	$widget_image_opacity = (int)$widget_image_opacity; // convert to integer
	$widget_image_opacity = (100 - $widget_image_opacity);

	// output on front end:
	if ( is_active_sidebar( 'blogpages' ) ) {
		echo '
		<div id="footer-widgets" role="complementary"'. ( $widget_image ? ( ' style="background-image:url('. $widget_image ) .')"' : '') . ( $widget_theme ? ( ' class="'. $widget_theme ) .'"' : '') .'>'.
			( $widget_title ? ( '<div class="container'. ( $widget_align != 'left' ? ( ' '. $widget_align )  : '') .'"><h3 class="blog-widgets--title">'. $widget_title .'</h3></div>' )  : '') .'
			<div class="container widgets">
				'; dynamic_sidebar( 'blogpages' ); echo'
			</div>
			'. ( $widget_colour ? ( '<div class="widget-overlay '. $widget_colour ) .'" '. ( $widget_image_opacity != 100 ? ( ' style="opacity:.'. $widget_image_opacity ) .';"' : '') .'></div>' : '') .'
		</div>
		';
	}

}



// b) blog advert
// note: this does not use widgets

// - this needs to work with wrapper-white and divider grey in the templates:
// - home.php, category.php, tag.php
// - can't isolate to here unfortunately. Variable '$ad_enabled' is used to manipulate the above templates
function blog_advert() {
	// in page ad
	// - best to put this in a function, perhaps in classes.php
	$ad_info = get_option ( 'sandbox_theme_blog_options' );
	$ad_title = $ad_info['blog_ad_text_title'];
	$ad_content = $ad_info['blog_ad_content'];
	// image
	$ad_img = $ad_info['blog_ad_img'];
	$ad_img_alt = $ad_info['blog_img_alt'];
	$ad_img_width = $ad_info['blog_img_width'];
	$ad_img_height = $ad_info['blog_img_height'];
	// button 1
	$btn_1 = $ad_info['blog_button_1_link'];
	$btn_1_txt = $ad_info['blog_btn_1_text'];
	$btn_1_color = $ad_info['blog_btn_1_colour'];
	// button 2
	$btn_2 = $ad_info['blog_button_2_link'];
	$btn_2_txt = $ad_info['blog_btn_2_text'];
	$btn_2_color = $ad_info['blog_btn_2_colour'];
	// checkbox
	$ad_enabled = $ad_info['blog_ad_check'];

	if ($ad_enabled) {
		echo '
		<div class="wrapper-grey">
			<div class="container container-narrow">
				<div class="page-advert">
					<div>
						<h3>' . $ad_title . '</h3>
						<p>' . $ad_content . '</p>
						<div class="button--container">
							<a class="button solid ' . $btn_1_color . '" href="' . $btn_1 . '">' . $btn_1_txt . '</a>
							<a class="button ' . $btn_2_color . '" href="' . $btn_2 . '">' . $btn_2_txt . '</a>
						</div>
					</div>
					<div>
						<img src="' . $ad_img . '" alt="' . $ad_img_alt . '" width="' . $ad_img_width . '" height="' . $ad_img_height . '"/>
					</div>
				</div>
			</div>
			<span class="divider white"></span>
		</div>';
	}
}



// c) cookies widget
class cookies_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
		'cookies_widget', // widget ID
		__('Google Analytics Cookies Notice', 'cookies_widget_domain'), // widget name
		array( 'description' => __( 'Add your Cookies Notice here', 'cookies_widget_domain' ), ) // description
		);
	}

	// cookie bar: front-end
	// - message switching is handled in main.js
	public function widget( $args, $instance ) {
		$content_lg = apply_filters( 'widget_contentlg', $instance['contentlg'] );
		$content_sm = apply_filters( 'widget_contentsm', $instance['contentsm'] );
		$link = apply_filters( 'widget_link', $instance['link'] );
		$linktext = apply_filters( 'widget_linktext', $instance['linktext'] );
		$hidetext = apply_filters( 'widget_hidetext', $instance['hidetext'] );

		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		// only output if the large content has been added:
		if ( ! empty( $content_lg ) )
			echo $args['before_content'] .'
			<div class="textwidget" data-small="'. $content_sm .'" data-big="'. $content_lg .'">
				<span>' . $content_lg .'</span>
				<a href="'. $link .'">'. $linktext .'</a>
				<div class="hide">'. $hidetext .'</div>
			</div>'.
			$args['after_content'];
		echo $args['after_widget'];
	} // end cookie bar


	// form: back end
	public function form( $instance ) {
		if ($instance) {
			$content_lg = esc_attr($instance[ 'contentlg' ]);
			$content_sm = esc_attr($instance[ 'contentsm' ]);
			$link = esc_attr($instance[ 'link' ]);
			$linktext = esc_attr($instance[ 'linktext' ]);
			$hidetext = esc_attr($instance[ 'hidetext' ]);
		} else {
			$content_lg = __( 'Cookie bar message: larger screens', 'cookies_widget_domain' );
			$content_sm = __( 'Cookie bar message: smaller screens', 'cookies_widget_domain' );
			$link = __( 'Add your privacy policy page link here', 'cookies_widget_domain' );
			$linktext = __( 'Add your link text here', 'cookies_widget_domain' );
			$hidetext = __( 'Hide button text', 'cookies_widget_domain' );
		}
		// cookies widget admin form
		?>
		<p>
			<!-- large -->
			<label for="<?php echo $this->get_field_id( 'contentlg' ); ?>"><?php _e( 'Content (larger screens):' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'contentlg' ); ?>" name="<?php echo $this->get_field_name( 'contentlg' ); ?>" type="text" value="<?php echo esc_attr( $content_lg ); ?>" />
			<!-- small -->
			<label for="<?php echo $this->get_field_id( 'contentsm' ); ?>"><?php _e( 'Content (smaller screens):' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'contentsm' ); ?>" name="<?php echo $this->get_field_name( 'contentsm' ); ?>" type="text" value="<?php echo esc_attr( $content_sm ); ?>" />
			<!-- link -->
			<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Link to Privacy Policy Page:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" />
			<!-- link text -->
			<label for="<?php echo $this->get_field_id( 'linktext' ); ?>"><?php _e( 'Link text:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'linktext' ); ?>" name="<?php echo $this->get_field_name( 'linktext' ); ?>" type="text" value="<?php echo esc_attr( $linktext ); ?>" />
			<!-- hide text -->
			<label for="<?php echo $this->get_field_id( 'hidetext' ); ?>"><?php _e( 'Hide button text:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'hidetext' ); ?>" name="<?php echo $this->get_field_name( 'hidetext' ); ?>" type="text" value="<?php echo esc_attr( $hidetext ); ?>" />
		</p>
	<?php
	}  // end form

	// update old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['contentlg'] = ( ! empty( $new_instance['contentlg'] ) ) ? strip_tags( $new_instance['contentlg'] ) : '';
		$instance['contentsm'] = ( ! empty( $new_instance['contentsm'] ) ) ? strip_tags( $new_instance['contentsm'] ) : '';
		$instance['link'] = ( ! empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';
		$instance['linktext'] = ( ! empty( $new_instance['linktext'] ) ) ? strip_tags( $new_instance['linktext'] ) : '';
		$instance['hidetext'] = ( ! empty( $new_instance['hidetext'] ) ) ? strip_tags( $new_instance['hidetext'] ) : '';
		return $instance;
	}
}
// register and load the widget
function analytics_load_widget() {
	register_widget( 'cookies_widget' );
}
add_action( 'widgets_init', 'analytics_load_widget' );












// d) custom widget - blog posts with thumbnails
class myposts_widget extends WP_Widget {
	
	function __construct() {
		parent::__construct(
		'myposts_widget', // widget ID
		__('Featured Post', 'myposts_widget_domain'), // widget name
		array( 'description' => __( 'Display Featured Post Thumbnails', 'myposts_widget_domain' ), ) // description
		);
	}
	
	
	// front end: output thumbnails
	public function widget( $args, $instance ) {
		$slug = apply_filters( 'widget_slug', $instance['slug'] );
		$colour = apply_filters( 'widget_colour', $instance['colour'] );

		// use the slug to retrieve post information
		$args = array(
			'name'        => $slug,
			'post_type'   => 'post',
			'post_status' => 'publish',
			'numberposts' => 1
		);
		$post_info = get_posts($args);
		$post_id = $post_info[0]->ID;
		
		// var_dump($post_info);

		$thumbImg = get_the_post_thumbnail($post_id, 'widget-thumbnail');
		$post_title = get_the_title($post_id);
		$post_link = get_the_permalink($post_id);

		$post_author = get_the_author($post_id);
    	$post_date = get_the_date('d / m / y', $post_id);


		// output the html
		// - before and after args don't seem to work
		if ( ! empty( $slug ) ) {

			echo $args['before_widget'] . $args['before_content'] . '
			<div class="four columns card'.($colour ? ' '.$colour : '').'">
				<a class="overlay" href="' . $post_link . '"><span class="hidden">' . $post_title . '</span></a>
				<div class="card-thumb">' . $thumbImg . '</div>
				<div class="card-content">
					<h4>' . $post_title . '</h4>
					<p>By
						<span class="author">'.$post_author.'</span> On '.$post_date.'.
						<span class="read-more faux">Read More ></span>
					</p>
				</div>
			</div>
			' . $args['after_content'] . $args['after_widget'];

		}



	}


	
	
	
	
	
	
	// back end: form
	public function form( $instance ) {
		if ($instance) {
			$slug = esc_attr($instance[ 'slug' ]);
			$colour = esc_attr($instance[ 'colour' ]);
		} else {
			$slug = __( 'Add post slug (found at bottom of post)', 'myposts_widget_domain' );
			$colour = __( 'Border colour', 'myposts_widget_domain' );
		}
		
		
		// output form
		// - colour callback (callbacks.php) won't work, section ID / name attr structured differently here
		?>
		<p>
			<!-- slug -->
			<label for="<?php echo $this->get_field_id( 'slug' ); ?>"><?php _e( 'Post slug:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'slug' ); ?>" name="<?php echo $this->get_field_name( 'slug' ); ?>" type="text" value="<?php echo esc_attr( $slug ); ?>" />
		</p>

		<?php
		// colour
		$field_id = $this->get_field_id( 'colour' );
		$field_name = $this->get_field_name( 'colour' );
		$chosen = esc_attr( $colour );

		echo '
		<p>
			<label for="'.$field_id.'">Post colour:</label>
		</p>
		<ul id="'.$field_id.'">
			<li>
				<input type="radio" id="green" name="'.$field_name.'" value="green" '. ( $chosen == 'green' ? (' checked="checked"')  : '') .'/>
				<label for="'.$field_id.'_green">Green</label>
			</li>
			<li>
				<input type="radio" id="orange" name="'.$field_name.'" value="orange" '. ( $chosen == 'orange' ? (' checked="checked"')  : '') .'/>
				<label for="'.$field_id.'_orange">Orange</label>
			</li>
			<li>
				<input type="radio" id="blue" name="'.$field_name.'" value="blue" '. ( $chosen == 'blue' ? (' checked="checked"')  : '') .'/>
				<label for="'.$field_id.'_blue">Blue</label>
			</li>
			<li>
				<input type="radio" id="red" name="'.$field_name.'" value="red" '. ( $chosen == 'red' ? (' checked="checked"')  : '') .'/>
				<label for="'.$field_id.'_red">Red</label>
			</li>
		</ul>
		';

	}  // end form

	// update old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['slug'] = ( ! empty( $new_instance['slug'] ) ) ? strip_tags( $new_instance['slug'] ) : '';
		$instance['colour'] = ( ! empty( $new_instance['colour'] ) ) ? strip_tags( $new_instance['colour'] ) : '';
		return $instance;
	}
} // end class



// register and load the widget
function posts_load_widget() {
	register_widget( 'myposts_widget' );
}
add_action( 'widgets_init', 'posts_load_widget' );






?>
