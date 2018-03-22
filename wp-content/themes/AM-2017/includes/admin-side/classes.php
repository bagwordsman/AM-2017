<?php
// classes
// - templates for repeated functionality


// header and footer: affiliated organisation logos
class affiliateLogos {
    var $number;
    function __construct($new_number) {		
        $this->number = $new_number;		
    }
    function add_fields() {
        add_settings_field(
            'aff_logo_'.$this->number, // option ID
            'Affiliate Logo '.$this->number, // label
            'img_callback', // callback - requires $args. Callbacks for input type
            'sandbox_theme_affiliates_options', // page it will be displayed on
            'affiliates_settings_section', // name of section
            array( // $args array - tailor the callback function
                'aff_logo_'.$this->number, // Should match Option ID
                $this->number // number to help admin-settings.js
            )
        );
        add_settings_field(
            'aff_alt_'.$this->number,
            '',
            'alt_text_callback',
            'sandbox_theme_affiliates_options',
            'affiliates_settings_section',
            array(
                'aff_alt_'.$this->number, // option ID
                'sandbox_theme_affiliates_options', // section ID
                'affiliate-logo_'.$this->number // class ID
            )
        );
        add_settings_field(
            'aff_width_'.$this->number,
            '',
            'img_width_height_callback',
            'sandbox_theme_affiliates_options',
            'affiliates_settings_section',
            array(
                'aff_width_'.$this->number,
                'sandbox_theme_affiliates_options',
                'affiliate-logo_'.$this->number
            )
        );
        add_settings_field(
            'aff_height_'.$this->number,
            '',
            'img_width_height_callback',
            'sandbox_theme_affiliates_options',
            'affiliates_settings_section',
            array(
                'aff_height_'.$this->number,
                'sandbox_theme_affiliates_options',
                'affiliate-logo_'.$this->number
            )
        );
    }
}




// in page: google map locations
class mapLocations {
    var $number;
    function __construct($new_number) {		
        $this->number = $new_number;		
    }
    function add_location() {
        add_settings_field(
            'gmap_location_'.$this->number.'_name', // option ID
            '<br>Office Location '.$this->number.'<br>
            <br><i class="fa fa-home black--text" aria-hidden="true"></i>Name', // label
            'text_callback', // callback - requires $args. Callbacks for input type
            'sandbox_theme_map_options', // page it will be displayed on
            'map_settings_section', // name of section
            array( // $args array - tailor the callback function
                'gmap_location_'.$this->number.'_name', // Should match Option ID
                'sandbox_theme_map_options', // section ID
                'top-margin--5-6'
            )
        );
        add_settings_field(
            'gmap_location_'.$this->number.'_address', // ID
            '<i class="fa fa-map-marker red--text" aria-hidden="true"></i>Address',
            'text_callback',
            'sandbox_theme_map_options',
            'map_settings_section',
            array(
                'gmap_location_'.$this->number.'_address', // ID
                'sandbox_theme_map_options'
            )
        );
    }
}



?>