jQuery(document).ready(function($) {

	if ($(window).width() <= 991) { // if there is at least one :) 
	
		$('#menu').find('.subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});
	    $('.top ul').prepend('<div class="mobilmenubutton d-flex align-items-center"><a href="#menu">Menu<span class="symbol">&emsp;&#xf0c9;</span></a></div>');
	    
		new Mmenu( '#menu',{
	 			 extensions  : [ 'widescreen', 'theme-white', 'pageshadow', 'effect-listitems-drop', 'pagedim-black' ],
	             searchfield  : {
	                    search              : true,
	                    placeholder         : "Suche",
	                    noResults 			: "Keine Suchergebnisse",
	                    resultsPanel    	: true,
	             },
	             counters     				: true,
	             setSelected         		: {
	                    parent              : true
	             },           
	             navbar              : {
	                    title        : 'Menü'
	             },
	             navbars             : [{
	                    position     : 'top',
	                    content      : [ 'searchfield' ]
	                    }, 
				]
	     });
	}	
});
