<?php
/**
 * Product category loop item
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product-cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
$image = wp_get_attachment_url( $thumbnail_id );
?>
<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
    <a href="<?php echo get_term_link( $category ); ?>" class="dc-category-item d-block text-decoration-none dc-style-2" aria-label="<?php echo esc_attr( sprintf( __( 'Go to product category %s', 'dc-circle' ), $category->name ) ); ?>">
        <div class="dc-category-flex">
            <?php if ( $image ) : ?>
                <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $category->name ); ?>" class="dc-category-thumb">
            <?php endif; ?>

            <h2 class="dc-category-title">
                <?php echo esc_html( $category->name ); ?>
            </h2>
        </div>
    </a>
</div>