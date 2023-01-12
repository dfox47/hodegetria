(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/aro-brand.default', ($scope) => {
            var $carousel = $('.aro-carousel', $scope);
            if ($carousel.length > 0) {
                var data = $carousel.data('settings');
                aro_slick_carousel_init($carousel, data);
            }
        });
    });

})(jQuery);
