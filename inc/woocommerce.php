<?php
    add_action('after_setup_theme', function() {
        remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
        remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
        remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

	
        add_action('woocommerce_before_shop_loop', function() {
            ?>
            <div class="dc-message">
                <?php woocommerce_output_all_notices(); ?>
            </div>

            <div class="dc-shop-toolbar container mb-4">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6 px-0">
                        <?php woocommerce_result_count(); ?>
                    </div>
                    <div class="col-12 col-md-6 text-md-end px-0">
                        <?php woocommerce_catalog_ordering(); ?>
                    </div>
                </div>
            </div>
            <?php
        }, 10);

    });

    add_filter('woocommerce_loop_add_to_cart_link', function ($html, $product, $args) {
        $qty   = isset($args['quantity']) ? (int) $args['quantity'] : 1;
        $cls   = isset($args['class']) ? $args['class'] : '';
        $type  = $product->get_type();

        // Prosty produkt – AJAX add to cart (z klasami dc-*)
        if ( $type === 'simple' && $product->is_purchasable() && $product->is_in_stock() ) {
            $url   = esc_url( $product->add_to_cart_url() );
            $text  = esc_html( $product->add_to_cart_text() );

            $html = sprintf(
                '<a href="%1$s"
                    data-quantity="%2$d"
                    data-product_id="%3$s"
                    data-product_sku="%4$s"
                    class="add_to_cart_button ajax_add_to_cart %5$s dc-btn dc-style-2 dc-btn-addcart"
                    aria-label="%6$s">%7$s</a>',
                $url,
                $qty,
                esc_attr( $product->get_id() ),
                esc_attr( $product->get_sku() ),
                esc_attr( $cls ),
                esc_attr( $product->add_to_cart_description() ),
                $text
            );

            return $html;
        }

        if ( $type === 'variable' ) {
            return sprintf(
                '<a href="%1$s" class="%2$s dc-btn dc-style-2 dc-btn-choose">%3$s</a>',
                esc_url( get_permalink( $product->get_id() ) ),
                esc_attr( $cls ),
                esc_html__( 'Wybierz opcje', 'twój' )
            );
        }

        if ( $type === 'grouped' ) {
            return sprintf(
                '<a href="%1$s" class="%2$s dc-btn dc-style-2 dc-btn-grouped">%3$s</a>',
                esc_url( get_permalink( $product->get_id() ) ),
                esc_attr( $cls ),
                esc_html__( 'Zobacz zestaw', 'twój' )
            );
        }

        if ( $type === 'external' ) {
            return sprintf(
                '<a href="%1$s" target="_blank" rel="nofollow noopener" class="%2$s dc-btn dc-style-2 dc-btn-external">%3$s</a>',
                esc_url( $product->get_product_url() ),
                esc_attr( $cls ),
                esc_html( $product->button_text ? $product->button_text : __( 'Kup teraz', 'twój' ) )
            );
        }


        return $html;
    }, 10, 3);

    add_action('after_setup_theme', function(){
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
    }, 20);

    add_action('woocommerce_before_add_to_cart_quantity', function () {
        echo '<div class="dc-atc-row">';
    }, 1);

    // Zamknij wrapper PO przycisku
    add_action('woocommerce_after_add_to_cart_button', function () {
        echo '</div>';
    }, 999);

    