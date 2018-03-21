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

	// checkbox groups
	const $box1 = 'input[name="fields[field_59467757ba235]"]'; // home page hero
	const $box2 = 'input[name="fields[field_595c0af112ddc]"]'; // 1st section sidebar
	const $box3 = 'input[name="fields[field_5a96f5e2ec133]"]'; // 2nd section sidebar (default only)
	const $box4 = 'input[name="fields[field_595c0e7230aff]"]'; // 2nd section sidebar (home only)
	const $box5 = 'input[name="fields[field_59465b96adac7]"]'; // cta / linked page
	// elements
	const $elem1_a = '#acf_471344'; // home page hero
	const $elem1_b = '';
	const $elem2_a = '#acf-first_section_sidebar'; // 1st section sidebar
	const $elem2_b = '#acf-first_section_sidebar_colour .label';
	const $elem3_a = '#acf-second_section_sidebar'; // 2nd section sidebar (default only)
	const $elem3_b = '#acf-second_section_sidebar_colour .label';
	const $elem4_a = '#acf-second_section_sidebar'; // 2nd section sidebar (home only)
	const $elem4_b = '#acf-second_section_sidebar_colour .label';
	const $elem5_a = '#acf_471302'; // cta / linked page
	const $elem5_b = '';

	const items = (function() {
		const settings = {
			checkboxes : [ $box1, $box2, $box3, $box4, $box5 ],
			elements : [ [$elem1_a, $elem1_b], [$elem2_a, $elem2_b], [$elem3_a, $elem3_b], [$elem4_a, $elem4_b], [$elem5_a, $elem5_b]]
		};
		return settings;
	}());

	// output colour marker code
	$(items.checkboxes).each(function(i, v) {
		const choices = this;
		const elements = items.elements[i];
		const output = new colourMarker(choices, elements);
		output.code();
	});



	// ––––––––––––––––––––––––––––––––––––––––––––––––––
	// 3 - Anchor link / ID Helper

	// get permalink (used for all iterations)
	const pLink = $('#sample-permalink').text();

	// section section anchor
	const anchor_s2 = $('#acf-second_section_id')[0];
	const s2_output = new anchorHash(anchor_s2, pLink);
	s2_output.code();

	// last section anchor
	const anchor_last = $('#acf-last_section_id')[0];
	const last_output = new anchorHash(anchor_last, pLink);
	last_output.code();
	

	
	
	// ––––––––––––––––––––––––––––––––––––––––––––––––––
	// In Page Anchor Constructor
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
				}
			});
			$(boxes).change(applyColour); // on user action
			$(checked).each(applyColour); // onload
			// apply colour
			function applyColour() {
				const colour = this.value;
				$(elements).each(function(i, v) {
					$(v).removeClass('default none transparent green orange blue red').addClass(colour);
				});
			}
			
        }
	}

})(jQuery);