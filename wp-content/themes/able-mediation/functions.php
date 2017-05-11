<?php
/*name of my theme*/
$themename = 'ABLE Mediation';

// add a favicon //
function blog_favicon() {
	echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('stylesheet_directory').'/images/able-icon.png" />' . "\n";
	}
add_action('wp_head', 'blog_favicon');

// add google fonts //
function load_fonts() {
	wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Asap:700|Source+Sans+Pro:400,400italic,700', false, false, true);
	wp_enqueue_style( 'googleFonts');
	}
add_action('wp_print_styles', 'load_fonts');

// add IE google fonts //
function ie_fonts() {
	echo "<!--[if lt IE 9]>
<link href='http://fonts.googleapis.com/css?family=Asap:700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:700' rel='stylesheet' type='text/css'>
    <![endif]-->";
	}
add_action('wp_head', 'ie_fonts');

// add google analytics //
add_action('wp_footer', 'add_googleanalytics');
function add_googleanalytics() { ?>

<script>
  //(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  //(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  //m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  //})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  //ga('create', 'UA-93508129-1', 'auto');
  //ga('send', 'pageview');

</script>
<?php }

// add secondary menu in the footer //
register_nav_menus( array(
'footernavigation' => __( 'Footer Navigation', 'ABLE Mediation' )
) );

// add Stylesheets
function load_css() {
	// ie css in header.php
	//add print css
	wp_register_style('ablemediation-print', get_stylesheet_directory_uri() . '/css/print.css', false, false, 'print');
	// add font awesome icons
	wp_register_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
	wp_enqueue_style('font-awesome');
	// add css for home page slider
	if (is_page_template('page-templates/home-page-slider.php')){
		wp_register_style('flexslider-css', get_stylesheet_directory_uri(). '/css/flexslider.css' );
		wp_enqueue_style( 'flexslider-css');
	}
}
add_action('wp_enqueue_scripts', 'load_css');





// JS Async load
function jt_async_scripts($url){
    if ( strpos( $url, '#asyncload') === false )
        return $url;
    else if ( is_admin() )
        return str_replace( '#asyncload', '', $url );
    else
	return str_replace( '#asyncload', '', $url )."' async='async";
}
add_filter( 'clean_url', 'jt_async_scripts', 11, 1 );

