<?php
defined('ABSPATH') || exit;
get_header(); ?>

<div class="container my-5">
	<div class="row">
		<div class="col-12 col-lg-10 offset-lg-1">
			<header class="mb-4">
				<h1 class="h2 mb-2"><?php single_cat_title(); ?></h1>
				<?php
				$desc = category_description();
				if ( $desc ) echo '<div class="text-muted">'. $desc .'</div>';
				?>
			</header>

			<?php if ( have_posts() ) : ?>
				<div class="row g-4">
					<?php while ( have_posts() ) : the_post(); ?>
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
					<?php the_posts_pagination(); ?>
				</div>
			<?php else : ?>
				<p>Brak wpisów.</p>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php get_footer();
