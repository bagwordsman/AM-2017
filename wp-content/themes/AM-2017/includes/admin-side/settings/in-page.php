<?php
// in page

// File Contents:

// 1 - google map
// 2 - blog


// _______________________________________________________
// 1 - Google Map
function sandbox_theme_intialize_map_options() {
	// if google map options don't exist, create them.
    if ( false == get_option( 'sandbox_theme_map_options' ) ) {
        add_option( 'sandbox_theme_map_options' );
    }
	add_settings_section(
    	'map_settings_section', // section ID
    	'Display a Google Map of your Location', // section title
    	'sandbox_map_options_callback', // callback
    	'sandbox_theme_map_options' // add to settings page
	);
	add_settings_field(
    	'gmap_api_key',
    	'<h4>General Settings for Map</h4>
		<i class="fa fa-key" aria-hidden="true"></i>Google Maps API Key',
    	'text_callback',
    	'sandbox_theme_map_options',
		'map_settings_section',
		array( // $args array - tailor the callback function
			'gmap_api_key', // Should match Option ID
			'sandbox_theme_map_options', // section ID
			'top-margin--7-6'
		)
	);
	add_settings_field(
		'gmap_height',
		'<i class="fa fa-arrows-v black--text" aria-hidden="true"></i>Set map height in pixels',
		'sandbox_gmap_height_callback',
		'sandbox_theme_map_options',
		'map_settings_section'
  	);
  	add_settings_field(
		'gmap_scroll', // option ID
		'<i class="fa fa-binoculars black--text" aria-hidden="true"></i>Zoom in and out with page scroll',
		'checkbox_callback',
		'sandbox_theme_map_options', // section ID
		'map_settings_section',
		array(
			'gmap_scroll', // option ID
			'sandbox_theme_map_options' // section ID
		)
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
	    'checkbox_callback',
	    'sandbox_theme_map_options',
		'map_settings_section',
		array(
			'gmap_infowindow_address', // option ID
			'sandbox_theme_map_options' // section ID
		)
	);
	add_settings_field(
	    'gmap_infowindow_link',
	    '<i class="fa fa-link purple--text" aria-hidden="true"></i>Show links to separate Google Maps',
	    'checkbox_callback',
	    'sandbox_theme_map_options',
		'map_settings_section',
		array(
			'gmap_infowindow_link', // option ID
			'sandbox_theme_map_options' // section ID
		)
	);

	// output location fields
	$one = new mapLocations(1);
	$one->add_location();

	$two = new mapLocations(2);
	$two->add_location();

	$three = new mapLocations(3);
	$three->add_location();

	$four = new mapLocations(4);
	$four->add_location();

	$five = new mapLocations(5);
	$five->add_location();

	$six = new mapLocations(5);
	$six->add_location();

	register_setting(
    	'sandbox_theme_map_options',
    	'sandbox_theme_map_options',
    	'in_page_sanitize'
	);
} // end sandbox_theme_intialize_map_options
add_action( 'admin_init', 'sandbox_theme_intialize_map_options' );

// callback: message
function sandbox_map_options_callback() {
	echo '
	<p>'. back_btn() .'Add your Google Maps API Key, then define general settings for the map, before adding your office locations.</p>
	<p>Copy and paste the following shortcode to add your Google Map into pages:</p>
	<p class="shortcode-info"><span>[google-map]</span></p>';
}

// callback: zoom and scroll - dropdown
function sandbox_gmap_zoom_level_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if ( isset( $options['gmap_zoom'] ) ) {
        $options['gmap_zoom'];
    }
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
}

// callback: height slider
function sandbox_gmap_height_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if ( isset( $options['gmap_height'] ) ) {
        $options['gmap_height'];
    }
    echo '
	<div id="gmap_slider">
		<div class="v-slider"></div>
		<div class="slider-info">
			<label for="map-height">Height (px):</label>
			<input class="slider-value" type="text" id="gmap_height" readonly name="sandbox_theme_map_options[gmap_height]" value="' . $options['gmap_height'] . '">
		</div>
	</div>';
}

