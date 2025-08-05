import { registerBlockType } from '@wordpress/blocks';
import { InnerBlocks } from '@wordpress/block-editor';
import Edit from './edit';
import deprecated from './deprecated';

// Import block metadata
import blockMetadata from './block.json';

registerBlockType(blockMetadata.name, {
    ...blockMetadata,
    edit: Edit,
    save: ({ attributes }) => {
        const { maxWidth } = attributes;
        
        return (
            <div className={`wp-block-sigil-container ${maxWidth}`}>
                <InnerBlocks.Content />
            </div>
        );
    },
    deprecated,
}); 