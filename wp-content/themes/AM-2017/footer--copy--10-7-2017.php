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
$gmaps_data = get_option ( 'sandbox_theme_map_options' );
$api_key = $gmaps_data['gmap_api_key'];
$x_coord = $gmaps_data['gmap_x_coord'];
$y_coord = $gmaps_data['gmap_y_coord'];

// location 1
$location_1 = $gmaps_data['gmap_location_1'];

$gmap_contact = $gmaps_data['gmap_contact_page'];
?>

<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $api_key; ?>" type="text/javascript"></script>


<?php
// load map script for contact page
// div id = able-map-content
if (is_page('contact') and $gmap_contact): ?>

<script>
function initialize() {

// get coords from php
var x = "<?php echo $x_coord ?>";
var y = "<?php echo $y_coord ?>";
var name = "<?php echo $company_name ?>";
var address = "<?php echo $address ?>";

var myLatlng = new google.maps.LatLng(x, y);
  // set map options
	var mapOptions = {
    zoom: 15,
    center: myLatlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    scrollwheel: false
  }

  var map = new google.maps.Map(document.getElementById('able-map-content'), mapOptions);

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: name
  });

  // add the company address when marker is hovered over
	var contentString =
    '<div class="address">'+
    '<h1>'+ name +'</h1>'+
    '<p>'+ address +'</p>'+
    '</div>';

	var infowindow = new google.maps.InfoWindow({
    content: contentString
	});

google.maps.event.addListener(marker, 'mouseover', function() {
  infowindow.open(map,marker);
});
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>

<?php endif;
// end if contact page ?>


<?php wp_footer(); ?>
</body>
</html>
