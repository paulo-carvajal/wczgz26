import { useBlockProps } from '@wordpress/block-editor';

export default function Edit() {
	const blockProps = useBlockProps();
	return (
		<div { ...blockProps }>
			<div className="global-counter-block">
				<h3>Contador Global</h3>
				<p className="global-counter-description">
					Este bloque mostrará el total de todos los contadores en la
					página.
				</p>
				<div className="global-counter-preview">
					<div className="global-total">
						<span className="total-label">Total:</span>
						<span className="total-value">0</span>
					</div>
					<div className="counter-list-preview">
						<p>Lista de contadores aparecerá aquí...</p>
					</div>
				</div>
			</div>
		</div>
	);
}
