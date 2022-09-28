jQuery(document).ready(function($) {
	
	var mainpadding = $('header').height(),
		win = $(window),
	    header = $('header'),
	    offset = (header.offset().top);

        if ( $(window).width() > 991) {
           /* Navigation ausblenden und fixen******************/
        		win.scroll(function() {
        		    if (offset < win.scrollTop()) {
        		        header.addClass("sticky");
        		        header.css('position','fixed');
        		    } else {
        		        header.removeClass("sticky");
        		        header.css('position','relative')
               }     
           });
        }
 
		win.resize(function () {
				offset = header.offset().top;
				
		})

});