import { useBlockProps, RichText, InspectorControls, ColorPalette, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, TextControl, RangeControl, SelectControl, Button, ButtonGroup, ToggleControl, TextareaControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { useSelect } from '@wordpress/data';

export default function Edit({ attributes, setAttributes }) {
        const { 
            heading, subheading, buttonText, buttonUrl, overlayOpacity, breakoutType, 
            headingColorLight, headingColorDark, textColorLight, textColorDark,
            backgroundColorLight, backgroundColorDark, backgroundImage, backgroundImageId,
            backgroundOpacity, backgroundType, sectionColor,
            overlayType, overlayColor, overlayOpacity: overlayOpacityAttr,
            backgroundBlendMode, overlayBlendMode, backgroundImageFit, backgroundImagePosition,
            overlayGradientType, overlayGradientAngle, overlayGradientAngleMode, overlayGradientColor1, overlayGradientColor2, overlayCustomGradient
        } = attributes;
        
        // Get theme colors and media
        const { colors, media } = useSelect((select) => {
            const settings = select('core/block-editor').getSettings();
            return {
                colors: settings.colors || [],
                media: backgroundImageId ? select('core').getMedia(backgroundImageId) : null
            };
        }, [backgroundImageId]);
        

        
        // Blend mode options
        const blendModeOptions = [
            { label: __('Normal', 'sigil'), value: 'normal' },
            { label: __('Multiply', 'sigil'), value: 'multiply' },
            { label: __('Screen', 'sigil'), value: 'screen' },
            { label: __('Overlay', 'sigil'), value: 'overlay' },
            { label: __('Darken', 'sigil'), value: 'darken' },
            { label: __('Lighten', 'sigil'), value: 'lighten' },
            { label: __('Color Dodge', 'sigil'), value: 'color-dodge' },
            { label: __('Color Burn', 'sigil'), value: 'color-burn' },
            { label: __('Hard Light', 'sigil'), value: 'hard-light' },
            { label: __('Soft Light', 'sigil'), value: 'soft-light' },
            { label: __('Difference', 'sigil'), value: 'difference' },
            { label: __('Exclusion', 'sigil'), value: 'exclusion' },
            { label: __('Hue', 'sigil'), value: 'hue' },
            { label: __('Saturation', 'sigil'), value: 'saturation' },
            { label: __('Color', 'sigil'), value: 'color' },
            { label: __('Luminosity', 'sigil'), value: 'luminosity' },
            { label: __('Plus Darker', 'sigil'), value: 'plus-darker' },
            { label: __('Plus Lighter', 'sigil'), value: 'plus-lighter' }
        ];
        
        // Object fit options
        const objectFitOptions = [
            { label: __('Cover', 'sigil'), value: 'cover' },
            { label: __('Contain', 'sigil'), value: 'contain' },
            { label: __('Fill', 'sigil'), value: 'fill' },
            { label: __('Scale Down', 'sigil'), value: 'scale-down' },
            { label: __('None', 'sigil'), value: 'none' }
        ];
        
        // Position options
        const positionOptions = [
            { label: __('Center', 'sigil'), value: 'center' },
            { label: __('Top', 'sigil'), value: 'top' },
            { label: __('Bottom', 'sigil'), value: 'bottom' },
            { label: __('Left', 'sigil'), value: 'left' },
            { label: __('Right', 'sigil'), value: 'right' },
            { label: __('Top Left', 'sigil'), value: 'top left' },
            { label: __('Top Right', 'sigil'), value: 'top right' },
            { label: __('Bottom Left', 'sigil'), value: 'bottom left' },
            { label: __('Bottom Right', 'sigil'), value: 'bottom right' }
        ];
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
                    </PanelBody>
                    <PanelBody title={__('Layout', 'sigil')} initialOpen={false}>
                        <SelectControl
                            label={__('Content Width', 'sigil')}
                            value={breakoutType || 'normal'}
                            options={[
                                { label: __('Normal (896px)', 'sigil'), value: 'normal' },
                                { label: __('Wide (1280px)', 'sigil'), value: 'wide' },
                                { label: __('Full Width (100%)', 'sigil'), value: 'full' }
                            ]}
                            onChange={(value) => setAttributes({ breakoutType: value })}
                            help={__('Choose how wide this block should be within the page layout.', 'sigil')}
                        />
                    </PanelBody>
                    <PanelBody title={__('Colors', 'sigil')} initialOpen={false}>
                        <h4>{__('Heading Colors', 'sigil')}</h4>
                        <div style={{ marginBottom: '16px' }}>
                            <label style={{ display: 'block', marginBottom: '8px', fontWeight: '500' }}>
                                {__('Light Mode', 'sigil')}
                            </label>
                            <ColorPalette
                                colors={colors}
                                value={headingColorLight}
                                onChange={(value) => setAttributes({ headingColorLight: value })}
                                clearable={true}
                            />
                        </div>
                        <div style={{ marginBottom: '24px' }}>
                            <label style={{ display: 'block', marginBottom: '8px', fontWeight: '500' }}>
                                {__('Dark Mode', 'sigil')}
                            </label>
                            <ColorPalette
                                colors={colors}
                                value={headingColorDark}
                                onChange={(value) => setAttributes({ headingColorDark: value })}
                                clearable={true}
                            />
                        </div>
                        
                        <h4>{__('Text Colors', 'sigil')}</h4>
                        <div style={{ marginBottom: '16px' }}>
                            <label style={{ display: 'block', marginBottom: '8px', fontWeight: '500' }}>
                                {__('Light Mode', 'sigil')}
                            </label>
                            <ColorPalette
                                colors={colors}
                                value={textColorLight}
                                onChange={(value) => setAttributes({ textColorLight: value })}
                                clearable={true}
                            />
                        </div>
                        <div style={{ marginBottom: '16px' }}>
                            <label style={{ display: 'block', marginBottom: '8px', fontWeight: '500' }}>
                                {__('Dark Mode', 'sigil')}
                            </label>
                            <ColorPalette
                                colors={colors}
                                value={textColorDark}
                                onChange={(value) => setAttributes({ textColorDark: value })}
                                clearable={true}
                            />
                        </div>
                    </PanelBody>
                    
                    <PanelBody title={__('Section Color', 'sigil')} initialOpen={false}>
                        <div style={{ marginBottom: '16px' }}>
                            <label style={{ display: 'block', marginBottom: '8px', fontWeight: '500' }}>
                                {__('Section Background Color', 'sigil')}
                            </label>
                            <ColorPalette
                                colors={colors}
                                value={sectionColor}
                                onChange={(value) => setAttributes({ sectionColor: value })}
                                clearable={true}
                                enableAlpha={true}
                            />
                        </div>
                    </PanelBody>
                    
                    <PanelBody title={__('Background', 'sigil')} initialOpen={false}>
                        <SelectControl
                            label={__('Background Type', 'sigil')}
                            value={backgroundType}
                            options={[
                                { label: __('Color', 'sigil'), value: 'color' },
                                { label: __('Image', 'sigil'), value: 'image' },
                                { label: __('None', 'sigil'), value: 'none' }
                            ]}
                            onChange={(value) => setAttributes({ backgroundType: value })}
                        />
                        
                        {backgroundType === 'color' && (
                            <>
                                <h4>{__('Background Colors', 'sigil')}</h4>
                                <div style={{ marginBottom: '16px' }}>
                                    <label style={{ display: 'block', marginBottom: '8px', fontWeight: '500' }}>
                                        {__('Light Mode', 'sigil')}
                                    </label>
                                    <ColorPalette
                                        colors={colors}
                                        value={backgroundColorLight}
                                        onChange={(value) => setAttributes({ backgroundColorLight: value })}
                                        clearable={true}
                                        enableAlpha={true}
                                    />
                                </div>
                                <div style={{ marginBottom: '16px' }}>
                                    <label style={{ display: 'block', marginBottom: '8px', fontWeight: '500' }}>
                                        {__('Dark Mode', 'sigil')}
                                    </label>
                                    <ColorPalette
                                        colors={colors}
                                        value={backgroundColorDark}
                                        onChange={(value) => setAttributes({ backgroundColorDark: value })}
                                        clearable={true}
                                        enableAlpha={true}
                                    />
                                </div>
                                <RangeControl
                                    label={__('Background Opacity', 'sigil')}
                                    value={backgroundOpacity}
                                    onChange={(value) => setAttributes({ backgroundOpacity: value })}
                                    min={0}
                                    max={1}
                                    step={0.1}
                                    help={__('Adjust transparency of background color', 'sigil')}
                                />
                                <SelectControl
                                    label={__('Background Blend Mode', 'sigil')}
                                    value={backgroundBlendMode}
                                    options={blendModeOptions}
                                    onChange={(value) => setAttributes({ backgroundBlendMode: value })}
                                    help={__('How the background blends with content below', 'sigil')}
                                />
                            </>
                        )}
                        
                        {backgroundType === 'image' && (
                            <>
                                <MediaUploadCheck>
                                    <MediaUpload
                                        onSelect={(media) => setAttributes({ 
                                            backgroundImage: {
                                                url: media.url,
                                                alt: media.alt || ''
                                            },
                                            backgroundImageId: media.id 
                                        })}
                                        allowedTypes={['image']}
                                        value={backgroundImageId}
                                        render={({ open }) => (
                                            <div>
                                                {!backgroundImage && (
                                                    <Button
                                                        onClick={open}
                                                        variant="secondary"
                                                        style={{ marginBottom: '16px' }}
                                                    >
                                                        {__('Select Background Image', 'sigil')}
                                                    </Button>
                                                )}
                                                {backgroundImage && (
                                                    <div style={{ marginBottom: '16px' }}>
                                                        <img 
                                                            src={backgroundImage.url} 
                                                            alt={backgroundImage.alt}
                                                            style={{ maxWidth: '100%', height: 'auto', marginBottom: '8px' }}
                                                        />
                                                        <div>
                                                            <Button
                                                                onClick={open}
                                                                variant="secondary"
                                                                style={{ marginRight: '8px' }}
                                                            >
                                                                {__('Replace Image', 'sigil')}
                                                            </Button>
                                                            <Button
                                                                onClick={() => setAttributes({ 
                                                                    backgroundImage: null, 
                                                                    backgroundImageId: 0 
                                                                })}
                                                                variant="tertiary"
                                                                isDestructive
                                                            >
                                                                {__('Remove Image', 'sigil')}
                                                            </Button>
                                                        </div>
                                                    </div>
                                                )}
                                            </div>
                                        )}
                                    />
                                </MediaUploadCheck>
                                {backgroundImage && (
                                    <>
                                        <SelectControl
                                            label={__('Image Fit', 'sigil')}
                                            value={backgroundImageFit}
                                            options={objectFitOptions}
                                            onChange={(value) => setAttributes({ backgroundImageFit: value })}
                                            help={__('How the image should fit within the container', 'sigil')}
                                        />
                                        <SelectControl
                                            label={__('Image Position', 'sigil')}
                                            value={backgroundImagePosition}
                                            options={positionOptions}
                                            onChange={(value) => setAttributes({ backgroundImagePosition: value })}
                                            help={__('Position of the background image', 'sigil')}
                                        />
                                        <RangeControl
                                            label={__('Image Opacity', 'sigil')}
                                            value={backgroundOpacity}
                                            onChange={(value) => setAttributes({ backgroundOpacity: value })}
                                            min={0}
                                            max={1}
                                            step={0.1}
                                            help={__('Adjust transparency of background image', 'sigil')}
                                        />
                                        <SelectControl
                                            label={__('Image Blend Mode', 'sigil')}
                                            value={backgroundBlendMode}
                                            options={blendModeOptions}
                                            onChange={(value) => setAttributes({ backgroundBlendMode: value })}
                                            help={__('How the image blends with content below', 'sigil')}
                                        />
                                    </>
                                )}
                            </>
                        )}
                        

                    </PanelBody>
                    
                    <PanelBody title={__('Overlay', 'sigil')} initialOpen={false}>
                        <SelectControl
                            label={__('Overlay Type', 'sigil')}
                            value={overlayType}
                            options={[
                                { label: __('None', 'sigil'), value: 'none' },
                                { label: __('Solid Color', 'sigil'), value: 'color' },
                                { label: __('Linear Gradient', 'sigil'), value: 'linear-gradient' },
                                { label: __('Radial Gradient', 'sigil'), value: 'radial-gradient' }
                            ]}
                            onChange={(value) => setAttributes({ overlayType: value })}
                        />
                        
                        {overlayType === 'color' && (
                            <>
                                <div style={{ marginBottom: '16px' }}>
                                    <label style={{ display: 'block', marginBottom: '8px', fontWeight: '500' }}>
                                        {__('Overlay Color', 'sigil')}
                                    </label>
                                    <ColorPalette
                                        colors={colors}
                                        value={overlayColor}
                                        onChange={(value) => setAttributes({ overlayColor: value })}
                                        clearable={true}
                                        enableAlpha={true}
                                    />
                                </div>
                                <RangeControl
                                    label={__('Overlay Opacity', 'sigil')}
                                    value={overlayOpacityAttr || 0.5}
                                    onChange={(value) => setAttributes({ overlayOpacity: value })}
                                    min={0}
                                    max={1}
                                    step={0.1}
                                    help={__('Adjust transparency of overlay color', 'sigil')}
                                />
                                <SelectControl
                                    label={__('Overlay Blend Mode', 'sigil')}
                                    value={overlayBlendMode}
                                    options={blendModeOptions}
                                    onChange={(value) => setAttributes({ overlayBlendMode: value })}
                                    help={__('How the overlay blends with content below', 'sigil')}
                                />
                            </>
                        )}
                        
                        {(overlayType === 'linear-gradient' || overlayType === 'radial-gradient') && (
                            <>
                                <h4>{__('Gradient Colors', 'sigil')}</h4>
                                <div style={{ marginBottom: '16px' }}>
                                    <label style={{ display: 'block', marginBottom: '8px', fontWeight: '500' }}>
                                        {__('Start Color', 'sigil')}
                                    </label>
                                    <ColorPalette
                                        colors={colors}
                                        value={overlayGradientColor1}
                                        onChange={(value) => setAttributes({ overlayGradientColor1: value })}
                                        clearable={true}
                                        enableAlpha={true}
                                    />
                                </div>
                                <div style={{ marginBottom: '16px' }}>
                                    <label style={{ display: 'block', marginBottom: '8px', fontWeight: '500' }}>
                                        {__('End Color', 'sigil')}
                                    </label>
                                    <ColorPalette
                                        colors={colors}
                                        value={overlayGradientColor2}
                                        onChange={(value) => setAttributes({ overlayGradientColor2: value })}
                                        clearable={true}
                                        enableAlpha={true}
                                    />
                                </div>
                                {overlayType === 'linear-gradient' && (
                                    <>
                                        <h4 style={{ marginTop: '24px', marginBottom: '16px' }}>{__('Gradient Angle', 'sigil')}</h4>
                                        <SelectControl
                                            label={__('Angle Control', 'sigil')}
                                            value={overlayGradientAngleMode || 'preset'}
                                            options={[
                                                { label: __('Preset Angles', 'sigil'), value: 'preset' },
                                                { label: __('Custom Angle', 'sigil'), value: 'custom' }
                                            ]}
                                            onChange={(value) => setAttributes({ overlayGradientAngleMode: value })}
                                            help={__('Choose between preset 45° increments or custom angle input', 'sigil')}
                                        />
                                        
                                        {overlayGradientAngleMode === 'preset' ? (
                                            <SelectControl
                                                label={__('Gradient Direction', 'sigil')}
                                                value={overlayGradientAngle || 45}
                                                options={[
                                                    { label: __('0° (Left to Right)', 'sigil'), value: 0 },
                                                    { label: __('45° (Bottom-Left to Top-Right)', 'sigil'), value: 45 },
                                                    { label: __('90° (Bottom to Top)', 'sigil'), value: 90 },
                                                    { label: __('135° (Bottom-Right to Top-Left)', 'sigil'), value: 135 },
                                                    { label: __('180° (Right to Left)', 'sigil'), value: 180 },
                                                    { label: __('225° (Top-Right to Bottom-Left)', 'sigil'), value: 225 },
                                                    { label: __('270° (Top to Bottom)', 'sigil'), value: 270 },
                                                    { label: __('315° (Top-Left to Bottom-Right)', 'sigil'), value: 315 }
                                                ]}
                                                onChange={(value) => setAttributes({ overlayGradientAngle: parseInt(value) })}
                                                help={__('Select a preset gradient direction', 'sigil')}
                                            />
                                        ) : (
                                            <div style={{ marginBottom: '16px' }}>
                                                <TextControl
                                                    label={__('Custom Angle (degrees)', 'sigil')}
                                                    type="number"
                                                    value={overlayGradientAngle || 45}
                                                    onChange={(value) => {
                                                        const numValue = parseInt(value) || 0;
                                                        // Normalize angle to 0-360 range
                                                        const normalizedAngle = ((numValue % 360) + 360) % 360;
                                                        setAttributes({ overlayGradientAngle: normalizedAngle });
                                                    }}
                                                    min={0}
                                                    max={360}
                                                    help={__('Enter any angle from 0 to 360 degrees', 'sigil')}
                                                />
                                                <div style={{ fontSize: '12px', color: '#757575', marginTop: '8px' }}>
                                                    {__('Preview: ', 'sigil')} {overlayGradientAngle || 45}° 
                                                    {overlayGradientAngle === 0 && __(' (Left to Right)', 'sigil')}
                                                    {overlayGradientAngle === 90 && __(' (Bottom to Top)', 'sigil')}
                                                    {overlayGradientAngle === 180 && __(' (Right to Left)', 'sigil')}
                                                    {overlayGradientAngle === 270 && __(' (Top to Bottom)', 'sigil')}
                                                </div>
                                            </div>
                                        )}
                                    </>
                                )}
                                <RangeControl
                                    label={__('Overlay Opacity', 'sigil')}
                                    value={overlayOpacityAttr || 0.5}
                                    onChange={(value) => setAttributes({ overlayOpacity: value })}
                                    min={0}
                                    max={1}
                                    step={0.1}
                                    help={__('Adjust transparency of gradient overlay', 'sigil')}
                                />
                                <SelectControl
                                    label={__('Overlay Blend Mode', 'sigil')}
                                    value={overlayBlendMode}
                                    options={blendModeOptions}
                                    onChange={(value) => setAttributes({ overlayBlendMode: value })}
                                    help={__('How the gradient overlay blends with content below', 'sigil')}
                                />
                                <div style={{ marginTop: '16px' }}>
                                    <label style={{ display: 'block', marginBottom: '8px', fontWeight: '500' }}>
                                        {__('Custom CSS Gradient (Optional)', 'sigil')}
                                    </label>
                                    <TextareaControl
                                        value={attributes.overlayCustomGradient || ''}
                                        onChange={(value) => setAttributes({ overlayCustomGradient: value })}
                                        placeholder={__('e.g., linear-gradient(45deg, rgba(255,0,0,0.5), rgba(0,0,255,0.5))', 'sigil')}
                                        help={__('Override gradient colors with custom CSS. Supports rgba(), hsla(), and any valid CSS gradient.', 'sigil')}
                                        rows={3}
                                    />
                                </div>
                            </>
                        )}
                        

                    </PanelBody>
                </InspectorControls>
                
                <div className="simple-centered-editor" style={{
                    textAlign: 'center',
                    padding: '2rem',
                    border: '1px dashed #ccc',
                    borderRadius: '4px',
                    position: 'relative',
                    minHeight: '200px',
                    overflow: 'hidden',
                    backgroundColor: sectionColor || (backgroundType === 'color' ? (backgroundColorLight || 'transparent') : 'transparent'),
                    backgroundImage: backgroundType === 'image' && backgroundImage ? `url(${backgroundImage.url})` : 'none',
                    backgroundSize: backgroundImageFit || 'cover',
                    backgroundPosition: backgroundImagePosition || 'center',
                    opacity: backgroundType !== 'none' ? backgroundOpacity : 1,
                    mixBlendMode: backgroundBlendMode || 'normal'
                }}>
                    <RichText
                        tagName="h1"
                        value={heading}
                        onChange={(value) => setAttributes({ heading: value })}
                        placeholder={__('Enter heading...', 'sigil')}
                        style={{
                            color: headingColorLight || 'inherit',
                            marginBottom: '1rem'
                        }}
                    />
                    <RichText
                        tagName="p"
                        value={subheading}
                        onChange={(value) => setAttributes({ subheading: value })}
                        placeholder={__('Enter text...', 'sigil')}
                        style={{
                            color: textColorLight || 'inherit',
                            marginBottom: buttonText ? '1.5rem' : '0'
                        }}
                    />
                    {buttonText && (
                        <a href={buttonUrl} className="simple-centered-button" style={{
                            display: 'inline-block',
                            padding: '0.75rem 1.5rem',
                            backgroundColor: '#007cba',
                            color: 'white',
                            textDecoration: 'none',
                            borderRadius: '4px'
                        }}>
                            {buttonText}
                        </a>
                    )}
                </div>
            </div>
        );
} 