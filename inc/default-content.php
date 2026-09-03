<?php
/**
 * Default demo content on first theme activation.
 *
 * @package dc-circle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Current default content schema version.
 */
define( 'DC_CIRCLE_DEFAULT_CONTENT_VERSION', 1 );

/**
 * Register default content hooks.
 */
function dc_circle_default_content_hooks() {
	add_action( 'after_switch_theme', 'dc_circle_maybe_install_default_content' );
	add_action( 'init', 'dc_circle_maybe_install_default_content', 20 );
}
add_action( 'after_setup_theme', 'dc_circle_default_content_hooks' );

/**
 * Install demo widgets and menus once per site.
 */
function dc_circle_maybe_install_default_content() {
	if ( (int) get_option( 'dc_circle_default_content_version', 0 ) >= DC_CIRCLE_DEFAULT_CONTENT_VERSION ) {
		return;
	}

	dc_circle_install_footer_widgets();
	dc_circle_install_footer_menu();

	update_option( 'dc_circle_default_content_version', DC_CIRCLE_DEFAULT_CONTENT_VERSION );
}

/**
 * Check whether a sidebar has no active widgets.
 *
 * @param string $sidebar_id Sidebar ID.
 * @return bool
 */
function dc_circle_sidebar_is_empty( $sidebar_id ) {
	$sidebars = wp_get_sidebars_widgets();

	return empty( $sidebars[ $sidebar_id ] );
}

/**
 * Get the next numeric widget instance ID.
 *
 * @param string $option_name Widget option name.
 * @return int
 */
function dc_circle_get_next_widget_instance_id( $option_name ) {
	$widgets = get_option( $option_name, array() );
	$max_id  = 0;

	foreach ( $widgets as $key => $value ) {
		if ( is_numeric( $key ) ) {
			$max_id = max( $max_id, (int) $key );
		}
	}

	return $max_id + 1;
}

/**
 * Create a block widget and return its sidebar ID.
 *
 * @param string $content Block markup.
 * @return string
 */
function dc_circle_create_block_widget( $content ) {
	$widgets = get_option( 'widget_block', array() );
	$id      = dc_circle_get_next_widget_instance_id( 'widget_block' );

	$widgets[ $id ]              = array( 'content' => $content );
	$widgets['_multiwidget']     = 1;

	update_option( 'widget_block', $widgets );

	return 'block-' . $id;
}

/**
 * Assign widget IDs to a sidebar.
 *
 * @param string $sidebar_id Sidebar ID.
 * @param array  $widget_ids Widget IDs.
 */
function dc_circle_assign_widgets_to_sidebar( $sidebar_id, array $widget_ids ) {
	$sidebars = wp_get_sidebars_widgets();

	if ( ! is_array( $sidebars ) ) {
		$sidebars = array();
	}

	$sidebars[ $sidebar_id ] = $widget_ids;

	wp_set_sidebars_widgets( $sidebars );
}

/**
 * Install default footer block widgets.
 */
function dc_circle_install_footer_widgets() {
	if (
		! dc_circle_sidebar_is_empty( 'footer-1' )
		&& ! dc_circle_sidebar_is_empty( 'footer-2' )
		&& ! dc_circle_sidebar_is_empty( 'footer-3' )
	) {
		return;
	}

	$logo_url = esc_url( get_template_directory_uri() . '/assets/images/demo/logo-white.png' );

	if ( dc_circle_sidebar_is_empty( 'footer-1' ) ) {
		$about = dc_circle_create_block_widget(
			'<!-- wp:image {"sizeSlug":"medium","linkDestination":"none"} -->'
			. '<figure class="wp-block-image size-medium"><img src="' . $logo_url . '" alt="' . esc_attr__( 'DC Circle', 'dc-circle' ) . '"/></figure>'
			. '<!-- /wp:image -->'
			. '<!-- wp:paragraph -->'
			. '<p>' . esc_html__( 'DC Circle is a free WooCommerce theme by Design Cart. Customize colors, banners, and product sliders to launch a modern online store quickly.', 'dc-circle' ) . '</p>'
			. '<!-- /wp:paragraph -->'
		);

		dc_circle_assign_widgets_to_sidebar( 'footer-1', array( $about ) );
	}

	if ( dc_circle_sidebar_is_empty( 'footer-2' ) ) {
		$contact = dc_circle_create_block_widget(
			'<!-- wp:heading {"level":4} -->'
			. '<h4 class="wp-block-heading">' . esc_html__( 'Contact', 'dc-circle' ) . '</h4>'
			. '<!-- /wp:heading -->'
			. '<!-- wp:paragraph -->'
			. '<p><strong>' . esc_html__( 'DC Circle Demo Store', 'dc-circle' ) . '</strong><br>'
			. esc_html__( '123 Commerce Street', 'dc-circle' ) . '<br>'
			. esc_html__( 'New York, NY 10001, USA', 'dc-circle' ) . '<br>'
			. esc_html__( 'Phone:', 'dc-circle' ) . ' +1 (555) 123-4567<br>'
			. esc_html__( 'Email:', 'dc-circle' ) . ' hello@example.com<br>'
			. esc_html__( 'Hours: Mon–Fri 9:00 AM–5:00 PM', 'dc-circle' ) . '</p>'
			. '<!-- /wp:paragraph -->'
		);

		dc_circle_assign_widgets_to_sidebar( 'footer-2', array( $contact ) );
	}

	if ( dc_circle_sidebar_is_empty( 'footer-3' ) ) {
		$payments = dc_circle_create_block_widget(
			'<!-- wp:heading {"level":4} -->'
			. '<h4 class="wp-block-heading">' . esc_html__( 'We accept', 'dc-circle' ) . '</h4>'
			. '<!-- /wp:heading -->'
			. '<!-- wp:paragraph -->'
			. '<p>' . esc_html__( 'Visa, Mastercard, PayPal, Apple Pay, and Google Pay.', 'dc-circle' ) . '</p>'
			. '<!-- /wp:paragraph -->'
		);

		dc_circle_assign_widgets_to_sidebar( 'footer-3', array( $payments ) );
	}
}

/**
 * Install a default footer navigation menu.
 */
function dc_circle_install_footer_menu() {
	$locations = get_theme_mod( 'nav_menu_locations', array() );

	if ( ! empty( $locations['footer_menu'] ) ) {
		return;
	}

	$menu_id = wp_create_nav_menu( __( 'Footer Menu', 'dc-circle' ) );

	if ( is_wp_error( $menu_id ) ) {
		return;
	}

	$shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
	$account_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'myaccount' ) : home_url( '/my-account/' );
	$cart_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'cart' ) : home_url( '/cart/' );

	$items = array(
		array(
			'title' => __( 'Shop', 'dc-circle' ),
			'url'   => $shop_url ? $shop_url : home_url( '/' ),
		),
		array(
			'title' => __( 'My account', 'dc-circle' ),
			'url'   => $account_url ? $account_url : home_url( '/' ),
		),
		array(
			'title' => __( 'Cart', 'dc-circle' ),
			'url'   => $cart_url ? $cart_url : home_url( '/' ),
		),
		array(
			'title' => __( 'Contact', 'dc-circle' ),
			'url'   => home_url( '/contact/' ),
		),
	);

	foreach ( $items as $item ) {
		wp_update_nav_menu_item(
			$menu_id,
			0,
			array(
				'menu-item-title'  => $item['title'],
				'menu-item-url'    => $item['url'],
				'menu-item-status' => 'publish',
			)
		);
	}

	$locations['footer_menu'] = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );
}
