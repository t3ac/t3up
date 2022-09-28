$(document).ready(function() {
	
	var $nav = $('.nav'), 
		$body = $('body');
	
		$('.ankerNav #menu a').on('click',function(e) {
		 	e.preventDefault();
		 	var target = this.hash;
		 	var $target = $(target);
		 	$('html, body').stop().animate({
		  		'scrollTop': $target.offset().top
		 	}, 900, 'swing', function () {
		  	window.location.hash = target;
		 	});
		});		
		
	$('.simpleAnkerNav .cur .subnav a').on('click',function(e) {
	 	e.preventDefault();
	 	var target = this.hash;
	 	var $target = $(target);
	 	$('html, body').stop().animate({
	  		'scrollTop': $target.offset().top
	 	}, 900, 'swing', function () {
	  	window.location.hash = target;
	 	});
	});		

	if (($(window).width() > 767)) { // if there is at least one :)
		
		$('#sideanker a').on('click',function(e) {
			$this = $(this);
		 	e.preventDefault();
		 	var target = this.hash;
		 	var $target = $(target);
		 	$('html, body').stop().animate({
		  		'scrollTop': $target.offset().top
		 	}, 900, 'swing', function () {
		  	window.location.hash = target;
		 	});
		});		
		
	};
	
	/* Inits end *********************************************************************************/

	if (($nav.length) && ($(window).width() > 991)) { // if there is at least one :)
			
		/* Inits  ********************************************************************************/		
		    
	    	/* specials */
        $('#menu ul ul li').has( ".subnav" ).find('span').text($plu);  
        $('.nav li').last().addClass('lastitem');    
        $('.nav li.dropmenue > span').text($pluTop);    
        	
								
			var navblock1 = 0;  
		    $('#menu ul ul').each(function() {    
		    	if ($(this).children().length > navblock1) {
		    		navblock1 = $(this).children().length;
		    	}	
			});	
			
		    var navblock2 = 0;
		    $('#menu ul ul ul').each(function() {    
		    	if ($(this).children().length > navblock2) {
		    		navblock2 = $(this).children().length;
		    	}		
			});
			
		    var navblock3 = 0;
		    $('#menu ul ul ul ul').each(function() {    
		    	if ($(this).children().length > navblock3) {
		    		navblock3 = $(this).children().length;
		    	}		
			});
			
			var navblock = [navblock2,navblock1,navblock3]
		    navblock = (Math.max.apply(Math,navblock));
	
		    liheight = 2.75 *(parseInt($('html').css('font-size')));
		    li2height= 3.25 *(parseInt($('html').css('font-size')));
		    blockNavHeight = liheight * navblock;  
		    
			$('.box').height(liheight * navblock + 30); 		    
			
		
	/* Init "Standard" ********************************************************************/
	
 		 $('.standardNav #menu ul ul li').has( ".subnav" ).find('span').text($plu);	
 		
		$body.on('focus ontouchend click mouseover', '.standardNav .navlink', function(event) {
			var $this = $(this).parent();
			
			/* Reset */	
			$this.siblings().find('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});
			$this.siblings().attr({'data-show-sub': 'false'});	
			$this.siblings().removeClass('activated');
			$this.siblings().find('li').removeClass('activated');	 
			$this.siblings().find('span').text($pluTop);
					
			/* Do */
			$this.addClass('activated');
			$this.find('> span').text($minTop);
			$this.attr({'data-show-sub': 'true'});	
			$this.find(' > .subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});
			
			if ($this.parent().is('.nav')) {
                if ($this.next().length){
                    $('.overlay').fadeIn();	 
                 }	
			} else {
				/* Reset */
				$this.parent().find('span').text($plu);
				
				/* Do */
				$this.find('> span').text($min);
			}	
		})
        


	/* Init "MediaNavigation" ********************************************************************/
    
		$('.mediaNav #menu ul ul li').has( ".subnav" ).find('span').text($plu);
		$('.mediaNav #menu .subnav .subnav .subnav').find('span').remove();
		$('.mediaNav #menu > .nav > li > .row').wrap( '<div class="box"><div class="container px-0 px-lg-3"></div><span class="closemenu">X</span></div>' );
		
		$('.box').height(liheight * navblock + 30);
		
		$body.on('focus ontouchend mouseover click', '.mediaNav .navlink', function(event) {
			var $this   = $(this).parent(),
				$clone  = '',
            	$elem   = $this.find('>.capital'),
            	$clone  = $elem.clone(true);  
            	
				/* Reset */	
				$this.siblings().find('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});
				$this.siblings().attr({'data-show-sub': 'false'});	
				$this.siblings().removeClass('activated');
				$this.siblings().find('li').removeClass('activated');
						
				/* Do */
				$this.addClass('activated');
				$this.attr({'data-show-sub': 'true'});	
				$this.find(' > .subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});
            	
            	
			if ($this.parent().is('.nav')) {
				/* Do */
				$this.find('.box').fadeIn('fast',function(){
					$this.siblings().find('.box').hide();
				});
				if ($this.next().length){
                    $('.overlay').fadeIn();  
                }  
				$this.find('.submenulevel').css('display','flex');
				$this.find('.row > .subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});
				$this.find('.im img').replaceWith($clone);   // Replace the Capitalimage
                $this.find('.im .capital').fadeIn('slow');
			} else {
				/* Reset */
				$this.parent().find('span').text($plu);
				
				/* Do */
				$this.find('> span').text($min);
			}	
		})
        
            $body.on('click', '.mediaNav .nav > .navitem > .navlink', function(event) {     
                var $this   = $(this);  
                $('.mediaNav .nav > .navitem > .navlink').off('click'); 
                if ($this.siblings().is('.box')){  
                    event.preventDefault();     
                }
                $this.one('click', function(event) {        
                    event.stopPropagation();
                    
                });
            });
                
            $body.on('click', '.mediaNav .closemenu', function(event) {  
                // ESC-Taste schließt das Menu
                $('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});     
                $('#menu li').attr({'data-show-sub': 'true'}).removeClass('activated');
                $('#menu .subnav li').find('> span').text($plu);
                $('.overlay').fadeOut();
                $('.box').fadeOut('fast');  
                $('.submenulevel').fadeOut('fast'); 
            });
                
                

	/* Init "BlockNavigation" ********************************************************************/
    
		$body.on('focus ontouchend  mouseover', '.blockNav .navlink', function() {
			var $this  = $(this).parent();

			if ($this.parent().is('.nav')) {
				/* Reset */
				$this.siblings().find('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});
				$this.siblings().attr({'data-show-sub': 'false'});	
				$this.siblings().removeClass('activated');
				$this.siblings().find('li').removeClass('activated');
				/* Do */
				$this.addClass('activated');
				$('.overlay').fadeOut();
				$this.attr({'data-show-sub': 'true'});	
				$this.find('.subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});						
			}	
		})
		
		
	/* Init Simpledrop *******************************************************************************/
	
		$body.on('focus ontouchend mouseover', '.simpleDropNav .navlink', function(event) {
			var $this = $(this).parent();
			
			/* Reset */	
			$this.siblings().find('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});
			$this.siblings().attr({'data-show-sub': 'false'});	
			$this.siblings().removeClass('activated');
			$this.siblings().find('li').removeClass('activated');	 
					
			/* Do */
			$this.addClass('activated');
			$this.attr({'data-show-sub': 'true'});	
			$this.find(' > .subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});
			
			if ($this.parent().is('.nav')) {
	    		if ($this.next().length){
                    $('.overlay').fadeIn();  
                }     		
			} else {
				/* Reset */
				$this.parent().find('span').text($plu);
				
				/* Do */
				$this.find('> span').text($min);
			}	
		})
		

	// span click **************************************************************************************/		
		
		$body.on('click', '#menu .subnav .navitem span', function(event) {
			var $span = $(this).text(),
			    $this = $(this).parent(); 

			$(this).text(function(i, text){
      			// return text === "+" ? "–" : "+";
      			return text === $plu ? $min : $plu;
			})

			
			if ($span == $min) {
				$this.find('> .subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});
				$this.removeClass('activated');
			} else {
				$this.parent().find('li').attr({'data-show-sub': 'true'}).removeClass('activated');
				$this.parent().find('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});		
				$this.find('> .subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});
		 		$this.addClass('activated');
		 		$this.siblings().find('span').text($plu);
			}
		})	

	
	// Toparea schließt menu *************************************************************************
		
		$body.on(' mouseleave', '.blockNav', function(event) {
				$('.blockNav').find('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});	
				$('.overlay').fadeOut();
		})			
		 	
		$body.on(' mouseleave', '.ulmNav', function(event) {
				$('.blockNav').find('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});	
				$('.overlay').fadeOut();
				$('.submenulevel').fadeOut('fast');
				$('#menu > ul > li > span').text(unescape("%uF13a"));
		})				 	
		 		 	
		$body.on('focus mouseenter click', '.top', function(event) {
				$('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});		
				$('#menu li').attr({'data-show-sub': 'true'}).removeClass('activated');
				$('#menu .subnav li').find('> span').text($plu);	
				$('.overlay').fadeOut();
				$('.box').fadeOut('fast');	
				$('.submenulevel').fadeOut('fast');
		})	
		
			 
		$body.on('focus mouseenter click', '.logo', function(event) {
				$('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});		
				$('#menu li').attr({'data-show-sub': 'true'}).removeClass('activated');
				$('#menu .subnav li').find('> span').text($plu);	
				$('.overlay').fadeOut();
				$('.box').fadeOut('fast');
				$('.submenulevel').fadeOut('fast');	
				$('#menu > ul > li > span').text($pluTop);
		})	
		
		$body.on('mouseenter', '.overlay', function(event) {

				$('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});		
				$('#menu li').attr({'data-show-sub': 'true'}).removeClass('activated');
				$('#menu .subnav li').find('> span').text($plu);	
				$('.overlay').fadeOut();
				$('.box').fadeOut('fast');	
				$('.submenulevel').fadeOut('fast');
		})	
		
			 	 
		
	// Tastatatur Eigenschaften *************************************************************************************************************

		$body.on('keydown', '.navlink', function(event) {
			var	$this       = $(this),
				$parentitem = $this.parents('.navitem'),
				$parent     = $this.parents('.nav'),
				$navitem    = $this.parent();
				
			// Key bottom
			if (event.keyCode == 40) {	
				if($('.standardNav'))  {
					if($navitem.parent().is('.nav')) {
						$navitem.find('> ul > .navitem:first-child').children(".navlink").focus();
					} else {
						if ($navitem.is(".navitem:last-child")){
							$this.parent().parent().closest('li').children('.navlink').focus();
						} else {
							$navitem.next().children(".navlink").focus();		
		 				}
	 				}
	 			}
	 			event.preventDefault();
			} 
			
			if (event.keyCode == 40) {	
				if($('.blockNav'))  {
					if($navitem.parent().is('.nav')) {
						$navitem.find('> ul > .navitem:first-child').children(".navlink").focus();
					} else {
						if($navitem.parent().is('.subnav')) {
							$navitem.find('> ul > .navitem:first-child').children(".navlink").focus();
						} else {
							$navitem.next().children(".navlink").focus();
						}		
		 			}
	 			}
			} 
			
			if (event.keyCode == 40) {	
				if($('.mediaNav'))  {
					if($navitem.parent().is('.nav')) {
						$navitem.find('.box > * > * > ul > .navitem:first-child').children(".navlink").focus();
					} else {
						if ($navitem.is(".navitem:last-child")){
							$this.parent().parent().closest('li').children('.navlink').focus();
						} else {
							$navitem.next().children(".navlink").focus();		
		 				}
	 				}
	 			}
	 			event.preventDefault();
			} 


			 // Key top 
			if (event.keyCode == 38) {
				 if($navitem.closest('.subnav').length === 1)  {
					if ($navitem.is(".navitem:first-child")){
						$this.parent().parent().closest('li').children('.navlink').focus();
					 } else {
						 $navitem.prev().children(".navlink").focus();
					 }
				}
				event.preventDefault();
			} 
		
				// Key right
			if (event.keyCode == 39) {
				if($navitem.parent().is('.nav')){
					if ($parentitem.is(".nav > .navitem:last-child")) {
						$parent.find('> .navitem:first-child').children('.navlink').focus();
					} else {
						$parentitem.next().children(".navlink").focus();
					}
				} else {
					$navitem.find('> .subnav > .navitem:first-child').children('.navlink').focus();
				}
				event.preventDefault();
			} 
			
	 		// Key Left
			if (event.keyCode == 37) {
				if($navitem.parent().is('.nav')){
					if ($parentitem.is(".nav > .navitem:first-child")) {
						$parent.find('> .navitem:last-child').children('.navlink').focus();
					} else {
						$parentitem.prev().children(".navlink").focus();
					}
				} else {
					if ($parentitem.find(".subnav").length > 1) {
						if ($navitem.is(":first-child")) {
							 $navitem.parent().parent().children(".navlink").focus();
						}
					}
				}		
			} 
			
		 	// Key Esc ********************************************************************************
			if (event.keyCode == 27) {
				// ESC-Taste schließt das Menu
				$('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});		
				$('#menu li').attr({'data-show-sub': 'true'}).removeClass('activated');
				$('#menu .subnav li').find('> span').text($plu);
				$('.overlay').fadeOut();
				$('.box').fadeOut('fast');	
				$('.submenulevel').fadeOut('fast');	
			 }
			 
				
		 	// TAB & Shift Esc *************************************************************************
			if (event.shiftKey && event.keyCode == 9) {
				if($navitem.parent().is('.nav')){
					if ($parentitem.is(".nav > .navitem:first-child")) {
						$('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});
						$('#menu li').attr({'data-show-sub': 'true'}).removeClass('activated');
						$('#menu .subnav li').find('> span').text($plu);
						$('.overlay').fadeOut();
						$('.box').fadeOut('fast');	
					} 
				} 	
			 }
			
			// TAB  ************************************************************************************
			if (event.keyCode == 9) {
				if($navitem.is('.lastitem')){
					$('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});		
					$('#menu li').attr({'data-show-sub': 'false'}).removeClass('activated');
					$('#menu .subnav li').find('> span').text($plu);	
					$('.box').fadeOut('fast');
					$('.overlay').fadeOut();
				}
			 }
	
		})
	}
});
