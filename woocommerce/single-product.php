<?php
/**
 * The Template for displaying single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 1.6.4
 */

/**
 * Fully custom Single Product template
 * - No page-level Woo wrappers/hooks
 * - Uses WooCommerce partials/functions for full functionality
 */

defined('ABSPATH') || exit;

get_header('shop');

if ( have_posts() ) :
	while ( have_posts() ) : the_post();

		// Ensure we have a proper product object to avoid fatals.
		global $product;
		if ( ! $product || ! $product instanceof WC_Product ) {
			$product = wc_get_product( get_the_ID() );
		}
		?>
		<div id="product-<?php the_ID(); ?>" <?php wc_product_class('dc-single', $product); ?>>

			<div class="container my-5">
				<div class="row g-4">

                    <?php
                        $ids = [];
                        $thumb_id = get_post_thumbnail_id();
                        if ( $thumb_id ) { $ids[] = $thumb_id; }
                        $gallery_ids = $product ? (array) $product->get_gallery_image_ids() : [];
                        if ( $gallery_ids ) { $ids = array_values(array_unique(array_merge($ids, $gallery_ids))); }
                    ?>

					<!-- GALERIA -->
                    <div class="col-12 col-sm-6 col-md-5 col-lg-4 offset-md-1 offset-lg-2">
<div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
                            <div class="swiper-wrapper">
                                <?php foreach ( $ids as $id ): ?>
                                    <div class="swiper-slide">
                                        <?php echo wp_get_attachment_image( $id, 'large', false ); ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>

                        <div thumbsSlider class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                <?php foreach ( $ids as $id ): ?>
                                    <div class="swiper-slide">
                                        <?php echo wp_get_attachment_image( $id, 'woocommerce_gallery_thumbnail', false ); ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

					<!-- PODSUMOWANIE / KARTA -->
					<div class="col-12 col-lg-6">
						<div class="dc-product-card card h-100">
							<div class="card-body d-flex flex-column">

                                <?php
									/*
                                    if ( function_exists('do_shortcode') && function_exists('wc_get_product') ) :
                                        global $product;
                                        if ( ! $product instanceof WC_Product ) { $product = wc_get_product( get_the_ID() ); }
                                        echo '<div class="dc-single-wishlist-btn">';
                                        // Wymuś render przez shortcode + jawny product_id + bez labela
                                        echo do_shortcode(
                                            '[yith_wcwl_add_to_wishlist product_id="'. esc_attr( $product->get_id() ) .'" label="" browse_wishlist_text="" already_in_wishlist_text=""]'
                                        );
                                        echo '</div>';
                                    endif;
									*/
                                ?>

								<header class="mb-3">
									<h1 class="dc-product-title h3 mb-2"><?php the_title(); ?></h1>
									<?php
									// Ocena
									if ( wc_review_ratings_enabled() ) {
										woocommerce_template_single_rating();
									}
									?>
								</header>

								<?php
								// Cena
								woocommerce_template_single_price();

								// Krótki opis
								$short = apply_filters('woocommerce_short_description', get_the_excerpt());
								if ( $short ) {
									echo '<div class="dc-excerpt text-muted mb-3">'. wp_kses_post( $short ) .'</div>';
								}

								// Formularz "dodaj do koszyka" (obsługuje simple/variable/grouped itp.)
								echo '<div class="dc-buy mb-3">';
									woocommerce_template_single_add_to_cart();
								echo '</div>';

								// Meta (SKU, kategorie, tagi)
								echo '<div class="dc-meta small text-muted mb-2">';
									woocommerce_template_single_meta();
								echo '</div>';

								// Udostępnianie (jeśli masz hooki share lub wtyczkę)
								woocommerce_template_single_sharing();
								?>
							</div>
						</div>
					</div>

				</div>

				<!-- Taby: opis / dodatkowe info / opinie -->
				<div class="row g-4 mt-4">
					<div class="col-12">
						<?php woocommerce_output_product_data_tabs(); ?>
					</div>
				</div>

				<!-- Produkty powiązane / podobne -->
				<div class="row g-4 mt-4">
					<div class="col-12">
						<?php
						woocommerce_upsell_display();
						woocommerce_output_related_products();
						?>
					</div>
				</div>
			</div>
		</div>
<?php
	endwhile;
endif;

get_footer('shop');