// callback: hover or click over marker - extra info - dropdown
function sandbox_gmap_infowindow_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if ( isset( $options['gmap_infowindow'] ) ) {
        $options['gmap_infowindow'];
    }
    echo '
    <select id="gmap_infowindow" name="sandbox_theme_map_options[gmap_infowindow]">
        <option value="mouseover" '. ( $options['gmap_infowindow'] == 'mouseover' ? ('selected="selected" class="green--background"')  : '') .' >Hover</option>
        <option value="click" '. ( $options['gmap_infowindow'] == 'click' ? ('selected="selected" class="green--background"')  : '') .' >Click</option>
    </select>
    ';
}










// _______________________________________________________
// 2 - Blog Styling
function sandbox_theme_intialize_blog_options() {
	// if blog options don't exist, create them
    if ( false == get_option( 'sandbox_theme_blog_options' ) ) {
        add_option( 'sandbox_theme_blog_options' );
    }
	add_settings_section(
    	'blog_settings_section', // section ID
    	'Blog Settings', // section title
    	'sandbox_blog_options_callback', // callback
    	'sandbox_theme_blog_options' // add to settings page
	);






	// Blog - In Page Advert
	// - title and content
	add_settings_field(
    	'blog_ad_text_title',
		'<h4>In Page Advert</h4>
		<i class="fa fa-header" aria-hidden="true"></i>Title',
    	'text_callback',
    	'sandbox_theme_blog_options',
		'blog_settings_section',
		array( // $args array - tailor the callback function
			'blog_ad_text_title', // option ID
			'sandbox_theme_blog_options', // section ID
			'top-margin--7-8' // top offset
		)
	);
	add_settings_field(
    	'blog_ad_content',
		'<i class="fa fa-align-left black--text" aria-hidden="true"></i>Content',
    	'textarea_callback',
    	'sandbox_theme_blog_options',
		'blog_settings_section',
		array( // $args array - tailor the callback function
			'blog_ad_content', // option ID
			'sandbox_theme_blog_options' // section ID
		)
	);
	// - image
	add_settings_field(
    	'blog_ad_img',
    	'<i class="fa fa-picture-o" aria-hidden="true"></i>Image',
    	'sandbox_blog_ad_img_callback',
    	'sandbox_theme_blog_options',
    	'blog_settings_section'
	);
	add_settings_field(
		'blog_img_alt',
		'',
		'alt_text_callback',
		'sandbox_theme_blog_options',
    	'blog_settings_section',
		array( // $args array - tailor the callback function
			'blog_img_alt',
			'sandbox_theme_blog_options',
			'blog_ad_img' // match img id
		)
	);
	add_settings_field(
    	'blog_img_width',
    	'',
    	'img_width_height_callback',
    	'sandbox_theme_blog_options',
		'blog_settings_section',
		array( // $args array - tailor the callback function
			'blog_img_width',
			'sandbox_theme_blog_options',
			'blog_ad_img' // match img id
		)
	);
	add_settings_field(
    	'blog_img_height',
    	'',
    	'img_width_height_callback',
    	'sandbox_theme_blog_options',
		'blog_settings_section',
		array( // $args array - tailor the callback function
			'blog_img_height',
			'sandbox_theme_blog_options',
			'blog_ad_img' // match img id
		)
	);
	// - buttons
	$btn_one = new blogBtn(1);
	$btn_one->add_btn();

	$btn_two = new blogBtn(2);
	$btn_two->add_btn();
	// - checkbox
	add_settings_field(
	    'blog_ad_check',
	    '<i class="fa fa-check green--text" aria-hidden="true"></i>Display Advert',
	    'checkbox_callback',
	    'sandbox_theme_blog_options',
		'blog_settings_section',
		array(
			'blog_ad_check', // option ID
			'sandbox_theme_blog_options' // section ID
		)
	);



	// Single Posts Nav
	// - nav toggle
	add_settings_field(
	    'single_nav_check',
		'<h4>Single Posts</h4>
		<i class="fa fa-chevron-left" aria-hidden="true"></i><i class="fa fa-chevron-right" aria-hidden="true"></i>Display Nav',
	    'checkbox_callback',
	    'sandbox_theme_blog_options',
		'blog_settings_section',
		array(
			'single_nav_check', // option ID
			'sandbox_theme_blog_options', // section ID
			'top-margin--7-8' // top offset
		)
	);
	// - author & date toggle
	add_settings_field(
	    'single_meta_check',
		'<i class="fa fa-calendar" aria-hidden="true"></i>Display Author & Date',
	    'checkbox_callback',
	    'sandbox_theme_blog_options',
		'blog_settings_section',
		array(
			'single_meta_check', // option ID
			'sandbox_theme_blog_options' // section ID
		)
	);
	// - tags under post toggle
	add_settings_field(
	    'single_tag_check',
		'<i class="fa fa-tag" aria-hidden="true"></i>Display Post Tags under post',
	    'checkbox_callback',
	    'sandbox_theme_blog_options',
		'blog_settings_section',
		array(
			'single_tag_check', // option ID
			'sandbox_theme_blog_options' // section ID
		)
	);




	// Footer Widget Area
	add_settings_field(
    	'blog_widget_title',
		'<h4>Footer Widget Area</h4>
		<i class="fa fa-header" aria-hidden="true"></i>Title',
    	'text_callback',
    	'sandbox_theme_blog_options',
		'blog_settings_section',
		array( // $args array - tailor the callback function
			'blog_widget_title', // option ID
			'sandbox_theme_blog_options', // section ID
			'top-margin--7-8' // top offset
		)
	);
	add_settings_field(
	    'blog_widget_title_align',
		'<i class="fa fa-align-left black--text" aria-hidden="true"></i>Title Alignment',
	    'sandbox_blog_widget_title_align_callback',
	    'sandbox_theme_blog_options',
	    'blog_settings_section'
	);
  	add_settings_field(
    	'blog_widget_bg_colour',
		'<i class="fa fa-paint-brush" id="bg-colour-brush" aria-hidden="true"></i>Background Colour',
    	'sandbox_blog_widget_bg_colour_callback',
    	'sandbox_theme_blog_options',
    	'blog_settings_section'
	);
	add_settings_field(
	    'blog_widget_theme',
	    '<i class="fa fa-adjust colour-overlay" id="widget-theme" aria-hidden="true"></i>Widget Text Colour',
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
    	'in_page_sanitize'
	);
}
add_action( 'admin_init', 'sandbox_theme_intialize_blog_options' );


