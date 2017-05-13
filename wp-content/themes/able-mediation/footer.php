<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
 		// footer info functions
		$name = get_the_author_meta('companyname',1);
		$number = get_the_author_meta('companynumber',1);
		$address = get_the_author_meta('registeredaddress',1);
		$twitter = get_the_author_meta('twitter',1);
		$facebook = get_the_author_meta('facebook',1);
		$googleplus = get_the_author_meta('googleplus',1);
		$linkedin = get_the_author_meta('linkedin',1);
		// footer logo functions
		$footerlogogreenheading = get_the_author_meta('footerlogogreenheading',1);
		$footerlogoheading = get_the_author_meta('footerlogoheading',1);
		// logo 1
		$footerlogo1 = get_the_author_meta('footerlogo1',1);
		$footerlogo1link = get_the_author_meta('footerlogo1link',1);
		$footerlogo1title = get_the_author_meta('footerlogo1title',1);
		// logo 2
		$footerlogo2 = get_the_author_meta('footerlogo2',1);
		$footerlogo2link = get_the_author_meta('footerlogo2link',1);
		$footerlogo2title = get_the_author_meta('footerlogo2title',1);
		// logo 3
		$footerlogo3 = get_the_author_meta('footerlogo3',1);
		$footerlogo3link = get_the_author_meta('footerlogo3link',1);
		$footerlogo3title = get_the_author_meta('footerlogo3title',1);
		// logo 4
		$footerlogo4 = get_the_author_meta('footerlogo4',1);
		$footerlogo4link = get_the_author_meta('footerlogo4link',1);
		$footerlogo4title = get_the_author_meta('footerlogo4title',1);
		// logo 3
		$footerlogo5 = get_the_author_meta('footerlogo5',1);
		$footerlogo5link = get_the_author_meta('footerlogo5link',1);
		$footerlogo5title = get_the_author_meta('footerlogo5title',1);
?>
</div><!-- #main .wrapper -->

