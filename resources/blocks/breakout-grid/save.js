import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';

export default function save() {
	const blockProps = useBlockProps.save({
		className: 'breakout-grid'
	});

	return (
		<div {...blockProps}>
			<InnerBlocks.Content />
		</div>
	);
} 