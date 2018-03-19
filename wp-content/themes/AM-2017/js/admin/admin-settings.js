(function($){


		// JS for Able Mediation Theme Settings:
		//	- these settings are defined in functions.php
		//	- this js relies upon css in admin.css file
		//	- some js (for logos) was previously in a function called themelogo_js()



		// File Contents:
		// 1 - Company Logos
		// 2 - Embed a Tweet
		// 3 - Affiliated Organisations Logos
		// 4 - Display a Google Map of Your Location
		// 5 - Styling Options for the Blog
		// 6 - Google Analytics Tracking ID - helper






		// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		// 1 - Company Logos

		// a) Main Logo
		// display media upload editor
		jQuery(document).find("input[id^='uploadmainlogo']").live('click', function(){
		//var num = this.id.split('-')[1];
		formfield = jQuery('#mainlogo').attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

		// 'insert into post' button is clicked here:
		window.send_to_editor = function(html) {
		// the below outputs the window object:
		// console.log(this);

		// try adding ['prevObject'] before attr if the below does not work
		mynewimgurl = jQuery('img',html).attr('src');

		// console.log(mynewimgurl);

		// need to find dimensions - save these in a hidden field and output on client side
		mynewimgWidth = jQuery('img',html).width();
		mynewimgHeight = jQuery('img',html).height();

		jQuery('#mainlogo').val(mynewimgurl);
		jQuery('#MLwidth').val(mynewimgWidth);
		jQuery('#MLheight').val(mynewimgHeight);
		tb_remove();
		}
		return false;
		});

		// mainlogo - if logo has been uploaded..
		mainlogo = jQuery("input[id^='mainlogo']").val()
		if (jQuery("input[id^='mainlogo']").val()) {
			// Show the uploaded image
			jQuery('.mainlogo').attr('src', mainlogo);
			// If logo has been uploaded, change the button text to 'Replace'
			jQuery('#uploadmainlogo').val('Replace Main Company Logo');
		}


		// b) Apple Touch Icon
		// display media upload editor
		jQuery(document).find("input[id^='uploadappletouch']").live('click', function(){
			//var num = this.id.split('-')[1];
			formfield = jQuery('#appletouch').attr('name');
			tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

			// 'insert into post' button is clicked here:
			window.send_to_editor = function(html) {
				mynewimgurl = jQuery('img',html).attr('src');
				jQuery('#appletouch').val(mynewimgurl);
				tb_remove();
			}
			return false;
		});

		// appletouch - if icon has been uploaded..
		appletouch = jQuery("input[id^='appletouch']").val()
		if (jQuery("input[id^='appletouch']").val()) {
			// Show the uploaded image
			jQuery('.appletouch').attr('src', appletouch);
			// If logo has been uploaded, change the button text to 'Replace'
			jQuery('#uploadappletouch').val('Replace Apple Touch Icon');
		}



		// c) Favicon
		// display media upload editor
		jQuery(document).find("input[id^='uploadfavicon']").live('click', function(){
			//var num = this.id.split('-')[1];
			formfield = jQuery('#favicon').attr('name');
			tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

			// 'insert into post' button is clicked here:
			window.send_to_editor = function(html) {
				mynewimgurl = jQuery('img',html).attr('src');
				jQuery('#favicon').val(mynewimgurl);
				tb_remove();
			}
			return false;
		});

		// favicon - if favicon has been uploaded..
		favicon = jQuery("input[id^='favicon']").val()
		if (jQuery("input[id^='favicon']").val()) {
			// Show the uploaded image
			jQuery('.favicon').attr('src', favicon);
			// If logo has been uploaded, change the button text to 'Replace'
			jQuery('#uploadfavicon').val('Replace Favicon');
		}












		// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		// 2 - Embed a Tweet / Twitter
		// a) copy twitter link info
		$('.AM2017--options form.tweet .fa').hover(function(event){
		  event.preventDefault();
		  $('.embeddedtweet--info').removeClass('hidden');
		});


		// b) tweet colour scheme
		$('input[name="sandbox_theme_tweet_options[tweetcolour]"]').change(tweetColour); // when user selects
		$('input[name="sandbox_theme_tweet_options[tweetcolour]"]:checked').each(tweetColour); // onload

		function tweetColour() {
		    // replace hex values with colour classes
				// hex values (defined in functions.php) make the code on the client side shorter
				var hex = this.value;
				var colour = hex.replace('70bf44', 'green').replace('f07f37', 'orange').replace('339cff', 'blue').replace('da291c', 'red').replace('6a6a6a', 'dark-grey');
				console.log(colour);

				$('#tweetcolour_scheme').removeClass('green orange blue red dark-grey').addClass(colour);
		}


		// c) update button text if a tweet is present
		embeddedtweet = jQuery("input[id^='embeddedtweet']").val()
		if (jQuery("input[id^='embeddedtweet']").val()) {
			// If a tweet has been added alread, change the button text to 'Update'
			jQuery('.tweet #submit').val('Update Tweet');
		}









		// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		// 3 - Affiliated Organisations Logos


		// affiliatelogo1
		jQuery(document).find("input[id^='uploadaffiliatelogo1']").live('click', function(){
		//var num = this.id.split('-')[1];
		formfield = jQuery('#affiliatelogo1').attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

		// 'insert into post' button is clicked here:
		window.send_to_editor = function(html) {
		// the below outputs the window object:
		// console.log(this);

		// image I want is in prevObject:
		mynewimgurl = jQuery('img',html).attr('src');

		// need to find dimensions - save these in a hidden field and output on client side
		mynewimgWidth = jQuery('img',html).width();
		mynewimgHeight = jQuery('img',html).height();
		console.log(mynewimgWidth);
		console.log(mynewimgHeight);
		console.log(mynewimgurl);

		jQuery('#affiliatelogo1').val(mynewimgurl);
		jQuery('#AL1width').val(mynewimgWidth);
		jQuery('#AL1height').val(mynewimgHeight);
		tb_remove();
		}
		return false;
		});
		// affiliatelogo1 - if logo has been uploaded..
		affiliatelogo1 = jQuery("input[id^='affiliatelogo1']").val()
		if (jQuery("input[id^='affiliatelogo1']").val()) {
		  // Show the uploaded image
			jQuery('.affiliatelogo1').attr('src', affiliatelogo1);
			// If logo has been uploaded, change the button text to 'Replace'
			jQuery('#uploadaffiliatelogo1').val('Replace Affiliate Logo 1');
		}



		// affiliatelogo2
		jQuery(document).find("input[id^='uploadaffiliatelogo2']").live('click', function(){
		//var num = this.id.split('-')[2];
		formfield = jQuery('#affiliatelogo2').attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

		// 'insert into post' button is clicked here:
		window.send_to_editor = function(html) {
		// the below outputs the window object:
		// console.log(this);

		// image I want is in prevObject:
		mynewimgurl = jQuery('img',html).attr('src');

		// need to find dimensions - save these in a hidden field and output on client side
		mynewimgWidth = jQuery('img',html).width();
		mynewimgHeight = jQuery('img',html).height();
		//console.log(mynewimgWidth);
		//console.log(mynewimgHeight);
		//console.log(mynewimgurl);

		jQuery('#affiliatelogo2').val(mynewimgurl);
		jQuery('#AL2width').val(mynewimgWidth);
		jQuery('#AL2height').val(mynewimgHeight);
		tb_remove();
		}
		return false;
		});
		// affiliatelogo2 - if logo has been uploaded..
		affiliatelogo2 = jQuery("input[id^='affiliatelogo2']").val()
		if (jQuery("input[id^='affiliatelogo2']").val()) {
		  // Show the uploaded image
		  jQuery('.affiliatelogo2').attr('src', affiliatelogo2);
		  // If logo has been uploaded, change the button text to 'Replace'
		  jQuery('#uploadaffiliatelogo2').val('Replace Affiliate Logo 2');
		}

		// affiliatelogo3
		jQuery(document).find("input[id^='uploadaffiliatelogo3']").live('click', function(){
		//var num = this.id.split('-')[3];
		formfield = jQuery('#affiliatelogo3').attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

		// 'insert into post' button is clicked here:
		window.send_to_editor = function(html) {
		// the below outputs the window object:
		// console.log(this);

		// image I want is in prevObject:
		mynewimgurl = jQuery('img',html).attr('src');

		// need to find dimensions - save these in a hidden field and output on client side
		mynewimgWidth = jQuery('img',html).width();
		mynewimgHeight = jQuery('img',html).height();
		//console.log(mynewimgWidth);
		//console.log(mynewimgHeight);
		//console.log(mynewimgurl);

		jQuery('#affiliatelogo3').val(mynewimgurl);
		jQuery('#AL3width').val(mynewimgWidth);
		jQuery('#AL3height').val(mynewimgHeight);
		tb_remove();
		}
		return false;
		});
		// affiliatelogo3 - if logo has been uploaded..
		affiliatelogo3 = jQuery("input[id^='affiliatelogo3']").val()
		if (jQuery("input[id^='affiliatelogo3']").val()) {
		  // Show the uploaded image
		  jQuery('.affiliatelogo3').attr('src', affiliatelogo3);
		  // If logo has been uploaded, change the button text to 'Replace'
		  jQuery('#uploadaffiliatelogo3').val('Replace Affiliate Logo 3');
		}

		// affiliatelogo4
		jQuery(document).find("input[id^='uploadaffiliatelogo4']").live('click', function(){
		//var num = this.id.split('-')[4];
		formfield = jQuery('#affiliatelogo4').attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

		// 'insert into post' button is clicked here:
		window.send_to_editor = function(html) {
		// the below outputs the window object:
		// console.log(this);

		// image I want is in prevObject:
		mynewimgurl = jQuery('img',html).attr('src');

		// need to find dimensions - save these in a hidden field and output on client side
		mynewimgWidth = jQuery('img',html).width();
		mynewimgHeight = jQuery('img',html).height();
		//console.log(mynewimgWidth);
		//console.log(mynewimgHeight);
		//console.log(mynewimgurl);

		jQuery('#affiliatelogo4').val(mynewimgurl);
		jQuery('#AL4width').val(mynewimgWidth);
		jQuery('#AL4height').val(mynewimgHeight);
		tb_remove();
		}
		return false;
		});
		// affiliatelogo4 - if logo has been uploaded..
		affiliatelogo4 = jQuery("input[id^='affiliatelogo4']").val()
		if (jQuery("input[id^='affiliatelogo4']").val()) {
		  // Show the uploaded image
		  jQuery('.affiliatelogo4').attr('src', affiliatelogo4);
		  // If logo has been uploaded, change the button text to 'Replace'
		  jQuery('#uploadaffiliatelogo4').val('Replace Affiliate Logo 4');
		}

		// affiliatelogo5
		jQuery(document).find("input[id^='uploadaffiliatelogo5']").live('click', function(){
		//var num = this.id.split('-')[5];
		formfield = jQuery('#affiliatelogo5').attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

		// 'insert into post' button is clicked here:
		window.send_to_editor = function(html) {
		// the below outputs the window object:
		// console.log(this);

		// image I want is in prevObject:
		mynewimgurl = jQuery('img',html).attr('src');

		// need to find dimensions - save these in a hidden field and output on client side
		mynewimgWidth = jQuery('img',html).width();
		mynewimgHeight = jQuery('img',html).height();
		//console.log(mynewimgWidth);
		//console.log(mynewimgHeight);
		//console.log(mynewimgurl);

		jQuery('#affiliatelogo5').val(mynewimgurl);
		jQuery('#AL5width').val(mynewimgWidth);
		jQuery('#AL5height').val(mynewimgHeight);
		tb_remove();
		}
		return false;
		});
		// affiliatelogo5 - if logo has been uploaded..
		affiliatelogo5 = jQuery("input[id^='affiliatelogo5']").val()
		if (jQuery("input[id^='affiliatelogo5']").val()) {
		  // Show the uploaded image
		  jQuery('.affiliatelogo5').attr('src', affiliatelogo5);
		  // If logo has been uploaded, change the button text to 'Replace'
		  jQuery('#uploadaffiliatelogo5').val('Replace Affiliate Logo 5');
		}

		// affiliatelogo6
		jQuery(document).find("input[id^='uploadaffiliatelogo6']").live('click', function(){
		//var num = this.id.split('-')[6];
		formfield = jQuery('#affiliatelogo6').attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

		// 'insert into post' button is clicked here:
		window.send_to_editor = function(html) {
		// the below outputs the window object:
		// console.log(this);

		// image I want is in prevObject:
		mynewimgurl = jQuery('img',html).attr('src');

		// need to find dimensions - save these in a hidden field and output on client side
		mynewimgWidth = jQuery('img',html).width();
		mynewimgHeight = jQuery('img',html).height();
		//console.log(mynewimgWidth);
		//console.log(mynewimgHeight);
		//console.log(mynewimgurl);

		jQuery('#affiliatelogo6').val(mynewimgurl);
		jQuery('#AL6width').val(mynewimgWidth);
		jQuery('#AL6height').val(mynewimgHeight);
		tb_remove();
		}
		return false;
		});
		// affiliatelogo6 - if logo has been uploaded..
		affiliatelogo6 = jQuery("input[id^='affiliatelogo6']").val()
		if (jQuery("input[id^='affiliatelogo6']").val()) {
		  // Show the uploaded image
		  jQuery('.affiliatelogo6').attr('src', affiliatelogo6);
		  // If logo has been uploaded, change the button text to 'Replace'
		  jQuery('#uploadaffiliatelogo6').val('Replace Affiliate Logo 6');
		}




		// background image for widgets area
		// blog_widget_bg_image
		jQuery(document).find("input[id^='upload_blog_widget_bg_image']").live('click', function(){
		//var num = this.id.split('-')[1];
		formfield = jQuery('#blog_widget_bg_image').attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

		// 'insert into post' button is clicked here:
		window.send_to_editor = function(html) {
		// the below outputs the window object:
		// console.log(this);

		// image I want is in prevObject:
		mynewimgurl = jQuery('img',html).attr('src');
		//console.log(mynewimgurl);

		jQuery('#blog_widget_bg_image').val(mynewimgurl);
		tb_remove();
		}
		return false;
		});

		// blog_widget_bg_image - if logo has been uploaded..
		blog_widget_bg_image = jQuery("input[id^='blog_widget_bg_image']").val()
		if (jQuery("input[id^='blog_widget_bg_image']").val()) {
		  // Show the uploaded image
		  jQuery('.blog_widget_bg_image').attr('src', blog_widget_bg_image);
		  // If background image has been uploaded, change the button text to 'Replace'
		  jQuery('#upload_blog_widget_bg_image').val('Replace Blog Widgets Background Image');
		}















		// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		// 4 - Display a Google Map of Your Location / Google Map
		// a) Google Map Height
		$( function() {
			$( "#gmap_slider .v-slider" ).slider({
				orientation: "vertical",
				range: "min",
				min: 250,
				max: 500,
				value: 400,
				slide: function( event, ui ) {
					$( "#gmap_height" ).val( ui.value );
				}
			});
			//$( "#gmap_height" ).val( $( "#gmap_slider .v-slider" ).slider( "value" ) );
			$( "#gmap_height" ).val( $( "#gmap_height" ).val() );
		} );








		// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		// 5 - Styling Options for the Blog / Blog Styling
		// a) colour of widgets
		$('input[name="sandbox_theme_blog_options[blog_widget_bg_colour]"]').change(blogWidgetsColour); // when user selects
		$('input[name="sandbox_theme_blog_options[blog_widget_bg_colour]"]:checked').each(blogWidgetsColour); // onload

		function blogWidgetsColour() {
		    $('#bg-colour-brush').removeClass('none green orange blue red_dark grey_lighter grey').addClass(this.value);
			$('#blog_widget_bg_colour label').removeClass('none green orange blue red_dark grey_lighter grey').addClass(this.value);
			// opacity icon - greater context
			$('#bg-opacity_icon').removeClass('none green orange blue red_dark grey_lighter grey').addClass(this.value);
			// background colour
			$('.widget-bg-preview').removeClass('none green orange blue red_dark grey_lighter grey').addClass(this.value);

		}


		// b) widgets theme / colour scheme
		$('select[name="sandbox_theme_blog_options[blog_widget_theme]"]').change(blogWidgetsTheme); // when user selects
		$('select[name="sandbox_theme_blog_options[blog_widget_theme]"]').find(":selected").text(blogWidgetsTheme); // onload

		function blogWidgetsTheme() {
		    $('#widget-theme').removeClass('light dark').addClass(this.value);
		}



		// c) widgets background image - opacity
		$( function() {

			var bottom = $( "#blog_widget_bg_image_opacity" ).val();
			var opacity = bottom / 100;
			//console.log(opacity);

			$( "#bg_image_slider .v-slider" ).slider({
		    orientation: "vertical",
		    range: "min",
		    min: 0,
		    max: 100,
		    value: 75,
		    slide: function( event, ui ) {
		      var opacity_updated = ui.value;
					var opacity_fraction = opacity_updated / 100;

					// show value
					$( "#blog_widget_bg_image_opacity" ).val( opacity_updated );
					// apply to elements to preview
					$( ".widget-image-preview" ).css( 'opacity' , + opacity_fraction );
					$( "#bg-opacity_icon" ).css( 'opacity' , + opacity_fraction );
		    }
		  });
		  // set value of input field
		  $( "#blog_widget_bg_image_opacity" ).val( $( "#blog_widget_bg_image_opacity" ).val() );

			// set slider to the correct position
			$( '#bg_image_slider .v-slider .ui-slider-handle' ).css('bottom' , bottom + '%');
			$( '#bg_image_slider .v-slider .ui-slider-range' ).css('height' , bottom + '%');

			// apply to elements to preview - image and icon
			$( ".widget-image-preview" ).css( 'opacity' , + opacity );
			$( "#bg-opacity_icon" ).css( 'opacity' , + opacity );

		} );



		// d) set width of image background
		var width = $('.widget-image-preview').width();
		$('.widget-bg-preview').css('width', width);







		// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		// 6 - Google Analytics Tracking ID - helper
		// a) copy twitter link info
		$('.AM2017--options form.google_analytics .fa').hover(function(event){
		  event.preventDefault();
		  $('.google_analytics--info').removeClass('hidden');
		});


		// analytics_id - if an ID has been added...
		analytics_id = jQuery("input[id^='google_analytics']").val()
		if (jQuery("input[id^='google_analytics']").val()) {
		  // If background image has been uploaded, change the button text to 'Replace'
		  jQuery('.google_analytics #submit').val('Update Google Analytics Tracking ID');
		}







		// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		// 7 - Lazyloading

		var checked = 'Enable Lazyloading';
		var unchecked = 'Disable Lazyloading';


		if ( $("input[id^='lazyloading']").is(":checked") ) {
			console.log('checked');
			$('.lazyloading #submit').val(checked);
		} else {
			console.log('unchecked');
			$('.lazyloading #submit').val(unchecked);
		}


		$("input[id^='lazyloading']").change(function() {
				if ( $(this).is(":checked") ) {
						$('.lazyloading #submit').val(checked);
				} else {
						$('.lazyloading #submit').val(unchecked);
				}
		})
























})(jQuery);
