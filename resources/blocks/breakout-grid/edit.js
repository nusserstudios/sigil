import { useBlockProps, InnerBlocks, InspectorControls } from '@wordpress/block-editor';
import { PanelBody } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

export default function Edit() {
	const blockProps = useBlockProps({
		className: 'breakout-grid'
	});

	// Template for initial blocks - helps users understand the structure
	const TEMPLATE = [
		['core/heading', { 
			content: __('Breakout Grid Example', 'sigil'),
			level: 2 
		}],
		['core/paragraph', { 
			content: __('This content is in the normal content area (max-w-4xl). Add any blocks here and they will be constrained to the content width.', 'sigil')
		}],
		['sigil/breakout-section', {}],
		['core/paragraph', { 
			content: __('This content is back in the normal content area. The breakout grid automatically handles the layout.', 'sigil')
		}]
	];

	return (
		<div {...blockProps}>
			<InspectorControls>
				<PanelBody title={__('Breakout Grid Settings', 'sigil')}>
					<p>{__('This grid provides three content areas:', 'sigil')}</p>
					<ul>
						<li><strong>{__('Normal:', 'sigil')}</strong> {__('max-w-4xl (896px)', 'sigil')}</li>
						<li><strong>{__('Wide:', 'sigil')}</strong> {__('1280px width', 'sigil')}</li>
						<li><strong>{__('Full:', 'sigil')}</strong> {__('100% width breakout', 'sigil')}</li>
					</ul>
					<p>{__('Use the Breakout Section block to create wide or full-width content areas.', 'sigil')}</p>
				</PanelBody>
			</InspectorControls>
			
			<div className="breakout-grid-editor">
				<div className="breakout-grid-label">
					<small>{__('Breakout Grid Container', 'sigil')}</small>
				</div>
				<InnerBlocks 
					template={TEMPLATE}
					renderAppender={InnerBlocks.DefaultAppender}
				/>
			</div>
		</div>
	);
} 