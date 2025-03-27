jQuery(document).ready(function($) {

	var 	hh = $('header').height(),
		sh =  hh * 0.66;

	//On Scroll Functionality
	$(window).scroll( () => {
		var windowTop = $(window).scrollTop();
		windowTop > 100 ? $('header').addClass('shy-aktiv').css('min-height',sh) : $('header').removeClass('shy-aktiv').css('min-height',hh);
	});

	
});