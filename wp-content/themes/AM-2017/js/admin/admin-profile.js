(function($){
	// user profiles
	// - move and add to html, so it can be styled as wished
	
	$('#description').parents('tr').remove();

	// reposition elements
	$( '.profile-image' ).after( $( '.profile-info' ) );
	$( '.profile-info' ).before( $( '.user-title-wrap' ) );

	// #mediator-profile container
	$('.profile-image, .user-title-wrap, .profile-info').wrapAll('<div id="mediator-profile">');

	// table for job title
	$( '.user-title-wrap' ).wrap( '<div class="profile-description"><table class="form-table"><tbody></tbody></table></div>' );

	// remove capabilities text
	$('.user-capabilities-wrap').parents('table').prev('h2').remove();
	$('.user-capabilities-wrap').parents('table').remove();

})(jQuery);