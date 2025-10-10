<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
$image = wp_get_attachment_url( $thumbnail_id );
?>
<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
    <a href="<?php echo get_term_link( $category ); ?>" class="dc-category-item d-block text-decoration-none dc-style-2" aria-label="<?php echo sprintf( esc_html__( 'Przejdź do kategorii produktu %s', 'woocommerce' ), $category->name ); ?>">
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