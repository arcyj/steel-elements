(function($) {
    'use strict';

    var animatedSwitchSlider = {};
    mkdf.modules.animatedSwitchSlider = animatedSwitchSlider;

    animatedSwitchSlider.mkdfAnimatedSwitchSlider = mkdfAnimatedSwitchSlider;
    animatedSwitchSlider.mkdfOnWindowLoad = mkdfOnWindowLoad;

    $(window).on('load', mkdfOnWindowLoad());

    /**
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {
        if ( mkdf.body.hasClass('elementor-page') ) {
            mkdfElementorAnimatedSwitchSlider();
        }
        else {
            mkdfAnimatedSwitchSlider();
        }
    }


    /**
     * Elementor
     */
    function mkdfElementorAnimatedSwitchSlider(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_animated_switch_slider.default', function() {
                mkdfAnimatedSwitchSlider();
            } );
        });
    }
    /**
     * Init animated switch slider shortcode
     */
    function mkdfAnimatedSwitchSlider() {
        var slider = $('#mkdf-animated-switch-slider');

        if (slider.length) {
            var slides = slider.find('.mkdf-switch-slide'),
                bgTexts = slider.find('.mkdf-item-background-text'),
                overlay = slider.find('.mkdf-item-text-left'),
                bgrndImages = slider.find('.mkdf-background-images-holder'),
                paginationHolder = slider.find('.mkdf-animated-switch-slider-pagination'),
                paginationBullet = paginationHolder.find('.mkdf-animated-ss-button'),
                initialized = false;

            var fullscreenCalcs = function() {
                var heightVal = mkdf.windowHeight - slider.offset().top;

                if (mkdf.body.hasClass('mkdf-paspartu-enabled')) {
                    var passepartoutSize = parseInt($('.mkdf-wrapper').css('padding-top'));

                    heightVal -= passepartoutSize;
                }

                slider.css('height', heightVal);
            }

            var prepItems = function() {
                slides.first().addClass('mkdf-active');
                changeImage();
                headerSkin();
            }

            //slideshow logic start
            var startAnimating = function() {
                slider.addClass('mkdf-animating');
                bgTexts.each(function(){
                    $(this).fadeOut();
                })
            }

            var endAnimating = function() {
                slides.filter('.mkdf-active').one(mkdf.animationEnd,function(){
                    var activeSlide = $(this);
                    slider.removeClass('mkdf-animating');
                    bgTexts.each(function(){
                        if($(this).data('index') === activeSlide.data('index')){
                            $(this).fadeIn();
                        }
                    })
                    paginationBullet.removeClass('mkdf-active');
                    paginationBullet.eq(activeSlide.data('index') - 1).addClass('mkdf-active');
                });
            }

            var changeImage = function() {
                bgrndImages.css('z-index', 'auto');
                slides.filter('.mkdf-active').find(bgrndImages).css('z-index', 10);
            }

            var headerSkin = function() {
                if(slider.hasClass('mkdf-enabled-header-skin-change')) {
                    mkdf.body.removeClass('mkdf-light-header mkdf-dark-header');

                    if (slides.filter('.mkdf-active').hasClass('mkdf-light-header')) {
                        mkdf.body.addClass('mkdf-light-header');
                    } else if(slides.filter('.mkdf-active').hasClass('mkdf-dark-header')){
                        mkdf.body.addClass('mkdf-dark-header');
                    }
                }
            }

            var paginationSkin = function() {
                paginationHolder.removeClass('mkdf-light-slin mkdf-dark-skin');

                if (slides.filter('.mkdf-active').find('.mkdf-item-overlay').hasClass('mkdf-dark')) {
                    paginationHolder.addClass('mkdf-dark-skin');
                } else {
                    paginationHolder.addClass('mkdf-light-skin');
                }
            }

            var nextSlide = function() {
                startAnimating();

                if (slides.filter('.mkdf-active').next().index() > 0) {
                    slides.removeClass('mkdf-remove');
                    slides.filter('.mkdf-active')
                        .removeClass('mkdf-active')
                        .addClass('mkdf-remove').next()
                        .addClass('mkdf-active');
                } else {
                    slides.removeClass('mkdf-active mkdf-remove');
                    slides.first().addClass('mkdf-active');
                    slides.last().addClass('mkdf-remove');
                }

                setTimeout( function(){
                    changeImage();
                }, 400);

                headerSkin();
                paginationSkin();
                endAnimating();

                /*overlay.one(mkdf.animationEnd, function(){
                    changeImage();
                    headerSkin();
                    endAnimating();
                });*/
            }

            var prevSlide = function() {
                startAnimating();

                if (slides.filter('.mkdf-active').prev().index() < 0) {
                    slides.removeClass('mkdf-active mkdf-remove');
                    slides.first().addClass('mkdf-remove');
                    slides.last().addClass('mkdf-active');
                } else {
                    slides.removeClass('mkdf-remove');
                    slides.filter('.mkdf-active')
                        .removeClass('mkdf-active')
                        .addClass('mkdf-remove').prev()
                        .addClass('mkdf-active');
                }

                setTimeout( function(){
                    changeImage();
                }, 400);

                headerSkin();
                paginationSkin();
                endAnimating();

                /*overlay.one(mkdf.animationEnd, function(){
                    changeImage();
                    headerSkin();
                    endAnimating();
                });*/
            }

            var goToSlide = function(index){
                startAnimating();

                slides.each(function(){
                    $(this).removeClass('mkdf-remove');
                })
                slides.filter('.mkdf-active').removeClass('mkdf-active').addClass('mkdf-remove');
                slides.eq(index - 1).addClass('mkdf-active');

                setTimeout( function(){
                    changeImage();
                }, 400);

                headerSkin();
                paginationSkin();
                endAnimating();

            }

            var slideshowScroll = function() {
                if (!mkdf.htmlEl.hasClass('touch')) {
                    var delta = 0;

                    slider.mousewheel(function(e) {
                        e.preventDefault();

                        if (!initialized) {
                            initialized = true;
                        }

                        if (!slider.hasClass('mkdf-animating')) {
                            if (e.deltaY < 0) {
                                delta = -1;
                            } else {
                                delta = 1;
                            }

                            if (delta == -1 ) {
                                nextSlide();

                            } else {
                                prevSlide();
                            }
                        }
                    });

                    slider.on('wheel', function() { return false; });
                }
            }

            var touchSlider = function() {
                if (mkdf.htmlEl.hasClass('touch')) {
                    var ts;

                    slider.on('touchstart', function (e){
                        if (!slider.hasClass('mkdf-animating')) {
                           ts = e.originalEvent.touches[0].clientY;
                        }
                    });

                    slider.on('touchend', function (e){
                        if (!slider.hasClass('mkdf-animating')) {
                            var te = e.originalEvent.changedTouches[0].clientY;

                            if (ts > te+5) {
                                prevSlide();
                            } else if (ts < te-5) {
                                nextSlide();
                            }
                        }
                    });
                }
            }

            var slideShowClick = function(){
                if(paginationBullet.length){
                    paginationBullet.each(function(){
                        var thisBullet = $(this);
                        thisBullet.on('click', function(){
                            goToSlide(thisBullet.data('index'));
                        })
                    })
                }
            }
            //slideshow logic end

            //init
            slider.waitForImages(function(){
                fullscreenCalcs();
                prepItems();
                slideshowScroll();
                touchSlider();
                endAnimating();
                slideShowClick();
            });

            $(window).resize(function(){
                fullscreenCalcs();
            });
        }
    }

})(jQuery);
