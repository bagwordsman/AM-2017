<?php
// ------------------------------------------------------------------------
// In Page Options
// 1) Google Map of Location
// 2) Blog Styling



// ------------------------------------------------------------------------
// 1) Google Map of Location
function sandbox_theme_intialize_map_options() {
	// If the google map options don't exist, create them.
    if( false == get_option( 'sandbox_theme_map_options' ) ) {
        add_option( 'sandbox_theme_map_options' );
    } // end if

	add_settings_section(
    	'map_settings_section',          // ID used to identify this section and with which to register options
    	'Display a Google Map of your Location',                   // Title to be displayed on the administration page
    	'sandbox_map_options_callback',  // Callback used to render the description of the section
    	'sandbox_theme_map_options'      // Page on which to add this section of options
	);
	add_settings_field(
    	'gmap_api_key',
    	'<h4>General Settings for Map</h4>
			<i class="fa fa-key" aria-hidden="true"></i>Google Maps API Key',
    	'sandbox_gmap_api_callback',
    	'sandbox_theme_map_options',
    	'map_settings_section'
	);
	// hide this - it does not work on maps with multiple markers
	// test with a single marker - and get it working with this
	//add_settings_field(
    	//'gmap_zoom_level',
    	//'<i class="fa fa-binoculars" aria-hidden="true"></i>Zoom Level',
    	//'sandbox_gmap_zoom_level_callback',
    	//'sandbox_theme_map_options',
    	//'map_settings_section'
	//);
	add_settings_field(
      'gmap_height',
      '<i class="fa fa-arrows-v black--text" aria-hidden="true"></i>Set map height in pixels',
      'sandbox_gmap_height_callback',
      'sandbox_theme_map_options',
      'map_settings_section'
  );
  add_settings_field(
      'gmap_scroll',
      '<i class="fa fa-binoculars black--text" aria-hidden="true"></i>Zoom in and out with page scroll',
      'sandbox_gmap_scroll_callback',
      'sandbox_theme_map_options',
      'map_settings_section'
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
	    'sandbox_gmap_infowindow_address_callback',
	    'sandbox_theme_map_options',
	    'map_settings_section'
	);
	add_settings_field(
	    'gmap_infowindow_link',
	    '<i class="fa fa-link purple--text" aria-hidden="true"></i>Show links to separate Google Maps',
	    'sandbox_gmap_infowindow_link_callback',
	    'sandbox_theme_map_options',
	    'map_settings_section'
	);




	// - - - - - - - - -
	// location 1
	// a) location 1 name
	add_settings_field(
      'gmap_location_1_name',
      '<h4>Office Locations</h4>
			<br>Office Location 1<br>
			<br><i class="fa fa-home black--text" aria-hidden="true"></i>Name',
      'sandbox_gmap_location_1_name_callback',
      'sandbox_theme_map_options',
      'map_settings_section'
  );
	// b) location 1 address
	add_settings_field(
      'gmap_location_1_address',
      '<i class="fa fa-map-marker red--text" aria-hidden="true"></i>Address',
      'sandbox_gmap_location_1_address_callback',
      'sandbox_theme_map_options',
      'map_settings_section'
  );

	// location 2
	// a) location 2 name
	add_settings_field(
	    'gmap_location_2_name',
	    '<br>Office Location 2<br>
			<br><i class="fa fa-home black--text" aria-hidden="true"></i>Name',
	    'sandbox_gmap_location_2_name_callback',
	    'sandbox_theme_map_options',
	    'map_settings_section'
	);
	// b) location 2 address
	add_settings_field(
	    'gmap_location_2_address',
	    '<i class="fa fa-map-marker red--text" aria-hidden="true"></i>Address',
	    'sandbox_gmap_location_2_address_callback',
	    'sandbox_theme_map_options',
	    'map_settings_section'
	);

	// location 3
	// a) location 3 name
	add_settings_field(
	    'gmap_location_3_name',
	    '<br>Office Location 3<br>
			<br><i class="fa fa-home black--text" aria-hidden="true"></i>Name',
	    'sandbox_gmap_location_3_name_callback',
	    'sandbox_theme_map_options',
	    'map_settings_section'
	);
	// b) location 3 address
	add_settings_field(
	    'gmap_location_3_address',
	    '<i class="fa fa-map-marker red--text" aria-hidden="true"></i>Address',
	    'sandbox_gmap_location_3_address_callback',
	    'sandbox_theme_map_options',
	    'map_settings_section'
	);

	// location 4
	// a) location 4 name
	add_settings_field(
	    'gmap_location_4_name',
	    '<br>Office Location 4<br>
			<br><i class="fa fa-home black--text" aria-hidden="true"></i>Name',
	    'sandbox_gmap_location_4_name_callback',
	    'sandbox_theme_map_options',
	    'map_settings_section'
	);
	// b) location 4 address
	add_settings_field(
	    'gmap_location_4_address',
	    '<i class="fa fa-map-marker red--text" aria-hidden="true"></i>Address',
	    'sandbox_gmap_location_4_address_callback',
	    'sandbox_theme_map_options',
	    'map_settings_section'
	);


	register_setting(
    	'sandbox_theme_map_options',
    	'sandbox_theme_map_options',
    	'sandbox_theme_sanitize_map_options'
	);
} // end sandbox_theme_intialize_map_options
add_action( 'admin_init', 'sandbox_theme_intialize_map_options' );



