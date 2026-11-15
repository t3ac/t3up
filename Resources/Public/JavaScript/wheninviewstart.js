
document.addEventListener('DOMContentLoaded', function () {

    const body = document.body;
    const root = document.documentElement;

    /* When in view **************************************/

	whenInView('.content > div', {
	    className: 'element-in-view',
	    topOffset: '10%',
	    bottomOffset: '10%',
	    staggerInterval: 100,
	    removeWhenOut: true
	});
	
});
