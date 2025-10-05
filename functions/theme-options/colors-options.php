<?php
/**
 * Colors Theme Options
 * 
 * Contains color-specific theme customizer options and functionality.
 * This includes the complete color system from the original theme-options.php
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register colors theme options
 */
function sigil_register_colors_options($wp_customize) {
    
    // ========================================
    // COLORS SECTION
    // ========================================
    $wp_customize->add_section('sigil_colors', [
        'title' => __('Theme Colors', 'sigil'),
        'priority' => 30,
        'description' => __('Customize the main colors for your theme. Changes apply to both light and dark modes.', 'sigil'),
    ]);
    
    // For now, we'll include a basic color system
    // The full system will be migrated from theme-options-old.php
    
    // Primary Color System
    $wp_customize->add_setting('sigil_primary_color_mode', [
        'default' => 'preset',
        'sanitize_callback' => 'sigil_sanitize_color_mode',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_primary_color_mode', [
        'label' => __('Primary Color Mode', 'sigil'),
        'description' => __('Choose between preset Pico CSS colors or custom color.', 'sigil'),
        'section' => 'sigil_colors',
        'type' => 'radio',
        'choices' => [
            'preset' => __('Use Preset Color', 'sigil'),
            'custom' => __('Use Custom Color', 'sigil'),
        ],
        'priority' => 10,
    ]);
    
    // Primary Color (Preset)
    $wp_customize->add_setting('sigil_primary_color_name', [
        'default' => 'blue',
        'sanitize_callback' => 'sigil_sanitize_color_name',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_primary_color_name', [
        'label' => __('Primary Color', 'sigil'),
        'description' => __('Choose the base color for your primary color.', 'sigil'),
        'section' => 'sigil_colors',
        'type' => 'select',
        'choices' => sigil_get_color_name_choices(),
        'priority' => 11,
    ]);
    
    // Primary Shade (Preset)
    $wp_customize->add_setting('sigil_primary_color_shade', [
        'default' => '450',
        'sanitize_callback' => 'sigil_sanitize_color_shade',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_primary_color_shade', [
        'label' => __('Primary Color Shade', 'sigil'),
        'description' => __('Choose the shade intensity for your primary color.', 'sigil'),
        'section' => 'sigil_colors',
        'type' => 'select',
        'choices' => sigil_get_color_shade_choices(),
        'priority' => 12,
    ]);
    
    // Primary Custom Color
    $wp_customize->add_setting('sigil_primary_custom_color', [
        'default' => '#5c7ef8',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sigil_primary_custom_color', [
        'label' => __('Primary Custom Color', 'sigil'),
        'section' => 'sigil_colors',
        'priority' => 13,
    ]));
}

/**
 * Include essential color functions from the old theme-options.php
 * These functions are needed for the color system to work
 */

// Include the old theme-options.php temporarily to get the functions
// We'll gradually move these functions to the appropriate modular files
if (file_exists(get_template_directory() . '/functions/theme-options-old.php')) {
    require_once get_template_directory() . '/functions/theme-options-old.php';
}