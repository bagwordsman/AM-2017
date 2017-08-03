<?php
$themename = 'AM2017';

// ____________________________________________________________________________
// CONTENTS

// _____________________
// 1 - client side stuff


// add google fonts
// add IE google fonts for ie8 and below
// add stylesheets
// jQuery scripts on front end
// register menus, post formats, and post thumbnails
// remove the default <div> and <ul> which wrap menus by default
// add google maps to footer
// blog - set post excerpt length and add 'read more'
// add current class to wp_list_pages()
// mediator profiles section
// Mediator Profile Shortcode
// Google Map Shortcode
// Lazyloading



// ____________________
// 2 - admin side stuff

// add admin stylesheets
// add 2nd theme administrator
// redirect login for subscribers to /sample-page
// add meta fields to media uploader for attachment pages
// webmaster credits at bottom of admin panel
// register widgets - Blog Page Widgets, Cookies Notice, Header Opening Times,
// compose custom cookies widget
// compose custom opening times widget



// ____________________
// 3 - Create Theme Options Page
// 1) Company Options
// 2) logo Options
// 3) Social Options
// 4) Tweet
// 5) Styling Options
// 5) affiliates Options

// -------- In Page Options --------
// 1) Google Map of Location
// 2) Blog Styling






// ____________________________________________________________________________
// 1 - client side stuff
// ____________________________________________________________________________

// split site title




// add google fonts
function load_fonts() {
	wp_register_style('googleFonts', 'https://fonts.googleapis.com/css?family=Asap:400,400i,700,700i|Lato:300i,400');
	wp_enqueue_style( 'googleFonts');
}
add_action('wp_print_styles', 'load_fonts');

// add IE google fonts for ie8 and below
// individual loading stops faux italic and bold from displaying in ie8 and below
function ie_fonts() {
echo
"<!--[if lt IE 9]>
<link href='https://fonts.googleapis.com/css?family=Asap:400' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Asap:400i' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Asap:700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Asap:700i' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lato:300i' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lato:400' rel='stylesheet' type='text/css'>
<![endif]-->";
}
add_action('wp_head', 'ie_fonts');





// add stylesheets
// to be audited / redone with SASS
function load_css() {
	// ie css in header.php
	// style.css - required by theme
	wp_register_style('style', get_stylesheet_directory_uri() . '/style.css' );
	wp_enqueue_style( 'style');
	// skeleton.css - most styles
	wp_register_style('newskeleton', get_stylesheet_directory_uri() . '/css/skeleton.css' );
	wp_enqueue_style( 'newskeleton');
	// nav.css - better to separate out
	wp_register_style('oldnav', get_stylesheet_directory_uri() . '/css/nav.css' );
	wp_enqueue_style( 'oldnav');
	// font awesome icons - loaded from theme, not a CDN
	wp_register_style( 'fa-icons', get_stylesheet_directory_uri(). '/css/font-awesome.min.css' );
	wp_enqueue_style('fa-icons' );
	// add print css
	wp_register_style('print', get_stylesheet_directory_uri() . '/css/print/AM2017-print.css', false, false, 'print');
	wp_enqueue_style( 'print');
}
add_action('wp_enqueue_scripts', 'load_css');






// use a cdn to load jquery instead
function replace_jquery() {
    wp_deregister_script( 'jquery' );
    wp_enqueue_script( 'jquery', '//code.jquery.com/jquery-2.2.3.min.js', array(), '2.2.3' );
}
add_action( 'wp_enqueue_scripts', 'replace_jquery' );





// jQuery scripts on front end
function load_scripts() {
if (!is_admin()) {
	//  all pages and posts  //
	// i) jquery ui plugin - needed for scrolltop //
	wp_enqueue_script('jquery-ui', get_stylesheet_directory_uri(). '/js/lib/jquery-ui-1.10.3.custom.min.js', array('jquery'), '1.0', true );
	// ii)
	// cookies script for cookie bar, and learning page markers for visited page background images
	wp_enqueue_script('jquery-cookie', get_stylesheet_directory_uri(). '/js/lib/jquery.cookie.js', array('jquery'), '1.0', true  );
	// iii) main js (includes tooltip) //
	wp_enqueue_script('main', get_stylesheet_directory_uri(). '/js/main.js', array('jquery','jquery-ui','jquery-cookie'), '1.0', true  );

}
}  // end load scripts //
add_action('wp_enqueue_scripts', 'load_scripts');






// styles and scripts for Mediation Presentation
function mediation_animation() {
	if ( !is_admin() && is_page_template( 'page-templates/mediation-page.php' ) ) {

		// css
		wp_register_style('animation-css', get_stylesheet_directory_uri() . '/css/mediation-animation.css');
		wp_enqueue_style( 'animation-css');


		// - - - - - -
		// js

		// Greensock
		//wp_enqueue_script( 'Greensock', '//cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/jquery.gsap.min.js', array(), '1.20.2' );

		// Tween
		//wp_enqueue_script( 'Tween', '//cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/TimelineMax.min.js', array(), '1.20.2' );

		// ScrollMagic
		//wp_enqueue_script( 'ScrollMagic', '//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js', array(), '2.0.5' );
		//wp_enqueue_script( 'ScrollMagicIndicators', '//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.min.js', array(), '2.0.5' );


		// make stuff happen
		//wp_register_script('animation-js', get_stylesheet_directory_uri() . '/js/mediation-animation.js');
		//wp_enqueue_script( 'animation-js');





	} // end conditional


}  // end load scripts //
add_action('wp_enqueue_scripts', 'mediation_animation');










// register menus, post formats, and post thumbnails
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
}
add_action( 'after_setup_theme', 'AM2017_setup' );






// remove the default <div> and <ul> which wrap menus by default
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







// blog - set post excerpt length and add 'read more'
function custom_excerpt_length( $length ) {
	return 40;}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
      function new_excerpt_more( $more ) {
	return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '"> ...View Full Blog Post Here > </a>';}
add_filter( 'excerpt_more', 'new_excerpt_more' );








// add current class to wp_list_pages()
// not used in menus, but this could be useful on the sitemap page
function my_page_css_class( $css_class, $page ) {
    global $post;
    if ( $post->ID == $page->ID ) {
        $css_class[] = 'current_page_item';
    }
    return $css_class;
}
add_filter( 'page_css_class', 'my_page_css_class', 10, 2 );










// ______________________________________________________
// mediator profiles section
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
				<div class="profile-pic">
						<img src="'. $image .'" alt="'. $name .'" width="'. $imageWidth .'" height="'. $imageHeight .'"/>
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








// Google Map Shortcode
add_shortcode('google-map', 'google_map_shortcode_handler');

