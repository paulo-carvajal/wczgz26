import { useBlockProps } from '@wordpress/block-editor';

export default function Edit() {
	const blockProps = useBlockProps();
	return (
		<div { ...blockProps }>
			<p>Búsqueda y Filtro Interactivo (Vista del Editor)</p>
			<p>Este bloque simula un listado de productos con filtros en tiempo real. La funcionalidad interactiva solo está disponible en el frontend.</p>
			<div className="search-controls" style={{ display: 'flex', gap: '10px', marginBottom: '10px' }}>
				<input type="search" placeholder="Buscar productos..." disabled style={{ flexGrow: 1 }} />
				<select disabled>
					<option>Todas las categorías</option>
				</select>
				<select disabled>
					<option>Nombre</option>
				</select>
			</div>
			<p>Mostrando 4 productos</p>
			<div className="product-grid" style={{ display: 'grid', gridTemplateColumns: 'repeat(2, 1fr)', gap: '10px' }}>
				<div className="product-card" style={{ border: '1px solid #eee', padding: '10px' }}>
					<h3>Laptop Pro</h3>
					<p>electronics</p>
					<p>$1299</p>
				</div>
				<div className="product-card" style={{ border: '1px solid #eee', padding: '10px' }}>
					<h3>Office Chair</h3>
					<p>furniture</p>
					<p>$299</p>
				</div>
			</div>
		</div>
	);
}
