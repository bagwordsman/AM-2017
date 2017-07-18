<?php
/**
 * The template for displaying the footer.
 *
 */

 $styling_options = get_option ( 'sandbox_theme_styling_options' );
 $footerhero = $styling_options['footerhero'];


?>

	</div><!-- .page -->
</div><!-- .page-wrap -->


<?php
// Affiliated Companies Logos
$affiliate_logo_options = get_option ( 'sandbox_theme_affiliates_options' );

// Title for companies affiliated with
$ouraffiliatestitle = $affiliate_logo_options['ouraffiliatestitle'];
// bold 'Able Mediation' in the title
$search = array('Able Mediation');
$replace = array('<strong>Able Mediation</strong>');
$ouraffiliatestitle = str_replace($search, $replace, $ouraffiliatestitle);

// Logos for companies affiliated with
$affiliatelogo1 = $affiliate_logo_options['affiliatelogo1'];
$affiliatelogo2 = $affiliate_logo_options['affiliatelogo2'];
$affiliatelogo3 = $affiliate_logo_options['affiliatelogo3'];
$affiliatelogo4 = $affiliate_logo_options['affiliatelogo4'];

// if any logo is present, echo the affiliates-band
if ($affiliatelogo1 != '' || $affiliatelogo2 != '' || $affiliatelogo3 != '' || $affiliatelogo4 != '')
echo '
<div id="affiliates-band" role="complementary">'
		. ( $ouraffiliatestitle ? ('<div class="container"><h4>'. $ouraffiliatestitle .'</h4></div>')  : '') .'
		<div class="container">';
				// echo each of the logos
				// remove title and assign to '$BL_title'
				$BL_title = array_shift($affiliate_logo_options);
				// create a multidimensional array - split into 3 part chunks
				$logogroup = array_chunk($affiliate_logo_options, 4);

				// separate out each logo
				foreach( $logogroup as $logo => $items ) {
						//var_dump($items);

            // only output logo if a url for it exists
            if ($items[0] != '') {

    						// preg_replace width and height - couldn't sanitise non-numeric data in functions.php
    						$width = preg_replace("/[^0-9,.]/", "", $items[2]);
    						$height = preg_replace("/[^0-9,.]/", "", $items[3]);

    						// output the image
    						echo '<img src="' . $items[0] .'" alt="' . $items[1] .'" width="' . $width .'" height="' . $height .'" />';

            }

				} // end foreach logo

		// if any logo is present, close the affiliates-band
		if ($affiliatelogo1 != '' || $affiliatelogo2 != '' || $affiliatelogo3 != '' || $affiliatelogo4 != '')
		echo
		'</div>
</div><!-- #affiliates-band -->';
?>



