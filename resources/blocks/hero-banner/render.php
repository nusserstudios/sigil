<?php
/**
 * Hero Banner Block Template
 */

// Extract attributes with defaults
$heading = $attributes['heading'] ?? 'Welcome to Our Site';
$subheading = $attributes['subheading'] ?? 'Discover amazing content and features';
$button_text = $attributes['buttonText'] ?? 'Learn More';
$button_url = $attributes['buttonUrl'] ?? '#';
$overlay_opacity = $attributes['overlayOpacity'] ?? 0.5;

// Generate unique ID for this block instance
$unique_id = 'hero-banner-' . uniqid();
?>

<section
    id="<?php echo esc_attr($unique_id); ?>"
    class="wp-block-sigil-hero-banner"
    data-block="hero-banner"
    style="--hero-overlay-opacity: <?php echo floatval($overlay_opacity); ?>"
>
    <div class="hero-banner__overlay"></div>

    <div class="hero-banner__content">
        <div class="hero-banner__text">
            <?php if (!empty($heading)): ?>
                <h1 class="hero-banner__heading"><?php echo wp_kses_post($heading); ?></h1>
            <?php endif; ?>

            <?php if (!empty($subheading)): ?>
                <p class="hero-banner__subheading"><?php echo wp_kses_post($subheading); ?></p>
            <?php endif; ?>

            <?php if (!empty($button_text) && !empty($button_url)): ?>
                <div class="hero-banner__actions">
                    <a href="<?php echo esc_url($button_url); ?>" class="btn">
                        <?php echo esc_html($button_text); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section> 