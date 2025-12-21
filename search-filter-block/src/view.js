import { store } from '@wordpress/interactivity';

const { state } = store( 'productSearch', {
    state: {
        // Estado inicial - products viene de PHP via wp_interactivity_state()
        searchQuery: '',
        selectedCategory: 'all',
        sortBy: 'name',

        get filteredProducts() {
            if ( ! state.products || ! Array.isArray( state.products ) ) {
                return [];
            }
            let result = [ ...state.products ];

            // 1. Filtrar por búsqueda
            if ( state.searchQuery.trim() ) {
                const query = state.searchQuery.toLowerCase();
                result = result.filter( p =>
                    p.name.toLowerCase().includes( query )
                );
            }

            // 2. Filtrar por categoría
            if ( state.selectedCategory !== 'all' ) {
                result = result.filter( p =>
                    p.category === state.selectedCategory
                );
            }

            // 3. Ordenar
            switch ( state.sortBy ) {
                case 'price-asc':
                    result.sort( ( a, b ) => a.price - b.price );
                    break;
                case 'price-desc':
                    result.sort( ( a, b ) => b.price - a.price );
                    break;
                default:
                    // Ordenar por nombre alfabéticamente
                    result.sort( ( a, b ) => a.name.localeCompare( b.name ) );
            }

            return result;
        },

        // Getter para el conteo de resultados
        get resultsCount() {
            return state.filteredProducts.length;
        },

        // Getter para saber si hay resultados
        get hasResults() {
            return state.filteredProducts.length > 0;
        }
    },

    actions: {
        updateSearch( event ) {
            state.searchQuery = event.target.value;
        },

        updateCategory( event ) {
            state.selectedCategory = event.target.value;
        },

        updateSort( event ) {
            state.sortBy = event.target.value;
        }
    }
} );