// use sanitize_text_field() to sanitise map options
function sandbox_theme_sanitize_map_options( $input ) {
    $output = array();

    // loop over the affiliate logo section options
    foreach( $input as $key => $val ) {

        // the key must be set, in order to get sanitised and output
        if( isset ( $input[$key] ) ) {

            // if input key is a checkbox, sanitise if differently
            if ( $key == 'gmap_contact_page' ) {
                $output[$key] = filter_var( $input[$key], FILTER_SANITIZE_NUMBER_INT );
            } else {
                $output[$key] = sanitize_text_field( $input[$key] );
            }

        } // end if

    } // end foreach

    return apply_filters( 'sandbox_theme_sanitize_map_options', $output, $input );
} // end sandbox_theme_sanitize_map_options


// construct the map options form
function sandbox_map_options_callback() {
    echo '<p>Add your Google Maps API Key, then define general settings for the map, before adding your office locations.</p>
		 <p>Copy and paste the following shortcode to add your Google Map into pages:</p>
		 <p><strong>[google-map]</strong></p>';
} // end sandbox_map_options_callback

//
// API Key
function sandbox_gmap_api_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_api_key'] ) ) {
        $options['gmap_api_key'];
    } // end if
    // Render the output
    echo '<input type="text" id="gmap_api_key" name="sandbox_theme_map_options[gmap_api_key]" value="' . $options['gmap_api_key'] . '" class="top-margin--4-2" />';
} // end sandbox_gmap_api_callback


//
// Zoom and Scroll Stuff
// 1 - set the zoom level
// create a dropdown to select zoom level
function sandbox_gmap_zoom_level_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_zoom'] ) ) {
        $options['gmap_zoom'];
    } // end if
    // Render the output
		// selected="selected"
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
} // end sandbox_gmap_zoom_level_callback

// 2 - set height in pixels of google map
function sandbox_gmap_height_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_height'] ) ) {
        $options['gmap_height'];
    } // end if
    // Render the output
    echo '
		<div id="gmap_slider">
				<div class="v-slider"></div>
				<div class="slider-info">
						<label for="map-height">Height (px):</label>
						<input class="slider-value" type="text" id="gmap_height" readonly name="sandbox_theme_map_options[gmap_height]" value="' . $options['gmap_height'] . '">
				</div>
		</div>';
} // end sandbox_gmap_height_callback

// 3 - allow scroll page to zoom map in and out
function sandbox_gmap_scroll_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_scroll'] ) ) {
        $options['gmap_scroll'];
    } // end if
    // Render the output
    echo '<input type="checkbox" id="gmap_scroll" name="sandbox_theme_map_options[gmap_scroll]" value="1" ' . checked( 1, isset( $options['gmap_scroll'] ) ? $options['gmap_scroll'] : 0, false ) . ' />';
} // end sandbox_gmap_scroll_callback



