import { InnerBlocks } from '@wordpress/block-editor';

// Deprecated version 1: Dynamic block with textAlignment
const v1 = {
    attributes: {
        maxWidth: {
            type: "string",
            default: "max-w-4xl"
        },
        textAlignment: {
            type: "string",
            default: "text-start"
        }
    },
    save: () => null, // Was a dynamic block
    migrate: (attributes, innerBlocks) => {
        // Remove textAlignment since we're using WordPress native alignment
        const { textAlignment, ...newAttributes } = attributes;
        return [newAttributes, innerBlocks];
    },
    isEligible: (attributes) => {
        // This version had textAlignment attribute
        return attributes.hasOwnProperty('textAlignment');
    }
};

// Deprecated version 2: Dynamic block without textAlignment
const v2 = {
    attributes: {
        maxWidth: {
            type: "string",
            default: "max-w-4xl"
        }
    },
    save: () => null, // Was a dynamic block
    migrate: (attributes, innerBlocks) => {
        return [attributes, innerBlocks];
    },
    isEligible: (attributes, innerBlocks, blockType) => {
        // This version was a dynamic block (no save content)
        return blockType.save === null || typeof blockType.save === 'function' && blockType.save() === null;
    }
};

export default [v1, v2]; 