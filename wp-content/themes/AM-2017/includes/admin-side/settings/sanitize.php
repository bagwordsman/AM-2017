<?php

// ––––––––––––––––––––––––––––––––––––––––––––––––––
// universal sanitise function
// - make things simpler with one main sanitise function
// - PROBLEM: can't seem to make this work with an include
// - it seems sanitising needs to be done within in-page.php etc.

// how to use:
// - if section IDs correspond to inputs of the same type, use strpos
// - if section IDs named similar to inputs of multiple types, use text array method

// note (an example):
// - can't sanitise all 'aff_' fields as text fields. 'aff_logo' fields are url fields.
// - same case with 'gmap_'. API key, height and location = text fields, the rest are checkboxes.
// - make sure these don't conflict with non-sanitised fields (radio and dropdowns)

// __________________
// examples:
// a) full string version:
// $text_fields = array('twitter_heading', 'twitter_profile', 'twitter_user');
// if (in_array($key, $text_fields)) {
//     $output[$key] = sanitize_text_field( $input[$key] );

// b) string contains version:
// if (strpos($key, 'twitter_') !== false)  {
//     $output[$key] = sanitize_text_field( $input[$key] );
// __________________

function sandbox_theme_universal_sanitize( $input ) {
    $output = array();

	// loop over all fields
	foreach( $input as $key => $val ) {

		// the key must be set, in order to get sanitised and output
		if ( isset ( $input[$key] ) ) {

            // radio and dropdown (no sanitise):
            // cta_type, cta_colour
            
            // ____________________________________
            // text fields

            // header and footer:
            // 1 - company_name, company_number, company_address, company_phone, company_email (could be company_*)
            // 2 - MLalt, MLwidth, MLheight (could be ML_*)
            // 3 - cta_text
            // 4 - facebook, twitter, googleplus, linkedin
            // 5 - twitter_heading, twitter_profile, twitter_user (could be twitter_*)
            // 6 - ouraffiliatestitle, aff_alt*, aff_width*, aff_height*

            // in page:
            // 1 - gmap_api_key, gmap_height (readonly), gmap_location*
            // 2 - blog_widget_title, blog_widget_bg_image_opacity (this is readonly) 

            // functionality:
            // 1 - google_analytics
            // 3 - fixed_header_offset

            $text_fields_full = array('cta_text', 'facebook', 'twitter', 'googleplus', 'linkedin', 'ouraffiliatestitle', 'gmap_api_key', 'gmap_height', 'blog_widget_title', 'blog_widget_bg_image_opacity', 'google_analytics', 'fixed_header_offset');
            $url_fields_full = array('mainlogo', 'appletouch', 'favicon', 'cta_link', 'blog_widget_bg_image');
            $checkboxes = array('heromesh', 'footerhero', 'gmap_scroll', 'gmap_infowindow_address', 'gmap_infowindow_link', 'lazyloading', 'fixed_header');
            
            
            // a) full string
            if (in_array($key, $text_fields_full)) {
                $output[$key] = sanitize_text_field( $input[$key] );
            }
            // b) string contains
            // - use a class, or something smarter to output this:
            // - foreach loop
            if (strpos($key, 'company_') !== false)  {
                $output[$key] = sanitize_text_field( $input[$key] );
            }
            elseif (strpos($key, 'ML') !== false)  {
                $output[$key] = sanitize_text_field( $input[$key] );
            }
            elseif (strpos($key, 'twitter_') !== false)  {
                $output[$key] = sanitize_text_field( $input[$key] );
            }
            elseif (strpos($key, 'aff_alt') !== false)  {
                $output[$key] = sanitize_text_field( $input[$key] );
            }
            elseif (strpos($key, 'aff_width') !== false)  {
                $output[$key] = sanitize_text_field( $input[$key] );
            }
            elseif (strpos($key, 'aff_height') !== false)  {
                $output[$key] = sanitize_text_field( $input[$key] );
            }

            
            
            
            
            
            
            // ____________________________________
            // urls

            // header and footer:
            // 2 - mainlogo, appletouch, favicon
            // 3 - cta_link
            // 6 - aff_logo*

            // in page:
            // 2 - blog_widget_bg_image
            
            elseif (in_array($key, $url_fields_full)) {
                $output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
            }
            elseif (strpos($key, 'aff_logo') !== false)  {
                $output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
                

            // NOTE:
            // header cta not working
            // foreach( $input as $key => $val ) {
            //     if ( isset ( $input[$key] ) ) {
            //         $output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
            //     }
            // }
            
            // ____________________________________
            // checkboxes

            // header and footer:
            // 7 - heromesh, footerhero
            // in page:
            // 1 - gmap_scroll, gmap_infowindow_address, gmap_infowindow_link
            // functionality:
            // 2 - lazyloading
            // 3 - fixed_header

            
			} elseif (in_array($key, $checkboxes))  {
                $output[$key] = filter_var( $input[$key], FILTER_SANITIZE_NUMBER_INT );
            }

            else {

            }





            
            // // select / dropdown
			// } elseif (strpos($key, 'aff_height') !== false)  {
            //     $output[$key] = sanitize_text_field( $input[$key] );
            
			// } // radio buttons
			// elseif (strpos($key, 'alttext') !== false)  { 
			// 	$output[$key] = sanitize_text_field( $input[$key] );
            // }
            


            // - - - - - - -
            // notes:
            // (strpos($key, 'aff_alt') !== false) - if key contains this. Actual key is 'aff_alt_1', etc
            // http://php.net/manual/en/function.strpos.php

            // $key == 'whatever' didn't work too well with text fields. Needed to strpos.
			


		}
	}
    return apply_filters( 'sandbox_theme_universal_sanitize', $output, $input );
}






?>


