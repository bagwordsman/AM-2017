(function($){

	// JS for Able Mediation Page Content:
	//	- handles stuff in pages and post editor

	// File Contents:
	// 1 - Remove the default textarea
	// 2 - Colour Marker (sidebars etc)
	// 3 - Anchor link / ID Helper
	// + in page anchor constructor
	// + colour marker constructor

	// ––––––––––––––––––––––––––––––––––––––––––––––––––

	"use strict";

	// ––––––––––––––––––––––––––––––––––––––––––––––––––
	// 1 - Remove the default textarea before displaying WSIWYG editor
	$('#description').parents('tr').remove();
	
		
	
	// ––––––––––––––––––––––––––––––––––––––––––––––––––
	// 2 - Colour Marker (sidebars etc)

	// checkbox (radio) groups
	const $box1 = "input[name='acf[field_59467757ba235]']"; // home page hero
	const $box2 = "input[name='acf[field_595c0af112ddc]']"; // 1st section sidebar - default page
	const $box3 = "input[name='acf[field_5a96f5e2ec133]']"; // 2nd section sidebar - default page
	const $box4 = 'input[name="acf[field_595c0e7230aff]"]'; // 2nd section sidebar - home page
	const $box5 = 'input[name="acf[field_5943b161451da]"]'; // end of content cta - home page
	const $box6 = 'input[name="acf[field_59465b96adac7]"]'; // cta / linked page
	
	// ________
	// elements
	// hero - home page
	const $elem1_a = '#acf-group_5bbde6e1437ff';
	const $elem1_b = '';
	// 1st section sidebar - default page
	const $elem2_a = ".acf-postbox.seamless > .inside > .acf-field[data-name='first_section_sidebar']";
	const $elem2_b = "div[data-name='first_section_sidebar_colour'] .acf-label label";
	// 2nd section sidebar - default page
	const $elem3_a = ".acf-postbox.seamless > .inside > .acf-field[data-name='second_section_sidebar']";
	const $elem3_b = "div[data-name='second_section_sidebar_colour'] .acf-label label";
	// 2nd section sidebar - home page
	const $elem4_a = ".acf-postbox.seamless > .inside > .acf-field[data-name='second_section_sidebar']";
	const $elem4_b = "div[data-name='second_section_sidebar_colour'] .acf-label label";
	// end of content - home page
	const $elem5_a = "div[data-name='end_of_content_cta_colour'] .acf-label label";
	const $elem5_b = '';
	// cta / linked page
	const $elem6_a = '#acf-group_5bbde6e35bfa2';
	const $elem6_b = '';

	const items = (function() {
		const settings = {
			checkboxes : [ $box1, $box2, $box3, $box4, $box5, $box6 ],
			elements : [ [$elem1_a, $elem1_b], [$elem2_a, $elem2_b], [$elem3_a, $elem3_b], [$elem4_a, $elem4_b], [$elem5_a, $elem5_b], [$elem6_a, $elem6_b]]
		};
		return settings;
	}());

	// output colour marker code
	$(items.checkboxes).each(function(i) {
		const checkBox = this;
		const elements = items.elements[i];
		// console.log(checkBox, elements);
		const output = new colourMarker(checkBox, elements);
		output.code();
	});

	
	
	// ––––––––––––––––––––––––––––––––––––––––––––––––––
	// Colour Marker Constructor
	// - constructor takes a string, followed by [array]
	function colourMarker(boxes, elements) {
        this.code = function () {
			// checked box
			let checked;
			$(boxes).each(function() {
				if(this.checked) {
					checked = $(this)[0];
					// console.log($(this)[0]);
				}
			});
			$(boxes).change(applyColour); // on user action
			$(checked).each(applyColour); // onload
			// apply colour
			function applyColour() {
				const colour = this.value;
				// use value, not the index
				$(elements).each(function(i, v) {
					$(v).removeClass('default none transparent green orange blue red').addClass(colour);
				});
			}
			
        }
	}


	// ––––––––––––––––––––––––––––––––––––––––––––––––––
	// 3 - Anchor link / ID Helper
	// - needs fixing after update

	// get permalink for current page
	// + remove trailing slash
	const pLink = $('#sample-permalink').text().replace(/\/$/, "");
	// console.log(pLink);

	// section section anchor
	const anchor_s2 = $('div[data-name="second_section_id"]')[0];
	const s2_output = new anchorHash(anchor_s2, pLink);
	s2_output.code();

	// last section anchor
	const anchor_last = $('div[data-name="last_section_id"]')[0];
	const last_output = new anchorHash(anchor_last, pLink);
	last_output.code();
	

	
	
	// ––––––––––––––––––––––––––––––––––––––––––––––––––
	// In Page Anchor Constructor
	// - needs fixing after update
	function anchorHash(section, permalink) {
		this.code = function () {
			// add permalink to url
			$(section).find('.anchor-url').text(permalink);
			// update ID on load and change
			$(section).find('input[type="text"]').change(updateID).each(updateID);
			function updateID() {
				$(section).find('.anchor-id').text(`#${this.value}`);
			}
		}
	}

})(jQuery);