<header id="masthead" class="site-header header-1" role="banner">
    <div class="header-container">
        <div class="container header-main">
            <div class="header-left">
                <?php
                aro_site_branding();
                if (aro_is_woocommerce_activated()) {
                    ?>
                    <div class="site-header-cart header-cart-mobile">
                        <?php aro_cart_link(); ?>
                    </div>
                    <?php
                }
                ?>
                <?php aro_mobile_nav_button(); ?>
            </div>
            <div class="header-center">
                <?php aro_primary_navigation(); ?>
            </div>
            <div class="header-right desktop-hide-down">
                <div class="header-group-action">
                    <?php
                    aro_header_account();
                    if (aro_is_woocommerce_activated()) {
                        aro_header_wishlist();
                        aro_header_cart();
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</header><!-- #masthead -->
