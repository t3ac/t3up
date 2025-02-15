jQuery(document).ready(function($) {

	if ($(window).width() <= 991) { // if there is at least one :) 
	
  		
		new Mmenu( '#menu',{
	 			 extensions  : [ 'widescreen', 'theme-white', 'pageshadow', 'effect-listitems-drop', 'pagedim-black' ],
	             counters     				: true,
	             setSelected         		: {
	                    parent              : true
	             },           
	             navbar              : {
	                    title        : 'Start'
	             },
	     });
	}	
});
