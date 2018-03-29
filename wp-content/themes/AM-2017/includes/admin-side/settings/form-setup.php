<?php
// form setup
// - create page + tab, form skeleton

// 1 -  create page
function sandbox_create_menu_page() {
    add_menu_page(
        'Able Mediation Theme Options', // page title
        'Able Mediation Theme Settings', // tab title
        'manage_options', // user permissions > what level can see this admin page
        'sandbox', // ID / slug - for this menu item
        'sandbox_menu_page_display', // function to call when rendering this page menu
        'dashicons-admin-tools' // tab icon
    );
} // end sandbox_create_menu_page
add_action('admin_menu', 'sandbox_create_menu_page');


// 2 - create form
function sandbox_menu_page_display() {
?>
    <div class="wrap AM2017--options">
        <!-- <div id="icon-themes" class="icon32"></div> -->
        <h2>Able Mediation Theme Options</h2>

        <div class="in-header-and-footer">
		<?php settings_errors(); ?>
			
			<h1>Header and Footer Options</h1>
			
			<!-- 1 - company details -->
			<form method="post" action="options.php" class="first wide" id="details">
				<?php settings_fields( 'sandbox_theme_company_options' ); ?>
				<?php do_settings_sections( 'sandbox_theme_company_options' ); ?>
				<?php submit_button('Save Changes to Company Details'); ?>
			</form>

			<!-- 2 - company logos -->
			<form method="post" action="options.php" id="logos">
				<?php settings_fields( 'sandbox_theme_logo_options' ); ?>
				<?php do_settings_sections( 'sandbox_theme_logo_options' ); ?>
				<?php submit_button('Save Changes to Your Company Logos'); ?>
			</form>

			<!-- 3 - header call to action -->
			<form method="post" action="options.php" id="cta">
				<?php settings_fields( 'sandbox_theme_cta_options' ); ?>
				<?php do_settings_sections( 'sandbox_theme_cta_options' ); ?>
				<?php submit_button('Save Header Call to Action'); ?>
			</form>

			<!-- 4 - social network links -->
			<form method="post" action="options.php" id="social">
				<?php settings_fields( 'sandbox_theme_social_options' ); ?>
				<?php do_settings_sections( 'sandbox_theme_social_options' ); ?>
				<?php submit_button('Save Changes to Social Options'); ?>
			</form>

			<!-- 5 - tweet -->
			<form method="post" action="options.php" class="wide tweet" id="tweet">
				<?php settings_fields( 'sandbox_theme_tweet_options' ); ?>
				<?php do_settings_sections( 'sandbox_theme_tweet_options' ); ?>
				<?php submit_button('Display Tweet(s)'); ?>
			</form>

			<!-- 6 - affiliated organisations logos -->
			<form method="post" action="options.php" id="affiliates">
				<?php settings_fields( 'sandbox_theme_affiliates_options' ); ?>
				<?php do_settings_sections( 'sandbox_theme_affiliates_options' ); ?>
				<?php submit_button('Save Changes to Affiliated Organisations Logos'); ?>
			</form>

			<!-- 7 - styling options -->
			<form method="post" action="options.php" class="wide" id="styling">
				<?php settings_fields( 'sandbox_theme_styling_options' ); ?>
				<?php do_settings_sections( 'sandbox_theme_styling_options' ); ?>
				<?php submit_button('Save Changes to Your Styling Options'); ?>
			</form>
			<div class="divider white"></div>
		</div><!-- .in-header-and-footer -->

		<div class="in-page">
			<h1>In Page Options</h1>
			<!-- 1 - google map of location -->
			<form method="post" action="options.php" class="first wide" id="gmap">
				<?php settings_fields( 'sandbox_theme_map_options' ); ?>
				<?php do_settings_sections( 'sandbox_theme_map_options' ); ?>
				<?php submit_button('Save Changes to Your Google Map'); ?>
			</form>
			<!-- 2 - blog styling -->
			<form method="post" action="options.php" class="wide" id="blog">
				<?php settings_fields( 'sandbox_theme_blog_options' ); ?>
				<?php do_settings_sections( 'sandbox_theme_blog_options' ); ?>
				<?php submit_button('Save Changes to Blog Styling'); ?>
			</form>
			<div class="divider mid-grey"></div>
		</div><!-- .in-page -->

		<div class="functionality">
			<h1>Functionality Options</h1>
			<!-- 1 - Google Analytics -->
			<form method="post" action="options.php" class="first wide google_analytics" id="analytics">
				<?php settings_fields( 'sandbox_theme_google_analytics_options' ); ?>
				<?php do_settings_sections( 'sandbox_theme_google_analytics_options' ); ?>
				<?php submit_button('Apply Google Analytics'); ?>
			</form>
			<!-- 2 - lazyloading -->
			<form method="post" action="options.php" class="wide lazyloading" id="lazyload">
				<?php settings_fields( 'sandbox_theme_lazyloading_options' ); ?>
				<?php do_settings_sections( 'sandbox_theme_lazyloading_options' ); ?>
				<?php submit_button('Enable Lazyloading'); ?>
			</form>
			<!-- 3 - fixed header -->
			<form method="post" action="options.php" class="wide header" id="header">
				<?php settings_fields( 'sandbox_theme_header_options' ); ?>
				<?php do_settings_sections( 'sandbox_theme_header_options' ); ?>
				<?php submit_button('Save Header Options'); ?>
			</form>
		</div><!-- .functionality -->

    </div><!-- /.wrap -->
<?php
} // end sandbox_menu_page_display
add_filter('menu_options_filter','sandbox_menu_page_display');

?>