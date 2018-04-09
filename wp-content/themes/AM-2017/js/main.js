(function($){

    // JS for Able Mediation Front End:
	//	- client facing, uses pre ES5

	// File Contents:
	// 1 - setup: remove no-js class
    // 2 - header: hide if scrolled (+ hide opened sub-menus)
    // 3 - menu: js sub-menu dropdowns
    // 4 - menu: abbreviated text for mid sized screens
    // 5 - cookie bar notice
    // 6 - mediator profile reveal
        // TO BE CHANGED / REMOVED:  // 7 - services parent page
    // 8 - staged column height matching


    // ––––––––––––––––––––––––––––––––––––––––––––––––––
    // 1 - setup: remove no-js class
    $( 'html' ).removeClass('no-js');


    // ––––––––––––––––––––––––––––––––––––––––––––––––––
    // 2 - header: hide if scrolled
    // - if menu opened, and screen is small (under 800px)
    if ( $('.page').hasClass('fixed-header') ) {

        var didScroll;
        var lastScrollTop = 0;
        var delta = $('div.page').attr('data-offset'); // threshold setting - distance user has to scroll up to reveal header (px)
        var navbarHeight = $('.header').outerHeight();
        // small size, menu open:
        // - top offset to be 57px less - show close menu button
        // - menu-open is used in css:
        $( "#toggle" ).change(function() {
            $('.header').toggleClass('menu-open');
        });
        
        // activate function when user scrolls
        $(window).scroll(function(event){
            didScroll = true;
        });
        setInterval(function() {
            if (didScroll) {
                hasScrolled();
                didScroll = false;
            }
        }, 250);

        // scroll function
        function hasScrolled() {
            var st = $(this).scrollTop();

            // scroll more than delta value
            if (Math.abs(lastScrollTop - st) <= delta)
                return;
            
            // if scrolled down past the navbar, add class .nav-up.
            // - don't see what is "behind" the navbar.
            if (st > lastScrollTop && st > navbarHeight){
                // scroll down - add .up class
                $('.header').removeClass('down').addClass('up');
                // hide all opened sub-menus + set attr to false
                $('.main-menu .menu-item-has-children > a').attr('aria-expanded', 'false').next().slideUp(250);
            } else {
                // scroll up - add .down class
                if (st + $(window).height() < $(document).height()) {
                    $('.header').removeClass('up').addClass('down');
                }
            }
            lastScrollTop = st;
        }


        
        
        // ––––––––––––––––––––––––––––––––––––––––––––––––––
        // 3 - menu: js sub-menu dropdowns
        $('.main-menu .menu-item-has-children > a').click(function(e){
            e.preventDefault();

            if ( $(e.target).attr('aria-expanded') == 'false' ) {
                
                // hide all other opened sub-menus + set attr to false
                $('.main-menu .menu-item-has-children > a').attr('aria-expanded', 'false').next().slideUp(250);

                // show clicked items children
                $(e.target).attr('aria-expanded', 'true').next().slideDown(250);
            } else {
                $(e.target).attr('aria-expanded', 'false').next().slideUp(250);
            }
        });
        
        
        
        
        
        
        // ––––––––––––––––––––––––––––––––––––––––––––––––––
        // 4 - menu: abbreviated text for mid sized screens
        // - note: css sets large menu at 800px
        $( window ).resize(function() {
            var resize = true; // let menuMedium know that it has been called after document resize
            menuMedium(resize);
            // run column resize
            stageColumn(resize);
        });



        function menuMedium(resize) {

            // if menu text overflows
            if ($('.main-menu')[0].scrollWidth >  $('.main-menu').innerWidth()) {            
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
                } // end small menu

                // large menu
                else {
                    if (resize == true) {
                        // console.log('resized large menu -> if it is wide enough, swap in original text');
                        // - test if the screen is wide enough
                        if ($('body').innerWidth() >= 1120) {
                            $('.main-menu > li > a').each(function(k, i) {
                                var abbrevTitle = $(this).attr('data-abbrev');
                                var origTitle = $(this).attr('data-orig');
                                // only swap original text back in if it differs from the alternative text
                                if ( $(this).text() !== origTitle ) {
                                    $(this).text(origTitle);
                                }
                            });
                        }
                    }
                } // end large menu  
            }
        }
        // run on load
        menuMedium();
    }



    // ––––––––––––––––––––––––––––––––––––––––––––––––––
    // 5 - cookie bar notice
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




    // ––––––––––––––––––––––––––––––––––––––––––––––––––
    // 6 - mediator profile reveal
    $('.mediator-profile .full-profile').addClass('hidden');
    $('.mediator-profile .button').click(function(e){
        e.preventDefault();
        $(this).parents().next().removeClass('hidden');
        $(this).remove();
    });




    // ––––––––––––––––––––––––––––––––––––––––––––––––––
    // 7 - services parent page
    // var desc = $('.serviceswrapper .button');


    // on button click event
    // $(desc).on('click', function(e){
    //     e.preventDefault;
    //     var expndBtn = e.target;
        // console.log(expndBtn);

        // show description
        // if ( $( 'i', expndBtn ).hasClass('fa-chevron-down') ) {
            // button chevrons
            // $( 'i', expndBtn ).removeClass('fa-chevron-down');
            // $( 'i', expndBtn ).addClass('fa-chevron-up');
            
            // alter the display
            // $( expndBtn ).closest('.title').next().slideToggle('250');
            // $( expndBtn ).closest('.info').addClass('add-summary');
            // $( expndBtn ).remove();
        // }
        // else {
        //   // button chevrons
        //   $( 'i', expndBtn ).addClass('fa-chevron-down');
        //   $( 'i', expndBtn ).removeClass('fa-chevron-up');
        //   // alter the display
        //   $( expndBtn ).closest('.title').next().slideToggle( '250' );
        // }

    // });




    // ––––––––––––––––––––––––––––––––––––––––––––––––––
    // 8 - staged column height matching
    // - works fine so long as it isnt used on the home page - WHY???
    function stageColumn(resize) {           
        
        // get height of each column
        // $('.columns.stage').each(function() {
        //     console.log( $(this).height() );
        // });
        
        // set height of staged columns
        if ($('body:not(.home)').innerWidth() >= 980) {
            var maxHeight = Math.max.apply(Math, $('.columns.stage').map(function(i,elem){ 
                // return Number($(elem).height());
                return $(elem).height();
            }));
            // console.log(maxHeight + ': max height');
            $('.columns.stage').height(maxHeight);
            // - does not work properly on home page???
            // $('.home .columns.stage').height(maxHeight + 75);
        } else {
            $('.columns.stage').css('height', 'auto');
        }
    }
    // run on load
    stageColumn();





// end whole document
})(jQuery);
