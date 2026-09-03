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
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'dc-circle' ); ?></a>

    <?php if ( $topbar = get_theme_mod( 'designcart_topbar_text' ) ) : ?>
        <div class="dc-topbar dc-style-4 text-center">
            <div class="container">
                <p class="mb-0"><?php echo esc_html( $topbar ); ?></p>
            </div>
        </div>
    <?php endif; ?>

    <header class="dc-header py-3 border-bottom <?php echo is_front_page() ? 'dc-header-fixed' : ''; ?>">
        <div class="container">
            <div class="row align-items-center justify-content-between">

                <div class="col-md-4 d-none d-md-flex justify-content-start">
                    <?php get_search_form(); ?>
                </div>

                <div class="col-md-4 text-center">
                    <?php if ( $logo = get_theme_mod( 'designcart_logo' ) ) : ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-logo">
                        </a>
                    <?php else : ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand h1 m-0"><?php bloginfo( 'name' ); ?></a>
                    <?php endif; ?>
                </div>

                <div class="col-md-4 d-none d-md-flex justify-content-end gap-2">
                    <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>" class="dc-header-btn dc-btn dc-style-2" title="<?php esc_attr_e( 'My account', 'dc-circle' ); ?>">
                        <i class="fas fa-user" aria-hidden="true"></i>
                    </a>
                    <a href="<?php echo esc_url( get_permalink( get_option( 'yith_wcwl_wishlist_page_id' ) ) ); ?>" class="dc-header-btn dc-btn dc-style-1" title="<?php esc_attr_e( 'Wishlist', 'dc-circle' ); ?>">
                        <i class="fas fa-heart" aria-hidden="true"></i>
                    </a>
                    <button type="button" class="dc-header-btn dc-btn dc-style-3 dc-slidecart-toggle" title="<?php esc_attr_e( 'Cart', 'dc-circle' ); ?>">
                        <i class="fas fa-shopping-cart" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>
    
    <?php if ( ! is_front_page() ) : ?>
        <nav class="dc-nav dc-header-desktop">
            <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'main_menu',
                        'menu_class'     => 'dc-menu dc-menu-subpage',
                        'container'      => false,
                        'fallback_cb'    => false,
                    )
                );
            ?>
        </nav>

        <nav class="dc-nav dc-nav-mobile dc-header-mobile">
            <div class="menu-mobile-header d-flex justify-content-between align-items-center">
                <div class="menu-mobile-header-title">
                    <?php esc_html_e( 'Menu', 'dc-circle' ); ?>
                </div>
                <div class="menu-mobile-header-button">
                    <button name="menuPanelToggle" type="button" class="btn-menu-toggle dc-style-3">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </nav>
    <?php endif; ?>  
    
    <?php if ( is_front_page() ) : ?>
        <div class="dc-banner">
            <?php
                $banner        = get_theme_mod( 'designcart_banner_image' );
                $banner_mobile = get_theme_mod( 'designcart_mobile_banner_image' );
            ?>

            <?php if ( $banner ) : ?>
                <img src="<?php echo esc_url( $banner ); ?>" class="dc-baner-desktop" alt="<?php bloginfo( 'name' ); ?>" />
            <?php endif; ?>
            <?php if ( $banner_mobile ) : ?>
                <img src="<?php echo esc_url( $banner_mobile ); ?>" class="dc-baner-mobile" alt="<?php bloginfo( 'name' ); ?>" />
            <?php endif; ?>

            <nav class="dc-nav-baner dc-header-desktop">
                <div class="container text-center">
                    <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'main_menu',
                                'container'      => false,
                                'menu_class'     => 'dc-menu',
                                'depth'          => 2,
                            )
                        );
                    ?>
                </div>
            </nav>

            <nav class="dc-nav-baner dc-header-mobile">
                <div class="menu-mobile-header d-flex justify-content-between align-items-center">
                    <div class="menu-mobile-header-title">
                        <?php esc_html_e( 'Menu', 'dc-circle' ); ?>
                    </div>
                    <div class="menu-mobile-header-button">
                        <button name="menuPanelToggle" type="button" class="btn-menu-toggle dc-style-3">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </nav>
                
            <div class="dc-banner-content text-start py-5 text-white">
                <h1><?php echo esc_html( get_theme_mod( 'designcart_banner_h1', __( 'Welcome to our store', 'dc-circle' ) ) ); ?></h1>
                <p class="lead"><?php echo esc_html( get_theme_mod( 'designcart_banner_subtitle', __( 'Discover curated products for everyday living.', 'dc-circle' ) ) ); ?></p>

                <?php
				$btn1_text = get_theme_mod( 'designcart_banner_btn1_text', __( 'Shop now', 'dc-circle' ) );
				$btn1_url  = get_theme_mod( 'designcart_banner_btn1_url', '' );
				if ( $btn1_text && ! $btn1_url ) {
					$btn1_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' );
				}

				$btn2_text = get_theme_mod( 'designcart_banner_btn2_text', __( 'Learn more', 'dc-circle' ) );
				$btn2_url  = get_theme_mod( 'designcart_banner_btn2_url', '' );
				if ( $btn2_text && ! $btn2_url ) {
					$btn2_url = home_url( '/' );
				}
				?>

                <?php if ( $btn1_text ) : ?>
                    <a href="<?php echo esc_url( $btn1_url ); ?>" class="btn dc-style-3 me-2">
                        <?php echo esc_html( $btn1_text ); ?>
                    </a>
                <?php endif; ?>

                <?php if ( $btn2_text ) : ?>
                    <a href="<?php echo esc_url( $btn2_url ); ?>" class="btn dc-style-2">
                        <?php echo esc_html( $btn2_text ); ?>
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
                    <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>" class="dc-header-btn dc-btn dc-style-2" title="<?php esc_attr_e( 'My account', 'dc-circle' ); ?>">
                        <i class="fas fa-user" aria-hidden="true"></i>
                    </a>
                    <a href="<?php echo esc_url( get_permalink( get_option( 'yith_wcwl_wishlist_page_id' ) ) ); ?>" class="dc-header-btn dc-btn dc-style-1" title="<?php esc_attr_e( 'Wishlist', 'dc-circle' ); ?>">
                        <i class="fas fa-heart" aria-hidden="true"></i>
                    </a>
                    <button type="button" class="dc-header-btn dc-btn dc-style-3 dc-slidecart-toggle" title="<?php esc_attr_e( 'Cart', 'dc-circle' ); ?>">
                        <i class="fas fa-shopping-cart" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <div class="dc-mobile-panel-menu">
                <?php
                    $args = array(
                        'theme_location' => 'main_menu',
                        'container'      => false,
                        'menu_class'     => 'dc-mobile-accordion list-unstyled',
                        'depth'          => 2,
                    );

                    if ( class_exists( 'DC_Mobile_Accordion_Walker' ) ) {
                        $args['walker'] = new DC_Mobile_Accordion_Walker();
                    }

                    wp_nav_menu( $args );
                ?>
            </div>

            <div class="dc-mobile-panel-search">
                <div class="d-flex justify-content-center">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
    </div>

	<div id="content" class="site-content">