// - - - - - - - -
// Infowindow Stuff
// 1 - display on hover or click
// create a dropdown to select hover or click
function sandbox_gmap_infowindow_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_infowindow'] ) ) {
        $options['gmap_infowindow'];
    } // end if
    // Render the output
    echo '
    <select id="gmap_infowindow" name="sandbox_theme_map_options[gmap_infowindow]">
        <option value="mouseover" '. ( $options['gmap_infowindow'] == 'mouseover' ? ('selected="selected" class="green--background"')  : '') .' >Hover</option>
        <option value="click" '. ( $options['gmap_infowindow'] == 'click' ? ('selected="selected" class="green--background"')  : '') .' >Click</option>
    </select>
    ';
} // end sandbox_gmap_infowindow_callback

// 2 - toggle addresses
function sandbox_gmap_infowindow_address_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_infowindow_address'] ) ) {
        $options['gmap_infowindow_address'];
    } // end if
    // Render the output
    echo '<input type="checkbox" id="gmap_infowindow_address" name="sandbox_theme_map_options[gmap_infowindow_address]" value="1" ' . checked( 1, isset( $options['gmap_infowindow_address'] ) ? $options['gmap_infowindow_address'] : 0, false ) . ' />';
} // end sandbox_gmap_infowindow_address_callback

// 3 - toggle open in google maps link
function sandbox_gmap_infowindow_link_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_infowindow_link'] ) ) {
        $options['gmap_infowindow_link'];
    } // end if
    // Render the output
    echo '<input type="checkbox" id="gmap_infowindow_link" name="sandbox_theme_map_options[gmap_infowindow_link]" value="1" ' . checked( 1, isset( $options['gmap_infowindow_link'] ) ? $options['gmap_infowindow_link'] : 0, false ) . ' />';
} // end sandbox_gmap_infowindow_link_callback



// - - - - - - - - - -
// Location 1
// a) location 1 name
function sandbox_gmap_location_1_name_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_location_1_name'] ) ) {
        $options['gmap_location_1_name'];
    } // end if
    echo '<input type="text" id="gmap_location_1_name" name="sandbox_theme_map_options[gmap_location_1_name]" value="' . $options['gmap_location_1_name'] . '" class="top-margin--10" />';
} // end sandbox_gmap_location_1_name_callback

// b) location 1 address
function sandbox_gmap_location_1_address_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_location_1_address'] ) ) {
        $options['gmap_location_1_address'];
    } // end if
    echo '<input type="text" id="gmap_location_1_address" name="sandbox_theme_map_options[gmap_location_1_address]" value="' . $options['gmap_location_1_address'] . '" />';
} // end sandbox_gmap_location_1_address_callback



// - - - - - - - - - -
// Location 2
// a) location 2 name
function sandbox_gmap_location_2_name_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_location_2_name'] ) ) {
        $options['gmap_location_2_name'];
    } // end if
    echo '<input type="text" id="gmap_location_2_name" name="sandbox_theme_map_options[gmap_location_2_name]" value="' . $options['gmap_location_2_name'] . '" class="top-margin--5-8" />';
} // end sandbox_gmap_location_2_name_callback

// b) location 2 address
function sandbox_gmap_location_2_address_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_location_2_address'] ) ) {
        $options['gmap_location_2_address'];
    } // end if
    echo '<input type="text" id="gmap_location_2_address" name="sandbox_theme_map_options[gmap_location_2_address]" value="' . $options['gmap_location_2_address'] . '" />';
} // end sandbox_gmap_location_2_address_callback



// - - - - - - - - - -
// Location 3
// a) location 3 name
function sandbox_gmap_location_3_name_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_location_3_name'] ) ) {
        $options['gmap_location_3_name'];
    } // end if
    echo '<input type="text" id="gmap_location_3_name" name="sandbox_theme_map_options[gmap_location_3_name]" value="' . $options['gmap_location_3_name'] . '" class="top-margin--5-8" />';
} // end sandbox_gmap_location_3_name_callback

// b) location 3 address
function sandbox_gmap_location_3_address_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_location_3_address'] ) ) {
        $options['gmap_location_3_address'];
    } // end if
    echo '<input type="text" id="gmap_location_3_address" name="sandbox_theme_map_options[gmap_location_3_address]" value="' . $options['gmap_location_3_address'] . '" />';
} // end sandbox_gmap_location_3_address_callback



