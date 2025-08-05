/**
 * Breakout Enhancements for Core Blocks
 * Adds breakout controls to specified blocks
 */

import { __ } from '@wordpress/i18n';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';
import { addFilter } from '@wordpress/hooks';
import { createHigherOrderComponent } from '@wordpress/compose';

/**
 * Add breakout attribute to enabled blocks
 */
function addBreakoutAttribute(settings, name) {
    // Only add to enabled blocks
    if (!sigilBreakout.enabledBlocks.includes(name)) {
        return settings;
    }

    // Add the breakout attribute
    return {
        ...settings,
        attributes: {
            ...settings.attributes,
            breakoutType: {
                type: 'string',
                default: sigilBreakout.defaultBreakout
            }
        }
    };
}

/**
 * Add breakout controls to block inspector
 */
const withBreakoutControls = createHigherOrderComponent((BlockEdit) => {
    return (props) => {
        const { name, attributes, setAttributes } = props;
        
        // Only show for enabled blocks
        if (!sigilBreakout.enabledBlocks.includes(name)) {
            return <BlockEdit {...props} />;
        }

        const { breakoutType = sigilBreakout.defaultBreakout } = attributes;

        // Create options array from the localized data
        const breakoutOptions = Object.entries(sigilBreakout.breakoutOptions).map(([value, label]) => ({
            label,
            value
        }));

        return (
            <>
                <BlockEdit {...props} />
                <InspectorControls>
                    <PanelBody 
                        title={__('Layout', 'sigil')} 
                        initialOpen={false}
                    >
                        <SelectControl
                            label={__('Content Width', 'sigil')}
                            value={breakoutType}
                            options={breakoutOptions}
                            onChange={(value) => setAttributes({ breakoutType: value })}
                            help={__('Choose how wide this block should be within the page layout.', 'sigil')}
                        />
                    </PanelBody>
                </InspectorControls>
            </>
        );
    };
}, 'withBreakoutControls');

/**
 * Add CSS class to block wrapper based on breakout type
 */
function addBreakoutClass(extraProps, blockType, attributes) {
    const { name } = blockType;
    
    // Only add to enabled blocks
    if (!sigilBreakout.enabledBlocks.includes(name)) {
        return extraProps;
    }

    const { breakoutType = sigilBreakout.defaultBreakout } = attributes;
    
    // Don't add class for normal (default behavior)
    if (breakoutType === 'normal') {
        return extraProps;
    }

    // Add the breakout class
    const breakoutClass = `breakout-${breakoutType}`;
    
    return {
        ...extraProps,
        className: extraProps.className ? 
            `${extraProps.className} ${breakoutClass}` : 
            breakoutClass
    };
}

/**
 * Register all the filters
 */
function registerBreakoutEnhancements() {
    // Add attribute to block settings
    addFilter(
        'blocks.registerBlockType',
        'sigil/add-breakout-attribute',
        addBreakoutAttribute
    );

    // Add inspector controls
    addFilter(
        'editor.BlockEdit',
        'sigil/add-breakout-controls',
        withBreakoutControls
    );

    // Add CSS class to block wrapper
    addFilter(
        'blocks.getSaveContent.extraProps',
        'sigil/add-breakout-class',
        addBreakoutClass
    );
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', registerBreakoutEnhancements);
} else {
    registerBreakoutEnhancements();
} 