function google_map_shortcode_handler($atts, $content=null) {


		// get map information
    $gmaps_data = get_option ( 'sandbox_theme_map_options' );
    $api_key = $gmaps_data['gmap_api_key'];

		// scroll to zoom - assign option to variable here
		$map_height = $gmaps_data['gmap_height'];

		// scroll to zoom - assign option to variable here
    $scroll_to_zoom = $gmaps_data['gmap_scroll'];
		if ($scroll_to_zoom != 1) {
			$scroll_to_zoom = 'scrollwheel: false,';
		} else {
			$scroll_to_zoom = 'scrollwheel: true,';
		}

    // info box / window
		$infowindow_view = $gmaps_data['gmap_infowindow'];
		// a) include address - assign option to variable
    $infowindow_address = $gmaps_data['gmap_infowindow_address'];
		if ($infowindow_address == 1) {
			$infowindow_address = '<p class="infobox--text">\' + address + \'</p>';
		} else {
			$infowindow_address = '';
		}
		// b) include link to separate google map - assign option to variable
    $infowindow_link = $gmaps_data['gmap_infowindow_link'];
		if ($infowindow_link == 1) {
			$infowindow_link = '<p class="infobox--link"><a href="\' + url + \' target="_blank">View location in Google Maps</a></p>';
		} else {
			$infowindow_link = '';
		}



    // map or office locations
		$location_1_name = $gmaps_data['gmap_location_1_name'];
    $location_1_address = $gmaps_data['gmap_location_1_address'];

    $location_2_name = $gmaps_data['gmap_location_2_name'];
    $location_2_address = $gmaps_data['gmap_location_2_address'];

    $location_3_name = $gmaps_data['gmap_location_3_name'];
    $location_3_address = $gmaps_data['gmap_location_3_address'];

    $location_4_name = $gmaps_data['gmap_location_4_name'];
    $location_4_address = $gmaps_data['gmap_location_4_address'];


		// Output the Google Map
		return '
		<div id="able-map-content" style="height:'. $map_height .'px"></div>

    <script src="https://maps.googleapis.com/maps/api/js?key=' . $api_key . '" type="text/javascript"></script>

		<script>
		var locations = [
		  [\'' . $location_1_name . '\', \'' . $location_1_address . '\', \'' . 'http://maps.google.com/?q=' . $location_1_address . '\' ],
		  [\'' . $location_2_name . '\', \'' . $location_2_address . '\', \'' . 'http://maps.google.com/?q=' . $location_2_address . '\' ],
			[\'' . $location_3_name . '\', \'' . $location_3_address . '\', \'' . 'http://maps.google.com/?q=' . $location_3_address . '\' ],
			[\'' . $location_4_name . '\', \'' . $location_4_address . '\', \'' . 'http://maps.google.com/?q=' . $location_4_address . '\' ]
		];
		var geocoder;
		var map;
		var bounds = new google.maps.LatLngBounds();



		// initialise map
		// zoom and scroll
		function initialize() {
		  map = new google.maps.Map(
		    document.getElementById("able-map-content"), {
		      zoom: 13, // changing zoom has no effect with multiple locations
		      ' . $scroll_to_zoom . '
		      mapTypeId: google.maps.MapTypeId.ROADMAP
		    });
		  geocoder = new google.maps.Geocoder();

		  for (i = 0; i < locations.length; i++) {
		    geocodeAddress(locations, i);
		  }
		}
		google.maps.event.addDomListener(window, "load", initialize);



		// geocode locations from addresses
		function geocodeAddress(locations, i) {
		  var title = locations[i][0];
		  var address = locations[i][1];
		  var url = locations[i][2];
		  geocoder.geocode({
		      \'address\': locations[i][1]
		    },

		    function(results, status) {
		      if (status == google.maps.GeocoderStatus.OK) {
		        var marker = new google.maps.Marker({
		          map: map,
		          position: results[0].geometry.location,
		          title: title,
		          animation: google.maps.Animation.DROP,
		          address: address,
		          url: url
		        })
		        infoWindow(marker, map, title, address, url);
		        bounds.extend(marker.getPosition());
		        map.fitBounds(bounds);
		      } else {
		        alert("geocode of " + address + " failed:" + status);
		      }
		    });
		}



		// info window / box
		function infoWindow(marker, map, title, address, url) {

		  // view box on mouseover (hover), or click
		  google.maps.event.addListener(marker, "'. $infowindow_view .'", function() {
		    var html = \'<div class="gmap-infobox"><h3 class="infobox--title">\' + title + \'</h3>'. $infowindow_address . $infowindow_link .'</div>\';
		    iw = new google.maps.InfoWindow({
		      content: html,
		      maxWidth: 350
		    });

		    iw.open(map, marker);
		  });


		}




		function createMarker(results) {
		  var marker = new google.maps.Marker({
		    map: map,
		    position: results[0].geometry.location,
		    title: title,
		    animation: google.maps.Animation.DROP,
		    address: address,
		    url: url
		  })
		  bounds.extend(marker.getPosition());
		  map.fitBounds(bounds);
		  infoWindow(marker, map, title, address, url);
		  return marker;
		}

		</script>
		';
}


























// ____________________________________________________________________________
// 2 - admin side stuff
// mediator profiles section above combines the two sides
// ____________________________________________________________________________




// add admin stylesheets
function load_admin_css() {
	// jquery ui css - for sliders etc
	wp_register_style( 'jquery-ui-css', get_stylesheet_directory_uri(). '/css/admin/jquery-ui.min.css' );
	wp_enqueue_style( 'jquery-ui-css');
	// css for all admin pages
	wp_register_style( 'admin', get_stylesheet_directory_uri(). '/css/admin/admin.css' );
	wp_enqueue_style( 'admin');
	// font awesome icons - loaded from theme, not a CDN
	wp_register_style( 'fa-icons', get_stylesheet_directory_uri(). '/css/font-awesome.min.css' );
	wp_enqueue_style('fa-icons' );
	// google fonts - required if not installed on user's machine
	wp_register_style('googleFonts', 'https://fonts.googleapis.com/css?family=Asap:400,400i,700,700i|Lato:300i,400');
	wp_enqueue_style( 'googleFonts');
}
add_action( 'admin_enqueue_scripts', 'load_admin_css' );



// add admin scripts
function load_admin_js($hook) {

	// load jquery ui - required for sliders etc.
	wp_enqueue_script('jquery-ui-js', get_stylesheet_directory_uri(). '/js/admin/jquery-ui.min.js', false, false, true );

	//
	// remove default non WSIWYG editor for user profile
	if ( $hook == 'profile.php' || $hook == 'user-edit.php' ) {
		wp_enqueue_script('admin-profile-js', get_stylesheet_directory_uri(). '/js/admin/admin-profile.js', false, false, true );
	}

	// load js for page templates (pages created with ACF PLugin)
	wp_enqueue_script('admin-pages-js', get_stylesheet_directory_uri(). '/js/admin/admin-pages.js', false, false, true );

	// load js for Able Mediation Theme Settings
	wp_enqueue_script('admin-settings-js', get_stylesheet_directory_uri(). '/js/admin/admin-settings.js', false, false, true );

	// thickbox is also added after admin settings section. Search for 'thickbox' - perhaps is can be added here

}
add_action( 'admin_enqueue_scripts', 'load_admin_js' );





// add 2nd theme administrator
// allows the client (with administrator role) - always 2nd created user - to update theme options (i.e. company details)
// stops 'Cheatin' uh? from displaying
function add_theme_caps() {
    // gets the administrator role
    $user = new WP_User( 2 );
	$user->add_cap( 'manage_options' );
}
add_action( 'admin_init', 'add_theme_caps');










// redirect login for subscribers to /sample-page
function redirect_subscriber_login() {
    global $current_user;
    get_currentuserinfo();
    // If login user role is Subscriber
    if ($current_user->user_level == 0){
        wp_redirect( home_url('/sample-page') ); exit;
    }
}
add_action('admin_init', 'redirect_subscriber_login');












// add meta fields to media uploader for attachment pages
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









// webmaster credits at bottom of admin panel
function remove_footer_admin () {
echo 'Website Designed and Built by <a href="http://www.martinbagshaw.co.uk" target="_blank">Martin Bagshaw</a></p>';
}
add_filter('admin_footer_text', 'remove_footer_admin');








// register widgets
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











// compose custom cookies widget
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
	// before and after widget arguments are defined by themes
	echo $args['before_widget'];
		if ( ! empty( $content ) )
		echo $args['before_content'] .'
			<div class="textwidget">'. $content .' <a href="'. $link .'">Privacy and Cookie Policy Page</a> <div class="hide">Hide this notice ×</div></div>'.
			$args['after_content'];
		// This is where you run the code and display the output
	echo $args['after_widget'];
}


// cookies widget back-end
public function form( $instance ) {
	if ( isset( $instance[ 'content' ] ) ) {
	$content = $instance[ 'content' ];
	}
	else {
		$content = __( 'Add your cookies message here', 'analytics_widget_domain' );
	}
	if ( isset( $instance[ 'link' ] ) ) {
		$link = $instance[ 'link' ];
	}
	else {
	$link = __( 'Add your privacy policy page link here', 'analytics_widget_domain' );
}

// cookies widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'content' ); ?>"><?php _e( 'Content:' ); ?></label>
<textarea class="widefat" id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" cols="20" rows="5"><?php echo esc_attr( $content ); ?></textarea>
<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Link to Privacy Policy Page:' ); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" />
</p>
<?php
}

// cookies widget - updating old instances with new
public function update( $new_instance, $old_instance ) {
	$instance = array();
	$instance['content'] = ( ! empty( $new_instance['content'] ) ) ? strip_tags( $new_instance['content'] ) : '';
	$instance['link'] = ( ! empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';
return $instance;
}
} // Class analytics_widget ends here

// cookies widget - register and load the widget
function analytics_load_widget() {
	register_widget( 'analytics_widget' );
}
add_action( 'widgets_init', 'analytics_load_widget' );



















// ---------------------------- ---------------------------- ----------------------------
// 3 - Create Theme Options Page
// ---------------------------- ---------------------------- ----------------------------
// 1./ create page
function sandbox_create_menu_page() {
    add_menu_page(
        'Able Mediation Theme Options',          // The title to be displayed on the corresponding page for this menu
        'Able Mediation Theme Settings',                  // The text to be displayed for this actual menu item
        'manage_options',            // Which type of users can see this menu
        'sandbox',                  // The unique ID - that is, the slug - for this menu item
        'sandbox_menu_page_display',// The name of the function to call when rendering the menu for this page
        'dashicons-admin-tools'
    );
} // end sandbox_create_menu_page
add_action('admin_menu', 'sandbox_create_menu_page');

// ----------------------------
// 2./ render page contents
function sandbox_menu_page_display() {
?>
    <!-- Create a header in the default WordPress 'wrap' container -->
    <div class="wrap AM2017--options">
        <!-- Add the icon / header image to the page (could use company logo) -->
        <div id="icon-themes" class="icon32"></div>
        <h2>Able Mediation Theme Options</h2>
        <!-- Make a call to the WordPress function for rendering errors when settings are saved. -->
        <div class="in-header-and-footer">
						<?php settings_errors(); ?>
		        <!-- Create the forms that will be used to render our options -->
						<h1>Header and Footer Options</h1>
						<!-- 1 - company details -->
		        <form method="post" action="options.php" class="first wide">
		            <?php settings_fields( 'sandbox_theme_company_options' ); ?>
								<?php do_settings_sections( 'sandbox_theme_company_options' ); ?>
		            <?php submit_button('Save Changes to Company Details'); ?>
						</form>
						<!-- 2 - company logos -->
						<form method="post" action="options.php">
								<?php settings_fields( 'sandbox_theme_logo_options' ); ?>
								<?php do_settings_sections( 'sandbox_theme_logo_options' ); ?>
								<?php submit_button('Save Changes to Your Company Logos'); ?>
						</form>
						<!-- 3 - social network links -->
		        <form method="post" action="options.php">
		            <?php settings_fields( 'sandbox_theme_social_options' ); ?>
								<?php do_settings_sections( 'sandbox_theme_social_options' ); ?>
		            <?php submit_button('Save Changes to Social Options'); ?>
						</form>
						<!-- 4 - tweet -->
						<form method="post" action="options.php" class="wide tweet">
						    <?php settings_fields( 'sandbox_theme_tweet_options' ); ?>
						    <?php do_settings_sections( 'sandbox_theme_tweet_options' ); ?>
						    <?php submit_button('Embed Tweet'); ?>
						</form>
						<!-- 5 - affiliated organisations logos -->
		        <form method="post" action="options.php">
		            <?php settings_fields( 'sandbox_theme_affiliates_options' ); ?>
								<?php do_settings_sections( 'sandbox_theme_affiliates_options' ); ?>
		            <?php submit_button('Save Changes to Affiliated Organisations Logos'); ?>
						</form>
						<!-- 6 - styling options -->
						<form method="post" action="options.php" class="wide">
						    <?php settings_fields( 'sandbox_theme_styling_options' ); ?>
						    <?php do_settings_sections( 'sandbox_theme_styling_options' ); ?>
						    <?php submit_button('Save Changes to Your Styling Options'); ?>
						</form>
						<div class="divider white"></div>
				</div><!-- .in-header-and-footer -->

				<div class="in-page">
						<h1>In Page Options</h1>
						<!-- 1 - google map of location -->
						<form method="post" action="options.php" class="first wide">
						    <?php settings_fields( 'sandbox_theme_map_options' ); ?>
						    <?php do_settings_sections( 'sandbox_theme_map_options' ); ?>
						    <?php submit_button('Save Changes to Your Google Map'); ?>
						</form>
						<!-- 2 - blog styling -->
						<form method="post" action="options.php" class="wide">
						    <?php settings_fields( 'sandbox_theme_blog_options' ); ?>
						    <?php do_settings_sections( 'sandbox_theme_blog_options' ); ?>
						    <?php submit_button('Save Changes to Blog Styling'); ?>
						</form>
						<div class="divider mid-grey"></div>

				</div><!-- .in-page -->

				<div class="functionality">
						<h1>Functionality Options</h1>
						<!-- 1 - Google Analytics -->
						<form method="post" action="options.php" class="first wide google_analytics">
								<?php settings_fields( 'sandbox_theme_google_analytics_options' ); ?>
								<?php do_settings_sections( 'sandbox_theme_google_analytics_options' ); ?>
								<?php submit_button('Apply Google Analytics'); ?>
						</form>
						<!-- 2 - lazyloading of images -->
						<form method="post" action="options.php" class="wide lazyloading">
								<?php settings_fields( 'sandbox_theme_lazyloading_options' ); ?>
								<?php do_settings_sections( 'sandbox_theme_lazyloading_options' ); ?>
								<?php submit_button('Enable Lazyloading'); ?>
						</form>
				</div><!-- .functionality -->

    </div><!-- /.wrap -->
<?php
} // end sandbox_menu_page_display
add_filter('menu_options_filter','sandbox_menu_page_display');






// ------------------------------------------------------------------------
// 1) Company Options
// 2/ logo Options
// 3/ Social Options
// 4/ Tweet
// 5) Affiliated Companies Logos
// 6/ Styling Options

// ------------------------------------------------------------------------
// In Page Options
// 1) Google Map of Location
// 2) Blog Styling

// ------------------------------------------------------------------------
// Functionality Options
// 1/ Google Analytics Options
// 2/ Lazyloading Options




// ------------------------------------------------------------------------
// header and footer options
// ------------------------------------------------------------------------
// 1) Company Options
function sandbox_theme_intialize_company_options() {
	// If the company options don't exist, create them.
    if( false == get_option( 'sandbox_theme_company_options' ) ) {
        add_option( 'sandbox_theme_company_options' );
    } // end if

	add_settings_section(
    	'company_settings_section',          // ID used to identify this section and with which to register options
    	'Company Details',                   // Title to be displayed on the administration page
    	'sandbox_company_options_callback',  // Callback used to render the description of the section
    	'sandbox_theme_company_options'      // Page on which to add this section of options
	);
	add_settings_field(
    	'company_name',
    	'<i class="fa fa-tag" aria-hidden="true"></i>Company Name',
    	'sandbox_company_name_callback',
    	'sandbox_theme_company_options',
    	'company_settings_section'
	);
	add_settings_field(
    	'company_number',
    	'<i class="fa fa-hashtag" aria-hidden="true"></i>Company Number',
    	'sandbox_company_number_callback',
    	'sandbox_theme_company_options',
    	'company_settings_section'
	);
	add_settings_field(
    	'company_address',
    	'<i class="fa fa-home" aria-hidden="true"></i>Company Address',
    	'sandbox_company_address_callback',
    	'sandbox_theme_company_options',
    	'company_settings_section'
	);
	add_settings_field(
    	'company_phone',
    	'<i class="fa fa-phone" aria-hidden="true"></i>Company Phone',
    	'sandbox_company_phone_callback',
    	'sandbox_theme_company_options',
    	'company_settings_section'
	);
	add_settings_field(
    	'company_email',
    	'<i class="fa fa-envelope" aria-hidden="true"></i>Company Email',
    	'sandbox_company_email_callback',
    	'sandbox_theme_company_options',
    	'company_settings_section'
	);
	register_setting(
    	'sandbox_theme_company_options',
    	'sandbox_theme_company_options',
    	'sandbox_theme_sanitize_company_options'
	);
} // end sandbox_theme_intialize_company_options
add_action( 'admin_init', 'sandbox_theme_intialize_company_options' );



// use sanitize_text_field() to sanitise company options
function sandbox_theme_sanitize_company_options( $input ) {
    $output = array();
    foreach( $input as $key => $val ) {
        if( isset ( $input[$key] ) ) {
            $output[$key] = sanitize_text_field( $input[$key] );
        } // end if
    } // end foreach
    return apply_filters( 'sandbox_theme_sanitize_company_options', $output, $input );
} // end sandbox_theme_sanitize_company_options



// construct the company options form
function sandbox_company_options_callback() {
    echo '<p>Type in your company details</p>';
} // end sandbox_general_options_callback

function sandbox_company_name_callback() {
    $options = get_option( 'sandbox_theme_company_options' );
    if( isset( $options['company_name'] ) ) {
        $options['company_name'];
    } // end if
    // Render the output
    echo '<input type="text" id="company_name" name="sandbox_theme_company_options[company_name]" value="' . $options['company_name'] . '" />';
} // end sandbox_company_name_callback

function sandbox_company_number_callback() {
    $options = get_option( 'sandbox_theme_company_options' );
    if( isset( $options['company_number'] ) ) {
        $options['company_number'];
    } // end if
    // Render the output
    echo '<input type="text" id="company_number" name="sandbox_theme_company_options[company_number]" value="' . $options['company_number'] . '" />';
} // end sandbox_company_number_callback

function sandbox_company_address_callback() {
    $options = get_option( 'sandbox_theme_company_options' );
    if( isset( $options['company_address'] ) ) {
        $url = $options['company_address'];
    } // end if
    // Render the output
    echo '<input type="text" id="company_address" name="sandbox_theme_company_options[company_address]" value="' . $options['company_address'] . '" />';
} // end sandbox_company_address_callback

function sandbox_company_phone_callback() {
    $options = get_option( 'sandbox_theme_company_options' );
    if( isset( $options['company_phone'] ) ) {
        $url = $options['company_phone'];
    } // end if
    // Render the output
    echo '<input type="text" id="company_phone" name="sandbox_theme_company_options[company_phone]" value="' . $options['company_phone'] . '" />';
} // end sandbox_company_phone_callback

function sandbox_company_email_callback() {
    $options = get_option( 'sandbox_theme_company_options' );
    if( isset( $options['company_email'] ) ) {
        $url = $options['company_email'];
    } // end if
    // Render the output
    echo '<input type="text" id="company_email" name="sandbox_theme_company_options[company_email]" value="' . $options['company_email'] . '" />';
} // end sandbox_company_email_callback









// ------------------------------------------------------------------------
// 2/ logo Options
function sandbox_theme_intialize_logo_options() {
    // If the logo options don't exist, create them.
    if( false == get_option( 'sandbox_theme_logo_options' ) ) {
        add_option( 'sandbox_theme_logo_options' );
    } // end if
	add_settings_section(
    	'logo_settings_section',          // ID used to identify this section and with which to register options
    	'Company Logos',                   // Title to be displayed on the administration page
    	'sandbox_logo_options_callback',  // Callback used to render the description of the section
    	'sandbox_theme_logo_options'      // Page on which to add this section of options
	);
	add_settings_field(
    	'mainlogo',
    	'Main Logo',
    	'sandbox_mainlogo_callback',
    	'sandbox_theme_logo_options',
    	'logo_settings_section'
	);
	add_settings_field(
    	'MLwidth',
    	'',
    	'sandbox_MLwidth_callback',
    	'sandbox_theme_logo_options',
    	'logo_settings_section'
	);
	add_settings_field(
    	'MLheight',
    	'',
    	'sandbox_MLheight_callback',
    	'sandbox_theme_logo_options',
    	'logo_settings_section'
	);
	add_settings_field(
    	'appletouch',
    	'Apple Touch Icon<br><span class="extra-label">Square png:<br>180px, 110px, or 57px</span>',
    	'sandbox_appletouch_callback',
    	'sandbox_theme_logo_options',
    	'logo_settings_section'
	);
	add_settings_field(
    	'favicon',
    	'Favicon<br><span class="extra-label">Square png or ico:<br>32px, or 16px</span>',
    	'sandbox_favicon_callback',
    	'sandbox_theme_logo_options',
    	'logo_settings_section'
	);
	register_setting(
    	'sandbox_theme_logo_options',
    	'sandbox_theme_logo_options',
    	'sandbox_theme_sanitize_logo_options'
	);
} // end sandbox_theme_intialize_logo_options
add_action( 'admin_init', 'sandbox_theme_intialize_logo_options' );


// sanitise logo options - output urls
function sandbox_theme_sanitize_logo_options( $input ) {
    $output = array();
    foreach( $input as $key => $val ) {
        if( isset ( $input[$key] ) ) {
            $output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
        } // end if
    } // end foreach
    // Return the new collection
    return apply_filters( 'sandbox_theme_sanitize_logo_options', $output, $input );
} // end sandbox_theme_sanitize_logo_options


function sandbox_logo_options_callback() {
    echo '<p>Upload or add your logos with their URL location here</p>';
} // end sandbox_general_options_callback

function sandbox_mainlogo_callback() {
    $options = get_option( 'sandbox_theme_logo_options' );
    $url = '';
    if( isset( $options['mainlogo'] ) ) {
        $url = $options['mainlogo'];
    } // end if mainlogo is set
		echo
		'<div class="logogroup mainlogo">
			<img class="adminlogo mainlogo" src="'. get_bloginfo('stylesheet_directory'). '/img/able-logo.png"/>
			<input type="button" class="button button-primary" value="Upload Main Company Logo" id="uploadmainlogo"/>
			<label for="mainlogo">Logo Location - can also enter with URL</label>
			<input type="text" id="mainlogo" name="sandbox_theme_logo_options[mainlogo]" value="' . $options['mainlogo'] . '" />
		</div>';
} // end sandbox_mainlogo_callback

// pass width and height to be used on front end
// MLwidth
function sandbox_MLwidth_callback() {
    $options = get_option( 'sandbox_theme_logo_options' );
    $url = '';
    if( isset( $options['MLwidth'] ) ) {
        $url = $options['MLwidth'];
    } // end if MLwidth is set
		echo
		'<div class="logogroup MLwidth invisible">
			<input type="text" id="MLwidth" name="sandbox_theme_logo_options[MLwidth]" value="' . $options['MLwidth'] . '" />
		</div>';
} // end sandbox_MLwidth_callback

// MLheight
function sandbox_MLheight_callback() {
    $options = get_option( 'sandbox_theme_logo_options' );
    $url = '';
    if( isset( $options['MLheight'] ) ) {
        $url = $options['MLheight'];
    } // end if MLheight is set
		echo
		'<div class="logogroup MLheight invisible">
			<input type="text" id="MLheight" name="sandbox_theme_logo_options[MLheight]" value="' . $options['MLheight'] . '" />
		</div>';
} // end sandbox_MLheight_callback


function sandbox_appletouch_callback() {
    $options = get_option( 'sandbox_theme_logo_options' );
    $url = '';
    if( isset( $options['appletouch'] ) ) {
        $url = $options['appletouch'];
    } // end if appletouch is set
		echo
		'<div class="logogroup appletouch">
		  <img class="adminlogo appletouch" src="'. get_bloginfo('stylesheet_directory'). '/img/able-apple-touch-icon.jpg"/>
		  <input type="button" class="button button-primary" value="Upload Apple Touch Icon" id="uploadappletouch"/>
		  <label for="appletouch">Apple Touch Icon Location - can also enter with URL</label>
		  <input type="text" id="appletouch" name="sandbox_theme_logo_options[appletouch]" value="' . $options['appletouch'] . '" />
		</div>';
} // end sandbox_appletouch_callback

function sandbox_favicon_callback() {
    $options = get_option( 'sandbox_theme_logo_options' );
    $url = '';
    if( isset( $options['favicon'] ) ) {
        $url = $options['favicon'];
    } // end if
    // Render the output
    echo
		'<div class="logogroup favicon">
		  <img class="adminlogo favicon" src="'. get_bloginfo('stylesheet_directory'). '/img/able-favicon.jpg"/>
		  <input type="button" class="button button-primary" value="Upload Favicon" id="uploadfavicon"/>
		  <label for="favicon">Favicon Location - can also enter with URL</label>
		  <input type="text" id="favicon" name="sandbox_theme_logo_options[favicon]" value="' . $options['favicon'] . '" />
		</div>';
} // end sandbox_favicon_callback









// ------------------------------------------------------------------------
// 3/ Social Options
function sandbox_theme_intialize_social_options() {
    // If the social options don't exist, create them.
    if( false == get_option( 'sandbox_theme_social_options' ) ) {
        add_option( 'sandbox_theme_social_options' );
    } // end if
	add_settings_section(
    	'social_settings_section',          // ID used to identify this section and with which to register options
    	'Social Networks',                   // Title to be displayed on the administration page
    	'sandbox_social_options_callback',  // Callback used to render the description of the section
    	'sandbox_theme_social_options'      // Page on which to add this section of options
	);
	add_settings_field(
    	'facebook',
    	'<i class="fa fa-facebook" aria-hidden="true"></i>Facebook',
    	'sandbox_facebook_callback',
    	'sandbox_theme_social_options',
    	'social_settings_section'
	);
	add_settings_field(
			'twitter',
			'<i class="fa fa-twitter" aria-hidden="true"></i>Twitter',
			'sandbox_twitter_callback',
			'sandbox_theme_social_options',
			'social_settings_section'
	);
	add_settings_field(
    	'googleplus',
    	'<i class="fa fa-google-plus" aria-hidden="true"></i>Google+',
    	'sandbox_googleplus_callback',
    	'sandbox_theme_social_options',
    	'social_settings_section'
	);
	add_settings_field(
    	'linkedin',
    	'<i class="fa fa-linkedin" aria-hidden="true"></i>Linkedin',
    	'sandbox_linkedin_callback',
    	'sandbox_theme_social_options',
    	'social_settings_section'
	);
	register_setting(
    	'sandbox_theme_social_options',
    	'sandbox_theme_social_options',
    	'sandbox_theme_sanitize_social_options'
	);
} // end sandbox_theme_intialize_social_options
add_action( 'admin_init', 'sandbox_theme_intialize_social_options' );


// sanitise social options - output urls
function sandbox_theme_sanitize_social_options( $input ) {
    $output = array();
    foreach( $input as $key => $val ) {
        if( isset ( $input[$key] ) ) {
            $output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
        } // end if
    } // end foreach
    // Return the new collection
    return apply_filters( 'sandbox_theme_sanitize_social_options', $output, $input );
} // end sandbox_theme_sanitize_social_options


function sandbox_social_options_callback() {
    echo '<p>Provide the URLs to the social networks you\'d like to display.</p>';
} // end sandbox_general_options_callback

function sandbox_facebook_callback() {
    $options = get_option( 'sandbox_theme_social_options' );
    $url = '';
    if( isset( $options['facebook'] ) ) {
        $url = $options['facebook'];
    } // end if
    // Render the output
    echo '<input type="text" id="facebook" name="sandbox_theme_social_options[facebook]" value="' . $options['facebook'] . '" />';
} // end sandbox_facebook_callback

function sandbox_twitter_callback() {
    $options = get_option( 'sandbox_theme_social_options' );
    $url = '';
    if( isset( $options['twitter'] ) ) {
        $url = $options['twitter'];
    } // end if
    echo '<input type="text" id="twitter" name="sandbox_theme_social_options[twitter]" value="' . $options['twitter'] . '" />';
} // end sandbox_twitter_callback

function sandbox_googleplus_callback() {
    $options = get_option( 'sandbox_theme_social_options' );
    $url = '';
    if( isset( $options['googleplus'] ) ) {
        $url = $options['googleplus'];
    } // end if
    // Render the output
    echo '<input type="text" id="googleplus" name="sandbox_theme_social_options[googleplus]" value="' . $options['googleplus'] . '" />';
} // end sandbox_googleplus_callback

function sandbox_linkedin_callback() {
    $options = get_option( 'sandbox_theme_social_options' );
    $url = '';
    if( isset( $options['linkedin'] ) ) {
        $url = $options['linkedin'];
    } // end if
    // Render the output
    echo '<input type="text" id="linkedin" name="sandbox_theme_social_options[linkedin]" value="' . $options['linkedin'] . '" />';
} // end sandbox_linkedin_callback











// ------------------------------------------------------------------------
// 4/ Tweet
function sandbox_theme_intialize_tweet_options() {
    // If the tweet options don't exist, create them.
    if( false == get_option( 'sandbox_theme_tweet_options' ) ) {
        add_option( 'sandbox_theme_tweet_options' );
    } // end if
	add_settings_section(
    	'tweet_settings_section',          // ID used to identify this section and with which to register options
    	'Embed a Tweet <i class="fa fa-twitter" aria-hidden="true"></i>',                   // Title to be displayed on the administration page
    	'sandbox_tweet_options_callback',  // Callback used to render the description of the section
    	'sandbox_theme_tweet_options'      // Page on which to add this section of options
	);
	add_settings_field(
    	'embeddedtweetheading',
    	'<i class="fa fa-header black--text" aria-hidden="true"></i>Heading to introduce Tweet',
    	'sandbox_embeddedtweetheading_callback',
    	'sandbox_theme_tweet_options',
    	'tweet_settings_section'
	);
	add_settings_field(
    	'embeddedtweet',
    	'<i class="fa fa-link purple--text" aria-hidden="true"></i>Tweet URL / Link',
    	'sandbox_embeddedtweet_callback',
    	'sandbox_theme_tweet_options',
    	'tweet_settings_section'
	);
	add_settings_field(
    	'tweetcolour',
    	'<i class="fa fa-paint-brush" id="tweetcolour_scheme" aria-hidden="true"></i>Tweet Colour Scheme',
    	'sandbox_tweetcolour_callback',
    	'sandbox_theme_tweet_options',
    	'tweet_settings_section'
	);
	register_setting(
    	'sandbox_theme_tweet_options',
    	'sandbox_theme_tweet_options',
    	'sandbox_theme_sanitize_tweet_options'
	);
} // end sandbox_theme_intialize_tweet_options
add_action( 'admin_init', 'sandbox_theme_intialize_tweet_options' );

function sandbox_tweet_options_callback() {
    echo '<p>Copy and paste the URL / link to the Tweet you wish to embed here. This will display in the footer.</p>';
} // end sandbox_general_options_callback

function sandbox_embeddedtweetheading_callback() {
    $options = get_option( 'sandbox_theme_tweet_options' );
    $url = '';
    if( isset( $options['embeddedtweetheading'] ) ) {
        $url = $options['embeddedtweetheading'];
    } // end if
    // Render the output
    echo '<input type="text" id="embeddedtweetheading" name="sandbox_theme_tweet_options[embeddedtweetheading]" value="' . $options['embeddedtweetheading'] . '" />';
} // end sandbox_embeddedtweetheading_callback

function sandbox_embeddedtweet_callback() {
    $options = get_option( 'sandbox_theme_tweet_options' );
    $url = '';
    if( isset( $options['embeddedtweet'] ) ) {
        $url = $options['embeddedtweet'];
    } // end if
    // Render the output
    echo '<input type="text" id="embeddedtweet" name="sandbox_theme_tweet_options[embeddedtweet]" value="' . $options['embeddedtweet'] . '" />
		<i title="How do I find the URL / Link of the Tweet I want to Embed?" class="fa fa-question" aria-hidden="true"></i>
		<div class="embeddedtweet--info hidden">
		<img src="'. get_bloginfo('stylesheet_directory'). '/img/admin-img/tweet-copy-info.jpg"/>
		<p>Click the Drop Down arrow next to the Tweet to find the link to copy and paste into the above text field</p>
		</div>';
} // end sandbox_embeddedtweet_callback



// Tweet Colour Scheme
function sandbox_tweetcolour_callback() {
    $options = get_option( 'sandbox_theme_tweet_options' );
    if( isset( $options['tweetcolour'] ) ) {
        $options['tweetcolour'];
    } // end if
    // Render the output
    echo '
		<ul id="tweetcolour">
				<li>
				    <input type="radio" id="tweetcolour_green" name="sandbox_theme_tweet_options[tweetcolour]" value="70bf44" '. ( $options['tweetcolour'] == '70bf44' ? ('checked="checked" class="green--background"')  : '') .' />
				    <label for="tweetcolour_green">Green</label>
				</li>
				<li>
				    <input type="radio" id="tweetcolour_orange" name="sandbox_theme_tweet_options[tweetcolour]" value="f07f37" '. ( $options['tweetcolour'] == 'f07f37' ? ('checked="checked" class="green--background"')  : '') .' />
				    <label for="tweetcolour_orange">Orange</label>
				</li>
        <li>
            <input type="radio" id="tweetcolour_blue" name="sandbox_theme_tweet_options[tweetcolour]" value="339cff" '. ( $options['tweetcolour'] == '339cff' ? ('checked="checked" class="green--background"')  : '') .' />
            <label for="tweetcolour_blue">Blue</label>
        </li>
        <li>
            <input type="radio" id="tweetcolour_red" name="sandbox_theme_tweet_options[tweetcolour]" value="da291c" '. ( $options['tweetcolour'] == 'da291c' ? ('checked="checked" class="green--background"')  : '') .' />
            <label for="tweetcolour_red">Red</label>
        </li>
				<li>
				    <input type="radio" id="tweetcolour_dark-grey" name="sandbox_theme_tweet_options[tweetcolour]" value="6a6a6a" '. ( $options['tweetcolour'] == '6a6a6a' ? ('checked="checked" class="green--background"')  : '') .' />
				    <label for="tweetcolour_dark-grey">Dark Grey</label>
				</li>
		</ul>
		';
} // end sandbox_tweetcolour_callback










// ------------------------------------------------------------------------
// 5) Affiliated Companies Logos
// each affiliate logo needs width and height applied to it
function sandbox_theme_intialize_affiliates_options() {
    // If the affiliates options don't exist, create them.
    if( false == get_option( 'sandbox_theme_affiliates_options' ) ) {
        add_option( 'sandbox_theme_affiliates_options' );
    } // end if
	add_settings_section(
    	'affiliates_settings_section',          // ID used to identify this section and with which to register options
    	'Affiliated Organisations Logos',                   // Title to be displayed on the administration page
    	'sandbox_affiliates_options_callback',  // Callback used to render the description of the section
    	'sandbox_theme_affiliates_options'      // Page on which to add this section of options
	);
	// affiliates we stock title
	add_settings_field(
    	'ouraffiliatestitle',
    	'Affiliated Organisations Logos - Title',
    	'sandbox_ouraffiliatestitle_callback',
    	'sandbox_theme_affiliates_options',
    	'affiliates_settings_section'
	);

	// logo 1
	add_settings_field(
    	'affiliatelogo1',
    	'Affiliate Logo 1',
    	'sandbox_affiliatelogo1_callback',
    	'sandbox_theme_affiliates_options',
    	'affiliates_settings_section'
	);
	add_settings_field(
    	'AL1alttext',
    	'',
    	'sandbox_AL1alttext_callback',
    	'sandbox_theme_affiliates_options',
    	'affiliates_settings_section'
	);
	add_settings_field(
    	'AL1width',
    	'',
    	'sandbox_AL1width_callback',
    	'sandbox_theme_affiliates_options',
    	'affiliates_settings_section'
	);
	add_settings_field(
    	'AL1height',
    	'',
    	'sandbox_AL1height_callback',
    	'sandbox_theme_affiliates_options',
    	'affiliates_settings_section'
	);

	// logo 2
  add_settings_field(
      'affiliatelogo2',
      'Affiliate Logo 2',
      'sandbox_affiliatelogo2_callback',
      'sandbox_theme_affiliates_options',
      'affiliates_settings_section'
  );
	add_settings_field(
	    'AL2alttext',
	    '',
	    'sandbox_AL2alttext_callback',
	    'sandbox_theme_affiliates_options',
	    'affiliates_settings_section'
	);
  add_settings_field(
      'AL2width',
      '',
      'sandbox_AL2width_callback',
      'sandbox_theme_affiliates_options',
      'affiliates_settings_section'
  );
  add_settings_field(
      'AL2height',
      '',
      'sandbox_AL2height_callback',
      'sandbox_theme_affiliates_options',
      'affiliates_settings_section'
  );

  // logo 3
  add_settings_field(
      'affiliatelogo3',
      'Affiliate Logo 3',
      'sandbox_affiliatelogo3_callback',
      'sandbox_theme_affiliates_options',
      'affiliates_settings_section'
  );
	add_settings_field(
	    'AL3alttext',
	    '',
	    'sandbox_AL3alttext_callback',
	    'sandbox_theme_affiliates_options',
	    'affiliates_settings_section'
	);
  add_settings_field(
      'AL3width',
      '',
      'sandbox_AL3width_callback',
      'sandbox_theme_affiliates_options',
      'affiliates_settings_section'
  );
  add_settings_field(
      'AL3height',
      '',
      'sandbox_AL3height_callback',
      'sandbox_theme_affiliates_options',
      'affiliates_settings_section'
  );

	// logo 4
	add_settings_field(
	    'affiliatelogo4',
	    'Affiliate Logo 4',
	    'sandbox_affiliatelogo4_callback',
	    'sandbox_theme_affiliates_options',
	    'affiliates_settings_section'
	);
	add_settings_field(
	    'AL4alttext',
	    '',
	    'sandbox_AL4alttext_callback',
	    'sandbox_theme_affiliates_options',
	    'affiliates_settings_section'
	);
	add_settings_field(
	    'AL4width',
	    '',
	    'sandbox_AL4width_callback',
	    'sandbox_theme_affiliates_options',
	    'affiliates_settings_section'
	);
	add_settings_field(
	    'AL4height',
	    '',
	    'sandbox_AL4height_callback',
	    'sandbox_theme_affiliates_options',
	    'affiliates_settings_section'
	);

	// logo 5
	add_settings_field(
	    'affiliatelogo5',
	    'Affiliate Logo 5',
	    'sandbox_affiliatelogo5_callback',
	    'sandbox_theme_affiliates_options',
	    'affiliates_settings_section'
	);
	add_settings_field(
	    'AL5alttext',
	    '',
	    'sandbox_AL5alttext_callback',
	    'sandbox_theme_affiliates_options',
	    'affiliates_settings_section'
	);
	add_settings_field(
	    'AL5width',
	    '',
	    'sandbox_AL5width_callback',
	    'sandbox_theme_affiliates_options',
	    'affiliates_settings_section'
	);
	add_settings_field(
	    'AL5height',
	    '',
	    'sandbox_AL5height_callback',
	    'sandbox_theme_affiliates_options',
	    'affiliates_settings_section'
	);

	// logo 6
	add_settings_field(
	    'affiliatelogo6',
	    'Affiliate Logo 6',
	    'sandbox_affiliatelogo6_callback',
	    'sandbox_theme_affiliates_options',
	    'affiliates_settings_section'
	);
	add_settings_field(
	    'AL6alttext',
	    '',
	    'sandbox_AL6alttext_callback',
	    'sandbox_theme_affiliates_options',
	    'affiliates_settings_section'
	);
	add_settings_field(
	    'AL6width',
	    '',
	    'sandbox_AL6width_callback',
	    'sandbox_theme_affiliates_options',
	    'affiliates_settings_section'
	);
	add_settings_field(
	    'AL6height',
	    '',
	    'sandbox_AL6height_callback',
	    'sandbox_theme_affiliates_options',
	    'affiliates_settings_section'
	);

	register_setting(
    	'sandbox_theme_affiliates_options',
    	'sandbox_theme_affiliates_options',
    	'sandbox_theme_sanitize_affiliates_options'
	);
} // end sandbox_theme_intialize_affiliates_options
add_action( 'admin_init', 'sandbox_theme_intialize_affiliates_options' );


// sanitise affiliates options - output urls
function sandbox_theme_sanitize_affiliates_options( $input ) {
    $output = array();

		// loop over the affiliate logo section options
		foreach( $input as $key => $val ) {

				// the key must be set, in order to get sanitised and output
				if ( isset ( $input[$key] ) ) {

					// if the key is the title, sanitise it as a text field
					if ( $key == 'ouraffiliatestitle' ) {
							$output['ouraffiliatestitle'] = sanitize_text_field( $input['ouraffiliatestitle'] );
					// alternative text
					} elseif (strpos($key, 'alttext') !== false)  {
								$output[$key] = sanitize_text_field( $input[$key] );
					} else {
							// if the key is a path to a logo, sanitise it as a url
							$output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
					}

				} // end if
    } // end foreach
    // Return the new collection
    return apply_filters( 'sandbox_theme_sanitize_affiliates_options', $output, $input );
} // end sandbox_theme_sanitize_affiliates_options

function sandbox_affiliates_options_callback() {
    echo '<p>Upload Logos of your Affiliated Organisations, or add their URL location here.<br>
		<span class="red--text">Best to keep logos small, for example around <strong>200px wide</strong>.</span></p>';
} // end sandbox_general_options_callback





// title to introduce affiliate logos
function sandbox_ouraffiliatestitle_callback() {
    $options = get_option( 'sandbox_theme_affiliates_options' );
    $url = '';
    if( isset( $options['ouraffiliatestitle'] ) ) {
        $url = $options['ouraffiliatestitle'];
    } // end if
    // Render the output
    echo '<input type="text" id="ouraffiliatestitle" name="sandbox_theme_affiliates_options[ouraffiliatestitle]" value="' . $options['ouraffiliatestitle'] . '" />';
} // end sandbox_ouraffiliatestitle_callback




// compose affiliate Logos
//____________________
// Affiliate Logo 1
function sandbox_affiliatelogo1_callback() {
    $options = get_option( 'sandbox_theme_affiliates_options' );
    $url = '';
    if( isset( $options['affiliatelogo1'] ) ) {
        $url = $options['affiliatelogo1'];
    } // end if affiliatelogo1 is set
		echo
		'<div class="logogroup affiliatelogo1">
			<img class="adminlogo affiliatelogo1" src="'. get_bloginfo('stylesheet_directory'). '/img/admin-img/affiliate-logo-default.jpg"/>
			<input type="button" class="button button-primary" value="Upload Affiliate Logo 1" id="uploadaffiliatelogo1"/>
			<label for="affiliatelogo1">Logo Location - can also enter with URL</label>
			<input type="text" id="affiliatelogo1" name="sandbox_theme_affiliates_options[affiliatelogo1]" value="' . $options['affiliatelogo1'] . '" />
		</div>';
} // end sandbox_affiliatelogo1_callback

// add alternative text for best practice
// AL1alttext
function sandbox_AL1alttext_callback() {
    $options = get_option( 'sandbox_theme_affiliates_options' );
    $url = '';
    if( isset( $options['AL1alttext'] ) ) {
        $url = $options['AL1alttext'];
    } // end if AL1alttext is set
		echo
		'<div class="logogroup AL1alttext">
			<label for="AL1alttext">Alternative Text - describe the image for best practice</label>
			<input type="text" id="AL1alttext" name="sandbox_theme_affiliates_options[AL1alttext]" value="' . $options['AL1alttext'] . '" />
		</div>';
} // end sandbox_AL1alttext_callback


// pass width and height to be used on front end
// AL1width
function sandbox_AL1width_callback() {
    $options = get_option( 'sandbox_theme_affiliates_options' );
    $url = '';
    if( isset( $options['AL1width'] ) ) {
        $url = $options['AL1width'];
    } // end if AL1width is set
		echo
		'<div class="logogroup AL1width invisible">
			<input type="text" id="AL1width" name="sandbox_theme_affiliates_options[AL1width]" value="' . $options['AL1width'] . '" />
		</div>';
} // end sandbox_AL1width_callback

// AL1height
function sandbox_AL1height_callback() {
    $options = get_option( 'sandbox_theme_affiliates_options' );
    $url = '';
    if( isset( $options['AL1height'] ) ) {
        $url = $options['AL1height'];
    } // end if AL1height is set
		echo
		'<div class="logogroup AL1height invisible">
			<input type="text" id="AL1height" name="sandbox_theme_affiliates_options[AL1height]" value="' . $options['AL1height'] . '" />
		</div>';
} // end sandbox_AL1height_callback


// Affiliate Logo 2
function sandbox_affiliatelogo2_callback() {
    $options = get_option( 'sandbox_theme_affiliates_options' );
    $url = '';
    if( isset( $options['affiliatelogo2'] ) ) {
        $url = $options['affiliatelogo2'];
    } // end if affiliatelogo2 is set
		echo
		'<div class="logogroup affiliatelogo2">
			<img class="adminlogo affiliatelogo2" src="'. get_bloginfo('stylesheet_directory'). '/img/admin-img/affiliate-logo-default.jpg"/>
			<input type="button" class="button button-primary" value="Upload Affiliate Logo 2" id="uploadaffiliatelogo2"/>
			<label for="affiliatelogo2">Logo Location - can also enter with URL</label>
			<input type="text" id="affiliatelogo2" name="sandbox_theme_affiliates_options[affiliatelogo2]" value="' . $options['affiliatelogo2'] . '" />
		</div>';
} // end sandbox_affiliatelogo2_callback

// add alternative text for best practice
// AL2alttext
function sandbox_AL2alttext_callback() {
    $options = get_option( 'sandbox_theme_affiliates_options' );
    $url = '';
    if( isset( $options['AL2alttext'] ) ) {
        $url = $options['AL2alttext'];
    } // end if AL2alttext is set
		echo
		'<div class="logogroup AL2alttext">
			<label for="AL2alttext">Alternative Text - describe the image for best practice</label>
			<input type="text" id="AL2alttext" name="sandbox_theme_affiliates_options[AL2alttext]" value="' . $options['AL2alttext'] . '" />
		</div>';
} // end sandbox_AL2alttext_callback

// pass width and height to be used on front end
// AL2width
function sandbox_AL2width_callback() {
    $options = get_option( 'sandbox_theme_affiliates_options' );
    $url = '';
    if( isset( $options['AL2width'] ) ) {
        $url = $options['AL2width'];
    } // end if AL2width is set
		echo
		'<div class="logogroup AL2width invisible">
			<input type="text" id="AL2width" name="sandbox_theme_affiliates_options[AL2width]" value="' . $options['AL2width'] . '" />
		</div>';
} // end sandbox_AL2width_callback

// AL2height
function sandbox_AL2height_callback() {
    $options = get_option( 'sandbox_theme_affiliates_options' );
    $url = '';
    if( isset( $options['AL2height'] ) ) {
        $url = $options['AL2height'];
    } // end if AL2height is set
		echo
		'<div class="logogroup AL2height invisible">
			<input type="text" id="AL2height" name="sandbox_theme_affiliates_options[AL2height]" value="' . $options['AL2height'] . '" />
		</div>';
} // end sandbox_AL2height_callback


// Affiliate Logo 3
function sandbox_affiliatelogo3_callback() {
    $options = get_option( 'sandbox_theme_affiliates_options' );
    $url = '';
    if( isset( $options['affiliatelogo3'] ) ) {
        $url = $options['affiliatelogo3'];
    } // end if affiliatelogo3 is set
		echo
		'<div class="logogroup affiliatelogo3">
			<img class="adminlogo affiliatelogo3" src="'. get_bloginfo('stylesheet_directory'). '/img/admin-img/affiliate-logo-default.jpg"/>
			<input type="button" class="button button-primary" value="Upload Affiliate Logo 3" id="uploadaffiliatelogo3"/>
			<label for="affiliatelogo3">Logo Location - can also enter with URL</label>
			<input type="text" id="affiliatelogo3" name="sandbox_theme_affiliates_options[affiliatelogo3]" value="' . $options['affiliatelogo3'] . '" />
		</div>';
} // end sandbox_affiliatelogo3_callback

// add alternative text for best practice
// AL3alttext
function sandbox_AL3alttext_callback() {
    $options = get_option( 'sandbox_theme_affiliates_options' );
    $url = '';
    if( isset( $options['AL3alttext'] ) ) {
        $url = $options['AL3alttext'];
    } // end if AL3alttext is set
		echo
		'<div class="logogroup AL3alttext">
			<label for="AL3alttext">Alternative Text - describe the image for best practice</label>
			<input type="text" id="AL3alttext" name="sandbox_theme_affiliates_options[AL3alttext]" value="' . $options['AL3alttext'] . '" />
		</div>';
} // end sandbox_AL3alttext_callback

// pass width and height to be used on front end
// AL3width
function sandbox_AL3width_callback() {
    $options = get_option( 'sandbox_theme_affiliates_options' );
    $url = '';
    if( isset( $options['AL3width'] ) ) {
        $url = $options['AL3width'];
    } // end if AL3width is set
		echo
		'<div class="logogroup AL3width invisible">
			<input type="text" id="AL3width" name="sandbox_theme_affiliates_options[AL3width]" value="' . $options['AL3width'] . '" />
		</div>';
} // end sandbox_AL3width_callback

// AL3height
function sandbox_AL3height_callback() {
    $options = get_option( 'sandbox_theme_affiliates_options' );
    $url = '';
    if( isset( $options['AL3height'] ) ) {
        $url = $options['AL3height'];
    } // end if AL3height is set
		echo
		'<div class="logogroup AL3height invisible">
			<input type="text" id="AL3height" name="sandbox_theme_affiliates_options[AL3height]" value="' . $options['AL3height'] . '" />
		</div>';
} // end sandbox_AL3height_callback


// Affiliate Logo 4
function sandbox_affiliatelogo4_callback() {
    $options = get_option( 'sandbox_theme_affiliates_options' );
    $url = '';
    if( isset( $options['affiliatelogo4'] ) ) {
        $url = $options['affiliatelogo4'];
    } // end if affiliatelogo4 is set
		echo
		'<div class="logogroup affiliatelogo4">
			<img class="adminlogo affiliatelogo4" src="'. get_bloginfo('stylesheet_directory'). '/img/admin-img/affiliate-logo-default.jpg"/>
			<input type="button" class="button button-primary" value="Upload Affiliate Logo 4" id="uploadaffiliatelogo4"/>
			<label for="affiliatelogo4">Logo Location - can also enter with URL</label>
			<input type="text" id="affiliatelogo4" name="sandbox_theme_affiliates_options[affiliatelogo4]" value="' . $options['affiliatelogo4'] . '" />
		</div>';
} // end sandbox_affiliatelogo4_callback

// add alternative text for best practice
// AL4alttext
function sandbox_AL4alttext_callback() {
    $options = get_option( 'sandbox_theme_affiliates_options' );
    $url = '';
    if( isset( $options['AL4alttext'] ) ) {
        $url = $options['AL4alttext'];
    } // end if AL4alttext is set
		echo
		'<div class="logogroup AL4alttext">
			<label for="AL4alttext">Alternative Text - describe the image for best practice</label>
			<input type="text" id="AL4alttext" name="sandbox_theme_affiliates_options[AL4alttext]" value="' . $options['AL4alttext'] . '" />
		</div>';
} // end sandbox_AL4alttext_callback

// pass width and height to be used on front end
// AL4width
function sandbox_AL4width_callback() {
    $options = get_option( 'sandbox_theme_affiliates_options' );
    $url = '';
    if( isset( $options['AL4width'] ) ) {
        $url = $options['AL4width'];
    } // end if AL4width is set
		echo
		'<div class="logogroup AL4width invisible">
			<input type="text" id="AL4width" name="sandbox_theme_affiliates_options[AL4width]" value="' . $options['AL4width'] . '" />
		</div>';
} // end sandbox_AL4width_callback

// AL4height
function sandbox_AL4height_callback() {
    $options = get_option( 'sandbox_theme_affiliates_options' );
    $url = '';
    if( isset( $options['AL4height'] ) ) {
        $url = $options['AL4height'];
    } // end if AL4height is set
		echo
		'<div class="logogroup AL4height invisible">
			<input type="text" id="AL4height" name="sandbox_theme_affiliates_options[AL4height]" value="' . $options['AL4height'] . '" />
		</div>';
} // end sandbox_AL4height_callback



// Affiliate Logo 5
function sandbox_affiliatelogo5_callback() {
    $options = get_option( 'sandbox_theme_affiliates_options' );
    $url = '';
    if( isset( $options['affiliatelogo5'] ) ) {
        $url = $options['affiliatelogo5'];
    } // end if affiliatelogo5 is set
		echo
		'<div class="logogroup affiliatelogo5">
			<img class="adminlogo affiliatelogo5" src="'. get_bloginfo('stylesheet_directory'). '/img/admin-img/affiliate-logo-default.jpg"/>
			<input type="button" class="button button-primary" value="Upload Affiliate Logo 5" id="uploadaffiliatelogo5"/>
			<label for="affiliatelogo5">Logo Location - can also enter with URL</label>
			<input type="text" id="affiliatelogo5" name="sandbox_theme_affiliates_options[affiliatelogo5]" value="' . $options['affiliatelogo5'] . '" />
		</div>';
} // end sandbox_affiliatelogo5_callback

// add alternative text for best practice
// AL5alttext
function sandbox_AL5alttext_callback() {
    $options = get_option( 'sandbox_theme_affiliates_options' );
    $url = '';
    if( isset( $options['AL5alttext'] ) ) {
        $url = $options['AL5alttext'];
    } // end if AL5alttext is set
		echo
		'<div class="logogroup AL5alttext">
			<label for="AL5alttext">Alternative Text - describe the image for best practice</label>
			<input type="text" id="AL5alttext" name="sandbox_theme_affiliates_options[AL5alttext]" value="' . $options['AL5alttext'] . '" />
		</div>';
} // end sandbox_AL5alttext_callback

// pass width and height to be used on front end
// AL5width
function sandbox_AL5width_callback() {
    $options = get_option( 'sandbox_theme_affiliates_options' );
    $url = '';
    if( isset( $options['AL5width'] ) ) {
        $url = $options['AL5width'];
    } // end if AL5width is set
		echo
		'<div class="logogroup AL5width invisible">
			<input type="text" id="AL5width" name="sandbox_theme_affiliates_options[AL5width]" value="' . $options['AL5width'] . '" />
		</div>';
} // end sandbox_AL5width_callback

// AL5height
function sandbox_AL5height_callback() {
    $options = get_option( 'sandbox_theme_affiliates_options' );
    $url = '';
    if( isset( $options['AL5height'] ) ) {
        $url = $options['AL5height'];
    } // end if AL5height is set
		echo
		'<div class="logogroup AL5height invisible">
			<input type="text" id="AL5height" name="sandbox_theme_affiliates_options[AL5height]" value="' . $options['AL5height'] . '" />
		</div>';
} // end sandbox_AL5height_callback



// Affiliate Logo 6
function sandbox_affiliatelogo6_callback() {
    $options = get_option( 'sandbox_theme_affiliates_options' );
    $url = '';
    if( isset( $options['affiliatelogo6'] ) ) {
        $url = $options['affiliatelogo6'];
    } // end if affiliatelogo6 is set
		echo
		'<div class="logogroup affiliatelogo6">
			<img class="adminlogo affiliatelogo6" src="'. get_bloginfo('stylesheet_directory'). '/img/admin-img/affiliate-logo-default.jpg"/>
			<input type="button" class="button button-primary" value="Upload Affiliate Logo 6" id="uploadaffiliatelogo6"/>
			<label for="affiliatelogo6">Logo Location - can also enter with URL</label>
			<input type="text" id="affiliatelogo6" name="sandbox_theme_affiliates_options[affiliatelogo6]" value="' . $options['affiliatelogo6'] . '" />
		</div>';
} // end sandbox_affiliatelogo6_callback

// add alternative text for best practice
// AL6alttext
function sandbox_AL6alttext_callback() {
    $options = get_option( 'sandbox_theme_affiliates_options' );
    $url = '';
    if( isset( $options['AL6alttext'] ) ) {
        $url = $options['AL6alttext'];
    } // end if AL6alttext is set
		echo
		'<div class="logogroup AL6alttext">
			<label for="AL6alttext">Alternative Text - describe the image for best practice</label>
			<input type="text" id="AL6alttext" name="sandbox_theme_affiliates_options[AL6alttext]" value="' . $options['AL6alttext'] . '" />
		</div>';
} // end sandbox_AL6alttext_callback

// pass width and height to be used on front end
// AL6width
function sandbox_AL6width_callback() {
    $options = get_option( 'sandbox_theme_affiliates_options' );
    $url = '';
    if( isset( $options['AL6width'] ) ) {
        $url = $options['AL6width'];
    } // end if AL6width is set
		echo
		'<div class="logogroup AL6width invisible">
			<input type="text" id="AL6width" name="sandbox_theme_affiliates_options[AL6width]" value="' . $options['AL6width'] . '" />
		</div>';
} // end sandbox_AL6width_callback

// AL6height
function sandbox_AL6height_callback() {
    $options = get_option( 'sandbox_theme_affiliates_options' );
    $url = '';
    if( isset( $options['AL6height'] ) ) {
        $url = $options['AL6height'];
    } // end if AL6height is set
		echo
		'<div class="logogroup AL6height invisible">
			<input type="text" id="AL6height" name="sandbox_theme_affiliates_options[AL6height]" value="' . $options['AL6height'] . '" />
		</div>';
} // end sandbox_AL6height_callback













// ------------------------------------------------------------------------
// 6/ Styling Options
function sandbox_theme_intialize_styling_options() {
    // If the styling options don't exist, create them.
    if( false == get_option( 'sandbox_theme_styling_options' ) ) {
        add_option( 'sandbox_theme_styling_options' );
    } // end if
	add_settings_section(
    	'styling_settings_section',          // ID used to identify this section and with which to register options
    	'Styling Options',                   // Title to be displayed on the administration page
    	'sandbox_styling_options_callback',  // Callback used to render the description of the section
    	'sandbox_theme_styling_options'      // Page on which to add this section of options
	);
	add_settings_field(
    	'heromesh',
    	'<i class="fa fa-table" aria-hidden="true"></i>Header Hero Mesh',
    	'sandbox_heromesh_callback',
    	'sandbox_theme_styling_options',
    	'styling_settings_section'
	);
  add_settings_field(
    	'footerhero',
    	'<i class="fa fa-picture-o" aria-hidden="true"></i>Footer Hero Image',
    	'sandbox_footerhero_callback',
    	'sandbox_theme_styling_options',
    	'styling_settings_section'
	);
	register_setting(
    	'sandbox_theme_styling_options',
    	'sandbox_theme_styling_options',
    	'sandbox_theme_sanitize_styling_options'
	);
} // end sandbox_theme_intialize_styling_options
add_action( 'admin_init', 'sandbox_theme_intialize_styling_options' );

// sanitise styling options
function sandbox_theme_sanitize_styling_options( $input ) {
    $output = array();

    // loop over the affiliate logo section options
    foreach( $input as $key => $val ) {
        // the key must be set, in order to get sanitised and output
        // styling options sanitised as checkboxes
        //if( isset ( $input[$key] ) ) {
            //$output[$key] = filter_var( $input[$key], FILTER_SANITIZE_NUMBER_INT );
        //}
				if ( $key == 'heromesh' or $key == 'footerhero' ) {
						$output[$key] = filter_var( $input[$key], FILTER_SANITIZE_NUMBER_INT );
				} // end if
    } // end foreach

    return apply_filters( 'sandbox_theme_sanitize_styling_options', $output, $input );
} // end sandbox_theme_sanitize_styling_options

// construct the styling options form
function sandbox_styling_options_callback() {
    echo '<p>Choose Styling Options for the Hero and Footer</p>';
} // end sandbox_styling_options_callback

// heromesh checkbox
function sandbox_heromesh_callback() {
    $options = get_option( 'sandbox_theme_styling_options' );
    if( isset( $options['heromesh'] ) ) {
        $options['heromesh'];
    } // end if
    // Render the output
    echo '<input type="checkbox" id="heromesh" name="sandbox_theme_styling_options[heromesh]" value="1" ' . checked( 1, isset( $options['heromesh'] ) ? $options['heromesh'] : 0, false ) . ' />';
} // end sandbox_heromesh_callback

// footerhero checkbox
function sandbox_footerhero_callback() {
    $options = get_option( 'sandbox_theme_styling_options' );
    if( isset( $options['footerhero'] ) ) {
        $options['footerhero'];
    } // end if
    // Render the output
    echo '<input type="checkbox" id="footerhero" name="sandbox_theme_styling_options[footerhero]" value="1" ' . checked( 1, isset( $options['footerhero'] ) ? $options['footerhero'] : 0, false ) . ' />';
} // end sandbox_footerhero_callback













// ------------------------------------------------------------------------
// In Page Options
// ------------------------------------------------------------------------



// ------------------------------------------------------------------------
// 1) Google Map of Location
function sandbox_theme_intialize_map_options() {
	// If the google map options don't exist, create them.
    if( false == get_option( 'sandbox_theme_map_options' ) ) {
        add_option( 'sandbox_theme_map_options' );
    } // end if

	add_settings_section(
    	'map_settings_section',          // ID used to identify this section and with which to register options
    	'Display a Google Map of your Location',                   // Title to be displayed on the administration page
    	'sandbox_map_options_callback',  // Callback used to render the description of the section
    	'sandbox_theme_map_options'      // Page on which to add this section of options
	);
	add_settings_field(
    	'gmap_api_key',
    	'<h4>General Settings for Map</h4>
			<i class="fa fa-key" aria-hidden="true"></i>Google Maps API Key',
    	'sandbox_gmap_api_callback',
    	'sandbox_theme_map_options',
    	'map_settings_section'
	);
	// hide this - it does not work on maps with multiple markers
	// test with a single marker - and get it working with this
	//add_settings_field(
    	//'gmap_zoom_level',
    	//'<i class="fa fa-binoculars" aria-hidden="true"></i>Zoom Level',
    	//'sandbox_gmap_zoom_level_callback',
    	//'sandbox_theme_map_options',
    	//'map_settings_section'
	//);
	add_settings_field(
      'gmap_height',
      '<i class="fa fa-arrows-v black--text" aria-hidden="true"></i>Set map height in pixels',
      'sandbox_gmap_height_callback',
      'sandbox_theme_map_options',
      'map_settings_section'
  );
  add_settings_field(
      'gmap_scroll',
      '<i class="fa fa-binoculars black--text" aria-hidden="true"></i>Zoom in and out with page scroll',
      'sandbox_gmap_scroll_callback',
      'sandbox_theme_map_options',
      'map_settings_section'
  );
	add_settings_field(
      'gmap_infowindow',
      '<i class="fa fa-hand-pointer-o blue--text" aria-hidden="true"></i>Display Marker Location Info on:',
      'sandbox_gmap_infowindow_callback',
      'sandbox_theme_map_options',
      'map_settings_section'
  );
	add_settings_field(
	    'gmap_infowindow_address',
	    '<i class="fa fa-map-marker red--text" aria-hidden="true"></i>Show Location Addresses',
	    'sandbox_gmap_infowindow_address_callback',
	    'sandbox_theme_map_options',
	    'map_settings_section'
	);
	add_settings_field(
	    'gmap_infowindow_link',
	    '<i class="fa fa-link purple--text" aria-hidden="true"></i>Show links to separate Google Maps',
	    'sandbox_gmap_infowindow_link_callback',
	    'sandbox_theme_map_options',
	    'map_settings_section'
	);




	// - - - - - - - - -
	// location 1
	// a) location 1 name
	add_settings_field(
      'gmap_location_1_name',
      '<h4>Office Locations</h4>
			<br>Office Location 1<br>
			<br><i class="fa fa-home black--text" aria-hidden="true"></i>Name',
      'sandbox_gmap_location_1_name_callback',
      'sandbox_theme_map_options',
      'map_settings_section'
  );
	// b) location 1 address
	add_settings_field(
      'gmap_location_1_address',
      '<i class="fa fa-map-marker red--text" aria-hidden="true"></i>Address',
      'sandbox_gmap_location_1_address_callback',
      'sandbox_theme_map_options',
      'map_settings_section'
  );

	// location 2
	// a) location 2 name
	add_settings_field(
	    'gmap_location_2_name',
	    '<br>Office Location 2<br>
			<br><i class="fa fa-home black--text" aria-hidden="true"></i>Name',
	    'sandbox_gmap_location_2_name_callback',
	    'sandbox_theme_map_options',
	    'map_settings_section'
	);
	// b) location 2 address
	add_settings_field(
	    'gmap_location_2_address',
	    '<i class="fa fa-map-marker red--text" aria-hidden="true"></i>Address',
	    'sandbox_gmap_location_2_address_callback',
	    'sandbox_theme_map_options',
	    'map_settings_section'
	);

	// location 3
	// a) location 3 name
	add_settings_field(
	    'gmap_location_3_name',
	    '<br>Office Location 3<br>
			<br><i class="fa fa-home black--text" aria-hidden="true"></i>Name',
	    'sandbox_gmap_location_3_name_callback',
	    'sandbox_theme_map_options',
	    'map_settings_section'
	);
	// b) location 3 address
	add_settings_field(
	    'gmap_location_3_address',
	    '<i class="fa fa-map-marker red--text" aria-hidden="true"></i>Address',
	    'sandbox_gmap_location_3_address_callback',
	    'sandbox_theme_map_options',
	    'map_settings_section'
	);

	// location 4
	// a) location 4 name
	add_settings_field(
	    'gmap_location_4_name',
	    '<br>Office Location 4<br>
			<br><i class="fa fa-home black--text" aria-hidden="true"></i>Name',
	    'sandbox_gmap_location_4_name_callback',
	    'sandbox_theme_map_options',
	    'map_settings_section'
	);
	// b) location 4 address
	add_settings_field(
	    'gmap_location_4_address',
	    '<i class="fa fa-map-marker red--text" aria-hidden="true"></i>Address',
	    'sandbox_gmap_location_4_address_callback',
	    'sandbox_theme_map_options',
	    'map_settings_section'
	);


	register_setting(
    	'sandbox_theme_map_options',
    	'sandbox_theme_map_options',
    	'sandbox_theme_sanitize_map_options'
	);
} // end sandbox_theme_intialize_map_options
add_action( 'admin_init', 'sandbox_theme_intialize_map_options' );



// use sanitize_text_field() to sanitise map options
function sandbox_theme_sanitize_map_options( $input ) {
    $output = array();

    // loop over the affiliate logo section options
    foreach( $input as $key => $val ) {

        // the key must be set, in order to get sanitised and output
        if( isset ( $input[$key] ) ) {

            // if input key is a checkbox, sanitise if differently
            if ( $key == 'gmap_contact_page' ) {
                $output[$key] = filter_var( $input[$key], FILTER_SANITIZE_NUMBER_INT );
            } else {
                $output[$key] = sanitize_text_field( $input[$key] );
            }

        } // end if

    } // end foreach

    return apply_filters( 'sandbox_theme_sanitize_map_options', $output, $input );
} // end sandbox_theme_sanitize_map_options


// construct the map options form
function sandbox_map_options_callback() {
    echo '<p>Add your Google Maps API Key, then define general settings for the map, before adding your office locations.</p>
		 <p>Copy and paste the following shortcode to add your Google Map into pages:</p>
		 <p><strong>[google-map]</strong></p>';
} // end sandbox_map_options_callback

//
// API Key
function sandbox_gmap_api_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_api_key'] ) ) {
        $options['gmap_api_key'];
    } // end if
    // Render the output
    echo '<input type="text" id="gmap_api_key" name="sandbox_theme_map_options[gmap_api_key]" value="' . $options['gmap_api_key'] . '" class="top-margin--4-2" />';
} // end sandbox_gmap_api_callback


//
// Zoom and Scroll Stuff
// 1 - set the zoom level
// create a dropdown to select zoom level
function sandbox_gmap_zoom_level_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_zoom'] ) ) {
        $options['gmap_zoom'];
    } // end if
    // Render the output
		// selected="selected"
    echo '
    <select class="hidden" id="gmap_zoom" name="sandbox_theme_map_options[gmap_zoom]" ' . selected( isset( $options['gmap_zoom'] ) ? $options['gmap_zoom'] : false ) . '>
        <option value="10" '. ( $options['gmap_zoom'] == 10 ? ('selected="selected" class="green--background"')  : '') .' >10</option>
        <option value="11" '. ( $options['gmap_zoom'] == 11 ? ('selected="selected" class="green--background"')  : '') .' >11</option>
        <option value="12" '. ( $options['gmap_zoom'] == 12 ? ('selected="selected" class="green--background"')  : '') .' >12</option>
        <option value="13" '. ( $options['gmap_zoom'] == 13 ? ('selected="selected" class="green--background"')  : '') .' >13</option>
        <option value="14" '. ( $options['gmap_zoom'] == 14 ? ('selected="selected" class="green--background"')  : '') .' >14</option>
        <option value="15" '. ( $options['gmap_zoom'] == 15 ? ('selected="selected" class="green--background"')  : '') .' >15</option>
    </select>
    ';
} // end sandbox_gmap_zoom_level_callback

