<?php
/**
 * Template: Page (static)
 */
defined('ABSPATH') || exit;

get_header();

while ( have_posts() ) : the_post(); ?>
	<main id="page-<?php the_ID(); ?>" <?php post_class('dc-page'); ?>>

		<div class="container my-5">

			<?php
			// Breadcrumb (opcjonalnie – jeśli masz)
			if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb('<p class="dc-breadcrumb small text-muted mb-3">','</p>');
			} elseif ( function_exists('rank_math_the_breadcrumbs') ) {
				rank_math_the_breadcrumbs();
			}
			?>

			<header class="mb-4">
				<h1><?php the_title(); ?></h1>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="dc-featured mb-3">
						<?php the_post_thumbnail('large', ['class'=>'img-fluid rounded']); ?>
					</div>
				<?php endif; ?>
			</header>

			<div class="row">
				<div class="col-12 col-lg-10 offset-lg-1">
					<div class="dc-content">
						<?php
						the_content();

						// Paginacja w treści (<!--nextpage-->)
						wp_link_pages([
							'before' => '<nav class="page-links my-4">',
							'after'  => '</nav>',
						]);
						?>
					</div>

					<?php if ( comments_open() || get_comments_number() ) : ?>
						<section class="dc-comments mt-5">
							<?php comments_template(); ?>
						</section>
					<?php endif; ?>
				</div>
			</div>

		</div>
	</main>
<?php endwhile;

get_footer();
