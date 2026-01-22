<?php
/**
 * PHP file to render the Global Counter block on the front end.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#render
 */

?>
<div
	data-wp-interactive="cddc/counter"
	data-wp-init="callbacks.logMount"
	class="wp-block-cddc-global-counter global-counter-block"
>
	<h3 class="global-counter-title"><?php esc_html_e( 'Contador Global', 'cddc-global-counter-block' ); ?></h3>

	<div class="global-total">
		<span class="total-label"><?php esc_html_e( 'Total:', 'cddc-global-counter-block' ); ?></span>
		<span class="total-value" data-wp-text="state.total">0</span>
	</div>

</div>
