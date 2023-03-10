<?php
/**
 * Aro WooCommerce hooks
 *
 * @package aro
 */

/**
 * Layout
 *
 * @see  aro_before_content()
 * @see  aro_after_content()
 * @see  woocommerce_breadcrumb()
 * @see  aro_shop_messages()
 */

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
//remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

add_action('hfe_header', 'aro_get_shop_banner', 95);
add_action('woocommerce_before_main_content', 'aro_before_content', 10);
add_action('woocommerce_after_main_content', 'aro_after_content', 10);

/**
 * Layout Archive
 * sorting
 */
add_action('woocommerce_before_shop_loop', 'aro_sorting_wrapper', 15);
add_action('woocommerce_before_shop_loop', 'aro_sorting_wrapper_close', 40);
add_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 15);
add_action('woocommerce_before_shop_loop', 'aro_button_shop_canvas', 20);
add_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 25);
//add_action('woocommerce_before_shop_loop', 'aro_products_per_page_select', 35);
add_action('woocommerce_before_shop_loop', 'aro_button_grid_list_layout', 30);

/**
 * Layout Single
 *
 */

//Wrapper content single
add_action('woocommerce_before_single_product_summary', 'aro_woocommerce_single_content_wrapper_start', 2);
add_action('woocommerce_single_product_summary', 'aro_woocommerce_single_content_wrapper_end', 99);

// single product summary
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
add_action('woocommerce_single_product_summary', 'aro_woocommerce_single_product_summary_left_start', 2);
add_action('woocommerce_single_product_summary', 'aro_single_product_summary_top', 3);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 9);
add_action('woocommerce_single_product_summary', 'aro_single_product_extra_label', 9);
add_action('woocommerce_single_product_summary', 'aro_stock_label', 10);

add_action('woocommerce_single_product_summary', 'aro_woocommerce_deal_progress', 26);
add_action('woocommerce_single_product_summary', 'aro_woocommerce_single_product_summary_left_end', 61);
add_action('woocommerce_single_product_summary', 'aro_single_product_extra', 25);


add_filter('woosc_button_position_single', '__return_false');
add_filter('woosw_button_position_single', '__return_false');

add_action('woocommerce_after_add_to_cart_button', 'aro_wishlist_button', 31);
add_action('woocommerce_after_add_to_cart_button', 'aro_compare_button', 32);

//style product single
add_filter('woocommerce_get_image_size_gallery_thumbnail', function ($size) {
    return array(
        'width'  => 100,
        'height' => 126,
        'crop'   => 1,
    );
});
$product_single_style = aro_get_theme_option('single_product_gallery_layout', 'horizontal');
add_theme_support('wc-product-gallery-lightbox');
if ($product_single_style === 'horizontal' || $product_single_style === 'vertical' || $product_single_style === 'sidebar') {
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-slider');
}
if ($product_single_style === 'sticky') {
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
    remove_action('woocommerce_single_product_summary', 'aro_single_product_extra', 70);
    add_action('woocommerce_single_product_summary', 'aro_output_product_data_accordion', 70);
    add_filter('woocommerce_single_product_image_thumbnail_html', 'aro_woocommerce_single_product_image_thumbnail_html', 10, 2);
}
if ($product_single_style === 'gallery') {
    add_filter('woocommerce_single_product_image_thumbnail_html', 'aro_woocommerce_single_product_image_thumbnail_html', 10, 2);
}

//Position label onsale
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
add_action('aro_single_product_video_360', 'woocommerce_show_product_sale_flash', 30);
add_action('aro_single_product_video_360', 'aro_single_product_video_360', 10);

/**
 * Product Search
 *
 * @see aro_ajax_search_result()
 */

add_action('pre_get_product_search_form', 'aro_ajax_search_result');
/**
 * Cart fragment
 *
 * @see aro_cart_link_fragment()
 */
add_filter('woocommerce_add_to_cart_fragments', 'aro_ajax_add_to_cart_add_fragments');

if (defined('WC_VERSION') && version_compare(WC_VERSION, '2.3', '>=')) {
    add_filter('woocommerce_add_to_cart_fragments', 'aro_cart_link_fragment');
} else {
    add_filter('add_to_cart_fragments', 'aro_cart_link_fragment');
}

remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
add_action('woocommerce_after_cart', 'woocommerce_cross_sell_display');

add_action('woocommerce_checkout_order_review', 'woocommerce_checkout_order_review_start', 5);
add_action('woocommerce_checkout_order_review', 'woocommerce_checkout_order_review_end', 15);

add_filter('woocommerce_get_script_data', function ($params, $handle) {
    if ($handle == "wc-add-to-cart") {
        $params['i18n_view_cart'] = '';
    }
    return $params;
}, 10, 2);

/**
 * Layout Product
 *
 **/

add_filter('woosc_button_position_archive', '__return_false');
add_filter('woosq_button_position', '__return_false');
add_filter('woosw_button_position_archive', '__return_false');

function aro_include_hooks_product_blocks() {
//    // Remove product content link
    remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

    add_action('woocommerce_before_shop_loop_item', 'aro_product_block_wrapper_start', 0);
    add_action('woocommerce_after_shop_loop_item', 'aro_product_block_wrapper_close', 99);
    add_action('woocommerce_before_shop_loop_item', 'aro_product_transition_wrapper_start', 10);
    add_action('woocommerce_before_shop_loop_item_title', 'aro_product_block_wrapper_close', 99);
    add_action('woocommerce_before_shop_loop_item_title', 'aro_woocommerce_product_loop_action_start', 20);
    add_action('woocommerce_before_shop_loop_item_title', 'aro_woocommerce_product_loop_action_close', 30);
    add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 25);
    add_action('woocommerce_before_shop_loop_item_title', 'aro_wishlist_button', 26);
    add_action('woocommerce_before_shop_loop_item_title', 'aro_compare_button', 27);
    add_action('woocommerce_before_shop_loop_item_title', 'aro_quickview_button', 28);
    add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 50);
    add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 50);
    add_action('woocommerce_shop_loop_item_title', 'aro_product_caption_wrapper_start', 0);
    add_action('woocommerce_after_shop_loop_item_title', 'aro_product_caption_wrapper_close', 99);
    add_action('woocommerce_shop_loop_item_title', 'aro_woocommerce_get_product_category', 5);
    add_action('woocommerce_shop_loop_item_title', 'aro_single_product_extra_label', 15);
}

if (isset($_GET['action']) && $_GET['action'] === 'elementor') {
    return;
}
aro_include_hooks_product_blocks();