// ------------------- //
// jQuery Scripts // true puts script in footer
function load_scripts() {
	if (!is_admin()) {

	// 1./ all pages

	// a) jquery ui plugin //
	wp_register_script('jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js', 'jquery', '1.10.3', true);
	wp_enqueue_script('jquery-ui');

	// b) cookies plugin //
	if ( is_active_sidebar( 'cookies' ) ){
		//wp_enqueue_script('jquery-cookie', get_stylesheet_directory_uri(). '/js/lib/jquery.cookie.js', array('jquery'), '1.0', true );
		// newer version of script on cdn did not work???
		wp_register_script('jquery-cookie', 'https://cdnjs.cloudflare.com/ajax/libs/js-cookie/1.5.0/js.cookie.min.js', 'jquery', '1.5.0', true );
		wp_enqueue_script('jquery-cookie');
	}
	// c) tooltip and cookies toggle //
	wp_enqueue_script('tooltip', get_stylesheet_directory_uri(). '/js/tooltip.js#asyncload', array('jquery','jquery-ui'), '1.0', true);

	// main js didnt work - wp_enqueue_script('able-js', get_stylesheet_directory_uri(). '/js/able.js', array('jquery', 'jquery-ui', 'jquery-cookie' ), '1.0', true);


// 2./ specific pages
	// a) family mediation nav //
	if (is_page_template('page-templates/family-mediation.php')){
		wp_enqueue_script('fam-nav', get_stylesheet_directory_uri(). '/js/fam-nav.js#asyncload', array('jquery'), '1.0', true);
	}
	// b) - 1 self-referrals nav //
	if (is_page_template('page-templates/self-referrals.php')){
		wp_enqueue_script('referral-nav', get_stylesheet_directory_uri(). '/js/referral-nav.js#asyncload', array('jquery'), '1.0', true);
	}
	// c) quote author styling and flexslider - home page //
	if (is_page_template('page-templates/home-page.php')  || is_page_template('page-templates/home-page-slider.php')){
		wp_enqueue_script('quote-author-home', get_stylesheet_directory_uri(). '/js/quote-author-home.js#asyncload', array('jquery'), '1.0', true );
		// image slider
		wp_register_script('flexslider', 'https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.3/jquery.flexslider-min.js', 'jquery', '2.6.3', true);
		wp_enqueue_script('flexslider');
		wp_enqueue_script('flex-control', get_stylesheet_directory_uri(). '/js/flex-control.js', array('jquery','flexslider'), '1.0', true);
		// better youtube embed
		wp_enqueue_script('youtube-embed', get_stylesheet_directory_uri(). '/js/youtube-embed.js', false, '1.0', true );
	}
	// d) quote author styling - all other pages //
	if (!is_page_template('page-templates/home-page.php') && !is_page_template('our-mediators.php')){
		wp_enqueue_script('quote-author', get_stylesheet_directory_uri(). '/js/quote-author.js#asyncload', array('jquery'), '1.0', true);
	}
	// e) our mediators page //
	if (is_page_template('page-templates/our-mediators.php')){
		wp_enqueue_script('mediators', get_stylesheet_directory_uri(). '/js/mediators.js#asyncload', array('jquery'), '1.0', true);
	}

	} // end customer side //
}  // end load scripts //
add_action('wp_enqueue_scripts', 'load_scripts');



// - - - - - - - - -
// use a cdn to load jquery instead
function replace_jquery() {
	if (!is_admin()) {
		// comment out the next two lines to load the local copy of jQuery
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', false, '1.10.2', true);
		wp_enqueue_script('jquery');
	}
}
add_action('init', 'replace_jquery');







// Remove Stuff //
// ------------------ //
// dequeue styles and scripts //
function dequeue_stuff() {
	wp_dequeue_style( 'twentytwelve-fonts' );
	wp_dequeue_style( 'twentytwelve-ie' );
	}
add_action( 'wp_print_styles', 'dequeue_stuff' );


// remove dashicons - render blocking above fold stuff
function deregister_styles()    {
   if (!is_admin() && !is_user_logged_in()) {
   	wp_deregister_style( 'dashicons' );
   }
}
add_action( 'wp_print_styles', 'deregister_styles', 100 );


// remove emojis
function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );

function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}




// remove default page templates (works in more modern versions of wordpress)
function remove_page_templates( $templates ) {
    unset( $templates['page-templates/front-page.php'] );
	unset( $templates['page-templates/full-width.php'] );
    return $templates;
}
add_filter( 'theme_page_templates', 'remove_page_templates' );
// remove background and header options in admin panel //
add_action( 'after_setup_theme','remove_twentytwelve_options', 100 );
function remove_twentytwelve_options() {
	remove_custom_background();
	remove_custom_image_header();
}
// Remove top dashboard widget //
if (is_admin(25)){
function rc_my_welcome_panel() {
	?>
    <script type="text/javascript">
/* Hide default welcome message */
jQuery(document).ready( function($)
{
	$('div#welcome-panel').hide();
});
</script>
<?php
}
add_action( 'welcome_panel', 'rc_my_welcome_panel' );
}
// Remove unneccessary fields from admin panel //
 add_filter('user_contactmethods','hide_profile_fields',10,1);
       function hide_profile_fields( $contactmethods ) {
       unset($contactmethods['aim']);
       unset($contactmethods['jabber']);
       unset($contactmethods['yim']);
       return $contactmethods;
       }