// callback: message
function sandbox_blog_options_callback() {
    echo '
	<p>'. back_btn() .'This section includes:</p>
	<ul class="admin-list">
		<li><strong>In Page Advert:</strong> in between posts on main blog page, category page, and tag page</li>
		<li><strong>Single Post:</strong> toggle nav and meta (author & date under the title)</li>
		<li><strong>Footer Widget Area:</strong> select title, colours and background image</li>
	</ul>
	<p>Select blog widgets (e.g. Categories, Tags, Recent Posts etc.) in <a href="widgets.php">Appearance > Widgets</a>.</p>';
}





// _________________________________________
// Advert
// callback: advert image
function sandbox_blog_ad_img_callback() {
    $options = get_option( 'sandbox_theme_blog_options' );
    $url = '';
    if ( isset( $options['blog_ad_img'] ) ) {
        $url = $options['blog_ad_img'];
    }
	echo
	'<div class="logogroup blog_ad_img">
		<img class="adminlogo" src="'. get_bloginfo('stylesheet_directory'). '/img/AM-advert.png"/>
		<input type="button" class="button button-primary" value="Upload Advert Image" id="upload_blog_ad_img"/>
		<input class="invisible" type="text" id="blog_ad_img" name="sandbox_theme_blog_options[blog_ad_img]" value="' . $options['blog_ad_img'] . '" />
	</div>';
}




