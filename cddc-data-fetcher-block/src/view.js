import { store } from '@wordpress/interactivity';

const { state, actions, callbacks } = store( 'cddc/data-fetcher', {
    state: {
        posts: [],
        isLoading: false,
        error: null,
        currentPage: 1,
        hasMore: true,
    },

    actions: {
        loadMore() {
            // Incrementa la página y luego llama a la función de carga
            state.currentPage += 1;
            callbacks.fetchPosts();
        },
    },

    callbacks: {
        // Función principal para la carga de datos
        fetchPosts() {
            // No cargar si ya está cargando o no hay más páginas
            if ( state.isLoading || !state.hasMore ) return;

            state.isLoading = true;
            state.error = null;

            // URL de la API REST de WordPress para posts
            const url = `/wp-json/wp/v2/posts?_embed&per_page=5&page=${ state.currentPage }`;

            fetch( url )
                .then( ( response ) => {
                    // Verificar si hay más páginas a partir del header 'X-WP-TotalPages'
                    const totalPages = parseInt( response.headers.get( 'X-WP-TotalPages' ) );
                    state.hasMore = state.currentPage < totalPages;

                    if ( !response.ok ) {
                        throw new Error( `HTTP error! status: ${ response.status }` );
                    }
                    return response.json();
                } )
                .then( ( newPosts ) => {
                    // Concatenar los nuevos posts a la lista existente
                    state.posts = [ ...state.posts, ...newPosts ];
                } )
                .catch( ( error ) => {
                    console.error( 'Error fetching posts:', error );
                    state.error = 'Error al cargar los datos. Inténtalo de nuevo.';
                    // Revertir la página si falla la carga
                    state.currentPage -= 1;
                } )
                .finally( () => {
                    state.isLoading = false;
                } );
        },

        // Función para la carga inicial (usada en data-wp-init)
        loadInitialData() {
            // Reiniciar el estado si es necesario
            state.posts = [];
            state.currentPage = 1;
            state.hasMore = true;
            callbacks.fetchPosts();
        },
    },
} );
