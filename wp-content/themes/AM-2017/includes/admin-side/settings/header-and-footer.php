<?php
// header and footer

// File Contents:

// 1 - company details
// 2 - company logos
// 3 - header call to action
// 4 - social network links
// 5 - tweet
// 6 - affiliated organisations logos
// 7 - styling options
// + sanitise everything
// + generic callback functions saved in separate include

// back button - remember: do not duplicate functions!
function back_btn() {
	echo '<div style="margin-bottom : 20px;"><a class="button small" href="#quick-links">Back to top<i class="fa fa-chevron-up" aria-hidden="true"></i></a></div>';
}


// _______________________________________________________
// 1 - company details
function sandbox_theme_intialize_company_options() {
	// if company options don't exist, create them.
    if (false == get_option('sandbox_theme_company_options')) {
        add_option( 'sandbox_theme_company_options' );
    }
	add_settings_section(
    	'company_settings_section', // section ID
    	'Company Details', // section title
    	'sandbox_company_options_callback', // callback
    	'sandbox_theme_company_options' // add to settings page
	);
	add_settings_field(
    	'company_name',
    	'<i class="fa fa-tag" aria-hidden="true"></i>Company Name',
    	'text_callback',
    	'sandbox_theme_company_options',
		'company_settings_section',
		array( // $args array - tailor text_callback
			'company_name',
			'sandbox_theme_company_options'
		)
	);
	add_settings_field(
    	'company_number',
    	'<i class="fa fa-hashtag" aria-hidden="true"></i>Company Number',
    	'text_callback',
    	'sandbox_theme_company_options',
		'company_settings_section',
		array( // $args array - tailor text_callback
			'company_number',
			'sandbox_theme_company_options'
		)
	);
	add_settings_field(
    	'company_address',
    	'<i class="fa fa-home" aria-hidden="true"></i>Company Address',
    	'text_callback',
    	'sandbox_theme_company_options',
		'company_settings_section',
		array( // $args array - tailor text_callback
			'company_address',
			'sandbox_theme_company_options'
		)
	);
	add_settings_field(
    	'company_phone',
    	'<i class="fa fa-phone" aria-hidden="true"></i>Company Phone',
    	'text_callback',
    	'sandbox_theme_company_options',
		'company_settings_section',
		array( // $args array - tailor text_callback
			'company_phone',
			'sandbox_theme_company_options'
		)
	);
	add_settings_field(
    	'company_email',
    	'<i class="fa fa-envelope" aria-hidden="true"></i>Company Email',
    	'text_callback',
    	'sandbox_theme_company_options',
		'company_settings_section',
		array( // $args array - tailor text_callback
			'company_email',
			'sandbox_theme_company_options'
		)
	);
	register_setting(
    	'sandbox_theme_company_options',
    	'sandbox_theme_company_options',
    	'header_footer_sanitize'
	);
}
add_action( 'admin_init', 'sandbox_theme_intialize_company_options' );


// callback: message
function sandbox_company_options_callback() {
    echo '<p>Type in your company details</p>';
}








// _______________________________________________________
// 2 - company logos
function sandbox_theme_intialize_logo_options() {
    // if logo options don't exist, create them.
    if( false == get_option( 'sandbox_theme_logo_options' ) ) {
        add_option( 'sandbox_theme_logo_options' );
    }
	add_settings_section(
    	'logo_settings_section', // section ID
    	'Company Logos', // section title
    	'sandbox_logo_options_callback', // callback
    	'sandbox_theme_logo_options' // add to settings page
	);
	add_settings_field(
    	'mainlogo',
    	'Main Logo',
    	'sandbox_mainlogo_callback',
    	'sandbox_theme_logo_options',
    	'logo_settings_section'
	);
	add_settings_field(
		'MLalt',
		'',
		'alt_text_callback',
		'sandbox_theme_logo_options',
    	'logo_settings_section',
		array( // $args array - tailor the callback function
			'MLalt',
			'sandbox_theme_logo_options',
			'mainlogo'
		)
	);
	add_settings_field(
    	'MLwidth',
    	'',
    	'img_width_height_callback',
    	'sandbox_theme_logo_options',
		'logo_settings_section',
		array( // $args array - tailor the callback function
			'MLwidth',
			'sandbox_theme_logo_options',
			'mainlogo'
		)
	);
	add_settings_field(
    	'MLheight',
    	'',
    	'img_width_height_callback',
    	'sandbox_theme_logo_options',
		'logo_settings_section',
		array( // $args array - tailor the callback function
			'MLheight',
			'sandbox_theme_logo_options',
			'mainlogo'
		)
	);
	add_settings_field(
    	'appletouch',
		'Apple Touch Icon
		<div class="extra-label" style="margin-top:10px;">Square .png. 180px, 110px, or 57px</div>',
    	'sandbox_appletouch_callback',
    	'sandbox_theme_logo_options',
    	'logo_settings_section'
	);
	add_settings_field(
    	'favicon',
		'Favicon
		<span class="extra-label" style="margin-top:10px;">Square .png or .ico. 32px, or 16px</div>',
    	'sandbox_favicon_callback',
    	'sandbox_theme_logo_options',
    	'logo_settings_section'
	);
	register_setting(
    	'sandbox_theme_logo_options',
    	'sandbox_theme_logo_options',
    	'header_footer_sanitize'
	);
} // end sandbox_theme_intialize_logo_options
add_action( 'admin_init', 'sandbox_theme_intialize_logo_options' );


