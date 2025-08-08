<?php
/**
 * Simple Centered Block Template
 */

// Extract attributes with defaults
$heading = $attributes['heading'] ?? 'Your Heading Here';
$subheading = $attributes['subheading'] ?? 'Your text content goes here';
$button_text = $attributes['buttonText'] ?? '';
$button_url = $attributes['buttonUrl'] ?? '#';
$overlay_opacity = $attributes['overlayOpacity'] ?? 0.5;
$breakout_type = $attributes['breakoutType'] ?? 'normal';
$heading_color_light = $attributes['headingColorLight'] ?? '';
$heading_color_dark = $attributes['headingColorDark'] ?? '';
$text_color_light = $attributes['textColorLight'] ?? '';
$text_color_dark = $attributes['textColorDark'] ?? '';
$background_color_light = $attributes['backgroundColorLight'] ?? '';
$background_color_dark = $attributes['backgroundColorDark'] ?? '';
$background_image = $attributes['backgroundImage'] ?? null;
$background_image_id = $attributes['backgroundImageId'] ?? 0;

$background_opacity = $attributes['backgroundOpacity'] ?? 1;
$background_type = $attributes['backgroundType'] ?? 'color';
$section_color = $attributes['sectionColor'] ?? '';
$overlay_type = $attributes['overlayType'] ?? 'none';

$overlay_color = $attributes['overlayColor'] ?? '';
$overlay_opacity = $attributes['overlayOpacity'] ?? 0.5;
$overlay_gradient_type = $attributes['overlayGradientType'] ?? 'linear';
$overlay_gradient_angle = $attributes['overlayGradientAngle'] ?? 45;
$overlay_gradient_angle_mode = $attributes['overlayGradientAngleMode'] ?? 'preset';
$overlay_gradient_color1 = $attributes['overlayGradientColor1'] ?? '';
$overlay_gradient_color2 = $attributes['overlayGradientColor2'] ?? '';
$overlay_custom_gradient = $attributes['overlayCustomGradient'] ?? '';
$background_blend_mode = $attributes['backgroundBlendMode'] ?? 'normal';
$overlay_blend_mode = $attributes['overlayBlendMode'] ?? 'normal';
$background_image_fit = $attributes['backgroundImageFit'] ?? 'cover';
$background_image_position = $attributes['backgroundImagePosition'] ?? 'center';
$animated_svg_background = $attributes['animatedSvgBackground'] ?? '';
$svg_blend_mode = $attributes['svgBlendMode'] ?? 'normal';



// Generate unique ID for this block instance
$unique_id = 'simple-centered-' . uniqid();

// CSS variables are handled in the existing $style_vars array below

// Build CSS classes - using semantic approach instead of BEM
$css_classes = ['hero', 'centered-hero'];

// Add breakout class if not normal
if ($breakout_type !== 'normal') {
    $css_classes[] = 'breakout-' . $breakout_type;
}

// Add any additional classes from block supports
if (!empty($attributes['className'])) {
    $css_classes[] = $attributes['className'];
}

$css_class_string = implode(' ', array_filter($css_classes));

// Build inline styles for color and background variables
$style_vars = [];
if ($heading_color_light) {
    $style_vars[] = '--heading-color-light: ' . esc_attr($heading_color_light);
}
if ($heading_color_dark) {
    $style_vars[] = '--heading-color-dark: ' . esc_attr($heading_color_dark);
}
if ($text_color_light) {
    $style_vars[] = '--text-color-light: ' . esc_attr($text_color_light);
}
if ($text_color_dark) {
    $style_vars[] = '--text-color-dark: ' . esc_attr($text_color_dark);
}
if ($background_color_light) {
    $style_vars[] = '--background-color-light: ' . esc_attr($background_color_light);
}
if ($background_color_dark) {
    $style_vars[] = '--background-color-dark: ' . esc_attr($background_color_dark);
}
if ($background_opacity !== 1) {
    $style_vars[] = '--background-opacity: ' . floatval($background_opacity);
}
if ($section_color) {
    $style_vars[] = '--section-color: ' . esc_attr($section_color);
}
if ($background_image && $background_type === 'image') {
    $style_vars[] = '--background-image: url(' . esc_url($background_image['url']) . ')';
    $style_vars[] = '--background-image-position: ' . esc_attr($background_image_position);
    
    // Convert object-fit values to background-size values
    $background_size = 'cover'; // default
    switch ($background_image_fit) {
        case 'contain':
            $background_size = 'contain';
            break;
        case 'fill':
            $background_size = '100% 100%';
            break;
        case 'scale-down':
            $background_size = 'contain';
            break;
        case 'none':
            $background_size = 'auto';
            break;
        case 'cover':
        default:
            $background_size = 'cover';
            break;
    }
    $style_vars[] = '--background-image-size: ' . $background_size;
}
if ($background_blend_mode !== 'normal') {
    $style_vars[] = '--background-blend-mode: ' . esc_attr($background_blend_mode);
}

