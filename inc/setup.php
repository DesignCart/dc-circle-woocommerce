<?php
/**
 * @package dc-circle
 * @author Paweł Nosko
 * @copyright 2026 Design Cart
 * @license GPL-2.0-or-later
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
    function designcart_theme_setup() {
        load_theme_textdomain( 'dc-circle', get_template_directory() . '/languages' );

        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'woocommerce' );
        add_theme_support( 'align-wide' );
        add_theme_support( 'responsive-embeds' );
        add_theme_support( 'wp-block-styles' );
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );
        add_theme_support(
            'custom-logo',
            array(
                'height'      => 120,
                'width'       => 300,
                'flex-height' => true,
                'flex-width'  => true,
            )
        );

        add_theme_support(
            'custom-background',
            array(
                'default-color' => 'ffffff',
            )
        );

        add_theme_support(
            'custom-header',
            array(
                'default-image'      => '',
                'width'              => 1600,
                'height'             => 600,
                'flex-width'         => true,
                'flex-height'        => true,
                'header-text'        => false,
                'uploads'            => true,
            )
        );

        add_editor_style( array( 'assets/css/fonts.css', 'assets/css/editor-style.css', 'style.css' ) );

        register_nav_menus(
            array(
                'main_menu'   => __( 'Main menu', 'dc-circle' ),
                'footer_menu' => __( 'Footer menu', 'dc-circle' ),
            )
        );
    }

    function designcart_register_widget_areas() {
        register_sidebar(
            array(
                'name'          => __( 'Below banner widget', 'dc-circle' ),
                'id'            => 'home-widget-1',
                'description'   => __( 'Content below the banner.', 'dc-circle' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            )
        );

        register_sidebar(
            array(
                'name'          => __( 'Below new arrivals widget', 'dc-circle' ),
                'id'            => 'home-widget-2',
                'description'   => __( 'Content below new arrivals.', 'dc-circle' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            )
        );

        register_sidebar(
            array(
                'name'          => __( 'Below sale widget', 'dc-circle' ),
                'id'            => 'home-widget-3',
                'description'   => __( 'Content below sale items.', 'dc-circle' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            )
        );

        register_sidebar(
            array(
                'name'          => __( 'Below bestsellers widget', 'dc-circle' ),
                'id'            => 'home-widget-4',
                'description'   => __( 'Content below bestsellers.', 'dc-circle' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            )
        );

        register_sidebar(
            array(
                'name'          => __( 'Below featured widget', 'dc-circle' ),
                'id'            => 'home-widget-5',
                'description'   => __( 'Content below featured items.', 'dc-circle' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            )
        );

        register_sidebar(
            array(
                'name'          => __( 'Footer - left', 'dc-circle' ),
                'id'            => 'footer-1',
                'description'   => __( 'Footer content on the left.', 'dc-circle' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            )
        );

        register_sidebar(
            array(
                'name'          => __( 'Footer - center', 'dc-circle' ),
                'id'            => 'footer-2',
                'description'   => __( 'Footer content in the center.', 'dc-circle' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            )
        );

        register_sidebar(
            array(
                'name'          => __( 'Footer - right', 'dc-circle' ),
                'id'            => 'footer-3',
                'description'   => __( 'Footer content on the right.', 'dc-circle' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            )
        );
    }

    add_action( 'after_setup_theme', 'designcart_theme_setup' );
    add_action( 'widgets_init', 'designcart_register_widget_areas' );
    add_action( 'wp_enqueue_scripts', function() {
        if ( class_exists( 'WooCommerce' ) ) {
            wp_enqueue_script( 'wc-cart-fragments' );
        }
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }, 20 );

    add_action( 'wp_ajax_dc_circle_update_cart_item_quantity', 'dc_circle_update_cart_item_quantity' );
    add_action( 'wp_ajax_nopriv_dc_circle_update_cart_item_quantity', 'dc_circle_update_cart_item_quantity' );

    function dc_circle_update_cart_item_quantity() {
        check_ajax_referer( 'dc_circle_cart', 'nonce' );

        if ( ! class_exists( 'WooCommerce' ) || ! function_exists( 'WC' ) || ! WC()->cart ) {
            wp_send_json_error( __( 'WooCommerce is not available.', 'dc-circle' ) );
        }

        if ( ! isset( $_POST['cart_item_key'], $_POST['quantity'] ) ) {
            wp_send_json_error( __( 'Invalid cart data.', 'dc-circle' ) );
        }

        $cart_item_key = sanitize_text_field( wp_unslash( $_POST['cart_item_key'] ) );
        $quantity      = absint( $_POST['quantity'] );

        if ($quantity <= 0) {
            WC()->cart->remove_cart_item($cart_item_key);
        } else {
            WC()->cart->set_quantity($cart_item_key, $quantity);
        }

        WC()->cart->calculate_totals();

        // Złap subtotal jednego produktu
        $cart_item = WC()->cart->get_cart()[$cart_item_key] ?? null;
        $subtotal_html = '';
        if ($cart_item && isset($cart_item['data'])) {
            $subtotal_html = WC()->cart->get_product_subtotal($cart_item['data'], $quantity);
        }

        ob_start();
        woocommerce_mini_cart();
        $mini_cart = ob_get_clean();

        wp_send_json_success([
            'mini_cart' => $mini_cart,
            'fragments' => apply_filters('woocommerce_add_to_cart_fragments', [
                'div.widget_shopping_cart_content' => '<div class="widget_shopping_cart_content">' . $mini_cart . '</div>'
            ]),
            'cart_hash' => WC()->cart->get_cart_hash(),
        ]);

        wp_die();
    }

    if ( ! class_exists( 'DC_Mobile_Accordion_Walker' ) ) {
        class DC_Mobile_Accordion_Walker extends Walker_Nav_Menu {

            public function start_lvl( &$output, $depth = 0, $args = [] ) {
                // puste – generujemy wrap submenu w start_el
            }
            public function end_lvl( &$output, $depth = 0, $args = [] ) {
                // puste – zamykamy w end_el
            }

            public function start_el( &$output, $item, $depth = 0, $args = [], $id = 0 ) {
                $has_children = in_array( 'menu-item-has-children', $item->classes ?? [], true );
                $submenu_id   = 'dc-submenu-' . (int) $item->ID;

                $output .= '<li class="menu-item' . ( $has_children ? ' menu-item-has-children' : '' ) . '">';

                // Wiersz: link po lewej, toggle po prawej (tylko gdy są dzieci)
                $output .= '<div class="dc-acc-row d-flex align-items-center justify-content-between">';
                $output .= '<a class="dc-acc-link" href="' . esc_url( $item->url ?: '#' ) . '">' . esc_html( $item->title ) . '</a>';

                if ( $has_children ) {
                    $output .= '<button class="dc-acc-toggle collapsed" type="button" data-target="#' . esc_attr( $submenu_id ) . '" aria-expanded="false" aria-controls="' . esc_attr( $submenu_id ) . '"></button>';
                }
                $output .= '</div>';

                // Submenu (kontener naszej „harmonijki”)
                if ( $has_children ) {
                    $output .= '<div id="' . esc_attr( $submenu_id ) . '" class="dc-collapse">';
                    $output .= '<ul class="dc-submenu list-unstyled mb-0">';
                }
            }

            public function end_el( &$output, $item, $depth = 0, $args = [] ) {
                $has_children = in_array( 'menu-item-has-children', $item->classes ?? [], true );
                if ( $has_children ) {
                    $output .= '</ul></div>'; // zamknięcie .dc-submenu i .dc-collapse
                }
                $output .= '</li>';
            }
        }
    }

    add_filter( 'woocommerce_add_to_cart_redirect', '__return_false' ); 


    