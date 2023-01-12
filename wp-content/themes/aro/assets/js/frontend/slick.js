(function ($) {
    'use strict';
    jQuery('.wpsisac-slick-carousal').each(function (index) {
        if (jQuery(this).hasClass('slick-initialized')) {
            return;
        }
    });
    let carousel_wrap = $('.aro-slick-carousel'),
        carousel = carousel_wrap.find('ul');

    if (carousel.length > 0) {
        let data = carousel_wrap.data('settings'),
            rtl = $('body').hasClass('rtl') ? true : false;
        carousel.slick({
            rtl: rtl,
            dots: data.navigation == 'both' || data.navigation == 'dots' ? true : false,
            arrows: data.navigation == 'both' || data.navigation == 'arrows' ? true : false,
            infinite: parseInt(data.loop) ? parseInt(data.loop) : false,
            slidesToShow: parseInt(data.items) ? parseInt(data.items) : 4,
            autoplay: data.autoplay ? data.autoplay : false,
            autoplaySpeed: parseInt(data.autoplaySpeed) ? parseInt(data.autoplaySpeed) : 8000,
            slidesToScroll: parseInt(data.slidesToScroll) ? parseInt(data.slidesToScroll) : 1,
            lazyLoad: 'ondemand',
            responsive: [
                {
                    breakpoint: parseInt(data.breakpoint_laptop) ? parseInt(data.breakpoint_laptop) : 1366,
                    settings: {
                        slidesToShow: parseInt(data.items_laptop) ? parseInt(data.items_laptop) : 4,
                    }
                },
                {
                    breakpoint: parseInt(data.breakpoint_tablet_extra) ? parseInt(data.breakpoint_tablet_extra) : 1200,
                    settings: {
                        slidesToShow: parseInt(data.items_tablet_extra) ? parseInt(data.items_tablet_extra) : 3,
                    }
                },
                {
                    breakpoint: parseInt(data.breakpoint_tablet) ? parseInt(data.breakpoint_tablet_extra) : 1024,
                    settings: {
                        slidesToShow: parseInt(data.items_tablet) ? parseInt(data.items_tablet_extra) : 3,
                    }
                },
                {
                    breakpoint: parseInt(data.breakpoint_mobile_extra) ? parseInt(data.breakpoint_mobile_extra) : 880,
                    settings: {
                        slidesToShow: parseInt(data.items_mobile_extra) ? parseInt(data.items_mobile_extra) : 2,
                    }
                },
                {
                    breakpoint: parseInt(data.breakpoint_mobile) ? parseInt(data.breakpoint_mobile) : 767,
                    settings: {
                        slidesToShow: parseInt(data.items_mobile) ? parseInt(data.items_mobile) : 1,
                    }
                },
                {
                    breakpoint: 300,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });
    }
})(jQuery);
