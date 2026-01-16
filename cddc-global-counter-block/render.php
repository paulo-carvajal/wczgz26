<?php
/**
 * PHP file to render the Global Counter block on the front end.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#render
 */

// Asegura que el estado del store 'cddc/counter' existe
wp_interactivity_state(
	'cddc/counter',
	array(
		'counters' => array(),
	)
);
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

	<div class="counter-list">
		<h4><?php esc_html_e( 'Contadores individuales:', 'cddc-global-counter-block' ); ?></h4>
		<ul data-wp-each="state.counterList">
			<template data-wp-each-child>
				<li class="counter-item">
					<span class="counter-item-label" data-wp-text="context.item.label"></span>:
					<span class="counter-item-value" data-wp-text="context.item.value">0</span>
				</li>
			</template>
		</ul>
		<p
			class="no-counters-message"
			data-wp-bind--hidden="state.counterList.length"
		>
			<?php esc_html_e( 'No hay contadores en la página.', 'cddc-global-counter-block' ); ?>
		</p>
	</div>

	<button
		class="reset-all-button"
		data-wp-on--click="actions.resetAll"
	>
		<?php esc_html_e( 'Resetear todos', 'cddc-global-counter-block' ); ?>
	</button>
</div>