// 2 - set height in pixels of google map
function sandbox_gmap_height_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_height'] ) ) {
        $options['gmap_height'];
    } // end if
    // Render the output
    echo '
		<div id="gmap_slider">
				<div class="v-slider"></div>
				<div class="slider-info">
						<label for="map-height">Height (px):</label>
						<input class="slider-value" type="text" id="gmap_height" readonly name="sandbox_theme_map_options[gmap_height]" value="' . $options['gmap_height'] . '">
				</div>
		</div>';
} // end sandbox_gmap_height_callback

// 3 - allow scroll page to zoom map in and out
function sandbox_gmap_scroll_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_scroll'] ) ) {
        $options['gmap_scroll'];
    } // end if
    // Render the output
    echo '<input type="checkbox" id="gmap_scroll" name="sandbox_theme_map_options[gmap_scroll]" value="1" ' . checked( 1, isset( $options['gmap_scroll'] ) ? $options['gmap_scroll'] : 0, false ) . ' />';
} // end sandbox_gmap_scroll_callback



// - - - - - - - -
// Infowindow Stuff
// 1 - display on hover or click
// create a dropdown to select hover or click
function sandbox_gmap_infowindow_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_infowindow'] ) ) {
        $options['gmap_infowindow'];
    } // end if
    // Render the output
    echo '
    <select id="gmap_infowindow" name="sandbox_theme_map_options[gmap_infowindow]">
        <option value="mouseover" '. ( $options['gmap_infowindow'] == 'mouseover' ? ('selected="selected" class="green--background"')  : '') .' >Hover</option>
        <option value="click" '. ( $options['gmap_infowindow'] == 'click' ? ('selected="selected" class="green--background"')  : '') .' >Click</option>
    </select>
    ';
} // end sandbox_gmap_infowindow_callback

