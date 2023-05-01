
</div><!-- .col-full -->
</div><!-- #content -->

<ul class="footer_mobile">
	<li class="footer_mobile__item">
		<a class="footer_mobile__link button-search-popup" href="javascript:void(0);">
			<i class="aro-icon-search"></i>
			<span class="footer_mobile__desc">Търсене</span>
		</a>
	</li>

	<li class="footer_mobile__item">
		<a class="footer_mobile__link" href="/my-account/">
			<i class="aro-icon- aro-icon-account"></i>
			<span class="footer_mobile__desc">Account</span>
		</a>
	</li>

	<li class="footer_mobile__item">
		<a class="footer_mobile__link" href="/cart/">
			<i aria-hidden="true" class="aro-icon- aro-icon-cart"></i>
			<span class="footer_mobile__desc">Cart</span>
		</a>
	</li>
</ul>

<?php do_action( 'aro_before_footer' );
if (aro_is_elementor_activated() && function_exists('hfe_init') && (hfe_footer_enabled() || hfe_is_before_footer_enabled())) {
	do_action('hfe_footer_before');
	do_action('hfe_footer');
}
else { ?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php
		/**
		 * Functions hooked in to aro_footer action
		 *
		 * @see aro_footer_default - 20
		 *
		 *
		 */
		do_action('aro_footer'); ?>
	</footer>
<?php }

/**
 * Functions hooked in to aro_after_footer action
 * @see aro_sticky_single_add_to_cart 	- 999 - woo
 */
do_action( 'aro_after_footer' ); ?>

</div><!-- #page -->

<?php

/**
 * Functions hooked in to wp_footer action
 * @see aro_template_account_dropdown 	- 1
 * @see aro_mobile_nav - 1
 * @see aro_render_woocommerce_shop_canvas - 1 - woo
 */

wp_footer(); ?>

<script src="/wp-content/themes/aro/assets/js/custom.js?v<?php echo(date("Ymd")); ?>"></script>

<!-- Google tag (gtag.js) -->
<script async src="//www.googletagmanager.com/gtag/js?id=G-HE2ZNXP2NJ"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'G-HE2ZNXP2NJ');
</script>

</body>
</html>