<div id="footer" role="contentinfo" <?php if ($footerhero) echo 'class="has-hero"'; ?>>

	<!-- company information part of footer -->
  <div class="company-info">
	   <div class="container">

			<div class="three columns">

          <?php
          // Output Menu Title
          $services_title = wp_get_nav_menu_object( 3 );
          $services_title = ($services_title -> name);
          echo ( $services_title ? ('<h4>'. $services_title .'</h4>')  : '<h4>Menu</h4>');
          ?>
					<ul class="footer-menu">
					<?php
					// function to remove <div> and <ul> which wrap the menu by default
					wp_services_menu_unwrap( array( 'theme_location' => 'services-menu') );
					?>
					</ul>
			</div>

      <div class="three columns">
          <?php
          // Output Menu Title
          $quicklinks_title = wp_get_nav_menu_object( 52 );
          $quicklinks_title = ($quicklinks_title -> name);
          echo ( $quicklinks_title ? ('<h4>'. $quicklinks_title .'</h4>')  : '<h4>Menu</h4>');
          ?>
					<ul class="footer-menu">
					<?php
					// function to remove <div> and <ul> which wrap the menu by default
					wp_quicklinks_menu_unwrap( array( 'theme_location' => 'quicklinks-menu') );
					?>
					</ul>
			</div>

			<div class="six columns">
				<!-- phone, email, and address -->
				<?php
				// company details
				$company_options = get_option ( 'sandbox_theme_company_options' );
				$phone = $company_options['company_phone'];
				// get dialable number from phone
				$search = array(' ', '(', ')', '-');
				$replace = array('', '', '', '');
				$dial = str_replace($search, $replace, $phone);
				// email and address
				$email = $company_options['company_email'];
				$address = $company_options['company_address'];

				if ($phone != '' || $email != '' || $address != '') echo '
					<h4>Contact Us</h4>
          <ul class="contact">';
						if ($phone != '' ) echo '
						<li><a href="tel:'.$dial.'"><i class="fa fa-phone" aria-hidden="true"></i>'.$phone.'</a></li>';
						if ($email != '' ) echo '
						<li><a href="mailto:'.$email.'"><i class="fa fa-envelope" aria-hidden="true"></i>'.$email.'</a></li>';
            if ($address != '' ) echo '
						<li><i class="fa fa-home" aria-hidden="true"></i>'.$address.'</li>';
				if ($phone != '' || $email != '' || $address != '') echo '
					</ul>';


        // tweet
        $tweet_link = get_option ( 'sandbox_theme_tweet_options' );
        $tweetheading = $tweet_link['embeddedtweetheading'];
        echo ( $tweetheading ? ('<h4>'. $tweetheading .'</h4>')  : '');

        $tweet = $tweet_link['embeddedtweet'];
        $tweet_id = filter_var($tweet, FILTER_SANITIZE_NUMBER_INT);
        $tweetlinkcolour = $tweet_link['embeddedtweetlinkcolor'];

        if ($tweet != '') echo '
        <div id="twitter-tweet"></div>
        <script src="https://platform.twitter.com/widgets.js"></script>
        <script>
        twttr.widgets.createTweet(
          "'. $tweet_id .'",
          document.getElementById("twitter-tweet"),
          {
            align: "left",
            '. ( $tweetlinkcolour ? ('linkColor : "'. $tweetlinkcolour .'",')  : '') .'
          })
          .then(function (el) {
            console.log("Tweet displayed.")
          }
        );
        </script>
        ';



        // social media
				$social_options = get_option ( 'sandbox_theme_social_options' );
				$facebook = $social_options['facebook'];
				$twitter = $social_options['twitter'];
				$googleplus = $social_options['googleplus'];
        $linkedin = $social_options['linkedin'];

				if ($facebook != '' || $twitter != '' || $googleplus != '' || $linkedin != '') echo '
				<h4>Follow Us on Social Media</h4>
        <ul class="social">';
				if ($facebook != '') echo '
				<li><a href="'.$facebook.'" target="_blank"><i class="fa fa-facebook-official" aria-hidden="true"></i> NMT Facebook</a></li>';
				if ($twitter != '') echo '
				<li><a href="'.$twitter.'" target="_blank"><i class="fa fa-twitter-official" aria-hidden="true"></i> NMT Twitter</a></li>';
				if ($googleplus != '') echo '
				<li><a href="'.$googleplus.'" target="_blank"><i class="fa fa-google-plus-official" aria-hidden="true"></i> NMT Google Plus</a></li>';
				if ($linkedin != '') echo '
				<li><a href="'.$linkedin.'" target="_blank"><i class="fa fa-linkedin-official" aria-hidden="true"></i> NMT Linkedin</a></li>'; ?>
				<?php if ($facebook != '' || $twitter != '' || $googleplus != '' || $linkedin != '') echo '
				</ul>';
				?>
			</div><!-- six columns -->
	</div><!-- container -->
</div><!-- company-info -->



	<!-- site credits -->
	<div class="site-credits">
    <div class="container">
  		<div class="eight columns">
        <?php
  			// company name
  			$company_name = $company_options['company_name'];
  			if ($company_name != '') echo '<p>© '.date("Y ").$company_name.'</p>';
  			// add another footer menu - for privacy poilcy and terms
  			?>
  		</div><!-- eight columns -->
  		<div class="four columns">
        	<a href="http://martinbagshaw.co.uk/" title="Martin Bagshaw Graphic Designer" target="_blank" <?php if (!is_page( 21 )) echo 'rel="nofollow"'; ?>>Website by Martin Bagshaw</a>
  		</div><!-- four columns -->
  	</div><!-- container -->
  </div><!-- site-credits -->

</div><!-- #footer -->







<?php
// add this stuff in contact page template