// callback: message
function sandbox_logo_options_callback() {
    echo '<p>'. back_btn() .'Upload or add your logos with their URL location here</p>';
}


// callback: main logo
function sandbox_mainlogo_callback() {
    $options = get_option( 'sandbox_theme_logo_options' );
    $url = '';
    if ( isset( $options['mainlogo'] ) ) {
        $url = $options['mainlogo'];
    }
	echo
	'<div class="logogroup mainlogo">
		<img class="adminlogo" src="'. get_bloginfo('stylesheet_directory'). '/img/AM-logo.png"/>
		<input type="button" class="button button-primary" value="Upload Main Company Logo" id="uploadmainlogo"/>
		<input class="invisible" type="text" id="mainlogo" name="sandbox_theme_logo_options[mainlogo]" value="' . $options['mainlogo'] . '" />
	</div>';
}


// callback: apple touch
function sandbox_appletouch_callback() {
    $options = get_option( 'sandbox_theme_logo_options' );
    $url = '';
    if ( isset( $options['appletouch'] ) ) {
        $url = $options['appletouch'];
    }
	echo
	'<div class="logogroup appletouch">
		<img class="adminlogo" src="'. get_bloginfo('stylesheet_directory'). '/img/able-apple-touch-icon.jpg"/>
		<input type="button" class="button button-primary" value="Upload Apple Touch Icon" id="uploadappletouch"/>
		<input class="invisible" type="text" id="appletouch" name="sandbox_theme_logo_options[appletouch]" value="' . $options['appletouch'] . '" />
	</div>';
}


// callback: favicon
function sandbox_favicon_callback() {
    $options = get_option( 'sandbox_theme_logo_options' );
    $url = '';
    if ( isset( $options['favicon'] ) ) {
        $url = $options['favicon'];
    }
    echo
	'<div class="logogroup favicon">
		<img class="adminlogo" src="'. get_bloginfo('stylesheet_directory'). '/img/able-favicon.jpg"/>
		<input type="button" class="button button-primary" value="Upload Favicon" id="uploadfavicon"/>
		<input class="invisible" type="text" id="favicon" name="sandbox_theme_logo_options[favicon]" value="' . $options['favicon'] . '" />
	</div>';
}







// _______________________________________________________
// 3 - header call to action
function sandbox_theme_intialize_cta_options() {
    if( false == get_option( 'sandbox_theme_cta_options' ) ) {
        add_option( 'sandbox_theme_cta_options' );
    } // end if
	add_settings_section(
    	'cta_settings_section', // section ID
    	'Header Call to Action', // section title
    	'sandbox_cta_options_callback',  // callback
    	'sandbox_theme_cta_options' // add to settings page
	);
	add_settings_field(
    	'cta_type',
    	'Type',
    	'sandbox_cta_type_callback',
    	'sandbox_theme_cta_options',
    	'cta_settings_section'
	);
	add_settings_field(
    	'cta_link',
    	'<i class="fa fa-link purple--text" aria-hidden="true"></i>Link:<br> enter a url',
    	'text_callback',
    	'sandbox_theme_cta_options',
		'cta_settings_section',
		array( // $args array - tailor text_callback
			'cta_link',
			'sandbox_theme_cta_options'
		)
	);
	add_settings_field(
    	'cta_text',
    	'<i class="fa fa-header" aria-hidden="true"></i>Text:<br> enter button text',
    	'text_callback',
    	'sandbox_theme_cta_options',
		'cta_settings_section',
		array( // $args array - tailor text_callback
			'cta_text',
			'sandbox_theme_cta_options'
		)
	);
	add_settings_field(
    	'cta_colour',
    	'<i class="fa fa-paint-brush blue" id="bg-colour-brush" aria-hidden="true"></i>Colour',
    	'sandbox_cta_colour_callback',
    	'sandbox_theme_cta_options',
    	'cta_settings_section'
	);
	register_setting(
    	'sandbox_theme_cta_options',
    	'sandbox_theme_cta_options',
    	'header_footer_sanitize'
	);
} // end sandbox_theme_intialize_social_options
add_action( 'admin_init', 'sandbox_theme_intialize_cta_options' );


