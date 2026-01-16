import { useBlockProps } from '@wordpress/block-editor';

export default function Edit() {
	const blockProps = useBlockProps();
	return (
		<div { ...blockProps }>
			<p>Pestañas Interactivas (Vista del Editor)</p>
			<p>Este bloque simula un sistema de pestañas. La funcionalidad interactiva solo está disponible en el frontend.</p>
			<div className="tabs-container">
				<div className="tabs-nav" style={{ borderBottom: '2px solid #ccc' }}>
					<button style={{ border: '1px solid #ccc', borderBottom: 'none', padding: '5px 10px', backgroundColor: '#fff' }}>Información</button>
					<button style={{ border: '1px solid #ccc', borderBottom: 'none', padding: '5px 10px', backgroundColor: '#f0f0f0' }}>Especificaciones</button>
					<button style={{ border: '1px solid #ccc', borderBottom: 'none', padding: '5px 10px', backgroundColor: '#f0f0f0' }}>Reseñas</button>
				</div>
				<div className="tabs-content" style={{ border: '1px solid #ccc', padding: '10px' }}>
					<p>Contenido de la pestaña activa (Información).</p>
				</div>
			</div>
		</div>
	);
}
