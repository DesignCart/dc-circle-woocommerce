jQuery(function($) {
	// === OPEN/CLOSE ===
	function openSlidecart() {
		$('#dc-slidecart').addClass('open');
		$('.dc-slidecart-overlay').fadeIn(150);
		$('body').addClass('dc-no-scroll');
	}
	function closeSlidecart() {
		$('#dc-slidecart').removeClass('open');
		$('.dc-slidecart-overlay').fadeOut(150);
		$('body').removeClass('dc-no-scroll');
	}
	// Udostępnij globalnie (opcjonalnie)
	window.dcOpenSlidecart  = openSlidecart;
	window.dcCloseSlidecart = closeSlidecart;

	// === FRAGMENTS START ===
	// Odśwież mini-koszyk na starcie (bez auto-otwierania!)
	if (typeof wc_cart_fragments_params !== 'undefined') {
		$(document.body).trigger('wc_fragment_refresh');
	} else {
		$.post('/?wc-ajax=get_refreshed_fragments').done(function(data){
			if (data && data.fragments && data.fragments['div.widget_shopping_cart_content']) {
				$('#dc-slidecart-inner .widget_shopping_cart_content').replaceWith(data.fragments['div.widget_shopping_cart_content']);
			}
		});
	}

	// === TOGGLE ===
	$(document).on('click', '#cart-toggle, .dc-slidecart-toggle', function(e){
		e.preventDefault();
		openSlidecart();
	});

	// === CLOSE ===
	$(document).on('click', '.dc-slidecart-overlay, .dc-slidecart-close', closeSlidecart);
	$(document).on('keydown', function(e){ if (e.key === 'Escape') closeSlidecart(); });

	// === AUTO-OPEN TYLKO PO DODANIU DO KOSZYKA (AJAX) ===
	$(document.body).on('added_to_cart', function(){
		openSlidecart();
	});

	// NIE otwieraj na te eventy – to się dzieje też przy zwykłym odświeżeniu:
	// removed_from_cart updated_cart_totals wc_fragments_refreshed
	// (zostawiamy bez akcji)

	// === PO RELOADZIE PO SUBMICIE (single, bez AJAX) ===
	$('form.cart').on('submit', function(){
		// ustaw flagę, żeby po reloadzie otworzyć koszyk
		sessionStorage.setItem('dcOpenMiniCartAfterReload', '1');
	});
	if ( sessionStorage.getItem('dcOpenMiniCartAfterReload') === '1' ) {
		sessionStorage.removeItem('dcOpenMiniCartAfterReload');
		openSlidecart();
	}
});


// ===== QUANTITY W SLIDECARCIE (ZOSTAWIAM, TYLKO KOSMETYKA) =====
jQuery(document).ready(function($) {
	const updateCartQuantity = (cartItemKey, quantity) => {
		$.ajax({
			type: 'POST',
			url: wc_add_to_cart_params.ajax_url,
			data: {
				action: 'designcart_update_cart_item_quantity',
				cart_item_key: cartItemKey,
				quantity: quantity,
			},
			success: function(response) {
				if (response.success) {
					$(document.body).trigger('wc_fragment_refresh');
				} else {
					alert(response.data || 'Nie udało się zaktualizować koszyka.');
				}
			},
			error: function() {
				alert('Wystąpił błąd przy aktualizacji koszyka.');
			}
		});
	};

	$(document).on('click', '#dc-products-listing .dc-qty-btn', function(e){
		e.preventDefault();

		const $button     = $(this);
		const $qtyWrapper = $button.closest('.dc-qty-wrapper');
		const $input      = $qtyWrapper.find('.dc-qty-input');
		let currentQty    = parseInt($input.val(), 10);
		const minQty      = parseInt($input.attr('min')) || 1;
		const cartItemKey = $input.data('cart_item_key');

		if ($button.hasClass('dc-qty-plus')) {
			currentQty++;
		} else {
			currentQty--;
			if (currentQty < minQty) currentQty = minQty;
		}

		$input.val(currentQty);
		updateCartQuantity(cartItemKey, currentQty);
	});
});
