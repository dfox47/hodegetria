<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

if ($upsells) :
    $class = 'aro-theme-carousel';
    $number = count($upsells);
    $items = wc_get_loop_prop('columns');
    if (aro_is_elementor_activated()) {
        $breakpoints = \Elementor\Plugin::$instance->breakpoints->get_breakpoints();
    }

    $laptop = aro_get_theme_option('wocommerce_row_laptop');
    $tablet = aro_get_theme_option('wocommerce_row_tablet');
    $mobile = aro_get_theme_option('wocommerce_row_mobile');

    $settings = array(
        'navigation'         => 'dots',
        'items'              => $number,
        'items_laptop'       => $laptop,
        'items_tablet_extra' => $tablet,
        'items_tablet'       => $tablet,
        'items_mobile_extra' => $tablet,
        'items_mobile'       => $mobile,
    );
    ?>

    <section class="up-sells upsells products">
        <?php
        $heading = apply_filters('woocommerce_product_upsells_products_heading', __('You may also like&hellip;', 'aro'));

        if ($heading) :
            ?>
            <h2><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <div class="woocommerce <?php echo esc_attr($class); ?>" data-settings="<?php echo esc_attr(wp_json_encode($settings)) ?>">
            <?php woocommerce_product_loop_start(); ?>

            <?php foreach ($upsells as $upsell) : ?>

                <?php
                $post_object = get_post($upsell->get_id());

                setup_postdata($GLOBALS['post'] =& $post_object); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

                wc_get_template_part('content', 'product');
                ?>

            <?php endforeach; ?>

            <?php woocommerce_product_loop_end(); ?>
        </div>
    </section>

<?php
endif;

wp_reset_postdata();
