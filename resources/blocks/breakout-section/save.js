import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';

export default function save({ attributes }) {
	const { breakoutType } = attributes;
	
	const blockProps = useBlockProps.save({
		className: `breakout-section breakout-${breakoutType}`
	});

	return (
		<div {...blockProps}>
			<InnerBlocks.Content />
		</div>
	);
} 