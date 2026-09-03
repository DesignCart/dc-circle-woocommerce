<?php if ( function_exists( 'woocommerce_mini_cart' ) ) : ?>
<div class="dc-slidecart-overlay"></div>
<div id="dc-slidecart" class="dc-slidecart">
    <div class="dc-slidecart-content">
        <div class="dc-slidecart-header">
            <h3><?php esc_html_e( 'Your cart', 'dc-circle' ); ?></h3>
            <button type="button" class="dc-slidecart-close">&times;</button>
        </div>
        
        <div id="dc-slidecart-inner">
            <div class="widget_shopping_cart_content">
                <?php woocommerce_mini_cart(); ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
