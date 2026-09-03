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
</div><!-- #content -->

<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                    <div class="footer-widget footer-widget-1">
                        <?php dynamic_sidebar( 'footer-1' ); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-sm-3 offset-sm-1">
                <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                    <div class="footer-widget footer-widget-2">
                        <?php dynamic_sidebar( 'footer-2' ); ?>
                    </div>
                <?php endif; ?>

                <div class="footer-menu-wrapper">
                    <h4><?php esc_html_e( 'Menu', 'dc-circle' ); ?></h4>
                    <?php
                        wp_nav_menu([
                            'theme_location' => 'footer_menu',
                            'menu_class'     => 'footer-menu',
                            'container'      => false
                        ]);
				    ?>
                </div>
            </div>

            <div class="col-sm-3 offset-sm-1">
                <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                    <div class="footer-widget footer-widget-3">
                        <?php dynamic_sidebar( 'footer-3' ); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="copyright-wrapper">
    <div class="copyright">
        <div class="container">
            <?php
            echo wp_kses_post(
                sprintf(
                    /* translators: 1: site link, 2: author link */
                    __( 'All rights reserved %1$s - Copyright &copy; | Designed by %2$s', 'dc-circle' ),
                    '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>',
                    '<a href="' . esc_url( wp_get_theme()->get( 'AuthorURI' ) ) . '" target="_blank" rel="noopener noreferrer">' . esc_html( wp_get_theme()->get( 'Author' ) ) . '</a>'
                )
            );
            ?>
        </div>
    </div>
</div>

<?php get_template_part( 'template-parts/slidecart' ); ?>

<?php wp_footer(); ?>