// - - - - - - - - - -
// Location 4
// a) location 4 name
function sandbox_gmap_location_4_name_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_location_4_name'] ) ) {
        $options['gmap_location_4_name'];
    } // end if
    echo '<input type="text" id="gmap_location_4_name" name="sandbox_theme_map_options[gmap_location_4_name]" value="' . $options['gmap_location_4_name'] . '" class="top-margin--5-8" />';
} // end sandbox_gmap_location_4_name_callback

// b) location 4 address
function sandbox_gmap_location_4_address_callback() {
    $options = get_option( 'sandbox_theme_map_options' );
    if( isset( $options['gmap_location_4_address'] ) ) {
        $options['gmap_location_4_address'];
    } // end if
    echo '<input type="text" id="gmap_location_4_address" name="sandbox_theme_map_options[gmap_location_4_address]" value="' . $options['gmap_location_4_address'] . '" />';
} // end sandbox_gmap_location_4_address_callback















// ------------------------------------------------------------------------
// 2) Blog Styling
function sandbox_theme_intialize_blog_options() {
	// If the blog options don't exist, create them.
    if( false == get_option( 'sandbox_theme_blog_options' ) ) {
        add_option( 'sandbox_theme_blog_options' );
    } // end if

	add_settings_section(
    	'blog_settings_section',          // ID used to identify this section and with which to register options
    	'Styling Options for the Blog',  // Title to be displayed on the administration page
    	'sandbox_blog_options_callback',  // Callback used to render the description of the section
    	'sandbox_theme_blog_options'      // Page on which to add this section of options
	);

	// Widgets Title
	add_settings_field(
    	'blog_widget_title',
    	'<h4>Blog Widget Area</h4>
			<i class="fa fa-header" aria-hidden="true"></i>Title',
    	'sandbox_blog_widget_title_callback',
    	'sandbox_theme_blog_options',
    	'blog_settings_section'
	);
	add_settings_field(
	    'blog_widget_title_align',
	    '<i class="fa fa-align-left black--text" aria-hidden="true"></i>Title Alignment',
	    'sandbox_blog_widget_title_align_callback',
	    'sandbox_theme_blog_options',
	    'blog_settings_section'
	);

	// Widgets Background
  add_settings_field(
    	'blog_widget_bg_colour',
			'<i class="fa fa-paint-brush" id="bg-colour-brush" aria-hidden="true"></i>Background Colour',
    	'sandbox_blog_widget_bg_colour_callback',
    	'sandbox_theme_blog_options',
    	'blog_settings_section'
	);
	add_settings_field(
	    'blog_widget_theme',
	    '<i class="fa fa-adjust" id="widget-theme" aria-hidden="true"></i>Theme / Colour Scheme',
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
    	'sandbox_theme_sanitize_blog_options'
	);
} // end sandbox_theme_intialize_blog_options
add_action( 'admin_init', 'sandbox_theme_intialize_blog_options' );


// construct the blog options form
function sandbox_blog_options_callback() {
    echo '
		<p>Define Styling Options for the Blog Pages here.</p>
		<p>Decide whether to include blog widgets or not in <a href="widgets.php">Appearance > Widgets</a>.</p>';
} // end sandbox_blog_options_callback

// sanitise blog options
function sandbox_theme_sanitize_blog_options( $input ) {
    $output = array();
    foreach( $input as $key => $val ) {

        // if the key is the background image, sanitise as a url
        if ( $key == 'blog_widget_bg_image' ) {
            $output['blog_widget_bg_image'] = esc_url_raw( strip_tags( stripslashes( $input['blog_widget_bg_image'] ) ) );

        // if not, sanitise it as a text field
        } else {
            $output[$key] = sanitize_text_field( $input[$key] );
        }

    } // end foreach
    // Return the new collection
    return apply_filters( 'sandbox_theme_sanitize_blog_options', $output, $input );
} // end sandbox_theme_sanitize_blog_options




// - - - - - - - - -
// Blog Widgets
// 1 - Title
function sandbox_blog_widget_title_callback() {
    $options = get_option( 'sandbox_theme_blog_options' );
    if( isset( $options['blog_widget_title'] ) ) {
        $options['blog_widget_title'];
    } // end if
    // Render the output
    echo '<input type="text" id="blog_widget_title" name="sandbox_theme_blog_options[blog_widget_title]" value="' . $options['blog_widget_title'] . '" class="top-margin--4-2" />';
} // end sandbox_blog_widget_title_callback

