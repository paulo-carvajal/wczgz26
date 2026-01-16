import { useBlockProps } from '@wordpress/block-editor';

export default function Edit() {
	const blockProps = useBlockProps();
	return (
		<div { ...blockProps }>
			<p>Contador Interactivo (Vista del Editor)</p>
			<p>El contador se inicializa a 0. Usa los botones para cambiar el valor.</p>
			<div className="counter-block">
				<button disabled>-</button>
				<span>0</span>
				<button disabled>+</button>
				<button disabled>Reset</button>
			</div>
		</div>
	);
}
