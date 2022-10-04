$(document).ready(function() {
    
    var $nav = $('.nav'), 
        $body = $('body'),
        navblock1 = 0,
        navblock2 = 0,
        navblock3 = 0;

             
    /* Inits start *******************************************************************************/    
    
        $('#menu ul ul li').has( ".subnav" ).find('span').text($plu);  
        $('.nav li').last().addClass('lastitem');    
        $('.nav li.dropmenue > span').text($pluTop);    
        $('.mediaNav #menu > .nav > li > .row').wrap('<div class="box"><div class="container px-0 px-lg-3"></div><span class="btn-close"></span></div>');
            
        $('#menu ul ul').each(function() {    
            if ($(this).children().length > navblock1) {
                navblock1 = $(this).children().length;
            }   
        }); 
        $('#menu ul ul ul').each(function() {    
            if ($(this).children().length > navblock2) {
                navblock2 = $(this).children().length;
            }       
        });
        $('#menu ul ul ul ul').each(function() {    
            if ($(this).children().length > navblock2) {
                navblock3 = $(this).children().length;
            }       
        });
        var navblock = [navblock2,navblock1,navblock3]
        navblock = (Math.max.apply(Math,navblock));
        
       // liheight = (parseInt($('html').css('font-size')));
        liheight = $('.subnav > li').height();
        li2height= (parseInt($('html').css('font-size')));
        blockNavHeight = liheight * navblock; 
        // $('.box').css('height', (navblock + 1) * 50); 
            
    /* Inits end *********************************************************************************/
    
    /* Resets start ******************************************************************************/  

        function meineFunktion(){
            if ($(window).width() >= 992) {
                $('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});     
                $('#menu li').attr({'data-show-sub': 'false'}).removeClass('activated');
                $('#menu .subnav li > span').text($plu);
                $('#menu > .nav > li > span').text($pluTop);
                $('.box').fadeOut('fast');  
                $('.submenulevel').fadeOut('fast');   
                $(".overlay").fadeOut();  
            }
        }
              
        $body.on('click', ' .btn-close', function(event) {  
            // ESC-Taste schliesst das Menu
           meineFunktion();
        });

        $body.on('focus click', '.logo', function(event) {
            meineFunktion();
        })  
        
        $body.on('focus mouseenter click', '.top', function(event) {
            meineFunktion();
        })  
        
        $body.on('click ontouchend', '.overlay', function(event) {
            meineFunktion();
        })  
        
        $body.on('mouseleave', '.Nav', function(event) {
              // meineFunktion();
        })  
        
        $body.on('click ontouchend', '.closelink', function(event) {
            event.preventDefault();
            $(".overlay").fadeOut();  
            $(this).parent().find('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});
            $(this).parent().find('li').removeClass('activated');
            $(this).removeClass('activated');
            $(this).toggleClass('navlink').toggleClass('closelink');  
            $(this).parent().find('> span').text($pluTop);  
            $('.box').hide();
        })  
        

    /* Resets end ********************************************************************************/

    /* Menue *************************************************************************************/
    /* Nav */
    if (($nav.length) && ($(window).width() > 991)) { // if there is at least one :)
   
       $body.on('ontouchend click', '.standardNav .navlink', function(event) {
            var $this = $(this),
                $p    = $(this).parent();
                    
            /* Reset */ 
          
            $p.siblings().find('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});
            $p.siblings().attr({'data-show-sub': 'false'});  
            $p.siblings().removeClass('activated');
            $p.siblings().find('li').removeClass('activated');
            $p.find('.subnav span').text($plu);
            $p.siblings().find('> span').text($pluTop);
            $p.siblings().find(' > a').addClass('navlink').removeClass('closelink');

           /* Do */
            if (($this.next().length) & ($this.parent().parent().is('.nav'))){
                event.preventDefault();
                $('.overlay').fadeIn(); 
                $p.addClass('activated');
                $p.find('> span').text($minTop);
                $p.attr({'data-show-sub': 'true'});  
                $p.find(' > .subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});
                
                $this.toggleClass('navlink').toggleClass('closelink');
            } else {
                /* Reset */
                $p.parent().find('span').text($plu);
                
                /* Do */
                $p.find('> span').text($min);
            } 
		 })

        
        
        /* Media */

        $body.on('ontouchend click', '.mediaNav .navlink', function(event) {
            var $this   = $(this),
                $p      = $(this).parent();  
                
                /* Reset */ 
                $p.siblings().find('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});
                $p.siblings().attr({'data-show-sub': 'false'});  
                $p.siblings().removeClass('activated');
                $p.siblings().find('li').removeClass('activated');
                $p.find('.subnav span').text($plu);
                $p.siblings().find('> span').text($pluTop);
                $p.siblings().find(' > a').addClass('navlink').removeClass('closelink');
                
                
                if (($this.next().length) & ($this.parent().parent().is('.nav'))){
                    event.preventDefault();         
                    $('.overlay').fadeIn();  
                    $p.addClass('activated');   
                    $p.find('> span').text($minTop); 
                    $p.attr({'data-show-sub': 'true'});  
                    $p.find('.box > .subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});
                    $p.find('.box').fadeIn('fast',function(){
                        $p.siblings().find('.box').hide();
                    });
                    
                  $p.find('li.act').parent().attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});
                  $p.find('li.act > span').text($min);                  
                  $p.find('li.cur').parent().attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});
                  $p.find('li.cur > span').text($min);                  
                   // $p.find('.submenulevel').css('display','flex');
                 //   $p.find('.subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});
                //    $this.toggleClass('navlink').toggleClass('closelink');
   
                }
                
                    
        })
        
        
        
        /* Block */
        $body.on('ontouchend click', '.blockNav .navlink', function(event) {
            var $this = $(this).parent(); 
            
            /* Reset */ 
            $this.siblings().removeClass('activated');
            $this.find('.subnav .subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'})
            $this.siblings().find(' > a').addClass('navlink').removeClass('closelink');
            
            if ($this.parent().is('.nav')) { 
                $this.siblings().find('> .subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'})
                event.preventDefault();
            }
            
            
           /* Do */
            $this.addClass('activated');
            $(this).toggleClass('navlink').toggleClass('closelink')
            $this.attr({'data-show-sub': 'true'});  
            $this.find(' > .subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'})
            $('.overlay').fadeIn();

        })
        
        /* Ankernav */
          $body.on('.ontouchend click').on('.ankerNav .navlink ',function(e) {
            e.preventDefault();
            var target = this.hash;
            var $target = $(target);
            $('html, body').stop().animate({
                'scrollTop': $target.offset().top
            }, 900, 'swing', function () {
            window.location.hash = target;
            });
        }); 
        
        // span click **************************************************************************************/       
        
        // Untermenue oeffnen und schliessen der Submenues
        $body.on('click', '#menu .subnav .navitem > span', function(event) {
            var $span = $(this).text(),
                $p    = $(this).parent();

            $(this).text(function(i, text){
                return text === $plu ? $min : $plu;
            })
            
            if ($span == $min) {
                $p.siblings().find('span').text($plu);
                $p.find('> .subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});
            } else {
                $p.parent().find('li').attr({'data-show-sub': 'true'}).removeClass('activated');
                $p.parent().find('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});       
                $p.find('> .subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});
                $p.siblings().find('span').text($plu);
                $p.addClass('activated');
            }
        })  


        $body.on('click', '.standardNav .dropmenue > span', function(event) {
            var $span = $(this).text(),
                $p = $(this).parent(); 
                
                $('.dropmenue .subnav span').text($plu);
                
            $(this).text(function(i, text){
                // return text === "+" ? "–" : "+";
                return text === $pluTop ? $minTop : $pluTop;
            })
            

                
            if ($span == $minTop) {
	
            	// Reset
                $p.siblings().attr({'data-show-sub': 'false'});  
                $p.siblings().find('li').removeClass('activated');
                $p.siblings().find('> span').text($pluTop);
	            $p.siblings().find('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});            
	            $('.overlay').fadeOut();  
	
                $p.find('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});
                $p.find('.subnav span').text($plu);
                $this.text($pluTop);
				$p.find(' > a').addClass('navlink').removeClass('closelink');
                
            } else {
	
            	// Reset
                $p.siblings().attr({'data-show-sub': 'false'});  
                $p.siblings().find('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});  
                $p.siblings().find('> span').text($pluTop);
                $p.siblings().find('li').removeClass('activated');
                
                $p.attr({'data-show-sub': 'true'});  
                $p.find('> .subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});
                $('.overlay').fadeIn();
            }
        })  

        $body.on('click', '.mediaNav .dropmenue > span', function(event) {
            var $span = $(this).text(),
                $this   = $(this).parent(),
                $clone  = '',
                $elem   = $this.find('>.capital'),
                $clone  = $elem.clone(true);  
                
				$('.dropmenue .subnav span').text($plu);
				
            $(this).text(function(i, text){
                // return text === "+" ? "–" : "+";
                return text === $pluTop ? $minTop : $pluTop;
            })
            
            if ($span == $minTop) {
                $('.box').fadeOut('fast');  
                // $this.siblings().find('> span').text($pluTop);

                $('.overlay').fadeOut();
                
            } else {
                $this.siblings().find('> span').text($pluTop);
                $this.find('.box').fadeIn('fast',function(){
                    $this.siblings().find('.box').hide();
                });
                
                $this.find('.submenulevel').css('display','flex');
                $this.find('.row > .subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});
                $this.find('.im img').replaceWith($clone);   // Replace the Capitalimage
                $this.find('.im .capital').fadeIn('slow');
                
                
                $('.overlay').fadeIn();
            }
        })  


    // Tastatatur Eigenschaften *************************************************************************************************************
    

        $(document.body).on('keyup', function (event) {
            if (event.keyCode == 27) {
                // ESC-Taste schließt das Menu
                meineFunktion();
             }
        })

        $body.on('keydown', '.navlink', function(event) {
            var $this       = $(this),
                $parentitem = $this.parents('.navitem'),
            	$parent     = $this.parents('.nav'),
                $navitem    = $this.parent(),
                $clone      = '',
                $elem       = $navitem.find('>.capital'),
                $clone      = $elem.clone(true); ;
   
            // TAB  ************************************************************************************
            if (event.keyCode == 9) {
                if($navitem.is('.lastitem')){
                   meineFunktion(); 
                } else {
                    /* Reset */
                    $navitem.siblings().find('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});
                    $navitem.siblings().attr({'data-show-sub': 'false'});  
                    $navitem.siblings().removeClass('activated');
                    $navitem.siblings().find('li').removeClass('activated');
                    $navitem.siblings().find('.box').hide();
                    $navitem.find('.subnav li > span').text($plu); 
                                       
                    /* Do */
                    $navitem.addClass('activated');
                    $navitem.find('> span').text($minTop);
                    $navitem.attr({'data-show-sub': 'true'}); 
                    $navitem.find(' > .subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});
                    $('.overlay').fadeIn();
                   
                   
                    if($navitem.parent().is('.nav')){
        
                    } else {
        
                           $navitem.find('> span').text($min);
                    }
   
                    /* Do Media*/
                    $navitem.find('.box').show();
                    $navitem.find('.submenulevel').css('display','flex');
                    $navitem.find('.row > .subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});
                    $navitem.find('.im img').replaceWith($clone);   // Replace the Capitalimage
                    $navitem.find('.im .capital').fadeIn('slow');
                    
                }
     
             }

            // TAB & Shift Esc *************************************************************************
            if (event.shiftKey && event.keyCode == 9) {
                if($navitem.parent().is('.nav')){
                    if ($parentitem.is(".nav > .navitem:first-child")) {
                        meineFunktion(); 
                    }else{
				}
                    
                } else {
                   	$navitem.find('> span').text($plu);
                }
                  
             }

                
                // Key left
            if (event.keyCode == 37) {
                if($navitem.parent().is('.nav')){
                    if ($parentitem.is(".nav > .navitem:first-child")) {
                        $parent.find('> .navitem:last-child').children('.navlink').focus();
                        $parent.find('> .navitem:last-child').children('span').text($minTop);
                    } else {
                        $parentitem.prev().children(".navlink").focus();
                        $parentitem.prev().children('span').text($minTop);
                        $parentitem.children('span').text($pluTop);
                    }
                   /* Do */ 
                   $(".nav > li > .subnav").attr({'aria-hidden': 'true'}).attr({'aria-expanded':'hidden'});

                } else {
                     if ($parentitem.find(".subnav").length > 1) {
                        if ($navitem.is(":first-child")) {
                            /* Do */
                             $navitem.parent().parent().children(".navlink").focus();
                             $navitem.parent().parent().find(' > .subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'hidden'});
                             $navitem.parent().parent().find(' > span').text($plu);
                        }
                     }
                }
                event.preventDefault();
            } 
            

                // Key right
            if (event.keyCode == 39) {
                if($navitem.parent().is('.nav')){
                    if ($parentitem.is(".nav > .navitem:last-child")) {
                        $parent.find('> .navitem:first-child').children('.navlink').focus();
                        $parent.find('> .navitem:first-child').children('span').text($minTop);
                    } else {
                        $parentitem.next().children(".navlink").focus(); 
                        $parentitem.next().children('span').text($minTop);
                        $parentitem.children('span').text($pluTop)
                    }
                    /* Do */
                    $(".nav > li > .subnav").attr({'aria-hidden': 'true'}).attr({'aria-expanded':'hidden'});
					//$(".nav > li > span").text($pluTop);

                } else {
                   /* Do */
                   $navitem.find('> .subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});
                   $navitem.find('> span').text($min);
                   $navitem.find('> .subnav > .navitem:first-child').children('.navlink').focus();
                }
                event.preventDefault();
            } 
            
            // Key bottom *****************************************************************************
            if (event.keyCode == 40) {  
                if($navitem.parent().is('.nav')) {
                    /* Do */  
                    $navitem.siblings().find('.subnav').attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});
                    $navitem.find(' > .subnav').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});
                    $navitem.find('> ul > .navitem:first-child').children(".navlink").focus();
                    $navitem.siblings().find('.box').hide();
                    $('.overlay').fadeIn();
                    
                } else {
                    if ($navitem.is(".navitem:last-child")){
                        $this.parent().parent().closest('li').children('.navlink').focus();
                    } else {
                        $navitem.next().children(".navlink").focus();       
                    }
                }
                event.preventDefault();
            } 
            
            
            // Key top *****************************************************************************
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

        
        
        
    }    
});
