document.addEventListener('DOMContentLoaded', function () {

    /* To Top ********************************************/

    // Scroll-Event
    window.addEventListener('scroll', function () {

        if (window.scrollY > 65) {
            document.querySelectorAll('.toTop').forEach(function (element) {
                element.classList.add('fixed');
            });
        } else {
            document.querySelectorAll('.toTop').forEach(function (element) {
                element.classList.remove('fixed');
            });
        }

    });

    // Scroll-to-Top
	document.querySelectorAll('.scrollup').forEach(function (element) {

	    element.addEventListener('click', function (event) {
	        event.preventDefault();

	        const startPosition = window.scrollY;
	        const duration = 600;
	        const startTime = performance.now();

	        function scrollAnimation(currentTime) {

	            const elapsed = currentTime - startTime;
	            const progress = Math.min(elapsed / duration, 1);

	            // Ease-In-Out
	            const easing = progress < 0.5
	                ? 2 * progress * progress
	                : 1 - Math.pow(-2 * progress + 2, 2) / 2;

	            window.scrollTo(0, startPosition * (1 - easing));

	            if (progress < 1) {
	                requestAnimationFrame(scrollAnimation);
	            }
	        }

	        requestAnimationFrame(scrollAnimation);

	    });
	});

});