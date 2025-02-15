jQuery(document).ready(function($) {
      

    /* To Top **********************************************************************************************************/
    $(window).bind('scroll', function () {
        if ($(window).scrollTop() > 65) {
            $('.toTop').addClass('fixed');            
        } else {
            $('.toTop').removeClass('fixed');
        }
        
    });
    
     $('.scrollup').click(function(){
        $('html, body').animate({ scrollTop: 0 }, 600);
        return false;
    });
   
      
});