// google map
// 1 - general settings
$gmaps_data = get_option ( 'sandbox_theme_map_options' );
$api_key = $gmaps_data['gmap_api_key'];
// zoom and scroll
// doesn't work for maps with multiple markers
// $zoom_level = $gmaps_data['gmap_zoom'];
$scroll_to_zoom = $gmaps_data['gmap_scroll'];
// infowindow
$infowindow_view = $gmaps_data['gmap_infowindow'];
$infowindow_address = $gmaps_data['gmap_infowindow_address'];
$infowindow_link = $gmaps_data['gmap_infowindow_link'];


// 2 -locations
// location 1
$location_1_name = $gmaps_data['gmap_location_1_name'];
$location_1_address = $gmaps_data['gmap_location_1_address'];
// location 2
$location_2_name = $gmaps_data['gmap_location_2_name'];
$location_2_address = $gmaps_data['gmap_location_2_address'];
// location 3
$location_3_name = $gmaps_data['gmap_location_3_name'];
$location_3_address = $gmaps_data['gmap_location_3_address'];
// location 4
$location_4_name = $gmaps_data['gmap_location_4_name'];
$location_4_address = $gmaps_data['gmap_location_4_address'];


$gmap_contact = $gmaps_data['gmap_contact_page'];
?>

<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $api_key; ?>" type="text/javascript"></script>


<?php
// load map script for contact page
// div id = able-map-content
if (is_page('contact') and $gmap_contact): ?>

<script>
var locations = [
  ['<?php echo $location_1_name ?>', '<?php echo $location_1_address ?>', 'http://maps.google.com/?q=<?php echo $location_1_address ?>'],
  ['<?php echo $location_2_name ?>', '<?php echo $location_2_address ?>', 'http://maps.google.com/?q=<?php echo $location_2_address ?>'],
  ['<?php echo $location_3_name ?>', '<?php echo $location_3_address ?>', 'http://maps.google.com/?q=<?php echo $location_3_address ?>'],
  ['<?php echo $location_4_name ?>', '<?php echo $location_4_address ?>', 'http://maps.google.com/?q=<?php echo $location_4_address ?>']
];
var geocoder;
var map;
var bounds = new google.maps.LatLngBounds();


// initialise map
// zoom and scroll
function initialize() {
  map = new google.maps.Map(
    document.getElementById("able-map-content"), {
      <?php if ($zoom_level){ echo 'zoom: '. $zoom_level .','; } else { echo 'zoom: 13,'; } ?>
      <?php if ($scroll_to_zoom != 1){ echo 'scrollwheel: false,'; }  ?>
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
      'address': locations[i][1]
    },

    function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        var marker = new google.maps.Marker({
          //icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',
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
        alert("geocode of " + address + " failed:" + status);
      }
    });
}


// info box
function infoWindow(marker, map, title, address, url) {


  <?php if ($infowindow_view == 'click') : ?>
  // on click
  google.maps.event.addListener(marker, 'click', function() {
    var html = '<div class="gmap-infobox"><h3>' + title + '</h3>' + <?php if ($infowindow_address == 1) : ?> '<p>' + address + '</p>' <?php else: ?>''<?php endif; ?> + <?php if ($infowindow_link == 1) : ?> '<p><a href="' + url + '" target="_blank">View location in Google Maps</a></p>' <?php else: ?>''<?php endif; ?> + '</div>';
    iw = new google.maps.InfoWindow({
      content: html,
      maxWidth: 350
    });

    iw.open(map, marker);
  });


  <?php else: ?>
  // on mouseover
  google.maps.event.addListener(marker, 'mouseover', function() {
    var html = '<div class="gmap-infobox"><h3>' + title + '</h3>' + <?php if ($infowindow_address == 1) : ?> '<p>' + address + '</p>' <?php else: ?>''<?php endif; ?> + <?php if ($infowindow_link == 1) : ?> '<p><a href="' + url + '" target="_blank">View location in Google Maps</a></p>' <?php else: ?>''<?php endif; ?> + '</div>';
    iw = new google.maps.InfoWindow({
      content: html,
      maxWidth: 350
    });

    iw.open(map, marker);
  });

  <?php endif; ?>

}






function createMarker(results) {
  var marker = new google.maps.Marker({
    //icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',
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

<?php endif;
// end if contact page ?>


<?php wp_footer(); ?>
</body>
</html>
