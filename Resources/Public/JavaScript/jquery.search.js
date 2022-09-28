// Search  ***********************************************************************************************

$('#SE').mouseenter(function(){
    $('html, body').animate({scrollTop:0}, 'slow');
 });

$('#SE').click( function (e) {
   if ($('body').children('#SE').length == 0) {
      $( "#modal" ).remove();
        
      if($(this).hasClass('active')){
          $(this).removeClass('active');
    } else {
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
      // {type:xxx} an dieser Stelle können Sie zusätzliche Parameter übergeben (GET oder POST. 

      .load(linkTarget, {type: 912}, function () {
          // Mit einer Zeitverzögerung von 300ms lasse ich die Lightbox langsam erscheinen
          $(this).delay(500).fadeIn();
      })
     .prependTo('body')  // Das HTML meiner Box soll vor dem schließenden Body-Tag erscheinen
     }
  }
});
      
