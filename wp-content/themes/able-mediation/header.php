<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<!--<meta name="google-site-verification" content="6Zk7qrlPn49rq2PXj139zbeDcXE0JQa32_nn8b3d79s" />-->
<title>
<?php // title tag
$blogtitle = get_post_meta(14,'Title Tag',true);
$title = get_post_meta($post->ID,'Title Tag', true);
if(is_home()) {
	echo $blogtitle;
}
else if(!is_404() && !is_home()) {
	if ($title == '') {
		wp_title( '|', true, 'right' );
		} else {
		echo $title;
		}
}
else {
	wp_title( '|', true, 'right' );
}; ?>
</title>

<?php // meta description
$blogdescription = get_post_meta(14, 'Meta Description', true);
$description = get_post_meta($post->ID, 'Meta Description', true);
if(is_home()) {
	echo '<meta name="description" content="'.$blogdescription.'" />';
}
else if(!is_404() && !is_home()) {
	if ($description == '') {
		echo '<meta name="description" content="'.get_bloginfo('name').', '.get_bloginfo('description').', '.get_the_title().' Page'.'" />';
		} else {
		echo '<meta name="description" content="'. $description. '" />';
	}
}; ?>

<?php // meta keywords
$blogkeywords = get_post_meta(14, 'Meta Keywords', true);
$keywords = get_post_meta($post->ID, 'Meta Keywords', true);
if(is_home()) {
	echo '<meta name="keywords" content="'.get_bloginfo('name').', '.$blogkeywords.'" />';
}
else if(!is_404() && !is_home()) {
	if ($keywords == '') {
		echo '<meta name="keywords" content="'.get_bloginfo('name').', '.get_bloginfo('description').', '.get_the_title().'" />';
		} else {
		echo '<meta name="keywords" content="'. $keywords. '" />';
	}
}; ?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!-- Load css and print shiv for ie8 and below -->
<!--[if lt IE 9]>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/lib/html5-print.js" type="text/javascript"></script>
<link rel="stylesheet" id="ie-css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/ie.css" type="text/css" media="all" />
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if ( is_active_sidebar( 'cookies' ) ){
		dynamic_sidebar( 'cookies' );
	} ?>
<div id="page" class="hfeed site">

	<header id="masthead" role="banner">

        <div class="wrapper">
        	<div id="branding">
            	<div id="logo">
                	<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/able-logo_sm.png" alt="Able Mediation" title="Able Mediation" width="80" height="55" /></a>
            	</div><!-- #logo -->
            	<div id="title">
            		<h1><?php $completeName = get_bloginfo('name');
					$nameParts = explode(" ", $completeName, 2);
					echo '<span class="able">'.$nameParts[0]. "\n" .'</span>'.$nameParts[1];?></h1>
            	</div><!-- #title -->
        	</div><!-- #branding -->

					<!--<img src="'. get_bloginfo('stylesheet_directory') .'/images/icons/phone.png" alt="phone us" width="21" height="21" />-->


        	<div id="contact">
        	<?php $phone = get_the_author_meta('phone',1);
			 	  $mobilephone = get_the_author_meta('mobilephone',1);
			 	  $email = get_the_author_meta('user_email',1);
			 	  $referrallink = get_the_author_meta('referrallink',1);
			 	  $referraltext = get_the_author_meta('referraltext',1);
				  $referralnewtab = get_the_author_meta('referralnewtab',1);

            	if ($phone != '' || $mobilephone != '' || $email != '') echo '
                <div class="left">
                	<ul class="contact">';?>

					<?php if ($phone != '') echo '
						<li><i class="fa fa-phone" aria-hidden="true"></i>'.$phone.'</li>'; ?>

					<?php if ($mobilephone != '') echo '
						<li><i class="fa fa-phone" aria-hidden="true"></i>'.$mobilephone.'</li>'; ?>

					<?php if ($email != '') echo '
						<li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:'.$email.'" title="email us">'.$email.'</a></li>'; ?>

            	<?php if ($phone != '' || $mobilephone != '' || $email != '') echo '
                	</ul>
                </div>';?>

            	<?php if ($referrallink != '' && $referraltext != '' && (!empty($referralnewtab))) echo '
				<div class="right">
					<a class="button orange" href="'.$referrallink.'" target="_blank">'.$referraltext.'</a>
				</div>';
					if ($referrallink != '' && $referraltext != '' && (empty($referralnewtab))) echo '
				<div class="right">
					<a class="button orange" href="'.$referrallink.'">'.$referraltext.'</a>
				</div>'; ?>

        	</div><!-- #contact -->
		</div><!-- .wrapper -->



		<nav id="site-navigation" class="main-navigation" role="navigation">
			<h3 class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></h3>
			<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
		</nav><!-- #site-navigation -->


	</header><!-- #masthead -->

<div id="main" class="wrapper">
