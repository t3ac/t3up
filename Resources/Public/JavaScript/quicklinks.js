$(document).ready(function() {
	
	var $quick = $('.quicklinks'), 
				 $body = $('body'),
				 qw = $('.quicklinks ul').width();
	
	$('.quicklinks').css('min-width',qw );
	
	if ($quick.length) { // if there is at least one :)
		
		$quick.find('ul').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});
			
		// Zeige Untermenüs 
		$body.on('focus mouseover click', '.quickstart', function(event) {   
			var $this = $(this),
			$quick = $this.parent().find('ul');		
			$quick.attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});
			$this.addClass('active');
		})
	
	    $body.on('mouseleave', '.quicklinks', function(event) {
			var $this = $(this),
			$quick = $this.find('ul');
			$quick.attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});
			$('.quickstart').removeClass('active');
			
		}) 
		
	// Tastatatur Events  *******************************************************************************************************

		$body.on('keydown', '.quicklinks > a', function(event) {
         	var $this = $(this);			
		    if (event.keyCode == 40) {      
		         $this.parent().find("ul li:first-child").children("a").focus();
		         event.preventDefault();	
		     }
		})  	

		$body.on('keydown', '.quicklinks li a', function(event) {
         	var $this = $(this),
	             $subnav = $this.parents('.quicklinks ul'),
	             $subnavitem = $this.parents('.quicklinks ul li');
	
		         // Key bottom **********************************************************************
		         if (event.keyCode == 40) {
		            if ($this.parent().is(':last-child')) {
		               $('.quicklinks ul li:first-child').children('a').focus();
		            } else {
		               $subnavitem.next().children('a').focus();
		            }
		            event.preventDefault();
		         }
				 
		         // Key top *************************************************************************
		         if (event.keyCode == 38) {
		            if ($this.parent().is(':first-child')) {
		               $('.quicklinks > a').focus();
		            }
		            else {
		               $subnavitem.prev().children('a').focus();
		            }
		            event.preventDefault();
		         }

		         // Key TAB 
		         if (event.keyCode == 9 && !event.shiftKey) {
		            if ($subnavitem.is(".quicklinks ul li:last-child")) {
		              $('.quicklinks').find('ul').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'}); 
		              $('.quickstart').removeClass('active');
		            }
		         }
		         
		         // Key TAB & SHIF
		         if (event.keyCode == 9 && event.shiftKey) {
		            if ($subnavitem.is(".quicklinks ul li:first-child")) {
		            	$('.quickstart').focus();
		             	$('.quicklinks').find('ul').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'}); 
		             	$('.quickstart').removeClass('active');
		            }
		         }
		         
		         // event keyboard Esc *************************************************************************
		         if (event.keyCode == 27) {
		            $('.quicklinks').find('ul').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});
		            $('.quickstart').removeClass('active'); 
		         }
		         
		})
	}
	

});