// _________________________________________
// Footer Widget Area
// callback: title alignment - radio buttons
function sandbox_blog_widget_title_align_callback() {
    $options = get_option( 'sandbox_theme_blog_options' );
    if ( isset( $options['blog_widget_title_align'] ) ) {
        $options['blog_widget_title_align'];
    }
    echo '
	<ul id="blog_widget_title_align">
		<li>
			<input type="radio" id="blog_widget_title_align_left" name="sandbox_theme_blog_options[blog_widget_title_align]" value="left" '. ( $options['blog_widget_title_align'] == 'left' ? ('checked="checked" class="green--background"')  : '') .' />
			<label for="blog_widget_title_align_left">Left (Default)</label>
		</li>
		<li>
			<input type="radio" id="blog_widget_title_align_center" name="sandbox_theme_blog_options[blog_widget_title_align]" value="text--center" '. ( $options['blog_widget_title_align'] == 'text--center' ? ('checked="checked" class="green--background"')  : '') .' />
			<label for="blog_widget_title_align_center">Center</label>
		</li>
		<li>
			<input type="radio" id="blog_widget_title_align_right" name="sandbox_theme_blog_options[blog_widget_title_align]" value="text--right" '. ( $options['blog_widget_title_align'] == 'text--right' ? ('checked="checked" class="green--background"')  : '') .' />
			<label for="blog_widget_title_align_right">Right</label>
		</li>
	</ul>
	';
}

// callback: background colour - radio buttons
function sandbox_blog_widget_bg_colour_callback() {
    $options = get_option( 'sandbox_theme_blog_options' );
    if ( isset( $options['blog_widget_bg_colour'] ) ) {
        $options['blog_widget_bg_colour'];
    }
    echo '
	<ul id="blog_widget_bg_colour">
		<li>
			<input type="radio" id="blog_widget_bg_colour_default" name="sandbox_theme_blog_options[blog_widget_bg_colour]" value="white" '. ( $options['blog_widget_bg_colour'] == 'white' ? ('checked="checked" class="green--background"')  : '') .' />
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
			<input type="radio" id="blog_widget_bg_colour_red" name="sandbox_theme_blog_options[blog_widget_bg_colour]" value="red_dark" '. ( $options['blog_widget_bg_colour'] == 'red_dark' ? ('checked="checked" class="green--background"')  : '') .' />
			<label for="blog_widget_bg_colour_red">Red</label>
		</li>
		<li>
			<input type="radio" id="blog_widget_bg_colour_light-grey" name="sandbox_theme_blog_options[blog_widget_bg_colour]" value="grey_lighter" '. ( $options['blog_widget_bg_colour'] == 'grey_lighter' ? ('checked="checked" class="green--background"')  : '') .' />
			<label for="blog_widget_bg_colour_light-grey">Light Grey</label>
		</li>
		<li>
			<input type="radio" id="blog_widget_bg_colour_dark-grey" name="sandbox_theme_blog_options[blog_widget_bg_colour]" value="grey" '. ( $options['blog_widget_bg_colour'] == 'grey' ? ('checked="checked" class="green--background"')  : '') .' />
			<label for="blog_widget_bg_colour_dark-grey">Dark Grey</label>
		</li>
	</ul>
	';
}


// callback: theme (light or dark) - dropdown
function sandbox_blog_widget_theme_callback() {
    $options = get_option( 'sandbox_theme_blog_options' );
    if ( isset( $options['blog_widget_theme'] ) ) {
        $options['blog_widget_theme'];
    }
    echo '
    <select id="blog_widget_theme" name="sandbox_theme_blog_options[blog_widget_theme]" ' . selected( isset( $options['blog_widget_theme'] ) ? $options['blog_widget_theme'] : false ) . '>
        <option value="light" '. ( $options['blog_widget_theme'] == light ? ('selected="selected" class="green--background"')  : '') .' >light</option>
        <option value="dark" '. ( $options['blog_widget_theme'] == dark ? ('selected="selected" class="green--background"')  : '') .' >dark</option>
    </select>
    ';
}


