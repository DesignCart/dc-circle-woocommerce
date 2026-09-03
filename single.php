<?php
/**
 * Template: Single Post
 */
defined('ABSPATH') || exit;

get_header(); ?>

<div class="container my-5">
	<div class="row">
		<div class="col-lg-8">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('dc-single-post'); ?>>

					<header class="mb-3">
						<h1 class="mb-2"><?php the_title(); ?></h1>
						<div class="text-muted small">
							<time datetime="<?php echo esc_attr( get_the_date('c') ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
							<span class="mx-2">•</span>
							<span><?php the_author(); ?></span>
							<?php if ( has_category() ) : ?>
								<span class="mx-2">•</span>
								<span><?php the_category(', '); ?></span>
							<?php endif; ?>
						</div>
					</header>

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="mb-4">
							<?php the_post_thumbnail('large', ['class' => 'img-fluid rounded']); ?>
						</div>
					<?php endif; ?>

					<div class="entry-content">
						<?php
							the_content();

							// Paginacja treści (<!--nextpage-->)
							wp_link_pages([
								'before' => '<nav class="page-links my-4">',
								'after'  => '</nav>',
							]);
						?>
					</div>

					<footer class="mt-4">
						<?php the_tags( '<div class="small">' . esc_html__( 'Tags:', 'dc-circle' ) . ' ', ', ', '</div>' ); ?>
					</footer>

				</article>

				<hr class="my-5">

				<nav class="d-flex justify-content-between">
					<div class="prev"><?php previous_post_link( '%link', esc_html__( '&larr; Previous post', 'dc-circle' ) ); ?></div>
					<div class="next"><?php next_post_link( '%link', esc_html__( 'Next post &rarr;', 'dc-circle' ) ); ?></div>
				</nav>

				<?php if ( comments_open() || get_comments_number() ) : ?>
					<section class="mt-5">
						<?php comments_template(); ?>
					</section>
				<?php endif; ?>

			<?php endwhile; else : ?>

				<p><?php esc_html_e( 'No content.', 'dc-circle' ); ?></p>

			<?php endif; ?>

		</div>

        <div class="col-lg-4">
            <aside class="dc-sidebar">
                <div class="mb-4">
                    <h5 class="mb-3"><?php esc_html_e( 'Latest posts', 'dc-circle' ); ?></h5>

                    <?php
                    $q = new WP_Query([
                    'post_type'           => 'post',
                    'posts_per_page'      => 5,
                    'post_status'         => 'publish',
                    'orderby'             => 'date',
                    'order'               => 'DESC',
                    'ignore_sticky_posts' => true,
                    'no_found_rows'       => true,
                    'category__not_in'    => [22], // ← WYKLUCZ KATEGORIĘ ID=22
                    ]);

                    if ( $q->have_posts() ) : ?>
                    <ul class="list-unstyled dc-recent-posts">
                        <?php while ( $q->have_posts() ) : $q->the_post(); ?>
                        <li class="dc-recent d-flex gap-3 mb-3">
                            <a href="<?php the_permalink(); ?>" class="dc-recent-thumb ratio ratio-1x1 flex-shrink-0" style="width:88px;">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail('thumbnail', ['class'=>'w-100 h-100', 'style'=>'object-fit:cover;']); ?>
                            <?php else : ?>
                                <span class="w-100 h-100 d-block bg-light border rounded"></span>
                            <?php endif; ?>
                            </a>
                            <div class="dc-recent-body">
                            <div class="small text-muted mb-1"><?php echo esc_html( get_the_date() ); ?></div>
                            <h6 class="mb-1"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                            <a class="btn btn-sm btn-outline-secondary" href="<?php the_permalink(); ?>"><?php esc_html_e( 'More', 'dc-circle' ); ?></a>
                            </div>
                        </li>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                    <?php else : ?>
                    <p class="text-muted small mb-0"><?php esc_html_e( 'No posts found.', 'dc-circle' ); ?></p>
                    <?php endif; ?>
                </div>

                <div class="mb-4">
                    <h5 class="mb-3"><?php esc_html_e( 'Archives', 'dc-circle' ); ?></h5>
                    <ul class="list-unstyled mb-0">
                    <?php wp_get_archives(['type'=>'monthly']); ?>
                    </ul>
                </div>
                </aside>
        </div>
	</div>
</div>

<?php get_footer();
