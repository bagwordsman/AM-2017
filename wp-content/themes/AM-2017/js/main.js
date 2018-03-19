jQuery(document).ready(function( $ ) {

// ---------------------------
// html no-js
$( 'html' ).removeClass('no-js');







// ___________________
// header - hide if scrolled
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $('.header').outerHeight();

$(window).scroll(function(event){
    didScroll = true;
});

setInterval(function() {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 250);

function hasScrolled() {
    var st = $(this).scrollTop();
    
    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTop - st) <= delta)
        return;
    
    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight){
        // Scroll Down
        $('.header').removeClass('down').addClass('up');
    } else {
        // Scroll Up
        if(st + $(window).height() < $(document).height()) {
            $('.header').removeClass('up').addClass('down');
        }
    }
    
    lastScrollTop = st;
}













// ___________________
// menu - text wrap


// ______________________
// 2 wraps idea, come back to this
// - 1st wrap - abbreviate menu text
// - 2nd wrap - activate small menu

// run function on resize
// $( window ).resize(function() {
//     menuMedium();
// });

// function menuMedium(){  
//     if (menu overflows) {
    // n++;
    // if (n = 1) {
        // abbrevTitle
    // }
    // if (n > 1) {
    //     small menu
    // }

    // }
// }

// run function on load
// let n = -1; // increments by 1 each time function is run
// menuMedium();






// ______________________
// 1 wrap idea, css large menu at 800px
$( window ).resize(function() {
    var resize = true; // let menuMedium know that it has been called after document resize
    menuMedium(resize);
});



function menuMedium(resize) {

    // if menu text overflows
    if ($('.main-menu')[0].scrollWidth >  $('.main-menu').innerWidth()) {
    // console.log('menu overflows');
        
        // large menu (medium) - swap in alternative shorter text
        if ($('body').innerWidth() >= 800) {
            $('.main-menu li a').each(function() {
                var abbrevTitle = $(this).attr('data-abbrev');
                // only swap text if alternative text has been entered
                if (abbrevTitle!==undefined) {
                    $(this).text(abbrevTitle);                    
                }
            });
        }
    
    }

    
    // if menu text does not overflow
    else {
        
        // small menu - restore original text
        if ($('body').innerWidth() <= 799) {
            if (resize == true) {
                // console.log('resized small menu -> restore original text');
                
                $('.main-menu > li > a').each(function(k, i) {
                    var abbrevTitle = $(this).attr('data-abbrev');
                    var origTitle = $(this).attr('data-orig');
                    // only swap original text back in if it differs from the alternative text
                    if ( $(this).text() !== origTitle ) {
                        $(this).text(origTitle);
                        // console.log('replace');
                    }
                });

            }
            
        }

        // large menu - 
        else {
            if (resize == true) {
                // console.log('resized large menu -> if it is wide enough, swap in original text');
                // test if the screen is wide enough
                // - this is around 1120px in chrome
                // - this will probably be quite difficult without original text in the DOM
                if ($('body').innerWidth() >= 1120) {
                    
                    $('.main-menu > li > a').each(function(k, i) {
                        var abbrevTitle = $(this).attr('data-abbrev');
                        var origTitle = $(this).attr('data-orig');
                        // only swap original text back in if it differs from the alternative text
                        if ( $(this).text() !== origTitle ) {
                            $(this).text(origTitle);
                            // console.log('replace');
                        }
                    });

                }
            }
        }
        
    }


}

// run on load
menuMedium();















// ___________________
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
    $(".page").removeClass('has-cookie-bar');
		$.cookie('cookie_bar_hide', 'hidden', { path: '/' });
        return false;
    });

// if cookie is set to hidden, hide bar
if ($.cookie("cookie_bar_hide") !== 'visible') {
    $(".cookies").hide();
    $(".page").removeClass('has-cookie-bar');
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
// var id = window.location.hash; // console.log(id);
//console.log(id);

// if (id) {
//   $(window).scrollTop( $(id).offset().top) //
//   $(id).addClass('padded'); // padded = header height + h2 height
// }





// ---------------------------
// lazyloading










// ---------------------------
// services parent page

// show page description on + click
var desc = $('.serviceswrapper .button');


// on button click event
$(desc).on('click', function(e){
    e.preventDefault;
    var expndBtn = e.target;
    // console.log(expndBtn);

    // show description
    if ( $( 'i', expndBtn ).hasClass('fa-chevron-down') ) {
      // button chevrons
      // $( 'i', expndBtn ).removeClass('fa-chevron-down');
      // $( 'i', expndBtn ).addClass('fa-chevron-up');
      
      // alter the display
      // $( expndBtn ).closest('.title').next().slideToggle('250');
      $( expndBtn ).closest('.info').addClass('add-summary');
      $( expndBtn ).remove();
      
    }
    // else {
    //   // button chevrons
    //   $( 'i', expndBtn ).addClass('fa-chevron-down');
    //   $( 'i', expndBtn ).removeClass('fa-chevron-up');
    //   // alter the display
    //   $( expndBtn ).closest('.title').next().slideToggle( '250' );
    // }

});






// ---------------------------
// header bar shrink on scroll
// need to accommodate for logo--custom in the css - default logo is 65px high
// $(window).on('scroll touchmove', function () {
//   $('.header').toggleClass('scrolled', $(document).scrollTop() > 0);
// });










// ---------------------------
// tooltip
// $(function() {
//   $( '*' ).tooltip();
// });

// add element id/ class for negative tooltip
// $('#footer').tooltip({
//     tooltipClass: 'ui-tooltip-negative'
// });








// end whole document
});
