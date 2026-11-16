
document.addEventListener('DOMContentLoaded', function () {

    const navs = document.querySelectorAll('.subnavigation');

    if (!navs.length) return;

    const plus = '+';
    const minus = '–';


    /* Slide Animation ************************************/

    function slideSubnav(element, show, callback) {

        // Laufende Animation abbrechen
        element.getAnimations().forEach(animation => animation.cancel());

        if (show) {
            element.style.display = '';

            if (getComputedStyle(element).display === 'none') {
                element.style.display = 'block';
            }
        }

        const startHeight = show ? 0 : element.offsetHeight;
        const endHeight = show ? element.scrollHeight : 0;

        element.style.overflow = 'hidden';

        const animation = element.animate(
            [
                { height: startHeight + 'px' },
                { height: endHeight + 'px' }
            ],
            {
                duration: 50,
                easing: 'ease',
                fill: 'forwards'
            }
        );

        animation.onfinish = function () {

            element.style.height = '';
            element.style.overflow = '';

            if (!show) {
                element.style.display = 'none';
            }

            if (callback) callback();

        };
    }


    /* Untermenü öffnen / schließen **********************/

    function closeSubnav(li) {

        const span = li.querySelector(':scope > span');
        const subnav = li.querySelector(':scope > .subsubmenu');

        li.dataset.showSub = 'false';
        li.classList.remove('cur', 'activated');

        if (span) span.textContent = plus;

        if (subnav) {

            slideSubnav(subnav, false, function () {

                subnav.setAttribute('aria-hidden', 'true');
                subnav.setAttribute('aria-expanded', 'false');

            });

        }
    }


    function openSubnav(li) {

        const span = li.querySelector(':scope > span');
        const subnav = li.querySelector(':scope > .subsubmenu');

        if (!subnav) return;

        // Andere Untermenüs schließen
        Array.from(li.parentElement.children).forEach(function (sibling) {

            if (sibling !== li && sibling.matches('li')) {
                closeSubnav(sibling);
            }

        });

        if (span) span.textContent = minus;

        li.dataset.showSub = 'true';
        li.classList.add('activated');

        subnav.setAttribute('aria-hidden', 'false');
        subnav.setAttribute('aria-expanded', 'true');

        slideSubnav(subnav, true);

    }


    function toggleSubnav(li) {

        if (li.dataset.showSub === 'true') {
            closeSubnav(li);
        } else {
            openSubnav(li);
        }

    }


    /* Initialisierung ************************************/

    navs.forEach(function (nav) {

        // Vorhandene aktive Menüs berücksichtigen
        nav.querySelectorAll('li.cur, li.act').forEach(function (li) {

            const subnav = li.querySelector(':scope > .subsubmenu');

            if (subnav) {

                subnav.setAttribute('aria-hidden', 'false');
                subnav.setAttribute('aria-expanded', 'true');

                li.dataset.showSub = 'true';
                li.classList.add('activated');

            }

        });


        // Plus-/Minus-Zeichen ergänzen
        nav.querySelectorAll('ul li').forEach(function (li) {

            const subnav = li.querySelector(':scope > .subsubmenu');

            if (!subnav) return;

            let span = li.querySelector(':scope > span');

            if (!span) {
                span = document.createElement('span');
                li.appendChild(span);
            }

            span.textContent =
                li.classList.contains('cur') || li.classList.contains('act')
                    ? minus
                    : plus;

        });


        /* Click Eigenschaften ***************************/

        nav.addEventListener('click', function (event) {

            const span = event.target.closest('li > span');

            if (!span || !nav.contains(span)) return;

            const li = span.parentElement;

            if (!li.querySelector(':scope > .subsubmenu')) return;

            toggleSubnav(li);

        });


        /* Tastaturbedienung *****************************/

        nav.addEventListener('keydown', function (event) {

            if (event.key !== 'Tab') return;

            const link = event.target.closest('.navlink');

            if (!link || !nav.contains(link)) return;

            const li = link.parentElement;

            if (li.querySelector(':scope > .subsubmenu')) {
                toggleSubnav(li);
            }

        });

    });

});