// callback: widget background - image
function sandbox_blog_widget_bg_image_callback() {
    $options = get_option( 'sandbox_theme_blog_options' );
    $url = '';
    if ( isset( $options['blog_widget_bg_image'] ) ) {
        $url = $options['blog_widget_bg_image'];
    } // end if blog_widget_bg_image is set
		echo
		'<div class="logogroup widget_bg">
			<div class="colour-overlay">
				<img class="adminlogo" src="'. get_bloginfo('stylesheet_directory'). '/img/admin-img/widgets-bg_default.jpg"/>
			</div>
			<input type="button" class="button button-primary" value="Upload Blog Widgets Background Image" id="upload_blog_widget_bg_image"/>
			<input class="invisible" type="text" id="blog_widget_bg_image" name="sandbox_theme_blog_options[blog_widget_bg_image]" value="' . $options['blog_widget_bg_image'] . '" />
		</div>';
}


// callback: widget background opacity
function sandbox_blog_widget_bg_image_opacity_callback() {
    $options = get_option( 'sandbox_theme_blog_options' );
    if ( isset( $options['blog_widget_bg_image_opacity'] ) ) {
        $options['blog_widget_bg_image_opacity'];
    }
    echo '
	<div id="bg_image_slider">
		<div class="v-slider"></div>
		<div class="slider-info">
			<label for="image-opacity">Opacity (%):</label>
			<input class="slider-value" type="text" id="blog_widget_bg_image_opacity" readonly name="sandbox_theme_blog_options[blog_widget_bg_image_opacity]" value="' . $options['blog_widget_bg_image_opacity'] . '">
		</div>
	</div>';
}



// ________________________________________
// sanitise function
// - radio buttons sansitised as text fields
// - select / dropdowns sanitised as text fields
function in_page_sanitize( $input ) {
    $output = array();
    foreach( $input as $key => $val ) {
        if ( isset ( $input[$key] ) ) {
			$text_fields_full = array('gmap_api_key', 'gmap_height', 'gmap_infowindow', 'blog_widget_title', 'blog_widget_title_align', 'blog_widget_bg_colour', 'blog_widget_theme', 'blog_widget_bg_image_opacity');
			$textarea_full = array('blog_ad_content');
            $url_fields_full = array( 'blog_widget_bg_image', 'blog_ad_img' );
			$checkboxes = array('gmap_scroll', 'gmap_infowindow_address', 'gmap_infowindow_link', 'blog_ad_check', 'single_nav_check', 'single_meta_check', 'single_tag_check');
			
			// text fields
			if (in_array($key, $text_fields_full)) {
                $output[$key] = sanitize_text_field( $input[$key] );
			}
			if (strpos($key, 'gmap_location') !== false)  {
                $output[$key] = sanitize_text_field( $input[$key] );
			}
			if (strpos($key, 'blog_ad_text') !== false)  {
                $output[$key] = sanitize_text_field( $input[$key] );
			}
			if (strpos($key, 'blog_img_') !== false)  {
                $output[$key] = sanitize_text_field( $input[$key] );
			}
			if (strpos($key, 'blog_btn_') !== false)  {
                $output[$key] = sanitize_text_field( $input[$key] );
			}
			
			// textarea
			// if ( $key == 'blog_ad_content' ) {
			if (in_array($key, $textarea_full)) {
				$output[$key] = sanitize_textarea_field( $input[$key] );
			}

			// urls
			if (in_array($key, $url_fields_full)) {
                $output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
			}
			if (strpos($key, 'blog_button_') !== false)  {
                $output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
			}	
			
			// checkboxes
			if (in_array($key, $checkboxes))  {
				$output[$key] = filter_var( $input[$key], FILTER_SANITIZE_NUMBER_INT );
			}
        }
    }
    return apply_filters( 'in_page_sanitize', $output, $input );
}

// note: may be better to use the following in the case of this file:

// sanitise blog options
// function sandbox_theme_sanitize_blog_options( $input ) {
//     $output = array();
//     foreach( $input as $key => $val ) {
//         // background image > sanitise as url
//         if ( $key == 'blog_widget_bg_image' ) {
//             $output['blog_widget_bg_image'] = esc_url_raw( strip_tags( stripslashes( $input['blog_widget_bg_image'] ) ) );
//         // sanitise as text field
//         } else {
//             $output[$key] = sanitize_text_field( $input[$key] );
//         }
//     }
//     return apply_filters( 'sandbox_theme_sanitize_blog_options', $output, $input );
// }</file:>
?>
