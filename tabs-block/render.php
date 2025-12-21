<?php
/**
 * PHP file to render the block on the front end.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#render
 */

$tabs = array(
    array( 'id' => 'info', 'label' => 'Información', 'content' => 'Contenido de información...' ),
    array( 'id' => 'specs', 'label' => 'Especificaciones', 'content' => 'Especificaciones técnicas...' ),
    array( 'id' => 'reviews', 'label' => 'Reseñas', 'content' => 'Reseñas de usuarios...' ),
);

// Estado global para el bloque
wp_interactivity_state( 'tabsBlock', array(
    'activeTab' => 'info',
) );
?>

<div
    data-wp-interactive="tabsBlock"
    class="wp-block-demo-tabs-block tabs-container"
>
    <div class="tabs-nav" role="tablist">
        <?php foreach ( $tabs as $tab ) :
            $tab_context = array( 'tabId' => $tab['id'] );
        ?>
            <button
                role="tab"
                <?php echo wp_interactivity_data_wp_context( $tab_context ); ?>
                data-wp-on--click="actions.setTab"
                data-wp-class--active="state.isActiveTab"
                data-wp-bind--aria-selected="state.isActiveTab"
            >
                <?php echo esc_html( $tab['label'] ); ?>
            </button>
        <?php endforeach; ?>
    </div>

    <div class="tabs-content">
        <?php foreach ( $tabs as $tab ) :
            $tab_context = array( 'tabId' => $tab['id'] );
        ?>
            <div
                role="tabpanel"
                <?php echo wp_interactivity_data_wp_context( $tab_context ); ?>
                data-wp-bind--hidden="!state.isActiveTab"
            >
                <?php echo esc_html( $tab['content'] ); ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
