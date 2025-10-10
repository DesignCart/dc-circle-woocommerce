<?php
    function designcart_output_customizer_css() {
        ?>

        <style type="text/css">
            :root {
                --font-color: <?= esc_html( get_theme_mod('designcart_font_color') ); ?>;
                --link-color: <?= esc_html( get_theme_mod('designcart_link_color') ); ?>;
                --link-hover-color: <?= esc_html( get_theme_mod('designcart_link_hover') ); ?>;
                --footer-bg: <?= esc_html( get_theme_mod('designcart_footer_bg') ); ?>;
                --footer-text: <?= esc_html( get_theme_mod('designcart_footer_text') ); ?>;

                <?php for ( $i = 1; $i <= 4; $i++ ) : ?>
                    --dc-bg-<?= $i; ?>: <?php echo get_theme_mod("designcart_button_style_{$i}_bg"); ?>;
                    --dc-color-<?= $i; ?>: <?php echo get_theme_mod("designcart_button_style_{$i}_text"); ?>;
                <?php endfor; ?>

            }

            footer {
                background-color: var(--footer-bg);
                color: var(--footer-text);
            }

            a {
                color: var(--link-color);
            }

            a:hover {
                color: var(--link-hover-color);
            }

            <?php $colors_transparency = array(); ?>

            <?php for ( $i = 1; $i <= 4; $i++ ) : 
                $bg                      = get_theme_mod("designcart_button_style_{$i}_bg");
                $text                    = get_theme_mod("designcart_button_style_{$i}_text");
                $bg_hover                = get_theme_mod("designcart_button_style_{$i}_bg_hover");
                $text_hover              = get_theme_mod("designcart_button_style_{$i}_text_hover");
                $bg_rgba                 = hex2rgba($bg, 0.8);
                $colors_transparency[$i] = $bg_rgba;
            ?>
                .dc-style-<?= $i; ?> {
                    background-color: <?= esc_html($bg); ?> !important;
                    color: <?= esc_html($text); ?> !important;
                    border-color: <?= esc_html($bg); ?> !important;
                }

                .dc-style-<?= $i; ?>.dc-btn:hover {
                    background-color: <?= esc_html($bg_hover); ?> !important;
                    color: <?= esc_html($text_hover); ?> !important;
                    border-color: <?= esc_html($bg_hover); ?> !important;
                }

                .dc-input-style-<?= $i; ?> {
                    background-color: <?= esc_html($bg); ?> !important;
                    border:1px <?= esc_html($text); ?> solid !important;
                    color: <?= esc_html($text); ?> !important;
                }

                .dc-input-style-<?= $i; ?>::placeholder{
                    color: <?= esc_html($text); ?> !important;
                }

                .dc-color-<?= $i; ?>,
                .dc-color-<?= $i; ?> h1,
                .dc-color-<?= $i; ?> h2,
                .dc-color-<?= $i; ?> h3,
                .dc-color-<?= $i; ?> h4,
                .dc-color-<?= $i; ?> h5,
                .dc-color-<?= $i; ?> h6{
                    color: <?= esc_html($bg); ?> !important;
                }

                .bg-transparency-<?= $i; ?>{
                    background-color: <?= esc_html($bg_rgba); ?> !important;
                }
            <?php endfor; ?>
            /* Add to cart button */
            /*
            .add_to_cart_button{
                color: <?= get_theme_mod("designcart_button_style_2_text"); ?> !important;
                background-color: <?= get_theme_mod("designcart_button_style_2_bg"); ?> !important;
            }
            */

            :root{
                --dc-bg: <?= get_theme_mod("designcart_button_style_2_bg"); ?>;
                --dc-fg: <?= get_theme_mod("designcart_button_style_3_bg"); ?>;
                --dc-border: rgba(110,83,53,.25);
                --dc-border-strong: rgba(110,83,53,.4);
                --dc-shadow: 0 6px 20px rgba(0,0,0,.06);
                }

            /*Carousel prev */
            button.dc-owl-prev{
                color: <?= get_theme_mod("designcart_button_style_1_text"); ?> !important;
                background-color: <?= get_theme_mod("designcart_button_style_1_bg"); ?> !important;
            }

            button.dc-owl-prev svg path{
                fill: <?= get_theme_mod("designcart_button_style_1_text"); ?> !important;
            }

            button.dc-owl-prev:hover{
                color: <?= get_theme_mod("designcart_button_style_1_text_hover"); ?> !important;
                background-color: <?= get_theme_mod("designcart_button_style_1_bg_hover"); ?> !important;
            }

            button.dc-owl-prev:hover svg path{
                fill: <?= get_theme_mod("designcart_button_style_1_text_hover"); ?> !important;
            }

            /*Carousel next */
            button.dc-owl-next{
                color: <?= get_theme_mod("designcart_button_style_4_text"); ?> !important;
                background-color: <?= get_theme_mod("designcart_button_style_4_bg"); ?> !important;
            }

            button.dc-owl-next svg path{
                fill: <?= get_theme_mod("designcart_button_style_4_text"); ?> !important;
            }

            button.dc-owl-next:hover{
                color: <?= get_theme_mod("designcart_button_style_4_text_hover"); ?> !important;
                background-color: <?= get_theme_mod("designcart_button_style_4_bg_hover"); ?> !important;
            }

            button.dc-owl-next:hover svg path{
                fill: <?= get_theme_mod("designcart_button_style_4_text_hover"); ?> !important;
            }

            .dc-nav-baner, 
            .dc-nav-mobile{
                background-color: <?= $colors_transparency[2]; ?> !important;
            }

            .dc-menu > li > a{
                color: <?= get_theme_mod("designcart_button_style_3_bg"); ?> !important;
            }

            .dc-menu > li > a:hover{
                color: <?= get_theme_mod("designcart_button_style_1_bg"); ?> !important;
            }

            .dc-menu li ul li a {
                color: <?= get_theme_mod("designcart_button_style_3_bg"); ?> !important;
            }

            .dc-menu li ul li a:hover {
                background-color: <?= get_theme_mod("designcart_button_style_2_bg"); ?> !important;
                color: <?= get_theme_mod("designcart_button_style_2_text"); ?> !important;
            }

            a, h1, h2, h3, h4, h5, h6,
            .h3.dc-products-carousel-product-title a,
            .dc-products-carousel-product-price,
            h2.dc-products-carousel-title,
            .woocommerce ul.cart_list li a, 
            .woocommerce ul.product_list_widget li a,
            h1.woocommerce-products-header__title.page-title{
                color: <?= get_theme_mod("designcart_button_style_3_bg"); ?> ;
            }

            #education-wall .wp-block-media-text{
                background: <?= get_theme_mod("designcart_button_style_2_bg"); ?> !important;
            }
            #slogan .slogan-container{
                color: <?= get_theme_mod("designcart_button_style_4_bg"); ?> !important;
            }

            #slogan .slogan-container strong{
                color: <?= get_theme_mod("designcart_button_style_1_bg"); ?> !important;
            }

            #guild{
                background-color: <?= get_theme_mod("designcart_button_style_2_bg"); ?> !important;
                color: <?= get_theme_mod("designcart_button_style_3_bg"); ?> !important;
            }

            #footer,
            #footer a,
            #footer ul li a{
                background-color: <?= get_theme_mod("designcart_footer_bg"); ?> !important;
                color: <?= get_theme_mod("designcart_footer_text"); ?> !important;
            }

            #footer ul li a:hover{
                background-color: <?= get_theme_mod("designcart_button_style_1_bg"); ?> !important;
                color: <?= get_theme_mod("designcart_button_style_1_text"); ?> !important;
            }

            #dc-products-listing .dc-qty-btn, .dc-qty-btn{
                background-color: <?= get_theme_mod("designcart_button_style_2_bg"); ?> !important;
                color: <?= get_theme_mod("designcart_button_style_2_text"); ?> !important;
            }

            .woocommerce-mini-cart__buttons.buttons .button.wc-forward{
                background-color: <?= get_theme_mod("designcart_button_style_3_bg"); ?> !important;
                color: <?= get_theme_mod("designcart_button_style_3_text"); ?> !important;
            }

            .woocommerce-mini-cart__buttons.buttons .button.checkout.wc-forward{
                background-color: <?= get_theme_mod("designcart_button_style_4_bg"); ?> !important;
                color: <?= get_theme_mod("designcart_button_style_4_text"); ?> !important;
            }

            .dc-slidecart-close{
                background-color: <?= get_theme_mod("designcart_button_style_4_bg"); ?> !important;
                color: <?= get_theme_mod("designcart_button_style_4_text"); ?> !important;
            }

            .dc-menu.dc-menu-subpage{
                background-color: <?= get_theme_mod("designcart_button_style_2_bg"); ?> !important;
            }

            #dc-products-listing .dc-qty-btn:focus {
                background-color: <?= get_theme_mod("designcart_button_style_2_bg"); ?> !important;
            }

            .dc-qty-wrapper,
            .dc-products-sort .orderby,
            .dc-card.card,
            .dc-product-card,
            select,
            input:not([type="button"]):not([type="submit"]){
                border: 1px solid <?= get_theme_mod("designcart_button_style_2_bg"); ?> !important;
                color: <?= get_theme_mod("designcart_button_style_2_text"); ?> !important;
            }

            .dc-card.card:hover{
                /*background: <?= get_theme_mod("designcart_button_style_2_bg"); ?> !important;*/
            }

            .swiper.mySwiper{
                background: <?= get_theme_mod("designcart_button_style_2_bg"); ?> !important;
            }

            .dc-badge{
                background: <?= get_theme_mod("designcart_button_style_1_bg"); ?> !important;
                border:1px solid <?= get_theme_mod("designcart_button_style_1_bg"); ?> !important;
                color: <?= get_theme_mod("designcart_button_style_1_text"); ?> !important;
            }

            .wp-element-button{
                background: <?= get_theme_mod("designcart_button_style_2_bg"); ?> !important;
                border:1px solid <?= get_theme_mod("designcart_button_style_2_bg"); ?> !important;
                color: <?= get_theme_mod("designcart_button_style_2_text"); ?> !important;
            }

            .dc-badge--sale{ 
                background:<?= get_theme_mod("designcart_button_style_4_bg"); ?> !important; 
                color:<?= get_theme_mod("designcart_button_style_4_text"); ?> !important; 
                border-color:<?= get_theme_mod("designcart_button_style_4_bg"); ?> !important; 
            }
            .dc-badge--oos{ 
                background:<?= get_theme_mod("designcart_button_style_3_bg"); ?> !important; 
                color:<?= get_theme_mod("designcart_button_style_3_text"); ?> !important; 
                border-color:<?= get_theme_mod("designcart_button_style_3_bg"); ?> !important; 
            }

            .swiper-button-next,
            .swiper-button-prev{
                background:<?= get_theme_mod("designcart_button_style_4_bg"); ?> !important; 
                color:<?= get_theme_mod("designcart_button_style_4_text"); ?> !important; 
            }


            .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) #respond input#submit.alt.disabled, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) #respond input#submit.alt.disabled:hover, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) #respond input#submit.alt:disabled, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) #respond input#submit.alt:disabled:hover, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) #respond input#submit.alt:disabled[disabled], .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) #respond input#submit.alt:disabled[disabled]:hover, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) a.button.alt.disabled, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) a.button.alt.disabled:hover, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) a.button.alt:disabled, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) a.button.alt:disabled:hover, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) a.button.alt:disabled[disabled], .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) a.button.alt:disabled[disabled]:hover, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) button.button.alt.disabled, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) button.button.alt.disabled:hover, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) button.button.alt:disabled, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) button.button.alt:disabled:hover, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) button.button.alt:disabled[disabled], .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) button.button.alt:disabled[disabled]:hover, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) input.button.alt.disabled, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) input.button.alt.disabled:hover, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) input.button.alt:disabled, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) input.button.alt:disabled:hover, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) input.button.alt:disabled[disabled], .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) input.button.alt:disabled[disabled]:hover, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce #respond input#submit.alt.disabled, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce #respond input#submit.alt.disabled:hover, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce #respond input#submit.alt:disabled, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce #respond input#submit.alt:disabled:hover, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce #respond input#submit.alt:disabled[disabled], :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce #respond input#submit.alt:disabled[disabled]:hover, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce a.button.alt.disabled, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce a.button.alt.disabled:hover, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce a.button.alt:disabled, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce a.button.alt:disabled:hover, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce a.button.alt:disabled[disabled], :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce a.button.alt:disabled[disabled]:hover, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce button.button.alt.disabled, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce button.button.alt.disabled:hover, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce button.button.alt:disabled, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce button.button.alt:disabled:hover, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce button.button.alt:disabled[disabled], :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce button.button.alt:disabled[disabled]:hover, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce input.button.alt.disabled, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce input.button.alt.disabled:hover, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce input.button.alt:disabled, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce input.button.alt:disabled:hover, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce input.button.alt:disabled[disabled], :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce input.button.alt:disabled[disabled]:hover {
                background:<?= get_theme_mod("designcart_button_style_3_bg"); ?> ; 
                color:<?= get_theme_mod("designcart_button_style_3_text"); ?> ; 
            }  
            
            .woocommerce div.product .woocommerce-tabs ul.tabs li {
                border: 1px solid <?= get_theme_mod("designcart_button_style_2_bg"); ?>;
                background-color: <?= get_theme_mod("designcart_button_style_2_bg"); ?>;
                color: <?= get_theme_mod("designcart_button_style_2_text"); ?>;
            }
            .woocommerce div.product .woocommerce-tabs ul.tabs li a{
                color: <?= get_theme_mod("designcart_button_style_2_text"); ?>;
            }

            .woocommerce div.product .woocommerce-tabs ul.tabs::before {
                border-bottom: 1px solid <?= get_theme_mod("designcart_button_style_2_text"); ?>;
            }

            .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) #respond input#submit, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) a.button, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) button.button, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) input.button, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce #respond input#submit, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce a.button, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce button.button, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce input.button {
                border: 1px solid <?= get_theme_mod("designcart_button_style_3_bg"); ?>;
                background-color: <?= get_theme_mod("designcart_button_style_3_bg"); ?>;
                color: <?= get_theme_mod("designcart_button_style_3_text"); ?>;
            }

            .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) #respond input#submit.alt, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) a.button.alt, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) button.button.alt, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) input.button.alt, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce #respond input#submit.alt, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce a.button.alt, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce button.button.alt, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce input.button.alt {
                background-color: <?= get_theme_mod("designcart_button_style_3_bg"); ?>;
                color: <?= get_theme_mod("designcart_button_style_3_text"); ?>;
            }

            .woocommerce-error, .woocommerce-info, .woocommerce-message {
                background-color: <?= get_theme_mod("designcart_button_style_2_bg"); ?>;
                color: <?= get_theme_mod("designcart_button_style_3_bg"); ?>;
                border-top: 3px solid <?= get_theme_mod("designcart_button_style_3_bg"); ?>;
            }

            .woocommerce-info::before,
            .dc-article-footer a{
                color: <?= get_theme_mod("designcart_button_style_3_bg"); ?>;
            }

            .dc-article-footer a:hover{
                color: <?= get_theme_mod("designcart_button_style_1_bg"); ?>;
            }

            .copyright-wrapper{
                background: <?= get_theme_mod("designcart_footer_bg"); ?>;
                color: <?= get_theme_mod("designcart_footer_text"); ?>;
            }

            .copyright-wrapper a{
                color: <?= get_theme_mod("designcart_footer_text"); ?>;
            }

            .dc-article{
                border: 1px solid <?= get_theme_mod("designcart_button_style_2_bg"); ?>;
            }

            .btn-outline-secondary{
                border: 1px solid <?= get_theme_mod("designcart_button_style_3_bg"); ?>;
                color: <?= get_theme_mod("designcart_button_style_3_bg"); ?>;
            }

            .btn-outline-secondary:hover{
                border: 1px solid <?= get_theme_mod("designcart_button_style_3_bg"); ?>;
                background: <?= get_theme_mod("designcart_button_style_3_bg"); ?>;
                color: <?= get_theme_mod("designcart_button_style_3_text"); ?>;
            }

            .wp-block-columns.dc-divider {
                position: relative;
            }

            .wp-block-columns.dc-divider::before {
                background-color: <?= get_theme_mod("designcart_button_style_2_bg"); ?>;
            }

            .wp-block-columns.dc-divider::after {
                background-color: <?= get_theme_mod("designcart_button_style_2_bg"); ?>;
                border: 2px solid <?= get_theme_mod("designcart_button_style_2_bg"); ?>;
            }

            .yith-wcwl-add-to-wishlist-button.yith-wcwl-add-to-wishlist-button--anchor {
                background-color:<?= get_theme_mod("designcart_button_style_2_bg"); ?>;  /* tło kółka */
                border: 1px solid <?= get_theme_mod("designcart_button_style_2_bg"); ?>;
                color:<?= get_theme_mod("designcart_button_style_2_text"); ?>
            }

            .yith-wcwl-add-to-wishlist-button {
                color: <?= get_theme_mod("designcart_button_style_1_bg"); ?> !important; 
            }

            .yith-wcwl-add-to-wishlist-button:hover {
                color: <?= get_theme_mod("designcart_button_style_1_bg"); ?> !important;
            }

            .yith-wcwl-add-to-wishlist-button .yith-wcwl-icon {
                color: <?= get_theme_mod("designcart_button_style_1_bg"); ?> !important;
            }

            .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) #respond input#submit.alt:hover, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) a.button.alt:hover, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) button.button.alt:hover, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) input.button.alt:hover, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce #respond input#submit.alt:hover, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce a.button.alt:hover, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce button.button.alt:hover, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce input.button.alt:hover {
                background-color: <?= get_theme_mod("designcart_button_style_4_bg"); ?>;
                color: <?= get_theme_mod("designcart_button_style_4_text"); ?>;
            }

            .dc-mobile-panel-icons{
                border-top: 1px solid <?= get_theme_mod("designcart_button_style_2_bg"); ?>;
                border-bottom: 1px solid <?= get_theme_mod("designcart_button_style_2_bg"); ?>;
            }

            #description{
                color: <?= get_theme_mod("designcart_button_style_3_bg"); ?>
            }

            .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) #respond input#submit:hover, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) a.button:hover, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) button.button:hover, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) input.button:hover, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce #respond input#submit:hover, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce a.button:hover, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce button.button:hover, :where(body:not(.woocommerce-block-theme-has-button-styles)):where(:not(.edit-post-visual-editor)) .woocommerce input.button:hover {
                background-color: <?= get_theme_mod("designcart_button_style_2_bg"); ?>;
                color: <?= get_theme_mod("designcart_button_style_2_text"); ?>;
            }
        </style>

        <?php
    }
    add_action( 'wp_head', 'designcart_output_customizer_css' );
