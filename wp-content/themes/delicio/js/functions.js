/**
* Theme functions file
*/
(function ($) {
    'use strict';

    var $document = $(document);
    var $window = $(window);

    /**
     * Document ready (jQuery)
     */
    $(function () {


        /**
         * Activate Headroom.
         */
        $('.site-header').headroom({
           tolerance: {
               up: 20,
               down: 5
           },
           offset : 100
        });


        /**
         * Activate superfish menu.
         */
        $('.sf-menu').superfish({
            'speed': 'fast',
            'delay' : 0,
            'animation': {
                'height': 'show'
            }
        });



        /**
         * Sidebar Panel
         */
        function setSlideNav(){
            $(".side-panel-btn .navbar-toggle").pageslide({ direction: "left"});

            $(".side-panel-btn .navbar-toggle").on('click', function(e){
                e.preventDefault();
                setTimeout(function(){
                    $window.trigger('resize');
                }, 100);
            });
        }


        setSlideNav();


         /**
          * FitVids - Responsive Videos in posts
          */
         $(".entry-content, .cover").fitVids();



        $('#scroll-to-content').on('click', function () {
            var $slider = $('#slider');

            $('html, body').animate({
                scrollTop: $slider.offset().top + $slider.outerHeight()
            }, 600);
        });

        (function() {
            /**
             * Activate main slider.
             */

            var $slider = $('#slider');
            var $header = $('.site-header');

            var $main_content = $('#content');

            $slider.css('marginTop',$header.outerHeight());


            $main_content.css('marginTop',$header.outerHeight());

            $slider.sllider().responsiveSliderImages();

            var $viewport = $slider.find('.flickity-viewport');
            var $slides = $slider.find('.slide');
            var $elements = $viewport.add($slides);

            var $adminbar = $('#wpadminbar');

            var isHidden = true;
            var size = [ $(window).width(), $(window).height() ];

            function fixSliderSize() {
                var maxElementHeight = 0;
                $elements.css('height', 'auto');

                var computedHeight = 0;

                if (zoomOptions.home_slider_look_height_type == 'auto') {

                    $slides.each(function () {
                        maxElementHeight = Math.max(maxElementHeight, $(this).find('.slide-content').outerHeight());
                    });

                    var availableHeight = $window.height() - $header.outerHeight();

                    if ($adminbar.length) {
                        availableHeight -= $adminbar.outerHeight();
                    }

                    var maxSliderHeight = zoomOptions.home_slider_look_max_height;

                    computedHeight = Math.max(maxElementHeight, Math.min(maxSliderHeight, availableHeight));
                } else {
                    computedHeight = ( ( zoomOptions.home_slider_look_height_value * $window.height() ) / 100 ) - $header.outerHeight();
                }

                $elements.css('height', computedHeight);

                $slider.addClass('zoom-compute-done').removeClass('zoom-compute-pending');
                isHidden = false;


                $header.delicioHeader('update');
            }

            var debouncedFix = _debounce(fixSliderSize, 400);

            $(window).on('resize focus', function() {
                if (size[0] == $(window).width() && size[1] == $(window).height()) {
                    return;
                }

                size = [ $(window).width(), $(window).height() ];

                if (!isHidden) {
                    isHidden = true;
                    $slider.addClass('zoom-compute-pending').removeClass('zoom-compute-done');
                }

                debouncedFix();
            });
            fixSliderSize();
        })();

        // $('.zoom-page-overlay').fadeOut(function(o) {
        //     $(o).remove();
        // });
    });



    $.fn.sllider = function() {
        return this.each(function () {
            var $this = $(this);

            var $slides = $this.find('.slide');

            if ($slides.length <= 1) {
                $slides.addClass('is-selected');

                return;
            }

            new Flickity('.slides', {
                autoPlay: (zoomOptions.home_slider_autoplay == '1' && parseInt(zoomOptions.home_slider_autoplay_interval, 10)),
                contain: true,
                percentPosition: false,
                //prevNextButtons: false,
                pageDots: false,
                arrowShape: {
                  x0: 10,
                  x1: 60, y1: 50,
                  x2: 65, y2: 50,
                  x3: 15
                },
                accessibility: false,
                wrapAround: true,
                setGallerySize: false
            });
        });
    };

    $.fn.responsiveSliderImages = function () {
        $(window).on('resize orientationchange', _debounce(update, 500));

        function update() {
            var windowWidth = $(window).width();

            if (windowWidth <= 680) {
                $('#slider .slides li').each(function () {
                    var bgurl = $(this).css('background-image').match(/^url\(['"]?(.+)["']?\)$/);
                    var smallimg = $(this).data('smallimg');

                    if (bgurl) {
                        bgurl = bgurl[1];
                    }

                    if (bgurl == smallimg) return;

                    $(this).css('background-image', 'url("' + smallimg + '")');
                });
            }

            if (windowWidth > 680) {
                $('#slider .slides li').each(function () {
                    var bgurl = $(this).css('background-image').match(/^url\(['"]?(.+)["']?\)$/);
                    var bigimg = $(this).data('bigimg');

                    if (bgurl) {
                        bgurl = bgurl[1];
                    }

                    if (bgurl == bigimg) return;

                    $(this).css('background-image', 'url("' + bigimg + '")');
                });
            }
        }

        update();
    };




    $.fn.delicioHeader = function(method) {
        return this.each(function() {
            var $this = $(this);
            var instance = $this.data('headroom-instance');
            var $reference = $('.delicio-header-reference');

            var $content = $('#content');

            if (method == 'update') {
                if (instance) {
                    instance.offset = $reference.position().top;

                    $content.css('padding-top', $this.outerHeight());
                }

                return;
            }

            if ($reference.length == 0) {
                $reference = $('<div />')
                    .addClass('delicio-header-reference')
                    .css('visibility', 'hidden')
                    .insertBefore($this);
            }

            instance = new Headroom(this, {
                offset: $reference.position().top
            });

            $this.data('headroom-instance', instance);

            instance.init();

            $content.css('padding-top', $this.outerHeight());
        });
    };

    // Returns a function, that, as long as it continues to be invoked, will not
    // be triggered. The function will be called after it stops being called for
    // N milliseconds. If `immediate` is passed, trigger the function on the
    // leading edge, instead of the trailing.
    var _debounce = function(func, wait, immediate) {
        var timeout, args, context, timestamp, result;

        var later = function() {
            var last = _now() - timestamp;

            if (last < wait && last >= 0) {
                timeout = setTimeout(later, wait - last);
            } else {
                timeout = null;
                if (!immediate) {
                    result = func.apply(context, args);
                    if (!timeout) context = args = null;
                }
            }
        };

        return function() {
            context = this;
            args = arguments;
            timestamp = _now();
            var callNow = immediate && !timeout;
            if (!timeout) timeout = setTimeout(later, wait);
            if (callNow) {
                result = func.apply(context, args);
                context = args = null;
            }

            return result;
        };
    };
    // A (possibly faster) way to get the current timestamp as an integer.
    var _now = Date.now || function() {
        return new Date().getTime();
    };


    // init Isotope
    var $grid = $('.nova-menu-wrapper').isotope({
        layoutMode: 'vertical',
        itemSelector : '.nova-menu-grid-item'
    });
// filter items on button click
    $('.nova-menu-filter').on( 'click', 'li', function() {
        var $this = $(this);
        $this.siblings().removeClass('active');
        $this.addClass('active');
        var filterValue = $(this).attr('data-filter');
        $grid.isotope({ filter: filterValue });
    });
})(jQuery);
