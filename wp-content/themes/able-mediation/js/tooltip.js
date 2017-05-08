
var bar_state = jQuery.cookie('cookie_bar_hide');

if( bar_state !== "hidden" ) {
    jQuery('.cookies').show; // show bar
	jQuery.cookie('cookie_bar_hide', 'visible', { path: '/' }); // update (or set) the cookie to visible
  } else {
    jQuery('.cookies').hide; // hide bar
    jQuery.cookie('cookie_bar_hide', 'hidden', { path: '/' }); // update (or set) the cookie to hidden
  }
  
  
  jQuery(document).ready(function( $ ) {


// tooltip
$(function() {
$( document ).tooltip();
});

// add element id/ class for negative tooltip 
// $('#company-details').tooltip({
//     tooltipClass: "ui-tooltip-negative"
//  });



// cookie notice


// hide on click
$('.hide').click(function() {
        $('.cookies').slideUp(250);
		$.removeCookie('cookie_bar_hide');// stop multiple instances from occurring
		$.cookie('cookie_bar_hide', 'hidden', { path: '/' });
        return false;
    });

// if cookie is set to hidden, hide bar	
if ($.cookie("cookie_bar_hide") !== 'visible')
{
    $(".cookies").hide();
}


			
			
});