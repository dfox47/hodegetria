<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
	<link rel="profile" href="//gmpg.org/xfn/11">

	<?php // favicon
	include_once 'template-parts/favicon.php'; ?>

	<?php // Functions hooked in to wp_head action
	// @see aro_pingback_header - 1

	wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php do_action('aro_before_site'); ?>

<div id="page" class="hfeed site">
	<?php // Functions hooked in to aro_before_header action
	do_action('aro_before_header');

	if (aro_is_elementor_activated() && function_exists('hfe_init') && hfe_header_enabled()) {
		do_action('hfe_header');
	}
	else {
		get_template_part('template-parts/header/header-1');
	}

	// Functions hooked in to aro_before_content action
	do_action('aro_before_content'); ?>

	<div id="content" class="site-content" tabindex="-1">
		<div class="col-full">

<?php // Functions hooked in to aro_content_top action
// @see aro_shop_messages - 10 - woo
do_action('aro_content_top');