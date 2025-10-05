<?php
/**
 * Colors Theme Options
 * 
 * Contains color-specific theme customizer options and functionality.
 * This file includes the existing comprehensive color system.
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
    
    // Include the existing color system
    // This will be populated with the existing color options from the main theme-options.php file
    // For now, we'll create a placeholder that can be populated with the existing color system
    
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
    
    // Note: The full color system will be moved here from the main theme-options.php file
    // This includes all background colors, text colors, foreground colors, etc.
}

/**
 * Include the existing color system functions
 * These functions are already defined in the main theme-options.php file
 * and will be available when this file is included
 */
