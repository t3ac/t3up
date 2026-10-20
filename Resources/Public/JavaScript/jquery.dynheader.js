(function() {
  "use strict";

  /**
   * Apply .scrolled class to the body as the page is scrolled down
   */
  
  const $body = $("body");
  
  function toggleScrolled() {
        const selectHeader = document.querySelector('#header');
        if (!selectHeader.classList.contains('dynamic')) return;
        // window.scrollY > 50 ? selectHeader.classList.add('blend') : selectHeader.classList.remove('blend');
        window.scrollY > 50 ? selectHeader.classList.add('blend') : selectHeader.classList.remove();
  }

  document.addEventListener('scroll', toggleScrolled);
  window.addEventListener('load', toggleScrolled);

  
  $body.on('mouseover', 'header', function() {
    $('#header').addClass('blend');
  });

})();