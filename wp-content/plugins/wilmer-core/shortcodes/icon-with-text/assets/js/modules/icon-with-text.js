(function ($) {
    'use strict';

    var iconWithText = {};
    mkdf.modules.iconWithText = iconWithText;

    iconWithText.mkdfInitIconWithText = mkdfInitIconWithText;


    iconWithText.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load', mkdfOnWindowLoad());
    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitIconWithText().init();
    }

    /**
    All functions to be called on $(window).load() should be in this function
    */
    function mkdfOnWindowLoad() {
        mkdfElementorIconWithText();
    }

    /**
     * Elementor
     */
    function mkdfElementorIconWithText(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_icon_with_text.default', function() {
                mkdf.modules.icon.mkdfIcon().init();
                mkdfInitIconWithText().init();
            } );
        });
    }


    /**
     * Button object that initializes whole button functionality
     * @type {Function}
     */
    var mkdfInitIconWithText = function () {
        //all buttons on the page
        var icons = $('.mkdf-iwt');

        /**
         * Initializes button hover color
         * @param button current button
         */
        var iwtHoverColor = function (icon) {
            if (typeof icon.data('title-hover-color') !== 'undefined') {
                var iconTitle = icon.find('.mkdf-iwt-title a'),
                    originalColor = icon.data('title-color'),
                    hoverColor = icon.data('title-hover-color');

                iconTitle.on('mouseenter', function(){
                    $(this).css('color', hoverColor);
                });

                iconTitle.on('mouseleave', function(){
                    $(this).css('color', originalColor);
                });
            }
        };

        return {
            init: function () {
                if (icons.length) {
                    icons.each(function () {
                        iwtHoverColor($(this));
                    });
                }
            }
        };
    };

})(jQuery);