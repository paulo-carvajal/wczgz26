import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';
import './style.scss';

registerBlockType( 'cddc/global-counter', {
	edit: Edit,
} );