// callback: header cta instruction text
function sandbox_cta_options_callback() {
    echo '<p>'. back_btn() .'Configure the Call to Action button in the header.</p>';
}


// callback: header cta type
function sandbox_cta_type_callback() {
    $options = get_option( 'sandbox_theme_cta_options' );
    if ( isset( $options['cta_type'] ) ) {
        $options['cta_type'];
    }
    echo '
	<ul id="cta_type">
		<li>
			<input type="radio" id="cta_type_phone" name="sandbox_theme_cta_options[cta_type]" value="phone" '. ( $options['cta_type'] == 'phone' ? ('checked="checked" class="green--background"')  : '') .' />
			<label for="cta_type_phone">Phone (populated automatically)</label>
		</li>
		<li>
			<input type="radio" id="cta_type_other" name="sandbox_theme_cta_options[cta_type]" value="other" '. ( $options['cta_type'] == 'other' ? ('checked="checked" class="green--background"')  : '') .' />
			<label for="cta_type_other">Other (enter details below)</label>
		</li>
		<li>
			<input type="radio" id="cta_type_none" name="sandbox_theme_cta_options[cta_type]" value="none" '. ( $options['cta_type'] == 'none' ? ('checked="checked" class="green--background"')  : '') .' />
			<label for="cta_type_none">No Call to Action</label>
		</li>
	</ul>
	';
} // end sandbox_cta_link_callback


// callback: header cta colour
function sandbox_cta_colour_callback() {
    $options = get_option( 'sandbox_theme_cta_options' );
    if ( isset( $options['cta_colour'] ) ) {
        $options['cta_colour'];
    }
    echo '
	<ul id="cta_colour">
		<li>
			<input type="radio" id="cta_colour_green" name="sandbox_theme_cta_options[cta_colour]" value="green" '. ( $options['cta_colour'] == 'green' ? ('checked="checked" class="green--background"')  : '') .' />
			<label for="cta_colour_green">Green</label>
		</li>
		<li>
			<input type="radio" id="cta_colour_orange" name="sandbox_theme_cta_options[cta_colour]" value="orange" '. ( $options['cta_colour'] == 'orange' ? ('checked="checked" class="green--background"')  : '') .' />
			<label for="cta_colour_orange">Orange</label>
		</li>
		<li>
			<input type="radio" id="cta_colour_blue" name="sandbox_theme_cta_options[cta_colour]" value="blue" '. ( $options['cta_colour'] == 'blue' ? ('checked="checked" class="green--background"')  : '') .' />
			<label for="cta_colour_blue">Blue</label>
		</li>
		<li>
			<input type="radio" id="cta_colour_red" name="sandbox_theme_cta_options[cta_colour]" value="red" '. ( $options['cta_colour'] == 'red' ? ('checked="checked" class="green--background"')  : '') .' />
			<label for="cta_colour_red">Red</label>
		</li>
	</ul>
	';
}






