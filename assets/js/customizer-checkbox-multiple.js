/**
 * Customizer checkbox-multiple control script.
 *
 * @package dc-circle
 * @author Paweł Nosko
 * @copyright 2026 Design Cart
 */
(function ($) {
	$(document).on('ready', function () {
		$('.customize-control-checkbox-multiple').each(function () {
			var $root = $(this);
			var $hidden = $root.find('input[type="hidden"][data-customize-setting-link]');

			if (!$hidden.length) {
				return;
			}

			$root.on('change', '.dc-circle-checkbox-multiple input[type="checkbox"]', function () {
				var vals = [];
				$root.find('.dc-circle-checkbox-multiple input[type="checkbox"]:checked').each(function () {
					vals.push($(this).val());
				});
				$hidden.val(JSON.stringify(vals)).trigger('change');
			});
		});
	});
})(jQuery);
