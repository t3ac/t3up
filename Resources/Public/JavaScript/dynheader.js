(function () {
    "use strict";
    /**
     * Header bei Scrollen und Mouseover steuern
     */
    const header = document.querySelector('#header');
    if (!header) return;
    function updateHeader() {
        const scrolled = window.scrollY;
        if (header.classList.contains('dynamic')) {
            header.classList.toggle('blend', scrolled > 50);
			header.classList.toggle('shrink', scrolled > 200);
        }
    }

    // Scroll- und Ladeereignis
    window.addEventListener('scroll', updateHeader, { passive: true });
    window.addEventListener('load', updateHeader);

    // Initialer Zustand
    updateHeader();

    // Header bei Mouseover hervorheben
    header.addEventListener('mouseover', function () {
        header.classList.add('blend');
    });
})();
