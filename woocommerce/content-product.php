<?php
    defined('ABSPATH') || exit;

    global $product, $post;
    if ( empty($product) || ! $product->is_visible() ) return;

    $gallery_ids = $product->get_gallery_image_ids();
    $hover_id    = $gallery_ids ? $gallery_ids[0] : 0;
    $price_html  = $product->get_price_html();
    $rating_html = wc_get_rating_html( $product->get_average_rating() );
    $is_on_sale  = $product->is_on_sale();
    $in_stock    = $product->is_in_stock();
    $short_desc  = apply_filters('woocommerce_short_description', $post->post_excerpt);
    ?>
    <div <?php wc_product_class('dc-product-item col-12 col-sm-6 col-lg-3 mb-4', $product); ?>>
        <div class="dc-card card h-100">
            <div class="dc-card-product-image text-center">
                <a href="<?php the_permalink(); ?>" class="dc-thumb-wrap position-relative">
                    <?php
                    // Zdjęcie główne
                    echo $product->get_image( 'woocommerce_thumbnail', ['class' => 'dc-thumb-main object-fit-cover'] );

                    // Hover image (pierwsza z galerii)
                    if ( $hover_id ) {
                        echo wp_get_attachment_image( $hover_id, 'woocommerce_thumbnail', false, [
                            'class' => 'dc-thumb-hover object-fit-cover position-absolute top-0 start-0 w-100 h-100',
                            'loading' => 'lazy',
                        ] );
                    }
                    ?>

                    <?php if ( ! $in_stock ) : ?>
                        <span class="dc-badge dc-badge--oos">Brak w magazynie</span>
                    <?php elseif ( $is_on_sale ) : ?>
                        <span class="dc-badge dc-badge--sale"><?php esc_html_e('Wyprzedaż','twój-motyw'); ?></span>
                    <?php endif; ?>

                    <div class="dc-wishlist-badge">
                        <?php //echo do_shortcode('[yith_wcwl_add_to_wishlist product_id="'. $product->get_id() .'" label="" browse_wishlist_text="" already_in_wishlist_text=""]'); ?>
                    </div>
                </a>
            </div>

            <div class="card-body d-flex flex-column text-center">
                <h3 class="dc-title h6 mb-2">
                    <a href="<?php the_permalink(); ?>" class="text-decoration-none"><?php the_title(); ?></a>
                </h3>

                <?php if ( $rating_html ) : ?>
                    <div class="dc-rating mb-2"><?php echo $rating_html; ?></div>
                <?php endif; ?>

                <?php if ( $price_html ) : ?>
                    <div class="dc-price mb-3 fw-semibold"><?php echo $price_html; ?></div>
                <?php endif; ?>

                <div class="mt-auto">
                    <div class="dc-atc text-center">
                        <?php if ( $product->is_type('simple') && $product->is_purchasable() && $product->is_in_stock() ) : ?>
                            <div class="dc-buy">
                                <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>"
                                    class="add_to_cart_button ajax_add_to_cart button dc-btn dc-style-2 dc-btn-addcart"
                                    data-product_id="<?php echo esc_attr( $product->get_id() ); ?>"
                                    data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>"
                                    data-quantity="1">
                                    <i class="fa fa-shopping-cart"></i> <?php echo esc_html( $product->add_to_cart_text() ); ?>
                                </a>
                            </div>
                        <?php else : ?>
                            <a href="<?php the_permalink(); ?>" class="button dc-btn dc-style-2 dc-btn-addcart">
                                <i class="fa fa-search"></i> <?php esc_html_e('Zobacz produkt','twój'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
