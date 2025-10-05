<?php
/**
 * Header Theme Options
 * 
 * Contains header-specific theme customizer options and functionality.
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register header theme options
 */
function sigil_register_header_options($wp_customize) {
    
    // ========================================
    // HEADER SECTION
    // ========================================
    $wp_customize->add_section('sigil_header', [
        'title' => __('Header Options', 'sigil'),
        'priority' => 10,
        'description' => __('Customize your header layout and styling.', 'sigil'),
    ]);
    
    // Header Style Selection
    $wp_customize->add_setting('sigil_header_style', [
        'default' => 'default',
        'sanitize_callback' => 'sigil_sanitize_header_style',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_header_style', [
        'label' => __('Header Style', 'sigil'),
        'description' => __('Choose the header layout style.', 'sigil'),
        'section' => 'sigil_header',
        'type' => 'select',
        'choices' => [
            'default' => __('Default Header', 'sigil'),
            'centered' => __('Centered Header', 'sigil'),
            'minimal' => __('Minimal Header', 'sigil'),
        ],
        'priority' => 1,
    ]);
    
    // Header Logo Options
    $wp_customize->add_setting('sigil_header_logo', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'sigil_header_logo', [
        'label' => __('Header Logo', 'sigil'),
        'description' => __('Upload a logo for your header.', 'sigil'),
        'section' => 'sigil_header',
        'priority' => 2,
    ]));
    
    // Header Logo Dark Mode
    $wp_customize->add_setting('sigil_header_logo_dark', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'sigil_header_logo_dark', [
        'label' => __('Header Logo (Dark Mode)', 'sigil'),
        'description' => __('Upload a logo for dark mode (optional).', 'sigil'),
        'section' => 'sigil_header',
        'priority' => 3,
    ]));
    
    // Header Height
    $wp_customize->add_setting('sigil_header_height', [
        'default' => '4rem',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_header_height', [
        'label' => __('Header Height', 'sigil'),
        'description' => __('Set the header height (e.g., 4rem, 5rem, 6rem).', 'sigil'),
        'section' => 'sigil_header',
        'type' => 'text',
        'priority' => 4,
    ]);
    
    // Header Background Color
    $wp_customize->add_setting('sigil_header_bg_color', [
        'default' => 'transparent',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_header_bg_color', [
        'label' => __('Header Background Color', 'sigil'),
        'description' => __('Set header background color (use "transparent" for no background).', 'sigil'),
        'section' => 'sigil_header',
        'type' => 'text',
        'priority' => 5,
    ]);
    
    // Header Text Color
    $wp_customize->add_setting('sigil_header_text_color', [
        'default' => 'inherit',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_header_text_color', [
        'label' => __('Header Text Color', 'sigil'),
        'description' => __('Set header text color (use "inherit" for theme default).', 'sigil'),
        'section' => 'sigil_header',
        'type' => 'text',
        'priority' => 6,
    ]);
    
    // Sticky Header
    $wp_customize->add_setting('sigil_sticky_header', [
        'default' => false,
        'sanitize_callback' => 'sigil_sanitize_checkbox',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_sticky_header', [
        'label' => __('Sticky Header', 'sigil'),
        'description' => __('Make the header stick to the top when scrolling.', 'sigil'),
        'section' => 'sigil_header',
        'type' => 'checkbox',
        'priority' => 7,
    ]);
}

/**
 * Sanitize header style selection
 */
function sigil_sanitize_header_style($input) {
    $valid_styles = ['default', 'centered', 'minimal'];
    return in_array($input, $valid_styles) ? $input : 'default';
}

/**
 * Sanitize checkbox
 */
function sigil_sanitize_checkbox($input) {
    return (bool) $input;
}