// 2 - toggle addresses
function sandbox_gmap_infowindow_address_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_infowindow_address'] ) ) {
        $options['gmap_infowindow_address'];
    } // end if
    // Render the output
    echo '<input type="checkbox" id="gmap_infowindow_address" name="sandbox_theme_map_options[gmap_infowindow_address]" value="1" ' . checked( 1, isset( $options['gmap_infowindow_address'] ) ? $options['gmap_infowindow_address'] : 0, false ) . ' />';
} // end sandbox_gmap_infowindow_address_callback

// 3 - toggle open in google maps link
function sandbox_gmap_infowindow_link_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_infowindow_link'] ) ) {
        $options['gmap_infowindow_link'];
    } // end if
    // Render the output
    echo '<input type="checkbox" id="gmap_infowindow_link" name="sandbox_theme_map_options[gmap_infowindow_link]" value="1" ' . checked( 1, isset( $options['gmap_infowindow_link'] ) ? $options['gmap_infowindow_link'] : 0, false ) . ' />';
} // end sandbox_gmap_infowindow_link_callback



// - - - - - - - - - -
// Location 1
// a) location 1 name
function sandbox_gmap_location_1_name_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_location_1_name'] ) ) {
        $options['gmap_location_1_name'];
    } // end if
    echo '<input type="text" id="gmap_location_1_name" name="sandbox_theme_map_options[gmap_location_1_name]" value="' . $options['gmap_location_1_name'] . '" class="top-margin--10" />';
} // end sandbox_gmap_location_1_name_callback

