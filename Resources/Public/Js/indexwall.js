jQuery(function($) {

	var setting = {}, wall;

	var colour = [];

	var func = {

		layout: function() {
			var lwidth = $(window).width();
			wall = new Freewall('.free-wall');

			wall.reset({
				selector: '> div',
        		animate: true,
        		cache: true,
        		// cellW: 292.5, // These are what saved the day!
        		// cellH: 284, // These are what saved the day!
        		cellW: 226, // These are what saved the day!
        		cellH: 226, // These are what saved the day!

            	gutterX: 10, // width spacing between blocks;
           		gutterY: 10, // height spacing between blocks;
           		fixSize: 0,
				onResize: function() {
					wall.refresh();
					wall.fitWidth();
				}
			});
			wall.addCustomEvent('onBlockLoad', function(setting){
                console.log(setting);
            });
            
			wall.fitWidth();

		},

		options: function() {
		},
		finish: function() {
		}
	};

	window.app = {
		config: function(key, data) {
			setting[key] = data;
		},
		setup: function(options) {
			for (var i in options) {
				if (options.hasOwnProperty(i)) {
					func[i](options[i]);
				}
			}
			func['finish']();
		}
	};


});