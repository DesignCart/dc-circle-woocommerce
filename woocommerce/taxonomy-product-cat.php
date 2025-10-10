<?php
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
