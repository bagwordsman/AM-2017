(function($){
		// Remove the default textarea before displaying WSIWYG editor
		// need to keep am eye on this one - it acts inconsistently
		
		//$('#description').parents('tr').remove();


		// -----------------------
		// Move Profile Stuff around to reflect how it displays on the page
		$( '.profile-image' ).after( $( '.profile-info' ) );
		$( '.profile-info' ).before( $( '.user-title-wrap' ) );

		// Create a Container
		$('.profile-image, .user-title-wrap, .profile-info').wrapAll('<div id="mediator-profile">');

		// Create a table for job title
		$( '.user-title-wrap' ).wrap( '<div class="profile-description"><table class="form-table"><tbody></tbody></table></div>' );


		// -----------------------
		// Remove capabilities text
		$('.user-capabilities-wrap').parents('table').prev('h2').remove();
		$('.user-capabilities-wrap').parents('table').remove();



})(jQuery);
