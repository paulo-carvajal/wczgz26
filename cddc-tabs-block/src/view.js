import { store, getContext } from '@wordpress/interactivity';

const { state } = store( 'cddc/tabs', {
    state: {
        activeTab: 'info',
        get isActiveTab() {
            const context = getContext();
            return state.activeTab === context.tabId;
        }
    },
    actions: {
        setTab() {
            const context = getContext();
            state.activeTab = context.tabId;
        }
    }
} );
