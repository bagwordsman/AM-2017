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
		
		<div class="quick-links" id="quick-links">
			<h3>Able Mediation Theme Settings</h3>
			<div>
				<p>Quick Links:</p>
				<div class="first">
					<p><strong>Header and Footer Settings</strong></p>
					<ul class="admin-list">
						<li><a href="#details">Company Details</a></li>
						<li><a href="#logos">Company Logos</a></li>
						<li><a href="#cta">Header Button / Call to Action</a></li>
						<li><a href="#social">Social Networks</a></li>
						<li><a href="#tweet">Tweet(s) in Footer</a></li>
						<li><a href="#affiliates">Affiliate Logos</a></li>
						<li><a href="#styling">Header and Footer Hero Styling</a></li>
					</ul>
				</div>

				<div>
					<p><strong>In Page Settings</strong></p>
					<ul class="admin-list">
						<li><a href="#gmap">Google Map</a></li>
						<li><a href="#blog">Blog Settings</a></li>
					</ul>
				</div>

				<div>
					<p><strong>Other Functionality</strong></p>
					<ul class="admin-list">
						<li><a href="#analytics">Google Analytics</a></li>
						<li><a href="#lazyload">Lazyloading</a></li>
						<li><a href="#header">Fixed Header</a></li>
					</ul>
				</div>
			</div>

		</div>
		

        <div class="in-header-and-footer">
		<?php settings_errors(); ?>
			
			<h1>Header and Footer Settings</h1>
			
			<!-- 1 - company details -->
			<form method="post" action="options.php" class="first wide" id="details">
				<?php settings_fields( 'sandbox_theme_company_options' ); ?>
				<?php do_settings_sections( 'sandbox_theme_company_options' ); ?>
				<?php submit_button('Save Company Details'); ?>
			</form>

			<!-- 2 - company logos -->
			<form method="post" action="options.php" id="logos">
				<?php settings_fields( 'sandbox_theme_logo_options' ); ?>
				<?php do_settings_sections( 'sandbox_theme_logo_options' ); ?>
				<?php submit_button('Save Company Logos'); ?>
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
				<?php submit_button('Save Social Networks'); ?>
			</form>

			<!-- 5 - tweet -->
			<form method="post" action="options.php" class="wide tweet" id="tweet">
				<?php settings_fields( 'sandbox_theme_tweet_options' ); ?>
				<?php do_settings_sections( 'sandbox_theme_tweet_options' ); ?>
				<?php submit_button('Save Tweet(s)'); ?>
			</form>

			<!-- 6 - affiliated organisations logos -->
			<form method="post" action="options.php" id="affiliates">
				<?php settings_fields( 'sandbox_theme_affiliates_options' ); ?>
				<?php do_settings_sections( 'sandbox_theme_affiliates_options' ); ?>
				<?php submit_button('Save Affiliate Logos'); ?>
			</form>

			<!-- 7 - styling options -->
			<form method="post" action="options.php" class="wide" id="styling">
				<?php settings_fields( 'sandbox_theme_styling_options' ); ?>
				<?php do_settings_sections( 'sandbox_theme_styling_options' ); ?>
				<?php submit_button('Save Header and Footer Styles'); ?>
			</form>
			<div class="divider white"></div>
		</div><!-- .in-header-and-footer -->

		<div class="in-page">
			<h1>In Page Settings</h1>
			<!-- 1 - google map of location -->
			<form method="post" action="options.php" class="first wide" id="gmap">
				<?php settings_fields( 'sandbox_theme_map_options' ); ?>
				<?php do_settings_sections( 'sandbox_theme_map_options' ); ?>
				<?php submit_button('Save Google Map'); ?>
			</form>
			<!-- 2 - blog styling -->
			<form method="post" action="options.php" class="wide" id="blog">
				<?php settings_fields( 'sandbox_theme_blog_options' ); ?>
				<?php do_settings_sections( 'sandbox_theme_blog_options' ); ?>
				<?php submit_button('Save Blog Settings'); ?>
			</form>
			<div class="divider mid-grey"></div>
		</div><!-- .in-page -->

		<div class="functionality">
			<h1>Other Functionality</h1>
			<!-- 1 - Google Analytics -->
			<form method="post" action="options.php" class="first wide google_analytics" id="analytics">
				<?php settings_fields( 'sandbox_theme_google_analytics_options' ); ?>
				<?php do_settings_sections( 'sandbox_theme_google_analytics_options' ); ?>
				<?php submit_button('Save Google Analytics'); ?>
			</form>
			<!-- 2 - lazyloading -->
			<form method="post" action="options.php" class="wide lazyloading" id="lazyload">
				<?php settings_fields( 'sandbox_theme_lazyloading_options' ); ?>
				<?php do_settings_sections( 'sandbox_theme_lazyloading_options' ); ?>
				<?php submit_button('Save Lazyloading'); ?>
			</form>
			<!-- 3 - fixed header -->
			<form method="post" action="options.php" class="wide header" id="header">
				<?php settings_fields( 'sandbox_theme_header_options' ); ?>
				<?php do_settings_sections( 'sandbox_theme_header_options' ); ?>
				<?php submit_button('Save Header Settings'); ?>
			</form>
		</div><!-- .functionality -->

    </div><!-- /.wrap -->
<?php
} // end sandbox_menu_page_display
add_filter('menu_options_filter','sandbox_menu_page_display');

?>