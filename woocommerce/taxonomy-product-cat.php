<?php
/**
 * Product Category taxonomy
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/taxonomy-product-cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.7.0
 */

defined('ABSPATH') || exit;
get_header(); ?>

<div class="container my-5">
	<?php

	if ( function_exists('woocommerce_breadcrumb') ) {
		woocommerce_breadcrumb();
	}
	?>

	<header class="mb-4">
		<h1 class="h2 mb-2"><?php woocommerce_page_title(); ?></h1>
		<?php do_action('woocommerce_archive_description'); // opis kategorii, miniaturka itp. ?>
	</header>

	<?php if ( woocommerce_product_loop() ) : ?>
        <div class="dc-products-sort">
		    <?php do_action('woocommerce_before_shop_loop'); // sortowanie, licznik, filtry itp. ?>
        </div>
		<div class="row">
			<?php if ( wc_get_loop_prop('total') ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php wc_get_template_part( 'content', 'product' ); // jeden kafelek produktu ?>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>

		<?php do_action('woocommerce_after_shop_loop'); // paginacja ?>

	<?php else : ?>

		<?php do_action('woocommerce_no_products_found'); ?>

	<?php endif; ?>
</div>

<?php get_footer();
