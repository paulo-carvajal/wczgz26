<?php
/**
 * PHP file to render the block on the front end.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#render
 */

// Inicialización del estado para el store 'modalExample'
wp_interactivity_state( 'modalExample', array(
    'isModalOpen' => false,
    'modalTitle' => '',
    'modalContent' => '',
) );
?>

<div data-wp-interactive="modalExample" class="wp-block-demo-modal-block">
    <!-- Botones para abrir modal -->
    <button
        data-wp-on--click="actions.openModal"
        data-title="Información"
        data-content="Este es el contenido del modal de información."
    >
        Abrir Modal Info
    </button>

    <button
        data-wp-on--click="actions.openModal"
        data-title="Confirmación"
        data-content="¿Estás seguro de que deseas continuar?"
    >
        Abrir Modal Confirmación
    </button>

    <!-- Modal -->
    <div
        class="modal-overlay"
        data-wp-class--visible="state.isModalOpen"
        data-wp-on--click="actions.closeModalOnOverlay"
    >
        <div
            class="modal-content"
            data-wp-on--click="actions.stopPropagation"
        >
            <header class="modal-header">
                <h2 data-wp-text="state.modalTitle">Título</h2>
                <button
                    class="modal-close"
                    data-wp-on--click="actions.closeModal"
                    aria-label="Cerrar"
                >×</button>
            </header>

            <div class="modal-body">
                <p data-wp-text="state.modalContent">Contenido</p>
            </div>

            <footer class="modal-footer">
                <button data-wp-on--click="actions.closeModal">
                    Cerrar
                </button>
            </footer>
        </div>
    </div>
</div>
