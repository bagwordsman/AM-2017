jQuery(document).ready(function( $ ) {

	$('a.button').click(function(){		
		
		$(this).prev().css('height', 'auto');
		$(this).remove();
			
	});
	
});