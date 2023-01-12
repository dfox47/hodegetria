<?php
/**
 * =================================================
 * Hook aro_page
 * =================================================
 */
add_action('aro_page', 'aro_page_header', 10);
add_action('aro_page', 'aro_page_content', 20);

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
add_action('aro_single_post', 'aro_post_thumbnail', 10);
add_action('aro_single_post', 'aro_post_header', 20);
add_action('aro_single_post', 'aro_post_content', 30);

/**
 * =================================================
 * Hook aro_single_post_bottom
 * =================================================
 */
add_action('aro_single_post_bottom', 'aro_post_taxonomy', 5);
add_action('aro_single_post_bottom', 'aro_post_nav', 10);
add_action('aro_single_post_bottom', 'aro_display_comments', 20);

/**
 * =================================================
 * Hook aro_loop_post
 * =================================================
 */
add_action('aro_loop_post', 'aro_post_header', 15);
add_action('aro_loop_post', 'aro_post_content', 30);

/**
 * =================================================
 * Hook aro_footer
 * =================================================
 */
add_action('aro_footer', 'aro_footer_default', 20);

/**
 * =================================================
 * Hook aro_after_footer
 * =================================================
 */

/**
 * =================================================
 * Hook wp_footer
 * =================================================
 */
add_action('wp_footer', 'aro_template_account_dropdown', 1);
add_action('wp_footer', 'aro_mobile_nav', 1);

/**
 * =================================================
 * Hook wp_head
 * =================================================
 */
add_action('wp_head', 'aro_pingback_header', 1);

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
add_action('aro_sidebar', 'aro_get_sidebar', 10);

/**
 * =================================================
 * Hook aro_loop_after
 * =================================================
 */
add_action('aro_loop_after', 'aro_paging_nav', 10);

/**
 * =================================================
 * Hook aro_page_after
 * =================================================
 */
add_action('aro_page_after', 'aro_display_comments', 10);

/**
 * =================================================
 * Hook aro_woocommerce_list_item_title
 * =================================================
 */

/**
 * =================================================
 * Hook aro_woocommerce_list_item_content
 * =================================================
 */

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

/**
 * =================================================
 * Hook aro_woocommerce_shop_loop_item_caption
 * =================================================
 */

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

/**
 * =================================================
 * Hook aro_product_list_content
 * =================================================
 */

/**
 * =================================================
 * Hook aro_product_list_end
 * =================================================
 */
