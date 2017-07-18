(function($){
		// Remove the default textarea before displaying WSIWYG editor
		$('#description').parents('tr').remove();


		// -----------------------
		// Hero Right Hand Content - colour
		// set on load, and change on click
		$('input[name="fields[field_59467757ba235]"]').change(heroRightColour); // when user selects
		$('input[name="fields[field_59467757ba235]"]:checked').each(heroRightColour); // onload

		function heroRightColour() {
		    $('#acf_471344').removeClass('default green orange blue transparent').addClass(this.value);
		}



		// -----------------------
		// Sidebar - colour
		// set on load, and change on click

		// 1 - default pages
		$('input[name="fields[field_595c0af112ddc]"]').change(defaultSidebarColour); // when user selects
		$('input[name="fields[field_595c0af112ddc]"]:checked').each(defaultSidebarColour); // onload

		function defaultSidebarColour() {
		    $('#acf-first_section_sidebar').removeClass('none green orange blue red').addClass(this.value);
				$('#acf-first_section_sidebar_colour .label').removeClass('none green orange blue red').addClass(this.value);
		}

		// 2 - home page
		$('input[name="fields[field_595c0e7230aff]"]').change(homeSidebarColour); // when user selects
		$('input[name="fields[field_595c0e7230aff]"]:checked').each(homeSidebarColour); // onload

		function homeSidebarColour() {
		    $('#acf-second_section_sidebar').removeClass('none green orange blue red').addClass(this.value);
				$('#acf-second_section_sidebar_colour .label').removeClass('none green orange blue red').addClass(this.value);
		}






		// -----------------------
		// Optional Linked Page - colour
		// set on load, and change on click
		$('input[name="fields[field_59465b96adac7]"]').change(setColour); // when user selects
		$('input[name="fields[field_59465b96adac7]"]:checked').each(setColour); // onload

		function setColour() {
		    $('#acf_471302').removeClass('default green orange blue red').addClass(this.value);
		}






		// -----------------------
		// page ID helper
		
		// second section
		$('input[name="fields[field_596e4f15db272]"]').change(sectionID);
		$('input[name="fields[field_596e4f15db272]"]').each(sectionID);
		//$('input[name="fields[field_596e4f15db272]"]').val(sectionID);

		function sectionID() {
		    // value of text field
				var newID = this.value;
				console.log(newID);

				// label string to replace
				$('#acf-second_section_id .section-id span').text(newID);


				//$( newlabel ).text(function () {
					//$(this).replace('ID', 'bollocks');
				//})

				// var newlabel = $('#acf-second_section_id .label:contains("#your-ID")')
				// console.log(newlabel);

				//$('#acf-second_section_id .label label').text(function () {
				    //return $(this).text().replace('ID', 'bollocks');
				//});​​​​​

				//$(newlabel).replace('your-ID', newID);

		}


		// last section
		$('input[name="fields[field_596e7353182ef]"]').change(last_sectionID);
		$('input[name="fields[field_596e7353182ef]"]').each(last_sectionID);

		function last_sectionID() {
				var lastID = this.value;

				// insert ID
				$('#acf-last_section_id .section-id span').text(lastID);

		}






})(jQuery);
