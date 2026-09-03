<?php if ( get_theme_mod( 'designcart_slider_feat_enabled' ) ) : ?>

    <?php
        $cats = (array) get_theme_mod( 'designcart_slider_feat_cats', array() );

        $args = wc_get_featured_product_ids();

        

        if ( ! empty( $cats ) ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => $cats,
                ),
            );
        }

        $products_query = new WP_Query( array(
            'post_type'      => 'product',
            'posts_per_page' => 10,
            'post__in'       => $args,
        ) );
    ?>
    <?php if ( $products_query->have_posts() ) : ?>
        <div class="container">
            <div id="products-carousel-featureds" class="dc-products-carousel-module">
                <h2><?php echo esc_html( get_theme_mod( 'designcart_slider_feat_title', __( 'Featured products', 'dc-circle' ) ) ); ?></h2>
            
                <div class="dc-products-carousel-wrapper">
                    <div class="dc-products-carousel dc-products-carousel-featureds owl-carousel">
                        <?php while ( $products_query->have_posts() ) : $products_query->the_post(); ?>
                            <?php global $product; ?>
                            
                            <div class="item dc-products-carousel-product-item">
                                <a href="<?php echo esc_url( get_the_permalink() ); ?>">
                                    <?php echo woocommerce_get_product_thumbnail(); ?>
                                </a>
                                <h3 class="dc-products-carousel-product-title">
                                    <a href="<?php echo esc_url( get_the_permalink() ); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                <div class="dc-products-carousel-product-price">
                                    <?php echo $product->get_price_html(); ?>
                                </div>
                                <div class="dc-products-carousel-product-cart">
                                    <?php
                                    global $product;

                                    if ( $product instanceof WC_Product ) {

                                        // 1) PROSTY produkt -> AJAX add to cart z ikoną koszyka
                                        if ( $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() ) {
                                            $url  = $product->add_to_cart_url();
                                            $id   = $product->get_id();
                                            $sku  = $product->get_sku();
                                            $aria = $product->add_to_cart_description();

                                            printf(
                                                '<a href="%1$s"
                                                    data-quantity="1"
                                                    class="btn add_to_cart_button ajax_add_to_cart button add_to_cart_button ajax_add_to_cart dc-style-2 dc-btn-addcart"
                                                    data-product_id="%2$s"
                                                    data-product_sku="%3$s"
                                                    aria-label="%4$s"
                                                    rel="nofollow">
                                                    %5$s
                                                    <span class="dc-btn-text">' . esc_html__( 'Add to cart', 'dc-circle' ) . '</span>
                                                </a>',
                                                esc_url( $url ),
                                                esc_attr( $id ),
                                                esc_attr( $sku ),
                                                esc_attr( $aria ),
                                                // SVG koszyka
                                                '<svg class="dc-icon dc-icon-cart" viewBox="0 0 24 24" width="18" height="18" fill="currentColor" aria-hidden="true"><path d="M7 18a2 2 0 1 0 .001 3.999A2 2 0 0 0 7 18zm10 0a2 2 0 1 0 .001 3.999A2 2 0 0 0 17 18zM6.2 5l.31 2H20a1 1 0 0 1 .97 1.243l-1.8 7.2A2 2 0 0 1 17.22 17H8.28a2 2 0 0 1-1.94-1.557L4.1 4.447A1 1 0 0 0 3.12 3.6H2a1 1 0 1 1 0-2h1.12a3 3 0 0 1 2.94 2.4L6.2 5z"/></svg>'
                                            );

            
                                        } else {
                                            printf(
                                                '<a href="%1$s" class="button dc-btn dc-style-2 dc_product_info_button">
                                                    %2$s
                                                    <span class="dc-btn-text">' . esc_html__( 'Select options', 'dc-circle' ) . '</span>
                                                </a>',
                                                esc_url( get_the_permalink() ),
                                                // SVG lupy
                                                '<svg class="dc-icon dc-icon-search" viewBox="0 0 24 24" width="18" height="18" fill="currentColor" aria-hidden="true"><path d="M21 20.29 16.65 15.9a8 8 0 1 0-1.41 1.41L20.29 21 21 20.29zM4 10a6 6 0 1 1 12.001.001A6 6 0 0 1 4 10z"/></svg>'
                                            );
                                        }
                                    }
                                    ?>
                                </div>
                            </div>

                        <?php endwhile;?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>

                <div class="dc-owl-nav">
                    <button type="button" role="presentation" class="dc-owl-prev">
                        <svg width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.75 16.25C13.6515 16.2505 13.5538 16.2313 13.4628 16.1935C13.3718 16.1557 13.2893 16.1001 13.22 16.03L9.72001 12.53C9.57956 12.3894 9.50067 12.1988 9.50067 12C9.50067 11.8013 9.57956 11.6107 9.72001 11.47L13.22 8.00003C13.361 7.90864 13.5285 7.86722 13.6958 7.88241C13.8631 7.89759 14.0205 7.96851 14.1427 8.08379C14.2649 8.19907 14.3448 8.35203 14.3697 8.51817C14.3946 8.68431 14.363 8.85399 14.28 9.00003L11.28 12L14.28 15C14.4205 15.1407 14.4994 15.3313 14.4994 15.53C14.4994 15.7288 14.4205 15.9194 14.28 16.06C14.1353 16.1907 13.9448 16.259 13.75 16.25Z" fill="#000000"/>
                        </svg>
                    </button>
                    <button type="button" role="presentation" class="dc-owl-next">
                        <svg width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.25 16.25C10.1493 16.2466 10.0503 16.2227 9.95921 16.1797C9.86807 16.1367 9.78668 16.0756 9.72001 16C9.57956 15.8594 9.50067 15.6688 9.50067 15.47C9.50067 15.2713 9.57956 15.0806 9.72001 14.94L12.72 11.94L9.72001 8.94002C9.66069 8.79601 9.64767 8.63711 9.68277 8.48536C9.71786 8.33361 9.79933 8.19656 9.91586 8.09322C10.0324 7.98988 10.1782 7.92538 10.3331 7.90868C10.4879 7.89198 10.6441 7.92391 10.78 8.00002L14.28 11.5C14.4205 11.6407 14.4994 11.8313 14.4994 12.03C14.4994 12.2288 14.4205 12.4194 14.28 12.56L10.78 16C10.7133 16.0756 10.6319 16.1367 10.5408 16.1797C10.4497 16.2227 10.3507 16.2466 10.25 16.25Z" fill="#000000"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
