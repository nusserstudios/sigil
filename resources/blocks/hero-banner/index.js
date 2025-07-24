import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';

// Import styles
import './style.scss';
import './editor.scss';

// Import block metadata
import blockMetadata from './block.json';

registerBlockType(blockMetadata.name, {
    ...blockMetadata,
    edit: Edit,
    save: () => null, // Dynamic block rendered on server
}); 