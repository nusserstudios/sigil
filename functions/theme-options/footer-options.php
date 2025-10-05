<?php
/**
 * Footer Theme Options
 * 
 * Contains footer-specific theme customizer options and functionality.
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register footer theme options
 */
function sigil_register_footer_options($wp_customize) {
    
    // ========================================
    // FOOTER SECTION
    // ========================================
    $wp_customize->add_section('sigil_footer', [
        'title' => __('Footer Options', 'sigil'),
        'priority' => 50,
        'description' => __('Customize your footer layout and styling.', 'sigil'),
    ]);
    
    // Footer Style Selection
    $wp_customize->add_setting('sigil_footer_style', [
        'default' => 'default',
        'sanitize_callback' => 'sigil_sanitize_footer_style',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_footer_style', [
        'label' => __('Footer Style', 'sigil'),
        'description' => __('Choose the footer layout style.', 'sigil'),
        'section' => 'sigil_footer',
        'type' => 'select',
        'choices' => [
            'default' => __('Default Footer', 'sigil'),
            'minimal' => __('Minimal Footer', 'sigil'),
            'extended' => __('Extended Footer', 'sigil'),
        ],
        'priority' => 1,
    ]);
    
    // Footer Logo Options
    $wp_customize->add_setting('sigil_footer_logo', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'sigil_footer_logo', [
        'label' => __('Footer Logo', 'sigil'),
        'description' => __('Upload a logo for your footer.', 'sigil'),
        'section' => 'sigil_footer',
        'priority' => 2,
    ]));
    
    // Footer Logo Dark Mode
    $wp_customize->add_setting('sigil_footer_logo_dark', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'sigil_footer_logo_dark', [
        'label' => __('Footer Logo (Dark Mode)', 'sigil'),
        'description' => __('Upload a logo for dark mode (optional).', 'sigil'),
        'section' => 'sigil_footer',
        'priority' => 3,
    ]));
    
    // Footer Description
    $wp_customize->add_setting('sigil_footer_description', [
        'default' => 'Making the world a better place through constructing elegant hierarchies.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_footer_description', [
        'label' => __('Footer Description', 'sigil'),
        'description' => __('Add a description for your footer.', 'sigil'),
        'section' => 'sigil_footer',
        'type' => 'textarea',
        'priority' => 4,
    ]);
    
    // Footer Copyright Text
    $wp_customize->add_setting('sigil_footer_copyright', [
        'default' => '© ' . date('Y') . ' ' . get_bloginfo('name') . ', Inc. All rights reserved.',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_footer_copyright', [
        'label' => __('Copyright Text', 'sigil'),
        'description' => __('Customize the copyright text.', 'sigil'),
        'section' => 'sigil_footer',
        'type' => 'text',
        'priority' => 5,
    ]);
    
    // Social Media Links
    $social_platforms = [
        'facebook' => 'Facebook',
        'instagram' => 'Instagram', 
        'twitter' => 'X (Twitter)',
        'github' => 'GitHub',
        'youtube' => 'YouTube',
        'linkedin' => 'LinkedIn',
    ];
    
    foreach ($social_platforms as $platform => $label) {
        $wp_customize->add_setting("sigil_footer_{$platform}", [
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'postMessage',
        ]);
        
        $wp_customize->add_control("sigil_footer_{$platform}", [
            'label' => sprintf(__('%s URL', 'sigil'), $label),
            'description' => sprintf(__('Enter your %s profile URL.', 'sigil'), $label),
            'section' => 'sigil_footer',
            'type' => 'url',
            'priority' => 10 + array_search($platform, array_keys($social_platforms)),
        ]);
    }
    
    // Footer Background Color Override
    $wp_customize->add_setting('sigil_footer_bg_override', [
        'default' => false,
        'sanitize_callback' => 'sigil_sanitize_checkbox',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_footer_bg_override', [
        'label' => __('Override Footer Background', 'sigil'),
        'description' => __('Use a custom background color instead of body background.', 'sigil'),
        'section' => 'sigil_footer',
        'type' => 'checkbox',
        'priority' => 20,
    ]);
    
    // Footer Custom Background Color
    $wp_customize->add_setting('sigil_footer_custom_bg_color', [
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sigil_footer_custom_bg_color', [
        'label' => __('Footer Background Color', 'sigil'),
        'description' => __('Custom background color for footer.', 'sigil'),
        'section' => 'sigil_footer',
        'priority' => 21,
    ]));
}

/**
 * Sanitize footer style selection
 */
function sigil_sanitize_footer_style($input) {
    $valid_styles = ['default', 'minimal', 'extended'];
    return in_array($input, $valid_styles) ? $input : 'default';
}
