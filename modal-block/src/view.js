import { store, withSyncEvent } from '@wordpress/interactivity';

const { state } = store( 'modalExample', {
    actions: {
        openModal( event ) {
            // Obtener el título y contenido de los atributos data- del botón
            state.modalTitle = event.target.dataset.title;
            state.modalContent = event.target.dataset.content;
            state.isModalOpen = true;

            // Prevenir scroll del body
            document.body.style.overflow = 'hidden';
        },

        closeModal() {
            state.isModalOpen = false;
            document.body.style.overflow = '';
        },

        closeModalOnOverlay( event ) {
            // Solo cerrar si se hace clic en el overlay, no en el contenido
            if ( event.target.classList.contains( 'modal-overlay' ) ) {
                state.isModalOpen = false;
                document.body.style.overflow = '';
            }
        },

        // Detener la propagación del evento para evitar que el clic en el modal
        // se propague al overlay y lo cierre.
        stopPropagation: withSyncEvent( ( event ) => {
            event.stopPropagation();
        } )
    }
} );
