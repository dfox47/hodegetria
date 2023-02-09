<?php
$theme       = wp_get_theme('aro');
$aro_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if (!isset($content_width)) {
	$content_width = 980; /* pixels */
}
require get_theme_file_path('inc/class-tgm-plugin-activation.php');
$aro = (object)array(
	'version' => $aro_version,
	/**
	 * Initialize all the things.
	 */
	'main'    => require 'inc/class-main.php',
);

require get_theme_file_path('inc/functions.php');
require get_theme_file_path('inc/template-hooks.php');
require get_theme_file_path('inc/template-functions.php');

require_once get_theme_file_path('inc/merlin/vendor/autoload.php');
require_once get_theme_file_path('inc/merlin/class-merlin.php');
require_once get_theme_file_path('inc/merlin-config.php');

require_once get_theme_file_path('inc/class-customize.php');
require get_theme_file_path('inc/merlin/includes/class-age-verification.php');

if (aro_is_woocommerce_activated()) {
	$aro->woocommerce = require get_theme_file_path('inc/woocommerce/class-woocommerce.php');

	require get_theme_file_path('inc/woocommerce/class-woocommerce-adjacent-products.php');
	require get_theme_file_path('inc/woocommerce/woocommerce-functions.php');
	require get_theme_file_path('inc/woocommerce/woocommerce-template-functions.php');
	require get_theme_file_path('inc/woocommerce/woocommerce-template-hooks.php');
	require get_theme_file_path('inc/woocommerce/template-hooks.php');
	require get_theme_file_path('inc/woocommerce/class-woocommerce-settings.php');
	require get_theme_file_path('inc/woocommerce/class-woocommerce-brand.php');
	require get_theme_file_path('inc/woocommerce/class-woocommerce-extra.php');
	require get_theme_file_path('inc/merlin/includes/class-wc-widget-product-brands.php');
}

if (aro_is_elementor_activated()) {
	require get_theme_file_path('inc/elementor/functions-elementor.php');
	$aro->elementor = require get_theme_file_path('inc/elementor/class-elementor.php');
	//====start_premium
	$aro->megamenu = require get_theme_file_path('inc/megamenu/megamenu.php');
	//====end_premium
	$aro->parallax = require get_theme_file_path('inc/elementor/class-section-parallax.php');

	if (defined('ELEMENTOR_PRO_VERSION')) {
		require get_theme_file_path('inc/elementor/functions-elementor-pro.php');
	}

	if (function_exists('hfe_init')) {
		require get_theme_file_path('inc/header-footer-elementor/class-hfe.php');
		require get_theme_file_path('inc/merlin/includes/breadcrumb.php');
		require get_theme_file_path('inc/merlin/includes/class-custom-shapes.php');
	}

	if (aro_is_woocommerce_activated()) {
		require_once get_theme_file_path('inc/elementor/elementor-control/class-elementor-control.php');
	}
}

if (!is_user_logged_in()) {
	require get_theme_file_path('inc/modules/class-login.php');
}


// checkout privacy policy [START]
add_action('woocommerce_review_order_before_submit', 'add_privacy_checkbox', 9);

function add_privacy_checkbox() {
	woocommerce_form_field( 'privacy_policy', array(
		'type' => 'checkbox',
		'class' => array('form-row privacy'),
		'label_class' => array('woocommerce-form__label woocommerce-form__label-for-checkbox checkbox'),
		'input_class' => array('woocommerce-form__input woocommerce-form__input-checkbox input-checkbox'),
		'required' => true,
		'label' => 'Прочетох и съм съгласен с <a href="/privacy-policy-2/">политиката на поверителност.</a>',
	));
}

add_action('woocommerce_checkout_process', 'privacy_checkbox_error_message');

function privacy_checkbox_error_message() {
	if ( ! (int) isset( $_POST['privacy_policy'] ) ) {
		wc_add_notice(__('Трябва да се съгласите с нашата политика за поверителност, за да продължите'), 'error');
	}
}
// checkout privacy policy [END]