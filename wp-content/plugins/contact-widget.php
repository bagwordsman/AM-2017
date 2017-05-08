<?php
/*
Plugin Name: Contact Form 7 Widget
Description: Displays Contact Form 7 with the shortcode id '158' in a widget which can be added to the sidebar of a page
Author: Martin Bagshaw
Version: 1
Author URI: http://martinbagshaw.co.uk/
*/
 
class Contact_Widget extends WP_Widget
{
  function Contact_Widget()
  {
    $widget_ops = array('classname' => 'Contact_Widget', 'description' => 'Displays Contact Form 7 with id ' ."'158'"  .' in the sidebar');
    $this->WP_Widget('Contact_Widget', 'Contact Form Widget', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args((array) $instance, array( 'title' => '' ));
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
 
    // Add Contact Form with id '158'
    echo do_shortcode( '[contact-form-7 id="158" title="Contact form 1"]' );
 
    echo $after_widget;
  }
}
add_action( 'widgets_init', create_function('', 'return register_widget("Contact_Widget");') );
 
?>