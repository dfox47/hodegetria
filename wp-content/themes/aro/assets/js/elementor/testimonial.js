(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/aro-testimonials.default', ($scope) => {
            let $carousel = $('.aro-carousel', $scope);
            if ($carousel.length > 0) {
                let data = $carousel.data('settings');
                aro_slick_carousel_init($carousel, data);
            }
        });
    });

})(jQuery);