// b) location 1 address
function sandbox_gmap_location_1_address_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_location_1_address'] ) ) {
        $options['gmap_location_1_address'];
    } // end if
    echo '<input type="text" id="gmap_location_1_address" name="sandbox_theme_map_options[gmap_location_1_address]" value="' . $options['gmap_location_1_address'] . '" />';
} // end sandbox_gmap_location_1_address_callback



// - - - - - - - - - -
// Location 2
// a) location 2 name
function sandbox_gmap_location_2_name_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_location_2_name'] ) ) {
        $options['gmap_location_2_name'];
    } // end if
    echo '<input type="text" id="gmap_location_2_name" name="sandbox_theme_map_options[gmap_location_2_name]" value="' . $options['gmap_location_2_name'] . '" class="top-margin--5-8" />';
} // end sandbox_gmap_location_2_name_callback

// b) location 2 address
function sandbox_gmap_location_2_address_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_location_2_address'] ) ) {
        $options['gmap_location_2_address'];
    } // end if
    echo '<input type="text" id="gmap_location_2_address" name="sandbox_theme_map_options[gmap_location_2_address]" value="' . $options['gmap_location_2_address'] . '" />';
} // end sandbox_gmap_location_2_address_callback



// - - - - - - - - - -
// Location 3
// a) location 3 name
function sandbox_gmap_location_3_name_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_location_3_name'] ) ) {
        $options['gmap_location_3_name'];
    } // end if
    echo '<input type="text" id="gmap_location_3_name" name="sandbox_theme_map_options[gmap_location_3_name]" value="' . $options['gmap_location_3_name'] . '" class="top-margin--5-8" />';
} // end sandbox_gmap_location_3_name_callback

