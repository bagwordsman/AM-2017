<?php
// ------------------------------------------------------------------------
// 3 - Create Theme Options Page
// 1) Company Options
// 2) logo Options
// 3) Social Options
// 4) Tweet
// 5) Styling Options
// 5) affiliates Options


// ------------------------------------------------------------------------
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




?>
