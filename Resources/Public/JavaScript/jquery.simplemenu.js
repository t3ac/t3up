jQuery(document).ready(function($) {
  
    var $nav = $('#menu'), 
        $body = $('body'),
        $anker = $('.ankerNav');
      

     if (($anker.length) && ($(window).width() <= 9991)) { // if there is at least one :)       
         $("#menu ul li a span").css('display','block');
    }
    
    $(".meanmenu-reveal").click(function() {  
        $("html, body").animate({ scrollTop: 0 }, "slow");
       // $(".page").toggleClass("pagepush"); 
        $("#menu").toggleClass("mobil");    
        $("nav#menu").show();    
    });  

  $(".overlay").click(function() {  
  //      $(".page").removeClass("pagepush");  
        $("#menu").removeClass("mobil");  
        $(".overlay").fadeOut();
        $("#menu").find('span').removeClass("on");  
        
 });  
       
        
    $("#menu ul li a").each(function(index, value) { 
        if($(this).is(':last-child'))
            {
                 //
            } else {
                $(this).parent().find('span').addClass("on");
             //   $(this).next().prepend('<li class="overview"><a href="' + $(this).attr('href') + '">' + $(this).text() + '</a></li>');      
                $(this).parent().find('span').click(function() {
                      var myul = $(this).parent().find('> .subnav')
                           if(myul.css('display')!=='block') {
                                 myul.slideDown('fast');
                                 $(this).parent().find('span').addClass('on');
                    } else {
                                myul.slideUp('fast');
                                $(this).parent().find('span').removeClass('on');
                            }
                        return false;     
                    });
            }    
    });
        
});