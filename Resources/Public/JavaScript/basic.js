
document.addEventListener('DOMContentLoaded', function () {

    const body = document.body;
    const root = document.documentElement;

    const container = document.querySelector('.container');
    const containerWidth = container
        ? parseInt(getComputedStyle(container).maxWidth)
        : 0;

    /* Hilfsfunktionen ************************************/

    // Smooth Scroll
    let scrollFrame;

    function smoothScrollTo(target, duration = 900) {

        cancelAnimationFrame(scrollFrame);

        const startPosition = window.scrollY;
        const distance = target - startPosition;
        const startTime = performance.now();

        function animate(currentTime) {

            const progress = Math.min((currentTime - startTime) / duration, 1);

            // jQuery Swing Easing
            const easing = 0.5 - Math.cos(progress * Math.PI) / 2;

            window.scrollTo(0, startPosition + distance * easing);

            if (progress < 1) {
                scrollFrame = requestAnimationFrame(animate);
            }
        }
        scrollFrame = requestAnimationFrame(animate);
    }

    // Fade In / Fade Out
    function fadeElement(element, show) {
        if (show) {
            element.style.display = '';
            if (getComputedStyle(element).display === 'none') {
                element.style.display = 'block';
            }
            element.animate(
                [{ opacity: 0 }, { opacity: 1 }],
                { duration: 300, fill: 'forwards' }
            );
        } else {
            const animation = element.animate(
                [{ opacity: getComputedStyle(element).opacity }, { opacity: 0 }],
                { duration: 300, fill: 'forwards' }
            );
            animation.onfinish = function () {
                element.style.display = 'none';
                element.style.opacity = '';
            };
        }
    }


    // Slide Toggle
    function slideToggle(element) {

        const isHidden = getComputedStyle(element).display === 'none';

        if (isHidden) {

            element.style.display = '';

            if (getComputedStyle(element).display === 'none') {
                element.style.display = 'block';
            }

            const height = element.scrollHeight;

            element.animate(
                [{ height: '0px', opacity: 0 },
                 { height: height + 'px', opacity: 1 }],
                { duration: 400, fill: 'forwards' }
            ).onfinish = function () {
                element.style.height = '';
                element.style.opacity = '';
                element.style.overflow = '';
            };

        } else {

            const height = element.offsetHeight;

            element.animate(
                [{ height: height + 'px', opacity: 1 },
                 { height: '0px', opacity: 0 }],
                { duration: 400, fill: 'forwards' }
            ).onfinish = function () {
                element.style.display = 'none';
                element.style.height = '';
                element.style.opacity = '';
                element.style.overflow = '';
            };
        }
    }

    /* Smooth Sideanker ***********************************/
	
    document.querySelectorAll('a[href*="#"].smooth').forEach(function (link) {
        link.addEventListener('click', function (event) {
            const url = new URL(this.href, window.location.href);

            // Nur interne Sprungziele
            if (url.pathname !== location.pathname ||
                url.search !== location.search ||
                !url.hash) {
                return;
            }

            const target = document.getElementById(
                decodeURIComponent(url.hash.substring(1))
            );

            if (!target) return;

            event.preventDefault();

            const position = target.getBoundingClientRect().top
                           + window.scrollY - 100;

            smoothScrollTo(position, 900);
            // Hash setzen, ohne einen zusätzlichen Sprung auszulösen
            history.pushState(null, '', url.hash);
        });
    });

    /* Sideanker ******************************************/

    body.addEventListener('click', function (event) {
        // Burger
        const burger = event.target.closest('.main-nav__burger');
        if (burger) {
            burger.classList.toggle('act');
            burger.parentElement.querySelectorAll(':scope > *').forEach(function (element) {
                if (element !== burger) {
                    element.classList.toggle('act');
                }
            });

            document.querySelectorAll('.overlay').forEach(function (overlay) {
                const visible = getComputedStyle(overlay).display !== 'none';
                fadeElement(overlay, !visible);
            });
            return;
        }

        // Sideanker Links
        const sideLink = event.target.closest('#sideanker a');
        if (sideLink) {

            const activeParent = sideLink.closest('div.act');

            document.querySelectorAll('#sideanker *').forEach(function (element) {
                element.classList.remove('act');
            });

            if (activeParent) {
                document.querySelectorAll('.overlay').forEach(function (overlay) {
                    fadeElement(overlay, false);
                });
            }
            return;
        }

        // Breadcrumb ohne Navigation
        if (event.target.closest(
            '.breadcrumbrow .nonav1 > a, .breadcrumbrow a.nonav1'
        )) {
            event.preventDefault();
            return;
        }

        // Breadcrumb erweitern
        const extend = event.target.closest('.breadcrumbrow a.extend');

        if (extend) {
            const parent = extend.parentElement;
            parent.parentElement.querySelectorAll(':scope > *').forEach(function (element) {
                if (element !== parent) {
                    element.classList.remove('act');
                }
            });
            parent.classList.toggle('act');
        }

    });


    /* Fontsize *******************************************/

    const sizeInput = document.querySelector('#size');

    if (sizeInput && containerWidth) {
        sizeInput.addEventListener('change', function () {
            const wert = parseInt(this.value) / 10;

            root.setAttribute('font-size', wert);
            root.style.fontSize = wert + 'rem';

            localStorage.setItem('font-size', wert);
            container.style.maxWidth = (wert * containerWidth) + 'px';

        });

    }

    document.querySelectorAll('.fsrange').forEach(function (button) {
        button.addEventListener('click', function () {
            root.style.fontSize = '1rem';

            if (container && containerWidth) {
                container.style.maxWidth = containerWidth + 'px';
            }

            const input = document.querySelector('.fsrange input');
            if (input) input.value = '10';
            root.setAttribute('font-size', '');
            localStorage.setItem('font-size', '');
        });
    });


    /* Color-mode switcher *******************************/

    document.querySelectorAll('.color-mode__btn').forEach(function (button) {
        button.addEventListener('click', function () {

            if (this.classList.contains('dark')) {
                root.setAttribute('color-mode', 'dark');
                localStorage.setItem('color-mode', 'dark');

            } else if (this.classList.contains('light')) {
                root.setAttribute('color-mode', 'contrast');
                localStorage.setItem('color-mode', 'contrast');

            } else if (this.classList.contains('system')) {
                root.setAttribute('color-mode', 'system');
                localStorage.setItem('color-mode', '');

                if (typeof checkDarkMode === 'function') {
                    checkDarkMode();
                }
            }
        });
    });


    /* Service Area ****************************************/

    document.querySelectorAll('#service_nav > li > a').forEach(function (link) {
        link.addEventListener('click', function () {
            const parent = this.parentElement;
            parent.parentElement.querySelectorAll(':scope > li').forEach(function (item) {
                if (item !== parent) {
                    item.querySelectorAll('.tab-pane').forEach(function (pane) {
                        pane.classList.remove('active', 'show');
                    });
                }
            });

            parent.querySelectorAll('.tab-pane').forEach(function (pane) {
                pane.classList.toggle('active');
                pane.classList.toggle('show');
            });
        });
    });


    body.addEventListener('click', function (event) {
        const close = event.target.closest('.btn-close');
        if (close) {
            close.parentElement.classList.remove('active', 'show');
        }
    });


    window.addEventListener('scroll', function () {
        document.querySelectorAll('.tab-pane').forEach(function (pane) {
            pane.classList.remove('active', 'show');
        });
    });


    /* Footer *********************************************/

    if (window.innerWidth < 576) {
        document.querySelectorAll('.trigger').forEach(function (trigger) {
            trigger.addEventListener('click', function () {
                const content = this.nextElementSibling;
                if (!content) return;
                slideToggle(content);
                this.classList.toggle('active');

                const expanded = this.getAttribute('aria-expanded') === 'true';
                this.setAttribute('aria-expanded', expanded ? 'false' : 'true');

            });

        });

    }
		
    /* Section Index **************************************/

    document.querySelectorAll('.sectionIndex').forEach(function (element, index) {
        element.classList.add('n' + (index + 1));
    });

});
