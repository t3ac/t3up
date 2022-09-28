    // Search  ***********************************************************************************************

    $('#SO').mouseenter(function(){
        $('html, body').animate({scrollTop:0}, 'slow');
     });

    $('#SO').click( function (e) {
      
          if ($('body').children('#SO').length == 0) {
          	  $('#modal').slideUp("slow");
              $('#modal').remove();
              $(this).addClass('active');
              
              $('.page').click(function(e){
               	e.preventDefault();
               });	
               
                // Link-Ziel wird in Variable gespeichert
                var linkTarget = $(this).attr('href');
                $('<div>', {
                  id: 'modal'
                })
                // Über die Funktion load starte ich einen AJAX-Request
                // {type:913} an dieser Stelle können Sie zusätzliche Parameter übergeben (GET oder POST. 
        
                .load(linkTarget, {type: 912}, function () {
                  // Mit einer Zeitverzögerung von 300ms lasse ich die Lightbox langsam erscheinen
                  $(this).delay(100).slideDown("slow");
                })
                .prependTo('body')  // Das HTML meiner Box soll vor dem schließenden Body-Tag erscheinen
                 //e.preventDefault(); // Ähnlich wie return false; also: verhindere das normale Verhalten des Links
         }
      });
      

