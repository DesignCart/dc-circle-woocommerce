<?php
/**
 * Theme bootstrap.
 *
 * @package dc-circle
 * @author Paweł Nosko
 * @copyright 2026 Design Cart
 * @license GPL-2.0-or-later
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require get_template_directory() . '/inc/setup.php';
require get_template_directory() . '/inc/default-content.php';
require get_template_directory() . '/inc/enqueue.php';
require get_template_directory() . '/inc/theme-options.php';
require get_template_directory() . '/inc/dynamic-css.php';
require get_template_directory() . '/inc/helpers.php';
require get_template_directory() . '/inc/blocks.php';

if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
