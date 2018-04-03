(function($){

	// JS for Able Mediation Theme Settings:
	//	- these settings are defined in includes/theme-options

	// File Contents:
	// 1 - Company Logos
	// 2 - Tweets
	// 3 - Affiliated Organisations Logos
	// 4 - Blog Options
	// 5 - Google Map
	// 6 - Google Analytics
	// 7 - Lazyloading
	// + logo upload constructor

	// ––––––––––––––––––––––––––––––––––––––––––––––––––

	"use strict";


	// ––––––––––––––––––––––––––––––––––––––––––––––––––
	// 1 - Company Logos
	// a) main logo
	const mainID = '.mainlogo';
	const mainLogo = new logoUpload(mainID);
	mainLogo.code();
	// b) apple touch
	const appleID = '.appletouch';
	const appleLogo = new logoUpload(appleID);
	appleLogo.code();
	// c) favicon
	const favID = '.favicon';
	const favLogo = new logoUpload(favID);
	favLogo.code();




	// ––––––––––––––––––––––––––––––––––––––––––––––––––
	// 2 - Tweets
	const opsTweets = $('#twitter_tweet_count');
	const birdie = $('.fa-twitter.orig')[0];
	const birdIcon = '<i class="fa fa-twitter" aria-hidden="true"></i>';
	const birds = {
		'one' : '',
		'two' : birdIcon,
		'three' : birdIcon + birdIcon + '<br>'
	}

	// on user action + onload
	$(opsTweets).change(addBirds).each(addBirds);
	
	function addBirds() {
		// remove previous birds
		$('#tweet .fa-twitter:not(.orig), br').remove();
		// add required amount
		const birdies = this.value;
		$(birdie).after(birds[birdies]);
	}
	
	
	
	
	// ––––––––––––––––––––––––––––––––––––––––––––––––––
	// 3 - Affiliated Organisations Logos
	// a) resolution logo
	const resolutionID = '.affiliate-logo_1';
	const resolutionLogo = new logoUpload(resolutionID);
	resolutionLogo.code();
	// b) fma logo
	const fmaID = '.affiliate-logo_2';
	const fmaLogo = new logoUpload(fmaID);
	fmaLogo.code();
	// c) college of mediators logo
	const comID = '.affiliate-logo_3';
	const comLogo = new logoUpload(comID);
	comLogo.code();
	// d) fmc logo
	const fmcID = '.affiliate-logo_4';
	const fmcLogo = new logoUpload(fmcID);
	fmcLogo.code();
	// e) 5th logo
	const fiveID = '.affiliate-logo_5';
	const fiveLogo = new logoUpload(fiveID);
	fiveLogo.code();
	// f) 6th logo
	const sixID = '.affiliate-logo_6';
	const sixLogo = new logoUpload(sixID);
	sixLogo.code();




	// ––––––––––––––––––––––––––––––––––––––––––––––––––
	// 4 - Blog Options
	// a) advert image
	const advertID = '.blog_ad_img';
	const advertLogo = new logoUpload(advertID);
	advertLogo.code();
	// b) widget background image
	const widgetID = '.widget_bg';
	const widgetImg = new logoUpload(widgetID);
	widgetImg.code();


	// –––––––––––––––––––––––––
	// b) image overlay + opacity
	const colourChoices = $('input[name="sandbox_theme_blog_options[blog_widget_bg_colour]"]');
	const colourChecked = $('input[name="sandbox_theme_blog_options[blog_widget_bg_colour]"]:checked');
	//
	const overlay = $(document).find(`${widgetID} .colour-overlay`);
	$(colourChoices).change(colourOverlay); // on user action
	$(colourChecked).each(colourOverlay); // onload

	function colourOverlay() {
		$(overlay).removeClass('none green orange blue red_dark grey_lighter grey').addClass(this.value);
	}
	// OVERLAY: trying to manipulate radio options for colour - use one var to get checked / selected:
	// console.log($(colourChoice.checked));
	// $('input[name="sandbox_theme_blog_options[blog_widget_bg_colour]"]:checked').each(colourOverlay);
	// const str = JSON.stringify(colourChoice);
	// $(`${colourChoice}:checked`).find(":checked").each(colourOverlay);
	
	const alphaContainer = $('#bg_image_slider')[0];
	const alphaSlider = $(alphaContainer).find('.v-slider')[0];
	const alphaReading = $(alphaContainer).find('input[type="text"]');
	const opacity = alphaReading.val()/100;
	const alphaImg = $('.widget_bg img')[0];
	const alphaIcon = $('#bg-opacity_icon')[0];

	$(alphaSlider).slider({
		orientation: "vertical",
		range: "min",
		min: 0,
		max: 100,
		value: 75,
		slide: function( event, ui ) {
			const alphaNew = ui.value;
			const opacityNew = alphaNew / 100;
			// update opacity value
			$(alphaReading).val(alphaNew);
			// apply to img
			$(alphaImg).css( 'opacity' , + opacityNew );
			$(alphaIcon).css( 'opacity' , + opacityNew );
		}
	});
	// on load:
	// - set slider at correct position
	$(alphaSlider).find('.ui-slider-handle').css('bottom' , alphaReading.val() + '%');
	$(alphaSlider).find('.ui-slider-range').css('height' , alphaReading.val() + '%');
	// - apply to img + icon
	$(alphaImg).css( 'opacity' , + opacity );
	$(alphaIcon).css( 'opacity' , + opacity );

	// img width - is this needed?
	// const alphaImgWidth = $(alphaImg).width();
	// $(alphaImg).css('width', alphaImgWidth);




	// –––––––––––––––––––––––––
	// c) light or dark theme
	const themeChoices = $('select[name="sandbox_theme_blog_options[blog_widget_theme]"]');
	$(themeChoices).change(lightDark); // on user action
	$(themeChoices).find(":selected").text(lightDark); // onload

	function lightDark() {
		$('#widget-theme').removeClass('light dark').addClass(this.value);
	}






	// ––––––––––––––––––––––––––––––––––––––––––––––––––
	// 5 - Google Map
	// - set height
	const mapContainer = $('#gmap_slider')[0];
	const mapSlider = $(mapContainer).find('.v-slider')[0];
	const mapReading = $(mapContainer).find('input[type="text"]');

	const mapHeight = new simpleSlider(mapSlider, mapReading, 250, 500, 400);
	mapHeight.code();




	// ––––––––––––––––––––––––––––––––––––––––––––––––––
	// 6 - Google Analytics
	const gaIcon = $('#analytics .fa-question')[0];
	const gaCode = $('#analytics input[type="text"]').val();
	const gaBtn = $('#analytics input[type="submit"]');
	$(gaIcon).hover(function(e){
		$(e.target).next().removeClass('hidden');
	});
	// - update button text
	if (gaCode) {
		$(gaBtn).val('Update Tracking ID');
	}






	// ––––––––––––––––––––––––––––––––––––––––––––––––––
	// 7 - Lazyloading
	const checked = 'Enable Lazyloading';
	const unchecked = 'Disable Lazyloading';

	if ( $("input[id^='lazyloading']").is(":checked") ) {
		// console.log('lazyloading checked');
		$('.lazyloading #submit').val(checked);
	} else {
		// console.log('lazyloading unchecked');
		$('.lazyloading #submit').val(unchecked);
	}

	$("input[id^='lazyloading']").change(function() {
		if ( $(this).is(":checked") ) {
			$('.lazyloading #submit').val(checked);
		} else {
			$('.lazyloading #submit').val(unchecked);
		}
	});




	// ––––––––––––––––––––––––––––––––––––––––––––––––––
	// 7 - Fixed Header
	// - set offset
	const headerContainer = $('#fixed_header_slider')[0];
	const headerSlider = $(headerContainer).find('.v-slider')[0];
	const headerReading = $(headerContainer).find('input[type="text"]');

	const headerOffset = new simpleSlider(headerSlider, headerReading, 0, 500, 250);
	headerOffset.code();



	



	
	
	// ––––––––––––––––––––––––––––––––––––––––––––––––––
	// Logo Upload constructor
	// - each logo has a unique class name, applied to parent of text fields
	// - each logo requires an alt text field at pos [1] in array
	function logoUpload(classID) {
        this.code = function () {
			// references to elements, and logo type
			const btn = $(classID).find("input[type='button']");
			const txtFields = $(classID).find("input[type='text']");
			const img = $(classID).find("img"); // const img = $(document).find(`${classID} img`);
			let logoType = $(document).find(`${classID}`).parent().prev();
			logoType = $(logoType).clone().children().remove().end().text(); // gets top level text only
			
			// upload button click
			$(btn).live('click', function(){
				// show thickbox / media upload
				tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		
				// when 'insert into post' is clicked:
				window.send_to_editor = function(html) {
					
					// take src from img that has just been uploaded
					// - img is wrapped in an <a> tag
					const url = $('img', html).attr('src');
					$(txtFields[0]).val(url);
					$(img).attr('src',url);

					// include img size
					// - exclude appletouch, favicon, and widget img
					if (!$.inArray(classID, ['.appletouch', '.favicon', '.widget_bg']) >= 0) {
						// .width() and .height() target wrapping <a> tag, therefore don't work
						const width = $('img', html).attr('width');
						const height = $('img', html).attr('height');
						$(txtFields[2]).val(width);
						$(txtFields[3]).val(height);
					}
					// remove thickbox / media upload
					tb_remove();
				}
				return false;
			});
		
			// if url field not empty, img is uploaded
			const uploaded = $(txtFields[0]).val();
			if (uploaded) {
				// show uploaded image
				$(img).attr('src', uploaded);
				// change the button text to 'Replace'
				$(btn).val(`Replace ${logoType}`);
				// update width, height, and alt text
				// - exclude appletouch, favicon, and widget img
				if (!$.inArray(classID, ['.appletouch', '.favicon', '.widget_bg']) >= 0) {
					const loadWidth = $(img).width();
					const loadHeight = $(img).height();
					$(txtFields[2]).val(loadWidth);
					$(txtFields[3]).val(loadHeight);
				}
			}
        }
	}




	// ––––––––––––––––––––––––––––––––––––––––––––––––––
	// Simple Slider constructor
	// - needs to be able to handle a min value of 0
	function simpleSlider(slider, reading, min, max, Default ) {
        this.code = function () {
			$(slider).slider({
				orientation: "vertical",
				range: "min",
				min: min,
				max: max,
				value: Default,
				slide: function(event, ui) {
					$(reading).val(ui.value);
				}
			});
			// on load:
			// - set slider at correct position
			const sliderPos = (reading.val() - min)/(max - min)*100;

			$(slider).find('.ui-slider-handle').css('bottom' , sliderPos + '%');
			$(slider).find('.ui-slider-range').css('height' , sliderPos + '%');
		}
	}
	// const mapSlider = new simpleSlider(slider, reading, 250, 500, 400);
	// mapSlider.code();



})(jQuery);