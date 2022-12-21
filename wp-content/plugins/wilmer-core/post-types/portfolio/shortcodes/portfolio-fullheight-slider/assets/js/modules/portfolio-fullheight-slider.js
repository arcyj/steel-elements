(function($) {
    'use strict';

    var portfolioFullheightSlider = {};
    mkdf.modules.portfolioFullheightSlider = portfolioFullheightSlider;

    portfolioFullheightSlider.mkdfOnDocumentReady = mkdfOnDocumentReady;
    portfolioFullheightSlider.mkdfOnWindowLoad = mkdfOnWindowLoad;
    portfolioFullheightSlider.mkdfOnWindowScroll = mkdfOnWindowScroll;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load', mkdfOnWindowLoad());
    $(window).scroll(mkdfOnWindowScroll);
    

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {

    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfportfolioFullheightSliderInitMouseWheel();
        mkdfElementorPortfolioFullheightSlider();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function mkdfOnWindowScroll() {

    }

    /**
     * Elementor
     */
    function mkdfElementorPortfolioFullheightSlider(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_portfolio_fullheight_slider.default', function() {
                mkdf.modules.common.mkdfOwlSlider();
                mkdf.modules.common.mkdfPrettyPhoto();
                mkdfportfolioFullheightSliderInitMouseWheel();
            } );
        });
    }

    function mkdfportfolioFullheightSliderInitMouseWheel(){

        var portfolioFullheightSlider = $('.mkdf-portfolio-fullheight-slider-holder');

        if(portfolioFullheightSlider.length && portfolioFullheightSlider.hasClass('mkdf-slide-on-mouse-scroll')){
            portfolioFullheightSlider.each(function(){
                var sliders = $(this).find('.mkdf-owl-slider');

                if (sliders.length) {
                    sliders.each(function() {

                        var slider = $(this);

                        slider.on('mousewheel', '.owl-stage', function (e) {
                            if (!slider.data('mkdf-active')) {
                                var curr = $(this);
                                if (e.deltaY < 0) {
                                    curr.trigger('next.owl');
                                } else {
                                    curr.trigger('prev.owl');
                                }
                                e.preventDefault();
                            }
                        });

                    })
                }
            })
        }
    }

})(jQuery);