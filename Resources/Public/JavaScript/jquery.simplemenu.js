jQuery(document).ready(function($) {
  
	var $nav = $('#menu'), 
		$body = $('body'),
		$anker = $('.ankerNav'),
		$htop = $('.top').height(),
		hwert = $('#menu ul li').height();
	  

	if (($nav.length) && ($(window).width() <= 991)) { // if there is at least one :) 	
	    $nav.prepend('<div class="simpleclose d-lg-none"><a href="#" class="symbol d-block pt-2 ps-3">&#xf00d;</a></div>');  	 	
		$('.simpleclose').height($htop);
		$('.simpleclose').css('margin-top',-$htop);

	}
	
	if (($nav.length) && ($(window).width() <= 991)){
		$('.top').append('<div class="mobilmenubutton d-flex align-items-center px-3"> Menu <a href="#" id="simplebutton" class="symbol">&#xf0c9;</a></div>');
	}

 	if (($anker.length) && ($(window).width() <= 991)) { // if there is at least one :)       
 		$("#menu ul li a span").css('display','block');
	}
	
    $("#simplebutton").click(function() {  
        $("html, body").animate({ scrollTop: 0 }, "slow");
        $(".page").toggleClass("pagepush"); 
        $(".overlay").fadeIn(); 
        $("#menu").toggleClass("mobil");    
    });  
    
 
    $(".simpleclose").click(function() {  
        $(".page").removeClass("pagepush");  
        $("#menu").removeClass("mobil");  
        $(".overlay").fadeOut();   
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