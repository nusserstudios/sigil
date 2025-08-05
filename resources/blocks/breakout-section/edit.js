import { useBlockProps, InnerBlocks, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

export default function Edit({ attributes, setAttributes }) {
	const { breakoutType } = attributes;
	
	const blockProps = useBlockProps({
		className: `breakout-section breakout-${breakoutType}`
	});

	const breakoutOptions = [
		{ label: __('Wide (1280px)', 'sigil'), value: 'wide' },
		{ label: __('Full Width (100%)', 'sigil'), value: 'full' }
	];

	return (
		<div {...blockProps}>
			<InspectorControls>
				<PanelBody title={__('Breakout Settings', 'sigil')}>
					<SelectControl
						label={__('Breakout Type', 'sigil')}
						value={breakoutType}
						options={breakoutOptions}
						onChange={(value) => setAttributes({ breakoutType: value })}
						help={__('Choose how wide this section should be', 'sigil')}
					/>
				</PanelBody>
			</InspectorControls>
			
			<div className="breakout-section-editor">
				<div className="breakout-section-label">
					<small>
						{__('Breakout Section:', 'sigil')} {breakoutType === 'wide' ? __('Wide (1280px)', 'sigil') : __('Full Width', 'sigil')}
					</small>
				</div>
				<InnerBlocks 
					renderAppender={InnerBlocks.DefaultAppender}
				/>
			</div>
		</div>
	);
} 