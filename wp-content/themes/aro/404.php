<?php
get_header(); ?>
    <div id="primary" class="content">
        <main id="main" class="site-main">
            <div class="error-404 not-found">
                <div class="page-content">
                    <div class="page-header">
                        <div class="img-404"><img src="<?php echo get_theme_file_uri('assets/images/404/404.png') ?>" alt="<?php echo esc_attr__('404 Page', 'aro') ?>"></div>
                        <div class="number-404"><img src="<?php echo get_theme_file_uri('assets/images/404/404_number.png') ?>" alt="<?php echo esc_attr__('404', 'aro') ?>"></div>
                        <h2 class="error-subtitle"><?php esc_html_e('Opps! That Links Is Broken', 'aro'); ?></h2>
                        </header><!-- .page-header -->
                        <div class="error-text">
                            <span><?php esc_html_e('Page does not exist or some other error occured. Go to our Home Page', 'aro') ?></span>
                        </div>
                        <div class="error-button">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="go-back"><?php esc_html_e('Back to Homepage', 'aro'); ?></a>
                        </div>
                    </div><!-- .page-content -->
                </div><!-- .error-404 -->
        </main><!-- #main -->
    </div><!-- #primary -->
<?php
get_footer();



