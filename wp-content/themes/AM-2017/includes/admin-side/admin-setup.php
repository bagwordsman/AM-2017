<?php
// admin setup
// - general settings across the whole theme added here

// 1 - allow user to update theme options
// 2 - redirect login for subscribers (NOT USED)
// 3 - add meta fields to media uploader
// 4 - webmaster credits
// 5 - dashboard user guide


// _______________________________________________________
// 1 - allow user (with administrator role) to update theme options (i.e. company details)
// - stops 'Cheatin' uh? from displaying when logging into the dashboard as admin
function add_theme_caps() {
    $user = new WP_User( 2 );
	$user->add_cap( 'manage_options' );
}
add_action( 'admin_init', 'add_theme_caps');


// _______________________________________________________
// 2 - redirect login for subscribers to /sample-page
// function redirect_subscriber_login() {
//     global $current_user;
//     get_currentuserinfo();
//     // If login user role is Subscriber
//     if ($current_user->user_level == 0){
//         wp_redirect( home_url('/sample-page') ); exit;
//     }
// }
// add_action('admin_init', 'redirect_subscriber_login');



// _______________________________________________________
// 3 -  add meta fields to media uploader for attachment pages
// - useful for image heavy websites, e.g. image attachment pages
function image_attachment_metadata( $form_fields, $post ) {
	$form_fields['meta-title'] = array(
		'label' => 'Meta Title',
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'meta_title', true ),
		'helps' => 'Display a title tag specific to the image',
	);
	$form_fields['meta-description'] = array(
		'label' => 'Meta Description',
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'meta_description', true ),
		'helps' => 'Display a meta description specific to the image',
	);
	$form_fields['meta-keywords'] = array(
		'label' => 'Meta Keywords',
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'meta_keywords', true ),
		'helps' => 'Display meta keywords specific to the image',
	);
	return $form_fields;
}
add_filter( 'attachment_fields_to_edit', 'image_attachment_metadata', 10, 2 );

/* Save metadata in media uploader */
function image_attachment_field_credit_save( $post, $attachment ) {
	if( isset( $attachment['meta-title'] ) )
		update_post_meta( $post['ID'], 'meta_title', $attachment['meta-title'] );
	if( isset( $attachment['meta-description'] ) )
		update_post_meta( $post['ID'], 'meta_description', $attachment['meta-description'] );
	if( isset( $attachment['meta-keywords'] ) )
		update_post_meta( $post['ID'], 'meta_keywords', $attachment['meta-keywords'] );
	return $post;
}

add_filter( 'attachment_fields_to_save', 'image_attachment_field_credit_save', 10, 2 );



// _______________________________________________________
// 4 - webmaster credits at bottom of admin panel
function remove_footer_admin () {
echo 'Website Designed and Built by <a href="http://www.martinbagshaw.co.uk" target="_blank">Martin Bagshaw</a></p>';
}
add_filter('admin_footer_text', 'remove_footer_admin');


