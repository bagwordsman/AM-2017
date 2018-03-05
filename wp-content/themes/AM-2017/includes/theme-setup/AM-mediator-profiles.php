<?php

// ------------------------------------------------------------------------
// Mediator Profiles


// want to be able to invoke the load of load mediator profile through a shortcode in the text
// e.g. typing [Juliet Wilkinson] will load her profile


// Remove unneccessary fields from admin panel
add_filter('user_contactmethods','edit_profile_fields',10,1);
	function edit_profile_fields( $contactmethods ) {
	unset($contactmethods['aim']);
	unset($contactmethods['jabber']);
	unset($contactmethods['yim']);
	$contactmethods['title'] = 'Your Job Title';
	return $contactmethods;
}



// add WSIWYG editor for Mediator Profiles
class KLVisualBiographyEditor {
	private $name = 'Visual Biography Editor';

	/**
	 * Setup WP hooks
	 */
	public function __construct() {
		// Add a visual editor if the current user is an Author role or above and WordPress is v3.3+
		if ( function_exists('wp_editor') ) {

			// Add the WP_Editor
			add_action( 'show_user_profile', array($this, 'visual_editor') );
			add_action( 'edit_user_profile', array($this, 'visual_editor') );

			// Don't sanitize the data for display in a textarea
			add_action( 'admin_init', array($this, 'save_filters') );

			// Load required JS
			//add_action( 'admin_enqueue_scripts', array($this, 'load_javascript'), 10, 1 );

			// Add content filters to the output of the description
			add_filter( 'get_the_author_description', 'wptexturize' );
			add_filter( 'get_the_author_description', 'convert_chars' );
			add_filter( 'get_the_author_description', 'wpautop' );
		}
		// Display a message if the requires aren't met
		else {
			add_action( 'admin_notices', array($this, 'update_notice') );
		}
	}



	/**
	 *	Create Visual Editor - Add TinyMCE editor to replace the "Biographical Info" field in a user profile
	 */
	public function visual_editor( $user ) {

		// Contributor level user or higher required
		if ( !current_user_can('edit_posts') )
			return;
		?>
		<div class="profile-info">
			<table class="form-table">
					<tr>
						<th><label for="description"><?php _e('Biographical Info'); ?></label></th>
						<td>
							<?php
							$description = get_user_meta( $user->ID, 'description', true);
							wp_editor( $description, 'description' );
							?>
							<p class="description"><?php _e('Share a little biographical information to fill out your profile. This may be shown publicly.'); ?></p>
						</td>
					</tr>
			</table>
		</div>
		<?php
	}
	/**
	 * Remove textarea filters from description field
	 */
	public function save_filters() {
		// Contributor level user or higher required
		if ( !current_user_can('edit_posts') )
			return;
		remove_all_filters('pre_user_description');
	}
}
$kpl_visual_editor_biography = new KLVisualBiographyEditor();




// Mediator Profile Image
add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );
function my_show_extra_profile_fields( $user ) { ?>
<div class="profile-image">
		<h3>Mediator Profile</h3>
		<p class="shortcode-info">
			Copy and paste the following shortcode to add Your Mediator Profile into pages:<br>
			<span>[mediator-profile user_id=<?php echo $user->ID; ?>]</span>
		</p>
		<table class="form-table">
				<tr>
						<th><label for="image">Your Profile Image</label></th>
						<td>
						<div class="adminimage">
						<img src="<?php if ( get_the_author_meta('image', $user->ID) != null) {
							echo esc_attr(get_the_author_meta('image', $user->ID));
						} else {
							echo bloginfo('stylesheet_directory'). '/img/admin-img/able-default-profile.jpg';
						};?> "/>
						</div>
						</td>
				<tr>
				<tr>
						<td>
						</td>
						<td>
								<input type="text" name="image" id="image" value="<?php echo esc_attr( get_the_author_meta( 'image', $user->ID ) ); ?>" class="regular-text" /><input type='button' class="button-primary" value="Upload Image" id="uploadimage"/><br>
								<span class="description">Upload a square image from your computer or device.</span>
						</td>
				</tr>
				<!-- hidden text fields to capture the width and height of the image (for use on the front end) -->
				<!-- width -->
				<tr class="invisible">
						<td>
						</td>
						<td>
								<input type="text" name="imageWidth" id="imageWidth" value="<?php echo esc_attr( get_the_author_meta( 'imageWidth', $user->ID ) ); ?>" />
						</td>
				</tr>
				<!-- height -->
				<tr class="invisible">
						<td>
						</td>
						<td>
								<input type="text" name="imageHeight" id="imageHeight" value="<?php echo esc_attr( get_the_author_meta( 'imageHeight', $user->ID ) ); ?>" />
						</td>
				</tr>
		</table>
</div>


<?php }
function zkr_profile_upload_js() {
?>
<script type="text/javascript">
jQuery(document).ready(function() {

	// button click
	jQuery(document).find("input[id^='uploadimage']").live('click', function(){
	//var num = this.id.split('-')[1];
	formfield = jQuery('#image').attr('name');
	tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

		window.send_to_editor = function(html) {
			// get the url of mediator image
			imgurl = jQuery('img',html).attr('src');
			jQuery('#image').val(imgurl);

			// add width and height
			mediatorImgWidth = jQuery('img',html).width();
			mediatorImgHeight = jQuery('img',html).height();
			jQuery('#imageWidth').val(mediatorImgWidth);
			jQuery('#imageHeight').val(mediatorImgHeight);

			// remove thickbox
			tb_remove();
		}

		return false;
		});
});
</script>
<?php
}
add_action('admin_head','zkr_profile_upload_js');
// add media upload styles and scripts if the user is logged in
if (is_admin() && is_user_logged_in()) {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
}
add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {
	 if ( !current_user_can( 'edit_user', $user_id ) )
	return false;
	update_usermeta( $user_id, 'image', $_POST['image'] );
	update_usermeta( $user_id, 'imageWidth', $_POST['imageWidth'] );
	update_usermeta( $user_id, 'imageHeight', $_POST['imageHeight'] );
}






// Mediator Profile Shortcode
// need to make this based on name, and not ID somehow
add_shortcode('mediator-profile', 'user_meta_shortcode_handler');

function user_meta_shortcode_handler($atts, $content=null) {

		//$id = get_user_meta($atts['user_id'], $atts['meta']);

		// Get Mediator Info
		$image = esc_html(get_user_meta($atts['user_id'], 'image', true));
		$imageWidth = esc_html(get_user_meta($atts['user_id'], 'imageWidth', true));
		$imageHeight = esc_html(get_user_meta($atts['user_id'], 'imageHeight', true));
		$name = esc_html(get_user_meta($atts['user_id'], 'nickname', true));
		$title = esc_html(get_user_meta($atts['user_id'], 'title', true));
		$description = get_the_author_meta( description, $atts['user_id']);

		// Break description into 2 parts - read more button--container
		$read_more = explode('<!--more-->', $description);

		return '
		<div class="mediator-profile">
			<div>
				<img class="profile-pic" src="'. $image .'" alt="'. $name .'" width="'. $imageWidth .'" height="'. $imageHeight .'"/>
				<div class="name-card">
						<h3>'. $name .'</h3>
						<p>'. $title .'</p>
				</div>
			</div>' .
			( (count($read_more) === 1) ? ( $read_more[0] ) : '') .
			( (count($read_more) === 2) ? ( $read_more[0] . '<a class="button" href="#">Read Full Profile</a>' .
			'<div class="full-profile">' . $read_more[1] .'</div>') : '') .
		'</div>';
}
