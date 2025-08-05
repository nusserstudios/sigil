import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';

// Import block metadata
import blockMetadata from './block.json';

registerBlockType(blockMetadata.name, {
    ...blockMetadata,
    edit: Edit,
    // No save function - this is a dynamic block rendered by PHP
}); 