// 2 - Title Alignment
function sandbox_blog_widget_title_align_callback() {
    $options = get_option( 'sandbox_theme_blog_options' );
    if( isset( $options['blog_widget_title_align'] ) ) {
        $options['blog_widget_title_align'];
    } // end if
    // Render the output
    echo '
		<ul id="blog_widget_title_align">
				<li>
						<input type="radio" id="blog_widget_title_align_left" name="sandbox_theme_blog_options[blog_widget_title_align]" value="left" '. ( $options['blog_widget_title_align'] == 'left' ? ('checked="checked" class="green--background"')  : '') .' />
						<label for="blog_widget_title_align_left">Left (Default)</label>
				</li>
				<li>
				    <input type="radio" id="blog_widget_title_align_center" name="sandbox_theme_blog_options[blog_widget_title_align]" value="center" '. ( $options['blog_widget_title_align'] == 'center' ? ('checked="checked" class="green--background"')  : '') .' />
				    <label for="blog_widget_title_align_center">Center</label>
				</li>
				<li>
				    <input type="radio" id="blog_widget_title_align_right" name="sandbox_theme_blog_options[blog_widget_title_align]" value="right" '. ( $options['blog_widget_title_align'] == 'right' ? ('checked="checked" class="green--background"')  : '') .' />
				    <label for="blog_widget_title_align_right">Right</label>
				</li>
		</ul>
		';
} // end sandbox_blog_widget_title_align_callback





// - - - - - - - - -
// 3 - Background Colour
function sandbox_blog_widget_bg_colour_callback() {
    $options = get_option( 'sandbox_theme_blog_options' );
    if( isset( $options['blog_widget_bg_colour'] ) ) {
        $options['blog_widget_bg_colour'];
    } // end if
    // Render the output
    echo '
		<ul id="blog_widget_bg_colour">
				<li>
						<input type="radio" id="blog_widget_bg_colour_default" name="sandbox_theme_blog_options[blog_widget_bg_colour]" value="default" '. ( $options['blog_widget_bg_colour'] == 'default' ? ('checked="checked" class="green--background"')  : '') .' />
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
            <input type="radio" id="blog_widget_bg_colour_red" name="sandbox_theme_blog_options[blog_widget_bg_colour]" value="red" '. ( $options['blog_widget_bg_colour'] == 'red' ? ('checked="checked" class="green--background"')  : '') .' />
            <label for="blog_widget_bg_colour_red">Red</label>
        </li>
				<li>
				    <input type="radio" id="blog_widget_bg_colour_light-grey" name="sandbox_theme_blog_options[blog_widget_bg_colour]" value="light-grey" '. ( $options['blog_widget_bg_colour'] == 'light-grey' ? ('checked="checked" class="green--background"')  : '') .' />
				    <label for="blog_widget_bg_colour_light-grey">Light Grey</label>
				</li>
				<li>
				    <input type="radio" id="blog_widget_bg_colour_dark-grey" name="sandbox_theme_blog_options[blog_widget_bg_colour]" value="dark-grey" '. ( $options['blog_widget_bg_colour'] == 'dark-grey' ? ('checked="checked" class="green--background"')  : '') .' />
				    <label for="blog_widget_bg_colour_dark-grey">Dark Grey</label>
				</li>
		</ul>
		';
} // end sandbox_blog_widget_bg_colour_callback


// 4 - Theme / Colour Scheme
function sandbox_blog_widget_theme_callback() {
    $options = get_option( 'sandbox_theme_blog_options' );
    if( isset( $options['blog_widget_theme'] ) ) {
        $options['blog_widget_theme'];
    } // end if
    // Render the output
		// selected="selected"
    echo '
    <select id="blog_widget_theme" name="sandbox_theme_blog_options[blog_widget_theme]" ' . selected( isset( $options['blog_widget_theme'] ) ? $options['blog_widget_theme'] : false ) . '>
        <option value="light" '. ( $options['blog_widget_theme'] == light ? ('selected="selected" class="green--background"')  : '') .' >light</option>
        <option value="dark" '. ( $options['blog_widget_theme'] == dark ? ('selected="selected" class="green--background"')  : '') .' >dark</option>
    </select>
    ';
} // end sandbox_blog_widget_theme_callback


