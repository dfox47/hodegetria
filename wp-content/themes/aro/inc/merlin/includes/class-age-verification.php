<?php

namespace Aro\Aro_Age_Verification;

class Aro_Age_Verification {
    private static $_instance = null;

    public static function instance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Constructor
     */
    private function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'), 10);
        add_action('wp_footer', array($this, 'aro_avpublic_js'));
    }

    public function enqueue_scripts() {
        global $aro_version;
        if ('1' == get_theme_mod('aro_Enable')) {
            wp_enqueue_script('aro-age-verification-cookie', get_template_directory_uri() . '/assets/js/frontend/js.cookie.js', array('jquery'), $aro_version, false);
            wp_enqueue_script('age-verification', get_template_directory_uri() . '/assets/js/frontend/age-verification.js', array('jquery'), $aro_version, false);
        }
    }

    function aro_avpublic_js() {
        $landing = apply_filters('aro_landing_id', '');
        // Empty redirect.
        $redirect_fail = '';

        // Set the redirect URL.
        $redirectOnFail = esc_url(apply_filters('aro_avredirect_on_fail_link', $redirect_fail));

        // Add content before popup contents.
        $beforeContent = apply_filters('aro_avbefore_popup_content', '');

        // Add content after popup contents.
        $afterContent = apply_filters('aro_avafter_popup_content', '');

        // Add JavaScript codes to footer based on setting in the Customizer.

        if ('1' != get_theme_mod('aro_Enable') || ('1' === get_theme_mod('aro_adminHide') && current_user_can('administrator')) || $landing === get_queried_object_id()) {
            // Do nothing.
        } else { ?>
            <script type="text/javascript">
                jQuery(document).ready(function ($) {
                    $.aroageCheck({
                        "bgImage": '<?php echo get_theme_mod('aro_bgImage', '') ?>',
                        "minAge": '<?php echo get_theme_mod('aro_minAge', '18')?>',
                        "imgLogo": '<?php echo get_theme_mod('aro_logo', '')?>',
                        "title": '<?php echo get_theme_mod('aro_title', '')?>',
                        "description": '<?php echo get_theme_mod('aro_description', '')?>',
                        "copy": '<?php echo get_theme_mod('aro_copy', esc_attr__('You must be [age] years old to enter.', 'aro'))?>',
                        'btnYes': '<?php  echo get_theme_mod('aro_button_yes', esc_attr__('YES', 'aro'))?>',
                        'btnNo': '<?php echo get_theme_mod('aro_button_no', esc_attr__('NO', 'aro'))?>',
                        "successTitle": '<?php echo esc_attr__('Success!', 'aro')?>',
                        "successText": '<?php echo esc_attr__('You are now being redirected back to the site ...', 'aro')?>',
                        "successMessage": '<?php echo get_theme_mod('aro_success_message', 'show')?>',
                        "failTitle": '<?php echo esc_attr__('Sorry!', 'aro')?>',
                        "failText": '<?php echo esc_attr__('You are not old enough to view the site ...', 'aro')?>',
                        "messageTime": '<?php echo get_theme_mod('aro_message_display_time', '2000')?>',
                        "cookieDays": '<?php echo get_theme_mod('aro_cookie_days', '30')?>',
                        "redirectOnFail": '<?php echo $redirectOnFail?>',
                        "beforeContent": '<?php echo $beforeContent?>',
                        "afterContent": '<?php echo $afterContent?>'
                    });
                });
            </script>
            <?php
        } // end adminHide check.
    }

}

Aro_Age_Verification::instance();