<?php
/**
 * PHP file to render the block on the front end.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#render
 */

// Genera un ID único para esta instancia del contador
$counter_id = wp_unique_id( 'counter-' );

// Contexto local para esta instancia
$context = array(
	'id'           => $counter_id,
	'value' => 0,
	'label'        => sprintf( __( 'Counter %s', 'cddc-counter-block' ), substr( $counter_id, -1 ) ),
);
?>
<div
	data-wp-interactive="cddc/counter"
	<?php echo wp_interactivity_data_wp_context( $context ); ?>
	data-wp-init="callbacks.init"
	class="wp-block-cddc-counter counter-block"
>
	<span class="counter-label" data-wp-text="context.label"></span>
	<div class="counter-controls">
		<button data-wp-on--click="actions.decrement">−</button>
		<span data-wp-text="context.value">0</span>
		<button data-wp-on--click="actions.increment">+</button>
		<button data-wp-on--click="actions.reset">Reset</button>
	</div>
</div>
