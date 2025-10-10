<?php get_header(); ?>

<?php if ( is_active_sidebar( 'home-widget-1' ) ) : ?>
    <div class="home-widget home-widget-1">
        <div class="container my-5">
            <?php dynamic_sidebar( 'home-widget-1' ); ?>
        </div>
    </div>
<?php endif; ?>

<?php include 'modules/product_news.php'; ?>

<?php if ( is_active_sidebar( 'home-widget-2' ) ) : ?>
    <div class="home-widget home-widget-2">
        <div class="container my-5">
            <?php dynamic_sidebar( 'home-widget-2' ); ?>
        </div>
    </div>
<?php endif; ?>

<?php include 'modules/product_sales.php'; ?>

<?php if ( is_active_sidebar( 'home-widget-3' ) ) : ?>
    <div class="home-widget home-widget-3">
        <div class="container my-5">
            <?php dynamic_sidebar( 'home-widget-3' ); ?>
        </div>
    </div>
<?php endif; ?>

<?php include 'modules/product_bestsellers.php'; ?>

<?php if ( is_active_sidebar( 'home-widget-4' ) ) : ?>
    <div class="home-widget home-widget-4">
        <div class="container my-5">
            <?php dynamic_sidebar( 'home-widget-4' ); ?>
        </div>
    </div>
<?php endif; ?>

<?php include 'modules/product_featureds.php'; ?>

<?php if ( is_active_sidebar( 'home-widget-5' ) ) : ?>
    <div class="home-widget home-widget-5">
        <div class="container my-5">
            <?php dynamic_sidebar( 'home-widget-5' ); ?>
        </div>
    </div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'reviews' ) ) : ?>
    <div id="reviews">
        <div class="reviews-container">
            <?php dynamic_sidebar( 'reviews' ); ?>
        </div>
    </div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'home-widget-6' ) ) : ?>
    <div class="home-widget home-widget-6">
        <div class="container my-5">
            <?php dynamic_sidebar( 'home-widget-6' ); ?>
        </div>
    </div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'home-blog' ) ) : ?>
    <div class="home-widget home-blog">
        <div class="container my-5">
            <?php dynamic_sidebar( 'home-blog' ); ?>
        </div>
    </div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'home-widget-7' ) ) : ?>
    <div class="ome-widget home-widget-7">
        <div class="container my-5">
            <?php dynamic_sidebar( 'home-widget-7' ); ?>
        </div>
    </div>
<?php endif; ?>

<?php get_footer(); ?>