<?php
/**
 * Template: Front Page (static homepage)
 */
defined('ABSPATH') || exit;

get_header();

while ( have_posts() ) : the_post(); ?>
	<main id="frontpage-<?php the_ID(); ?>" <?php post_class('dc-frontpage'); ?>>

		<div class="container my-5">
			<header class="mb-4">
				<h1 class="h2 mb-2"><?php the_title(); ?></h1>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="mb-3">
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
				</div>
			</div>
		</div>

	</main>
<?php endwhile;

get_footer();
