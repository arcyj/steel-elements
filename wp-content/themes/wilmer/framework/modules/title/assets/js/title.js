(function($) {
    "use strict";

    var title = {};
    mkdf.modules.title = title;

    title.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdfOnDocumentReady() {
	    mkdfParallaxTitle();
	    mkdfBackgroundTextResponsive();
    }

    /*
     **	Title image with parallax effect
     */
	function mkdfParallaxTitle() {
		var parallaxBackground = $('.mkdf-title-holder.mkdf-bg-parallax');
		
		if (parallaxBackground.length > 0 && mkdf.windowWidth > 1024) {
			var parallaxBackgroundWithZoomOut = parallaxBackground.hasClass('mkdf-bg-parallax-zoom-out'),
				titleHeight = parseInt(parallaxBackground.data('height')),
				imageWidth = parseInt(parallaxBackground.data('background-width')),
				parallaxRate = titleHeight / 10000 * 7,
				parallaxYPos = -(mkdf.scroll * parallaxRate),
				adminBarHeight = mkdfGlobalVars.vars.mkdfAddForAdminBar;
			
			parallaxBackground.css({'background-position': 'center ' + (parallaxYPos + adminBarHeight) + 'px'});
			
			if (parallaxBackgroundWithZoomOut) {
				parallaxBackground.css({'background-size': imageWidth - mkdf.scroll + 'px auto'});
			}
			
			//set position of background on window scroll
			$(window).scroll(function () {
				parallaxYPos = -(mkdf.scroll * parallaxRate);
				parallaxBackground.css({'background-position': 'center ' + (parallaxYPos + adminBarHeight) + 'px'});
				
				if (parallaxBackgroundWithZoomOut) {
					parallaxBackground.css({'background-size': imageWidth - mkdf.scroll + 'px auto'});
				}
			});
		}
	}

	function mkdfBackgroundTextResponsive(){

		var titleBgTextHolder = $('.mkdf-title-background-text');

		if(titleBgTextHolder.length){
			titleBgTextHolder.each(function(){
				var thisTitleBackgroundText = $(this),
					thisTitle = thisTitleBackgroundText.find('.mkdf-title-background-text-holder-inner');

				if( typeof(thisTitleBackgroundText.data('padding-left-1440')) !== 'undefined' && thisTitleBackgroundText.data('padding-left-1440') !== false){
					var padding1440 = thisTitleBackgroundText.data('padding-left-1440');

					if(mkdf.windowWidth <= 1440 ){
						thisTitle.css('padding-left', padding1440);
                    }
				}
			})
		}

	}

})(jQuery);
