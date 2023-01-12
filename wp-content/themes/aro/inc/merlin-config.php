<?php

class Aro_Merlin_Config {

    private $wizard;

    public function __construct() {
        $this->init();
        add_filter('merlin_import_files', [$this, 'import_files']);
        add_action('merlin_after_all_import', [$this, 'after_import_setup'], 10, 1);
        add_filter('merlin_generate_child_functions_php', [$this, 'render_child_functions_php']);

        add_action('import_start', function () {
            add_filter('wxr_importer.pre_process.post_meta', [$this, 'fiximport_elementor'], 10, 1);
        });
    }

    public function fiximport_elementor($post_meta) {
        if ('_elementor_data' === $post_meta['key']) {
            $post_meta['value'] = wp_slash($post_meta['value']);
        }

        return $post_meta;
    }

    public function import_files(){
            return array(
            array(
                'import_file_name'           => 'home 1',
                'home'                       => 'home-1',
                'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-1.xml'),
                'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
                'import_rev_slider_file_url' => 'http://source.wpopal.com/aro/dummy_data/revsliders/home-1/slider-1.zip',
                'import_more_revslider_file_url' => [],
                'import_lookbook_revslider_file_url' => [],
                'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home-1.jpg'),
                'preview_url'                => 'https://demo2.themelexus.com/aro/home-1',
                'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#DAA14C"},{"_id":"secondary","title":"Secondary(Heading)","color":"#30373E"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#30373E"},{"_id":"lighter","title":"Lighter","color":"#888888"},{"_id":"dark","title":"Dark","color":"#202020"},{"_id":"highlight","title":"Highlight","color":"#cccccc"},{"_id":"border","title":"Border","color":"#E3E3E3"},{"_id":"background-light","title":"Background Light","color":"#F8F6F4"},{"_id":"background-field","title":"Background Field","color":"#DADADA20"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary(Heading)","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"},{"_id":"special","title":"Special","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Aro","site_description":"Jewelry Store WordPress Theme","page_title_selector":"h1.entry-title","activeItemIndex":1,"active_breakpoints":["viewport_mobile","viewport_mobile_extra","viewport_tablet","viewport_tablet_extra","viewport_laptop"],"viewport_md":768,"viewport_lg":1025,"container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"body_background_background":"classic","body_background_color":"#fff"}',
                'themeoptions'               => '{}',
            ),

