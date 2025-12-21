<?php
/**
 * PHP file to render the block on the front end.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#render
 */

// Inicialización del estado para el store 'counter'
wp_interactivity_state( 'counter', array( 'count' => 0 ) );
?>
<div data-wp-interactive="counter" class="wp-block-demo-counter-block counter-block">
    <button data-wp-on--click="actions.decrement">−</button>
    <span data-wp-text="state.count">0</span>
    <button data-wp-on--click="actions.increment">+</button>
    <button data-wp-on--click="actions.reset">Reset</button>
</div>
