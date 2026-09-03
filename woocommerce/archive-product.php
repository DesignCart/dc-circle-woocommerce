<?php
/**
 * Product archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined('ABSPATH') || exit;
get_header('shop');
?>

<div class="container my-5">

	<?php if ( function_exists('woocommerce_breadcrumb') ) { woocommerce_breadcrumb(); } ?>

	<header class="mb-4">
		<h1 class="h2 mb-2"><?php woocommerce_page_title(); ?></h1>

		<?php
		// Opis strony sklepu (z edytora strony „Sklep” w Ustawieniach Woo)
		$shop_page_id = wc_get_page_id( 'shop' );
		if ( $shop_page_id && $shop_page_id > 0 ) {
			$shop_post = get_post( $shop_page_id );
			if ( $shop_post && ! empty( $shop_post->post_content ) ) {
				echo '<div class="text-muted">'. apply_filters( 'the_content', $shop_post->post_content ) .'</div>';
			}
		}

		// Opisy/miniatury archiwum (zachowujemy kompatybilność hooków Woo)
		do_action( 'woocommerce_archive_description' );
		?>
	</header>

	<?php
	if ( woocommerce_product_loop() ) :

		// Pasek sortowania/licznik – ten sam co w kategorii
		do_action( 'woocommerce_before_shop_loop' );

		// (Opcjonalnie) siatka KATEGORII GŁÓWNYCH nad produktami na stronie sklepu
		if ( is_shop() ) {
			$has_top_cats = woocommerce_output_product_categories( array(
				'parent_id' => 0,         // tylko główne
				'before'   => '<div class="row">', // Woo nada klasy <ul>
				'after'    => '</div>',
			) );
			// $has_top_cats zwraca true, jeśli wypisano kategorie
		}

		echo '<div class="row">';

			// Standard: subkategorie w środku listy, jeśli są
			woocommerce_maybe_show_product_subcategories();

			if ( wc_get_loop_prop( 'total' ) ) :
				while ( have_posts() ) :
					the_post();
					wc_get_template_part( 'content', 'product' );
				endwhile;
			endif;

		echo '</div>';

		// Paginacja – ta sama co w kategorii
		do_action( 'woocommerce_after_shop_loop' );

	else :

		do_action( 'woocommerce_no_products_found' );

	endif;
	?>

</div>

<?php get_footer('shop'); ?>
