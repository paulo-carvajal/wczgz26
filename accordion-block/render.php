<?php
/**
 * PHP file to render the block on the front end.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#render
 */

$items = array(
    array( 'title' => 'Sección 1', 'content' => 'Contenido de la sección 1' ),
    array( 'title' => 'Sección 2', 'content' => 'Contenido de la sección 2' ),
    array( 'title' => 'Sección 3', 'content' => 'Contenido de la sección 3' ),
);
?>

<div data-wp-interactive="accordion" class="wp-block-demo-accordion-block accordion">
    <?php foreach ( $items as $index => $item ) :
        // Inicialización del contexto local para cada elemento del acordeón
        $context = array( 'isOpen' => false, 'index' => $index );
    ?>
        <div class="accordion-item" <?php echo wp_interactivity_data_wp_context( $context ); ?>>
            <button
                class="accordion-header"
                data-wp-on--click="actions.toggle"
                data-wp-bind--aria-expanded="context.isOpen"
            >
                <?php echo esc_html( $item['title'] ); ?>
                <span data-wp-text="context.isOpen ? '−' : '+'">+</span>
            </button>
            <div
                class="accordion-content"
                data-wp-bind--hidden="!context.isOpen"
            >
                <?php echo esc_html( $item['content'] ); ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
