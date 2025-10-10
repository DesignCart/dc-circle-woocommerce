jQuery(function($){
	function clamp(val, min, max){
		val = isNaN(val) ? 0 : val;
		if (min !== '' && !isNaN(min)) val = Math.max(val, parseFloat(min));
		if (max !== '' && !isNaN(max)) val = Math.min(val, parseFloat(max));
		return val;
	}

	$(document).on('click', '.dc-qty-plus, .dc-qty-minus', function(){
		const $wrap = $(this).closest('[data-qty]');
		const $inp  = $wrap.find('input[type="number"]');
		let val  = parseFloat($inp.val() || 0);
		const stp = parseFloat($inp.attr('step') || 1);
		const min = $inp.attr('min');
		const max = $inp.attr('max');

		val += $(this).hasClass('dc-qty-plus') ? stp : -stp;
		val = clamp(val, min, max);
		$inp.val(val).trigger('change');
	});

	// Gdy wybierasz wariant, Woo podmienia fragment formularza – delegacja załatwia sprawę.
	$(document).on('found_variation', 'form.variations_form', function(){
		// nic specjalnego nie trzeba — nasz handler działa delegowane
	});
});
