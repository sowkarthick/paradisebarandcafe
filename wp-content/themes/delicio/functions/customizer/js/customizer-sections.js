( function( $ ) {
    $(function($) {
        $('.wpzoom-theme-control-range').each(function () {
            var $input = $(this),
                $slider = $input.parent().find('.wpzoom-theme-range-slider'),
                value = parseFloat($input.val()),
                min = parseFloat($input.attr('min')),
                max = parseFloat($input.attr('max')),
                step = parseFloat($input.attr('step'));

            $slider.slider({
                value: value,
                min: min,
                max: max,
                step: step,
                slide: function (e, ui) {
                    $input.val(ui.value).keyup().trigger('change');
                }
            });
            $input.val($slider.slider('value'));
        });
    });

    /**
     * Controls visibility
     */
    $.each({
        'home-slider-look-height-type': {
            controls: [ 'delicio_home-slider-look-height-value' ],
            callback: function( to ) { return ( 'static' === to ); }
        }
    }, function( settingId, o ) {
        wp.customize( settingId, function( setting ) {
            $.each( o.controls, function( i, controlId ) {
                wp.customize.control( controlId, function( control ) {
                    var visibility = function( to ) {
                        control.container.toggle( o.callback( to ) );
                    };

                    visibility( setting.get() );
                    setting.bind( visibility );
                });
            });
        });
    });
})(jQuery);
