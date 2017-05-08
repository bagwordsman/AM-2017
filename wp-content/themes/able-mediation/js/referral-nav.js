jQuery(document).ready(function( $ ) {
		
    var scrollTo = function(article) {
        $('html, body').animate({
            scrollTop: article.offset().top - $('.entry-title').height()
        }, 500);
    }

		
$(function(){
	$('a[href*="#ninja_forms_form_2_cont"]').click(function(e) {
        scrollTo($('div#ninja_forms_form_2_cont').eq($(this).index()));
        return false;
    });
	
	$('a[href*="#ninja_forms_form_3_cont"]').click(function(e) {
        scrollTo($('div#ninja_forms_form_3_cont').eq($(this).index()));
        return false;
    });
	
	$('a[href*="#post"]').click(function(e) {
		scrollTo($('article#post-1857').eq($(this).index()));
        return false;
    });
	
	
});

		
});