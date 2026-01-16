/**
 * Counter Block - Interactivity API View
 *
 * Define el store 'cddc/counter' con el estado base y las acciones
 * para un contador individual.
 */
import { store, getContext } from '@wordpress/interactivity';

const { state } = store( 'cddc/counter', {
	state: {
		// Objeto que almacena todos los contadores: { id: { value, label } }
		counters: {},

		// Getter: valor del contador actual (usando contexto)
		get value() {
			const ctx = getContext();
			return state.counters[ ctx.id ]?.value ?? 0;
		},
	},
	actions: {
		increment() {
			const ctx = getContext();
			if ( state.counters[ ctx.id ] ) {
				state.counters[ ctx.id ].value += 1;
			}
		},

		decrement() {
			const ctx = getContext();
			if ( state.counters[ ctx.id ] ) {
				state.counters[ ctx.id ].value -= 1;
			}
		},

		reset() {
			const ctx = getContext();
			if ( state.counters[ ctx.id ] ) {
				state.counters[ ctx.id ].value = 0;
			}
		},
	},
	callbacks: {
		// Registra el contador cuando el bloque se monta
		init() {
			const ctx = getContext();
			if ( ctx.id && ! state.counters[ ctx.id ] ) {
				state.counters[ ctx.id ] = {
					value: ctx.initialValue ?? 0,
					label: ctx.label ?? ctx.id,
				};
			}
		},
	},
} );
