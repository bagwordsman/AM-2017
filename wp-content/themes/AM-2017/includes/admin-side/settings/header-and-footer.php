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
// + generic callback functions saved in separate include


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
    	'sandbox_theme_sanitize_company_options'
	);
}
add_action( 'admin_init', 'sandbox_theme_intialize_company_options' );


// sanitise company options
function sandbox_theme_sanitize_company_options( $input ) {
    $output = array();
    foreach( $input as $key => $val ) {
        if ( isset ( $input[$key] ) ) {
            $output[$key] = sanitize_text_field( $input[$key] );
        }
    }
    return apply_filters( 'sandbox_theme_sanitize_company_options', $output, $input );
}

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


// sanitise logo options
function sandbox_theme_sanitize_logo_options( $input ) {
    $output = array();
    foreach( $input as $key => $val ) {
        if ( isset ( $input[$key] ) ) {
			// alternative text: sanitise as text field
			if ( $key == 'MLalt' ) {
				$output['MLalt'] = sanitize_text_field( $input['MLalt'] );
			// width
			} elseif (strpos($key, 'MLwidth') !== false)  {
				$output[$key] = sanitize_text_field( $input[$key] );
			// height
			} elseif (strpos($key, 'MLheight') !== false)  {
				$output[$key] = sanitize_text_field( $input[$key] );
			} else {
				$output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
			}
		}
    }
    return apply_filters( 'sandbox_theme_sanitize_logo_options', $output, $input );
}


// callback: message
function sandbox_logo_options_callback() {
    echo '<p>Upload or add your logos with their URL location here</p>';
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
		<label for="mainlogo">Logo Location - can also enter with URL</label>
		<input type="text" id="mainlogo" name="sandbox_theme_logo_options[mainlogo]" value="' . $options['mainlogo'] . '" />
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
		<label for="appletouch">Apple Touch Icon Location - can also enter with URL</label>
		<input type="text" id="appletouch" name="sandbox_theme_logo_options[appletouch]" value="' . $options['appletouch'] . '" />
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
		<label for="favicon">Favicon Location - can also enter with URL</label>
		<input type="text" id="favicon" name="sandbox_theme_logo_options[favicon]" value="' . $options['favicon'] . '" />
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
    	'<i class="fa fa-link purple--text" aria-hidden="true"></i>Link:<br>enter a url',
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
    	'<i class="fa fa-header" aria-hidden="true"></i>Text:<br>enter button text',
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
    	'sandbox_theme_sanitize_cta_options'
	);
} // end sandbox_theme_intialize_social_options
add_action( 'admin_init', 'sandbox_theme_intialize_cta_options' );


// sanitise header cta - text, url(link), radio buttons
function sandbox_theme_sanitize_cta_options( $input ) {
    $output = array();
	foreach( $input as $key => $val ) {
		if ( isset ( $input[$key] ) ) {
			// sanitise link as a url
			if ( $key == 'cta_link' ) {
				$output['cta_link'] = esc_url_raw( strip_tags( stripslashes( $input['cta_link'] ) ) );
			}
			// sanitise as text field
			else {
				$output[$key] = sanitize_text_field( $input[$key] );	
			}
		}
	}
    return apply_filters( 'sandbox_theme_sanitize_cta_options', $output, $input );
}


// callback: header cta instruction text
function sandbox_cta_options_callback() {
    echo '<p>Configure the Call to Action button in the header.</p>';
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
    	'sandbox_theme_sanitize_social_options'
	);
} // end sandbox_theme_intialize_social_options
add_action( 'admin_init', 'sandbox_theme_intialize_social_options' );


// sanitise urls
function sandbox_theme_sanitize_social_options( $input ) {
    $output = array();
    foreach( $input as $key => $val ) {
        if ( isset ( $input[$key] ) ) {
            $output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
        }
    }
    return apply_filters( 'sandbox_theme_sanitize_social_options', $output, $input );
}

