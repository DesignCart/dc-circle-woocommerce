<?php
/**
 * Newsletter form markup (use with Newsletter plugin or custom block).
 *
 * @package dc-circle
 * @author Paweł Nosko
 * @copyright 2026 Design Cart
 * @license GPL-2.0-or-later
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$action = esc_url( admin_url( 'admin-ajax.php?action=tnp&na=s' ) );
?>
<div class="dc-newsletter">
	<form action="<?php echo $action; ?>" method="post">
		<input type="hidden" name="nr" value="minimal">
		<input type="hidden" name="nlang" value="">

		<div class="dc-newsletter__row">
			<input class="dc-newsletter__email" type="email" name="ne" required placeholder="<?php esc_attr_e( 'E-mail', 'dc-circle' ); ?>">
			<button class="dc-newsletter__submit" type="submit"><?php esc_html_e( 'Subscribe', 'dc-circle' ); ?></button>
		</div>

		<div class="dc-newsletter__privacy">
			<label>
				<input type="checkbox" name="ny" value="1" required>
				<?php esc_html_e( 'I accept the privacy policy', 'dc-circle' ); ?>
			</label>
		</div>
	</form>
</div>