// Animated SVG backgrounds (now separate from background type)
if ($animated_svg_background) {
    $svg_path = get_template_directory_uri() . '/static/images/animated-svgs/' . $animated_svg_background;
    $style_vars[] = '--animated-svg-background: url(' . esc_url($svg_path) . ')';
    $style_vars[] = '--svg-blend-mode: ' . esc_attr($svg_blend_mode);
}

if ($overlay_color && $overlay_type === 'color') {
    $style_vars[] = '--overlay-color: ' . esc_attr($overlay_color);
}
if (($overlay_type === 'linear-gradient' || $overlay_type === 'radial-gradient') && ($overlay_custom_gradient || ($overlay_gradient_color1 && $overlay_gradient_color2))) {
    if ($overlay_custom_gradient) {
        // Use custom gradient if provided
        $style_vars[] = '--overlay-gradient: ' . esc_attr($overlay_custom_gradient);
    } else {
        // Generate gradient from colors
        if ($overlay_type === 'linear-gradient') {
            $gradient = 'linear-gradient(' . intval($overlay_gradient_angle) . 'deg, ' . esc_attr($overlay_gradient_color1) . ', ' . esc_attr($overlay_gradient_color2) . ')';
        } else {
            $gradient = 'radial-gradient(circle, ' . esc_attr($overlay_gradient_color1) . ', ' . esc_attr($overlay_gradient_color2) . ')';
        }
        $style_vars[] = '--overlay-gradient: ' . $gradient;
    }
}
if ($overlay_opacity !== 0.5) {
    $style_vars[] = '--overlay-opacity: ' . floatval($overlay_opacity);
}
if ($overlay_blend_mode !== 'normal') {
    $style_vars[] = '--overlay-blend-mode: ' . esc_attr($overlay_blend_mode);
}


$style_string = !empty($style_vars) ? implode('; ', $style_vars) : '';


?>

<section
    id="<?php echo esc_attr($unique_id); ?>"
    class="<?php echo esc_attr($css_class_string); ?>"
    data-block="simple-centered"
    data-breakout-type="<?php echo esc_attr($breakout_type); ?>"
    data-background-type="<?php echo esc_attr($background_type); ?>"
    data-overlay-type="<?php echo esc_attr($overlay_type); ?>"
    <?php if ($style_string): ?>style="<?php echo esc_attr($style_string); ?>"<?php endif; ?>
>
    <!-- Background Image Layer -->
    <?php if ($background_type === 'image' && $background_image): ?>
        <div class="background-image"></div>
    <?php endif; ?>
    
    <!-- Background Color Layer -->
    <?php if ($background_type === 'color' && ($background_color_light || $background_color_dark)): ?>
        <div class="background-color"></div>
    <?php endif; ?>
    
    <!-- Animated SVG Overlay Layer -->
    <?php if ($animated_svg_background): ?>
        <div class="animated-svg-overlay"></div>
    <?php endif; ?>
    
    <!-- Color/Gradient Overlay Layer -->
    <?php if ($overlay_type === 'color' && $overlay_color): ?>
        <div class="color-overlay"></div>
    <?php elseif (($overlay_type === 'linear-gradient' || $overlay_type === 'radial-gradient') && ($overlay_custom_gradient || ($overlay_gradient_color1 && $overlay_gradient_color2))): ?>
        <div class="gradient-overlay"></div>
    <?php endif; ?>
    
    <!-- Content Layer -->
    <div class="content">
        <?php if (!empty($heading)): ?>
            <h1 class="heading"><?php echo wp_kses_post($heading); ?></h1>
        <?php endif; ?>

        <?php if (!empty($subheading)): ?>
            <div class="text"><?php echo wp_kses_post($subheading); ?></div>
        <?php endif; ?>

        <?php if (!empty($button_text) && !empty($button_url)): ?>
            <div class="actions">
                <a href="<?php echo esc_url($button_url); ?>" class="btn">
                    <?php echo esc_html($button_text); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section> 