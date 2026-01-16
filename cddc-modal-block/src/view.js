import { store } from '@wordpress/interactivity';

const { state } = store( 'cddc/modal', {
	state: {
		isModalOpen: false,
		modalType: 'info', // 'info' | 'confirm' | 'prompt'
		modalTitle: '',
		modalContent: '',
		promptValue: '',
		// Resultado de la última confirmación (para demo)
		lastConfirmResult: null,
		lastPromptValue: null,

		// Getters para mostrar/ocultar elementos según tipo
		get isInfoModal() {
			return state.modalType === 'info';
		},
		get isConfirmModal() {
			return state.modalType === 'confirm';
		},
		get isPromptModal() {
			return state.modalType === 'prompt';
		},
		get showCancelButton() {
			return state.modalType === 'confirm' || state.modalType === 'prompt';
		},
		get showConfirmButton() {
			return state.modalType === 'confirm' || state.modalType === 'prompt';
		},
		get showCloseButton() {
			return state.modalType === 'info';
		},
		get hasResult() {
			return state.lastConfirmResult !== null || state.lastPromptValue !== null;
		},
		get resultMessage() {
			if ( state.lastPromptValue !== null ) {
				return `Prompt: "${ state.lastPromptValue }"`;
			}
			if ( state.lastConfirmResult !== null ) {
				return state.lastConfirmResult ? 'Confirmado' : 'Cancelado';
			}
			return '';
		},
	},
	actions: {
		openModal( event ) {
			const { title, content, type = 'info' } = event.target.dataset;

			state.modalTitle = title || 'Modal';
			state.modalContent = content || '';
			state.modalType = type;
			state.promptValue = '';
			state.isModalOpen = true;

			document.body.style.overflow = 'hidden';
		},

		closeModal() {
			state.isModalOpen = false;
			document.body.style.overflow = '';
		},

		// Para modal de confirmación: usuario confirma
		confirm() {
			state.lastConfirmResult = true;
			state.lastPromptValue = null;

			if ( state.modalType === 'prompt' ) {
				state.lastPromptValue = state.promptValue;
				state.lastConfirmResult = null;
			}

			state.isModalOpen = false;
			document.body.style.overflow = '';

			// Aquí se podría disparar un evento custom para que otros
			// bloques o scripts reaccionen a la confirmación
			document.dispatchEvent(
				new CustomEvent( 'modal:confirmed', {
					detail: {
						type: state.modalType,
						value: state.promptValue || true,
					},
				} )
			);
		},

		// Para modal de confirmación: usuario cancela
		cancel() {
			state.lastConfirmResult = false;
			state.lastPromptValue = null;
			state.isModalOpen = false;
			document.body.style.overflow = '';

			document.dispatchEvent(
				new CustomEvent( 'modal:cancelled', {
					detail: { type: state.modalType },
				} )
			);
		},

		// Actualizar valor del prompt
		updatePromptValue( event ) {
			state.promptValue = event.target.value;
		},

		closeModalOnOverlay( event ) {
			if ( event.target.classList.contains( 'modal-overlay' ) ) {
				// En confirm/prompt, cerrar overlay = cancelar
				if ( state.modalType === 'confirm' || state.modalType === 'prompt' ) {
					state.lastConfirmResult = false;
				}
				state.isModalOpen = false;
				document.body.style.overflow = '';
			}
		},

		// Limpiar resultado (para demo)
		clearResult() {
			state.lastConfirmResult = null;
			state.lastPromptValue = null;
		},
	},
} );
