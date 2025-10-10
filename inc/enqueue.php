<?php
    function designcart_enqueue_assets() {
        wp_enqueue_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', [], '5.3.3' );
        wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', [], '5.3.3', true );
        wp_enqueue_script( 'dc-slidecart', get_template_directory_uri() . '/assets/js/dc-slidecart.js', [], null, true );
        wp_enqueue_script( 'dc-woocommerce', get_template_directory_uri() . '/assets/js/woocommerce.js', [], null, true );
        wp_enqueue_script( 'designcart-theme', get_template_directory_uri() . '/assets/js/dc-theme.js', [], null, true );
        wp_enqueue_style( 'fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css', [], null );

        //Design Cart Styles
        wp_enqueue_style( 'designcart-style', get_stylesheet_uri(), [ 'bootstrap-css' ], wp_get_theme()->get( 'Version' ) );
        wp_enqueue_style( 'designcart-header', get_template_directory_uri() . '/assets/css/header.css', [ 'designcart-style' ], null );
        wp_enqueue_style( 'products-carousel', get_template_directory_uri() . '/assets/css/products_carousel.css', [ 'designcart-style' ], null );
        wp_enqueue_style( 'designcart-slidecart', get_template_directory_uri() . '/assets/css/slidecart.css', [ 'designcart-style' ], null );

        if ( is_front_page() ) {
            wp_enqueue_style(
                'designcart-home',
                get_template_directory_uri() . '/assets/css/home.css',
                [ 'designcart-style' ], 
                '1.0'
            );
        }

        // === Owl Carousel ===
        wp_enqueue_style(
            'owl-carousel',
            get_template_directory_uri() . '/assets/css/owl.carousel.min.css',
            [],
            '2.3.4'
        );

        wp_enqueue_style(
            'owl-carousel-theme',
            get_template_directory_uri() . '/assets/css/owl.theme.default.min.css',
            [ 'owl-carousel' ],
            '2.3.4'
        );

        wp_enqueue_script(
            'owl-carousel',
            get_template_directory_uri() . '/assets/js/owl.carousel.min.js',
            [ 'jquery' ],
            '2.3.4',
            true
        );
    }
    add_action( 'wp_enqueue_scripts', 'designcart_enqueue_assets' );