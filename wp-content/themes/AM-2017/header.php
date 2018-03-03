<?php
/**
 * Theme Header
 *
 * Displays all of the <head> section and everything up till <div id="main">
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>
<?php
// title tag
$title = get_the_title($post->ID);
$blogtitle = get_the_title( get_option('page_for_posts', true) );
$metatitle = get_post_meta($post->ID,'Title Tag', true);
if(is_home()) {
	echo $blogtitle;
}
else if(!is_404() && !is_home()) {
	if ($metatitle == '') {
		echo $title;
		} else {
		echo $metatitle;
		}
}
else if(is_404()) {
  echo '404: Page Not found';
}
else {
	echo $title;
}; ?>
</title>
<?php
// META DESCRIPTION
// $description = get_post_meta($post->ID, 'Meta Description', true);
$description = get_post_meta($post->ID, 'Meta Description', true) ? get_post_meta($post->ID, 'Meta Description', true) : get_bloginfo('description');
// if no description is entered in custom field, 'Meta Description', echo the site description from admin panel
echo '<meta name="description" content="'.$description.'" />';
// META KEYWORDS
$keywords = get_post_meta($post->ID, 'Meta Keywords', true);
// if keywords are entered, output the meta tag
if ($keywords == true) {
	echo '<meta name="keywords" content="'.$keywords.'" />';
}
?>
<meta content="<?php bloginfo( 'name' ); ?>" property="site title"/>


<!-- logos and favicons -->
<?php
// get site title for logo img alt text
$site_title = get_bloginfo('name');
// get logo
$logo_options = get_option ( 'sandbox_theme_logo_options' );
// Main logo - width and height
$mainlogo = $logo_options['mainlogo'];
// $mainlogo_Width = $logo_options['MLwidth'];
// $mainlogo_Width = preg_replace("/[^0-9,.]/", "", $mainlogo_Width);
// $mainlogo_Height = $logo_options['MLheight'];
// $mainlogo_Height = preg_replace("/[^0-9,.]/", "", $mainlogo_Height);
// Icons
$appletouch = $logo_options['appletouch'];
$favicon = $logo_options['favicon'];
// render the logos in metadata
if ($mainlogo != '') echo '<meta content="'.$mainlogo.'" property="logo">';
if ($appletouch != '') echo '<link rel="apple-touch-icon" sizes="" href="'.$appletouch.'">';
if ($favicon != '') echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.$favicon.'">';
?>
<!--[if lt IE 9]>
<link rel="stylesheet" id="ie-css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/ie/nmt-ie.css" type="text/css" media="all" />
<![endif]-->
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php echo '

<div class="page'. ( is_active_sidebar( 'cookies' ) ? (' has-cookie-bar') : '') .'">
	<div class="page-wrap">';
	
	// header section
	// . ( is_active_sidebar( 'cookies' ) ? (' has-cookie-bar') : '') .'" 

	// site title
	$parts = preg_split('/\s+/', $site_title);
	$able = $parts[0];
	$mediation = $parts[1];

	
	// get variables from theme options
	$company_options = get_option ( 'sandbox_theme_company_options' );
	$phone = $company_options['company_phone'];
	// convert phone to dialable number
	$search = array(' ', '(', ')', '-');
	$replace = array('', '', '', '');
	$dial = str_replace($search, $replace, $phone);


	// may need to look at logo size for new header - could use an svg, or bg image
	echo '
		<div class="header" role="banner">

			<div class="container">
				<div class="three columns logo">
					<a class="logo" href="' . esc_url( home_url( '/' ) ) . '">' .
						( $mainlogo ? ('<img src="' . $mainlogo .'" alt="'. $site_title .'" width="'. $mainlogo_Width .'" height="' . $mainlogo_Height .'" />')  : '<img src="'. get_bloginfo('stylesheet_directory'). '/img/AM-logo.png" alt="'. $site_title .'" width="200" height="113" />' ) . '
						<div class="site-title"><span>' . $able .' </span>' . $mediation . '</div>
					</a>
				</div><!-- three columns -->' .
				( $phone ? ( '<div class="nine columns contact"><a class="button orange" href="tel:'.$dial.'" title="call us"><span>Call Us:</span>'.$phone.'</a></div><!-- nine columns -->' )  : '') . '
			</div><!-- container -->

			<div class="nav" role="navigation">
				<input id="toggle" type="checkbox">
				<label class="main-toggle" onclick="" for="toggle"></label>
				<a class="assistive-text" href="#content" title="Skip to content">Skip to content</a>
				<ul class="main-menu">';
				// function to remove <div> and <ul> which wrap the menu by default
				wp_nav_menu_unwrap();
				echo '
				</ul>
			</div><!-- .nav -->

		</div><!-- .header -->
		';

	
	// cookies
	if (!preg_match('/(site url)/', $_SERVER['HTTP_REFERER'])) {
		if ( is_active_sidebar( 'cookies' ) ) {
			dynamic_sidebar( 'cookies' );
		}
	}


	?>