// add post thumnail support //
add_theme_support( 'post-thumbnails' );









// Admin side //
// --------------------- //
// enqueue admin styles //
function load_custom_wp_admin_style() {
	wp_enqueue_style('admin', get_stylesheet_directory_uri(). '/css/admin.css' );// css for all admin pages
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );



// ----------- //
// Add fields to admin panel //
// company details
	   function my_new_contactmethods( $contactmethods ) {
       $contactmethods['phone'] = '<h3 class="greyspan">Company Details</h3><p>a) 0800 Phone Number</br><em>Enter to display in the header area</em></p>' ;
	   $contactmethods['mobilephone'] = '<p>b) Mobile Phone Number</br><em>Enter to display in the header area</em></p>';
	   $contactmethods['facebook'] = '<p>c) Facebook Page Link</br><em>Enter full url, for example: <span class="red">https://www.facebook.com/AbleMediation</em></p>' ;
	   $contactmethods['twitter'] = '<p>d) Twitter Profile Link</br><em>Enter full url to display Twitter profile link.</p>' ;
	   $contactmethods['googleplus'] = '<p>e) Google Plus Page Link</br><em>Enter full url to display Google Plus Page link.</em></p>' ;
	   $contactmethods['linkedin'] = '<p>f) Linkedin Profile Link</br><em>Enter full url to display Linkedin profile link.</p>' ;
	   $contactmethods['companyname'] = '<p>g) Company Name</br><em>Enter to display in the footer area</em></p>';
       $contactmethods['companynumber'] = '<p>h) Registered Company Number</br><em>Enter to display in the footer area</em></p>';
	   $contactmethods['registeredaddress'] = '<p>i) Registered Company Address</br><em>Enter to display in the footer area</em></p>';
// referral
	   $contactmethods['referrallink'] = '<h3 class="orangespan">Referral Page</h3><p>a) Referral Page link</br><em>enter full url, for example: <span class="red">http://www.ablemediation.com/referrals</em></span></p>' ;
	   $contactmethods['referraltext'] = '<p>b) Referral Page Text</br><span class="orangespan">text for the button.</span></p>' ;
	   $contactmethods['referralnewtab'] = '<p>c) Referral Page New Window</br><em>enter any text to open the link in a new tab.</em></p>' ;
// footer logos
	   $contactmethods['footerlogogreenheading'] = '<h3 class="greenspan">Footer Logos</h3><p>a) Footer Logo Green Heading</br><span class="greenspan">Green text</span><em> in the footer area</em></p>';
	   $contactmethods['footerlogoheading'] = '<p>b) Footer Logo Heading</br><span class="greyspan">Grey text</span> <em>in the footer area</em></p>';
	   // footer logo 1
	   $contactmethods['footerlogo1'] = '<p>c) i/ First Footer Logo</br>
	   		<em>Upload a footer logo</em></p>
			<img class="footerlogo1" src="'.
			get_bloginfo('stylesheet_directory'). '/images/logo-default.png"/>
			<input type="button" class="button-primary" value="Upload Footer Logo" id="uploadfooterlogo1"/>
			<p><em>Upload from a location on the web, or your computer or device.</em></p>';
	   $contactmethods['footerlogo1link'] = '<p>c) ii/ First Footer Logo Link</br><em>Enter full url, for example: <span class="red">http://www.collegeofmediators.co.uk/</em></p>';
	   $contactmethods['footerlogo1title'] = '<p>c) iii/ First Footer Logo Title</br><em>Enter to display a </em><span class="greyspan">Title Tag</p>';
	   // footer logo 2
	   $contactmethods['footerlogo2'] = '<p>d) i/ Second Footer Logo</br>
	   		<em>Upload a footer logo</em></p>
			<img class="footerlogo2" src="'.
			get_bloginfo('stylesheet_directory'). '/images/logo-default.png"/>
			<input type="button" class="button-primary" value="Upload Footer Logo" id="uploadfooterlogo2"/>
			<p><em>Upload from a location on the web, or your computer or device.</em></p>';
	   $contactmethods['footerlogo2link'] = '<p>d) ii/ Second Footer Logo Link</br><em>Enter full url, for example: <span class="red">http://www.collegeofmediators.co.uk/</em></p>';
	   $contactmethods['footerlogo2title'] = '<p>d) iii/ Second Footer Logo Title</br><em>Enter to display a </em><span class="greyspan">Title Tag</p>';
	   // footer logo 3
	   $contactmethods['footerlogo3'] = '<p>e) i/ Third Footer Logo</br>
	   		<em>Upload a footer logo</em></p>
			<img class="footerlogo3" src="'.
			get_bloginfo('stylesheet_directory'). '/images/logo-default.png"/>
			<input type="button" class="button-primary" value="Upload Footer Logo" id="uploadfooterlogo3"/>
			<p><em>Upload from a location on the web, or your computer or device.</em></p>';
	   $contactmethods['footerlogo3link'] = '<p>e) ii/ Third Footer Logo Link</br><em>Enter full url, for example: <span class="red">http://www.collegeofmediators.co.uk/</em></p>';
	   $contactmethods['footerlogo3title'] = '<p>e) iii/ Third Footer Logo Title</br><em>Enter to display a </em><span class="greyspan">Title Tag</p>';
	   // footer logo 4
	   $contactmethods['footerlogo4'] = '<p>e) i/ Fourth Footer Logo</br>
	   		<em>Upload a footer logo</em></p>
			<img class="footerlogo4" src="'.
			get_bloginfo('stylesheet_directory'). '/images/logo-default.png"/>
			<input type="button" class="button-primary" value="Upload Footer Logo" id="uploadfooterlogo4"/>
			<p><em>Upload from a location on the web, or your computer or device.</em></p>';
	   $contactmethods['footerlogo4link'] = '<p>e) ii/ Fourth Footer Logo Link</br><em>Enter full url, for example: <span class="red">http://www.collegeofmediators.co.uk/</em></p>';
	   $contactmethods['footerlogo4title'] = '<p>e) iii/ Fourth Footer Logo Title</br><em>Enter to display a </em><span class="greyspan">Title Tag</p>';
	   // footer logo 5
	   $contactmethods['footerlogo5'] = '<p>e) i/ Fifth Footer Logo</br>
	   		<em>Upload a footer logo</em></p>
			<img class="footerlogo5" src="'.
			get_bloginfo('stylesheet_directory'). '/images/logo-default.png"/>
			<input type="button" class="button-primary" value="Upload Footer Logo" id="uploadfooterlogo5"/>
			<p><em>Upload from a location on the web, or your computer or device.</em></p>';
	   $contactmethods['footerlogo5link'] = '<p>e) ii/ Fifth Footer Logo Link</br><em>Enter full url, for example: <span class="red">http://www.collegeofmediators.co.uk/</em></p>';
	   $contactmethods['footerlogo5title'] = '<p>e) iii/ Fifth Footer Logo Title</br><em>Enter to display a </em><span class="greyspan">Title Tag</p>';
       return $contactmethods;
       }
       add_filter('user_contactmethods','my_new_contactmethods',10,1);