// b) location 3 address
function sandbox_gmap_location_3_address_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_location_3_address'] ) ) {
        $options['gmap_location_3_address'];
    } // end if
    echo '<input type="text" id="gmap_location_3_address" name="sandbox_theme_map_options[gmap_location_3_address]" value="' . $options['gmap_location_3_address'] . '" />';
} // end sandbox_gmap_location_3_address_callback



// - - - - - - - - - -
// Location 4
// a) location 4 name
function sandbox_gmap_location_4_name_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_location_4_name'] ) ) {
        $options['gmap_location_4_name'];
    } // end if
    echo '<input type="text" id="gmap_location_4_name" name="sandbox_theme_map_options[gmap_location_4_name]" value="' . $options['gmap_location_4_name'] . '" class="top-margin--5-8" />';
} // end sandbox_gmap_location_4_name_callback

// b) location 4 address
function sandbox_gmap_location_4_address_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_location_4_address'] ) ) {
        $options['gmap_location_4_address'];
    } // end if
    echo '<input type="text" id="gmap_location_4_address" name="sandbox_theme_map_options[gmap_location_4_address]" value="' . $options['gmap_location_4_address'] . '" />';
} // end sandbox_gmap_location_4_address_callback















// ------------------------------------------------------------------------
// 2) Blog Styling
function sandbox_theme_intialize_blog_options() {
	// If the blog options don't exist, create them.
    if( false == get_option( 'sandbox_theme_blog_options' ) ) {
        add_option( 'sandbox_theme_blog_options' );
    } // end if

	add_settings_section(
    	'blog_settings_section',          // ID used to identify this section and with which to register options
    	'Styling Options for the Blog',  // Title to be displayed on the administration page
    	'sandbox_blog_options_callback',  // Callback used to render the description of the section
    	'sandbox_theme_blog_options'      // Page on which to add this section of options
	);

	// Widgets Title
	add_settings_field(
    	'blog_widget_title',
    	'<h4>Blog Widget Area</h4>
			<i class="fa fa-header" aria-hidden="true"></i>Title',
    	'sandbox_blog_widget_title_callback',
    	'sandbox_theme_blog_options',
    	'blog_settings_section'
	);
	add_settings_field(
	    'blog_widget_title_align',
	    '<i class="fa fa-align-left black--text" aria-hidden="true"></i>Title Alignment',
	    'sandbox_blog_widget_title_align_callback',
	    'sandbox_theme_blog_options',
	    'blog_settings_section'
	);

	// Widgets Background
  add_settings_field(
    	'blog_widget_bg_colour',
			'<i class="fa fa-paint-brush" id="bg-colour-brush" aria-hidden="true"></i>Background Colour',
    	'sandbox_blog_widget_bg_colour_callback',
    	'sandbox_theme_blog_options',
    	'blog_settings_section'
	);
	add_settings_field(
	    'blog_widget_theme',
	    '<i class="fa fa-adjust" id="widget-theme" aria-hidden="true"></i>Theme / Colour Scheme',
	    'sandbox_blog_widget_theme_callback',
	    'sandbox_theme_blog_options',
	    'blog_settings_section'
	);
  add_settings_field(
    	'blog_widget_bg_image',
			'<i class="fa fa-picture-o" aria-hidden="true"></i>Background Image',
    	'sandbox_blog_widget_bg_image_callback',
    	'sandbox_theme_blog_options',
    	'blog_settings_section'
	);
  add_settings_field(
    	'blog_widget_bg_image_opacity',
			'<i class="fa fa-arrows-v" id="bg-opacity_icon" aria-hidden="true"></i>Background Image Opacity',
    	'sandbox_blog_widget_bg_image_opacity_callback',
    	'sandbox_theme_blog_options',
    	'blog_settings_section'
	);
	register_setting(
    	'sandbox_theme_blog_options',
    	'sandbox_theme_blog_options',
    	'sandbox_theme_sanitize_blog_options'
	);
} // end sandbox_theme_intialize_blog_options
add_action( 'admin_init', 'sandbox_theme_intialize_blog_options' );


