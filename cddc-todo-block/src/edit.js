import { useBlockProps } from '@wordpress/block-editor';

export default function Edit() {
	const blockProps = useBlockProps();
	return (
		<div { ...blockProps }>
			<p>Lista de Tareas Interactivas (Vista del Editor)</p>
			<p>Este bloque simula una aplicación de lista de tareas. La funcionalidad interactiva solo está disponible en el frontend.</p>
			<form>
				<input type="text" placeholder="Nueva tarea..." disabled />
				<button type="submit" disabled>Añadir</button>
			</form>
			<div className="filters">
				<button className="active" disabled>Todas</button>
				<button disabled>Activas</button>
				<button disabled>Completadas</button>
			</div>
			<p>2 tareas pendientes</p>
			<ul className="task-list">
				<li><input type="checkbox" disabled /> Aprender Interactivity API <button disabled>×</button></li>
				<li><input type="checkbox" disabled /> Crear un bloque interactivo <button disabled>×</button></li>
			</ul>
		</div>
	);
}
