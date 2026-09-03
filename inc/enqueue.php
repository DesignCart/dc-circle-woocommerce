<?php
/**
 * Asset loading.
 *
 * @package dc-circle
 * @author Paweł Nosko
 * @copyright 2026 Design Cart
 * @license GPL-2.0-or-later
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue theme scripts and styles.
 */
function dc_circle_enqueue_assets() {
	$theme_version = wp_get_theme()->get( 'Version' );
	$template_uri  = get_template_directory_uri();
	$deps            = array( 'dc-circle-fonts' );

	wp_enqueue_style( 'dc-circle-fonts', $template_uri . '/assets/css/fonts.css', array(), $theme_version );
	wp_enqueue_style( 'dc-circle-bootstrap', $template_uri . '/assets/vendor/bootstrap/bootstrap.min.css', $deps, '5.3.3' );
	wp_enqueue_script( 'dc-circle-bootstrap', $template_uri . '/assets/vendor/bootstrap/bootstrap.bundle.min.js', array(), '5.3.3', true );
	wp_enqueue_style( 'dc-circle-fontawesome', $template_uri . '/assets/fontawesome/css/all.min.css', array(), '6.5.0' );

	wp_enqueue_style( 'dc-circle-style', get_stylesheet_uri(), array( 'dc-circle-bootstrap' ), $theme_version );
	$deps[] = 'dc-circle-style';

	$css_files = array(
		'dc-circle-header-top'      => '/assets/css/header_top.css',
		'dc-circle-header'          => '/assets/css/header.css',
		'dc-circle-header-baner'    => '/assets/css/header_baner.css',
		'dc-circle-header-search'   => '/assets/css/header_search.css',
		'dc-circle-header-menu'     => '/assets/css/header_menu.css',
		'dc-circle-header-mobile'   => '/assets/css/header_menu_mobile.css',
		'dc-circle-header-slidecart'=> '/assets/css/header_slidecart.css',
		'dc-circle-products-carousel' => '/assets/css/products_carousel.css',
		'dc-circle-forms'           => '/assets/css/forms.css',
		'dc-circle-footer'          => '/assets/css/footer.css',
		'dc-circle-product-card'    => '/assets/css/product_card.css',
		'dc-circle-woocommerce'     => '/assets/css/woocommerce.css',
		'dc-circle-blog'            => '/assets/css/blog.css',
		'dc-circle-pages'           => '/assets/css/pages.css',
	);

	foreach ( $css_files as $handle => $path ) {
		wp_enqueue_style( $handle, $template_uri . $path, $deps, $theme_version );
	}

	if ( is_front_page() ) {
		wp_enqueue_style( 'dc-circle-home', $template_uri . '/assets/css/home.css', $deps, $theme_version );
	}

	wp_enqueue_style( 'dc-circle-owl-carousel', $template_uri . '/assets/css/owl.carousel.min.css', array(), '2.3.4' );
	wp_enqueue_script( 'dc-circle-owl-carousel', $template_uri . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '2.3.4', true );

	wp_enqueue_script( 'dc-circle-theme', $template_uri . '/assets/js/dc-theme.js', array( 'jquery' ), $theme_version, true );

	if ( class_exists( 'WooCommerce' ) ) {
		wp_enqueue_script( 'dc-circle-slidecart', $template_uri . '/assets/js/dc-slidecart.js', array( 'jquery' ), $theme_version, true );
		wp_enqueue_script( 'dc-circle-woocommerce', $template_uri . '/assets/js/woocommerce.js', array( 'jquery' ), $theme_version, true );
		wp_enqueue_script(
			'dc-circle-products-carousel',
			$template_uri . '/assets/js/dc-products-carousel.js',
			array( 'jquery', 'dc-circle-owl-carousel' ),
			$theme_version,
			true
		);

		wp_localize_script(
			'dc-circle-slidecart',
			'dcCircleCart',
			array(
				'ajaxUrl'          => admin_url( 'admin-ajax.php' ),
				'nonce'            => wp_create_nonce( 'dc_circle_cart' ),
				'cartUpdateFailed' => __( 'Could not update the cart.', 'dc-circle' ),
				'cartUpdateError'  => __( 'An error occurred while updating the cart.', 'dc-circle' ),
			)
		);
	}

	if ( function_exists( 'is_product' ) && is_product() ) {
		wp_enqueue_style( 'dc-circle-swiper', $template_uri . '/assets/vendor/swiper/swiper-bundle.min.css', array(), '11.0.0' );
		wp_enqueue_script( 'dc-circle-swiper', $template_uri . '/assets/vendor/swiper/swiper-bundle.min.js', array(), '11.0.0', true );
		wp_enqueue_script(
			'dc-circle-swiper-gallery',
			$template_uri . '/assets/js/dc-swiper-gallery.js',
			array( 'dc-circle-swiper' ),
			$theme_version,
			true
		);
	}
}
add_action( 'wp_enqueue_scripts', 'dc_circle_enqueue_assets' );
