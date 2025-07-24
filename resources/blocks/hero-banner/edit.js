import { useBlockProps, RichText, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, RangeControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

export default function Edit({ attributes, setAttributes }) {
        const { heading, subheading, buttonText, buttonUrl, overlayOpacity } = attributes;
        const blockProps = useBlockProps();

        return (
            <div {...blockProps}>
                <InspectorControls>
                    <PanelBody title={__('Hero Banner Settings', 'sigil')}>
                        <TextControl
                            label={__('Heading', 'sigil')}
                            value={heading}
                            onChange={(value) => setAttributes({ heading: value })}
                        />
                        <TextControl
                            label={__('Subheading', 'sigil')}
                            value={subheading}
                            onChange={(value) => setAttributes({ subheading: value })}
                        />
                        <TextControl
                            label={__('Button Text', 'sigil')}
                            value={buttonText}
                            onChange={(value) => setAttributes({ buttonText: value })}
                        />
                        <TextControl
                            label={__('Button URL', 'sigil')}
                            value={buttonUrl}
                            onChange={(value) => setAttributes({ buttonUrl: value })}
                        />
                        <RangeControl
                            label={__('Overlay Opacity', 'sigil')}
                            value={overlayOpacity}
                            onChange={(value) => setAttributes({ overlayOpacity: value })}
                            min={0}
                            max={1}
                            step={0.1}
                        />
                    </PanelBody>
                </InspectorControls>
                
                <div className="hero-banner-editor">
                    <RichText
                        tagName="h1"
                        value={heading}
                        onChange={(value) => setAttributes({ heading: value })}
                        placeholder={__('Enter heading...', 'sigil')}
                    />
                    <RichText
                        tagName="p"
                        value={subheading}
                        onChange={(value) => setAttributes({ subheading: value })}
                        placeholder={__('Enter subheading...', 'sigil')}
                    />
                    {buttonText && (
                        <a href={buttonUrl} className="hero-banner-button">
                            {buttonText}
                        </a>
                    )}
                </div>
            </div>
        );
} 