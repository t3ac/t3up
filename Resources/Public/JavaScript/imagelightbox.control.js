
document.addEventListener('DOMContentLoaded', () => {

    // Lightbox-Gruppen zuweisen
    ['a', 'b', 'c', 'd', 'e'].forEach(style => {

        document.querySelectorAll(`.lightboxstyle-${style} a.lightbox`)
            .forEach(link => {
                link.dataset.imagelightbox = style;
            });

    });

    // Lightbox A
    ImageLightbox.init('a[data-imagelightbox="a"]', {
        activity: true,
        overlay: true
    });

    // Lightbox B
    ImageLightbox.init('a[data-imagelightbox="b"]', {
        overlay: true,
        activity: true,
        button: true,
        quitOnDocClick: false
    });

    // Lightbox C
    ImageLightbox.init('a[data-imagelightbox="c"]', {
        navigation: true,
        overlay: true,
        activity: true,
        button: true,
        quitOnDocClick: false
    });

    // Lightbox D
    ImageLightbox.init('a[data-imagelightbox="d"]', {
        arrows: true,
        overlay: true,
        activity: true,
        button: true,
        quitOnDocClick: false
    });

    // Lightbox E
    ImageLightbox.init('a[data-imagelightbox="e"]', {
        arrows: true,
        navigation: true,
        overlay: true,
        activity: true,
        button: true,
        quitOnDocClick: false
    });

});