            array(
                'import_file_name'           => 'home 2',
                'home'                       => 'home-2',
                'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-2.xml'),
                'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
                'import_rev_slider_file_url' => 'http://source.wpopal.com/aro/dummy_data/revsliders/home-2/slider-home2.zip',
                'import_more_revslider_file_url' => [],
                'import_lookbook_revslider_file_url' => [],
                'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home-2.jpg'),
                'preview_url'                => 'https://demo2.themelexus.com/aro/home-2',
                'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#DAA14C"},{"_id":"secondary","title":"Secondary(Heading)","color":"#FFFFFF"},{"_id":"text","title":"Text","color":"#999999"},{"_id":"accent","title":"Accent","color":"#30373E"},{"_id":"lighter","title":"Lighter","color":"#888888"},{"_id":"dark","title":"Dark","color":"#999999"},{"_id":"highlight","title":"Highlight","color":"#cccccc"},{"_id":"border","title":"Border","color":"#D1D1D110"},{"_id":"background-light","title":"Background Light","color":"#30373E"},{"_id":"background-field","title":"Background Field","color":"#DADADA10"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary(Heading)","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"},{"_id":"special","title":"Special","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Aro","site_description":"Jewelry Store WordPress Theme","page_title_selector":"h1.entry-title","activeItemIndex":1,"active_breakpoints":["viewport_mobile","viewport_mobile_extra","viewport_tablet","viewport_tablet_extra","viewport_laptop"],"viewport_md":768,"viewport_lg":1025,"container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"body_background_background":"classic","body_background_color":"#121D23"}',
                'themeoptions'               => '{}',
            ),

            array(
                'import_file_name'           => 'home 3',
                'home'                       => 'home-3',
                'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-3.xml'),
                'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
                'import_rev_slider_file_url' => 'http://source.wpopal.com/aro/dummy_data/revsliders/home-3/slider-home3.zip',
                'import_more_revslider_file_url' => [],
                'import_lookbook_revslider_file_url' => [],
                'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home-3.jpg'),
                'preview_url'                => 'https://demo2.themelexus.com/aro/home-3',
                'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#DAA14C"},{"_id":"secondary","title":"Secondary(Heading)","color":"#FFFFFF"},{"_id":"text","title":"Text","color":"#999999"},{"_id":"accent","title":"Accent","color":"#30373E"},{"_id":"lighter","title":"Lighter","color":"#888888"},{"_id":"dark","title":"Dark","color":"#999999"},{"_id":"highlight","title":"Highlight","color":"#cccccc"},{"_id":"border","title":"Border","color":"#D1D1D110"},{"_id":"background-light","title":"Background Light","color":"#30373E"},{"_id":"background-field","title":"Background Field","color":"#DADADA10"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary(Heading)","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"},{"_id":"special","title":"Special","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Aro","site_description":"Jewelry Store WordPress Theme","page_title_selector":"h1.entry-title","activeItemIndex":1,"active_breakpoints":["viewport_mobile","viewport_mobile_extra","viewport_tablet","viewport_tablet_extra","viewport_laptop"],"viewport_md":768,"viewport_lg":1025,"container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"body_background_background":"classic","body_background_color":"#121D23"}',
                'themeoptions'               => '{}',
            ),

            array(
                'import_file_name'           => 'home 4',
                'home'                       => 'home-4',
                'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-4.xml'),
                'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
                'import_rev_slider_file_url' => 'http://source.wpopal.com/aro/dummy_data/revsliders/home-4/slider-home4.zip',
                'import_more_revslider_file_url' => [],
                'import_lookbook_revslider_file_url' => [],
                'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home-4.jpg'),
                'preview_url'                => 'https://demo2.themelexus.com/aro/home-4',
                'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#DAA14C"},{"_id":"secondary","title":"Secondary(Heading)","color":"#FFFFFF"},{"_id":"text","title":"Text","color":"#999999"},{"_id":"accent","title":"Accent","color":"#30373E"},{"_id":"lighter","title":"Lighter","color":"#888888"},{"_id":"dark","title":"Dark","color":"#999999"},{"_id":"highlight","title":"Highlight","color":"#cccccc"},{"_id":"border","title":"Border","color":"#D1D1D110"},{"_id":"background-light","title":"Background Light","color":"#30373E"},{"_id":"background-field","title":"Background Field","color":"#DADADA10"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary(Heading)","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"},{"_id":"special","title":"Special","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Aro","site_description":"Jewelry Store WordPress Theme","page_title_selector":"h1.entry-title","activeItemIndex":1,"active_breakpoints":["viewport_mobile","viewport_mobile_extra","viewport_tablet","viewport_tablet_extra","viewport_laptop"],"viewport_md":768,"viewport_lg":1025,"container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"body_background_background":"classic","body_background_color":"#121D23"}',
                'themeoptions'               => '{}',
            ),

            array(
                'import_file_name'           => 'home 5',
                'home'                       => 'home-5',
                'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-5.xml'),
                'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
                'import_rev_slider_file_url' => 'http://source.wpopal.com/aro/dummy_data/revsliders/home-5/slider-home56.zip',
                'import_more_revslider_file_url' => [],
                'import_lookbook_revslider_file_url' => [],
                'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home-5.jpg'),
                'preview_url'                => 'https://demo2.themelexus.com/aro/home-5',
                'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#DAA14C"},{"_id":"secondary","title":"Secondary(Heading)","color":"#FFFFFF"},{"_id":"text","title":"Text","color":"#999999"},{"_id":"accent","title":"Accent","color":"#30373E"},{"_id":"lighter","title":"Lighter","color":"#888888"},{"_id":"dark","title":"Dark","color":"#999999"},{"_id":"highlight","title":"Highlight","color":"#cccccc"},{"_id":"border","title":"Border","color":"#D1D1D110"},{"_id":"background-light","title":"Background Light","color":"#30373E"},{"_id":"background-field","title":"Background Field","color":"#DADADA10"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary(Heading)","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"},{"_id":"special","title":"Special","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Aro","site_description":"Jewelry Store WordPress Theme","page_title_selector":"h1.entry-title","activeItemIndex":1,"active_breakpoints":["viewport_mobile","viewport_mobile_extra","viewport_tablet","viewport_tablet_extra","viewport_laptop"],"viewport_md":768,"viewport_lg":1025,"container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"body_background_background":"classic","body_background_color":"#121D23"}',
                'themeoptions'               => '{}',
            ),

            array(
                'import_file_name'           => 'home 6',
                'home'                       => 'home-6',
                'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-6.xml'),
                'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
                'import_rev_slider_file_url' => 'http://source.wpopal.com/aro/dummy_data/revsliders/home-6/slider-home56.zip',
                'import_more_revslider_file_url' => [],
                'import_lookbook_revslider_file_url' => [],
                'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home-6.jpg'),
                'preview_url'                => 'https://demo2.themelexus.com/aro/home-6',
                'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#DAA14C"},{"_id":"secondary","title":"Secondary(Heading)","color":"#FFFFFF"},{"_id":"text","title":"Text","color":"#999999"},{"_id":"accent","title":"Accent","color":"#30373E"},{"_id":"lighter","title":"Lighter","color":"#888888"},{"_id":"dark","title":"Dark","color":"#999999"},{"_id":"highlight","title":"Highlight","color":"#cccccc"},{"_id":"border","title":"Border","color":"#D1D1D110"},{"_id":"background-light","title":"Background Light","color":"#30373E"},{"_id":"background-field","title":"Background Field","color":"#DADADA10"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary(Heading)","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"},{"_id":"special","title":"Special","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Aro","site_description":"Jewelry Store WordPress Theme","page_title_selector":"h1.entry-title","activeItemIndex":1,"active_breakpoints":["viewport_mobile","viewport_mobile_extra","viewport_tablet","viewport_tablet_extra","viewport_laptop"],"viewport_md":768,"viewport_lg":1025,"container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"body_background_background":"classic","body_background_color":"#121D23"}',
                'themeoptions'               => '{}',
            ),

            array(
                'import_file_name'           => 'home 7',
                'home'                       => 'home-7',
                'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-7.xml'),
                'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
                'import_rev_slider_file_url' => 'http://source.wpopal.com/aro/dummy_data/revsliders/home-7/slider-home7.zip',
                'import_more_revslider_file_url' => [],
                'import_lookbook_revslider_file_url' => [],
                'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home-7.jpg'),
                'preview_url'                => 'https://demo2.themelexus.com/aro/home-7',
                'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#DAA14C"},{"_id":"secondary","title":"Secondary(Heading)","color":"#FFFFFF"},{"_id":"text","title":"Text","color":"#999999"},{"_id":"accent","title":"Accent","color":"#30373E"},{"_id":"lighter","title":"Lighter","color":"#888888"},{"_id":"dark","title":"Dark","color":"#999999"},{"_id":"highlight","title":"Highlight","color":"#cccccc"},{"_id":"border","title":"Border","color":"#D1D1D110"},{"_id":"background-light","title":"Background Light","color":"#30373E"},{"_id":"background-field","title":"Background Field","color":"#DADADA10"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary(Heading)","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"},{"_id":"special","title":"Special","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Aro","site_description":"Jewelry Store WordPress Theme","page_title_selector":"h1.entry-title","activeItemIndex":1,"active_breakpoints":["viewport_mobile","viewport_mobile_extra","viewport_tablet","viewport_tablet_extra","viewport_laptop"],"viewport_md":768,"viewport_lg":1025,"container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"body_background_background":"classic","body_background_color":"#121D23"}',
                'themeoptions'               => '{}',
            ),

            array(
                'import_file_name'           => 'home 8',
                'home'                       => 'home-8',
                'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-8.xml'),
                'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
                'import_rev_slider_file_url' => 'http://source.wpopal.com/aro/dummy_data/revsliders/home-8/slider-home8.zip',
                'import_more_revslider_file_url' => [],
                'import_lookbook_revslider_file_url' => [],
                'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home-8.jpg'),
                'preview_url'                => 'https://demo2.themelexus.com/aro/home-8',
                'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#DAA14C"},{"_id":"secondary","title":"Secondary(Heading)","color":"#FFFFFF"},{"_id":"text","title":"Text","color":"#999999"},{"_id":"accent","title":"Accent","color":"#30373E"},{"_id":"lighter","title":"Lighter","color":"#888888"},{"_id":"dark","title":"Dark","color":"#999999"},{"_id":"highlight","title":"Highlight","color":"#cccccc"},{"_id":"border","title":"Border","color":"#D1D1D110"},{"_id":"background-light","title":"Background Light","color":"#30373E"},{"_id":"background-field","title":"Background Field","color":"#DADADA10"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary(Heading)","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"},{"_id":"special","title":"Special","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Aro","site_description":"Jewelry Store WordPress Theme","page_title_selector":"h1.entry-title","activeItemIndex":1,"active_breakpoints":["viewport_mobile","viewport_mobile_extra","viewport_tablet","viewport_tablet_extra","viewport_laptop"],"viewport_md":768,"viewport_lg":1025,"container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"body_background_background":"classic","body_background_color":"#121D23"}',
                'themeoptions'               => '{}',
            ),

            array(
                'import_file_name'           => 'home 9',
                'home'                       => 'home-9',
                'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-9.xml'),
                'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
                'import_rev_slider_file_url' => 'http://source.wpopal.com/aro/dummy_data/revsliders/home-9/slider-home9.zip',
                'import_more_revslider_file_url' => [],
                'import_lookbook_revslider_file_url' => [],
                'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home-9.jpg'),
                'preview_url'                => 'https://demo2.themelexus.com/aro/home-9',
                'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#DAA14C"},{"_id":"secondary","title":"Secondary(Heading)","color":"#FFFFFF"},{"_id":"text","title":"Text","color":"#999999"},{"_id":"accent","title":"Accent","color":"#30373E"},{"_id":"lighter","title":"Lighter","color":"#888888"},{"_id":"dark","title":"Dark","color":"#999999"},{"_id":"highlight","title":"Highlight","color":"#cccccc"},{"_id":"border","title":"Border","color":"#D1D1D110"},{"_id":"background-light","title":"Background Light","color":"#30373E"},{"_id":"background-field","title":"Background Field","color":"#DADADA10"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary(Heading)","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"},{"_id":"special","title":"Special","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Aro","site_description":"Jewelry Store WordPress Theme","page_title_selector":"h1.entry-title","activeItemIndex":1,"active_breakpoints":["viewport_mobile","viewport_mobile_extra","viewport_tablet","viewport_tablet_extra","viewport_laptop"],"viewport_md":768,"viewport_lg":1025,"container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"body_background_background":"classic","body_background_color":"#121D23"}',
                'themeoptions'               => '{}',
            ),
            );           
        }

    public function after_import_setup($selected_import) {
        $selected_import = ($this->import_files())[$selected_import];
        $check_oneclick  = get_option('aro_check_oneclick', []);

        $this->set_demo_menus();

        if (!isset($check_oneclick[$selected_import['home']])) {
            $this->wizard->importer->import(get_parent_theme_file_path('dummy-data/homepage/' . $selected_import['home'] . '.xml'));
            $check_oneclick[$selected_import['home']] = true;
        }

        // setup Home page
        $home = get_page_by_path($selected_import['home']);
        if ($home) {
            update_option('show_on_front', 'page');
            update_option('page_on_front', $home->ID);
        }

        // Setup Options
        $options = $this->get_all_options();

        // Elementor

        $active_kit_id = Elementor\Plugin::$instance->kits_manager->get_active_id();
        update_post_meta($active_kit_id, '_elementor_page_settings', json_decode($selected_import['elementor'], true));

        // Options
        $theme_options = $options['options'];
        foreach ($theme_options as $key => $option) {
            update_option($key, $option);
        }

        //Mailchimp
        if (!isset($check_oneclick['mailchip'])) {
            $mailchimp = $this->get_mailchimp_id();
            if ($mailchimp) {
                update_option('mc4wp_default_form_id', $mailchimp);
            }
            $check_oneclick['mailchip'] = true;
        }

        // Header Footer Builder
        $this->reset_header_footer();
        $this->set_hf($selected_import['home']);

        // WooCommerce
        if (!isset($check_oneclick['woocommerce'])) {
            update_option('woocommerce_single_image_width', 800);
            update_option('woocommerce_thumbnail_image_width', 460);
            $check_oneclick['woocommerce'] = true;
        }

        if (!isset($check_oneclick['logo'])) {
            set_theme_mod('custom_logo', $this->get_attachment('_logo'));
            $check_oneclick['logo'] = true;
        }

        if (!isset($check_oneclick['slidelookbook'])) {
            $check_oneclick['slidelookbook'] = true;
        }

        update_option('aro_check_oneclick', $check_oneclick);

        \Elementor\Plugin::instance()->files_manager->clear_cache();

        $this->update_nav_menu_item();
        $this->update_logo();
    }

    private function update_nav_menu_item() {
        $params = array(
            'posts_per_page' => -1,
            'post_type'      => [
                'nav_menu_item',
            ],
        );
        $query  = new WP_Query($params);
        while ($query->have_posts()): $query->the_post();
            wp_update_post(array(
                // Update the `nav_menu_item` Post Title
                'ID'         => get_the_ID(),
                'post_title' => get_the_title()
            ));
        endwhile;

    }

    private function get_mailchimp_id() {
        $params = array(
            'post_type'      => 'mc4wp-form',
            'posts_per_page' => 1,
        );
        $post   = get_posts($params);

        return isset($post[0]) ? $post[0]->ID : 0;
    }

    private function get_attachment($key) {
        $params = array(
            'post_type'      => 'attachment',
            'post_status'    => 'inherit',
            'posts_per_page' => 1,
            'meta_key'       => $key,
        );
        $post   = get_posts($params);
        if ($post) {
            return $post[0]->ID;
        }

        return 0;
    }

    private function init() {
        $this->wizard = new Merlin(
            $config = array(
                // Location / directory where Merlin WP is placed in your theme.
                'merlin_url'         => 'merlin',
                // The wp-admin page slug where Merlin WP loads.
                'parent_slug'        => 'themes.php',
                // The wp-admin parent page slug for the admin menu item.
                'capability'         => 'manage_options',
                // The capability required for this menu to be displayed to the user.
                'dev_mode'           => true,
                // Enable development mode for testing.
                'license_step'       => false,
                // EDD license activation step.
                'license_required'   => false,
                // Require the license activation step.
                'license_help_url'   => '',
                'directory'          => '/inc/merlin',
                // URL for the 'license-tooltip'.
                'edd_remote_api_url' => '',
                // EDD_Theme_Updater_Admin remote_api_url.
                'edd_item_name'      => '',
                // EDD_Theme_Updater_Admin item_name.
                'edd_theme_slug'     => '',
                // EDD_Theme_Updater_Admin item_slug.
            ),
            $strings = array(
                'admin-menu'          => esc_html__('Theme Setup', 'aro'),

                /* translators: 1: Title Tag 2: Theme Name 3: Closing Title Tag */
                'title%s%s%s%s'       => esc_html__('%1$s%2$s Themes &lsaquo; Theme Setup: %3$s%4$s', 'aro'),
                'return-to-dashboard' => esc_html__('Return to the dashboard', 'aro'),
                'ignore'              => esc_html__('Disable this wizard', 'aro'),

                'btn-skip'                 => esc_html__('Skip', 'aro'),
                'btn-next'                 => esc_html__('Next', 'aro'),
                'btn-start'                => esc_html__('Start', 'aro'),
                'btn-no'                   => esc_html__('Cancel', 'aro'),
                'btn-plugins-install'      => esc_html__('Install', 'aro'),
                'btn-child-install'        => esc_html__('Install', 'aro'),
                'btn-content-install'      => esc_html__('Install', 'aro'),
                'btn-import'               => esc_html__('Import', 'aro'),
                'btn-license-activate'     => esc_html__('Activate', 'aro'),
                'btn-license-skip'         => esc_html__('Later', 'aro'),

                /* translators: Theme Name */
                'license-header%s'         => esc_html__('Activate %s', 'aro'),
                /* translators: Theme Name */
                'license-header-success%s' => esc_html__('%s is Activated', 'aro'),
                /* translators: Theme Name */
                'license%s'                => esc_html__('Enter your license key to enable remote updates and theme support.', 'aro'),
                'license-label'            => esc_html__('License key', 'aro'),
                'license-success%s'        => esc_html__('The theme is already registered, so you can go to the next step!', 'aro'),
                'license-json-success%s'   => esc_html__('Your theme is activated! Remote updates and theme support are enabled.', 'aro'),
                'license-tooltip'          => esc_html__('Need help?', 'aro'),

                /* translators: Theme Name */
                'welcome-header%s'         => esc_html__('Welcome to %s', 'aro'),
                'welcome-header-success%s' => esc_html__('Hi. Welcome back', 'aro'),
                'welcome%s'                => esc_html__('This wizard will set up your theme, install plugins, and import content. It is optional & should take only a few minutes.', 'aro'),
                'welcome-success%s'        => esc_html__('You may have already run this theme setup wizard. If you would like to proceed anyway, click on the "Start" button below.', 'aro'),

                'child-header'         => esc_html__('Install Child Theme', 'aro'),
                'child-header-success' => esc_html__('You\'re good to go!', 'aro'),
                'child'                => esc_html__('Let\'s build & activate a child theme so you may easily make theme changes.', 'aro'),
                'child-success%s'      => esc_html__('Your child theme has already been installed and is now activated, if it wasn\'t already.', 'aro'),
                'child-action-link'    => esc_html__('Learn about child themes', 'aro'),
                'child-json-success%s' => esc_html__('Awesome. Your child theme has already been installed and is now activated.', 'aro'),
                'child-json-already%s' => esc_html__('Awesome. Your child theme has been created and is now activated.', 'aro'),

                'plugins-header'         => esc_html__('Install Plugins', 'aro'),
                'plugins-header-success' => esc_html__('You\'re up to speed!', 'aro'),
                'plugins'                => esc_html__('Let\'s install some essential WordPress plugins to get your site up to speed.', 'aro'),
                'plugins-success%s'      => esc_html__('The required WordPress plugins are all installed and up to date. Press "Next" to continue the setup wizard.', 'aro'),
                'plugins-action-link'    => esc_html__('Advanced', 'aro'),

                'import-header'      => esc_html__('Import Content', 'aro'),
                'import'             => esc_html__('Let\'s import content to your website, to help you get familiar with the theme.', 'aro'),
                'import-action-link' => esc_html__('Advanced', 'aro'),

                'ready-header'      => esc_html__('All done. Have fun!', 'aro'),

                /* translators: Theme Author */
                'ready%s'           => esc_html__('Your theme has been all set up. Enjoy your new theme by %s.', 'aro'),
                'ready-action-link' => esc_html__('Extras', 'aro'),
                'ready-big-button'  => esc_html__('View your website', 'aro'),
                'ready-link-1'      => sprintf('<a href="%1$s" target="_blank">%2$s</a>', 'https://wordpress.org/support/', esc_html__('Explore WordPress', 'aro')),
                'ready-link-2'      => sprintf('<a href="%1$s" target="_blank">%2$s</a>', 'https://themebeans.com/contact/', esc_html__('Get Theme Support', 'aro')),
                'ready-link-3'      => sprintf('<a href="%1$s">%2$s</a>', admin_url('customize.php'), esc_html__('Start Customizing', 'aro')),
            )
        );
        if (aro_is_elementor_activated()) {
            add_action('widgets_init', [$this, 'widgets_init']);
        }
        if (class_exists('Monster_Widget')) {
            add_action('widgets_init', [$this, 'widget_monster']);
        }
    }

    public function widget_monster() {
        unregister_widget('Monster_Widget');
        require_once get_parent_theme_file_path('/inc/merlin/includes/monster-widget.php');
        register_widget('Aro_Monster_Widget');
    }

    public function widgets_init() {
        require_once get_parent_theme_file_path('/inc/merlin/includes/recent-post.php');
        register_widget('Aro_WP_Widget_Recent_Posts');
        if (aro_is_woocommerce_activated()) {
            require_once get_parent_theme_file_path('/inc/merlin/includes/class-wc-widget-layered-nav.php');
            register_widget('Aro_Widget_Layered_Nav');
        }
    }

    private function get_all_header_footer() {
        return [
            'home-1' => [
                'header' => [
                    [
                        'slug'                         => 'header-1',
                        'ehf_target_include_locations' => ['rule' => ['specifics'], 'specific' => ['post-44']],
                    ],
                    [
                        'slug'                         => 'header-5',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                        'ehf_target_exclude_locations' => ['rule' => ['product|all', 'special-woo-shop', 'product|all|archive', 'product|all|taxarchive|product_cat', 'product|all|taxarchive|product_tag', 'specifics'], 'specific' => ['post-44']],
                    ],
                    [
                        'slug'                         => 'header-8',
                        'ehf_target_include_locations' => ['rule' => ['product|all', 'special-woo-shop', 'product|all|archive', 'product|all|taxarchive|product_cat', 'product|all|taxarchive|product_tag', 'specifics'], 'specific' => []],
                    ]
                ],
                'footer' => [
                    [
                        'slug'                         => 'footer-1',
                        'ehf_target_include_locations' => ['rule' => ['specifics'], 'specific' => ['post-44']],
                    ],
                    [
                        'slug'                         => 'footer-5',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                        'ehf_target_exclude_locations' => ['rule' => ['specifics'], 'specific' => ['post-44']],
                    ]
                ]
            ],
            'home-2' => [
                'header' => [
                    [
                        'slug'                         => 'header-2',
                        'ehf_target_include_locations' => ['rule' => ['specifics'], 'specific' => ['post-46']],
                    ],
                    [
                        'slug'                         => 'header-9',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                        'ehf_target_exclude_locations' => ['rule' => ['specifics'], 'specific' => ['post-46']],
                    ]
                ],
                'footer' => [
                    [
                        'slug'                         => 'footer-2',
                        'ehf_target_include_locations' => ['rule' => ['specifics'], 'specific' => ['post-46']],
                    ],
                    [
                        'slug'                         => 'footer-5',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                        'ehf_target_exclude_locations' => ['rule' => ['specifics'], 'specific' => ['post-46']],
                    ]
                ]
            ],
            'home-3' => [
                'header' => [
                    [
                        'slug'                         => 'header-3',
                        'ehf_target_include_locations' => ['rule' => ['specifics'], 'specific' => ['post-50']],
                    ],
                    [
                        'slug'                         => 'header-5',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                        'ehf_target_exclude_locations' => ['rule' => ['product|all', 'special-woo-shop', 'product|all|archive', 'product|all|taxarchive|product_cat', 'product|all|taxarchive|product_tag', 'specifics'], 'specific' => ['post-50']],
                    ],
                    [
                        'slug'                         => 'header-8',
                        'ehf_target_include_locations' => ['rule' => ['product|all', 'special-woo-shop', 'product|all|archive', 'product|all|taxarchive|product_cat', 'product|all|taxarchive|product_tag', 'specifics'], 'specific' => []],
                    ]
                ],
                'footer' => [
                    [
                        'slug'                         => 'footer-3',
                        'ehf_target_include_locations' => ['rule' => ['specifics'], 'specific' => ['post-50']],
                    ],
                    [
                        'slug'                         => 'footer-5',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                        'ehf_target_exclude_locations' => ['rule' => ['specifics'], 'specific' => ['post-50']],
                    ]
                ]
            ],
            'home-4' => [
                'header' => [
                    [
                        'slug'                         => 'header-3',
                        'ehf_target_include_locations' => ['rule' => ['specifics'], 'specific' => ['post-52']],
                    ],
                    [
                        'slug'                         => 'header-5',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                        'ehf_target_exclude_locations' => ['rule' => ['product|all', 'special-woo-shop', 'product|all|archive', 'product|all|taxarchive|product_cat', 'product|all|taxarchive|product_tag', 'specifics'], 'specific' => ['post-52']],
                    ],
                    [
                        'slug'                         => 'header-8',
                        'ehf_target_include_locations' => ['rule' => ['product|all', 'special-woo-shop', 'product|all|archive', 'product|all|taxarchive|product_cat', 'product|all|taxarchive|product_tag', 'specifics'], 'specific' => []],
                    ]
                ],
                'footer' => [
                    [
                        'slug'                         => 'footer-1',
                        'ehf_target_include_locations' => ['rule' => ['specifics'], 'specific' => ['post-52']],
                    ],
                    [
                        'slug'                         => 'footer-5',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                        'ehf_target_exclude_locations' => ['rule' => ['specifics'], 'specific' => ['post-52']],
                    ]
                ]
            ],
            'home-5' => [
                'header' => [
                    [
                        'slug'                         => 'header-5',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                        'ehf_target_exclude_locations' => ['rule' => ['product|all', 'special-woo-shop', 'product|all|archive', 'product|all|taxarchive|product_cat', 'product|all|taxarchive|product_tag', 'specifics'], 'specific' => []],
                    ],
                    [
                        'slug'                         => 'header-8',
                        'ehf_target_include_locations' => ['rule' => ['product|all', 'special-woo-shop', 'product|all|archive', 'product|all|taxarchive|product_cat', 'product|all|taxarchive|product_tag', 'specifics'], 'specific' => []],
                    ]
                ],
                'footer' => [
                    [
                        'slug'                         => 'footer-4',
                        'ehf_target_include_locations' => ['rule' => ['specifics'], 'specific' => ['post-54']],
                    ],
                    [
                        'slug'                         => 'footer-5',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                        'ehf_target_exclude_locations' => ['rule' => ['specifics'], 'specific' => ['post-54']],
                    ]
                ]
            ],
            'home-6' => [
                'header' => [
                    [
                        'slug'                         => 'header-5',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                        'ehf_target_exclude_locations' => ['rule' => ['product|all', 'special-woo-shop', 'product|all|archive', 'product|all|taxarchive|product_cat', 'product|all|taxarchive|product_tag', 'specifics'], 'specific' => []],
                    ],
                    [
                        'slug'                         => 'header-8',
                        'ehf_target_include_locations' => ['rule' => ['product|all', 'special-woo-shop', 'product|all|archive', 'product|all|taxarchive|product_cat', 'product|all|taxarchive|product_tag', 'specifics'], 'specific' => []],
                    ]
                ],
                'footer' => [
                    [
                        'slug'                         => 'footer-4',
                        'ehf_target_include_locations' => ['rule' => ['specifics'], 'specific' => ['post-56']],
                    ],
                    [
                        'slug'                         => 'footer-5',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                        'ehf_target_exclude_locations' => ['rule' => ['specifics'], 'specific' => ['post-56']],
                    ]
                ]
            ],
            'home-7' => [
                'header' => [
                    [
                        'slug'                         => 'header-6',
                        'ehf_target_include_locations' => ['rule' => ['specifics'], 'specific' => ['post-58']],
                    ],
                    [
                        'slug'                         => 'header-5',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                        'ehf_target_exclude_locations' => ['rule' => ['product|all', 'special-woo-shop', 'product|all|archive', 'product|all|taxarchive|product_cat', 'product|all|taxarchive|product_tag', 'specifics'], 'specific' => ['post-58']],
                    ],
                    [
                        'slug'                         => 'header-8',
                        'ehf_target_include_locations' => ['rule' => ['product|all', 'special-woo-shop', 'product|all|archive', 'product|all|taxarchive|product_cat', 'product|all|taxarchive|product_tag', 'specifics'], 'specific' => []],
                    ]
                ],
                'footer' => [
                    [
                        'slug'                         => 'footer-4',
                        'ehf_target_include_locations' => ['rule' => ['specifics'], 'specific' => ['post-58']],
                    ],
                    [
                        'slug'                         => 'footer-5',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                        'ehf_target_exclude_locations' => ['rule' => ['specifics'], 'specific' => ['post-58']],
                    ]
                ]
            ],
            'home-8' => [
                'header' => [
                    [
                        'slug'                         => 'header-5',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                        'ehf_target_exclude_locations' => ['rule' => ['product|all', 'special-woo-shop', 'product|all|archive', 'product|all|taxarchive|product_cat', 'product|all|taxarchive|product_tag', 'specifics'], 'specific' => []],
                    ],
                    [
                        'slug'                         => 'header-8',
                        'ehf_target_include_locations' => ['rule' => ['product|all', 'special-woo-shop', 'product|all|archive', 'product|all|taxarchive|product_cat', 'product|all|taxarchive|product_tag', 'specifics'], 'specific' => []],
                    ]
                ],
                'footer' => [
                    [
                        'slug'                         => 'footer-3',
                        'ehf_target_include_locations' => ['rule' => ['specifics'], 'specific' => ['post-60']],
                    ],
                    [
                        'slug'                         => 'footer-5',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                        'ehf_target_exclude_locations' => ['rule' => ['specifics'], 'specific' => ['post-60']],
                    ]
                ]
            ],
            'home-9' => [
                'header' => [
                    [
                        'slug'                         => 'header-7',
                        'ehf_target_include_locations' => ['rule' => ['specifics'], 'specific' => ['post-62']],
                    ],
                    [
                        'slug'                         => 'header-5',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                        'ehf_target_exclude_locations' => ['rule' => ['product|all', 'special-woo-shop', 'product|all|archive', 'product|all|taxarchive|product_cat', 'product|all|taxarchive|product_tag', 'specifics'], 'specific' => ['post-62']],
                    ],
                    [
                        'slug'                         => 'header-8',
                        'ehf_target_include_locations' => ['rule' => ['product|all', 'special-woo-shop', 'product|all|archive', 'product|all|taxarchive|product_cat', 'product|all|taxarchive|product_tag', 'specifics'], 'specific' => []],
                    ]
                ],
                'footer' => [
                    [
                        'slug'                         => 'footer-5',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                        'ehf_target_exclude_locations' => ['rule' => ['specifics'], 'specific' => ['post-62']],
                    ]
                ]
            ],
        ];
    }

    private function reset_header_footer() {
        $footer_args = array(
            'post_type'      => 'elementor-hf',
            'posts_per_page' => -1,
            'meta_query'     => array(
                array(
                    'key'     => 'ehf_template_type',
                    'compare' => 'IN',
                    'value'   => ['type_footer', 'type_header']
                ),
            )
        );
        $footer      = new WP_Query($footer_args);
        while ($footer->have_posts()) : $footer->the_post();
            update_post_meta(get_the_ID(), 'ehf_target_include_locations', []);
            update_post_meta(get_the_ID(), 'ehf_target_exclude_locations', []);
        endwhile;
        wp_reset_postdata();
    }

    public function set_demo_menus() {
        $main_menu = get_term_by('name', 'Main Menu', 'nav_menu');

        set_theme_mod(
            'nav_menu_locations',
            array(
                'primary'  => $main_menu->term_id,
                'handheld' => $main_menu->term_id,
            )
        );
    }

    private function set_hf($home) {
        $all_hf = $this->get_all_header_footer();
        $datas  = $all_hf[$home];
        foreach ($datas as $item) {
            foreach ($item as $object) {
                $hf = get_page_by_path($object['slug'], OBJECT, 'elementor-hf');
                if ($hf) {
                    update_post_meta($hf->ID, 'ehf_target_include_locations', $object['ehf_target_include_locations']);
                    if (isset($object['ehf_target_exclude_locations'])) {
                        update_post_meta($hf->ID, 'ehf_target_exclude_locations', $object['ehf_target_exclude_locations']);
                    }
                }
            }
        }
    }

    public function render_child_functions_php() {
        $output
            = "<?php
/**
 * Theme functions and definitions.
 */
		 ";

        return $output;
    }

    public function get_all_options(){
        $options = [];
        $options['options']   = json_decode('{"aro_options_wocommerce_row_laptop":"2","aro_options_single_product_content_meta":"<ul class=\"list-items\">\n    <li>\n        <i aria-hidden=\"true\" class=\"aro-icon- aro-icon-comment\"></i>\n        <span>Free returns </span>\n    </li>\n    <li>\n        <i aria-hidden=\"true\" class=\"aro-icon- aro-icon-truck\"></i>\n        <span>Free shipping via DHL, fully insured All </span>\n    </li>\n    <li>\n        <i aria-hidden=\"true\" class=\"aro-icon- aro-icon-check-square\"></i>\n        <span>taxes and customs duties included</span>\n    </li>\n</ul>","aro_options_single_product_gallery_layout":"horizontal","aro_options_shop_banner":"banner-categories-image"}', true);
        $options['elementor']   = json_decode('{"system_colors":[{"_id":"primary","title":"Primary","color":"#DAA14C"},{"_id":"secondary","title":"Secondary(Heading)","color":"#30373E"},{"_id":"text","title":"Text","color":"#666666"},{"_id":"accent","title":"Accent","color":"#30373E"},{"_id":"lighter","title":"Lighter","color":"#888888"},{"_id":"dark","title":"Dark","color":"#202020"},{"_id":"highlight","title":"Highlight","color":"#cccccc"},{"_id":"border","title":"Border","color":"#E3E3E3"},{"_id":"background-light","title":"Background Light","color":"#F8F6F4"},{"_id":"background-field","title":"Background Field","color":"#DADADA20"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom"},{"_id":"secondary","title":"Secondary(Heading)","typography_typography":"custom"},{"_id":"text","title":"Text","typography_typography":"custom"},{"_id":"accent","title":"Accent","typography_typography":"custom"},{"_id":"special","title":"Special","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Aro","site_description":"Jewelry Store WordPress Theme","page_title_selector":"h1.entry-title","activeItemIndex":1,"active_breakpoints":["viewport_mobile","viewport_mobile_extra","viewport_tablet","viewport_tablet_extra","viewport_laptop"],"viewport_md":768,"viewport_lg":1025,"container_width":{"unit":"px","size":1290,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"body_background_background":"classic","body_background_color":"#fff"}', true);
        return $options;
    } // end get_all_options
}

return new Aro_Merlin_Config();
