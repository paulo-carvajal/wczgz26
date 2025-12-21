import { useBlockProps } from '@wordpress/block-editor';

export default function Edit() {
	const blockProps = useBlockProps();
	return (
		<div { ...blockProps }>
			<p>Cargador de Datos Interactivo (Vista del Editor)</p>
			<p>Este bloque carga datos de la API REST de WordPress. La funcionalidad interactiva solo está disponible en el frontend.</p>
			<div style={{ padding: '10px', border: '1px dashed #ccc', textAlign: 'center' }}>
				<p>Cargando datos de la API REST...</p>
				<p>Se mostrarán los posts aquí.</p>
			</div>
			<button disabled style={{ marginTop: '10px' }}>Cargar más</button>
		</div>
	);
}
