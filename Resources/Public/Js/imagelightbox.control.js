jQuery(document).ready(function($) {
	

/* Lightbox  *****************************************/

	$('.lightboxstyle-a').find('a.lightbox').attr("data-imagelightbox", "a");
	$('.lightboxstyle-b').find('a.lightbox').attr("data-imagelightbox", "b");
	$('.lightboxstyle-c').find('a.lightbox').attr("data-imagelightbox", "c");
	$('.lightboxstyle-d').find('a.lightbox').attr("data-imagelightbox", "d");
	$('.lightboxstyle-e').find('a.lightbox').attr("data-imagelightbox", "e");
	
	$('a[data-imagelightbox="a"]').imageLightbox({
        activity: true,
        overlay: true
    });

  	
	$('a[data-imagelightbox="b"]').imageLightbox({
        overlay: true,
        activity: true,
        button: true,
        quitOnDocClick: false
    });
    
    
	$('a[data-imagelightbox="c"]').imageLightbox({
        navigation: true,
        overlay: true,
        activity: true,
        button: true,
        quitOnDocClick: false
    });
    
	$('a[data-imagelightbox="d"]').imageLightbox({
        arrows: true,
        overlay: true,
        activity: true,
        button: true,
        quitOnDocClick: false
    });
    
	$('a[data-imagelightbox="e"]').imageLightbox({
        arrows: true,
        navigation: true,
        overlay: true,
        activity: true,
        button: true,
        quitOnDocClick: false
    });
    
});
