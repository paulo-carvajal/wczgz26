import { store } from '@wordpress/interactivity';

const { state } = store( 'counter', {
    state: {
        count: 0,
    },
    actions: {
        increment() {
            state.count += 1;
        },
        decrement() {
            state.count -= 1;
        },
        reset() {
            state.count = 0;
        }
    }
} );
