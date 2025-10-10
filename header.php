<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body 
    <?php body_class(); ?>>

    <?php if ( $topbar = get_theme_mod( 'designcart_topbar_text' ) ) : ?>
        <div class="dc-topbar dc-style-4 text-center">
            <div class="container">
                <p class="mb-0"><?= esc_html( $topbar ); ?></p>
            </div>
        </div>
    <?php endif; ?>

    <header class="dc-header py-3 border-bottom <?php if (is_front_page()) : ?>dc-header-fixed<?php endif; ?>">
        <div class="container">
            <div class="row align-items-center justify-content-between">

                <div class="col-md-4 d-none d-md-flex justify-content-start">
                    <form role="search" method="get" class="dc-search-modern" action="<?= esc_url( home_url( '/' ) ); ?>">
                        <div class="dc-search-wrapper">
                            <input type="search" name="s" class="dc-search-input dc-input-style-2" placeholder="Wpisz słowo kluczowe" value="<?= get_search_query(); ?>">
                            <input type="hidden" name="post_type" value="product" />
                            <button type="submit" class="dc-search-btn dc-header-btn dc-btn dc-style-3" title="Szukaj">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="col-md-4 text-center">
                    <?php if ( $logo = get_theme_mod( 'designcart_logo' ) ) : ?>
                        <a href="<?= esc_url( home_url( '/' ) ); ?>">
                            <img src="<?= esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-logo">
                        </a>
                    <?php else : ?>
                        <a href="<?= esc_url( home_url( '/' ) ); ?>" class="navbar-brand h1 m-0"><?php bloginfo( 'name' ); ?></a>
                    <?php endif; ?>
                </div>

                <div class="col-md-4 d-none d-md-flex justify-content-end gap-2">
                    <a href="<?= esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" class="dc-header-btn dc-btn dc-style-2" title="Moje konto">
                        <i class="fas fa-user"></i>
                    </a>
                    <a href="<?php echo esc_url( get_permalink( get_option( 'yith_wcwl_wishlist_page_id' ) ) ); ?>" class="dc-header-btn dc-btn dc-style-1" title="Lista życzeń">
                        <i class="fas fa-heart"></i>
                    </a>
                    <!--
                    <a href="<?= esc_url( wc_get_cart_url() ); ?>" class="dc-header-btn dc-btn dc-style-3" title="Koszyk">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                    -->
                    <button id="cart-toggle" class="dc-header-btn dc-btn dc-style-3" title="Koszyk">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>
    
    <?php if (!is_front_page()) : ?>
        <nav class="dc-nav dc-header-desktop">
            
            <?php
                wp_nav_menu( array(
                    'theme_location' => 'main_menu',
                    'menu_class'     => 'dc-menu dc-menu-subpage',
                    'container'      => false,
                    'fallback_cb'    => false,
                ) );
            ?>
            
        </nav>

        <nav class="dc-nav dc-nav-mobile dc-header-mobile">
            <div class="menu-mobile-header d-flex justify-content-between align-items-center">
                <div class="menu-mobile-header-title">
                    Menu
                </div>
                <div class="menu-mobile-header-button">
                    <button name="menuPanelToggle" type="button" class="btn-menu-toggle dc-style-3">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
            </div>
        </nav>
    <?php endif; ?>  
    
    <?php if (is_front_page()) : ?>
        <div class="dc-banner">

            <?php
                $banner        = get_theme_mod('designcart_banner_image');
                $banner_mobile = get_theme_mod('designcart_mobile_banner_image');
            ?>

            <img src="<?= esc_url( $banner ); ?>" class="dc-baner-desktop" alt="<?php bloginfo( 'name' ); ?>" />
            <img src="<?= esc_url( $banner_mobile ); ?>" class="dc-baner-mobile" alt="<?php bloginfo( 'name' ); ?>" />

            <nav class="dc-nav-baner dc-header-desktop">
                <div class="container text-center">
                    <?php
                        wp_nav_menu( array(
                            'theme_location' => 'main_menu',
                            'container' => false,
                            'menu_class' => 'dc-menu',
                            'depth' => 2,
                        ) );
                    ?>
                </div>
            </nav>

            <nav class="dc-nav-baner dc-header-mobile">
                <div class="menu-mobile-header d-flex justify-content-between align-items-center">
                    <div class="menu-mobile-header-title">
                        Menu
                    </div>
                    <div class="menu-mobile-header-button">
                        <button name="menuPanelToggle" type="button" class="btn-menu-toggle dc-style-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                </div>
            </nav>
                
            <div class="dc-banner-content text-start py-5 text-white">
                <h1><?= esc_html( get_theme_mod('designcart_banner_h1') ); ?></h1>
                <p class="lead"><?= esc_html( get_theme_mod('designcart_banner_subtitle') ); ?></p>

                <?php if ( get_theme_mod('designcart_banner_btn1_text') ) : ?>
                    <a href="<?= esc_url( get_theme_mod('designcart_banner_btn1_url') ); ?>" class="btn dc-style-3 me-2">
                        <?= esc_html( get_theme_mod('designcart_banner_btn1_text') ); ?>
                    </a>
                <?php endif; ?>

                <?php if ( get_theme_mod('designcart_banner_btn2_text') ) : ?>
                    <a href="<?= esc_url( get_theme_mod('designcart_banner_btn2_url') ); ?>" class="btn dc-style-2">
                        <?= esc_html( get_theme_mod('designcart_banner_btn2_text') ); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>  
    <div class="dc-mobile-overlay"></div>          
    <div id="dc-mobile-panel" class="dc-mobile-panel dc-header-mobile">
        <span class="dc-mobile-close dc-style-4">&times;</span>
        <div class="dc-mobile-panel-content">
            <div class="dc-mobile-panel-icons">
                <div class="d-flex justify-content-center gap-2">
                    <a href="<?= esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" class="dc-header-btn dc-btn dc-style-2" title="Moje konto">
                        <i class="fas fa-user"></i>
                    </a>
                    <a href="<?php echo esc_url( get_permalink( get_option( 'yith_wcwl_wishlist_page_id' ) ) ); ?>" class="dc-header-btn dc-btn dc-style-1" title="Lista życzeń">
                        <i class="fas fa-heart"></i>
                    </a>
                    <!--
                    <a href="<?= esc_url( wc_get_cart_url() ); ?>" class="dc-header-btn dc-btn dc-style-3" title="Koszyk">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                    -->
                    <button id="cart-toggle" class="dc-header-btn dc-btn dc-style-3" title="Koszyk">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                </div>
            </div>
            <div class="dc-mobile-panel-menu">
                <?php
                    $args = [
                        'theme_location' => 'main_menu',
                        'container'      => false,
                        'menu_class'     => 'dc-mobile-accordion list-unstyled',
                        'depth'          => 2,
                    ];

                    if ( class_exists( 'DC_Mobile_Accordion_Walker' ) ) {
                        $args['walker'] = new DC_Mobile_Accordion_Walker();
                    }

                    wp_nav_menu( $args );
                ?>
            </div>

            <div class="dc-mobile-panel-search">
                <div class="d-flex justify-content-center">
                    <form role="search" method="get" class="dc-search-modern" action="<?= esc_url( home_url( '/' ) ); ?>">
                        <div class="dc-search-wrapper">
                            <input type="search" name="s" class="dc-search-input dc-input-style-2" placeholder="Wpisz słowo kluczowe" value="<?= get_search_query(); ?>">
                            <input type="hidden" name="post_type" value="product" />
                            <button type="submit" class="dc-search-btn dc-header-btn dc-btn dc-style-3" title="Szukaj">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    
