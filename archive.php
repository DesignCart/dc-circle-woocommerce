<?php
defined('ABSPATH') || exit;
get_header();

global $wp_query;

$paged = max( 1, get_query_var('paged'), get_query_var('page') );
$args  = array_merge( $wp_query->query_vars, [
	'category__not_in' => [22],
	'paged'            => $paged,
	'no_found_rows'    => false, // potrzebne do paginacji
]);

$loop = new WP_Query( $args );
?>
<div class="container my-5">
	<div class="row">
		<div class="col-12 col-lg-10 offset-lg-1">
			<header class="mb-4">
				<h1 class="h2 mb-2"><?php the_archive_title(); ?></h1>
				<?php
				$desc = get_the_archive_description();
				if ( $desc ) echo '<div class="text-muted">'. $desc .'</div>';
				?>
			</header>

			<?php if ( $loop->have_posts() ) : ?>
				<div class="row g-4">
					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
						<div class="col-12 col-md-6 col-lg-4">
							<article <?php post_class('dc-article h-100'); ?>>
								<div class="dc-article-image">
									<?php if ( has_post_thumbnail() ) : ?>
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('medium', ['class' => 'card-img-top']); ?>
										</a>
										<div class="dc-article-info small text-muted">
											<?php echo get_the_date(); ?> • <?php the_author(); ?>
										</div>
									<?php endif; ?>
								</div>
								<div class="dc-article-body">
									<h2 class="h5 dc-article-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h2>
									<p class="dc-article-text"><?php echo wp_trim_words( get_the_excerpt(), 24 ); ?></p>
								</div>
								<div class="dc-article-footer">
									<a href="<?php the_permalink(); ?>">Czytaj więcej...</a>
								</div>
							</article>
						</div>
					<?php endwhile; ?>
				</div>

				<div class="mt-4">
					<?php
					echo paginate_links([
						'total'   => $loop->max_num_pages,
						'current' => $paged,
						'prev_text' => '«',
						'next_text' => '»',
					]);
					?>
				</div>
			<?php else : ?>
				<p>Brak wpisów.</p>
			<?php endif; ?>

			<?php wp_reset_postdata(); ?>
		</div>
	</div>
</div>

<?php get_footer();