// _______________________________________________________
// 4 - social network links
function sandbox_theme_intialize_social_options() {
    // if social options don't exist, create them.
    if( false == get_option( 'sandbox_theme_social_options' ) ) {
        add_option( 'sandbox_theme_social_options' );
    } // end if
	add_settings_section(
    	'social_settings_section', // section ID
    	'Social Networks', // section title
    	'sandbox_social_options_callback', // callback
    	'sandbox_theme_social_options' // add to settings page
	);
	add_settings_field(
    	'facebook',
    	'<i class="fa fa-facebook" aria-hidden="true"></i>Facebook',
    	'text_callback',
    	'sandbox_theme_social_options',
		'social_settings_section',
		array( // $args array - tailor text_callback
			'facebook',
			'sandbox_theme_social_options'
		)
	);
	add_settings_field(
		'twitter',
		'<i class="fa fa-twitter" aria-hidden="true"></i>Twitter',
		'text_callback',
		'sandbox_theme_social_options',
		'social_settings_section',
		array( // $args array - tailor text_callback
			'twitter',
			'sandbox_theme_social_options'
		)
	);
	add_settings_field(
    	'googleplus',
    	'<i class="fa fa-google-plus" aria-hidden="true"></i>Google+',
    	'text_callback',
    	'sandbox_theme_social_options',
		'social_settings_section',
		array( // $args array - tailor text_callback
			'googleplus',
			'sandbox_theme_social_options'
		)
	);
	add_settings_field(
    	'linkedin',
    	'<i class="fa fa-linkedin" aria-hidden="true"></i>Linkedin',
    	'text_callback',
    	'sandbox_theme_social_options',
		'social_settings_section',
		array( // $args array - tailor text_callback
			'linkedin',
			'sandbox_theme_social_options'
		)
	);
	register_setting(
    	'sandbox_theme_social_options',
    	'sandbox_theme_social_options',
    	'header_footer_sanitize'
	);
} // end sandbox_theme_intialize_social_options
add_action( 'admin_init', 'sandbox_theme_intialize_social_options' );


// callback: social networks message
function sandbox_social_options_callback() {
    echo '<p>'. back_btn() .'Provide the URLs to the social networks you\'d like to display.</p>';
}









// _______________________________________________________
// 5 - tweet
function sandbox_theme_intialize_tweet_options() {
    // if tweet options don't exist, create them.
    if( false == get_option( 'sandbox_theme_tweet_options' ) ) {
        add_option( 'sandbox_theme_tweet_options' );
    }
	add_settings_section(
    	'tweet_settings_section', // Section ID
    	'Show Latest Tweet(s) <i class="fa fa-twitter" aria-hidden="true"></i>', // section title
    	'sandbox_tweet_options_callback', // callback
    	'sandbox_theme_tweet_options' // add to settings page
	);
	add_settings_field(
    	'twitter_heading',
    	'<i class="fa fa-header black--text" aria-hidden="true"></i>Twitter Feed Heading',
    	'text_callback',
    	'sandbox_theme_tweet_options',
		'tweet_settings_section',
		array( // $args array - tailor text_callback
			'twitter_heading',
			'sandbox_theme_tweet_options'
		)
	);
	add_settings_field(
    	'twitter_profile',
    	'<i class="fa fa-at" aria-hidden="true"></i>Twitter Handle',
    	'text_callback',
    	'sandbox_theme_tweet_options',
		'tweet_settings_section',
		array( // $args array - tailor text_callback
			'twitter_profile',
			'sandbox_theme_tweet_options'
		)
	);
	add_settings_field(
    	'twitter_user',
    	'<i class="fa fa-user" aria-hidden="true"></i>Twitter User Name',
    	'text_callback',
    	'sandbox_theme_tweet_options',
		'tweet_settings_section',
		array( // $args array - tailor text_callback
			'twitter_user',
			'sandbox_theme_tweet_options'
		)
	);
	// API settings
	// - key
	add_settings_field(
    	'twitter_consumer_key',
    	'<i class="fa fa-key light-grey--text" aria-hidden="true"></i>Consumer Key',
    	'text_callback',
    	'sandbox_theme_tweet_options',
		'tweet_settings_section',
		array( // $args array - tailor text_callback
			'twitter_consumer_key',
			'sandbox_theme_tweet_options'
		)
	);
	add_settings_field(
    	'twitter_consumer_key_secret',
    	'<i class="fa fa-user-secret black--text" aria-hidden="true"></i>Consumer Key Secret',
    	'text_callback',
    	'sandbox_theme_tweet_options',
		'tweet_settings_section',
		array( // $args array - tailor text_callback
			'twitter_consumer_key_secret',
			'sandbox_theme_tweet_options'
		)
	);
	// - token
	add_settings_field(
    	'twitter_access_token',
    	'<i class="fa fa-circle yellow--text" aria-hidden="true"></i>Access Token',
    	'text_callback',
    	'sandbox_theme_tweet_options',
		'tweet_settings_section',
		array( // $args array - tailor text_callback
			'twitter_access_token',
			'sandbox_theme_tweet_options'
		)
	);
	add_settings_field(
    	'twitter_access_token_secret',
    	'<i class="fa fa-user-secret black--text" aria-hidden="true"></i>Access Token Secret',
    	'text_callback',
    	'sandbox_theme_tweet_options',
		'tweet_settings_section',
		array( // $args array - tailor text_callback
			'twitter_access_token_secret',
			'sandbox_theme_tweet_options'
		)
	);

	// Tweet Count
	add_settings_field(
    	'twitter_tweet_count',
    	'<i class="fa fa-twitter orig" aria-hidden="true"></i>Number of Tweets to Display',
    	'sandbox_twitter_tweet_count_callback',
    	'sandbox_theme_tweet_options',
    	'tweet_settings_section'
	);
	register_setting(
    	'sandbox_theme_tweet_options',
    	'sandbox_theme_tweet_options',
    	'header_footer_sanitize'
	);
} // end sandbox_theme_intialize_tweet_options
add_action( 'admin_init', 'sandbox_theme_intialize_tweet_options' );


