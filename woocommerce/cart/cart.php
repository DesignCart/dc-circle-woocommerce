<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.8.0
 */

defined( 'ABSPATH' ) || exit;



do_action( 'woocommerce_before_cart' ); ?>
<form id="cart-table" class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>
	<?php do_action( 'woocommerce_before_cart_contents' ); ?>
	<div class="woocommerce-cart-form__contents">
	<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
			$product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
					<div class="dc-cart-row woocommerce-cart-form__cart-item cart_item">
						<!-- 1: obrazek -->
						<div class="dc-cart-col dc-col-image">
							<?php
								$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
								if ( $product_permalink ) {
									printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
								} else {
									echo $thumbnail;
								}
							?>
						</div>
						<div class="dc-col-content">
							<!-- 2: nazwa + cena -->
							<div class="dc-cart-col dc-col-info">
								<div class="dc-product-name">
									<?php
										$product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
										if ( $product_permalink ) {
											printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $product_name );
										} else {
											echo wp_kses_post( $product_name );
										}
										do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
										echo wc_get_formatted_cart_item_data( $cart_item );
										if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
											echo wp_kses_post( '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'dc-circle' ) . '</p>' );
										}
									?>
								</div>
								<div class="dc-product-price">
									<?php
										echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
									?>
								</div>
							</div>
							<div class="dc-col-interface">
								<!-- 3: quantity -->
								<div class="dc-cart-col dc-col-qty product-quantity" data-title="<?php esc_attr_e('Quantity', 'dc-circle'); ?>">
									<div class="dc-qty-wrapper">

										<?php
											if ($_product->is_sold_individually()) {
												$min_quantity = 1;
												$max_quantity = 1;
											} else {
												$min_quantity = 1;
												$max_quantity = $_product->get_max_purchase_quantity();
											}
										?>

										<button type="button" class="dc-qty-btn minus">−</button>
										<input type="number"
											class="input-text qty text dc-qty-input"
											step="1"
											min="<?php echo esc_attr( $_product->is_sold_individually() ? 1 : 1 ); ?>"
											max="100"
											name="cart[<?php echo esc_attr( $cart_item_key ); ?>][qty]"
											value="<?php echo esc_attr( $cart_item['quantity'] ); ?>"
											title="<?php esc_attr_e( 'Qty', 'dc-circle' ); ?>"
											size="4"
											inputmode="numeric"
											data-cart_item_key="<?php echo esc_attr( $cart_item_key ); ?>"
										/>
										<button type="button" class="dc-qty-btn plus">+</button>
									</div>
								</div>

								<!-- 4: usuń -->
								<div class="dc-cart-col dc-col-remove">
									<?php
										echo apply_filters( 'woocommerce_cart_item_remove_link',
											sprintf(
												'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><img src="%s/img/trash.svg" alt="' . esc_attr__( 'Remove', 'dc-circle' ) . '" class="dc-cart-remove-icon" /></a>',
												esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
												esc_attr( sprintf( __( 'Remove %s from cart', 'dc-circle' ), wp_strip_all_tags( $product_name ) ) ),
												esc_attr( $cart_item['product_id'] ),
												esc_attr( $_product->get_sku() ),
												get_stylesheet_directory_uri()
											),
										$cart_item_key );
									?>
								</div>
							</div>
						</div>	
					</div>		
					<?php
				}
			}
			?>
		</div>

		<?php do_action( 'woocommerce_cart_contents' ); ?>

		<?php if ( wc_coupons_enabled() ) { ?>
			<div class="coupon">
				<label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Coupon:', 'dc-circle' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'dc-circle' ); ?>" /> <button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'dc-circle' ); ?>"><?php esc_html_e( 'Apply coupon', 'dc-circle' ); ?></button>
				<?php do_action( 'woocommerce_cart_coupon' ); ?>
			</div>
		<?php } ?>

		<button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'dc-circle' ); ?>"><?php esc_html_e( 'Update cart', 'dc-circle' ); ?></button>

		<?php do_action( 'woocommerce_cart_actions' ); ?>

		<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>


		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		
		<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<div class="cart-collaterals">
	<?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		do_action( 'woocommerce_cart_collaterals' );
	?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>

<div id="page-cart-featureds" class="page-cart-featureds">
	<h2><?php esc_html_e( 'Recommended products', 'dc-circle' ); ?></h2>

	<div class="page-cart-featureds-carousel-container">
	<?php
		// pobierz zapisane ID i zrób tablicę
		$ids_raw = get_theme_mod('dc_cart_products_ids', '');
		if ( $ids_raw ) {
			$ids = array_map( 'intval', explode( ',', $ids_raw ) );
			if ( ! empty( $ids ) ) {
				// losowo wybierz do 6
				shuffle( $ids );
				$random_ids = array_slice( $ids, 0, 6 );

				// pobierz produkty w tej kolejności
				$products = wc_get_products([
					'include'   => $random_ids,
					'orderby'   => 'post__in',
				]);
				if ( $products ) {
					echo '<div class="dc-cart-products-carousel owl-carousel">';
					foreach ( $products as $prod ) {
						echo '<div class="dc-carousel-item">';
							echo '<a href="'. esc_url( $prod->get_permalink() ) .'">';
								echo $prod->get_image('woocommerce_thumbnail');
								echo '<h4 class="dc-carousel-title">'. esc_html( $prod->get_name() ) .'</h4>';
								echo '<span class="dc-carousel-price">'. $prod->get_price_html() .'</span>';
							echo '</a>';
							echo '<div class="dc-carousel-add-to-cart">';
								// opcjonalnie: przycisk Add to cart
								echo apply_filters( 'woocommerce_loop_add_to_cart_link',
									sprintf( '<a href="%s" data-quantity="1" class="button add_to_cart_button" data-product_id="%s">%s</a>',
										esc_url( $prod->add_to_cart_url() ),
										esc_attr( $prod->get_id() ),
										esc_html( $prod->add_to_cart_text() )
									),
								$prod );
							echo '</div>';
						echo '</div>';
					}
					echo '</div>';
				}
			}
		}
		?>
	</div>
</div>
