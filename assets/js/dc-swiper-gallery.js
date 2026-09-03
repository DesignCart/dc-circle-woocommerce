/**
 * Single product Swiper gallery.
 *
 * @package dc-circle
 * @author Paweł Nosko
 * @copyright 2026 Design Cart
 */
document.addEventListener('DOMContentLoaded', function () {
	if (typeof Swiper === 'undefined') {
		return;
	}

	var thumbsEl = document.querySelector('.mySwiper');
	var mainEl = document.querySelector('.mySwiper2');

	if (!thumbsEl || !mainEl) {
		return;
	}

	var thumbs = new Swiper('.mySwiper', {
		spaceBetween: 10,
		slidesPerView: 4,
		freeMode: true,
		watchSlidesProgress: true,
	});

	new Swiper('.mySwiper2', {
		spaceBetween: 10,
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
		thumbs: {
			swiper: thumbs,
		},
	});
});
