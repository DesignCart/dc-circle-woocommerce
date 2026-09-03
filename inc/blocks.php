<?php
/**
 * Block styles and patterns.
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
 * Register block styles.
 */
function dc_circle_register_block_styles() {
	register_block_style(
		'core/paragraph',
		array(
			'name'  => 'dc-lead',
			'label' => __( 'Lead text', 'dc-circle' ),
		)
	);

	register_block_style(
		'core/button',
		array(
			'name'  => 'dc-button',
			'label' => __( 'DC Circle button', 'dc-circle' ),
		)
	);

	register_block_style(
		'core/group',
		array(
			'name'  => 'dc-card',
			'label' => __( 'Soft card', 'dc-circle' ),
		)
	);
}
add_action( 'init', 'dc_circle_register_block_styles' );

/**
 * Register block patterns.
 */
function dc_circle_register_block_patterns() {
	register_block_pattern_category(
		'dc-circle',
		array(
			'label' => __( 'DC Circle', 'dc-circle' ),
		)
	);

	register_block_pattern(
		'dc-circle/intro-cta',
		array(
			'title'       => __( 'Intro with call to action', 'dc-circle' ),
			'description' => __( 'A simple heading, supporting text, and a button.', 'dc-circle' ),
			'categories'  => array( 'dc-circle', 'featured', 'call-to-action' ),
			'content'     => '<!-- wp:group {"className":"is-style-dc-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-dc-card"><!-- wp:heading {"textAlign":"left","level":2} -->
<h2 class="wp-block-heading has-text-align-left">' . esc_html__( 'Welcome to our store', 'dc-circle' ) . '</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-dc-lead"} -->
<p class="is-style-dc-lead">' . esc_html__( 'Discover curated products for everyday living.', 'dc-circle' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-dc-button"} -->
<div class="wp-block-button is-style-dc-button"><a class="wp-block-button__link wp-element-button" href="#">' . esc_html__( 'Shop now', 'dc-circle' ) . '</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->',
		)
	);
}
add_action( 'init', 'dc_circle_register_block_patterns' );
