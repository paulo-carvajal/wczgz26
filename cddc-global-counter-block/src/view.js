/**
 * Global Counter Block - Interactivity API View
 *
 * Extiende el store 'cddc/counter' con getters derivados y acciones
 * para mostrar y gestionar todos los contadores.
 */
import { store } from '@wordpress/interactivity';

const { state } = store( 'cddc/counter', {
	state: {
		// Asegura que counters existe (por si este bloque carga primero)
		counters: {},

		// Getter: suma total de todos los contadores
		get total() {
			return Object.values( state.counters ).reduce(
				( sum, counter ) => sum + counter.value,
				0
			);
		},

		// Getter: array de contadores para iterar con data-wp-each
		get counterList() {
			return Object.entries( state.counters ).map( ( [ id, counter ] ) => ( {
				id,
				value: counter.value,
				label: counter.label,
			} ) );
		},
	},
	actions: {
		// Resetea todos los contadores a cero
		resetAll() {
			Object.keys( state.counters ).forEach( ( id ) => {
				state.counters[ id ].value = 0;
			} );
		},
	},
} );