function footerlogo_js() {
?><script type="text/javascript">
	jQuery(document).ready(function() {

	// logo 1
	jQuery(document).find("input[id^='uploadfooterlogo1']").live('click', function(){
	//var num = this.id.split('-')[1];
	formfield = jQuery('#footerlogo1').attr('name');
	tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

	window.send_to_editor = function(html) {
	imgurl = jQuery('img',html).attr('src');
	jQuery('#footerlogo1').val(imgurl);
	tb_remove();
	}
	return false;
	});

	// logo 2
	jQuery(document).find("input[id^='uploadfooterlogo2']").live('click', function(){
	formfield = jQuery('#footerlogo2').attr('name');
	tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

	window.send_to_editor = function(html) {
	imgurl = jQuery('img',html).attr('src');
	jQuery('#footerlogo2').val(imgurl);
	tb_remove();
	}
	return false;
	});

	// logo 3
	jQuery(document).find("input[id^='uploadfooterlogo3']").live('click', function(){
	formfield = jQuery('#footerlogo3').attr('name');
	tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

	window.send_to_editor = function(html) {
	imgurl = jQuery('img',html).attr('src');
	jQuery('#footerlogo3').val(imgurl);
	tb_remove();
	}
	return false;
	});

	// logo 4
	jQuery(document).find("input[id^='uploadfooterlogo4']").live('click', function(){
	formfield = jQuery('#footerlogo4').attr('name');
	tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

	window.send_to_editor = function(html) {
	imgurl = jQuery('img',html).attr('src');
	jQuery('#footerlogo4').val(imgurl);
	tb_remove();
	}
	return false;
	});

	// logo 5
	jQuery(document).find("input[id^='uploadfooterlogo5']").live('click', function(){
	formfield = jQuery('#footerlogo5').attr('name');
	tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

	window.send_to_editor = function(html) {
	imgurl = jQuery('img',html).attr('src');
	jQuery('#footerlogo5').val(imgurl);
	tb_remove();
	}
	return false;
	});

	// ----------------------------------

	// conditional image display in editor
	logo1 = jQuery("input[id^='footerlogo1']").val()
	if (jQuery("input[id^='footerlogo1']").val()) {
    	jQuery('.footerlogo1').attr('src', logo1);
	}

	// conditional image display in editor
	logo2 = jQuery("input[id^='footerlogo2']").val()
	if (jQuery("input[id^='footerlogo2']").val()) {
    	jQuery('.footerlogo2').attr('src', logo2);
	}

	// conditional image display in editor
	logo3 = jQuery("input[id^='footerlogo3']").val()
	if (jQuery("input[id^='footerlogo3']").val()) {
    	jQuery('.footerlogo3').attr('src', logo3);
	}

	// conditional image display in editor
	logo4 = jQuery("input[id^='footerlogo4']").val()
	if (jQuery("input[id^='footerlogo4']").val()) {
    	jQuery('.footerlogo4').attr('src', logo4);
	}

	// conditional image display in editor
	logo5 = jQuery("input[id^='footerlogo5']").val()
	if (jQuery("input[id^='footerlogo5']").val()) {
    	jQuery('.footerlogo5').attr('src', logo5);
	}

});
</script>
<?php
}
add_action('admin_head','footerlogo_js');
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox'); //thickbox styles css
add_action( 'user_contactmethods', $contactmethods['footerlogo1'] );








