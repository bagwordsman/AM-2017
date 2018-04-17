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

<?php
// site title
$site_title = get_bloginfo('name');
// logo
$logo_options = get_option ( 'sandbox_theme_logo_options' );
$mainlogo = $logo_options['mainlogo'];
$mainlogo_alt = $logo_options['MLalt'];
$mainlogo_width = $logo_options['MLwidth'];
$mainlogo_height = $logo_options['MLheight'];
// icons
$appletouch = $logo_options['appletouch'];
$favicon = $logo_options['favicon'];
// fixed header
$fixed = get_option ( 'sandbox_theme_header_options' );
$isFixed = $fixed['fixed_header'];
$fixedOffset = $fixed['fixed_header_offset'];
// render the logos in metadata
if ($mainlogo != '') echo '<meta content="'.$mainlogo.'" property="logo">';
if ($appletouch != '') echo '<link rel="apple-touch-icon" sizes="" href="'.$appletouch.'">';
if ($favicon != '') echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.$favicon.'">';
?>
<!--[if lt IE 9]>
<link rel="stylesheet" id="ie-css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/ie/able-ie.css" type="text/css" media="all" />
<![endif]-->
<?php wp_head(); ?>
</head>
<body <?php body_class();?>>

<?php echo '

<div class="page'. ( is_active_sidebar( 'cookies' ) ? (' has-cookie-bar') : '') . ( $isFixed ? (' fixed-header') : '') . '"' . ( $isFixed ? (' data-offset="' . $fixedOffset . '"') : '') . '>
	<div class="page-wrap">';

	// site title
	$parts = preg_split('/\s+/', $site_title);
	$able = $parts[0];
	$mediation = $parts[1];

	// header CTA
	$header_cta = get_option ( 'sandbox_theme_cta_options' );
	$cta_type = $header_cta['cta_type'];
	$cta_link = $header_cta['cta_link'];
	$cta_text = $header_cta['cta_text'];
	$cta_colour = $header_cta['cta_colour'];
	
	// phone CTA
	$company_options = get_option ( 'sandbox_theme_company_options' );
	$phone = $company_options['company_phone'];
	// convert phone to dialable number
	$search = array(' ', '(', ')', '-');
	$replace = array('', '', '', '');
	$dial = str_replace($search, $replace, $phone);


	// determine the type of Call to Action
	if ($cta_type !== 'none') {
		$cta = '<div class="nine columns contact">';

		// phone
		if ($cta_type == 'phone') {
			$cta = $cta . '<a class="button '.$cta_colour.' solid phone" href="tel:'.$dial.'" title="call us">Call Us<span class="phone--number">'.$phone.'</span></a>';
		}
		// other
		else {
			$cta = $cta . '<a class="button '.$cta_colour.' solid" href="'.$cta_link.'" title="'.$cta_text.'">'.$cta_text.'</a>';
		}
		$cta = $cta . '</div><!-- nine columns -->';
	}


	// may need to look at logo size for new header - could use an svg, or bg image
	echo '
		<div class="header" role="banner">

			<div class="container">
				<div class="three columns logo">
					<a class="logo" href="' . esc_url( home_url( '/' ) ) . '">' .
						( $mainlogo ? ('<img src="' . $mainlogo .'" alt="'. $mainlogo_alt .'" width="'. $mainlogo_width .'" height="' . $mainlogo_height .'" />')  : '<img src="'. get_bloginfo('stylesheet_directory'). '/img/AM-logo.png" alt="'. $site_title .'" width="200" height="113" />' ) . '
						<div class="site-title"><span>' . $able .' </span>' . $mediation . '</div>
					</a>
				</div><!-- three columns -->' . $cta . '
				
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

