jQuery(document).ready(function($) {
	
	var mainpadding = $('header > .container').height(),
		win = $(window),
	    header = $('header'),
	    offset = (header.offset().top);
	    main = $('main'); 

        if ( $(window).width() > 991) {
           /* Navigation ausblenden und fixen******************/
        		win.scroll(function() {
        		    if (offset < win.scrollTop()) {
        		        header.addClass("sticky w-100");
        		        header.css('position','fixed');
        		        main.css('padding-top',mainpadding);
        		    } else {
        		        header.removeClass("sticky w-100");
        		        header.css('position','relative')
        		        main.css('padding-top','0');
               }     
           });
        }
 
		win.resize(function () {
				offset = header.offset().top;
				
		})

});