// callback: tweet message
function sandbox_tweet_options_callback() {
    echo '<p>'. back_btn() .'Display your latest Tweets in the footer. Please note that more settings (which are currently hard-coded) are required to do this.</p>';
}

// callback: number of tweets
function sandbox_twitter_tweet_count_callback() {
    $options = get_option( 'sandbox_theme_tweet_options' );
    if ( isset( $options['twitter_tweet_count'] ) ) {
        $options['twitter_tweet_count'];
    }
    echo '
    <select id="twitter_tweet_count" name="sandbox_theme_tweet_options[twitter_tweet_count]" ' . selected( isset( $options['twitter_tweet_count'] ) ? $options['twitter_tweet_count'] : false ) . '>
        <option value="one" '. ( $options['twitter_tweet_count'] == one ? ('selected="selected" class="green--background"')  : '') .' >one</option>
		<option value="two" '. ( $options['twitter_tweet_count'] == two ? ('selected="selected" class="green--background"')  : '') .' >two</option>
		<option value="three" '. ( $options['twitter_tweet_count'] == three ? ('selected="selected" class="green--background"')  : '') .' >three</option>
    </select>
    ';
}






// _______________________________________________________
// 6 - affiliated organisations logos
// each affiliate logo needs width and height applied to it
function sandbox_theme_intialize_affiliates_options() {
    // if affiliates options don't exist, create them.
    if( false == get_option( 'sandbox_theme_affiliates_options' ) ) {
        add_option( 'sandbox_theme_affiliates_options' );
    } // end if
	add_settings_section(
    	'affiliates_settings_section', // section ID
    	'Affiliated Organisations Logos', // section title
    	'sandbox_affiliates_options_callback', // callback
    	'sandbox_theme_affiliates_options' // add to settings page
	);
	// affiliates title
	add_settings_field(
    	'ouraffiliatestitle',
    	'Affiliated Organisations Logos - Title',
    	'text_callback',
    	'sandbox_theme_affiliates_options',
		'affiliates_settings_section',
		array( // $args array - tailor text_callback
			'ouraffiliatestitle',
			'sandbox_theme_affiliates_options'
		)
	);

	// output logo fields
	$one = new affiliateLogos(1);
	$one->add_fields();

	$two = new affiliateLogos(2);
	$two->add_fields();

	$three = new affiliateLogos(3);
	$three->add_fields();

	$four = new affiliateLogos(4);
	$four->add_fields();

	$five = new affiliateLogos(5);
	$five->add_fields();

	$six = new affiliateLogos(6);
	$six->add_fields();

	register_setting(
    	'sandbox_theme_affiliates_options',
    	'sandbox_theme_affiliates_options',
    	'header_footer_sanitize'
	);
	
} // end sandbox_theme_intialize_affiliates_options
add_action( 'admin_init', 'sandbox_theme_intialize_affiliates_options' );


// callback: section description
function sandbox_affiliates_options_callback() {
    echo '<p>'. back_btn() .'Upload Logos of your Affiliated Organisations, or add their URL location here.<br>
	<span class="red--text">Best to keep logos small, for example around <strong>200px wide</strong>.</span></p>';
}


