(function($){
	
	
	
	// JS for Able Mediation Widgets:
	// - this is loaded for a specific view, using a hook. It will not run theme - wide

	// 1 - widget warning
	
	
	
	// ––––––––––––––––––––––––––––––––––––––––––––––––––
	// 1 - widget warning
	
	const blogDiv = $('#blogpages');

	function addRemove() {
		const len = $(blogDiv).children().length;
		if (len > 5) {
			// add red text p for 1st time
			if ( !$('p', blogDiv).hasClass('widget--warn') ) {
				$('.description', blogDiv).after(`<p class="widget--warn">This widget area is best used with <span class="green--bg">3 widgets only</span><br><br> <span class="red--text">You currently have <span class="red--bg">${len}</span> widgets in this widget area.</span></p>`);
			}
			// if already there, update the count
			else {
				$('.red--bg', blogDiv).text(len);
			}
		}
		else if (len <= 5) {
			$('.widget--warn', blogDiv).remove();
		}
	}

	addRemove();

	// run when widget added or removed from footer widget area
	$( document ).ajaxStop( function() {
		addRemove();
    } );

	





})(jQuery);