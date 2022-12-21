(function($) {
    'use strict';

    var testimonialsVertical = {};
    mkdf.modules.mkdfInitTestimonialsVertical = mkdfInitTestimonialsVertical;

    testimonialsVertical.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load', mkdfOnWindowLoad());

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitTestimonialsVertical();
    }

    /**
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfElementorTestimonialsVertical();
    }

    /**
     * Elementor
     */
    function mkdfElementorTestimonialsVertical(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_testimonials.default', function() {
                mkdfInitTestimonialsVertical();
            } );
        });
    }

    /**
     * Initializes testimonials vertical logic
     */

    function mkdfInitTestimonialsVertical() {
        var holders = $('.mkdf-testimonials-holder.mkdf-testimonials-vertical-scroll');

        if(holders.length) {
            holders.each(function(){
                var holder = $(this),
                    swiperInstance = holder.find('.swiper-container'),
                    singleItem = holder.find('.mkdf-testimonial-content'),
                    maxHeight = 0,
                    dataHolder = holder.find('.mkdf-testimonials'),
                    loop = true,
                    delay = 5000,
                    speed = 300,
                    navigation = false,
                    pagination = false;

                var calcHeight = function() {
                    singleItem.each(function(){
                        var ofset = 70;
                        var thisImgHeight = $(this).find('.mkdf-testimonial-image').height();
                        var thisTextHeight = $(this).find('.mkdf-testimonial-text-holder').height();
                        if (thisImgHeight > thisTextHeight) {
                            if(thisImgHeight > maxHeight) {
                                maxHeight = thisImgHeight + ofset;
                            }
                        } else {
                            if(thisTextHeight > maxHeight) {
                                maxHeight = thisTextHeight + ofset;
                            }
                        }
                        if(mkdf.windowWidth <= 768){
                            maxHeight = thisImgHeight + thisTextHeight + ofset;
                        }
                        $('.swiper-container-vertical').css('height', maxHeight, 'important');
                    });

                    return maxHeight;
                }
                
                var wrapperHeight = function () {
                    swiperInstance.css('height', calcHeight());
                }
                wrapperHeight();

                if( typeof(dataHolder.data('enable-loop')) !== 'undefined' && dataHolder.data('enable-loop') !== false ){
                    if(dataHolder.data('enable-loop') === 'no'){
                        loop = false;
                    }
                }

                if( typeof(dataHolder.data('slider-speed')) !== 'undefined' && dataHolder.data('slider-speed') !== false){
                    delay = dataHolder.data('slider-speed');
                }

                if( typeof(dataHolder.data('enable-autoplay')) !== 'undefined' && dataHolder.data('enable-autoplay') !== false){
                    if(dataHolder.data('enable-autoplay') === 'no'){
                        delay = 1000000;
                    }
                }

                if( typeof(dataHolder.data('slider-speed-animation')) !== 'undefined' && dataHolder.data('slider-speed-animation') !== false){
                    speed = dataHolder.data('slider-speed-animation');
                }

                if( dataHolder.data('enable-navigation') === 'yes'){
                    navigation = {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    };
                }
                if( dataHolder.data('enable-pagination') === 'yes'){
                    pagination = {
                        el: '.swiper-pagination',
                        type: 'bullets',
                        clickable: true,
                    };
                }


                var swiperSlider = new Swiper (swiperInstance, {
                    loop: loop,
                    autoplay: {
                        delay: delay,
                    },
                    direction: 'vertical',
                    slidesPerView: 1,
                    speed: speed,
                    pagination: pagination,
                    navigation: navigation,
                    autoHeight: true,
                    // slideToClickedSlide: true,
                    // Responsive breakpoints
                    // breakpoints: {
                    //     // when window width is <= 768px

                    //     768: {
                    //         slidesPerView: 1,
                    //     },
                    // },
                    init: false
                });

                swiperSlider.on('slideChange', function() {
                });

                swiperSlider.on('transitionEnd', function() {
                });


                holder.waitForImages(function() {
                    swiperSlider.init();
                });

                $(window).on('resize', function() {
                });
            });
        }
    }

})(jQuery);