// --------------------- //
// Add Mediators Profile Image
add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );
function my_show_extra_profile_fields( $user ) { ?>
 <h3>Your Profile Image</h3>
	<table class="form-table">
		<tr>
			<th><label for="image">Upload a Profile Image, with around a 4:5 width:height ratio. Your face should be centered.</label></th>
			<td>
			<div class="adminimage">
			<img src="<?php if ( get_the_author_meta('image', $user->ID) != null){
				echo esc_attr(get_the_author_meta('image', $user->ID));
			} else {
				echo bloginfo('stylesheet_directory'). '/images/profile-default.png';
			};?> "/>
			</div>
			</td>
		<tr>
		<tr>
			<td>
			</td>
			<td>
			<input type="text" name="image" id="image" value="<?php echo esc_attr( get_the_author_meta( 'image', $user->ID ) ); ?>" class="regular-text" /><input type='button' class="button-primary" value="Upload Image" id="uploadimage"/><br>
			<span>Upload from a location on the web, or your computer or device.</span>
			</td>
		</tr>
	</table>


<?php }
function zkr_profile_upload_js() {
?><script type="text/javascript">
	jQuery(document).ready(function() {
	jQuery(document).find("input[id^='uploadimage']").live('click', function(){
	//var num = this.id.split('-')[1];
	formfield = jQuery('#image').attr('name');
	tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

	window.send_to_editor = function(html) {
	imgurl = jQuery('img',html).attr('src');
	jQuery('#image').val(imgurl);
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
}





// remove default sidebars and widgets //
function remove_some_widgets(){
    unregister_sidebar( 'sidebar-1' );
    unregister_sidebar( 'sidebar-2' );
    unregister_sidebar( 'sidebar-3' );
	unregister_widget( 'WP_Widget_Pages' );
	unregister_widget( 'WP_Widget_Calendar' );
	// unregister_widget( 'WP_Widget_Archives' );
	unregister_widget( 'WP_Widget_Links' );
	unregister_widget( 'WP_Widget_Meta' );
	unregister_widget( 'WP_Widget_Search' );
	// unregister_widget( 'WP_Widget_Recent_Posts' );
	// unregister_widget( 'WP_Widget_Recent_Comments' );
	unregister_widget( 'WP_Widget_RSS' );
	// unregister_widget( 'WP_Widget_Tag_Cloud' );
	unregister_widget( 'WP_Nav_Menu_Widget' );
	// unregister_widget( 'WP_Widget_Text' );
	// unregister_widget( 'WP_Widget_Categories' );
}
add_action( 'widgets_init', 'remove_some_widgets', 11 );

 // register sidebars for different pages and blog //
if ( function_exists('register_sidebar') )
    register_sidebar( array(
   'name' => __( 'Home Page'),
   'id' => 'testimonial',
   'description' => __( 'Sidebar for home page', 'twentytwelve' ),
   'before_widget' => '<aside id="%1$s" class="widget %2$s">',
   'after_widget' => "</aside>",
   'before_title' => '<h3 class="widget-title">',
   'after_title' => '</h3>',
   ) );

   register_sidebar( array(
   'name' => __( 'Other Pages'),
   'id' => 'testimonialcontact',
   'description' => __( 'Sidebar for all other pages', 'twentytwelve' ),
   'before_widget' => '<aside id="%1$s" class="widget %2$s">',
   'after_widget' => "</aside>",
   'before_title' => '<h3 class="widget-title">',
   'after_title' => '</h3>',
   ) );

   register_sidebar( array(
   'name' => __( 'Blog Pages'),
   'id' => 'blogsidebar',
   'description' => __( 'Sidebar for blog pages: blogroll, categories, tags, archives, and single posts', 'twentytwelve' ),
   'before_widget' => '<aside id="%1$s" class="widget %2$s">',
   'after_widget' => "</aside>",
   'before_title' => '<h3 class="widget-title">',
   'after_title' => '</h3>',
   ) );

   // Cookies Widget Area in Header //
if ( function_exists('register_sidebar') )
    register_sidebar( array(
   'name' => __( 'Cookies Notice'),
   'id' => 'cookies',
   'description' => __( 'Drag Google Analytics Cookies Notice here if running Google Analytics on your blog.', 'twentytwelve' ),
   'before_widget' => '<div class="cookies">',
   'after_widget' => '</div>',
   ) );



// Custom Cookies Widget  //
class analytics_widget extends WP_Widget {

function __construct() {
	parent::__construct(
	// Base ID of your widget
	'analytics_widget',
	// Widget name will appear in UI
	__('Google Analytics Cookies Notice', 'analytics_widget_domain'),
	// Widget description
	array( 'description' => __( 'Add your Cookies Notice here', 'analytics_widget_domain' ), )
	);
}

// Creating widget front-end
// This is where the action happens
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


// Widget Backend
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

// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'content' ); ?>"><?php _e( 'Content:' ); ?></label>
<textarea class="widefat" id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" cols="20" rows="5"><?php echo esc_attr( $content ); ?></textarea>
<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Link to Privacy Policy Page:' ); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" />
</p>
<?php
}

// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
	$instance = array();
	$instance['content'] = ( ! empty( $new_instance['content'] ) ) ? strip_tags( $new_instance['content'] ) : '';
	$instance['link'] = ( ! empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';
return $instance;
}
} // Class analytics_widget ends here

// Register and load the widget
function analytics_load_widget() {
	register_widget( 'analytics_widget' );
}
add_action( 'widgets_init', 'analytics_load_widget' );













// add google maps to contact page //
function google_maps() {
	if (is_page_template('page-templates/contact.php')){
		echo '<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDApA44NzVrUmgronW53dRcmNGvJsiiepY&amp;sensor=false" type="text/javascript"></script>';
		// wp_enqueue_script('brentford', get_stylesheet_directory_uri(). '/js/contact/brentford.js');

		wp_enqueue_script('ealing', get_stylesheet_directory_uri(). '/js/contact/ealing.js#asyncload', '', '1.0', true);
  		wp_enqueue_script('richmond', get_stylesheet_directory_uri(). '/js/contact/richmond.js#asyncload', '', '1.0', true);
  		wp_enqueue_script('central-london', get_stylesheet_directory_uri(). '/js/contact/central-london.js#asyncload', '', '1.0', true);
  		wp_enqueue_script('northfields', get_stylesheet_directory_uri(). '/js/contact/northfields.js#asyncload', '', '1.0', true);
		wp_enqueue_script('hammersmith', get_stylesheet_directory_uri(). '/js/contact/hammersmith.js#asyncload', '', '1.0', true);

		//wp_enqueue_script('able-maps', get_stylesheet_directory_uri(). '/js/able-maps.min.js'); - future attempt to combine maps
		// http://stackoverflow.com/questions/4074520/how-to-display-multiple-google-maps-per-page-with-api-v3
	 }
}
add_action('wp_head', 'google_maps');



// add logo in login panel and style it //
function my_login_logo() { ?>
    <style type="text/css">
        #login{font-family:'Source Sans Pro',sans-serif;}
		#loginform, #loginform a,
		#loginform input[type="submit"] {font-family:'Asap', sans-serif;font-weight:700;}
		#login h1 a {
            background-image: url(<?php echo get_bloginfo( 'stylesheet_directory' ) ?>/images/login-logo.png);
			background-size:cover;
			width:320px;
			height:176px;
        }
		#loginform, #loginform a {color:rgba(119, 115, 115, 1);}
		#loginform input[type="submit"] {display:block;background-color:rgba(112, 191, 68, 1);color:white;background-image:none;box-shadow:none;border-radius:0;border:0;padding:5px 10px;font-size:14px;line-height:14px;font-weight:700;font-family:Asap,sans-serif;transition:background-color ease-in-out 0.3s;}
		#loginform input[type="submit"]:hover,
		#loginform input[type="submit"]:focus,
		#loginform input[type="submit"]:active {background-color:rgba(119, 115, 115, 1);color:white;}
		.login #nav a, .login #backtoblog a {text-decoration:none;color:rgba(112, 191, 68, 1) !important;}
    </style>
<?php }
	wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Asap:700|Source+Sans+Pro:400,400italic,700');
	wp_enqueue_style( 'googleFonts');

add_action( 'login_enqueue_scripts', 'my_login_logo' );
function my_login_logo_url() {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );
function my_login_logo_url_title() {
    return 'Able Mediation';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );






// add custom dashboard widget at the top of the dashboard //
function example_dashboard_widget_function() {
	$user = wp_get_current_user();
	if($user->user_level < 10) :
    echo "Hello <strong>" . $user->user_login . "</strong>, and welcome to the Able mediation website. Below is a link to the old <strong>Author Guide</strong>, which will show you how to publish <strong>Blog Posts</strong> which include links, images, and documents, and update your User Profile.</br></br>"."<a href='http://localhost/ABLE-mediation/wp-content/uploads/2013/08/author-guide.pdf'>"."Able Mediation Author User Guide"."</a>"."</br>";
	elseif($user->user_level > 9) :
	echo 'Hello <strong>' . $user->user_login . '</strong>, and welcome to the Able mediation website. Below is a link to the old <strong>Website Administrator Guide</strong>, which will show you how to edit the website, though some parts will no longer apply. </br></br><a href="http://localhost/ABLE-mediation/wp-content/uploads/2013/08/admin-guide.pdf">Able Mediation Website Administrator Guide</a></br></br>The new guide will cover the below topics:</br>
	<ol class="mainlist">
		<li><h3 class="guide greenspan">Plugins (installed by developer)</h3>
			<ul class="sublist">
				<li>multiple content blocks <span class="red">(new)</span></li>
				<li>ninja forms <span class="red">(new)</span></li>
				<li>easy random quotes</li>
				<li>visual biography editor (for your profile page)</li>
				<li>wp clone (for backing up the website)</li>
			</ul>
		</li>
		<li><h3 class="guide orangespan">Editing Pages</h3>
			<ul class="sublist">
				<li><strong>A summary of what you need to know:</strong></li>
				<li>Some visual clues, i.e. <span class="greenspan">highlighted text</span> have been added to help indicate where information goes</li>
				<li><strong>Meta tags</strong> Are now added in custom fields. These can be found in the page editor by checking the custom fields checkbox in the <strong>Screen Options</strong> dropdown in top right of the screen. You scroll down to bottom of page to view custom fields, and enter values for the following custom fields:</br>
				<span class="customspan metatitle">Title Tag</span>
				<span class="customspan metadescription">Meta Description</span>
				<span class="customspan metakeywords">Meta Keywords</span>
				</li>
				<li>Family mediation and Referrals pages use html anchor links, which are defined by fields in the page editor, such as: <strong>First Question ID</strong>. In order for scrolling links to work, these need to be filled in.</li>
				<li>When adding images in conatiners that are defined as images (for example, <strong>First Box Image (do not link the image)</strong> on the home page), you should make sure that the image does not have a link to the file, or anywhere else. There will be room under these images for you to add a link, for example, <strong>First Box Link</strong>.</li>
			</ul>
		</li>
		<li><h3 class="guide greyspan">User Profile Section</h3></li>
			<ul class="sublist">
				<li>In the <strong>(Users > Your Profile)</strong> section and through the user, Juliet, information that is global can be added. In other words, information that is available on all pages of site, in the header and footer. This includes:</strong></li>
				<li><span class="greyspan">Company Details</span> (address, phone numbers, company number, links to social media pages).</li>
				<li><span class="orangespan">Referral Page Button</span> (orange button in the header).</li>
				<li><span class="greenspan">Footer Logos</span> (area to add logos for affiliated organisations).</li>
			</ul>
	</ol>';
	endif;
}
function example_add_dashboard_widgets() {
	wp_add_dashboard_widget('example_dashboard_widget', 'How to use the Able Mediation Website', 'example_dashboard_widget_function');
	global $wp_meta_boxes;
	$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
	$example_widget_backup = array('example_dashboard_widget' => $normal_dashboard['example_dashboard_widget']);
	unset($normal_dashboard['example_dashboard_widget']);
	$sorted_dashboard = array_merge($example_widget_backup, $normal_dashboard);
	$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}
add_action('wp_dashboard_setup', 'example_add_dashboard_widgets' );





// my credits at bottom of admin panel //
function remove_footer_admin () {
echo 'Website Designed and Built by <a href="http://www.martinbagshaw.co.uk" target="_blank">Martin Bagshaw</a></p>';
}
add_filter('admin_footer_text', 'remove_footer_admin');