<footer id="colophon" role="contentinfo" class="wrapper">

    <div class="footer-left">
    	<?php // footer menu
        wp_nav_menu( array( 'theme_location' => 'footernavigation', 'container' => false,'items_wrap' => '<ul id="footernavigation" class="footermenu">%3$s</ul>', ) );
		if ($name != '') {
			echo '<p><strong>Copyright '.date("Y").'</strong>  '.$name.'</p>';
		}
		if ($number != '') {
			echo '<p><strong>Registered Company Number  </strong>'.$number.'</p>';
		}
		if ($address != '') {
			echo '<p><strong>Correspondence Address  </strong>'.$address.'</p>';
		}
		?>
        <p class="author"><strong>Website design and build by</strong>
        <a title="Martin Bagshaw Graphic Designer and Frontend Developer" target="_blank" <?php if (!is_page( 42 )) echo 'rel="nofollow"'; ?> href="http://www.martinbagshaw.co.uk">Martin Bagshaw</a>
        </p>
    </div><!-- .left -->

    <div class="footer-right">
        <?php // footer logo heading
		if ($footerlogogreenheading != '' || $footerlogoheading != '') echo '<h3>';
		if ($footerlogogreenheading != '') echo '<span class="green">'.$footerlogogreenheading.'</span> ';
		if ($footerlogoheading != '') echo $footerlogoheading;
		if ($footerlogogreenheading != '' || $footerlogoheading != '') echo '</h3>';
		// footer logos
		if ($footerlogo1 != '' || $footerlogo2 != '' || $footerlogo3 != '' || $footerlogo4 != '' || $footerlogo5 != '') echo '
		<ul class="logocontainer">';
			// footer logos (1)
			if ($footerlogo1 != '') echo '
			<li>';
				if ($footerlogo1link != '') echo '
				<a href="'.$footerlogo1link.'" target="_blank">';
					if ($footerlogo1 != '') echo '
					<img src="'.$footerlogo1.'" alt="'.$footerlogo1title.'" title="'.$footerlogo1title.'" width="200" height="73" />';
				if ($footerlogo1link != '') echo '
				</a>';
			if ($footerlogo1 != '') echo '
			</li>';
			// footer logos (2)
			if ($footerlogo2 != '') echo '
			<li>';
				if ($footerlogo2link != '') echo '
				<a href="'.$footerlogo2link.'" target="_blank">';
					if ($footerlogo2 != '') echo '
					<img src="'.$footerlogo2.'" alt="'.$footerlogo2title.'" title="'.$footerlogo2title.'" width="200" height="109" />';
				if ($footerlogo2link != '') echo '
				</a>';
			if ($footerlogo2 != '') echo '
			</li>';
			// footer logos (3)
			if ($footerlogo3 != '') echo '
			<li>';
				if ($footerlogo3link != '') echo '
				<a href="'.$footerlogo3link.'" target="_blank">';
					if ($footerlogo3 != '') echo '
					<img src="'.$footerlogo3.'" alt="'.$footerlogo3title.'" title="'.$footerlogo3title.'" width="200" height="130" />';
				if ($footerlogo3link != '') echo '
				</a>';
			if ($footerlogo3 != '') echo '
			</li>';
			// footer logos (4)
			if ($footerlogo4 != '') echo '
			<li>';
				if ($footerlogo4link != '') echo '
				<a href="'.$footerlogo4link.'" target="_blank">';
					if ($footerlogo4 != '') echo '
					<img src="'.$footerlogo4.'" alt="'.$footerlogo4title.'" title="'.$footerlogo4title.'" width="200" height="112" />';
				if ($footerlogo4link != '') echo '
				</a>';
			if ($footerlogo4 != '') echo '
			</li>';
			// footer logos (5)
			if ($footerlogo5 != '') echo '
			<li>';
				if ($footerlogo5link != '') echo '
				<a href="'.$footerlogo5link.'" target="_blank">';
					if ($footerlogo5 != '') echo '
					<img src="'.$footerlogo5.'" alt="'.$footerlogo5title.'" title="'.$footerlogo5title.'" width="" height="" />';
				if ($footerlogo5link != '') echo '
				</a>';
			if ($footerlogo5 != '') echo '
			</li>';
		if ($footerlogo1 != '' || $footerlogo2 != '' || $footerlogo3 != '' || $footerlogo4 != '' || $footerlogo5 != '') echo '
		</ul><!-- .logocontainer -->
		';

		?>

        <?php // social icons
		if ($twitter != '' || $facebook != '' || $googleplus != '' || $linkedin != '' ) echo '
		<ul class="social">';
			if ($twitter != '')
        	echo '<li><a target="_blank" href="'.$twitter.'"><i class="fa fa-twitter-square" aria-hidden="true"></i><span class="assistive-text">Follow '.$name.' on Twitter</span></a></li>';
			if ($facebook != '')
        	echo '<li><a target="_blank" href="'.$facebook.'"><i class="fa fa-facebook-square" aria-hidden="true"></i><span class="assistive-text">Follow '.$name.' on Facebook</span></a></li>';
			if ($googleplus != '')
        	echo '<li><a target="_blank" href="'.$googleplus.'" rel="publisher"><i class="fa fa-google-plus-square" aria-hidden="true"></i><span class="assistive-text">Add '.$name.' to your Social Circles on Googleplus</span></a></li>';
			if ($linkedin != '')
        	echo '<li><a target="_blank" href="'.$linkedin.'"><i class="fa fa-google-plus-square" aria-hidden="true"></i><span class="assistive-text">Follow '.$name.' on Linkedin</span></a></li>';
			if ($twitter != '' || $facebook != '' || $googleplus != '' || $linkedin != '' ) echo '
		</ul><!-- .social -->';
		?>

    </div><!-- .right -->

</footer><!-- #colophon -->
</div><!-- #page -->


<?php wp_footer();
// if the site url does not contain 'localhost' (i.e. IS LIVE), add google analytics
$url = get_site_url();
if (strpos($url, 'localhost') == false){ ?>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-93508129-1', 'auto');
	  ga('send', 'pageview');

	</script>
<?php }
?>
</body>
</html>
