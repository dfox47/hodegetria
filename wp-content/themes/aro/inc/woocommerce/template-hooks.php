<?php
/**
 * =================================================
 * Hook aro_page
 * =================================================
 */

/**
 * =================================================
 * Hook aro_single_post_top
 * =================================================
 */

/**
 * =================================================
 * Hook aro_single_post
 * =================================================
 */

/**
 * =================================================
 * Hook aro_single_post_bottom
 * =================================================
 */

/**
 * =================================================
 * Hook aro_loop_post
 * =================================================
 */

/**
 * =================================================
 * Hook aro_footer
 * =================================================
 */

/**
 * =================================================
 * Hook aro_after_footer
 * =================================================
 */
add_action('aro_after_footer', 'aro_sticky_single_add_to_cart', 999);

/**
 * =================================================
 * Hook wp_footer
 * =================================================
 */
add_action('wp_footer', 'aro_render_woocommerce_shop_canvas', 1);

/**
 * =================================================
 * Hook wp_head
 * =================================================
 */

/**
 * =================================================
 * Hook aro_before_header
 * =================================================
 */

/**
 * =================================================
 * Hook aro_before_content
 * =================================================
 */

/**
 * =================================================
 * Hook aro_content_top
 * =================================================
 */
add_action('aro_content_top', 'aro_shop_messages', 10);

/**
 * =================================================
 * Hook aro_post_content_before
 * =================================================
 */

/**
 * =================================================
 * Hook aro_post_content_after
 * =================================================
 */

/**
 * =================================================
 * Hook aro_sidebar
 * =================================================
 */

/**
 * =================================================
 * Hook aro_loop_after
 * =================================================
 */

/**
 * =================================================
 * Hook aro_page_after
 * =================================================
 */

/**
 * =================================================
 * Hook aro_woocommerce_list_item_title
 * =================================================
 */
add_action('aro_woocommerce_list_item_title', 'aro_product_label', 5);
add_action('aro_woocommerce_list_item_title', 'aro_woocommerce_product_list_image', 10);

/**
 * =================================================
 * Hook aro_woocommerce_list_item_content
 * =================================================
 */
add_action('aro_woocommerce_list_item_content', 'woocommerce_template_loop_product_title', 10);
add_action('aro_woocommerce_list_item_content', 'woocommerce_template_loop_rating', 15);
add_action('aro_woocommerce_list_item_content', 'woocommerce_template_loop_price', 20);
add_action('aro_woocommerce_list_item_content', 'aro_stock_label', 25);

/**
 * =================================================
 * Hook aro_woocommerce_before_shop_loop_item
 * =================================================
 */

/**
 * =================================================
 * Hook aro_woocommerce_before_shop_loop_item_image
 * =================================================
 */
add_action('aro_woocommerce_before_shop_loop_item_image', 'aro_product_label', 10);
add_action('aro_woocommerce_before_shop_loop_item_image', 'woocommerce_template_loop_product_thumbnail', 15);
add_action('aro_woocommerce_before_shop_loop_item_image', 'aro_woocommerce_product_loop_action_start', 20);
add_action('aro_woocommerce_before_shop_loop_item_image', 'aro_quickview_button', 30);
add_action('aro_woocommerce_before_shop_loop_item_image', 'aro_woocommerce_product_loop_action_close', 40);

/**
 * =================================================
 * Hook aro_woocommerce_shop_loop_item_caption
 * =================================================
 */
add_action('aro_woocommerce_shop_loop_item_caption', 'aro_woocommerce_get_product_category', 5);
add_action('aro_woocommerce_shop_loop_item_caption', 'woocommerce_template_loop_product_title', 10);
add_action('aro_woocommerce_shop_loop_item_caption', 'aro_single_product_extra_label', 15);
add_action('aro_woocommerce_shop_loop_item_caption', 'woocommerce_template_loop_price', 20);
add_action('aro_woocommerce_shop_loop_item_caption', 'aro_woocommerce_get_product_description', 25);
add_action('aro_woocommerce_shop_loop_item_caption', 'woocommerce_template_loop_add_to_cart', 30);
add_action('aro_woocommerce_shop_loop_item_caption', 'aro_wishlist_button', 35);
add_action('aro_woocommerce_shop_loop_item_caption', 'aro_compare_button', 35);

/**
 * =================================================
 * Hook aro_woocommerce_after_shop_loop_item
 * =================================================
 */

/**
 * =================================================
 * Hook aro_product_list_start
 * =================================================
 */

/**
 * =================================================
 * Hook aro_product_list_image
 * =================================================
 */
add_action('aro_product_list_image', 'aro_woocommerce_product_list_image', 10);

/**
 * =================================================
 * Hook aro_product_list_content
 * =================================================
 */
add_action('aro_product_list_content', 'woocommerce_template_loop_product_title', 10);
add_action('aro_product_list_content', 'aro_single_product_extra_label', 15);
add_action('aro_product_list_content', 'woocommerce_template_loop_price', 20);

/**
 * =================================================
 * Hook aro_product_list_end
 * =================================================
 */