// construct the blog options form
function sandbox_blog_options_callback() {
    echo '
		<p>Define Styling Options for the Blog Pages here.</p>
		<p>Decide whether to include blog widgets or not in <a href="widgets.php">Appearance > Widgets</a>.</p>';
} // end sandbox_blog_options_callback

// sanitise blog options
function sandbox_theme_sanitize_blog_options( $input ) {
    $output = array();
    foreach( $input as $key => $val ) {

        // if the key is the background image, sanitise as a url
        if ( $key == 'blog_widget_bg_image' ) {
            $output['blog_widget_bg_image'] = esc_url_raw( strip_tags( stripslashes( $input['blog_widget_bg_image'] ) ) );

        // if not, sanitise it as a text field
        } else {
            $output[$key] = sanitize_text_field( $input[$key] );
        }

    } // end foreach
    // Return the new collection
    return apply_filters( 'sandbox_theme_sanitize_blog_options', $output, $input );
} // end sandbox_theme_sanitize_blog_options




// - - - - - - - - -
// Blog Widgets
// 1 - Title
function sandbox_blog_widget_title_callback() {
    $options = get_option( 'sandbox_theme_blog_options' );
    if( isset( $options['blog_widget_title'] ) ) {
        $options['blog_widget_title'];
    } // end if
    // Render the output
    echo '<input type="text" id="blog_widget_title" name="sandbox_theme_blog_options[blog_widget_title]" value="' . $options['blog_widget_title'] . '" class="top-margin--4-2" />';
} // end sandbox_blog_widget_title_callback

// 2 - Title Alignment
function sandbox_blog_widget_title_align_callback() {
    $options = get_option( 'sandbox_theme_blog_options' );
    if( isset( $options['blog_widget_title_align'] ) ) {
        $options['blog_widget_title_align'];
    } // end if
    // Render the output
    echo '
		<ul id="blog_widget_title_align">
				<li>
						<input type="radio" id="blog_widget_title_align_left" name="sandbox_theme_blog_options[blog_widget_title_align]" value="left" '. ( $options['blog_widget_title_align'] == 'left' ? ('checked="checked" class="green--background"')  : '') .' />
						<label for="blog_widget_title_align_left">Left (Default)</label>
				</li>
				<li>
				    <input type="radio" id="blog_widget_title_align_center" name="sandbox_theme_blog_options[blog_widget_title_align]" value="center" '. ( $options['blog_widget_title_align'] == 'center' ? ('checked="checked" class="green--background"')  : '') .' />
				    <label for="blog_widget_title_align_center">Center</label>
				</li>
				<li>
				    <input type="radio" id="blog_widget_title_align_right" name="sandbox_theme_blog_options[blog_widget_title_align]" value="right" '. ( $options['blog_widget_title_align'] == 'right' ? ('checked="checked" class="green--background"')  : '') .' />
				    <label for="blog_widget_title_align_right">Right</label>
				</li>
		</ul>
		';
} // end sandbox_blog_widget_title_align_callback





// - - - - - - - - -
// 3 - Background Colour
function sandbox_blog_widget_bg_colour_callback() {
    $options = get_option( 'sandbox_theme_blog_options' );
    if( isset( $options['blog_widget_bg_colour'] ) ) {
        $options['blog_widget_bg_colour'];
    } // end if
    // Render the output
    echo '
		<ul id="blog_widget_bg_colour">
				<li>
						<input type="radio" id="blog_widget_bg_colour_default" name="sandbox_theme_blog_options[blog_widget_bg_colour]" value="default" '. ( $options['blog_widget_bg_colour'] == 'default' ? ('checked="checked" class="green--background"')  : '') .' />
						<label for="blog_widget_bg_colour_default">Default (no colour / white)</label>
				</li>
				<li>
				    <input type="radio" id="blog_widget_bg_colour_green" name="sandbox_theme_blog_options[blog_widget_bg_colour]" value="green" '. ( $options['blog_widget_bg_colour'] == 'green' ? ('checked="checked" class="green--background"')  : '') .' />
				    <label for="blog_widget_bg_colour_green">Green</label>
				</li>
				<li>
				    <input type="radio" id="blog_widget_bg_colour_orange" name="sandbox_theme_blog_options[blog_widget_bg_colour]" value="orange" '. ( $options['blog_widget_bg_colour'] == 'orange' ? ('checked="checked" class="green--background"')  : '') .' />
				    <label for="blog_widget_bg_colour_orange">Orange</label>
				</li>
        <li>
            <input type="radio" id="blog_widget_bg_colour_blue" name="sandbox_theme_blog_options[blog_widget_bg_colour]" value="blue" '. ( $options['blog_widget_bg_colour'] == 'blue' ? ('checked="checked" class="green--background"')  : '') .' />
            <label for="blog_widget_bg_colour_blue">Blue</label>
        </li>
        <li>
            <input type="radio" id="blog_widget_bg_colour_red" name="sandbox_theme_blog_options[blog_widget_bg_colour]" value="red" '. ( $options['blog_widget_bg_colour'] == 'red' ? ('checked="checked" class="green--background"')  : '') .' />
            <label for="blog_widget_bg_colour_red">Red</label>
        </li>
				<li>
				    <input type="radio" id="blog_widget_bg_colour_light-grey" name="sandbox_theme_blog_options[blog_widget_bg_colour]" value="light-grey" '. ( $options['blog_widget_bg_colour'] == 'light-grey' ? ('checked="checked" class="green--background"')  : '') .' />
				    <label for="blog_widget_bg_colour_light-grey">Light Grey</label>
				</li>
				<li>
				    <input type="radio" id="blog_widget_bg_colour_dark-grey" name="sandbox_theme_blog_options[blog_widget_bg_colour]" value="dark-grey" '. ( $options['blog_widget_bg_colour'] == 'dark-grey' ? ('checked="checked" class="green--background"')  : '') .' />
				    <label for="blog_widget_bg_colour_dark-grey">Dark Grey</label>
				</li>
		</ul>
		';
} // end sandbox_blog_widget_bg_colour_callback