// _______________________________________________________
// 5 - dashboard user guide
// add custom dashboard widget at the top of the dashboard //
function user_guide_function() {
	$user = wp_get_current_user();
	// - used to show different message for different level of user
	// - see able mediation old theme for a more extensive example of this widget
	echo '
	<div class="quick-links">
		<h3>User Guide</h3>
		<div class="home-widget">
			<div>
				<p>A brief user guide / reference point for website settings:</p>
				<ul style="margin-bottom : 40px;">
					<li><strong>Menus</strong><br/>- including: \'Navigation Labels\' and \'Abbreviations\' for shorter page titles.</li>
					<li><strong>Posts and Pages</strong><br/>- including: Manual Excerpts, where to use Slugs, Metadata, and accordions</li>
					<li><strong>Widgets</strong><br/>- including: Blog sidebars (categories, tags, featured posts), and Cookie Bar.</li>
					<li><strong>Theme Settings Page</strong><br/>- everything else.</li>
				</ul>
				<p><span class="red--text">A note on character / word count for certain text:</span></p>
				<p>Please review the lengths of: page headings, page and post excerpts, and in page calls to action when adding them.
				These sections of text have limited container sizes to fit into. As a general rule of thumb, they will work best at all screen sizes if kept shorter. It is hard to recommend character counts for each, as longer words will affect how the text wraps.</p>
				<p>It is advised that you test each of these sections at different screen sizes after publishing them.</p>
			</div>
			<div>

				<div class="accordion single-column">
					
					<h4>Menus</h4>
					<div>
						<p>Go to <a href="nav-menus.php">Appearance > Menus</a> to configure the menus.</p>

						<p>Select from the dropdown at the top left of the panel which menu you would like to edit (Quick Links and Services are displayed in the footer),
						and drag and drop items in the order you would like, indenting them to designate them as child items.</p>
						
						<p><strong>Navigation Labels</strong></p>
						
						<p>You will probably want to use shorter versions of the page titles, in order to take up less space in the menu.
						For example, <em class="light-grey--text">\'Legal Aid\'</em> may be preferable to <em class="light-grey--text">\'Legal Aid for Family Mediation\'</em> when there is not much space available.</p>
						
						<p>In the dropdown for each page in the menu, enter a shortened title in the <span class="red--text">\'Navigation Label\'</span> text field, if required.</p>

						<p>The <em class="light-grey--text">\'Navigation Label\'</em> text will also be used in containers on 
						<em class="light-grey--text">\'About Our Services\'</em> page - the services parent page.</p>

						<p><strong>Abbreviations</strong></p>

						<p>On medium sized screens such as tablet devices, you may want to reduce menu item label length further, so that text in the main menu does not break onto 2 lines.</p>

						<p>In the dropdown for each page in the menu, enter an abbreviated title in the <span class="red--text">\'Abbreviation\'</span> text field, if required.</p>

						<p>Abbreviations will be active when the screen is between 800px and 980px in width.</p>

					</div>




					<h4>Blog Posts and Pages</h4>
					<div>

						<p>In an individual blog post or page, use the <span class="red--text">\'Screen Options\'</span> tab in the top right hand corner to view the list of options available.</p>
						
						<p>
						<em class="light-grey--text">\'Excerpt\'</em>,
						<em class="light-grey--text">\'Custom Fields\'</em>,
						<em class="light-grey--text">\'Slug\'</em>, and
						<em class="light-grey--text">\'Featured Image\'</em> will be the most commonly used options.</p>
						
						<p>In pages (as opposed to blog posts), you will also be able to toggle content areas provided by the Advanced Custom Fields Plugin. 
						If a content area or section is not showing, the <em class="light-grey--text">\'Screen Options\'</em> tab should be your first port of call.</p>

						<p><strong>Excerpt</strong></p>

						<p>Manual Excerpts determine the snippets of information in each of the containers on the 
						<em class="light-grey--text">\'About Our Services\' page</em>. 
						If an excerpt is not defined, the text here will default to the first 20 characters or the page content.</p>

						<p>You can find the <span class="red--text">\'Excerpt\'</span> text area by scrolling to the bottom of the page 
						/ post editor when the Excerpt box in <em class="light-grey--text">\'Screen Options\'</em> section is checked.</p>

						
						
						<p><strong>Custom Fields</strong></p>

						<p>Custom Fields are used for adding page metadata, specifically the Title Tag and Meta Description that are visible in Google Search results.</p>

						<p>To configure these, go to the <span class="red--text">\'Custom Fields\'</span> section at the bottom of the page or post, 
						and enter the following names, assigning the values you wish them to have before updating or publishing the page or post:</p>

						<ul class="admin-list">
							<li><span class="p-red--bg">Title Tag</span></li>
							<li><span class="p-orange--bg">Meta Description</span></li>
							<li><span class="p-green--bg">Meta Keywords</span> - not so important</li>
						</ul>

						
						
						<p><strong>Slug</strong></p>

						<p>Currently, the Slug is only used in combination with the <a href="widgets.php">Featured Post Widget</a>.</p>
						
						<p>This acts as an identifier to grab the post title, thumbnail, and other information, and output it in a container in the sidebar or footer on the blog.</p>

						<p>To get the Slug, go to the <span class="red--text">\'Slug\'</span> section at the bottom of a post, and copy and paste it for use in the Featured Post Widget.</p>

						
						
						<p><strong>Featured Image</strong></p>

						<p>Also commonly referred to as a <em class="light-grey--text">\'Thumbnail\'</em>, the Featured Image should be added to all posts and pages.</p>

						<p>The Featured Image defines the hero image on pages, the image at the top of single posts, 
						and smaller <em class="light-grey--text">\'thumbnails\'</em> found in featured post widgets 
						and the items on the <em class="light-grey--text">\'About Our Services\'</em> page.</p>

						<p>A standard dimension for the Featured Image is 1800px x 900px.</p>

						<p>The <span class="red--text">\'Featured Image\'</span> section can be found on the right hand side of the page or post editor,
						when the respective box in the <em class="light-grey--text">\'Screen Options\'</em> section is checked.</p>


						<p><strong>Accordions</strong></p>

						<p>Accordions are a slightly more technical feature that I have included, which serve to make the most out of a smaller amount of space.</p>
						<p>Each section header can be clicked to reveal it\'s contents, thereby minimising the total vertical height of the page.</p>

						<p>The html required for an accordion is as follows:</p><br/>

						<code>
						[accordion]
						<br/>
						&#160;&#160;
						&lt;h3&gt;
						Section heading
						&lt;&#47;h3&gt;

						<br/>
						&#160;&#160;
						&lt;&#33;&#45;&#45;
						more
						&#45;&#45;&gt;

						<br/>
						&#160;&#160;
						&lt;p&gt;
						section contents
						&lt;&#47;p&gt;

						<br/>
						&#160;&#160;
						&lt;hr&#47;&gt;


						<br/>
						&#160;&#160;
						&lt;h3&gt;
						Section heading
						&lt;&#47;h3&gt;

						<br/>
						&#160;&#160;
						&lt;&#33;&#45;&#45;
						more
						&#45;&#45;&gt;

						<br/>
						&#160;&#160;
						&lt;p&gt;
						section contents
						&lt;&#47;p&gt;

						<br/>
						[/accordion]
						</code>

						<p>The \'more\' tag and \'hr\' tag will be highlighted in green in the content editors for the second and third sections in \'Able Default\' page templates.</p>
						<p>The \'hr\' tag is labelled in the content editor as the \'horizontal line\' button.</p>

					</div>



					<h4>Widgets</h4>
					<div>
						<p>There are three widget areas in the <a href="widgets.php">Widgets</a> section.</p>

						<p>Drag widgets into the widget areas, configure them, and click their respective <em class="light-grey--text">\'Save\'</em> buttons to save changes.</p>

						<p>Note that the <span class="red--text">\'Blog - Footer\'</span> widget area should have a maximum of 3 widgets in.
						Any more, and widgets will break onto a new line.</p>
					</div>


					<h4>Theme Settings Page</h4>
					<div>
						<p>The lion\'s share of website settings can be configure on the <a href="admin.php?page=sandbox">Theme Settings Page</a>.</p>

						<p>This includes company details, logos, social network links, tweets, google map, blog settings - including in page advert, google analytics, and fixed header toggle.</p>
					</div>

				</div>

			</div>
		</div><!-- home widget -->
	</div>
	<script>
	jQuery(document).ready(function( $ ) {
		$( function() {
			$( ".accordion:nth-child(1n)" ).accordion({
				heightStyle: "content"
			});

			$("#welcome-panel").after($("#user_guide").show());
		} );
	});
	</script>
	';

}
function example_add_dashboard_widgets() {
	wp_add_dashboard_widget('user_guide', 'How to use the Able Mediation Website', 'user_guide_function');
	global $wp_meta_boxes;
	$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
	$example_widget_backup = array('user_guide' => $normal_dashboard['user_guide']);
	unset($normal_dashboard['user_guide']);
	$sorted_dashboard = array_merge($example_widget_backup, $normal_dashboard);
	$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}
add_action('wp_dashboard_setup', 'example_add_dashboard_widgets' );
?>
