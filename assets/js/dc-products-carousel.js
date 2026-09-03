/**
 * Product carousel initialization.
 *
 * @package dc-circle
 * @author Paweł Nosko
 * @copyright 2026 Design Cart
 */
jQuery(function ($) {
	$('.dc-products-carousel-module').each(function () {
		var $module = $(this);
		var $carousel = $module.find('.dc-products-carousel.owl-carousel');

		if (!$carousel.length || $carousel.hasClass('owl-loaded')) {
			return;
		}

		$carousel.owlCarousel({
			loop: true,
			margin: 10,
			nav: false,
			responsive: {
				0: { items: 1 },
				600: { items: 3 },
				1000: { items: 4 },
			},
		});

		$module.find('.dc-owl-prev').on('click', function () {
			$carousel.trigger('prev.owl.carousel');
		});

		$module.find('.dc-owl-next').on('click', function () {
			$carousel.trigger('next.owl.carousel');
		});
	});

	$('.dc-cart-products-carousel.owl-carousel').each(function () {
		var $carousel = $(this);

		if ($carousel.hasClass('owl-loaded')) {
			return;
		}

		$carousel.owlCarousel({
			items: 5,
			margin: 10,
			loop: true,
			nav: true,
			navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
			responsive: {
				0: { items: 2 },
				600: { items: 3 },
				1000: { items: 5 },
			},
		});
	});
});