// 4 - Theme / Colour Scheme
function sandbox_blog_widget_theme_callback() {
    $options = get_option( 'sandbox_theme_blog_options' );
    if( isset( $options['blog_widget_theme'] ) ) {
        $options['blog_widget_theme'];
    } // end if
    // Render the output
		// selected="selected"
    echo '
    <select id="blog_widget_theme" name="sandbox_theme_blog_options[blog_widget_theme]" ' . selected( isset( $options['blog_widget_theme'] ) ? $options['blog_widget_theme'] : false ) . '>
        <option value="light" '. ( $options['blog_widget_theme'] == light ? ('selected="selected" class="green--background"')  : '') .' >light</option>
        <option value="dark" '. ( $options['blog_widget_theme'] == dark ? ('selected="selected" class="green--background"')  : '') .' >dark</option>
    </select>
    ';
} // end sandbox_blog_widget_theme_callback


// 5 - Background Image
function sandbox_blog_widget_bg_image_callback() {
    $options = get_option( 'sandbox_theme_blog_options' );
    $url = '';
    if( isset( $options['blog_widget_bg_image'] ) ) {
        $url = $options['blog_widget_bg_image'];
    } // end if blog_widget_bg_image is set
		echo
		'<div class="bg-img_group blog_widget_bg_image">
			<div class="widget-bg-preview">
					<img class="adminlogo widget-image-preview" src="'. get_bloginfo('stylesheet_directory'). '/img/admin-img/widgets-bg_default.jpg"/>
			</div>
			<input type="button" class="button button-primary" value="Upload Blog Widgets Background Image" id="upload_blog_widget_bg_image"/>
			<label for="blog_widget_bg_image">Background Image Location - can also enter with URL. Image should be at least 1800px wide.</label>
			<input type="text" id="blog_widget_bg_image" name="sandbox_theme_blog_options[blog_widget_bg_image]" value="' . $options['blog_widget_bg_image'] . '" />
		</div>';
} // end sandbox_blog_widget_bg_image_callback


// 6 - Background Image Opacity
function sandbox_blog_widget_bg_image_opacity_callback() {
    $options = get_option( 'sandbox_theme_blog_options' );
    if( isset( $options['blog_widget_bg_image_opacity'] ) ) {
        $options['blog_widget_bg_image_opacity'];
    } // end if
    // Render the output
    echo '
		<div id="bg_image_slider">
				<div class="v-slider"></div>
				<div class="slider-info">
						<label for="image-opacity">Opacity (%):</label>
						<input class="slider-value" type="text" id="blog_widget_bg_image_opacity" readonly name="sandbox_theme_blog_options[blog_widget_bg_image_opacity]" value="' . $options['blog_widget_bg_image_opacity'] . '">
				</div>
		</div>';
} // end sandbox_blog_widget_bg_image_opacity_callback

// relies upon the above:

// function for blog widget area - reduce code repetition across templates
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
	$widget_image_opacity = (int)$widget_image_opacity;
	$widget_image_opacity = (100 - $widget_image_opacity);


	// blog widget area
	if ( is_active_sidebar( 'blogpages' ) ) {

			echo '
			<div id="blog-widgets" role="complementary"'. ( $widget_image ? ( ' style="background-image:url('. $widget_image ) .')"' : '') . ( $widget_theme ? ( ' class="'. $widget_theme ) .'"' : '') .'>'.
					( $widget_title ? ( '<div class="container'. ( $widget_align != 'left' ? ( ' '. $widget_align )  : '') .'"><h3 class="blog-widgets--title">'. $widget_title .'</h3></div>' )  : '') .'
					<div class="container widgets">
							'; dynamic_sidebar( 'blogpages' ); echo'
					</div>
					'. ( $widget_colour ? ( '<div class="widget-overlay '. $widget_colour ) .'" '. ( $widget_image_opacity != 100 ? ( ' style="opacity:.'. $widget_image_opacity ) .';"' : '') .'></div>' : '') .'
			</div>
			';
	}

} // end sandbox_blog_widget_title_callback



// load thickbox stuff on admin side only
if (is_admin()) {
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox'); //thickbox styles css
}
// hooked into theme logos function
add_action( 'menu_options_filter', 'sandbox_theme_logo_options' );
















// ------------------------------------------------------------------------
// Functionality Options
// ------------------------------------------------------------------------



// ------------------------------------------------------------------------
// 1/ Google Analytics Options
function sandbox_theme_intialize_google_analytics_options() {
    // If the google_analytics options don't exist, create them.
    if( false == get_option( 'sandbox_theme_google_analytics_options' ) ) {
        add_option( 'sandbox_theme_google_analytics_options' );
    } // end if
	add_settings_section(
    	'google_analytics_settings_section',          // ID used to identify this section and with which to register options
    	'Google Analytics',                           // Title to be displayed on the administration page
    	'sandbox_google_analytics_options_callback',  // Callback used to render the description of the section
    	'sandbox_theme_google_analytics_options'      // Page on which to add this section of options
	);
	add_settings_field(
    	'google_analytics',
    	'<i class="fa fa-bar-chart" aria-hidden="true"></i>Tracking ID',
    	'sandbox_google_analytics_callback',
    	'sandbox_theme_google_analytics_options',
    	'google_analytics_settings_section'
	);
	register_setting(
    	'sandbox_theme_google_analytics_options',
    	'sandbox_theme_google_analytics_options',
    	'sandbox_theme_sanitize_google_analytics_options'
	);
} // end sandbox_theme_intialize_google_analytics_options
add_action( 'admin_init', 'sandbox_theme_intialize_google_analytics_options' );


// sanitise google_analytics options - output tracking ID
function sandbox_theme_sanitize_google_analytics_options( $input ) {
    $output = array();
    foreach( $input as $key => $val ) {
        if( isset ( $input[$key] ) ) {
            $output[$key] = sanitize_text_field( $input[$key] );
        } // end if
    } // end foreach
    // Return the new collection
    return apply_filters( 'sandbox_theme_sanitize_google_analytics_options', $output, $input );
} // end sandbox_theme_sanitize_google_analytics_options


function sandbox_google_analytics_options_callback() {
    echo '<p>Paste your Google Analytics Tracking ID into the text field to add Google Analytics tracking to your website.</p>
		<p>Leave this field empty to omit tracking.</p>';
} // end sandbox_google_analytics_options_callback


function sandbox_google_analytics_callback() {
    $options = get_option( 'sandbox_theme_google_analytics_options' );
    $url = '';
    if( isset( $options['google_analytics'] ) ) {
        $url = $options['google_analytics'];
    } // end if
    // Render the output
    echo '<input type="text" id="google_analytics" name="sandbox_theme_google_analytics_options[google_analytics]" value="' . $options['google_analytics'] . '" />
		<i title="How do I find the Google Analytics Tracking ID?" class="fa fa-question" aria-hidden="true"></i>
		<div class="google_analytics--info hidden">
		<img src="'. get_bloginfo('stylesheet_directory'). '/img/admin-img/google_analytics-info.jpg"/>
		<p>When logged in to Google Analytics, Click the \'All Web Site Data\' Drop Down in the top left of the screen, then copy and paste the ID under your business name <span class="green--text">(underlined above in green)</span> into the above text field.</p>
		</div>';
} // end sandbox_google_analytics_callback















// ------------------------------------------------------------------------
// 2/ Lazyloading Options
function sandbox_theme_intialize_lazyloading_options() {
    // If the lazyloading options don't exist, create them.
    if( false == get_option( 'sandbox_theme_lazyloading_options' ) ) {
        add_option( 'sandbox_theme_lazyloading_options' );
    } // end if
	add_settings_section(
    	'lazyloading_settings_section',          // ID used to identify this section and with which to register options
    	'Lazyloading of Images',                   // Title to be displayed on the administration page
    	'sandbox_lazyloading_options_callback',  // Callback used to render the description of the section
    	'sandbox_theme_lazyloading_options'      // Page on which to add this section of options
	);
	add_settings_field(
    	'lazyloading',
    	'<i class="fa fa-picture-o" aria-hidden="true"></i>Toggle Lazyloading',
    	'sandbox_lazyloading_callback',
    	'sandbox_theme_lazyloading_options',
    	'lazyloading_settings_section'
	);
	register_setting(
    	'sandbox_theme_lazyloading_options',
    	'sandbox_theme_lazyloading_options',
    	'sandbox_theme_sanitize_lazyloading_options'
	);
} // end sandbox_theme_intialize_lazyloading_options
add_action( 'admin_init', 'sandbox_theme_intialize_lazyloading_options' );




// sanitise lazyloading options - checkbox and textfield
function sandbox_theme_sanitize_lazyloading_options( $input ) {
    $output = array();
    // loop over lazyloading options
    foreach( $input as $key => $val ) {
        // if key is set, sanitise and output it
        if( isset ( $input[$key] ) ) {
            // if input key is a checkbox, sanitise if differently
            if ( $key == 'lazyloading' ) {
                $output[$key] = filter_var( $input[$key], FILTER_SANITIZE_NUMBER_INT );
            } else {
                $output[$key] = sanitize_text_field( $input[$key] );
            }
        } // end if set
    } // end foreach
    return apply_filters( 'sandbox_theme_sanitize_lazyloading_options', $output, $input );
} // end sandbox_theme_sanitize_lazyloading_options




// construct the lazyloading options form
// 1 - the intro message
function sandbox_lazyloading_options_callback() {
    echo '
		<p>Allow in-page image assets to be lazy-loaded. This can help reduce the load time of image-heavy pages.</p>
    <p>Images below the viewport will only be loaded once the user scrolls down.</p>';
} // end sandbox_lazyloading_options_callback


// 2 - toggle lazyloading
function sandbox_lazyloading_callback() {
    $options = get_option( 'sandbox_theme_lazyloading_options' );
    if( isset( $options['lazyloading'] ) ) {
        $options['lazyloading'];
    } // end if
    // Render the output
    echo '<input type="checkbox" id="lazyloading" name="sandbox_theme_lazyloading_options[lazyloading]" value="1" ' . checked( 1, isset( $options['lazyloading'] ) ? $options['lazyloading'] : 0, false ) . ' />';
} // end sandbox_lazyloading_callback


// 3 - enable lazyloading on the front end
$lazyload = get_option( 'sandbox_theme_lazyloading_options' );
$lazyload_on = $lazyload['lazyloading'];

// if the checkbox is marked, add lazyloading
if ($lazyload_on != '') {

		// Lazyloading
		function enqueue_lazyload() {
		    wp_enqueue_script('jquery_lazy_load', get_stylesheet_directory_uri() . '/js/lib/jquery.lazyload.min.js', array('jquery'), '1.0');
		}
		add_action('wp_enqueue_scripts', 'enqueue_lazyload');


		function footer_lazyload() {
		echo '
		<script type="text/javascript">
		jQuery(document).ready(function( $ ) {
			$(function() {
			    $("img.lazy").lazyload({
					    load : function(elements_left, settings) {
					        //console.log(this, elements_left, settings);
					        $(this).removeClass("loading-icon");
					    }
					});
			});
		});
		</script>
		';
		}
		add_action('wp_footer', 'footer_lazyload');


		// filter the_content, acf_the_content, and
		function filter_lazyload($content) {
		    return preg_replace_callback('/(<\s*img[^>]+)(src\s*=\s*"[^"]+")([^>]+>)/i', 'preg_lazyload', $content);
		}
		add_filter('the_content', 'filter_lazyload');
		add_filter('acf_the_content', 'filter_lazyload');
		// gallery filter doesn't work here - need to come up with a new solution
		// add_filter('post_gallery', 'filter_lazyload');

		function preg_lazyload($img_match) {

		    //$img_replace = $img_match[1] . 'src="' . get_stylesheet_directory_uri() . '/img/loading-icon.gif" class="loading-icon" data-original' . substr($img_match[2], 3) . $img_match[3];
				$img_replace = $img_match[1] . ' class="loading-icon" data-original' . substr($img_match[2], 3) . $img_match[3];

		    $img_replace = preg_replace('/class\s*=\s*"/i', 'class="lazy ', $img_replace);

		    $img_replace .= '<noscript>' . $img_match[0] . '</noscript>';
		    return $img_replace;
		}

// end lazyload on
}
