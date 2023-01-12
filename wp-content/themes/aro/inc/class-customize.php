<?php
if (!defined('ABSPATH')) {
    exit;
}
if (!class_exists('Aro_Customize')) {

    class Aro_Customize {


        public function __construct() {
            add_action('customize_register', array($this, 'customize_register'));
        }

        public function get_banner() {
            global $post;

            $options[''] = esc_html__('Select Banner', 'aro');
            if (!aro_is_elementor_activated()) {
                return;
            }
            $args = array(
                'post_type'      => 'elementor_library',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                's'              => 'Banner ',
                'order'          => 'ASC',
            );

            $query1 = new WP_Query($args);
            while ($query1->have_posts()) {
                $query1->the_post();
                $options[$post->post_name] = $post->post_title;
            }

            wp_reset_postdata();
            return $options;
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         */
        public function tesst($wp_customize) {
            $wp_customize->add_control(
                new WP_Customize_Image_Control(
                    $wp_customize,
                    'dav_bgImage',
                    array(
                        'label'    => esc_attr__('Background image', 'aro'),
                        'section'  => 'dav_display_options',
                        'settings' => 'dav_bgImage',
                        'priority' => 8
                    )
                )
            );
        }

        public function customize_register($wp_customize) {

            /**
             * Theme options.
             */
            require_once get_theme_file_path('inc/customize-control/editor.php');
            $this->init_aro_blog($wp_customize);
            $this->aro_register_theme_customizer($wp_customize);


            if (aro_is_woocommerce_activated()) {
                $this->init_woocommerce($wp_customize);
            }

            do_action('aro_customize_register', $wp_customize);
        }

        function aro_register_theme_customizer($wp_customize) {
            /**
             * Defining our own 'Display Options' section
             */
            $wp_customize->add_section(
                'aro_display_options',
                array(
                    'title'    => esc_attr__('Age Verification', 'aro'),
                    'priority' => 55,
                )
            );

            /* minAge */
            $wp_customize->add_setting(
                'aro_minAge',
                array(
                    'default'           => '18',
                    'sanitize_callback' => 'aro_sanitize_input',
                    'transport'         => 'refresh',
                )
            );
            $wp_customize->add_control(
                'aro_minAge',
                array(
                    'section'  => 'aro_display_options',
                    'label'    => esc_attr__('Minimum age?', 'aro'),
                    'type'     => 'number',
                    'priority' => 7,
                )
            );

            /* Add setting for background image uploader. */
            $wp_customize->add_setting(
                'aro_bgImage',
                array(
                    'sanitize_callback' => 'aro_sanitize_image',
                    'transport'         => 'refresh',
                ));

            /* Add control for background image uploader (actual uploader) */
            $wp_customize->add_control(
                new WP_Customize_Image_Control(
                    $wp_customize,
                    'aro_bgImage',
                    array(
                        'label'    => esc_attr__('Background image', 'aro'),
                        'section'  => 'aro_display_options',
                        'settings' => 'aro_bgImage',
                        'priority' => 8
                    )
                )
            );

            /* Add setting for logo uploader. */
            $wp_customize->add_setting(
                'aro_logo',
                array(
                    'sanitize_callback' => 'aro_sanitize_image',
                    'transport'         => 'refresh',
                ));

            /* Add control for logo uploader (actual uploader) */
            $wp_customize->add_control(
                new WP_Customize_Image_Control(
                    $wp_customize,
                    'aro_logo',
                    array(
                        'label'    => esc_attr__('Logo image', 'aro'),
                        'section'  => 'aro_display_options',
                        'settings' => 'aro_logo',
                        'priority' => 9
                    )
                )
            );

            /* title */
            $wp_customize->add_setting(
                'aro_title',
                array(
                    'default'           => esc_attr__('Age Verification', 'aro'),
                    'sanitize_callback' => 'aro_sanitize_input',
                    'transport'         => 'refresh',
                )
            );
            $wp_customize->add_control(
                'aro_title',
                array(
                    'section'  => 'aro_display_options',
                    'label'    => esc_attr__('Title', 'aro'),
                    'type'     => 'text',
                    'priority' => 10,
                )
            );

            /* description */
            $wp_customize->add_setting(
                'aro_description',
                array(
                    'default'           => esc_attr__('You must be of legal drinking age to buy our products. Age will be verified upon delivery through ID.', 'aro'),
                    'sanitize_callback' => 'aro_sanitize_input',
                    'transport'         => 'refresh',
                )
            );
            $wp_customize->add_control(
                'aro_description',
                array(
                    'section'  => 'aro_display_options',
                    'label'    => esc_attr__('Description', 'aro'),
                    'type'     => 'textarea',
                    'priority' => 11,
                )
            );

            /* copy */
            $wp_customize->add_setting(
                'aro_copy',
                array(
                    'default'           => esc_attr__('You must be [age] years old to enter.', 'aro'),
                    'sanitize_callback' => 'aro_sanitize_input',
                    'transport'         => 'refresh',
                )
            );
            $wp_customize->add_control(
                'aro_copy',
                array(
                    'section'  => 'aro_display_options',
                    'label'    => esc_attr__('Copy', 'aro'),
                    'type'     => 'textarea',
                    'priority' => 13,
                )
            );

            /* Yes button */
            $wp_customize->add_setting(
                'aro_button_yes',
                array(
                    'default'           => esc_attr__('YES', 'aro'),
                    'sanitize_callback' => 'aro_sanitize_input',
                    'transport'         => 'refresh',
                )
            );
            $wp_customize->add_control(
                'aro_button_yes',
                array(
                    'section'  => 'aro_display_options',
                    'label'    => esc_attr__('Button #1 text', 'aro'),
                    'type'     => 'text',
                    'priority' => 14,
                )
            );

            /* No button */
            $wp_customize->add_setting(
                'aro_button_no',
                array(
                    'default'           => esc_attr__('NO', 'aro'),
                    'sanitize_callback' => 'aro_sanitize_input',
                    'transport'         => 'refresh',
                )
            );
            $wp_customize->add_control(
                'aro_button_no',
                array(
                    'section'  => 'aro_display_options',
                    'label'    => esc_attr__('Button #2 text', 'aro'),
                    'type'     => 'text',
                    'priority' => 13,
                )
            );

            /* Success/Failure message display time */
            $wp_customize->add_setting(
                'aro_message_display_time',
                array(
                    'default'           => 2000,
                    'sanitize_callback' => 'aro_sanitize_input',
                    'transport'         => 'refresh',
                )
            );
            $wp_customize->add_control(
                'aro_message_display_time',
                array(
                    'section'  => 'aro_display_options',
                    'label'    => esc_attr__('Message display time (milliseconds)', 'aro'),
                    'type'     => 'number',
                    'priority' => 18,
                )
            );
            /* Success/Failure message display time */
            $wp_customize->add_setting(
                'aro_cookie_days',
                array(
                    'default'           => 30,
                    'sanitize_callback' => 'aro_sanitize_input',
                    'transport'         => 'refresh',
                )
            );
            $wp_customize->add_control(
                'aro_cookie_days',
                array(
                    'section'  => 'aro_display_options',
                    'label'    => esc_attr__('Cookie (day)', 'aro'),
                    'type'     => 'number',
                    'priority' => 20,
                )
            );

            /* Show or Hide Blog Description */
            $wp_customize->add_setting(
                'aro_adminHide',
                array(
                    'default'           => '',
                    'sanitize_callback' => 'aro_sanitize_input',
                    'transport'         => 'refresh',
                )
            );
            $wp_customize->add_control(
                'aro_adminHide',
                array(
                    'section'  => 'aro_display_options',
                    'label'    => esc_attr__('Hide for admin users?', 'aro'),
                    'type'     => 'checkbox',
                    'priority' => 99,
                )
            );

            /* Show or Hide Blog Description */
            $wp_customize->add_setting(
                'aro_Enable',
                array(
                    'default'           => '',
                    'sanitize_callback' => 'aro_sanitize_input',
                    'transport'         => 'refresh',
                )
            );
            $wp_customize->add_control(
                'aro_Enable',
                array(
                    'section'  => 'aro_display_options',
                    'label'    => esc_attr__('Enable Age Verification', 'aro'),
                    'type'     => 'checkbox',
                    'priority' => 99,
                )
            );

        } // end aro_register_theme_customizer

        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */
        public function init_aro_blog($wp_customize) {

            $wp_customize->add_panel('aro_blog', array(
                'title' => esc_html__('Blog', 'aro'),
            ));

            // =========================================
            // Blog Archive
            // =========================================
            $wp_customize->add_section('aro_blog_archive', array(
                'title'      => esc_html__('Archive', 'aro'),
                'panel'      => 'aro_blog',
                'capability' => 'edit_theme_options',
            ));

            $wp_customize->add_setting('aro_options_blog_sidebar', array(
                'type'              => 'option',
                'default'           => 'left',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('aro_options_blog_sidebar', array(
                'section' => 'aro_blog_archive',
                'label'   => esc_html__('Sidebar Position', 'aro'),
                'type'    => 'select',
                'choices' => array(
                    'none'  => esc_html__('None', 'aro'),
                    'left'  => esc_html__('Left', 'aro'),
                    'right' => esc_html__('Right', 'aro'),
                ),
            ));

            $wp_customize->add_setting('aro_options_blog_style', array(
                'type'              => 'option',
                'default'           => 'standard',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('aro_options_blog_style', array(
                'section' => 'aro_blog_archive',
                'label'   => esc_html__('Blog style', 'aro'),
                'type'    => 'select',
                'choices' => array(
                    'standard' => esc_html__('Blog Standard', 'aro'),
                    'list'     => esc_html__('Blog List', 'aro'),
                    'style-1'  => esc_html__('Blog Grid', 'aro'),
                ),
            ));

            $wp_customize->add_setting('aro_options_blog_columns', array(
                'type'              => 'option',
                'default'           => 1,
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('aro_options_blog_columns', array(
                'section' => 'aro_blog_archive',
                'label'   => esc_html__('Colunms', 'aro'),
                'type'    => 'select',
                'choices' => array(
                    1 => esc_html__('1', 'aro'),
                    2 => esc_html__('2', 'aro'),
                    3 => esc_html__('3', 'aro'),
                    4 => esc_html__('4', 'aro'),
                ),
            ));

            // =========================================
            // Blog Single
            // =========================================
            $wp_customize->add_section('aro_blog_single', array(
                'title'      => esc_html__('Singular', 'aro'),
                'panel'      => 'aro_blog',
                'capability' => 'edit_theme_options',
            ));
            $wp_customize->add_setting('aro_options_blog_single_sidebar', array(
                'type'              => 'option',
                'default'           => 'left',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('aro_options_blog_single_sidebar', array(
                'section' => 'aro_blog_single',
                'label'   => esc_html__('Sidebar Position', 'aro'),
                'type'    => 'select',
                'choices' => array(
                    'none'  => esc_html__('None', 'aro'),
                    'left'  => esc_html__('Left', 'aro'),
                    'right' => esc_html__('Right', 'aro'),
                ),
            ));
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */


        public function init_woocommerce($wp_customize) {

            $wp_customize->add_panel('woocommerce', array(
                'title' => esc_html__('Woocommerce', 'aro'),
            ));

            $wp_customize->add_section('aro_woocommerce_archive', array(
                'title'      => esc_html__('Archive', 'aro'),
                'capability' => 'edit_theme_options',
                'panel'      => 'woocommerce',
                'priority'   => 1,
            ));

            if (aro_is_elementor_activated()) {
                $wp_customize->add_setting('aro_options_shop_banner', array(
                    'type'              => 'option',
                    'default'           => '',
                    'sanitize_callback' => 'sanitize_text_field',
                ));

                $wp_customize->add_control('aro_options_shop_banner', array(
                    'section'     => 'aro_woocommerce_archive',
                    'label'       => esc_html__('Banner', 'aro'),
                    'type'        => 'select',
                    'description' => __('Banner will take templates name prefix is "Banner"', 'aro'),
                    'choices'     => $this->get_banner()
                ));
            }

            $wp_customize->add_setting('aro_options_woocommerce_archive_layout', array(
                'type'              => 'option',
                'default'           => 'default',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('aro_options_woocommerce_archive_layout', array(
                'section' => 'aro_woocommerce_archive',
                'label'   => esc_html__('Layout Style', 'aro'),
                'type'    => 'select',
                'choices' => array(
                    'default' => esc_html__('Sidebar', 'aro'),
                    //====start_premium
                    'canvas'  => esc_html__('Canvas Filter', 'aro'),
                    //====end_premium
                ),
            ));

            $wp_customize->add_setting('aro_options_woocommerce_archive_sidebar', array(
                'type'              => 'option',
                'default'           => 'left',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('aro_options_woocommerce_archive_sidebar', array(
                'section' => 'aro_woocommerce_archive',
                'label'   => esc_html__('Sidebar Position', 'aro'),
                'type'    => 'select',
                'choices' => array(
                    'left'  => esc_html__('Left', 'aro'),
                    'right' => esc_html__('Right', 'aro'),

                ),
            ));

            // =========================================
            // Single Product
            // =========================================

            $wp_customize->add_section('aro_woocommerce_single', array(
                'title'      => esc_html__('Singular', 'aro'),
                'capability' => 'edit_theme_options',
                'panel'      => 'woocommerce',
                'priority'   => 1,
            ));

            $wp_customize->add_setting('aro_options_single_product_gallery_layout', array(
                'type'              => 'option',
                'default'           => 'horizontal',
                'transport'         => 'refresh',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('aro_options_single_product_gallery_layout', array(
                'section' => 'aro_woocommerce_single',
                'label'   => esc_html__('Style', 'aro'),
                'type'    => 'select',
                'choices' => array(
                    'horizontal' => esc_html__('Horizontal', 'aro'),
                    //====start_premium
                    'vertical'   => esc_html__('Vertical', 'aro'),
                    'gallery'    => esc_html__('Gallery', 'aro'),
                    'sticky'     => esc_html__('Sticky', 'aro'),
                    //====end_premium
                ),
            ));

            $wp_customize->add_setting(
                'aro_options_single_product_content_meta',
                array(
                    /* translators: %s privacy policy page name and link */
                    'type'              => 'option',
                    'sanitize_callback' => 'wp_kses_post',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'postMessage',
                )
            );

            $wp_customize->add_control(
                'aro_options_single_product_content_meta',
                array(

                    'label'    => esc_html__('Single extra description', 'aro'),
                    'section'  => 'aro_woocommerce_single',
                    'settings' => 'aro_options_single_product_content_meta',
                    'type'     => 'textarea',
                )
            );

            // =========================================
            // Product
            // =========================================
            $wp_customize->add_setting('aro_options_wocommerce_row_laptop', array(
                'type'              => 'option',
                'default'           => 3,
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('aro_options_wocommerce_row_laptop', array(
                'section' => 'woocommerce_product_catalog',
                'label'   => esc_html__('Products per row Laptop', 'aro'),
                'type'    => 'number',
            ));

            $wp_customize->add_setting('aro_options_wocommerce_row_tablet', array(
                'type'              => 'option',
                'default'           => 2,
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('aro_options_wocommerce_row_tablet', array(
                'section' => 'woocommerce_product_catalog',
                'label'   => esc_html__('Products per row tablet', 'aro'),
                'type'    => 'number',
            ));

            $wp_customize->add_setting('aro_options_wocommerce_row_mobile', array(
                'type'              => 'option',
                'default'           => 1,
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('aro_options_wocommerce_row_mobile', array(
                'section' => 'woocommerce_product_catalog',
                'label'   => esc_html__('Products per row mobile', 'aro'),
                'type'    => 'number',
            ));

            $wp_customize->add_setting('aro_options_wocommerce_block_style', array(
                'type'              => 'option',
                'default'           => '',
                'transport'         => 'refresh',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('aro_options_wocommerce_block_style', array(
                'section' => 'woocommerce_product_catalog',
                'label'   => esc_html__('Style', 'aro'),
                'type'    => 'select',
                'choices' => array(
                    '' => esc_html__('Style 1', 'aro'),
                ),
            ));

            $wp_customize->add_setting('aro_options_woocommerce_product_hover', array(
                'type'              => 'option',
                'default'           => 'none',
                'transport'         => 'refresh',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('aro_options_woocommerce_product_hover', array(
                'section' => 'woocommerce_product_catalog',
                'label'   => esc_html__('Animation Image Hover', 'aro'),
                'type'    => 'select',
                'choices' => array(
                    'none'          => esc_html__('None', 'aro'),
                    'bottom-to-top' => esc_html__('Bottom to Top', 'aro'),
                    'top-to-bottom' => esc_html__('Top to Bottom', 'aro'),
                    'right-to-left' => esc_html__('Right to Left', 'aro'),
                    'left-to-right' => esc_html__('Left to Right', 'aro'),
                    'swap'          => esc_html__('Swap', 'aro'),
                    'fade'          => esc_html__('Fade', 'aro'),
                    'zoom-in'       => esc_html__('Zoom In', 'aro'),
                    'zoom-out'      => esc_html__('Zoom Out', 'aro'),
                ),
            ));
        }
    }
}
return new Aro_Customize();
