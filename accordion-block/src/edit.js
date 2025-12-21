import { useBlockProps } from '@wordpress/block-editor';

export default function Edit() {
	const blockProps = useBlockProps();
	return (
		<div { ...blockProps }>
			<p>Acordeón Interactivo (Vista del Editor)</p>
			<p>Este bloque simula un acordeón interactivo. Haz clic en los títulos para expandir/colapsar (solo en el frontend).</p>
			<div className="accordion">
				<div className="accordion-item">
					<button className="accordion-header">Sección 1 <span>+</span></button>
					<div className="accordion-content" style={{ padding: '10px', border: '1px solid #eee' }}>Contenido de la sección 1</div>
				</div>
				<div className="accordion-item">
					<button className="accordion-header">Sección 2 <span>+</span></button>
					<div className="accordion-content" style={{ padding: '10px', border: '1px solid #eee', display: 'none' }}>Contenido de la sección 2</div>
				</div>
			</div>
		</div>
	);
}
