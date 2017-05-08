jQuery(document).ready(function( $ ) {
		
    var scrollTo = function(article) {
        $('.underline').removeClass('underline');
        article.addClass('underline');
        $('html, body').animate({
            scrollTop: article.offset().top - $('#fm-menu').height()
        }, 500);
    }
	
	$('article.fm1').attr('id', 'fm1');
	$('article.fm2').attr('id', 'fm2');
	$('article.fm3').attr('id', 'fm3');
	$('article.fm4').attr('id', 'fm4');
	$('article.fm5').attr('id', 'fm5');
	$('article.fm6').attr('id', 'fm6');
	$('article.fm7').attr('id', 'fm7');
	$('article.fm8').attr('id', 'fm8');
	$('article.fm9').attr('id', 'fm9');
		
$(function(){
	$('a[href*="mediation/#fm1"]').click(function(e) {
        scrollTo($('#fm1').eq($(this).index()));
        return false;
    });
	
	$('a[href*="mediation/#fm2"]').click(function(e) {
        scrollTo($('#fm2').eq($(this).index()));
        return false;
    });
	
	$('a[href*="mediation/#fm3"]').click(function(e) {
        scrollTo($('#fm3').eq($(this).index()));
        return false;
    });
	
	$('a[href*="mediation/#fm4"]').click(function(e) {
        scrollTo($('#fm4').eq($(this).index()));
        return false;
    });
	
	$('a[href*="mediation/#fm5"]').click(function(e) {
        scrollTo($('#fm5').eq($(this).index()));
        return false;
    });
	
	$('a[href*="mediation/#fm6"]').click(function(e) {
        scrollTo($('#fm6').eq($(this).index()));
        return false;
    });
	
	$('a[href*="mediation/#fm7"]').click(function(e) {
        scrollTo($('#fm7').eq($(this).index()));
        return false;
    });
	
	$('a[href*="mediation/#fm8"]').click(function(e) {
        scrollTo($('#fm8').eq($(this).index()));
        return false;
    });
	
	$('a[href*="mediation/#fm9"]').click(function(e) {
        scrollTo($('#fm9').eq($(this).index()));
        return false;
    });
	
	$('a[href*="mediation/#fm10"]').click(function(e) {
        scrollTo($('#fm10').eq($(this).index()));
        return false;
    });
	
	$('a[href*="mediation/#fm-menu"]').click(function(e) {
		scrollTo($('#fm-menu').eq($(this).index()));
        return false;
    });
	
	
});

var activeClass = 'underline', articles = $("#post-25 article");
        var first = articles.first().addClass(activeClass);
        articles.hover(function(){
            // remove the class from all sections who still have it, most likely only one.
            articles.filter("."+activeClass).removeClass(activeClass); 
            // add class to the element that was hovered.
            $(this).addClass(activeClass);					
        });
			
});