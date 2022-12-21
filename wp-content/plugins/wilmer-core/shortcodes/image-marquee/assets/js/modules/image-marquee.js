(function($) {
    'use strict';
    
    var imageMarquee = {};
    mkdf.modules.imageMarquee = imageMarquee;
    
    imageMarquee.mkdfImageMarquee = mkdfImageMarquee;
    
    imageMarquee.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load', mkdfOnWindowLoad());

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfImageMarquee();
    }

    /**
	 All functions to be called on $(window).load() should be in this function
	*/
    function mkdfOnWindowLoad() {
        mkdfElementorImageMarquee();
    }

    /**
     * Elementor
     */
    function mkdfElementorImageMarquee(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_image_marquee.default', function() {
                mkdfImageMarquee();
            } );
        });
    }

    /**
     * Init Image Marquee Shortcode
     */
    function mkdfImageMarquee() {
        var imageMarqueeShortcodes = $('.mkdf-image-marquee');

        if (imageMarqueeShortcodes.length) {
            imageMarqueeShortcodes.each(function(){
                var imageMarqueeShortcode = $(this),
                    marqueeElements = imageMarqueeShortcode.find('.mkdf-image'),
                    originalItem = marqueeElements.filter('.mkdf-original'),
                    auxItem = marqueeElements.filter('.mkdf-aux');

                var marqueeEffect = function () {
                	var delta = 1, //pixel movement
                	    speedCoeff = 0.5, // below 1 to slow down, above 1 to speed up
                	    currentPos,
                	    marqueeWidth,
                	    resizing = false;

                	var marqueeReset = function() {
                	    marqueeWidth = originalItem.width();
                	    currentPos = 0; 
                	    originalItem.css({
                	        'left': 0
                	    });
                	    auxItem.css({
                	        'width': marqueeWidth, //same width as the original marquee element
                	        'left': marqueeWidth //set to the right of the original marquee element
                	    });
                	}

               		marqueeReset();
	                mkdfRequestAnimationFrame();

                    //movement loop
                    marqueeElements.each(function(i){
                        var marqueeElement = $(this);

                        //movement loop
                        var mkdfMarqueeSequence = function() {
                            currentPos -= delta;

                            //reset marquee element
                            if (marqueeElement.position().left <= -marqueeWidth) {
                                marqueeElement.css('left', parseInt(marqueeWidth - delta));
                                currentPos = 0;
                            }

                            //move marquee element
                            if (!resizing) {
                            	marqueeElement.css({
                            	    'transform': 'translate3d('+speedCoeff*currentPos+'px,0,0)'
                            	});
                            }

                            //fix overlap issue if occurs
                            if (Math.abs(originalItem.position().left - auxItem.position().left) < marqueeWidth - 1) {
                                marqueeReset();
                            }
                        
                            //repeat
                            requestNextAnimationFrame(mkdfMarqueeSequence);
                        }; 
                            
                        mkdfMarqueeSequence();
                    });

                    var intialOrientation = mkdf.windowHeight > mkdf.windowWidth ? 'portrait' : 'landscape';
	                //reset marquee on resize end
	                $(window).resize(function(){
                        var newOrientation = mkdf.windowHeight > mkdf.windowWidth ? 'portrait' : 'landscape';

                        //check if resize is real resize on touch devices since on mobile scrolling will trigger resize when sticky address bar appears/hides
						if( newOrientation !== intialOrientation && mkdf.html.hasClass('touch')) {
                            if (!resizing) {
                                resizing = true;
                                imageMarqueeShortcode.stop().animate({opacity: 0}, 200, function () {
                                    marqueeReset();
                                    resizing = false;
                                    imageMarqueeShortcode.delay(200).animate({opacity: 1}, 200);
                                });
                            }
                        }
	                });
                };

            	//init
                imageMarqueeShortcode.waitForImages(function(){
	                marqueeEffect();
	            });
            });
        }
    }
    
    /*
     * Request Animation Frame shim
     */
	function mkdfRequestAnimationFrame() {
		window.requestNextAnimationFrame =
			(function () {
				var originalWebkitRequestAnimationFrame = undefined,
					wrapper = undefined,
					callback = undefined,
					geckoVersion = 0,
					userAgent = navigator.userAgent,
					index = 0,
					self = this;
				
				// Workaround for Chrome 10 bug where Chrome
				// does not pass the time to the animation function
				
				if (window.webkitRequestAnimationFrame) {
					// Define the wrapper
					
					wrapper = function (time) {
						if (time === undefined) {
							time = +new Date();
						}
						
						self.callback(time);
					};
					
					// Make the switch
					
					originalWebkitRequestAnimationFrame = window.webkitRequestAnimationFrame;
					
					window.webkitRequestAnimationFrame = function (callback, element) {
						self.callback = callback;
						
						// Browser calls the wrapper and wrapper calls the callback
						
						originalWebkitRequestAnimationFrame(wrapper, element);
					};
				}
				
				// Workaround for Gecko 2.0, which has a bug in
				// mozRequestAnimationFrame() that restricts animations
				// to 30-40 fps.
				
				if (window.mozRequestAnimationFrame) {
					// Check the Gecko version. Gecko is used by browsers
					// other than Firefox. Gecko 2.0 corresponds to
					// Firefox 4.0.
					
					index = userAgent.indexOf('rv:');
					
					if (userAgent.indexOf('Gecko') != -1) {
						geckoVersion = userAgent.substr(index + 3, 3);
						
						if (geckoVersion === '2.0') {
							// Forces the return statement to fall through
							// to the setTimeout() function.
							
							window.mozRequestAnimationFrame = undefined;
						}
					}
				}
				
				return window.requestAnimationFrame   ||
					window.webkitRequestAnimationFrame ||
					window.mozRequestAnimationFrame    ||
					window.oRequestAnimationFrame      ||
					window.msRequestAnimationFrame     ||
					
					function (callback, element) {
						var start,
							finish;
						
						window.setTimeout( function () {
							start = +new Date();
							callback(start);
							finish = +new Date();
							
							self.timeout = 1000 / 60 - (finish - start);
							
						}, self.timeout);
					};
				}
			)();
	}

})(jQuery);