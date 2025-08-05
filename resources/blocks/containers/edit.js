import { useBlockProps, InnerBlocks, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

export default function Edit({ attributes, setAttributes }) {
    const { maxWidth } = attributes;
    const blockProps = useBlockProps({
        className: maxWidth
    });

    const maxWidthOptions = [
        { label: __('3XS (16rem)', 'sigil'), value: 'max-w-3xs' },
        { label: __('2XS (18rem)', 'sigil'), value: 'max-w-2xs' },
        { label: __('XS (20rem)', 'sigil'), value: 'max-w-xs' },
        { label: __('Small (24rem)', 'sigil'), value: 'max-w-sm' },
        { label: __('Medium (28rem)', 'sigil'), value: 'max-w-md' },
        { label: __('Large (32rem)', 'sigil'), value: 'max-w-lg' },
        { label: __('XL (36rem)', 'sigil'), value: 'max-w-xl' },
        { label: __('2XL (42rem)', 'sigil'), value: 'max-w-2xl' },
        { label: __('3XL (48rem)', 'sigil'), value: 'max-w-3xl' },
        { label: __('4XL (56rem)', 'sigil'), value: 'max-w-4xl' },
        { label: __('5XL (64rem)', 'sigil'), value: 'max-w-5xl' },
        { label: __('6XL (72rem)', 'sigil'), value: 'max-w-6xl' },
        { label: __('7XL (80rem)', 'sigil'), value: 'max-w-7xl' }
    ];

    return (
        <div {...blockProps}>
            <InspectorControls>
                <PanelBody title={__('Container Settings', 'sigil')}>
                    <SelectControl
                        label={__('Max Width', 'sigil')}
                        value={maxWidth}
                        options={maxWidthOptions}
                        onChange={(value) => setAttributes({ maxWidth: value })}
                        help={__('Set the maximum width for the container', 'sigil')}
                    />
                </PanelBody>
            </InspectorControls>
            
            <div className="container-block-editor">
                <div className="container-preview-label">
                    <small>
                        {__('Container:', 'sigil')} {maxWidth}
                    </small>
                </div>
                <InnerBlocks 
                    renderAppender={InnerBlocks.DefaultAppender}
                />
            </div>
        </div>
    );
} 