// callback: logo callback
// - this is specific to affiliates, therefore not in callbacks.php
function img_callback($args) {
	$main_options = get_option( 'sandbox_theme_affiliates_options' );
	$value = $main_options[$args[0]];
	echo 
	'<div class="logogroup affiliate-logo_'.$args[1].'">
		<img class="adminlogo" src="'. get_bloginfo('stylesheet_directory'). '/img/admin-img/affiliate-logo-default.jpg"/>
		<input type="button" class="button button-primary" value="Upload Affiliate Logo '.$args[1].'" id="upload_'.$args[0].'"/>
		<div><a class="button red solid" id="remove_'.$args[0].'">Remove Logo</a></div>
		<!--<label for="'.$args[0].'">Image Location</label>-->
		<input class="invisible" type="text" id="'.$args[0].'" name="sandbox_theme_affiliates_options['.$args[0].']" value="'.$value.'" />
	</div>';
}











// _______________________________________________________
// 7 - styling: header hero mesh and footer bg image
function sandbox_theme_intialize_styling_options() {
    // create styling options section
    if ( false == get_option( 'sandbox_theme_styling_options' ) ) {
        add_option( 'sandbox_theme_styling_options' );
    }
	add_settings_section(
    	'styling_settings_section', // section ID
    	'Header and Footer Hero Styling', // section title
    	'sandbox_styling_options_callback', // callback
		'sandbox_theme_styling_options', // add to settings page
		array( // the $args array - tailor the callback function
			'styling_settings_section', 
			'sandbox_theme_styling_options' // section ID
		)
	);
	add_settings_field(
    	'heromesh',
    	'<i class="fa fa-table" aria-hidden="true"></i>Header Hero Mesh',
    	'checkbox_callback',
    	'sandbox_theme_styling_options',
		'styling_settings_section',
		array( // the $args array - tailor the callback function
			'heromesh', 
			'sandbox_theme_styling_options' // section ID
		)
	);
  	add_settings_field(
    	'footerhero',
    	'<i class="fa fa-picture-o" aria-hidden="true"></i>Footer Hero Image',
    	'checkbox_callback',
    	'sandbox_theme_styling_options',
		'styling_settings_section',
		array( // the $args array - tailor the callback function
			'footerhero', // option ID
			'sandbox_theme_styling_options' // section ID
		)
	);
	register_setting(
    	'sandbox_theme_styling_options',
    	'sandbox_theme_styling_options',
    	'header_footer_sanitize'
	);
}
add_action( 'admin_init', 'sandbox_theme_intialize_styling_options' );

// callback: styling options message
function sandbox_styling_options_callback() {
    echo '<p>'. back_btn() .'Choose Styling Options for the Hero and Footer</p>';
}








// ________________________________________
// sanitise function
// - radio buttons sansitised as text fields
// - select / dropdowns sanitised as text fields
function header_footer_sanitize( $input ) {
    $output = array();
    foreach( $input as $key => $val ) {
        if ( isset ( $input[$key] ) ) {
            $text_fields_full = array('cta_text', 'cta_type', 'cta_colour', 'ouraffiliatestitle');
            $url_fields_full = array('mainlogo', 'appletouch', 'favicon', 'cta_link', 'facebook', 'twitter', 'googleplus', 'linkedin' );
			$checkboxes = array('heromesh', 'footerhero');
			
			// text fields
			if (in_array($key, $text_fields_full)) {
                $output[$key] = sanitize_text_field( $input[$key] );
			}
			if (strpos($key, 'company_') !== false)  {
                $output[$key] = sanitize_text_field( $input[$key] );
            }
            if (strpos($key, 'ML') !== false)  {
                $output[$key] = sanitize_text_field( $input[$key] );
            }
            if (strpos($key, 'twitter_') !== false)  {
                $output[$key] = sanitize_text_field( $input[$key] );
            }
            if (strpos($key, 'aff_alt') !== false)  {
                $output[$key] = sanitize_text_field( $input[$key] );
            }
            if (strpos($key, 'aff_width') !== false)  {
                $output[$key] = sanitize_text_field( $input[$key] );
            }
            if (strpos($key, 'aff_height') !== false)  {
                $output[$key] = sanitize_text_field( $input[$key] );
            }
			
			
			// urls
			if (in_array($key, $url_fields_full)) {
                $output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
			}
			if (strpos($key, 'aff_logo') !== false)  {
				$output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
			}
			
			
			// checkboxes
			if (in_array($key, $checkboxes))  {
				$output[$key] = filter_var( $input[$key], FILTER_SANITIZE_NUMBER_INT );
			}
        }
    }
    return apply_filters( 'header_footer_sanitize', $output, $input );
}



?>