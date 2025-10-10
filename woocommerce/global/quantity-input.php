<?php
defined('ABSPATH') || exit;

/**
 * Variables dostępne z Woo:
 * $input_id, $input_name, $input_value, $max_value, $min_value, $step,
 * $pattern, $inputmode, $product_name, $placeholder
 */

$min  = isset( $min_value ) ? $min_value : 1;
$max  = isset( $max_value ) ? $max_value : '';
$step = isset( $step ) ? $step : 1;
?>
<div class="dc-qty-wrapper" data-qty>
	<button type="button" class="dc-qty-btn dc-qty-minus" aria-label="<?php esc_attr_e('Zmniejsz ilość','twój'); ?>">−</button>

	<input
		type="number"
		id="<?php echo esc_attr( $input_id ); ?>"
		class="dc-qty-input"
		name="<?php echo esc_attr( $input_name ); ?>"
		value="<?php echo esc_attr( $input_value ); ?>"
		min="<?php echo esc_attr( $min ); ?>"
		<?php if ( '' !== $max ) : ?>max="<?php echo esc_attr( $max ); ?>"<?php endif; ?>
		step="<?php echo esc_attr( $step ); ?>"
		<?php if ( ! empty( $pattern ) ) : ?>pattern="<?php echo esc_attr( $pattern ); ?>"<?php endif; ?>
		<?php if ( ! empty( $inputmode ) ) : ?>inputmode="<?php echo esc_attr( $inputmode ); ?>"<?php endif; ?>
		aria-label="<?php echo esc_attr( $product_name ? sprintf( __( 'Ilość dla %s', 'twój' ), $product_name ) : __( 'Ilość', 'twój' ) ); ?>"
	/>

	<button type="button" class="dc-qty-btn dc-qty-plus" aria-label="<?php esc_attr_e('Zwiększ ilość','twój'); ?>">+</button>
</div>
