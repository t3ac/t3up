jQuery(document).ready(function($) {

	var 	hh = $('header').height(),
		sh =  hh * 0.66;

		$('main').css('padding-top',hh);

	//On Scroll Functionality
	$(window).scroll( () => {
		var windowTop = $(window).scrollTop();
		windowTop > 100 ? $('header').addClass('shy-aktiv').css('height',sh) : $('header').removeClass('shy-aktiv').css('height',hh);
		// windowTop > 100 ? $('ul').css('top','100px') : $('ul').css('top','160px');
	});

	
});
