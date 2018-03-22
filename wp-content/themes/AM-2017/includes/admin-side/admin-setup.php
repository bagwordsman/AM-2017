<?php
// admin setup
// - general settings across the whole theme added here


// allow user (with administrator role) to update theme options (i.e. company details)
// - stops 'Cheatin' uh? from displaying when logging into the dashboard as admin
function add_theme_caps() {
    $user = new WP_User( 2 );
	$user->add_cap( 'manage_options' );
}
add_action( 'admin_init', 'add_theme_caps');



// 2) redirect login for subscribers to /sample-page
// function redirect_subscriber_login() {
//     global $current_user;
//     get_currentuserinfo();
//     // If login user role is Subscriber
//     if ($current_user->user_level == 0){
//         wp_redirect( home_url('/sample-page') ); exit;
//     }
// }
// add_action('admin_init', 'redirect_subscriber_login');




// 3) add meta fields to media uploader for attachment pages
// - useful for image heavy websites, e.g. image attachment pages
function image_attachment_metadata( $form_fields, $post ) {
	$form_fields['meta-title'] = array(
		'label' => 'Meta Title',
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'meta_title', true ),
		'helps' => 'Display a title tag specific to the image',
	);
	$form_fields['meta-description'] = array(
		'label' => 'Meta Description',
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'meta_description', true ),
		'helps' => 'Display a meta description specific to the image',
	);
	$form_fields['meta-keywords'] = array(
		'label' => 'Meta Keywords',
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'meta_keywords', true ),
		'helps' => 'Display meta keywords specific to the image',
	);
	return $form_fields;
}
add_filter( 'attachment_fields_to_edit', 'image_attachment_metadata', 10, 2 );

/* Save metadata in media uploader */
function image_attachment_field_credit_save( $post, $attachment ) {
	if( isset( $attachment['meta-title'] ) )
		update_post_meta( $post['ID'], 'meta_title', $attachment['meta-title'] );
	if( isset( $attachment['meta-description'] ) )
		update_post_meta( $post['ID'], 'meta_description', $attachment['meta-description'] );
	if( isset( $attachment['meta-keywords'] ) )
		update_post_meta( $post['ID'], 'meta_keywords', $attachment['meta-keywords'] );
	return $post;
}

add_filter( 'attachment_fields_to_save', 'image_attachment_field_credit_save', 10, 2 );




// 4) webmaster credits at bottom of admin panel
function remove_footer_admin () {
echo 'Website Designed and Built by <a href="http://www.martinbagshaw.co.uk" target="_blank">Martin Bagshaw</a></p>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

?>