// 5 - Background Image
function sandbox_blog_widget_bg_image_callback() {
    $options = get_option( 'sandbox_theme_blog_options' );
    $url = '';
    if( isset( $options['blog_widget_bg_image'] ) ) {
        $url = $options['blog_widget_bg_image'];
    } // end if blog_widget_bg_image is set
		echo
		'<div class="bg-img_group blog_widget_bg_image">
			<div class="widget-bg-preview">
					<img class="adminlogo widget-image-preview" src="'. get_bloginfo('stylesheet_directory'). '/img/admin-img/widgets-bg_default.jpg"/>
			</div>
			<input type="button" class="button button-primary" value="Upload Blog Widgets Background Image" id="upload_blog_widget_bg_image"/>
			<label for="blog_widget_bg_image">Background Image Location - can also enter with URL. Image should be at least 1800px wide.</label>
			<input type="text" id="blog_widget_bg_image" name="sandbox_theme_blog_options[blog_widget_bg_image]" value="' . $options['blog_widget_bg_image'] . '" />
		</div>';
} // end sandbox_blog_widget_bg_image_callback


// 6 - Background Image Opacity
function sandbox_blog_widget_bg_image_opacity_callback() {
    $options = get_option( 'sandbox_theme_blog_options' );
    if( isset( $options['blog_widget_bg_image_opacity'] ) ) {
        $options['blog_widget_bg_image_opacity'];
    } // end if
    // Render the output
    echo '
		<div id="bg_image_slider">
				<div class="v-slider"></div>
				<div class="slider-info">
						<label for="image-opacity">Opacity (%):</label>
						<input class="slider-value" type="text" id="blog_widget_bg_image_opacity" readonly name="sandbox_theme_blog_options[blog_widget_bg_image_opacity]" value="' . $options['blog_widget_bg_image_opacity'] . '">
				</div>
		</div>';
} // end sandbox_blog_widget_bg_image_opacity_callback

// relies upon the above:

// function for blog widget area - reduce code repetition across templates
function blog_widget_area() {
	$blog_options = get_option ( 'sandbox_theme_blog_options' );
	// title
	$widget_title = $blog_options['blog_widget_title'];
	$widget_align = $blog_options['blog_widget_title_align'];
	// background
	$widget_colour = $blog_options['blog_widget_bg_colour'];
	$widget_theme = $blog_options['blog_widget_theme'];
	$widget_image = $blog_options['blog_widget_bg_image'];
	$widget_image_opacity = $blog_options['blog_widget_bg_image_opacity'];
	// opacity for overlay (inverse of image)
	$widget_image_opacity = (int)$widget_image_opacity;
	$widget_image_opacity = (100 - $widget_image_opacity);


	// blog widget area
	if ( is_active_sidebar( 'blogpages' ) ) {

			echo '
			<div id="blog-widgets" role="complementary"'. ( $widget_image ? ( ' style="background-image:url('. $widget_image ) .')"' : '') . ( $widget_theme ? ( ' class="'. $widget_theme ) .'"' : '') .'>'.
					( $widget_title ? ( '<div class="container'. ( $widget_align != 'left' ? ( ' '. $widget_align )  : '') .'"><h3 class="blog-widgets--title">'. $widget_title .'</h3></div>' )  : '') .'
					<div class="container widgets">
							'; dynamic_sidebar( 'blogpages' ); echo'
					</div>
					'. ( $widget_colour ? ( '<div class="widget-overlay '. $widget_colour ) .'" '. ( $widget_image_opacity != 100 ? ( ' style="opacity:.'. $widget_image_opacity ) .';"' : '') .'></div>' : '') .'
			</div>
			';
	}

} // end sandbox_blog_widget_title_callback



// load thickbox stuff on admin side only
if (is_admin()) {
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox'); //thickbox styles css
}
// hooked into theme logos function
add_action( 'menu_options_filter', 'sandbox_theme_logo_options' );




?>
