jQuery(document).ready(function( $ ) {


// ---------------------------
// header bar shrink on scroll
// need to accommodate for logo--custom in the css - default logo is 65px high
$(window).on('scroll touchmove', function () {
  $('.header').toggleClass('scrolled', $(document).scrollTop() > 0);
});






// ---------------------------
// html no-js
$( 'html' ).removeClass('no-js');



// ---------------------------
// tooltip
$(function() {
  $( '*' ).tooltip();
});

// add element id/ class for negative tooltip
$('#footer').tooltip({
    tooltipClass: 'ui-tooltip-negative'
});



// ---------------------------
// cookie notice
var bar_state = $.cookie('cookie_bar_hide');

if( bar_state !== "hidden" ) {
    $('.cookies').show; // show bar
	$.cookie('cookie_bar_hide', 'visible', { path: '/' }); // update (or set) the cookie to visible
  } else {
    $('.cookies').hide; // hide bar
    $.cookie('cookie_bar_hide', 'hidden', { path: '/' }); // update (or set) the cookie to hidden
    // should save this option to the database - so the bar doesn't load on page refresh
  }

// hide on click
$('.hide').click(function() {
    $('.cookies').slideUp(250);
		$.removeCookie('cookie_bar_hide');// stop multiple instances from occurring
    $(".header").removeClass('has-cookie-bar');
		$.cookie('cookie_bar_hide', 'hidden', { path: '/' });
        return false;
    });

// if cookie is set to hidden, hide bar
if ($.cookie("cookie_bar_hide") !== 'visible') {
    $(".cookies").hide();
    $(".header").removeClass('has-cookie-bar');
}




// ---------------------------
// mediator profile - read full profile

// hide full profile
$('.mediator-profile .full-profile').addClass('hidden');
// button click
$('.mediator-profile .button').click(function(event){
  event.preventDefault();
  $(this).parents().next().removeClass('hidden');
  $(this).remove();

});





// ---------------------------
// anchor link offset - compensate for fixed header
/*
if an #ID is the the address bar:
  - offset the top by the (fixed) header height + header for the section
  - h2 + bottom margin = 64px
  - on load used due to required ninja form scripts loading last (jquery can't calculate offset)
*/

// get any id from the url
var id = window.location.hash; // console.log(id);
console.log(id);

if (id) {
  $(window).scrollTop( $(id).offset().top) //
  $(id).addClass('padded'); // padded = header height + h2 height
}





// ---------------------------
// lazyloading


// end whole document
});
