<?php
defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( WC()->cart && ! WC()->cart->is_empty() ) : ?>

	<?php $theme_url = get_stylesheet_directory_uri(); ?>

	<ul id="dc-products-listing" class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr( $args['list_class'] ); ?>">
		<?php
		do_action( 'woocommerce_before_mini_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				/**
				 * This filter is documented in woocommerce/templates/cart/cart.php.
				 *
				 * @since 2.1.0
				 */
				$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
				$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
				$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
				<li class="woocommerce-mini-cart-item mini_cart_item" data-cart-item-key="<?php echo esc_attr( $cart_item_key ); ?>">
					<div class="dc-cart-product">
						<div class="dc-cart-image">
							<?php echo $thumbnail; ?>
						</div>
						<div class="dc-cart-details">
							<div class="dc-cart-title">
								<a href="<?php echo esc_url( $product_permalink ); ?>"><?php echo wp_kses_post( $product_name ); ?></a>
							</div>
							<div class="dc-cart-desc">
								<?php echo wp_trim_words( strip_tags( $_product->get_description() ), 10, '...' ); ?>
							</div>
							<div class="dc-cart-price-remove">
								<span class="dc-cart-price"><?php echo $product_price; ?></span>
								<a href="<?php echo esc_url( wc_get_cart_remove_url( $cart_item_key ) ); ?>" class="dc-cart-remove remove remove_from_cart_button" aria-label="<?php esc_attr_e( 'Remove this item', 'woocommerce' ); ?>">
									<img class="dc-trash-icon" src="<?php echo $theme_url; ?>/assets/images/trash.svg" alt="trash icon" />
								</a>
							</div>
							<div class="dc-qty-wrapper">
								<button type="button" class="dc-qty-btn dc-qty-minus">−</button>
								<input 
									type="number" 
									class="dc-qty-input" 
									value="<?php echo esc_attr( $cart_item['quantity'] ); ?>" 
									min="1"
									name="cart[<?php echo esc_attr( $cart_item_key ); ?>][qty]"
									data-cart_item_key="<?php echo esc_attr( $cart_item_key ); ?>"
									>
								<button type="button" class="dc-qty-btn dc-qty-plus">+</button>
							</div>
						</div>
					</div>
				</li>
				<?php
			}
		}

		do_action( 'woocommerce_mini_cart_contents' );
		?>
	</ul>

	<div class="dc-mini-cart-bottom">
		<p class="woocommerce-mini-cart__total total">
			<?php
			/**
			 * Hook: woocommerce_widget_shopping_cart_total.
			 *
			 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
			 */
			do_action( 'woocommerce_widget_shopping_cart_total' );
			?>
		</p>

		<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>	

        <p class="woocommerce-mini-cart__buttons buttons">
		    <?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?>
	    </p>
	</div>

	

	<?php do_action( 'woocommerce_widget_shopping_cart_after_buttons' ); ?>

<?php else : ?>

	<p class="woocommerce-mini-cart__empty-message"><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
