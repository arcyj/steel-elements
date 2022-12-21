(function($) {
    'use strict';

    var splitSection = {};
    mkdf.modules.splitSection = splitSection;

    splitSection.mkdfInitSSAppearFX = mkdfInitSSAppearFX;

    splitSection.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load', mkdfOnWindowLoad());

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitSSAppearFX();
    }

    /**
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfElementorSSAppearFX();
    }

    /**
     * Elementor
     */
    function mkdfElementorSSAppearFX(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_split_section.default', function() {
                mkdfInitSSAppearFX();
                mkdf.modules.common.mkdfAppearingSection();
            } );
        });
    }


    function mkdfInitSSAppearFX() {
        var splitSection = $('.mkdf-ss-holder');

        if(splitSection.length){
            splitSection.each(function () {
                var thisSplitSection = $(this),
                    backgroundColorHolder = thisSplitSection.find('.mkdf-ss-background-holder'),
                    contentHolder = thisSplitSection.find('.mkdf-ss-content');

                thisSplitSection.appear(function() {
                    thisSplitSection.addClass('mkdf-appeared');
                    backgroundColorHolder.addClass('mkdf-appeared');
                    contentHolder.addClass('mkdf-appeared');
                },{accX: 0, accY:-400});
            })
        }
    }

})(jQuery);