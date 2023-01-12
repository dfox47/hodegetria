<?php


if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Aro_Elementor')) :

    /**
     * The Aro Elementor Integration class
     */
    class Aro_Elementor {
        private $suffix = '';

        public function __construct() {
            $this->suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';

            add_action('wp', [$this, 'register_auto_scripts_frontend']);
            add_action('elementor/init', array($this, 'add_category'));
            add_action('wp_enqueue_scripts', [$this, 'add_scripts'], 15);
            add_action('elementor/widgets/widgets_registered', array($this, 'include_widgets'));
            add_action('elementor/frontend/after_enqueue_scripts', [$this, 'add_js']);

            // Custom Animation Scroll
            add_filter('elementor/controls/animations/additional_animations', [$this, 'add_animations_scroll']);

            // Elementor Fix Noitice WooCommerce
            add_action('elementor/editor/before_enqueue_scripts', array($this, 'woocommerce_fix_notice'));

            // Backend
            add_action('elementor/editor/after_enqueue_styles', [$this, 'add_style_editor'], 99);

            // Add Icon Custom
            add_action('elementor/icons_manager/native', [$this, 'add_icons_native']);
            add_action('elementor/controls/controls_registered', [$this, 'add_icons']);

            // Add Breakpoints
            add_action('wp_enqueue_scripts', 'aro_elementor_breakpoints', 9999);

            if (!aro_is_elementor_pro_activated()) {
                require trailingslashit(get_template_directory()) . 'inc/elementor/class-custom-css.php';
                require trailingslashit(get_template_directory()) . 'inc/elementor/class-section-sticky.php';
                if (is_admin()) {
                    add_action('manage_elementor_library_posts_columns', [$this, 'admin_columns_headers']);
                    add_action('manage_elementor_library_posts_custom_column', [$this, 'admin_columns_content'], 10, 2);
                }
            }

            add_filter('elementor/fonts/additional_fonts', [$this, 'additional_fonts']);

        }

        public function additional_fonts($fonts) {
            $fonts["Outfit"] = 'googlefonts';
            return $fonts;
        }

        public function admin_columns_headers($defaults) {
            $defaults['shortcode'] = esc_html__('Shortcode', 'aro');

            return $defaults;
        }

        public function admin_columns_content($column_name, $post_id) {
            if ('shortcode' === $column_name) {
                ob_start();
                ?>
                <input class="elementor-shortcode-input" type="text" readonly onfocus="this.select()" value="[hfe_template id='<?php echo esc_attr($post_id); ?>']"/>
                <?php
                ob_get_contents();
            }
        }

        public function add_js() {
            global $aro_version;
            wp_enqueue_script('aro-elementor-frontend', get_theme_file_uri('/assets/js/elementor-frontend.js'), [], $aro_version);
        }

        public function add_style_editor() {
            global $aro_version;
            wp_enqueue_style('aro-elementor-editor-icon', get_theme_file_uri('/assets/css/admin/elementor/icons.css'), [], $aro_version);
        }

        public function add_scripts() {
            global $aro_version;
            $suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';
            wp_enqueue_style('aro-elementor', get_template_directory_uri() . '/assets/css/base/elementor.css', '', $aro_version);
            wp_style_add_data('aro-elementor', 'rtl', 'replace');

            // Add Scripts
            wp_register_script('tweenmax', get_theme_file_uri('/assets/js/libs/TweenMax.min.js'), array('jquery'), '1.11.1');

            if (aro_elementor_check_type('animated-bg-parallax')) {
                wp_enqueue_script('tweenmax');
                wp_enqueue_script('jquery-panr', get_theme_file_uri('/assets/js/libs/jquery-panr' . $suffix . '.js'), array('jquery'), '0.0.1');
            }
        }

        public function register_auto_scripts_frontend() {
            global $aro_version;
            wp_register_script('aro-elementor-brand', get_theme_file_uri('/assets/js/elementor/brand.js'), array('jquery','elementor-frontend'), $aro_version, true);
            wp_register_script('aro-elementor-countdown', get_theme_file_uri('/assets/js/elementor/countdown.js'), array('jquery','elementor-frontend'), $aro_version, true);
            wp_register_script('aro-elementor-image-carousel', get_theme_file_uri('/assets/js/elementor/image-carousel.js'), array('jquery','elementor-frontend'), $aro_version, true);
            wp_register_script('aro-elementor-image-gallery', get_theme_file_uri('/assets/js/elementor/image-gallery.js'), array('jquery','elementor-frontend'), $aro_version, true);
            wp_register_script('aro-elementor-image-hotspots', get_theme_file_uri('/assets/js/elementor/image-hotspots.js'), array('jquery','elementor-frontend'), $aro_version, true);
            wp_register_script('aro-elementor-link-showcase', get_theme_file_uri('/assets/js/elementor/link-showcase.js'), array('jquery','elementor-frontend'), $aro_version, true);
            wp_register_script('aro-elementor-posts-grid', get_theme_file_uri('/assets/js/elementor/posts-grid.js'), array('jquery','elementor-frontend'), $aro_version, true);
            wp_register_script('aro-elementor-product-categories', get_theme_file_uri('/assets/js/elementor/product-categories.js'), array('jquery','elementor-frontend'), $aro_version, true);
            wp_register_script('aro-elementor-product-tab', get_theme_file_uri('/assets/js/elementor/product-tab.js'), array('jquery','elementor-frontend'), $aro_version, true);
            wp_register_script('aro-elementor-products', get_theme_file_uri('/assets/js/elementor/products.js'), array('jquery','elementor-frontend'), $aro_version, true);
            wp_register_script('aro-elementor-tabs', get_theme_file_uri('/assets/js/elementor/tabs.js'), array('jquery','elementor-frontend'), $aro_version, true);
            wp_register_script('aro-elementor-testimonial', get_theme_file_uri('/assets/js/elementor/testimonial.js'), array('jquery','elementor-frontend'), $aro_version, true);
            wp_register_script('aro-elementor-video', get_theme_file_uri('/assets/js/elementor/video.js'), array('jquery','elementor-frontend'), $aro_version, true);
           
        }

        public function add_category() {
            Elementor\Plugin::instance()->elements_manager->add_category(
                'aro-addons',
                array(
                    'title' => esc_html__('Aro Addons', 'aro'),
                    'icon'  => 'fa fa-plug',
                ), 1);
        }

        public function add_animations_scroll($animations) {
            $animations['Aro Animation'] = [
                'opal-move-up'    => 'Move Up',
                'opal-move-down'  => 'Move Down',
                'opal-move-left'  => 'Move Left',
                'opal-move-right' => 'Move Right',
                'opal-flip'       => 'Flip',
                'opal-helix'      => 'Helix',
                'opal-scale-up'   => 'Scale',
                'opal-am-popup'   => 'Popup',
            ];

            return $animations;
        }

        /**
         * @param $widgets_manager Elementor\Widgets_Manager
         */
        public function include_widgets($widgets_manager) {
            require 'base_widgets.php';

            $files_custom = glob(get_theme_file_path('/inc/elementor/custom-widgets/*.php'));
            foreach ($files_custom as $file) {
                if (file_exists($file)) {
                    require_once $file;
                }
            }

            $files = glob(get_theme_file_path('/inc/elementor/widgets/*.php'));
            foreach ($files as $file) {
                if (file_exists($file)) {
                    require_once $file;
                }
            }
        }

        public function woocommerce_fix_notice() {
            if (aro_is_woocommerce_activated()) {
                remove_action('woocommerce_cart_is_empty', 'woocommerce_output_all_notices', 5);
                remove_action('woocommerce_shortcode_before_product_cat_loop', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_single_product', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_cart', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_account_content', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_customer_login_form', 'woocommerce_output_all_notices', 10);
            }
        }

        public function add_icons( $manager ) {
            $new_icons = json_decode( '{"aro-icon-account":"account","aro-icon-alarm":"alarm","aro-icon-amazing-value":"amazing-value","aro-icon-angle-down":"angle-down","aro-icon-angle-left":"angle-left","aro-icon-angle-right":"angle-right","aro-icon-angle-up":"angle-up","aro-icon-arrow_s":"arrow_s","aro-icon-arrow-right1":"arrow-right1","aro-icon-boxed":"boxed","aro-icon-breadcrumb":"breadcrumb","aro-icon-calendar-alt":"calendar-alt","aro-icon-check-o":"check-o","aro-icon-check-square-solid":"check-square-solid","aro-icon-clock":"clock","aro-icon-close-circle-line":"close-circle-line","aro-icon-coolicon":"coolicon","aro-icon-cricle1":"cricle1","aro-icon-day-delivery":"day-delivery","aro-icon-delivery":"delivery","aro-icon-diamond-icon":"diamond-icon","aro-icon-directly":"directly","aro-icon-expert":"expert","aro-icon-facebook-o":"facebook-o","aro-icon-featured":"featured","aro-icon-filter-ul":"filter-ul","aro-icon-filters":"filters","aro-icon-flower":"flower","aro-icon-gift--icon":"gift--icon","aro-icon-help-center":"help-center","aro-icon-home-1":"home-1","aro-icon-hurry":"hurry","aro-icon-increase":"increase","aro-icon-instagram-o":"instagram-o","aro-icon-left-arrow":"left-arrow","aro-icon-linkedin-in":"linkedin-in","aro-icon-list-ul":"list-ul","aro-icon-long-arrow-down":"long-arrow-down","aro-icon-long-arrow-right":"long-arrow-right","aro-icon-long-arrow-up":"long-arrow-up","aro-icon-mail-send-line":"mail-send-line","aro-icon-map-location-o":"map-location-o","aro-icon-map-location":"map-location","aro-icon-map-pin-line":"map-pin-line","aro-icon-minus-o":"minus-o","aro-icon-mobile-shopping":"mobile-shopping","aro-icon-money-check":"money-check","aro-icon-movies":"movies","aro-icon-new":"new","aro-icon-play":"play","aro-icon-plus-o":"plus-o","aro-icon-plus2":"plus2","aro-icon-quote-left":"quote-left","aro-icon-quote2":"quote2","aro-icon-reply-line":"reply-line","aro-icon-right-arrow-cicrle":"right-arrow-cicrle","aro-icon-right-arrow":"right-arrow","aro-icon-ring":"ring","aro-icon-search2":"search2","aro-icon-send-back":"send-back","aro-icon-setting":"setting","aro-icon-share-all":"share-all","aro-icon-shoppingcart-o":"shoppingcart-o","aro-icon-sliders-v":"sliders-v","aro-icon-support":"support","aro-icon-th-large-o":"th-large-o","aro-icon-truck":"truck","aro-icon-twitter-o":"twitter-o","aro-icon-user-o":"user-o","aro-icon-valuable":"valuable","aro-icon-visacard":"visacard","aro-icon-360":"360","aro-icon-arrow-down":"arrow-down","aro-icon-arrow-left":"arrow-left","aro-icon-arrow-right":"arrow-right","aro-icon-arrow-up":"arrow-up","aro-icon-bars":"bars","aro-icon-caret-down":"caret-down","aro-icon-caret-left":"caret-left","aro-icon-caret-right":"caret-right","aro-icon-caret-up":"caret-up","aro-icon-cart-empty":"cart-empty","aro-icon-cart":"cart","aro-icon-check-square":"check-square","aro-icon-chevron-down":"chevron-down","aro-icon-chevron-left":"chevron-left","aro-icon-chevron-right":"chevron-right","aro-icon-chevron-up":"chevron-up","aro-icon-circle":"circle","aro-icon-cloud-download-alt":"cloud-download-alt","aro-icon-comment":"comment","aro-icon-comments":"comments","aro-icon-compare":"compare","aro-icon-contact":"contact","aro-icon-credit-card":"credit-card","aro-icon-dot-circle":"dot-circle","aro-icon-edit":"edit","aro-icon-envelope":"envelope","aro-icon-expand-alt":"expand-alt","aro-icon-external-link-alt":"external-link-alt","aro-icon-file-alt":"file-alt","aro-icon-file-archive":"file-archive","aro-icon-filter":"filter","aro-icon-folder-open":"folder-open","aro-icon-folder":"folder","aro-icon-frown":"frown","aro-icon-gift":"gift","aro-icon-grip-horizontal":"grip-horizontal","aro-icon-heart-fill":"heart-fill","aro-icon-heart":"heart","aro-icon-history":"history","aro-icon-home":"home","aro-icon-info-circle":"info-circle","aro-icon-instagram":"instagram","aro-icon-level-up-alt":"level-up-alt","aro-icon-list":"list","aro-icon-map-marker-check":"map-marker-check","aro-icon-meh":"meh","aro-icon-minus-circle":"minus-circle","aro-icon-minus":"minus","aro-icon-mobile-android-alt":"mobile-android-alt","aro-icon-money-bill":"money-bill","aro-icon-paper-plane":"paper-plane","aro-icon-pencil-alt":"pencil-alt","aro-icon-plus-circle":"plus-circle","aro-icon-plus":"plus","aro-icon-quickview":"quickview","aro-icon-random":"random","aro-icon-rating-stroke":"rating-stroke","aro-icon-rating":"rating","aro-icon-repeat":"repeat","aro-icon-reply-all":"reply-all","aro-icon-reply":"reply","aro-icon-search-plus":"search-plus","aro-icon-search":"search","aro-icon-shield-check":"shield-check","aro-icon-shopping-basket":"shopping-basket","aro-icon-shopping-cart":"shopping-cart","aro-icon-sign-out-alt":"sign-out-alt","aro-icon-smile":"smile","aro-icon-spinner":"spinner","aro-icon-square":"square","aro-icon-star":"star","aro-icon-store":"store","aro-icon-sync":"sync","aro-icon-tachometer-alt":"tachometer-alt","aro-icon-th-large":"th-large","aro-icon-th-list":"th-list","aro-icon-thumbtack":"thumbtack","aro-icon-ticket":"ticket","aro-icon-times-circle":"times-circle","aro-icon-times":"times","aro-icon-trophy-alt":"trophy-alt","aro-icon-user-headset":"user-headset","aro-icon-user-shield":"user-shield","aro-icon-user":"user","aro-icon-video":"video","aro-icon-wishlist-empty":"wishlist-empty","aro-icon-wishlist":"wishlist","aro-icon-adobe":"adobe","aro-icon-amazon":"amazon","aro-icon-android":"android","aro-icon-angular":"angular","aro-icon-apper":"apper","aro-icon-apple":"apple","aro-icon-atlassian":"atlassian","aro-icon-behance":"behance","aro-icon-bitbucket":"bitbucket","aro-icon-bitcoin":"bitcoin","aro-icon-bity":"bity","aro-icon-bluetooth":"bluetooth","aro-icon-btc":"btc","aro-icon-centos":"centos","aro-icon-chrome":"chrome","aro-icon-codepen":"codepen","aro-icon-cpanel":"cpanel","aro-icon-discord":"discord","aro-icon-dochub":"dochub","aro-icon-docker":"docker","aro-icon-dribbble":"dribbble","aro-icon-dropbox":"dropbox","aro-icon-drupal":"drupal","aro-icon-ebay":"ebay","aro-icon-facebook-f":"facebook-f","aro-icon-facebook":"facebook","aro-icon-figma":"figma","aro-icon-firefox":"firefox","aro-icon-google-plus":"google-plus","aro-icon-google":"google","aro-icon-grunt":"grunt","aro-icon-gulp":"gulp","aro-icon-html5":"html5","aro-icon-joomla":"joomla","aro-icon-link-brand":"link-brand","aro-icon-linkedin":"linkedin","aro-icon-mailchimp":"mailchimp","aro-icon-opencart":"opencart","aro-icon-paypal":"paypal","aro-icon-pinterest-p":"pinterest-p","aro-icon-reddit":"reddit","aro-icon-skype":"skype","aro-icon-slack":"slack","aro-icon-snapchat":"snapchat","aro-icon-spotify":"spotify","aro-icon-trello":"trello","aro-icon-twitter":"twitter","aro-icon-vimeo":"vimeo","aro-icon-whatsapp":"whatsapp","aro-icon-wordpress":"wordpress","aro-icon-yoast":"yoast","aro-icon-youtube":"youtube"}', true );
			$icons     = $manager->get_control( 'icon' )->get_settings( 'options' );
			$new_icons = array_merge(
				$new_icons,
				$icons
			);
			// Then we set a new list of icons as the options of the icon control
			$manager->get_control( 'icon' )->set_settings( 'options', $new_icons ); 
        }

        public function add_icons_native($tabs) {
            global $aro_version;
            $tabs['opal-custom'] = [
                'name'          => 'aro-icon',
                'label'         => esc_html__('Aro Icon', 'aro'),
                'prefix'        => 'aro-icon-',
                'displayPrefix' => 'aro-icon-',
                'labelIcon'     => 'fab fa-font-awesome-alt',
                'ver'           => $aro_version,
                'fetchJson'     => get_theme_file_uri('/inc/elementor/icons.json'),
                'native'        => true,
            ];

            return $tabs;
        }
    }

endif;

return new Aro_Elementor();