// callback: social networks message
function sandbox_social_options_callback() {
    echo '<p>Provide the URLs to the social networks you\'d like to display.</p>';
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
    	'tweet_heading',
    	'<i class="fa fa-header black--text" aria-hidden="true"></i>Twitter Feed Heading',
    	'text_callback',
    	'sandbox_theme_tweet_options',
		'tweet_settings_section',
		array( // $args array - tailor text_callback
			'tweet_heading',
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
	add_settings_field(
    	'no_tweets',
    	'<i class="fa fa-twitter" aria-hidden="true"></i>Number of Tweets to Display',
    	'sandbox_no_tweets_callback',
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


// callback: tweet message
function sandbox_tweet_options_callback() {
    echo '<p>Display your latest Tweets in the footer. Please note that more settings (which are currently hard-coded) are required to do this.</p>';
}

// callback: number of tweets
function sandbox_no_tweets_callback() {
    $options = get_option( 'sandbox_theme_tweet_options' );
    if ( isset( $options['no_tweets'] ) ) {
        $options['no_tweets'];
    }
    echo '
    <select id="no_tweets" name="sandbox_theme_tweet_options[no_tweets]" ' . selected( isset( $options['no_tweets'] ) ? $options['no_tweets'] : false ) . '>
        <option value="one" '. ( $options['no_tweets'] == one ? ('selected="selected" class="green--background"')  : '') .' >one</option>
		<option value="two" '. ( $options['no_tweets'] == two ? ('selected="selected" class="green--background"')  : '') .' >two</option>
		<option value="three" '. ( $options['no_tweets'] == three ? ('selected="selected" class="green--background"')  : '') .' >three</option>
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
    	'sandbox_theme_sanitize_affiliates_options'
	);
	
} // end sandbox_theme_intialize_affiliates_options
add_action( 'admin_init', 'sandbox_theme_intialize_affiliates_options' );




// sanitise affiliate options
function sandbox_theme_sanitize_affiliates_options( $input ) {
    $output = array();

	// loop over affiliate logos
	foreach( $input as $key => $val ) {

		// the key must be set, in order to get sanitised and output
		if ( isset ( $input[$key] ) ) {

			// main title: sanitise as text field
			if ( $key == 'ouraffiliatestitle' ) {
				$output['ouraffiliatestitle'] = sanitize_text_field( $input['ouraffiliatestitle'] );
			
			// alternative text: sanitise as text field
			} elseif (strpos($key, 'aff_alt') !== false)  {
				$output[$key] = sanitize_text_field( $input[$key] );
			// width
			} elseif (strpos($key, 'aff_width') !== false)  {
				$output[$key] = sanitize_text_field( $input[$key] );
			// height
			} elseif (strpos($key, 'aff_height') !== false)  {
				$output[$key] = sanitize_text_field( $input[$key] );
			} // original
			elseif (strpos($key, 'alttext') !== false)  { 
				$output[$key] = sanitize_text_field( $input[$key] );
			}
			
			// url
			else {
				// if the key is a path to a logo, sanitise it as a url
				$output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
			}

		}
	}
    return apply_filters( 'sandbox_theme_sanitize_affiliates_options', $output, $input );
}


// callback: section description
function sandbox_affiliates_options_callback() {
    echo '<p>Upload Logos of your Affiliated Organisations, or add their URL location here.<br>
	<span class="red--text">Best to keep logos small, for example around <strong>200px wide</strong>.</span></p>';
}


// callback: logo callback
function img_callback($args) {
	$main_options = get_option( 'sandbox_theme_affiliates_options' );
	$value = $main_options[$args[0]];
	echo 
	'<div class="logogroup affiliate-logo_'.$args[1].'">
		<img class="adminlogo" src="'. get_bloginfo('stylesheet_directory'). '/img/admin-img/affiliate-logo-default.jpg"/>
		<input type="button" class="button button-primary" value="Upload Affiliate Logo '.$args[1].'" id="upload_'.$args[0].'"/>
		<label for="'.$args[0].'">Image Location - can also enter with URL</label>
		<input type="text" id="'.$args[0].'" name="sandbox_theme_affiliates_options['.$args[0].']" value="'.$value.'" />
	</div>';
}











// _______________________________________________________
// 7 - styling options
function sandbox_theme_intialize_styling_options() {
    // create styling options section
    if ( false == get_option( 'sandbox_theme_styling_options' ) ) {
        add_option( 'sandbox_theme_styling_options' );
    }
	add_settings_section(
    	'styling_settings_section', // section ID
    	'Styling Options', // section title
    	'sandbox_styling_options_callback', // callback
    	'sandbox_theme_styling_options' // add to settings page
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
    	'sandbox_theme_sanitize_styling_options'
	);
}
add_action( 'admin_init', 'sandbox_theme_intialize_styling_options' );

// sanitise checkboes
function sandbox_theme_sanitize_styling_options( $input ) {
    $output = array();
    foreach( $input as $key => $val ) {
		if ( $key == 'heromesh' or $key == 'footerhero' ) {
			$output[$key] = filter_var( $input[$key], FILTER_SANITIZE_NUMBER_INT );
		}
    }
    return apply_filters( 'sandbox_theme_sanitize_styling_options', $output, $input );
}

// callback: styling options message
function sandbox_styling_options_callback() {
    echo '<p>Choose Styling Options for the Hero and Footer</p>';
}

?>