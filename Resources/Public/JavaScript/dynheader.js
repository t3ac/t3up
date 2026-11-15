(function () {
    "use strict";

    /**
     * Apply .blend class to the header when scrolling
     */

    const header = document.querySelector('#header');

    if (!header) return;

    function toggleScrolled() {
        if (!header.classList.contains('dynamic')) return;

        header.classList.toggle('blend', window.scrollY > 50);
    }

    document.addEventListener('scroll', toggleScrolled);
    window.addEventListener('load', toggleScrolled);

    // Header bei Mouseover hervorheben
    document.querySelectorAll('header').forEach(element => {
        element.addEventListener('mouseover', () => {
            header.classList.add('blend');
        });
    });

})();