jQuery(document).ready(function($) {
    
   var $body = $('body');
	
   container = parseInt($('.container').css('max-width'));
	
   $(window).bind('scroll', function () {
       if ($(window).scrollTop() > 45) {
            $('#modal').remove();
            $('.page').removeClass('trans');
            $('.page').unbind('click');
      }
	});
	
	$('a[href*=\\#].smooth').on('click', function (e) {		
		 	e.preventDefault();
		 	var target = this.hash;
		 	var $target = $(target);
		 	var $target = $target.offset().top;
		 	 $target = $target -100;
		 	$('html, body').stop().animate({
		  		'scrollTop': $target
		 	}, 900, 'swing', function () {
		  	window.location.hash = target;
		 	});
		});		

    $(".panel-heading a").click(function() {
        $('#tx-solr-search-functions').addClass('hg');
        $(window).scrollTop(0);
    });
    
    
    /* Nonav *********************************************************************************************************/  

   $body.on('ontouchend click', '.breadcrumbrow  .nonav1 > a', function(event) {
            event.preventDefault();
   });
   
   $body.on('ontouchend click', '.breadcrumbrow a.extend ', function(event) {
	       $(this).parent().siblings().removeClass('act');  
           $(this).parent().toggleClass('act');
   });  

    /* Fontsize *********************************************************************************************************/
    $("#size").change(function() {
        wert = $(this).val() / 10;
        document.documentElement.setAttribute("font-size", wert);   
        localStorage.setItem("font-size", wert);     
        $('html').css("font-size", wert + "rem");
        cwert = (wert * container);
        $('.container').css("max-width", cwert + 'px');

    });
    
    $(".fsrange").click(function() {
        $('html').css("font-size", "1rem");
        $('.container').css("max-width", container + 'px'); 
        $('.fsrange input').prop('value','10');
        document.documentElement.setAttribute("font-size", "");
        localStorage.setItem("font-size", "");  
    });
    

    /* Color-mode switcher *********************************************************************************************/
    $(".color-mode__btn").click(function(){
        if ($(this).is('.dark')) {
            document.documentElement.setAttribute("color-mode", "dark");
            localStorage.setItem("color-mode", "dark");
         } else if ($(this).is('.light')) {
            document.documentElement.setAttribute("color-mode", "contrast");
            localStorage.setItem("color-mode", "contrast");
         } else if ($(this).is('.system')) {
            document.documentElement.setAttribute("color-mode", "system");
            localStorage.setItem("color-mode", "");
            checkDarkMode();
         }
     });
     
    $body.on('click', '#modal .btn-close', function(event) {  

       $('#modal').remove();

       $('.page').unbind('click');

     });

    /* Service Area *********************************************************************************************/
     $("#service_nav > li > a").click(function(){
        $(this).parent().siblings().find('.tab-pane').removeClass('active show');
        $(this).parent().find('.tab-pane').toggleClass('active show');
    });

     
    $body.on('click', '#service_nav .btn-close', function(event) {  
       $('#service_nav .tab-pane').removeClass('active show');
    });
	

	/* Main ************************************************************************************************************/
	$('main').css('padding-bottom',$('footer').height()); 
	
   	$(window).resize(function(){		
		$('main').css('padding-bottom',$('footer').height()); 	
	});
   		
   		
	/* Footer **********************************************************************************************************/
	if ( $(window).width() < 576 ) {
	   	$('.footer1 .trigger').click(function(){
			$(this).next().slideToggle( "slow" );
			$(this).toggleClass('active');
			if ($(this).attr('aria-expanded') === 'true' ) {
				$(this).attr({'aria-expanded': 'false'});
			} else {
				$(this).attr({'aria-expanded': 'true'});
			}
		})
   	} 
   	
	if ( $(window).width() > 576 ) {
	   	$('#tx-solr-search-functions h3 > a').click(function(){
			$(this).parent().parent().siblings().toggleClass('collapse');
		})
   	} 
   	
	/* Section Index ****************************************************************************************************/
	$.each($('.sectionIndex'), function(index, value) {
		$(this).addClass('n' + (index + 1) );
	});

});