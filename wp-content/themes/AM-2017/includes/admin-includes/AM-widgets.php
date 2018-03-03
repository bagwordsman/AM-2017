<?php

// ------------------------------------------------------------------------
// Widgets
// a) register widgets - Blog Page Widgets, Cookies Notice, Header Opening Times,
// b) cookies widget


// a) register widgets
// blog page widget area - in footer
 if ( function_exists('register_sidebar') )
     register_sidebar( array(
    'name' => __( 'Blog Page Widgets'),
    'id' => 'blogpages',
    'description' => __( 'Drag Widget Here to appear on all Blog Pages' ),
    'before_widget' => '<div class="six columns widget %2$s">',
    'after_widget' => '</div>',
    'before_title'  => '<h4>',
	'after_title'   => '</h4>'
) );

// cookies widget area - in header
if ( function_exists('register_sidebar') )
    register_sidebar( array(
	'name' => __( 'Cookies Notice'),
	'id' => 'cookies',
	'description' => __( 'Drag Google Analytics Cookies Notice here if running Google Analytics on your blog.' ),
	'before_widget' => '<div class="cookies"><div class="container">',
	'after_widget' => '</div></div>',
) );











// b) cookies widget
class analytics_widget extends WP_Widget {

function __construct() {
	parent::__construct(
	// ID of your widget
	'analytics_widget',
	// Widget name will appear in UI
	__('Google Analytics Cookies Notice', 'analytics_widget_domain'),
	// Widget description
	array( 'description' => __( 'Add your Cookies Notice here', 'analytics_widget_domain' ), )
	);
}

// cookies widget front-end
public function widget( $args, $instance ) {
	$content = apply_filters( 'widget_content', $instance['content'] );
	$link = apply_filters( 'widget_link', $instance['link'] );
	$linktext = apply_filters( 'widget_linktext', $instance['linktext'] );
	$hidetext = apply_filters( 'widget_hidetext', $instance['hidetext'] );

	// before and after widget arguments are defined by themes
	echo $args['before_widget'];
		if ( ! empty( $content ) )
			echo $args['before_content'] .'
			<div class="textwidget">'. $content .'
				<a href="'. $link .'">'. $linktext .'</a>
				<div class="hide">'. $hidetext .'</div>
			</div>'.
			$args['after_content'];
		// This is where you run the code and display the output
	echo $args['after_widget'];
}


// cookies widget back-end
public function form( $instance ) {

	// NOTE: for some reason the final curly brace needs to be left off?
	if ($instance) {
		$content = esc_attr($instance[ 'content' ]);
		$link = esc_attr($instance[ 'link' ]);
		$linktext = esc_attr($instance[ 'linktext' ]);
		$hidetext = esc_attr($instance[ 'hidetext' ]);
	} else {
		$content = __( 'Add your cookies message here', 'analytics_widget_domain' );
		$link = __( 'Add your privacy policy page link here', 'analytics_widget_domain' );
		$linktext = __( 'Add your link text here', 'analytics_widget_domain' );
		$hidetext = __( 'Hide button text', 'analytics_widget_domain' );
	// }
}

// cookies widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'content' ); ?>"><?php _e( 'Content:' ); ?></label>
<textarea class="widefat" id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" cols="20" rows="5"><?php echo esc_attr( $content ); ?></textarea>
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
}

// cookies widget - updating old instances with new
public function update( $new_instance, $old_instance ) {
	$instance = array();
	$instance['content'] = ( ! empty( $new_instance['content'] ) ) ? strip_tags( $new_instance['content'] ) : '';
	$instance['link'] = ( ! empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';
	$instance['linktext'] = ( ! empty( $new_instance['linktext'] ) ) ? strip_tags( $new_instance['linktext'] ) : '';
	$instance['hidetext'] = ( ! empty( $new_instance['hidetext'] ) ) ? strip_tags( $new_instance['hidetext'] ) : '';
	return $instance;
}
} // Class analytics_widget ends here



// cookies widget - register and load the widget
function analytics_load_widget() {
	register_widget( 'analytics_widget' );
}
add_action( 'widgets_init', 'analytics_load_widget' );

?>
