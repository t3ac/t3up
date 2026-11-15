
(function () {
    "use strict";

    class ImageLightbox {

        constructor(links, options = {}) {
            this.links = Array.from(links);

            this.options = {
                id: 'imagelightbox',
                allowedTypes: 'png|jpg|jpeg|gif|webp|avif',
                animationSpeed: 250,
                activity: false,
                arrows: false,
                button: false,
                caption: false,
                enableKeyboard: true,
                fullscreen: false,
                gutter: 10,
                offsetY: 0,
                navigation: false,
                overlay: false,
                preloadNext: true,
                quitOnEnd: false,
                quitOnImgClick: false,
                quitOnDocClick: true,
                quitOnEscKey: true,
                ...options
            };

            this.index = -1;
            this.open = false;
            this.touchStart = 0;

            this.links = this.links.filter(link =>
                new RegExp(`\\.(${this.options.allowedTypes})$`, 'i')
                    .test(link.href.split('?')[0])
            );

            this.links.forEach((link, index) => {
                link.addEventListener('click', event => {
                    event.preventDefault();
                    this.show(index);
                });
            });

            this.createLightbox();
        }

        createLightbox() {

            this.wrapper = document.createElement('div');
            this.wrapper.className = 'imagelightbox-wrapper';
            this.wrapper.setAttribute('role', 'dialog');
            this.wrapper.setAttribute('aria-modal', 'true');
            this.wrapper.setAttribute('aria-label', 'Bildansicht');
            this.wrapper.hidden = true;

            this.overlay = document.createElement('div');
            this.overlay.className = 'imagelightbox-overlay';

            this.loader = document.createElement('div');
            this.loader.className = 'imagelightbox-loading';
            this.loader.innerHTML = '<div></div>';

            this.closeButton = document.createElement('button');
            this.closeButton.type = 'button';
            this.closeButton.className = 'imagelightbox-close';
            this.closeButton.textContent = '×';
            this.closeButton.setAttribute('aria-label', 'Schließen');

            this.image = document.createElement('img');
            this.image.id = this.options.id;
            this.image.className = 'imagelightbox-image';

            this.caption = document.createElement('div');
            this.caption.className = 'imagelightbox-caption';

            this.previousButton = this.createButton(
                'imagelightbox-arrow imagelightbox-arrow-left',
                '‹',
                'Vorheriges Bild'
            );

            this.nextButton = this.createButton(
                'imagelightbox-arrow imagelightbox-arrow-right',
                '›',
                'Nächstes Bild'
            );

            this.navigation = document.createElement('div');
            this.navigation.className = 'imagelightbox-nav';

            this.wrapper.append(
                this.overlay,
                this.loader,
                this.image,
                this.caption,
                this.closeButton,
                this.previousButton,
                this.nextButton,
                this.navigation
            );

            document.body.appendChild(this.wrapper);

            this.closeButton.addEventListener('click', () => this.quit());
            this.previousButton.addEventListener('click', () => this.previous());
            this.nextButton.addEventListener('click', () => this.next());

            this.wrapper.addEventListener('click', event => {
                if (
                    this.options.quitOnDocClick &&
                    event.target === this.wrapper
                ) {
                    this.quit();
                }
            });

            this.image.addEventListener('click', event => {
                if (this.options.quitOnImgClick) {
                    this.quit();
                    return;
                }

                if (event.clientX < window.innerWidth / 2) {
                    this.previous();
                } else {
                    this.next();
                }
            });

            this.image.addEventListener('touchstart', event => {
                this.touchStart = event.touches[0].clientX;
            }, { passive: true });

            this.image.addEventListener('touchend', event => {
                const distance = event.changedTouches[0].clientX - this.touchStart;

                if (Math.abs(distance) > 50) {
                    distance > 0 ? this.previous() : this.next();
                }
            }, { passive: true });

            this.createNavigation();
        }

        createButton(className, text, label) {
            const button = document.createElement('button');
            button.type = 'button';
            button.className = className;
            button.textContent = text;
            button.setAttribute('aria-label', label);
            return button;
        }

        createNavigation() {

            if (!this.options.navigation) return;

            this.links.forEach((link, index) => {

                const button = this.createButton(
                    'imagelightbox-navitem',
                    String(index + 1),
                    `Bild ${index + 1}`
                );

                button.addEventListener('click', () => this.show(index));
                this.navigation.appendChild(button);

            });
        }

        updateNavigation() {
            this.navigation.querySelectorAll('button').forEach((button, index) => {
                button.classList.toggle('active', index === this.index);
            });
        }

        show(index) {

            if (index < 0 || index >= this.links.length) return;

            this.index = index;
            this.open = true;

            this.wrapper.hidden = false;
            this.wrapper.classList.add('active');
            document.body.classList.add('imagelightbox-open');

            this.loader.style.display = this.options.activity ? 'block' : 'none';
            this.previousButton.style.display = this.options.arrows ? 'block' : 'none';
            this.nextButton.style.display = this.options.arrows ? 'block' : 'none';
            this.closeButton.style.display = this.options.button ? 'block' : 'none';
            this.caption.style.display = this.options.caption ? 'block' : 'none';
            this.overlay.style.display = this.options.overlay ? 'block' : 'none';
            this.navigation.style.display = this.options.navigation ? 'flex' : 'none';

            const link = this.links[index];
            const src = link.href;

            this.image.classList.remove('loaded');
            this.loader.style.display = this.options.activity ? 'block' : 'none';

            this.image.onload = () => {

                this.loader.style.display = 'none';
                this.image.classList.add('loaded');

                this.resizeImage();

                if (this.options.caption) {
                    const text = link.dataset.ilb2Caption ||
                        link.querySelector('img')?.alt || '';

                    this.caption.textContent = text;
                }

                this.preload();
            };

            this.image.onerror = () => {
                this.loader.style.display = 'none';
                console.error('Lightbox-Bild konnte nicht geladen werden:', src);
            };

            this.image.src = src;

            this.updateNavigation();

            if (this.options.enableKeyboard) {
                document.addEventListener('keydown', this.keyHandler);
            }
        }

        resizeImage() {

            const width = window.innerWidth;
            const height = window.innerHeight - this.caption.offsetHeight;

            const maxWidth = width * (1 - this.options.gutter / 100);
            const maxHeight = height * (1 - this.options.gutter / 100);

            const ratio = Math.min(
                maxWidth / this.image.naturalWidth,
                maxHeight / this.image.naturalHeight,
                1
            );

            this.image.style.width = `${this.image.naturalWidth * ratio}px`;
            this.image.style.height = `${this.image.naturalHeight * ratio}px`;
            this.image.style.marginTop = `${this.options.offsetY}px`;
        }

        preload() {

            if (!this.options.preloadNext) return;

            const nextIndex = (this.index + 1) % this.links.length;
            const image = new Image();

            image.src = this.links[nextIndex].href;
        }

        next() {

            if (this.index + 1 >= this.links.length) {
                if (this.options.quitOnEnd) {
                    this.quit();
                    return;
                }
                this.show(0);
                return;
            }

            this.show(this.index + 1);
        }

        previous() {

            if (this.index <= 0) {
                if (this.options.quitOnEnd) {
                    this.quit();
                    return;
                }
                this.show(this.links.length - 1);
                return;
            }

            this.show(this.index - 1);
        }

        keyHandler = event => {

            if (!this.open) return;

            if (event.key === 'Escape' && this.options.quitOnEscKey) {
                this.quit();
            }

            if (event.key === 'ArrowLeft') {
                this.previous();
            }

            if (event.key === 'ArrowRight') {
                this.next();
            }
        };

        quit() {

            if (!this.open) return;

            this.open = false;
            this.wrapper.classList.remove('active');
            this.wrapper.hidden = true;

            document.body.classList.remove('imagelightbox-open');
            document.removeEventListener('keydown', this.keyHandler);

            this.image.removeAttribute('src');
            this.index = -1;
        }

        static init(selector, options = {}) {

            const links = typeof selector === 'string'
                ? document.querySelectorAll(selector)
                : selector;

            return new ImageLightbox(links, options);
        }
    }

    window.ImageLightbox = ImageLightbox;

})();
