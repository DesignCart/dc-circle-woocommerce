<?php
    function designcart_theme_setup() {
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'woocommerce' );

        register_nav_menus( array(
            'main_menu' => __( 'Menu główne', 'designcart' ),
        ) );

        register_nav_menus( array(
            'footer_menu' => __( 'Menu w stopce', 'designcart' ),
        ) );
    }

    function designcart_register_widget_areas() {
        //FRONTPAGE
        register_sidebar( array(
            'name'          => __( 'Widget pod banerem' ),
            'id'            => 'home-widget-1',
            'description'   => __( 'Zawartość pod banerem.', 'designcart' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );

        register_sidebar( array(
            'name'          => __( 'Widget pod nowościami' ),
            'id'            => 'home-widget-2',
            'description'   => __( 'Zawartość pod nowościami.', 'designcart' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );

        register_sidebar( array(
            'name'          => __( 'Widget pod promocjami' ),
            'id'            => 'home-widget-3',
            'description'   => __( 'Zawartość pod promocjami.', 'designcart' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );

        register_sidebar( array(
            'name'          => __( 'Widget pod bestsellerami' ),
            'id'            => 'home-widget-4',
            'description'   => __( 'Zawartość pod bestsellerami.', 'designcart' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );

        register_sidebar( array(
            'name'          => __( 'Widget pod wyróżnionymi' ),
            'id'            => 'home-widget-5',
            'description'   => __( 'Zawartość pod wyróżnionymi.', 'designcart' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );

        //FOOTER
        register_sidebar( array(
            'name'          => __( 'Stopka - lewa strona', 'designcart' ),
            'id'            => 'footer-1',
            'description'   => __( 'Zawartość stopki po lewej stronie.', 'designcart' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );

        register_sidebar( array(
            'name'          => __( 'Stopka - środek', 'designcart' ),
            'id'            => 'footer-2',
            'description'   => __( 'Zawartość stopki na środku.', 'designcart' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );

        register_sidebar( array(
            'name'          => __( 'Stopka - prawa strona', 'designcart' ),
            'id'            => 'footer-3',
            'description'   => __( 'Zawartość stopki po prawej stronie.', 'designcart' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
    }

    add_action( 'after_setup_theme', 'designcart_theme_setup' );
    add_action( 'widgets_init', 'designcart_register_widget_areas' );
    add_action('wp_enqueue_scripts', function(){ wp_enqueue_script('wc-cart-fragments'); }, 20);

    add_action('wp_ajax_designcart_update_cart_item_quantity', 'designcart_update_cart_item_quantity');
    add_action('wp_ajax_nopriv_designcart_update_cart_item_quantity', 'designcart_update_cart_item_quantity');

    function designcart_update_cart_item_quantity() {
        if (!isset($_POST['cart_item_key'], $_POST['quantity'])) {
            //wp_send_json_error('Błędne dane.');
            //wp_die();
        }

        $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
        $quantity = intval($_POST['quantity']);

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

    add_shortcode('dc_newsletter', function () {
        $action = esc_url( admin_url('admin-ajax.php?action=tnp&na=s') );

        ob_start(); ?>
        <div class="dc-newsletter">
        <form action="<?php echo $action; ?>" method="post">
            <input type="hidden" name="nr" value="minimal">
            <input type="hidden" name="nlang" value="">

            <div class="dc-newsletter__row">
            <input class="dc-newsletter__email" type="email" name="ne" required placeholder="E-mail">
            <button class="dc-newsletter__submit" type="submit">Subskrybuj</button>
            </div>

            <div class="dc-newsletter__privacy">
            <label>
                <input type="checkbox" name="ny" value="1" required>
                Akceptuję politykę prywatności
            </label>
            </div>
        </form>
        </div>

        <script>
        // Fallback walidacji – jeśli coś znów wyłączy HTML5 validate
        (function(){
            var wrap = document.currentScript.previousElementSibling;
            if(!wrap) return;
            var form = wrap.querySelector('form');
            if(!form) return;
            form.addEventListener('submit', function(e){
            var gdpr = form.querySelector('input[name="ny"]');
            if (!gdpr || gdpr.checked) return;
            e.preventDefault();
            // prosty komunikat – dopasuj do swojego UI
            gdpr.focus();
            alert('Musisz zaakceptować politykę prywatności.');
            });
        })();
        </script>
        <?php
        return ob_get_clean();
    });

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


    