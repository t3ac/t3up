$(document).ready(function() {
	
	var $nav = $('.subnavigation'), $body = $('body');
   
	if ($nav.length) { // if there is at least one :)
	   	  
		var $navlink = $('.navlink'),
			$plu = unescape('+'),
			$min = unescape('–'),
		    $body = $('body');
	
		$navlink.each(function(index) {
			var	$this = $(this),
				index_li = index + 1,
				$subnav = $this.next('.subsubmenu');
		})
		
	     $('.subnavigation').find('.cur').find('> .subsubmenu').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});
 		 $('.subnavigation').find('.act').find('> .subsubmenu').attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});
 		 $('.subnavigation ul li').has( ".subsubmenu" ).append('<span>' + unescape('+') + '</span>');
 		 $('.subnavigation ul li.cur').has( ".subsubmenu" ).find('> span').text(unescape('–')); 		 
	     $('.subnavigation ul li.act').has( ".subsubmenu" ).find('> span').text(unescape('–')); 	
	      
		// Click Eigenschaften  *******************************************************************************************************
			
		// SPAN ***************************************************************************************/		
		


		
		$('.subnavigation li span').click(function(){
          	var	$li			= $(this).parent(),	
          		$this		= $(this),
				$subnav	    = $li.find('> .subsubmenu'),
				$height	    = $li.find('.navlink').height(),
				$height	    = $height + 24;
			
				if ($li.attr('data-show-sub') === 'true') {
					$li.attr({'data-show-sub': 'false'});
					$li.removeClass('cur');
					$this.text(unescape('+')); 
					$this.css('height',$height); 
					$li.removeClass('activated');
					$subnav.slideUp(function(){
						$subnav.attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});
					});
				}else {
					$li.siblings().find('> span').text($plu);
					$li.siblings().removeClass('activated');
					$li.siblings().attr({'data-show-sub': 'false'});
					$li.siblings().find('> .subsubmenu').slideUp().attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});		
					$this.css('height',$height); 
					$this.text(unescape('–')); 
					$li.attr({'data-show-sub': 'true'});
					$li.addClass('activated');
					$subnav.slideDown();
					$subnav.attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});		
				}	
		})  
		
		
		$body.on('keydown', '.subnavigation .navlink', function(event) {
			
          	var	$li			= $(this).parent(),	
          		$span       = $li.find('>span'),
				$subnav	    = $li.find('> .subsubmenu'),
          		$this		= $(this),
				$height	    = $this.height(),
				$height	    = $height + 24;
			
			if (event.keyCode == 9) {
				
				if ($li.attr('data-show-sub') === 'true') {
					$li.attr({'data-show-sub': 'false'});
					$li.removeClass('cur');
					$span.text(unescape('+')); 
					$span.css('height',$height); 
					$li.removeClass('activated');
					$subnav.slideUp(function(){
						$subnav.attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});
					});
				}else {
					$li.siblings().find('> span').text($plu);
					$li.siblings().removeClass('activated');
					$li.siblings().attr({'data-show-sub': 'false'});
					$li.siblings().find('> .subsubmenu').slideUp().attr({'aria-hidden': 'true'}).attr({'aria-expanded':'false'});		
					
					$span.text(unescape('–')); 
					$span.css('height',$height); 
					$li.attr({'data-show-sub': 'true'});
					$li.addClass('activated');
					
					$subnav.slideDown();
					$subnav.attr({'aria-hidden': 'false'}).attr({'aria-expanded':'true'});		
				}
				
				
			}	
			 	
		})
	}	
});


