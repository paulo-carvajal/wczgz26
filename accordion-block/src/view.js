import { store, getContext } from '@wordpress/interactivity';

store( 'accordion', {
    actions: {
        toggle() {
            // getContext() recupera el contexto local del elemento que disparó la acción.
            const context = getContext();
            context.isOpen = !context.isOpen;
        }
    }
} );
