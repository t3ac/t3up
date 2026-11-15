
/*!
 * Vanilla whenInView
 * Based on jQuery whenInView 1.2.5
 * Original: https://github.com/funkhaus/whenInView
 */

(function () {
    'use strict';

    const instances = new WeakMap();

    function whenInView(elements, options, outCb) {

        // Elemente vereinheitlichen
        if (typeof elements === 'string') {
            elements = document.querySelectorAll(elements);
        } else if (elements instanceof Element) {
            elements = [elements];
        }

        elements = Array.from(elements);

        if (!elements.length) return;

        // Vorhandene Instanz entfernen
        const first = elements[0];
        const existing = instances.get(first);

        // Clear
        if (options === 'clear') {
            elements.forEach(element => {
                const instance = instances.get(element);
                if (instance) instance.destroy(outCb);
            });
            return elements;
        }

        let inCallback = null;
        let outCallback = null;

        if (typeof options === 'function') {
            inCallback = options;
            options = {};
        }

        if (typeof outCb === 'function') {
            outCallback = outCb;
        }

        const settings = {
            className: 'element-in-view',
            container: window,
            elementIn: null,
            elementOut: null,
            topOffset: 0,
            bottomOffset: 0,
            staggerInterval: 0,
            removeWhenOut: false,
            RAF: true,
            fireAtStart: true,
            ...options
        };

        settings.elementIn =
            inCallback ||
            settings.elementIn ||
            function () {
                this.classList.add(settings.className);
            };

        settings.elementOut =
            outCallback ||
            settings.elementOut ||
            function () {
                if (settings.removeWhenOut) {
                    this.classList.remove(settings.className);
                }
            };

        const container = settings.container;
        const isWindow = container === window;

        let winHeight = isWindow
            ? window.innerHeight
            : container.clientHeight;

        let sTop = isWindow
            ? window.scrollY
            : container.scrollTop;

        let percentOffsetTop = false;
        let percentOffsetBottom = false;

        function parseOffset(value) {
            if (String(value).includes('%')) {
                return {
                    percent: parseFloat(value) / 100,
                    value: winHeight * (parseFloat(value) / 100)
                };
            }

            return {
                percent: false,
                value: Number(value) || 0
            };
        }

        const topOffset = parseOffset(settings.topOffset);
        const bottomOffset = parseOffset(settings.bottomOffset);

        percentOffsetTop = topOffset.percent;
        percentOffsetBottom = bottomOffset.percent;

        settings.topOffset = topOffset.value;
        settings.bottomOffset = bottomOffset.value;

        // Positionen der Elemente berechnen
        function calculateOffsets() {
            elements.forEach(element => {
                const rect = element.getBoundingClientRect();

                element._whenInViewTop = isWindow
                    ? rect.top + window.scrollY
                    : rect.top - container.getBoundingClientRect().top + container.scrollTop;

                element._whenInViewHeight = rect.height;
            });
        }

        // Sichtbarkeit prüfen
        function checkVisibility() {

            const topTrigger = sTop + settings.topOffset;
            const bottomTrigger = sTop + winHeight - settings.bottomOffset;

            const incoming = elements.filter(element => {
                const top = element._whenInViewTop;
                const height = element._whenInViewHeight;

                return (
                    top + height > topTrigger &&
                    top < bottomTrigger &&
                    !element.inView
                );
            });

            if (incoming.length) {

                incoming.forEach(element => {
                    element.inView = true;
                });

                incoming.forEach((element, index) => {

                    const fire = () => {
                        if (!element.isConnected || !element.inView) return;

                        settings.elementIn.call(element, {
                            target: element,
                            elements: incoming
                        });
                    };

                    if (settings.staggerInterval > 0) {
                        setTimeout(
                            fire,
                            index * settings.staggerInterval
                        );
                    } else {
                        fire();
                    }
                });
            }

            const outgoing = elements.filter(element => {
                const top = element._whenInViewTop;
                const height = element._whenInViewHeight;

                return (
                    element.inView === true &&
                    (
                        top + height < topTrigger ||
                        top > bottomTrigger
                    )
                );
            });

            if (outgoing.length) {

                outgoing.forEach(element => {
                    element.inView = false;
                });

                outgoing.forEach(element => {
                    settings.elementOut.call(element, {
                        target: element,
                        elements: outgoing
                    });
                });
            }
        }

        // Scroll-Position aktualisieren
        function masterScrollListener() {

            sTop = isWindow
                ? window.scrollY
                : container.scrollTop;

            if (settings.RAF) {
                window.requestAnimationFrame(checkVisibility);
            } else {
                checkVisibility();
            }
        }

        // Resize
        function resizeListener() {

            winHeight = isWindow
                ? window.innerHeight
                : container.clientHeight;

            if (percentOffsetTop !== false) {
                settings.topOffset = winHeight * percentOffsetTop;
            }

            if (percentOffsetBottom !== false) {
                settings.bottomOffset = winHeight * percentOffsetBottom;
            }

            calculateOffsets();

            window.requestAnimationFrame(checkVisibility);
        }

        // Manuelle Neuberechnung
        function recalculateListener() {
            calculateOffsets();
            window.requestAnimationFrame(checkVisibility);
        }

        // Listener registrieren
        container.addEventListener('scroll', masterScrollListener);
        window.addEventListener('resize', resizeListener);

        document.addEventListener(
            'recalculate.wheninview',
            recalculateListener
        );

        // Instanz speichern
        const instance = {
            destroy(eventName) {

                container.removeEventListener(
                    'scroll',
                    masterScrollListener
                );

                window.removeEventListener(
                    'resize',
                    resizeListener
                );

                document.removeEventListener(
                    'recalculate.wheninview',
                    recalculateListener
                );

                if (!eventName || eventName === 'enter' || eventName === 'exit') {
                    elements.forEach(element => {
                        delete element.inView;
                        delete element._whenInViewTop;
                        delete element._whenInViewHeight;
                    });

                    instances.delete(first);
                }
            }
        };

        instances.set(first, instance);

        elements.forEach(element => {
            instances.set(element, instance);
        });

        calculateOffsets();

        if (settings.fireAtStart) {
            checkVisibility();
        }

        return elements;
    }

    // Globale Funktion bereitstellen
    window.whenInView = whenInView;

    // Manuelle Neuberechnung
    window.recalculateWhenInView = function () {
        document.dispatchEvent(
            new Event('recalculate.wheninview')
        );
    };

})();
