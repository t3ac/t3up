
document.addEventListener('DOMContentLoaded', function () {

    const body = document.body;
    const menu = document.querySelector('#menu');

    if (!menu) return;

    const plus = '+';
    const minus = '–';

    const colors = [
        'turquoise', 'green', 'blue', 'red',
        'grey', 'violett', 'orange'
    ];

    /* Hilfsfunktionen ************************************/

    function toggleAria(element, expanded) {

        if (!element) return;
        element.setAttribute('aria-hidden', String(!expanded));
        element.setAttribute('aria-expanded', String(expanded));
    }


    function showElement(element, animate = false) {

        if (!element) return;
        element.style.display = '';
        if (getComputedStyle(element).display === 'none') {
            element.style.display = 'block';
        }

        if (animate) {
            element.animate(
                [{ opacity: 0 }, { opacity: 0.65 }],
                { duration: 50, fill: 'forwards' }
            );
        }
    }

    function showBox(element, animate = false) {

        if (!element) return;
        element.style.display = '';
        if (getComputedStyle(element).display === 'none') {
            element.style.display = 'block';
        }

        if (animate) {
            element.animate(
                [{ opacity: 0 }, { opacity: 1 }],
                { duration: 50, fill: 'forwards' }
            );
        }
    }
	
    function hideElement(element, animate = false) {

        if (!element) return;
        if (animate) {
            const animation = element.animate(
                [{ opacity: getComputedStyle(element).opacity }, { opacity: 0 }],
                { duration: 50, fill: 'forwards' }
            );

            animation.onfinish = function () {
                element.style.display = 'none';
                element.style.opacity = '';
            };
        } else {

            element.style.display = 'none';
        }
    }

    function resetSiblings(item) {

        if (!item || !item.parentElement) return;

        Array.from(item.parentElement.children).forEach(function (sibling) {

            if (sibling === item) return;

            // Aktiven Navigationslink zurücksetzen
            const link = sibling.querySelector(':scope > .navlink');
            if (link) link.classList.remove('show');

            sibling.querySelectorAll('.subnav').forEach(function (subnav) {
                toggleAria(subnav, false);
            });

            sibling.querySelectorAll('li').forEach(function (li) {
                li.dataset.showSub = 'false';
                li.classList.remove('activated');
            });

            sibling.querySelectorAll('li > span').forEach(function (span) {
                span.textContent = plus;
            });

            sibling.querySelectorAll('.box').forEach(function (box) {
                hideElement(box);
            });
        });
    }

    /* Menü zurücksetzen **********************************/

    function resMenu() {
        if (window.innerWidth < 768) return;
        resetMenu();
    }

    function resetMenu() {
        menu.querySelectorAll('.subnav').forEach(function (subnav) {
            toggleAria(subnav, false);
        });

        menu.querySelectorAll('li').forEach(function (li) {
            li.dataset.showSub = 'false';
            li.classList.remove('activated');
        });

        menu.querySelectorAll('.subnav span.nextlevel').forEach(function (span) {
            span.textContent = plus;
        });

        document.querySelectorAll('.box, .submenulevel, .overlay')
            .forEach(function (element) {
                hideElement(element, true);
            });

        document.querySelectorAll('.navlink.show').forEach(function (link) {
            link.classList.remove('show');
        });
		
		document.querySelectorAll('#menu').forEach(subnav => {
		    subnav.setAttribute('aria-hidden', 'true');
			subnav.setAttribute('aria-expanded', 'false');
		});
    }

    /* Initialisierung ************************************/

    // Pluszeichen setzen
    menu.querySelectorAll('ul ul li').forEach(function (li) {
        if (li.querySelector(':scope > .subnav')) {
            const span = li.querySelector(':scope > span.nextlevel');
            if (span) span.textContent = plus;
        }
    });

    // Letztes Navigationselement markieren
    document.querySelectorAll('.nav').forEach(function (nav) {
        const items = nav.querySelectorAll(':scope > li');
        if (items.length) {
            items[items.length - 1].classList.add('lastitem');
        }
    });


    // ActiveNav: Box-Container erzeugen
    document.querySelectorAll(
        '.activeNav #menu > .nav > li > .row'
    ).forEach(function (row) {

        const box = document.createElement('div');
        box.className = 'box';

        const container = document.createElement('div');
        container.className = 'container px-0 px-lg-3';

        const close = document.createElement('span');
        close.className = 'btn-close';

        row.parentNode.insertBefore(box, row);

        box.appendChild(container);
        container.appendChild(row);
        box.appendChild(close);
    });


    // Vorhandene aktive Menüs
    menu.querySelectorAll('li.act, li.cur').forEach(function (li) {
        li.dataset.showSub = 'true';
        const subnav = li.querySelector(':scope > .subnav');
        if (subnav) {
            toggleAria(subnav, true);
        }
        const span = li.querySelector(':scope > span.nextlevel');
        if (span) span.textContent = minus;
    });

    /* Overlay-Farbe **************************************/

    body.addEventListener('focusin', setOverlayColor);
    body.addEventListener('mouseover', setOverlayColor);
    body.addEventListener('click', setOverlayColor);

    function setOverlayColor(event) {
        const li = event.target.closest('#menu > .nav > li');
        if (!li) return;
        const color = colors.find(function (color) {
            return li.classList.contains(color);
        });
        if (color) {
            document.querySelectorAll('.overlay').forEach(function (overlay) {
                overlay.className = 'overlay ' + color;
            });
        }
    }


    /* Reset Events ****************************************/

    body.addEventListener('click', function (event) {
        if (event.target.closest('.btn-close, .overlay, .closelink, .logo')) {
            resMenu();
        }
    });


    body.addEventListener('focusin', function (event) {
        if (event.target.closest('.logo')) {
            resMenu();
        }
    });


    /* Navigationstypen ***********************************/

    // StandardNav
	body.addEventListener('click', function (event) {

	    const link = event.target.closest('.standardNav .navlink');
	    if (!link) return;

	    const li = link.parentElement;

	    // Prüfen, ob bereits geöffnet
	    const isActive = li.classList.contains('activated');

	    resetSiblings(li);

	    if (link.nextElementSibling && li.parentElement.classList.contains('nav')) {

	        event.preventDefault();

	        if (isActive) {
	            li.classList.remove('activated');
	            li.dataset.showSub = 'false';

	            const span = li.querySelector(':scope > span.nextlevel');
	            if (span) span.textContent = plus;

	            toggleAria(li.querySelector(':scope > .subnav'), false);

	            document.querySelectorAll('.overlay').forEach(function (overlay) {
	                hideElement(overlay, true);
	            });

	        } else {

	            document.querySelectorAll('.overlay').forEach(function (overlay) {
	                showElement(overlay, true, 0.25);
	            });

	            li.classList.add('activated');
	            li.dataset.showSub = 'true';

	            const span = li.querySelector(':scope > span.nextlevel');
	            if (span) span.textContent = minus;

	            toggleAria(li.querySelector(':scope > .subnav'), true);
	        }
	    }
	});
	

    // ActiveNav
    body.addEventListener('click', function (event) {

        const link = event.target.closest('.activeNav .navlink');

        if (!link) return;

        const li = link.parentElement;

        resetSiblings(li);

        if (link.classList.contains('show')) {
            resMenu();
            event.preventDefault();
        } else if (
            link.nextElementSibling &&
            li.parentElement.classList.contains('nav')
        ) {
            event.preventDefault();
            document.querySelectorAll('.overlay').forEach(function (overlay) {
                showElement(overlay, true);
            });

            li.classList.add('activated');
            li.dataset.showSub = 'true';

            const span = li.querySelector(':scope > span.nextlevel');

            if (span) span.textContent = minus;

            const box = li.querySelector('.box');

            if (box) {

                toggleAria(box.querySelector(':scope .subnav'), true);
				showBox(box, true);
                li.parentElement.querySelectorAll(':scope > li .box').forEach(function (otherBox) {

                    if (otherBox !== box) {
                        hideElement(otherBox);
                    }

                });

            }

            li.querySelectorAll('li.act, li.cur').forEach(function (active) {

                toggleAria(active.querySelector(':scope > .subnav'), true);

                const activeSpan = active.querySelector(':scope > span.nextlevel');

                if (activeSpan) activeSpan.textContent = minus;

            });

        }

        link.classList.toggle('show');

    });


    // BlockNav
    body.addEventListener('click', function (event) {

        const link = event.target.closest('.blockNav .navlink');

        if (!link) return;

        const li = link.parentElement;

        resetSiblings(li);

        if (link.classList.contains('show')) {

            resMenu();
            event.preventDefault();

        } else if (
            link.nextElementSibling &&
            li.parentElement.classList.contains('nav')
        ) {

            event.preventDefault();

            document.querySelectorAll('.overlay').forEach(function (overlay) {
                showElement(overlay, true);
            });

            li.classList.add('activated');
            li.dataset.showSub = 'true';

            toggleAria(li.querySelector(':scope > .subnav'), true);

        }

        link.classList.toggle('show');

    });


    /* Untermenüs ******************************************/

    body.addEventListener('click', function (event) {

        const span = event.target.closest(
            '#menu .subnav .navitem > span.nextlevel'
        );

        if (!span) return;

        const li = span.parentElement;
        const subnav = li.querySelector(':scope > .subnav');

        if (!subnav) return;

        const wasOpen = span.textContent === minus;

        // Alle Untermenüs auf dieser Ebene schließen
        const parent = li.parentElement;

        parent.querySelectorAll(':scope > li').forEach(function (sibling) {

            const siblingSubnav = sibling.querySelector(':scope > .subnav');
            const siblingSpan = sibling.querySelector(':scope > span.nextlevel');

            if (siblingSubnav) {
                toggleAria(siblingSubnav, false);
            }

            sibling.classList.remove('activated');
            sibling.dataset.showSub = 'false';

            if (siblingSpan) siblingSpan.textContent = plus;

        });

        // Angeclicktes Untermenü gegebenenfalls öffnen
        if (!wasOpen) {

            span.textContent = minus;

            toggleAria(subnav, true);

            li.classList.add('activated');
            li.dataset.showSub = 'true';

        }

    });


    // Level 2 Links
    body.addEventListener('click', function (event) {

        const link = event.target.closest('#menu .nav__level2 > li > a');

        if (!link) return;

        link.parentElement.parentElement.querySelectorAll(':scope > li > a')
            .forEach(function (sibling) {
                sibling.classList.toggle('show', sibling === link);
            });

    });


    /* Tastatursteuerung: TAB und ESC *********************/

    body.addEventListener('keyup', function (event) {

        const link = event.target.closest('.navlink');

        if (!link) return;

        const item = link.parentElement;
        const nav = link.closest('.nav');

        if (event.key === 'Tab') {

            if (item.classList.contains('lastitem')) {
                resMenu();
            } else {

                // Geschwister zurücksetzen
                Array.from(item.parentElement.children).forEach(function (sibling) {

                    if (sibling === item) return;

                    sibling.classList.remove('activated');
                    sibling.dataset.showSub = 'false';

                    sibling.querySelectorAll('.subnav').forEach(function (subnav) {
                        toggleAria(subnav, false);
                    });

                    sibling.querySelectorAll('li').forEach(function (li) {
                        li.classList.remove('activated');
                    });

                    sibling.querySelectorAll('.box').forEach(function (box) {
                        hideElement(box);
                    });

                    sibling.querySelectorAll('.subnav li > span.nextlevel').forEach(function (span) {
                        span.textContent = plus;
                    });

                });

                // Aktuelles Element aktivieren
                item.classList.add('activated');
                item.dataset.showSub = 'true';

                document.querySelectorAll('.overlay').forEach(function (overlay) {
                    showElement(overlay, true);
                });

                const subnav = item.querySelector(':scope > .subnav');

                if (item.parentElement.classList.contains('nav')) {

                    item.querySelectorAll('.box').forEach(function (box) {
                        showBox(box, true);
                    });
                    toggleAria(subnav, true);
                    item.querySelectorAll('.box .subnav').forEach(function (boxSubnav) {
                        toggleAria(boxSubnav, true);
                    });

                } else {

                    toggleAria(subnav, true);

                    const span = item.querySelector(':scope > span.nextlevel');
                    if (span) span.textContent = minus;
                    item.parentElement.querySelectorAll(':scope > li > span.nextlevel')
                        .forEach(function (otherSpan) {
                            if (otherSpan !== span) otherSpan.textContent = plus;
                        });
                }
            }
        }

        // ESC
        if (event.key === 'Escape' || event.key === 'Esc') {
            resMenu();
        }
    });

    /* Tastatursteuerung: Pfeiltasten ********************/

    body.addEventListener('keydown', function (event) {

        const link = event.target.closest('.navlink');
        if (!link) return;
        const item = link.parentElement;
        const nav = link.closest('.nav');
        const parentItem = link.closest('.navitem');

        if (!nav || !parentItem) return;
        const isTopLevel = item.parentElement.classList.contains('nav');

        function showSubnav(currentItem) {
            currentItem.querySelectorAll('.box').forEach(function (box) {
                showBox(box, true);
            });
            currentItem.querySelectorAll('.subnav').forEach(function (subnav) {
                toggleAria(subnav, true);
            });
        }

        function hideSubnavs(container) {
            container.querySelectorAll('.box').forEach(function (box) {
                hideElement(box);
            });
            container.querySelectorAll('.subnav').forEach(function (subnav) {
                toggleAria(subnav, false);
            });
        }

        function focusLink(element) {
            const target = element?.querySelector(':scope > .navlink');
            if (target) target.focus();
        }


        switch (event.key) {

            case 'ArrowRight': // → Rechts
                if (isTopLevel) {
                    const next = parentItem.nextElementSibling ||
                                 nav.querySelector(':scope > .navitem');
                    if (next) focusLink(next);
                    hideSubnavs(nav);
                } else {
                    const subnav = item.querySelector(':scope > .subnav');
                    if (subnav) {
                        toggleAria(subnav, true);
                        const span = item.querySelector(':scope > span.nextlevel');
                        if (span) span.textContent = minus;
                        focusLink(subnav.querySelector(':scope > .navitem'));
                    }
                }
                event.preventDefault();
                break;

            case 'ArrowLeft': // ← Links

                if (isTopLevel) {
                    const items = Array.from(nav.querySelectorAll(':scope > .navitem'));
                    const index = items.indexOf(parentItem);
                    const previous = items[index - 1] || items[items.length - 1];
                    if (previous) focusLink(previous);
                    hideSubnavs(nav);
                } else {

                    const currentSubnav = link.closest('.subnav');
                    const parentNavItem = currentSubnav?.parentElement;

                    if (parentNavItem) {
                        const box = parentNavItem.querySelector(':scope > .box');
                        if (box) hideElement(box);
                        toggleAria(currentSubnav, false);
                        const span = parentNavItem.querySelector(':scope > span.nextlevel');
                        if (span) span.textContent = plus;
                        const parentLink = parentNavItem.querySelector(':scope > .navlink');
                        if (parentLink) parentLink.focus();
                    }

                }
                event.preventDefault();
                break;

            case 'ArrowDown': // ↓ Pfeil runter

                if (isTopLevel) {
                    showSubnav(item);
                    const subnav = item.querySelector(':scope > .subnav');
                    if (subnav) focusLink(subnav.querySelector(':scope > .navitem'));
                } else {
                    const next = item.nextElementSibling;
                    if (next) {
                        focusLink(next);
                    } else {
                        const parent = item.parentElement?.parentElement?.closest('li');
                        if (parent) focusLink(parent);
                    }
                }

                event.preventDefault();
                break;

            case 'ArrowUp': // ↑ Pfeil hoch
                if (item.closest('.subnav')) {
                    const previous = item.previousElementSibling;
                    if (previous) {
                        focusLink(previous);
                    } else {
                        const parent = item.parentElement?.parentElement?.closest('li');

                        if (parent) focusLink(parent);
                    }
                }
                event.preventDefault();
                break;

        }
    });


    /* Scroll / Responsive *******************************/

    window.addEventListener('scroll', function () {

        menu.querySelectorAll('.subnav').forEach(function (subnav) {
            toggleAria(subnav, false);
        });

        menu.querySelectorAll('li').forEach(function (li) {
            li.dataset.showSub = 'false';
            li.classList.remove('activated');
        });

        menu.querySelectorAll('.subnav span.nextlevel').forEach(function (span) {
            span.textContent = plus;
        });

        document.querySelectorAll('.box, .submenulevel, .overlay')
            .forEach(function (element) {
                hideElement(element, true);
            });

    });


    window.addEventListener('resize', resMenu);
	
	resMenu();

});
