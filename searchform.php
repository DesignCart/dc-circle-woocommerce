<?php
/**
 * @package dc-circle
 * @author Paweł Nosko
 * @copyright 2026 Design Cart
 * @license GPL-2.0-or-later
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Product search form.
 *
 * @package dc-circle
 */

?>
<form role="search" method="get" class="dc-search-modern search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<?php
	$dc_search_id = wp_unique_id( 'dc-search-field-' );
	?>
	<div class="dc-search-wrapper">
		<label class="screen-reader-text" for="<?php echo esc_attr( $dc_search_id ); ?>"><?php esc_html_e( 'Search products', 'dc-circle' ); ?></label>
		<input type="search" id="<?php echo esc_attr( $dc_search_id ); ?>" name="s" class="dc-search-input dc-input-style-2 search-field" placeholder="<?php esc_attr_e( 'Enter a keyword', 'dc-circle' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>">
		<input type="hidden" name="post_type" value="product">
		<button type="submit" class="dc-search-btn dc-header-btn dc-btn dc-style-3 search-submit" title="<?php esc_attr_e( 'Search', 'dc-circle' ); ?>">
			<i class="fas fa-search" aria-hidden="true"></i>
		</button>
	</div>
</form>
