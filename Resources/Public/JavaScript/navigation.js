$(document).ready(function() {
    
    var $nav = $('.nav'), 
        $body = $('body'),
        navblock1 = 0,
        navblock2 = 0,
        navblock3 = 0;

             
    /* Inits start *******************************************************************************/    
    
        // Span in submenues get the text from the var $plu -> chars1-4 Javascript      
        $('#menu ul ul li').has( ".subnav" ).find('span.nextlevel').text($plu);  
        
        // Add class "lastitem" to the last LI of all  
        $('.nav li').last().addClass('lastitem');    
                
        // wrap for the submenues - menuestyle 2 -> activeNav
        $('.activeNav #menu > .nav > li > .row').wrap('<div class="box"><div class="container px-0 px-lg-3"></div><span class="btn-close"></span></div>');
            
        // length of the first submenulevel   
        $('#menu ul ul').each(function() {    
            if ($(this).children().length > navblock1) {
                navblock1 = $(this).children().length;
            }   
        }); 
        
        // length of the second submenulevel   
        $('#menu ul ul ul').each(function() {    
            if ($(this).children().length > navblock2) {
                navblock2 = $(this).children().length;
            }       
        });
        
        // length of the third submenulevel 
        $('#menu ul ul ul ul').each(function() {    
            if ($(this).children().length > navblock2) {
                navblock3 = $(this).children().length;
            }       
        });
        var navblock = [navblock2,navblock1,navblock3]
        navblock = (Math.max.apply(Math,navblock));
        liheight = $('.subnav > li').height();
        li2height= (parseInt($('html').css('font-size')));
        blockNavHeight = liheight * navblock; 
            
	    /* Init "Overlay" */
	         
	    $body.on('focus ontouchend click mouseover', '#menu > ul > li', function(event){
	        var $this = $(this);
	
	        if ($this.parent().is('.nav')) {
	            
	            /* Do */
	            if ($this.hasClass('turquoise')){
	                $('.overlay').removeClass().addClass('overlay turquoise');
	            }
	            if ($this.hasClass('green')){
	                $('.overlay').removeClass().addClass('overlay green');
	            }       
	            if ($this.hasClass('blue')){
	                $('.overlay').removeClass().addClass('overlay blue');
	            }                           
	            if ($this.hasClass('red')){
	                $('.overlay').removeClass().addClass('overlay red');
	            }  
	            if ($this.hasClass('grey')){
	                $('.overlay').removeClass().addClass('overlay grey');
	            }  
	            if ($this.hasClass('violett')){
	                $('.overlay').removeClass().addClass('overlay violett');
	            }  
	             if ($this.hasClass('orange')){
	                $('.overlay').removeClass().addClass('overlay orange');
	            }  
	        } 
	    })

            
            
            
            
            
    /* Inits end *********************************************************************************/
    
    
    /* Resets start ******************************************************************************/  

        function resMenue(){
            if ($(window).width() >= 992) {
                $('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});     
                $('#menu li').attr({'data-show-sub': 'false'}).removeClass('activated');
                $('#menu .subnav li > span.nextlevel').text($plu);
                $('.box').fadeOut('fast');  
                $('.submenulevel').fadeOut('fast');   
                $(".overlay").fadeOut();  
            }
        }
                    
        $body.on('click', ' .btn-close', function(event) {  
            // ESC-Taste schliesst das Menu
           resMenue();
        });

        $body.on('focus click', '.logo', function(event) {
            resMenue();
        })  
        
        $body.on('focus mouseenter click', '.logo', function(event) {
            resMenue();
        }) 
                 
        $body.on('focus mouseenter click', '.top', function(event) {
            resMenue();
        })  
        
        $body.on('click ontouchend', '.overlay', function(event) {
            resMenue();
        })  
        
        $body.on('mouseleave', '.Nav', function(event) {
            resMenue();	
        })  
        
        $body.on('click ontouchend', '.closelink', function(event) {
            resMenue();
        })  
        

    /* Resets end ********************************************************************************/

    /* Menue *************************************************************************************/
    
        /* standardNav - menuestyle 1  */
    
    	if (($nav.length) && ($(window).width() > 991)) {
	   
	        $body.on('ontouched click', '.standardNav .navlink', function(event) {
	            var $this = $(this),
	                $p    = $(this).parent();
	                    
	            /* Reset */ 
	            $p.siblings().find('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});
	            $p.siblings().attr({'data-show-sub': 'false'});  
	            $p.siblings().removeClass('activated');
	            $p.siblings().find('li').removeClass('activated');
	            $p.find('.subnav span.nextlevel').text($plu);
	
	           /* Do */
	            if (($this.next().length) & ($this.parent().parent().is('.nav'))){
	                event.preventDefault();
	                $('.overlay').fadeIn(); 
	                $p.addClass('activated');
	                $p.find('> span.nextlevel').text($minTop);
	                $p.attr({'data-show-sub': 'true'});  
	                $p.find(' > .subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});
	                
	                // $this.toggleClass('navlink').toggleClass('closelink');
	            } else {
	                /* Reset */
	                $p.parent().find('span.nextlevel').text($plu);
	                
	                /* Do */
	                $p.find('> span.nextlevel').text($min);
	            } 
			 })
 		  }
 		
        /* Active dynamic - menuestyle 2  */

        $body.on('ontouchend click', '.activeNav .navlink', function(event) {
            var $this   = $(this),
                $p      = $(this).parent();  
            
            /* Reset */ 
            $p.siblings().find('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});
            $p.siblings().attr({'data-show-sub': 'false'});  
            $p.siblings().removeClass('activated');
            $p.siblings().find('li').removeClass('activated');
            $p.find('.subnav span.nextlevel').text($plu);
            
            if ($this.hasClass('show')){
				resMenue();
				event.preventDefault();  
                    
			} else {
                
                if (($this.next().length) & ($this.parent().parent().is('.nav'))){
                    event.preventDefault();         
                    $('.overlay').fadeIn();  
                    $p.addClass('activated');   
                    $p.find('> span.nextlevel').text($minTop); 
                    $p.attr({'data-show-sub': 'true'});  
                    $p.find('.box > .subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});
                    $p.find('.box').fadeIn('fast',function(){
                        $p.siblings().find('.box').hide();
                    });
                     $p.siblings().find(' > a').removeClass('show');
                     
                  $p.find('li.act').parent().attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});
                  $p.find('li.act > span.nextlevel').text($min);                  
                  $p.find('li.cur').parent().attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});
                  $p.find('li.cur > span.nextlevel').text($min);                  
                }
            }
            
            $this.toggleClass('show');
        })
        
 		
        /* Block - menuestyle 3  */
        
        $body.on('ontouchend click', '.blockNav .navlink', function(event) {
            var $this = $(this).parent(); 
            
            /* Reset */ 
            $this.siblings().removeClass('activated');
            $this.find('.subnav .subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'})
            
            if ($this.parent().is('.nav')) { 
                $this.siblings().find('> .subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'})
                event.preventDefault();
            }
            
           /* Do */
            $this.addClass('activated');
            $this.attr({'data-show-sub': 'true'});  
            $this.find(' > .subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'})
            $('.overlay').fadeIn();
        })
        
 	 		
     /* Submenues open and close **************************************************************************/
        $body.on('click', '#menu .subnav .navitem > span.nextlevel', function(event) {
            var $span = $(this).text(),
                $p    = $(this).parent();

            $(this).text(function(i, text){
                return text === $plu ? $min : $plu;
            })
            
            if ($span == $min) {
                $p.siblings().find('span.nextlevel').text($plu);
                $p.find('> .subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});
            } else {
                $p.parent().find('li').attr({'data-show-sub': 'true'}).removeClass('activated');
                $p.parent().find('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});       
                $p.find('> .subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});
                $p.siblings().find('span.nextlevel').text($plu);
                $p.addClass('activated');
            }
        })  
	

    // key events *************************************************************************************************************
    
 
        $body.on('keyup', '.navlink', function(event) {
            var $this       = $(this),
                $parentitem = $this.parents('.navitem'),
            	$parent     = $this.parents('.nav'),
                $navitem    = $this.parent();

            // TAB  ************************************************************************************
            if (event.keyCode == 9) {
                if($navitem.is('.lastitem')){
                   resMenue(); 
                } else {
                    /* Reset */
                    $navitem.siblings().find('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});
                    $navitem.siblings().attr({'data-show-sub': 'false'});  
                    $navitem.siblings().removeClass('activated');
                    $navitem.siblings().find('li').removeClass('activated');
                    $navitem.siblings().find('.box').hide();
                    $navitem.find('.subnav li > span.nextlevel').text($plu); 
                                       
                    /* Do */
                    $navitem.addClass('activated');
                    $navitem.attr({'data-show-sub': 'true'}); 
                    $('.overlay').fadeIn();
                    
                    if($navitem.parent().is('.nav')){
	                     /* Do active*/
	                    $navitem.find('.box').show();
	                    $navitem.find('.box > .subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});  
	                    $navitem.find('> .subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});  	                       
                    } else {
        				$navitem.find('> .subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});
                        $navitem.find('> span.nextlevel').text($min);
                        $navitem.siblings().find('> span.nextlevel').text($plu);
                    }  
                }
            }
            
            // Key esc ***************************************
            if (event.keyCode == 27) {
                resMenue();
             }
                    
        })
    

        $body.on('keydown', '.navlink', function(event) {
            var $this       = $(this),
                $parentitem = $this.parents('.navitem'),
            	$parent     = $this.parents('.nav'),
                $navitem    = $this.parent();
                
            // Key right ***************************************
            if (event.keyCode == 39) {
                if($navitem.parent().is('.nav')){
                    if ($parentitem.is(".nav > .navitem:last-child")) {
                        $parent.find('> .navitem:first-child').children('.navlink').focus();
                    } else {
                        $parentitem.next().children(".navlink").focus(); 
                    }
                   /* Do */
                    $parent.find('.box').hide();
                    $parent.find('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});  
                   
                } else {
                   /* Do */
                   $navitem.find('> .subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});                   
                   $navitem.find('> .subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});

                   $navitem.find('> span.nextlevel').text($min);
                   $navitem.find('> .subnav > .navitem:first-child').children('.navlink').focus();
                }
                event.preventDefault();
            } 
            
            // Key left ***************************************
            if (event.keyCode == 37) {
                if($navitem.parent().is('.nav')){
                    if ($parentitem.is(".nav > .navitem:first-child")) {
                        $parent.find('> .navitem:last-child').children('.navlink').focus();
                    } else {
                        $parentitem.prev().children(".navlink").focus();
                    }
                   /* Do */
                    $parent.find('.box').hide();
                    $parent.find('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});
                    
                } else {
                     if ($parentitem.find(".subnav").length > 1) {
                        if ($navitem.is(":first-child")) {
                            /* Do */
                             $navitem.parent().parent().children(".navlink").focus();
                             $navitem.parent().parent().find(' > .subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});
                             $navitem.parent().parent().find(' > span.nextlevel').text($plu);
                        }
                     }
                }
                event.preventDefault();
            } 
            
            // Key bottom *****************************************************************************
            if (event.keyCode == 40) {  
                if($navitem.parent().is('.nav')) {
	
	              /* Do */  
	                    $navitem.find('.box').show();
	                    $navitem.find('.box > .subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});  
	                    $navitem.find('> .subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});  	
	                    $navitem.find('> .subnav > .navitem:first-child > .navlink').focus();
                  
                    
                } else {
                    if ($navitem.is(".navitem:last-child")){
                       $this.parent().parent().closest('li').children('.navlink').focus();
                    } else {
                       $navitem.next().children(".navlink").focus();       
                    }


                }
                event.preventDefault();
            } 
            
            
            // Key top ***************************************
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
        })
 		
});
