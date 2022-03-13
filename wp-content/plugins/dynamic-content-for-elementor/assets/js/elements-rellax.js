(function ($) {
    var isRellax = false;
    var currentDevice = '';

    var WidgetElements_RellaxHandler = function (panel, model, view) {
        var $scope = view.$el;
        var scene = $scope.find('#scene');

    };

    var WidgetElements_RellaxHandlerFront = function ($scope, $) {
        var elementSettings = get_Dyncontel_ElementSettings($scope);

        var rellax = null;

        $(window).on('resize', function () {

            if (rellax) {
                rellax.destroy();
                if (rellax)
                    initRellax();
            }

        });
        var initRellax = function () {
            if (elementSettings.enabled_rellax) {

                currentDevice = elementorFrontend.getCurrentDeviceMode();

                var setting_speed = 'speed_rellax';
                var value_speed = 0;

                if (currentDevice != 'desktop') {
                    setting_speed = 'speed_rellax_' + currentDevice;
                }
                if (eval('elementSettings.' + setting_speed + '.size'))
                    value_speed = eval('elementSettings.' + setting_speed + '.size');


                var rellaxId = '#rellax-' + $scope.data('id');

                if( $(rellaxId).length ) {
                rellax = new Rellax(rellaxId, { speed: value_speed, } );
              }
                isRellax = true;
            }
        };
        initRellax();

    };

    $(window).on('elementor/frontend/init', function () {

        elementorFrontend.hooks.addAction('frontend/element_ready/global', WidgetElements_RellaxHandlerFront);
    });
})(jQuery);
