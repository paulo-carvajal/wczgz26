<?php
/**
 * PHP file to render the block on the front end.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#render
 */

// Inicialización del estado para el store 'cddc/modal'
wp_interactivity_state(
	'cddc/modal',
	array(
		'isModalOpen'       => false,
		'modalType'         => 'info',
		'modalTitle'        => '',
		'modalContent'      => '',
		'promptValue'       => '',
		'lastConfirmResult' => null,
		'lastPromptValue'   => null,
	)
);
?>

<div data-wp-interactive="cddc/modal" class="wp-block-cddc-modal">
	<div class="modal-triggers">
		<!-- Modal Info -->
		<button
			class="trigger-info"
			data-wp-on--click="actions.openModal"
			data-type="info"
			data-title="<?php esc_attr_e( 'Información', 'cddc-modal-block' ); ?>"
			data-content="<?php esc_attr_e( 'Este es un modal informativo. Solo muestra un mensaje y se cierra.', 'cddc-modal-block' ); ?>"
		>
			<?php esc_html_e( 'Modal Info', 'cddc-modal-block' ); ?>
		</button>

		<!-- Modal Confirmación -->
		<button
			class="trigger-confirm"
			data-wp-on--click="actions.openModal"
			data-type="confirm"
			data-title="<?php esc_attr_e( 'Confirmar acción', 'cddc-modal-block' ); ?>"
			data-content="<?php esc_attr_e( '¿Estás seguro de que deseas continuar con esta acción?', 'cddc-modal-block' ); ?>"
		>
			<?php esc_html_e( 'Modal Confirmación', 'cddc-modal-block' ); ?>
		</button>

		<!-- Modal Prompt -->
		<button
			class="trigger-prompt"
			data-wp-on--click="actions.openModal"
			data-type="prompt"
			data-title="<?php esc_attr_e( 'Introduce tu nombre', 'cddc-modal-block' ); ?>"
			data-content="<?php esc_attr_e( 'Por favor, escribe tu nombre para continuar:', 'cddc-modal-block' ); ?>"
		>
			<?php esc_html_e( 'Modal Prompt', 'cddc-modal-block' ); ?>
		</button>
	</div>

	<!-- Resultado de la última acción -->
	<div
		class="modal-result"
		data-wp-class--visible="state.hasResult"
	>
		<span class="result-label"><?php esc_html_e( 'Último resultado:', 'cddc-modal-block' ); ?></span>
		<span class="result-value" data-wp-text="state.resultMessage"></span>
		<button
			class="result-clear"
			data-wp-on--click="actions.clearResult"
			aria-label="<?php esc_attr_e( 'Limpiar resultado', 'cddc-modal-block' ); ?>"
		>×</button>
	</div>

	<!-- Modal -->
	<div
		class="modal-overlay"
		data-wp-class--visible="state.isModalOpen"
		data-wp-on--click="actions.closeModalOnOverlay"
	>
		<div class="modal-content">
			<header class="modal-header">
				<h2 data-wp-text="state.modalTitle"><?php esc_html_e( 'Título', 'cddc-modal-block' ); ?></h2>
				<button
					class="modal-close"
					data-wp-on--click="actions.closeModal"
					aria-label="<?php esc_attr_e( 'Cerrar', 'cddc-modal-block' ); ?>"
				>×</button>
			</header>

			<div class="modal-body">
				<p data-wp-text="state.modalContent"><?php esc_html_e( 'Contenido', 'cddc-modal-block' ); ?></p>

				<!-- Input para modal prompt -->
				<div
					class="modal-prompt-input"
					data-wp-bind--hidden="!state.isPromptModal"
				>
					<input
						type="text"
						data-wp-on--input="actions.updatePromptValue"
						data-wp-bind--value="state.promptValue"
						placeholder="<?php esc_attr_e( 'Escribe aquí...', 'cddc-modal-block' ); ?>"
					/>
				</div>
			</div>

			<footer class="modal-footer">
				<!-- Botón Cerrar (solo info) -->
				<button
					class="btn-close"
					data-wp-on--click="actions.closeModal"
					data-wp-bind--hidden="!state.showCloseButton"
				>
					<?php esc_html_e( 'Cerrar', 'cddc-modal-block' ); ?>
				</button>

				<!-- Botón Cancelar (confirm/prompt) -->
				<button
					class="btn-cancel"
					data-wp-on--click="actions.cancel"
					data-wp-bind--hidden="!state.showCancelButton"
				>
					<?php esc_html_e( 'Cancelar', 'cddc-modal-block' ); ?>
				</button>

				<!-- Botón Confirmar (confirm/prompt) -->
				<button
					class="btn-confirm"
					data-wp-on--click="actions.confirm"
					data-wp-bind--hidden="!state.showConfirmButton"
				>
					<?php esc_html_e( 'Confirmar', 'cddc-modal-block' ); ?>
				</button>
			</footer>
		</div>
	</div>
</div>
