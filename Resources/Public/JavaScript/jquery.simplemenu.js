jQuery(document).ready(function($) {
  
	var $nav = $('#menu'), 
		$body = $('body'),
		$anker = $('.ankerNav');
	  

 	if (($anker.length) && ($(window).width() <= 991)) { // if there is at least one :)       
 		$("#menu ul li a span").css('display','block');
	}
	
    $(".meanmenu-reveal").click(function() {  
        $("html, body").animate({ scrollTop: 0 }, "slow");
        $(".page").toggleClass("pagepush"); 
        $(".overlay").fadeIn(); 
        $("#menu").toggleClass("mobil");    
        $("nav#menu").show();    
    });  

    $(".overlay").click(function() {  
        $(".page").removeClass("pagepush");  
        $("#menu").removeClass("mobil");  
        $(".overlay").fadeOut();   
    });  
       
	  
	if (($nav.length) && ($(window).width() <= 991)) { // if there is at least one :) 
  
		$("#menu ul li a").each(function(index, value) { 
		    if($(this).is(':last-child'))
		    	{
		    	     //
		    	} else {
		    		$(this).addClass('plus');
		    		$(this).next().prepend('<li class="overview"><a href="' + $(this).attr('href') + '">' + $(this).text() + '</a></li>');  	
		    		$(this).click(function() {
			    			    	if ($(window).width() <= 991) {
			    			    	  var myul = $(this).parent().find('> .subnav')			    	  	 							
			    			   			if(myul.css('display')!=='block') {
			    			   			  	myul.slideDown('fast');
			    			   			  	$(this).addClass('on');
			    			   			 } else {
			    			   			 	myul.slideUp('fast');
			    			   			 	$(this).removeClass('on');
			    			   			 }
				    			    	return false;	 
			    			    	}	    			     			    	
		    			});
		    	}	
		});
	    
	}

});