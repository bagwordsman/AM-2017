<?php
// google map shortcode

add_shortcode('google-map', 'google_map_shortcode_handler');

function google_map_shortcode_handler($atts, $content=null) {


		// API key
    $gmaps_data = get_option ( 'sandbox_theme_map_options' );
    $api_key = $gmaps_data['gmap_api_key'];

		// height
		$map_height = $gmaps_data['gmap_height'];

		// scroll to zoom
    $scroll_to_zoom = $gmaps_data['gmap_scroll'];
		if ($scroll_to_zoom != 1) {
				$scroll_to_zoom = 'scrollwheel: false,';
		} else {
				$scroll_to_zoom = 'scrollwheel: true,';
		}

		
		// info box / window
		$infowindow_view = $gmaps_data['gmap_infowindow'];
		// a) address
    $infowindow_address = $gmaps_data['gmap_infowindow_address'];
		if ($infowindow_address == 1) {
				$infowindow_address = '<p class="infobox--text">\' + address + \'</p>';
		} else {
				$infowindow_address = '';
		}
		// b) link to separate google map
    $infowindow_link = $gmaps_data['gmap_infowindow_link'];
		if ($infowindow_link == 1) {
				$infowindow_link = '<p class="infobox--link"><a href="\' + url + \' target="_blank">View location in Google Maps</a></p>';
		} else {
				$infowindow_link = '';
		}


    // map locations
	$location_1_name = $gmaps_data['gmap_location_1_name'];
    $location_1_address = $gmaps_data['gmap_location_1_address'];

    $location_2_name = $gmaps_data['gmap_location_2_name'];
    $location_2_address = $gmaps_data['gmap_location_2_address'];

    $location_3_name = $gmaps_data['gmap_location_3_name'];
    $location_3_address = $gmaps_data['gmap_location_3_address'];

    $location_4_name = $gmaps_data['gmap_location_4_name'];
	$location_4_address = $gmaps_data['gmap_location_4_address'];
	
	$location_5_name = $gmaps_data['gmap_location_5_name'];
	$location_5_address = $gmaps_data['gmap_location_5_address'];
	
	$location_6_name = $gmaps_data['gmap_location_6_name'];
    $location_6_address = $gmaps_data['gmap_location_6_address'];


		// Output the Google Map
		return '
		<div id="able-map-content" style="height:'. $map_height .'px"></div><script src="https://maps.googleapis.com/maps/api/js?key=' . $api_key . '" type="text/javascript"></script>
    <script>
		var locations = [
				[\'' . $location_1_name . '\', \'' . $location_1_address . '\', \'' . 'http://maps.google.com/?q=' . $location_1_address . '\' ],
				[\'' . $location_2_name . '\', \'' . $location_2_address . '\', \'' . 'http://maps.google.com/?q=' . $location_2_address . '\' ],
				[\'' . $location_3_name . '\', \'' . $location_3_address . '\', \'' . 'http://maps.google.com/?q=' . $location_3_address . '\' ],
				[\'' . $location_4_name . '\', \'' . $location_4_address . '\', \'' . 'http://maps.google.com/?q=' . $location_4_address . '\' ],
				[\'' . $location_5_name . '\', \'' . $location_5_address . '\', \'' . 'http://maps.google.com/?q=' . $location_5_address . '\' ],
				[\'' . $location_6_name . '\', \'' . $location_6_address . '\', \'' . 'http://maps.google.com/?q=' . $location_6_address . '\' ]
		];
		var geocoder;
		var map;
		var bounds = new google.maps.LatLngBounds();



		// initialise map
		// zoom and scroll
		function initialize() {
				map = new google.maps.Map(
						document.getElementById("able-map-content"), {
								zoom: 13, // changing zoom has no effect with multiple locations
								' . $scroll_to_zoom . '
								mapTypeId: google.maps.MapTypeId.ROADMAP
						});
				geocoder = new google.maps.Geocoder();

				for (i = 0; i < locations.length; i++) {
					geocodeAddress(locations, i);
				}
		}
		google.maps.event.addDomListener(window, "load", initialize);



		// geocode locations from addresses
		function geocodeAddress(locations, i) {
				var title = locations[i][0];
				var address = locations[i][1];
				var url = locations[i][2];
		  	geocoder.geocode({
		      	\'address\': locations[i][1]
		    },

		    function(results, status) {
						if (status == google.maps.GeocoderStatus.OK) {
										var marker = new google.maps.Marker({
										map: map,
										position: results[0].geometry.location,
										title: title,
										animation: google.maps.Animation.DROP,
										address: address,
										url: url
								})
								infoWindow(marker, map, title, address, url);
								bounds.extend(marker.getPosition());
								map.fitBounds(bounds);
						} else {
								// alert("geocode of " + address + " failed:" + status);
						}
		    });
		}


		// info window / box
		function infoWindow(marker, map, title, address, url) {

				// view box on mouseover (hover), or click
				google.maps.event.addListener(marker, "'. $infowindow_view .'", function() {
						var html = \'<div class="gmap-infobox"><h3 class="infobox--title">\' + title + \'</h3>'. $infowindow_address . $infowindow_link .'</div>\';
						iw = new google.maps.InfoWindow({
								content: html,
								maxWidth: 350
						});

						iw.open(map, marker);
				});

		}

		
		// create marker
		function createMarker(results) {
				var marker = new google.maps.Marker({
						map: map,
						position: results[0].geometry.location,
						title: title,
						animation: google.maps.Animation.DROP,
						address: address,
						url: url
				})
				bounds.extend(marker.getPosition());
				map.fitBounds(bounds);
				infoWindow(marker, map, title, address, url);
				return marker;
		}

		</script>
		';
}


?>
