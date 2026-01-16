import { useBlockProps } from '@wordpress/block-editor';

export default function Edit() {
	const blockProps = useBlockProps();
	return (
		<div { ...blockProps }>
			<p>Modal Interactivo (Vista del Editor)</p>
			<p>Este bloque proporciona botones para activar un modal con estado global. La funcionalidad interactiva solo está disponible en el frontend.</p>
			<button disabled>Abrir Modal Info</button>
			<button disabled>Abrir Modal Confirmación</button>
			<div style={{ marginTop: '10px', padding: '10px', border: '1px dashed #ccc' }}>
				Estructura del Modal (Oculta en el editor)
			</div>
		</div>
	);
}
