<?php
/**
 * Theme Options
 * 
 * Contains theme customizer options, theme options panel,
 * and related functionality for theme customization.
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Customize register
 */
function sigil_customize_register($wp_customize) {
    
    // ========================================
    // COLORS SECTION
    // ========================================
    $wp_customize->add_section('sigil_colors', [
        'title' => __('Theme Colors', 'sigil'),
        'priority' => 30,
        'description' => __('Customize the main colors for your theme. Changes apply to both light and dark modes.', 'sigil'),
    ]);
    
    // Light Mode Background Color System
    $wp_customize->add_setting('sigil_light_bg_color_mode', [
        'default' => 'preset',
        'sanitize_callback' => 'sigil_sanitize_color_mode',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_light_bg_color_mode', [
        'label' => __('Light Mode Background Color Mode', 'sigil'),
        'description' => __('Choose between preset Pico CSS colors or custom color.', 'sigil'),
        'section' => 'sigil_colors',
        'type' => 'radio',
        'choices' => [
            'preset' => __('Use Preset Color', 'sigil'),
            'custom' => __('Use Custom Color', 'sigil'),
        ],
        'priority' => 31,
    ]);

    // Light Mode Background Color (Preset)
    $wp_customize->add_setting('sigil_light_bg_color', array(
        'default'           => 'light',
        'sanitize_callback' => 'sigil_sanitize_pico_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('sigil_light_bg_color', array(
        'label'    => __('Light Mode Background', 'sigil'),
        'section'  => 'sigil_colors',
        'type'     => 'select',
        'choices'  => sigil_get_pico_color_choices(),
        'priority' => 32,
    ));

    // Light Mode Background Custom Color
    $wp_customize->add_setting('sigil_light_bg_custom_color', [
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sigil_light_bg_custom_color', [
        'label' => __('Light Mode Background Custom Color', 'sigil'),
        'section' => 'sigil_colors',
        'priority' => 33,
    ]));

    // Dark Mode Background Color System
    $wp_customize->add_setting('sigil_dark_bg_color_mode', [
        'default' => 'preset',
        'sanitize_callback' => 'sigil_sanitize_color_mode',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_dark_bg_color_mode', [
        'label' => __('Dark Mode Background Color Mode', 'sigil'),
        'description' => __('Choose between preset Pico CSS colors or custom color.', 'sigil'),
        'section' => 'sigil_colors',
        'type' => 'radio',
        'choices' => [
            'preset' => __('Use Preset Color', 'sigil'),
            'custom' => __('Use Custom Color', 'sigil'),
        ],
        'priority' => 34,
    ]);

    // Dark Mode Background Color (Preset)
    $wp_customize->add_setting('sigil_dark_bg_color', array(
        'default'           => 'grey-900',
        'sanitize_callback' => 'sigil_sanitize_pico_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('sigil_dark_bg_color', array(
        'label'    => __('Dark Mode Background', 'sigil'),
        'section'  => 'sigil_colors',
        'type'     => 'select',
        'choices'  => sigil_get_pico_color_choices(),
        'priority' => 35,
    ));

    // Dark Mode Background Custom Color
    $wp_customize->add_setting('sigil_dark_bg_custom_color', [
        'default' => '#1b1b1b',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sigil_dark_bg_custom_color', [
        'label' => __('Dark Mode Background Custom Color', 'sigil'),
        'section' => 'sigil_colors',
        'priority' => 36,
    ]));

    // Light Mode Foreground Color System
    $wp_customize->add_setting('sigil_light_fg_color_mode', [
        'default' => 'preset',
        'sanitize_callback' => 'sigil_sanitize_color_mode',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_light_fg_color_mode', [
        'label' => __('Light Mode Foreground Color Mode', 'sigil'),
        'description' => __('Choose between preset Pico CSS colors or custom color.', 'sigil'),
        'section' => 'sigil_colors',
        'type' => 'radio',
        'choices' => [
            'preset' => __('Use Preset Color', 'sigil'),
            'custom' => __('Use Custom Color', 'sigil'),
        ],
        'priority' => 37,
    ]);

    // Light Mode Foreground Color (Preset)
    $wp_customize->add_setting('sigil_light_fg_color', array(
        'default'           => 'grey-800',
        'sanitize_callback' => 'sigil_sanitize_pico_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('sigil_light_fg_color', array(
        'label'    => __('Light Mode Foreground', 'sigil'),
        'description' => __('Text color for blockquotes, cards, and content areas.', 'sigil'),
        'section'  => 'sigil_colors',
        'type'     => 'select',
        'choices'  => sigil_get_pico_color_choices(),
        'priority' => 38,
    ));

    // Light Mode Foreground Custom Color
    $wp_customize->add_setting('sigil_light_fg_custom_color', [
        'default' => '#303030',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sigil_light_fg_custom_color', [
        'label' => __('Light Mode Foreground Custom Color', 'sigil'),
        'section' => 'sigil_colors',
        'priority' => 39,
    ]));

    // Dark Mode Foreground Color System
    $wp_customize->add_setting('sigil_dark_fg_color_mode', [
        'default' => 'preset',
        'sanitize_callback' => 'sigil_sanitize_color_mode',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_dark_fg_color_mode', [
        'label' => __('Dark Mode Foreground Color Mode', 'sigil'),
        'description' => __('Choose between preset Pico CSS colors or custom color.', 'sigil'),
        'section' => 'sigil_colors',
        'type' => 'radio',
        'choices' => [
            'preset' => __('Use Preset Color', 'sigil'),
            'custom' => __('Use Custom Color', 'sigil'),
        ],
        'priority' => 40,
    ]);

    // Dark Mode Foreground Color (Preset)
    $wp_customize->add_setting('sigil_dark_fg_color', array(
        'default'           => 'grey-200',
        'sanitize_callback' => 'sigil_sanitize_pico_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('sigil_dark_fg_color', array(
        'label'    => __('Dark Mode Foreground', 'sigil'),
        'description' => __('Text color for blockquotes, cards, and content areas in dark mode.', 'sigil'),
        'section'  => 'sigil_colors',
        'type'     => 'select',
        'choices'  => sigil_get_pico_color_choices(),
        'priority' => 41,
    ));

    // Dark Mode Foreground Custom Color
    $wp_customize->add_setting('sigil_dark_fg_custom_color', [
        'default' => '#c6c6c6',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sigil_dark_fg_custom_color', [
        'label' => __('Dark Mode Foreground Custom Color', 'sigil'),
        'section' => 'sigil_colors',
        'priority' => 42,
    ]));

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
        'label' => __('Primary Shade', 'sigil'),
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
    
    // Secondary Color System
    $wp_customize->add_setting('sigil_secondary_color_mode', [
        'default' => 'preset',
        'sanitize_callback' => 'sigil_sanitize_color_mode',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_secondary_color_mode', [
        'label' => __('Secondary Color Mode', 'sigil'),
        'description' => __('Choose between preset Pico CSS colors or custom color.', 'sigil'),
        'section' => 'sigil_colors',
        'type' => 'radio',
        'choices' => [
            'preset' => __('Use Preset Color', 'sigil'),
            'custom' => __('Use Custom Color', 'sigil'),
        ],
        'priority' => 20,
    ]);

    // Secondary Color (Preset)
    $wp_customize->add_setting('sigil_secondary_color_name', [
        'default' => 'green',
        'sanitize_callback' => 'sigil_sanitize_color_name',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_secondary_color_name', [
        'label' => __('Secondary Color', 'sigil'),
        'section' => 'sigil_colors',
        'type' => 'select',
        'choices' => sigil_get_color_name_choices(),
        'priority' => 21,
    ]);

    // Secondary Shade (Preset)
    $wp_customize->add_setting('sigil_secondary_color_shade', [
        'default' => '450',
        'sanitize_callback' => 'sigil_sanitize_color_shade',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_secondary_color_shade', [
        'label' => __('Secondary Shade', 'sigil'),
        'section' => 'sigil_colors',
        'type' => 'select',
        'choices' => sigil_get_color_shade_choices(),
        'priority' => 22,
    ]);

    // Secondary Custom Color
    $wp_customize->add_setting('sigil_secondary_custom_color', [
        'default' => '#47a417',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sigil_secondary_custom_color', [
        'label' => __('Secondary Custom Color', 'sigil'),
        'section' => 'sigil_colors',
        'priority' => 23,
    ]));
    
    // Accent Color System
    $wp_customize->add_setting('sigil_accent_color_mode', [
        'default' => 'preset',
        'sanitize_callback' => 'sigil_sanitize_color_mode',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_accent_color_mode', [
        'label' => __('Accent Color Mode', 'sigil'),
        'description' => __('Choose between preset Pico CSS colors or custom color.', 'sigil'),
        'section' => 'sigil_colors',
        'type' => 'radio',
        'choices' => [
            'preset' => __('Use Preset Color', 'sigil'),
            'custom' => __('Use Custom Color', 'sigil'),
        ],
        'priority' => 30,
    ]);

    // Accent Color (Preset)
    $wp_customize->add_setting('sigil_accent_color_name', [
        'default' => 'purple',
        'sanitize_callback' => 'sigil_sanitize_color_name',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_accent_color_name', [
        'label' => __('Accent Color', 'sigil'),
        'section' => 'sigil_colors',
        'type' => 'select',
        'choices' => sigil_get_color_name_choices(),
        'priority' => 31,
    ]);

    // Accent Shade (Preset)
    $wp_customize->add_setting('sigil_accent_color_shade', [
        'default' => '450',
        'sanitize_callback' => 'sigil_sanitize_color_shade',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_accent_color_shade', [
        'label' => __('Accent Shade', 'sigil'),
        'section' => 'sigil_colors',
        'type' => 'select',
        'choices' => sigil_get_color_shade_choices(),
        'priority' => 32,
    ]);

    // Accent Custom Color
    $wp_customize->add_setting('sigil_accent_custom_color', [
        'default' => '#c652dc',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sigil_accent_custom_color', [
        'label' => __('Accent Custom Color', 'sigil'),
        'section' => 'sigil_colors',
        'priority' => 33,
    ]));

    // Light Mode Background Color Mode
    $wp_customize->add_setting('sigil_light_bg_color_mode', [
        'default' => 'preset',
        'sanitize_callback' => 'sigil_sanitize_color_mode',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_light_bg_color_mode', [
        'label' => __('Light Mode Background Color Mode', 'sigil'),
        'description' => __('Choose between preset Pico CSS colors or custom color.', 'sigil'),
        'section' => 'sigil_colors',
        'type' => 'radio',
        'choices' => [
            'preset' => __('Use Preset Color', 'sigil'),
            'custom' => __('Use Custom Color', 'sigil'),
        ],
        'priority' => 40,
    ]);

    // Light Mode Background Color (Preset)
    $wp_customize->add_setting('sigil_light_bg_color_name', [
        'default' => 'grey',
        'sanitize_callback' => 'sigil_sanitize_color_name',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_light_bg_color_name', [
        'label' => __('Light Mode Background Color', 'sigil'),
        'section' => 'sigil_colors',
        'type' => 'select',
        'choices' => sigil_get_color_name_choices(),
        'priority' => 41,
    ]);

    // Light Mode Background Shade (Preset)
    $wp_customize->add_setting('sigil_light_bg_color_shade', [
        'default' => '50',
        'sanitize_callback' => 'sigil_sanitize_color_shade',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_light_bg_color_shade', [
        'label' => __('Light Mode Background Shade', 'sigil'),
        'section' => 'sigil_colors',
        'type' => 'select',
        'choices' => sigil_get_color_shade_choices(),
        'priority' => 42,
    ]);

    // Light Mode Background Custom Color
    $wp_customize->add_setting('sigil_light_bg_custom_color', [
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sigil_light_bg_custom_color', [
        'label' => __('Light Mode Background Custom Color', 'sigil'),
        'section' => 'sigil_colors',
        'priority' => 43,
    ]));

    // Dark Mode Background Color Mode
    $wp_customize->add_setting('sigil_dark_bg_color_mode', [
        'default' => 'preset',
        'sanitize_callback' => 'sigil_sanitize_color_mode',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_dark_bg_color_mode', [
        'label' => __('Dark Mode Background Color Mode', 'sigil'),
        'description' => __('Choose between preset Pico CSS colors or custom color.', 'sigil'),
        'section' => 'sigil_colors',
        'type' => 'radio',
        'choices' => [
            'preset' => __('Use Preset Color', 'sigil'),
            'custom' => __('Use Custom Color', 'sigil'),
        ],
        'priority' => 50,
    ]);

    // Dark Mode Background Color (Preset)
    $wp_customize->add_setting('sigil_dark_bg_color_name', [
        'default' => 'grey',
        'sanitize_callback' => 'sigil_sanitize_color_name',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_dark_bg_color_name', [
        'label' => __('Dark Mode Background Color', 'sigil'),
        'section' => 'sigil_colors',
        'type' => 'select',
        'choices' => sigil_get_color_name_choices(),
        'priority' => 51,
    ]);

    // Dark Mode Background Shade (Preset)
    $wp_customize->add_setting('sigil_dark_bg_color_shade', [
        'default' => '950',
        'sanitize_callback' => 'sigil_sanitize_color_shade',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_dark_bg_color_shade', [
        'label' => __('Dark Mode Background Shade', 'sigil'),
        'section' => 'sigil_colors',
        'type' => 'select',
        'choices' => sigil_get_color_shade_choices(),
        'priority' => 52,
    ]);

    // Dark Mode Background Custom Color
    $wp_customize->add_setting('sigil_dark_bg_custom_color', [
        'default' => '#111111',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sigil_dark_bg_custom_color', [
        'label' => __('Dark Mode Background Custom Color', 'sigil'),
        'section' => 'sigil_colors',
        'priority' => 53,
    ]));

    // Light Mode Foreground Color Mode
    $wp_customize->add_setting('sigil_light_fg_color_mode', [
        'default' => 'preset',
        'sanitize_callback' => 'sigil_sanitize_color_mode',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_light_fg_color_mode', [
        'label' => __('Light Mode Foreground Color Mode', 'sigil'),
        'description' => __('Choose between preset Pico CSS colors or custom color.', 'sigil'),
        'section' => 'sigil_colors',
        'type' => 'radio',
        'choices' => [
            'preset' => __('Use Preset Color', 'sigil'),
            'custom' => __('Use Custom Color', 'sigil'),
        ],
        'priority' => 60,
    ]);

    // Light Mode Foreground Color (Preset)
    $wp_customize->add_setting('sigil_light_fg_color_name', [
        'default' => 'grey',
        'sanitize_callback' => 'sigil_sanitize_color_name',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_light_fg_color_name', [
        'label' => __('Light Mode Foreground Color', 'sigil'),
        'section' => 'sigil_colors',
        'type' => 'select',
        'choices' => sigil_get_color_name_choices(),
        'priority' => 61,
    ]);

    // Light Mode Foreground Shade (Preset)
    $wp_customize->add_setting('sigil_light_fg_color_shade', [
        'default' => '950',
        'sanitize_callback' => 'sigil_sanitize_color_shade',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_light_fg_color_shade', [
        'label' => __('Light Mode Foreground Shade', 'sigil'),
        'section' => 'sigil_colors',
        'type' => 'select',
        'choices' => sigil_get_color_shade_choices(),
        'priority' => 62,
    ]);

    // Light Mode Foreground Custom Color
    $wp_customize->add_setting('sigil_light_fg_custom_color', [
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sigil_light_fg_custom_color', [
        'label' => __('Light Mode Foreground Custom Color', 'sigil'),
        'section' => 'sigil_colors',
        'priority' => 63,
    ]));

    // Dark Mode Foreground Color Mode
    $wp_customize->add_setting('sigil_dark_fg_color_mode', [
        'default' => 'preset',
        'sanitize_callback' => 'sigil_sanitize_color_mode',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_dark_fg_color_mode', [
        'label' => __('Dark Mode Foreground Color Mode', 'sigil'),
        'description' => __('Choose between preset Pico CSS colors or custom color.', 'sigil'),
        'section' => 'sigil_colors',
        'type' => 'radio',
        'choices' => [
            'preset' => __('Use Preset Color', 'sigil'),
            'custom' => __('Use Custom Color', 'sigil'),
        ],
        'priority' => 70,
    ]);

    // Dark Mode Foreground Color (Preset)
    $wp_customize->add_setting('sigil_dark_fg_color_name', [
        'default' => 'grey',
        'sanitize_callback' => 'sigil_sanitize_color_name',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_dark_fg_color_name', [
        'label' => __('Dark Mode Foreground Color', 'sigil'),
        'section' => 'sigil_colors',
        'type' => 'select',
        'choices' => sigil_get_color_name_choices(),
        'priority' => 71,
    ]);

    // Dark Mode Foreground Shade (Preset)
    $wp_customize->add_setting('sigil_dark_fg_color_shade', [
        'default' => '50',
        'sanitize_callback' => 'sigil_sanitize_color_shade',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control('sigil_dark_fg_color_shade', [
        'label' => __('Dark Mode Foreground Shade', 'sigil'),
        'section' => 'sigil_colors',
        'type' => 'select',
        'choices' => sigil_get_color_shade_choices(),
        'priority' => 72,
    ]);

    // Dark Mode Foreground Custom Color
    $wp_customize->add_setting('sigil_dark_fg_custom_color', [
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ]);
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sigil_dark_fg_custom_color', [
        'label' => __('Dark Mode Foreground Custom Color', 'sigil'),
        'section' => 'sigil_colors',
        'priority' => 73,
    ]));

}
// Customizer disabled in favor of dedicated theme options page
// add_action('customize_register', 'sigil_customize_register');

/**
 * Sanitize color mode choice
 */
function sigil_sanitize_color_mode($input) {
    $valid_modes = ['preset', 'custom'];
    return in_array($input, $valid_modes) ? $input : 'preset';
}

/**
 * Sanitize color name choice
 */
function sigil_sanitize_color_name($input) {
    $valid_names = ['white', 'black', 'red', 'pink', 'fuchsia', 'purple', 'violet', 'indigo', 'blue', 'azure', 'cyan', 'jade', 'green', 'lime', 'yellow', 'amber', 'pumpkin', 'orange', 'sand', 'grey', 'zinc', 'slate'];
    return in_array($input, $valid_names) ? $input : 'blue';
}

/**
 * Sanitize color shade choice
 */
function sigil_sanitize_color_shade($input) {
    $valid_shades = ['950', '900', '850', '800', '750', '700', '650', '600', '550', '500', '450', '400', '350', '300', '250', '200', '150', '100', '50'];
    return in_array($input, $valid_shades) ? $input : '450';
}

/**
 * Get color name choices for dropdowns
 */
function sigil_get_color_name_choices() {
    return [
        'white' => __('White', 'sigil'),
        'black' => __('Black', 'sigil'),
        'red' => __('Red', 'sigil'),
        'pink' => __('Pink', 'sigil'),
        'fuchsia' => __('Fuchsia', 'sigil'),
        'purple' => __('Purple', 'sigil'),
        'violet' => __('Violet', 'sigil'),
        'indigo' => __('Indigo', 'sigil'),
        'blue' => __('Blue', 'sigil'),
        'azure' => __('Azure', 'sigil'),
        'cyan' => __('Cyan', 'sigil'),
        'jade' => __('Jade', 'sigil'),
        'green' => __('Green', 'sigil'),
        'lime' => __('Lime', 'sigil'),
        'yellow' => __('Yellow', 'sigil'),
        'amber' => __('Amber', 'sigil'),
        'pumpkin' => __('Pumpkin', 'sigil'),
        'orange' => __('Orange', 'sigil'),
        'sand' => __('Sand', 'sigil'),
        'grey' => __('Grey', 'sigil'),
        'zinc' => __('Zinc', 'sigil'),
        'slate' => __('Slate', 'sigil'),
    ];
}

/**
 * Get color shade choices for dropdowns
 */
function sigil_get_color_shade_choices() {
    return [
        '50' => __('50 (Lightest)', 'sigil'),
        '100' => __('100', 'sigil'),
        '150' => __('150', 'sigil'),
        '200' => __('200', 'sigil'),
        '250' => __('250', 'sigil'),
        '300' => __('300', 'sigil'),
        '350' => __('350', 'sigil'),
        '400' => __('400', 'sigil'),
        '450' => __('450 (Default)', 'sigil'),
        '500' => __('500', 'sigil'),
        '550' => __('550', 'sigil'),
        '600' => __('600', 'sigil'),
        '650' => __('650', 'sigil'),
        '700' => __('700', 'sigil'),
        '750' => __('750', 'sigil'),
        '800' => __('800', 'sigil'),
        '850' => __('850', 'sigil'),
        '900' => __('900', 'sigil'),
        '950' => __('950 (Darkest)', 'sigil'),
    ];
}

/**
 * Get resolved color value based on mode (preset or custom)
 */
function sigil_get_resolved_color($color_type) {
    $mode = get_theme_mod("sigil_{$color_type}_color_mode", 'preset');
    
    if ($mode === 'custom') {
        // Set appropriate defaults based on color type
        $default_color = '#5c7ef8'; // Default primary color
        if ($color_type === 'secondary') $default_color = '#47a417';
        if ($color_type === 'accent') $default_color = '#c652dc';
        if ($color_type === 'light_bg') $default_color = '#ffffff';
        if ($color_type === 'dark_bg') $default_color = '#111111';
        
        return get_theme_mod("sigil_{$color_type}_custom_color", $default_color);
    } else {
        // Set appropriate defaults based on color type
        $default_name = 'blue';
        $default_shade = '450';
        
        if ($color_type === 'secondary') { $default_name = 'green'; $default_shade = '450'; }
        if ($color_type === 'accent') { $default_name = 'purple'; $default_shade = '450'; }
        if ($color_type === 'light_bg') { $default_name = 'grey'; $default_shade = '50'; }
        if ($color_type === 'dark_bg') { $default_name = 'grey'; $default_shade = '950'; }
        
        $color_name = get_theme_mod("sigil_{$color_type}_color_name", $default_name);
        $color_shade = get_theme_mod("sigil_{$color_type}_color_shade", $default_shade);
        
        // Handle white and black specially (no shade variations)
        if ($color_name === 'white' || $color_name === 'black') {
            $pico_color_name = $color_name;
        } else {
            $pico_color_name = $color_name . '-' . $color_shade;
        }
        
        return sigil_get_pico_color_hex($pico_color_name);
    }
}

/**
 * Get resolved foreground color value based on mode (preset or custom)
 */
function sigil_get_resolved_foreground_color($color_type) {
    $mode = get_theme_mod("sigil_{$color_type}_color_mode", 'preset');
    
    if ($mode === 'custom') {
        return get_theme_mod("sigil_{$color_type}_custom_color", '#1a1a1a');
    } else {
        $color_name = get_theme_mod("sigil_{$color_type}_color", 'grey-800');
        return sigil_get_pico_color_hex($color_name);
    }
}

/**
 * Get resolved body color value based on mode (preset or custom)
 */
function sigil_get_resolved_body_color($color_type) {
    $mode = get_theme_mod("sigil_{$color_type}_color_mode", 'preset');
    
    // Debug logging
    if (defined('WP_DEBUG') && WP_DEBUG) {
        error_log("Body Color Debug - Type: {$color_type}, Mode: {$mode}");
    }
    
    if ($mode === 'custom') {
        $custom_color = get_theme_mod("sigil_{$color_type}_custom_color", $color_type === 'light_body' ? '#fefefe' : '#11191f');
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log("Body Color Debug - Custom: {$custom_color}");
        }
        return $custom_color;
    } else {
        $color_name = get_theme_mod("sigil_{$color_type}_color_name", 'grey');
        $color_shade = get_theme_mod("sigil_{$color_type}_color_shade", $color_type === 'light_body' ? '50' : '900');
        
        // Handle white and black specially (no shade variations)
        if ($color_name === 'white' || $color_name === 'black') {
            $pico_color_name = $color_name;
        } else {
            $pico_color_name = $color_name . '-' . $color_shade;
        }
        
        $hex_color = sigil_get_pico_color_hex($pico_color_name);
        
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log("Body Color Debug - Preset: {$pico_color_name} = {$hex_color}");
        }
        
        return $hex_color;
    }
}





/**
 * Generate color variations (hover, light, dark, etc.)
 */
function sigil_generate_color_variations($hex_color) {
    // Remove # if present
    $hex = ltrim($hex_color, '#');
    
    // Ensure we have a valid 6-character hex string
    if (strlen($hex) !== 6 || !ctype_xdigit($hex)) {
        $hex = '5c7ef8'; // Use default blue if invalid
        $hex_color = '#5c7ef8';
    }
    
    // Convert to RGB
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    
    return [
        'base' => $hex_color,
        'hover' => sigil_darken_color($hex_color, 15),
        'light' => sigil_lighten_color($hex_color, 15),
        'dark' => sigil_darken_color($hex_color, 20),
        'focus' => $hex_color . '80', // Add 50% opacity
    ];
}

/**
 * Lighten a hex color
 */
function sigil_lighten_color($hex, $percent) {
    $hex = ltrim($hex, '#');
    
    // Ensure we have a valid 6-character hex string
    if (strlen($hex) !== 6 || !ctype_xdigit($hex)) {
        return '#5c7ef8'; // Return default if invalid
    }
    
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    
    $r = min(255, $r + ($percent / 100) * (255 - $r));
    $g = min(255, $g + ($percent / 100) * (255 - $g));
    $b = min(255, $b + ($percent / 100) * (255 - $b));
    
    // Convert to integers and ensure valid range
    $r = max(0, min(255, intval(round($r))));
    $g = max(0, min(255, intval(round($g))));
    $b = max(0, min(255, intval(round($b))));
    
    // Final validation - ensure they're proper integers
    if (!is_int($r) || !is_int($g) || !is_int($b)) {
        return '#5c7ef8';
    }
    
    return sprintf('#%02x%02x%02x', $r, $g, $b);
}

/**
 * Darken a hex color
 */
function sigil_darken_color($hex, $percent) {
    $hex = ltrim($hex, '#');
    
    // Ensure we have a valid 6-character hex string
    if (strlen($hex) !== 6 || !ctype_xdigit($hex)) {
        return '#5c7ef8'; // Return default if invalid
    }
    
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    
    $r = max(0, $r - ($percent / 100) * $r);
    $g = max(0, $g - ($percent / 100) * $g);
    $b = max(0, $b - ($percent / 100) * $b);
    
    // Convert to integers and ensure valid range
    $r = max(0, min(255, intval(round($r))));
    $g = max(0, min(255, intval(round($g))));
    $b = max(0, min(255, intval(round($b))));
    
    // Final validation - ensure they're proper integers
    if (!is_int($r) || !is_int($g) || !is_int($b)) {
        return '#5c7ef8';
    }
    
    return sprintf('#%02x%02x%02x', $r, $g, $b);
}

/**
 * Get hex value for Pico CSS color name
 */
function sigil_get_pico_color_hex($color_name) {
    $pico_colors = array(
        // Basic colors
        'light' => '#ffffff',
        'dark' => '#000000',
        'white' => '#ffffff',
        'black' => '#000000',
        
        // Red colors
        'red-950' => '#1c0d06',
        'red-900' => '#30130a',
        'red-850' => '#45150c',
        'red-800' => '#5c160d',
        'red-750' => '#72170f',
        'red-700' => '#861d13',
        'red-650' => '#9b2318',
        'red-600' => '#af291d',
        'red-550' => '#c52f21',
        'red-500' => '#d93526',
        'red-450' => '#ee402e',
        'red-400' => '#f06048',
        'red-350' => '#f17961',
        'red-300' => '#f38f79',
        'red-250' => '#f5a390',
        'red-200' => '#f5b7a8',
        'red-150' => '#f6cabf',
        'red-100' => '#f8dcd6',
        'red-50' => '#faeeeb',
        'red' => '#c52f21',
        
        // Pink colors
        'pink-950' => '#25060c',
        'pink-900' => '#380916',
        'pink-850' => '#4b0c1f',
        'pink-800' => '#5f0e28',
        'pink-750' => '#740f31',
        'pink-700' => '#88143b',
        'pink-650' => '#9d1945',
        'pink-600' => '#b21e4f',
        'pink-550' => '#c72259',
        'pink-500' => '#d92662',
        'pink-450' => '#f42c6f',
        'pink-400' => '#f6547e',
        'pink-350' => '#f7708e',
        'pink-300' => '#f8889e',
        'pink-250' => '#f99eae',
        'pink-200' => '#f9b4be',
        'pink-150' => '#f9c8ce',
        'pink-100' => '#f9dbdf',
        'pink-50' => '#fbedef',
        'pink' => '#d92662',
        
        // Fuchsia colors
        'fuchsia-950' => '#230518',
        'fuchsia-900' => '#360925',
        'fuchsia-850' => '#480b33',
        'fuchsia-800' => '#5c0d41',
        'fuchsia-750' => '#700e4f',
        'fuchsia-700' => '#84135e',
        'fuchsia-650' => '#98176d',
        'fuchsia-600' => '#ac1c7c',
        'fuchsia-550' => '#c1208b',
        'fuchsia-500' => '#d9269d',
        'fuchsia-450' => '#ed2aac',
        'fuchsia-400' => '#f748b7',
        'fuchsia-350' => '#f869bf',
        'fuchsia-300' => '#f983c7',
        'fuchsia-250' => '#fa9acf',
        'fuchsia-200' => '#f9b1d8',
        'fuchsia-150' => '#f9c6e1',
        'fuchsia-100' => '#f9daea',
        'fuchsia-50' => '#fbedf4',
        'fuchsia' => '#c1208b',
        
        // Purple colors
        'purple-950' => '#1e0820',
        'purple-900' => '#2d0f33',
        'purple-850' => '#3d1545',
        'purple-800' => '#4d1a57',
        'purple-750' => '#5e206b',
        'purple-700' => '#6f277d',
        'purple-650' => '#802e90',
        'purple-600' => '#9236a4',
        'purple-550' => '#aa40bf',
        'purple-500' => '#b645cd',
        'purple-450' => '#c652dc',
        'purple-400' => '#cd68e0',
        'purple-350' => '#d47de4',
        'purple-300' => '#db90e8',
        'purple-250' => '#e2a3eb',
        'purple-200' => '#e7b6ee',
        'purple-150' => '#edc9f1',
        'purple-100' => '#f2dcf4',
        'purple-50' => '#f8eef9',
        'purple' => '#9236a4',
        
        // Violet colors
        'violet-950' => '#190928',
        'violet-900' => '#251140',
        'violet-850' => '#321856',
        'violet-800' => '#3f1e6d',
        'violet-750' => '#4d2585',
        'violet-700' => '#5b2d9c',
        'violet-650' => '#6935b3',
        'violet-600' => '#7540bf',
        'violet-550' => '#8352c5',
        'violet-500' => '#9062ca',
        'violet-450' => '#9b71cf',
        'violet-400' => '#a780d4',
        'violet-350' => '#b290d9',
        'violet-300' => '#bd9fdf',
        'violet-250' => '#c9afe4',
        'violet-200' => '#d3bfe8',
        'violet-150' => '#decfed',
        'violet-100' => '#e8dff2',
        'violet-50' => '#f3eff7',
        'violet' => '#7540bf',
        
        // Indigo colors
        'indigo-950' => '#110b31',
        'indigo-900' => '#181546',
        'indigo-850' => '#1f1e5e',
        'indigo-800' => '#272678',
        'indigo-750' => '#2f2f92',
        'indigo-700' => '#3838ab',
        'indigo-650' => '#4040bf',
        'indigo-600' => '#524ed2',
        'indigo-550' => '#655cd6',
        'indigo-500' => '#7569da',
        'indigo-450' => '#8577dd',
        'indigo-400' => '#9486e1',
        'indigo-350' => '#a294e5',
        'indigo-300' => '#b0a3e8',
        'indigo-250' => '#bdb2ec',
        'indigo-200' => '#cac1ee',
        'indigo-150' => '#d8d0f1',
        'indigo-100' => '#e5e0f4',
        'indigo-50' => '#f2f0f9',
        'indigo' => '#524ed2',
        
        // Blue colors
        'blue-950' => '#080f2d',
        'blue-900' => '#0c1a41',
        'blue-850' => '#0e2358',
        'blue-800' => '#0f2d70',
        'blue-750' => '#0f3888',
        'blue-700' => '#1343a0',
        'blue-650' => '#184eb8',
        'blue-600' => '#1d59d0',
        'blue-550' => '#2060df',
        'blue-500' => '#3c71f7',
        'blue-450' => '#5c7ef8',
        'blue-400' => '#748bf8',
        'blue-350' => '#8999f9',
        'blue-300' => '#9ca7fa',
        'blue-250' => '#aeb5fb',
        'blue-200' => '#bfc3fa',
        'blue-150' => '#d0d2fa',
        'blue-100' => '#e0e1fa',
        'blue-50' => '#f0f0fb',
        'blue' => '#2060df',
        
        // Azure colors
        'azure-950' => '#04121d',
        'azure-900' => '#061e2f',
        'azure-850' => '#052940',
        'azure-800' => '#033452',
        'azure-750' => '#014063',
        'azure-700' => '#014c75',
        'azure-650' => '#015887',
        'azure-600' => '#02659a',
        'azure-550' => '#0172ad',
        'azure-500' => '#017fc0',
        'azure-450' => '#018cd4',
        'azure-400' => '#029ae8',
        'azure-350' => '#01aaff',
        'azure-300' => '#51b4ff',
        'azure-250' => '#79c0ff',
        'azure-200' => '#9bccfd',
        'azure-150' => '#b7d9fc',
        'azure-100' => '#d1e5fb',
        'azure-50' => '#e9f2fc',
        'azure' => '#0172ad',
        
        // Cyan colors
        'cyan-950' => '#041413',
        'cyan-900' => '#051f1f',
        'cyan-850' => '#052b2b',
        'cyan-800' => '#043737',
        'cyan-750' => '#014343',
        'cyan-700' => '#015050',
        'cyan-650' => '#025d5d',
        'cyan-600' => '#046a6a',
        'cyan-550' => '#047878',
        'cyan-500' => '#058686',
        'cyan-450' => '#059494',
        'cyan-400' => '#05a2a2',
        'cyan-350' => '#0ab1b1',
        'cyan-300' => '#0ac2c2',
        'cyan-250' => '#0ccece',
        'cyan-200' => '#25dddd',
        'cyan-150' => '#3deceb',
        'cyan-100' => '#58faf9',
        'cyan-50' => '#c3fcfa',
        'cyan' => '#047878',
        
        // Jade colors
        'jade-950' => '#04140c',
        'jade-900' => '#052014',
        'jade-850' => '#042c1b',
        'jade-800' => '#033823',
        'jade-750' => '#00452b',
        'jade-700' => '#015234',
        'jade-650' => '#005f3d',
        'jade-600' => '#006d46',
        'jade-550' => '#007a50',
        'jade-500' => '#00895a',
        'jade-450' => '#029764',
        'jade-400' => '#00a66e',
        'jade-350' => '#00b478',
        'jade-300' => '#00c482',
        'jade-250' => '#00cc88',
        'jade-200' => '#21e299',
        'jade-150' => '#39f1a6',
        'jade-100' => '#70fcba',
        'jade-50' => '#cbfce1',
        'jade' => '#007a50',
        
        // Green colors
        'green-950' => '#0b1305',
        'green-900' => '#131f07',
        'green-850' => '#152b07',
        'green-800' => '#173806',
        'green-750' => '#1a4405',
        'green-700' => '#205107',
        'green-650' => '#265e09',
        'green-600' => '#2c6c0c',
        'green-550' => '#33790f',
        'green-500' => '#398712',
        'green-450' => '#409614',
        'green-400' => '#47a417',
        'green-350' => '#4eb31b',
        'green-300' => '#55c21e',
        'green-250' => '#5dd121',
        'green-200' => '#62d926',
        'green-150' => '#77ef3d',
        'green-100' => '#95fb62',
        'green-50' => '#d7fbc1',
        'green' => '#398712',
        
        // Lime colors
        'lime-950' => '#101203',
        'lime-900' => '#191d03',
        'lime-850' => '#202902',
        'lime-800' => '#273500',
        'lime-750' => '#304100',
        'lime-700' => '#394d00',
        'lime-650' => '#435a00',
        'lime-600' => '#4d6600',
        'lime-550' => '#577400',
        'lime-500' => '#628100',
        'lime-450' => '#6c8f00',
        'lime-400' => '#779c00',
        'lime-350' => '#82ab00',
        'lime-300' => '#8eb901',
        'lime-250' => '#99c801',
        'lime-200' => '#a5d601',
        'lime-150' => '#b2e51a',
        'lime-100' => '#c1f335',
        'lime-50' => '#defc85',
        'lime' => '#a5d601',
        
        // Yellow colors
        'yellow-950' => '#141103',
        'yellow-900' => '#1f1c02',
        'yellow-850' => '#2b2600',
        'yellow-800' => '#363100',
        'yellow-750' => '#423c00',
        'yellow-700' => '#4e4700',
        'yellow-650' => '#5b5300',
        'yellow-600' => '#685f00',
        'yellow-550' => '#756b00',
        'yellow-500' => '#827800',
        'yellow-450' => '#908501',
        'yellow-400' => '#9e9200',
        'yellow-350' => '#ad9f00',
        'yellow-300' => '#bbac00',
        'yellow-250' => '#caba01',
        'yellow-200' => '#d9c800',
        'yellow-150' => '#e8d600',
        'yellow-100' => '#f2df0d',
        'yellow-50' => '#fdf1b4',
        'yellow' => '#f2df0d',
        
        // Amber colors
        'amber-950' => '#161003',
        'amber-900' => '#231a03',
        'amber-850' => '#312302',
        'amber-800' => '#3f2d00',
        'amber-750' => '#4d3700',
        'amber-700' => '#5b4200',
        'amber-650' => '#694d00',
        'amber-600' => '#785800',
        'amber-550' => '#876400',
        'amber-500' => '#977000',
        'amber-450' => '#a77c00',
        'amber-400' => '#b78800',
        'amber-350' => '#c79400',
        'amber-300' => '#d8a100',
        'amber-250' => '#e8ae01',
        'amber-200' => '#ffbf00',
        'amber-150' => '#fecc63',
        'amber-100' => '#fddea6',
        'amber-50' => '#fcefd9',
        'amber' => '#ffbf00',
        
        // Pumpkin colors
        'pumpkin-950' => '#180f04',
        'pumpkin-900' => '#271805',
        'pumpkin-850' => '#372004',
        'pumpkin-800' => '#482802',
        'pumpkin-750' => '#593100',
        'pumpkin-700' => '#693a00',
        'pumpkin-650' => '#7a4400',
        'pumpkin-600' => '#8b4f00',
        'pumpkin-550' => '#9c5900',
        'pumpkin-500' => '#ad6400',
        'pumpkin-450' => '#bf6e00',
        'pumpkin-400' => '#d27a01',
        'pumpkin-350' => '#e48500',
        'pumpkin-300' => '#ff9500',
        'pumpkin-250' => '#ffa23a',
        'pumpkin-200' => '#feb670',
        'pumpkin-150' => '#fcca9b',
        'pumpkin-100' => '#fcdcc1',
        'pumpkin-50' => '#fceee3',
        'pumpkin' => '#ff9500',
        
        // Orange colors
        'orange-950' => '#1b0d06',
        'orange-900' => '#2d1509',
        'orange-850' => '#411a0a',
        'orange-800' => '#561e0a',
        'orange-750' => '#6b220a',
        'orange-700' => '#7f270b',
        'orange-650' => '#942d0d',
        'orange-600' => '#a83410',
        'orange-550' => '#bd3c13',
        'orange-500' => '#d24317',
        'orange-450' => '#e74b1a',
        'orange-400' => '#f45d2c',
        'orange-350' => '#f56b3d',
        'orange-300' => '#f68e68',
        'orange-250' => '#f8a283',
        'orange-200' => '#f8b79f',
        'orange-150' => '#f8cab9',
        'orange-100' => '#f9dcd2',
        'orange-50' => '#faeeea',
        'orange' => '#d24317',
        
        // Sand colors
        'sand-950' => '#111110',
        'sand-900' => '#1c1b19',
        'sand-850' => '#272622',
        'sand-800' => '#32302b',
        'sand-750' => '#3d3b35',
        'sand-700' => '#49463f',
        'sand-650' => '#55524a',
        'sand-600' => '#615e55',
        'sand-550' => '#6e6a60',
        'sand-500' => '#7b776b',
        'sand-450' => '#888377',
        'sand-400' => '#959082',
        'sand-350' => '#a39e8f',
        'sand-300' => '#b0ab9b',
        'sand-250' => '#beb8a7',
        'sand-200' => '#ccc6b4',
        'sand-150' => '#dad4c2',
        'sand-100' => '#e8e2d2',
        'sand-50' => '#f2f0ec',
        'sand' => '#ccc6b4',
        
        // Grey colors
        'grey-950' => '#111111',
        'grey-900' => '#1b1b1b',
        'grey-850' => '#262626',
        'grey-800' => '#303030',
        'grey-750' => '#3b3b3b',
        'grey-700' => '#474747',
        'grey-650' => '#525252',
        'grey-600' => '#5e5e5e',
        'grey-550' => '#6a6a6a',
        'grey-500' => '#777777',
        'grey-450' => '#808080',
        'grey-400' => '#919191',
        'grey-350' => '#9e9e9e',
        'grey-300' => '#ababab',
        'grey-250' => '#b9b9b9',
        'grey-200' => '#c6c6c6',
        'grey-150' => '#d4d4d4',
        'grey-100' => '#e2e2e2',
        'grey-50' => '#f1f1f1',
        'grey' => '#ababab',
        
        // Zinc colors
        'zinc-950' => '#0f1114',
        'zinc-900' => '#191c20',
        'zinc-850' => '#23262c',
        'zinc-800' => '#2d3138',
        'zinc-750' => '#373c44',
        'zinc-700' => '#424751',
        'zinc-650' => '#4d535e',
        'zinc-600' => '#5c6370',
        'zinc-550' => '#646b79',
        'zinc-500' => '#6f7887',
        'zinc-450' => '#7b8495',
        'zinc-400' => '#8891a4',
        'zinc-350' => '#969eaf',
        'zinc-300' => '#a4acba',
        'zinc-250' => '#b3b9c5',
        'zinc-200' => '#c2c7d0',
        'zinc-150' => '#d1d5db',
        'zinc-100' => '#e0e3e7',
        'zinc-50' => '#f0f1f3',
        'zinc' => '#646b79',
        
        // Grey colors
        'grey-950' => '#111111',
        'grey-900' => '#1b1b1b',
        'grey-850' => '#262626',
        'grey-800' => '#303030',
        'grey-750' => '#3b3b3b',
        'grey-700' => '#474747',
        'grey-650' => '#525252',
        'grey-600' => '#5e5e5e',
        'grey-550' => '#6a6a6a',
        'grey-500' => '#777777',
        'grey-450' => '#808080',
        'grey-400' => '#919191',
        'grey-350' => '#9e9e9e',
        'grey-300' => '#ababab',
        'grey-250' => '#b9b9b9',
        'grey-200' => '#c6c6c6',
        'grey-150' => '#d4d4d4',
        'grey-100' => '#e2e2e2',
        'grey-50' => '#f1f1f1',
        'grey' => '#ababab',
        
        // Slate colors
        'slate-950' => '#0e1118',
        'slate-900' => '#181c25',
        'slate-850' => '#202632',
        'slate-800' => '#2a3140',
        'slate-750' => '#333c4e',
        'slate-700' => '#3d475c',
        'slate-650' => '#48536b',
        'slate-600' => '#525f7a',
        'slate-550' => '#5d6b89',
        'slate-500' => '#687899',
        'slate-450' => '#7385a9',
        'slate-400' => '#8191b5',
        'slate-350' => '#909ebe',
        'slate-300' => '#a0acc7',
        'slate-250' => '#b0b9d0',
        'slate-200' => '#bfc7d9',
        'slate-150' => '#cfd5e2',
        'slate-100' => '#dfe3eb',
        'slate-50' => '#eff1f4',
        'slate' => '#525f7a',
    );
    
    return isset($pico_colors[$color_name]) ? $pico_colors[$color_name] : '#5c7ef8'; // Default to blue-450
}

/**
 * Get available Pico CSS color choices for select controls
 */
function sigil_get_pico_color_choices() {
    return array(
        // Basic colors
        'light' => __('Light (White)', 'sigil'),
        'dark' => __('Dark (Black)', 'sigil'),
        
        // Red variants
        'red-950' => __('Red 950', 'sigil'),
        'red-900' => __('Red 900', 'sigil'),
        'red-800' => __('Red 800', 'sigil'),
        'red-700' => __('Red 700', 'sigil'),
        'red-600' => __('Red 600', 'sigil'),
        'red-500' => __('Red 500', 'sigil'),
        'red-450' => __('Red 450', 'sigil'),
        'red-400' => __('Red 400', 'sigil'),
        'red-300' => __('Red 300', 'sigil'),
        'red-200' => __('Red 200', 'sigil'),
        'red-100' => __('Red 100', 'sigil'),
        'red-50' => __('Red 50', 'sigil'),
        
        // Pink variants
        'pink-950' => __('Pink 950', 'sigil'),
        'pink-900' => __('Pink 900', 'sigil'),
        'pink-800' => __('Pink 800', 'sigil'),
        'pink-700' => __('Pink 700', 'sigil'),
        'pink-600' => __('Pink 600', 'sigil'),
        'pink-500' => __('Pink 500', 'sigil'),
        'pink-450' => __('Pink 450', 'sigil'),
        'pink-400' => __('Pink 400', 'sigil'),
        'pink-300' => __('Pink 300', 'sigil'),
        'pink-200' => __('Pink 200', 'sigil'),
        'pink-100' => __('Pink 100', 'sigil'),
        'pink-50' => __('Pink 50', 'sigil'),
        
        // Purple variants
        'purple-950' => __('Purple 950', 'sigil'),
        'purple-900' => __('Purple 900', 'sigil'),
        'purple-800' => __('Purple 800', 'sigil'),
        'purple-700' => __('Purple 700', 'sigil'),
        'purple-600' => __('Purple 600', 'sigil'),
        'purple-500' => __('Purple 500', 'sigil'),
        'purple-450' => __('Purple 450', 'sigil'),
        'purple-400' => __('Purple 400', 'sigil'),
        'purple-300' => __('Purple 300', 'sigil'),
        'purple-200' => __('Purple 200', 'sigil'),
        'purple-100' => __('Purple 100', 'sigil'),
        'purple-50' => __('Purple 50', 'sigil'),
        
        // Violet variants
        'violet-950' => __('Violet 950', 'sigil'),
        'violet-900' => __('Violet 900', 'sigil'),
        'violet-800' => __('Violet 800', 'sigil'),
        'violet-700' => __('Violet 700', 'sigil'),
        'violet-600' => __('Violet 600', 'sigil'),
        'violet-500' => __('Violet 500', 'sigil'),
        'violet-450' => __('Violet 450', 'sigil'),
        'violet-400' => __('Violet 400', 'sigil'),
        'violet-300' => __('Violet 300', 'sigil'),
        'violet-200' => __('Violet 200', 'sigil'),
        'violet-100' => __('Violet 100', 'sigil'),
        'violet-50' => __('Violet 50', 'sigil'),
        
        // Blue variants
        'blue-950' => __('Blue 950', 'sigil'),
        'blue-900' => __('Blue 900', 'sigil'),
        'blue-800' => __('Blue 800', 'sigil'),
        'blue-700' => __('Blue 700', 'sigil'),
        'blue-600' => __('Blue 600', 'sigil'),
        'blue-500' => __('Blue 500', 'sigil'),
        'blue-450' => __('Blue 450', 'sigil'),
        'blue-400' => __('Blue 400', 'sigil'),
        'blue-300' => __('Blue 300', 'sigil'),
        'blue-200' => __('Blue 200', 'sigil'),
        'blue-100' => __('Blue 100', 'sigil'),
        'blue-50' => __('Blue 50', 'sigil'),
        
        // Azure variants
        'azure-950' => __('Azure 950', 'sigil'),
        'azure-900' => __('Azure 900', 'sigil'),
        'azure-800' => __('Azure 800', 'sigil'),
        'azure-700' => __('Azure 700', 'sigil'),
        'azure-600' => __('Azure 600', 'sigil'),
        'azure-500' => __('Azure 500', 'sigil'),
        'azure-450' => __('Azure 450', 'sigil'),
        'azure-400' => __('Azure 400', 'sigil'),
        'azure-300' => __('Azure 300', 'sigil'),
        'azure-200' => __('Azure 200', 'sigil'),
        'azure-100' => __('Azure 100', 'sigil'),
        'azure-50' => __('Azure 50', 'sigil'),
        
        // Jade variants
        'jade-950' => __('Jade 950', 'sigil'),
        'jade-900' => __('Jade 900', 'sigil'),
        'jade-800' => __('Jade 800', 'sigil'),
        'jade-700' => __('Jade 700', 'sigil'),
        'jade-600' => __('Jade 600', 'sigil'),
        'jade-500' => __('Jade 500', 'sigil'),
        'jade-450' => __('Jade 450', 'sigil'),
        'jade-400' => __('Jade 400', 'sigil'),
        'jade-300' => __('Jade 300', 'sigil'),
        'jade-200' => __('Jade 200', 'sigil'),
        'jade-100' => __('Jade 100', 'sigil'),
        'jade-50' => __('Jade 50', 'sigil'),
        
        // Green variants
        'green-950' => __('Green 950', 'sigil'),
        'green-900' => __('Green 900', 'sigil'),
        'green-800' => __('Green 800', 'sigil'),
        'green-700' => __('Green 700', 'sigil'),
        'green-600' => __('Green 600', 'sigil'),
        'green-500' => __('Green 500', 'sigil'),
        'green-450' => __('Green 450', 'sigil'),
        'green-400' => __('Green 400', 'sigil'),
        'green-300' => __('Green 300', 'sigil'),
        'green-200' => __('Green 200', 'sigil'),
        'green-100' => __('Green 100', 'sigil'),
        'green-50' => __('Green 50', 'sigil'),
        
        // Orange variants
        'orange-950' => __('Orange 950', 'sigil'),
        'orange-900' => __('Orange 900', 'sigil'),
        'orange-800' => __('Orange 800', 'sigil'),
        'orange-700' => __('Orange 700', 'sigil'),
        'orange-600' => __('Orange 600', 'sigil'),
        'orange-500' => __('Orange 500', 'sigil'),
        'orange-450' => __('Orange 450', 'sigil'),
        'orange-400' => __('Orange 400', 'sigil'),
        'orange-300' => __('Orange 300', 'sigil'),
        'orange-200' => __('Orange 200', 'sigil'),
        'orange-100' => __('Orange 100', 'sigil'),
        'orange-50' => __('Orange 50', 'sigil'),
        
        // Zinc variants
        'zinc-950' => __('Zinc 950', 'sigil'),
        'zinc-900' => __('Zinc 900', 'sigil'),
        'zinc-800' => __('Zinc 800', 'sigil'),
        'zinc-700' => __('Zinc 700', 'sigil'),
        'zinc-600' => __('Zinc 600', 'sigil'),
        'zinc-500' => __('Zinc 500', 'sigil'),
        'zinc-450' => __('Zinc 450', 'sigil'),
        'zinc-400' => __('Zinc 400', 'sigil'),
        'zinc-300' => __('Zinc 300', 'sigil'),
        'zinc-200' => __('Zinc 200', 'sigil'),
        'zinc-100' => __('Zinc 100', 'sigil'),
        'zinc-50' => __('Zinc 50', 'sigil'),
        
        // Grey variants
        'grey-950' => __('Grey 950', 'sigil'),
        'grey-900' => __('Grey 900', 'sigil'),
        'grey-800' => __('Grey 800', 'sigil'),
        'grey-700' => __('Grey 700', 'sigil'),
        'grey-600' => __('Grey 600', 'sigil'),
        'grey-500' => __('Grey 500', 'sigil'),
        'grey-450' => __('Grey 450', 'sigil'),
        'grey-400' => __('Grey 400', 'sigil'),
        'grey-300' => __('Grey 300', 'sigil'),
        'grey-200' => __('Grey 200', 'sigil'),
        'grey-100' => __('Grey 100', 'sigil'),
        'grey-50' => __('Grey 50', 'sigil'),
        
        // Fuchsia variants
        'fuchsia-950' => __('Fuchsia 950', 'sigil'),
        'fuchsia-900' => __('Fuchsia 900', 'sigil'),
        'fuchsia-800' => __('Fuchsia 800', 'sigil'),
        'fuchsia-700' => __('Fuchsia 700', 'sigil'),
        'fuchsia-600' => __('Fuchsia 600', 'sigil'),
        'fuchsia-500' => __('Fuchsia 500', 'sigil'),
        'fuchsia-450' => __('Fuchsia 450', 'sigil'),
        'fuchsia-400' => __('Fuchsia 400', 'sigil'),
        'fuchsia-300' => __('Fuchsia 300', 'sigil'),
        'fuchsia-200' => __('Fuchsia 200', 'sigil'),
        'fuchsia-100' => __('Fuchsia 100', 'sigil'),
        'fuchsia-50' => __('Fuchsia 50', 'sigil'),
        
        // Indigo variants
        'indigo-950' => __('Indigo 950', 'sigil'),
        'indigo-900' => __('Indigo 900', 'sigil'),
        'indigo-800' => __('Indigo 800', 'sigil'),
        'indigo-700' => __('Indigo 700', 'sigil'),
        'indigo-600' => __('Indigo 600', 'sigil'),
        'indigo-500' => __('Indigo 500', 'sigil'),
        'indigo-450' => __('Indigo 450', 'sigil'),
        'indigo-400' => __('Indigo 400', 'sigil'),
        'indigo-300' => __('Indigo 300', 'sigil'),
        'indigo-200' => __('Indigo 200', 'sigil'),
        'indigo-100' => __('Indigo 100', 'sigil'),
        'indigo-50' => __('Indigo 50', 'sigil'),
        
        // Cyan variants
        'cyan-950' => __('Cyan 950', 'sigil'),
        'cyan-900' => __('Cyan 900', 'sigil'),
        'cyan-800' => __('Cyan 800', 'sigil'),
        'cyan-700' => __('Cyan 700', 'sigil'),
        'cyan-600' => __('Cyan 600', 'sigil'),
        'cyan-500' => __('Cyan 500', 'sigil'),
        'cyan-450' => __('Cyan 450', 'sigil'),
        'cyan-400' => __('Cyan 400', 'sigil'),
        'cyan-300' => __('Cyan 300', 'sigil'),
        'cyan-200' => __('Cyan 200', 'sigil'),
        'cyan-100' => __('Cyan 100', 'sigil'),
        'cyan-50' => __('Cyan 50', 'sigil'),
        
        // Lime variants
        'lime-950' => __('Lime 950', 'sigil'),
        'lime-900' => __('Lime 900', 'sigil'),
        'lime-800' => __('Lime 800', 'sigil'),
        'lime-700' => __('Lime 700', 'sigil'),
        'lime-600' => __('Lime 600', 'sigil'),
        'lime-500' => __('Lime 500', 'sigil'),
        'lime-450' => __('Lime 450', 'sigil'),
        'lime-400' => __('Lime 400', 'sigil'),
        'lime-300' => __('Lime 300', 'sigil'),
        'lime-200' => __('Lime 200', 'sigil'),
        'lime-100' => __('Lime 100', 'sigil'),
        'lime-50' => __('Lime 50', 'sigil'),
        
        // Yellow variants
        'yellow-950' => __('Yellow 950', 'sigil'),
        'yellow-900' => __('Yellow 900', 'sigil'),
        'yellow-800' => __('Yellow 800', 'sigil'),
        'yellow-700' => __('Yellow 700', 'sigil'),
        'yellow-600' => __('Yellow 600', 'sigil'),
        'yellow-500' => __('Yellow 500', 'sigil'),
        'yellow-450' => __('Yellow 450', 'sigil'),
        'yellow-400' => __('Yellow 400', 'sigil'),
        'yellow-300' => __('Yellow 300', 'sigil'),
        'yellow-200' => __('Yellow 200', 'sigil'),
        'yellow-100' => __('Yellow 100', 'sigil'),
        'yellow-50' => __('Yellow 50', 'sigil'),
        
        // Amber variants
        'amber-950' => __('Amber 950', 'sigil'),
        'amber-900' => __('Amber 900', 'sigil'),
        'amber-800' => __('Amber 800', 'sigil'),
        'amber-700' => __('Amber 700', 'sigil'),
        'amber-600' => __('Amber 600', 'sigil'),
        'amber-500' => __('Amber 500', 'sigil'),
        'amber-450' => __('Amber 450', 'sigil'),
        'amber-400' => __('Amber 400', 'sigil'),
        'amber-300' => __('Amber 300', 'sigil'),
        'amber-200' => __('Amber 200', 'sigil'),
        'amber-100' => __('Amber 100', 'sigil'),
        'amber-50' => __('Amber 50', 'sigil'),
        
        // Pumpkin variants
        'pumpkin-950' => __('Pumpkin 950', 'sigil'),
        'pumpkin-900' => __('Pumpkin 900', 'sigil'),
        'pumpkin-800' => __('Pumpkin 800', 'sigil'),
        'pumpkin-700' => __('Pumpkin 700', 'sigil'),
        'pumpkin-600' => __('Pumpkin 600', 'sigil'),
        'pumpkin-500' => __('Pumpkin 500', 'sigil'),
        'pumpkin-450' => __('Pumpkin 450', 'sigil'),
        'pumpkin-400' => __('Pumpkin 400', 'sigil'),
        'pumpkin-300' => __('Pumpkin 300', 'sigil'),
        'pumpkin-200' => __('Pumpkin 200', 'sigil'),
        'pumpkin-100' => __('Pumpkin 100', 'sigil'),
        'pumpkin-50' => __('Pumpkin 50', 'sigil'),
        
        // Sand variants
        'sand-950' => __('Sand 950', 'sigil'),
        'sand-900' => __('Sand 900', 'sigil'),
        'sand-800' => __('Sand 800', 'sigil'),
        'sand-700' => __('Sand 700', 'sigil'),
        'sand-600' => __('Sand 600', 'sigil'),
        'sand-500' => __('Sand 500', 'sigil'),
        'sand-450' => __('Sand 450', 'sigil'),
        'sand-400' => __('Sand 400', 'sigil'),
        'sand-300' => __('Sand 300', 'sigil'),
        'sand-200' => __('Sand 200', 'sigil'),
        'sand-100' => __('Sand 100', 'sigil'),
        'sand-50' => __('Sand 50', 'sigil'),
        
        // Slate variants
        'slate-950' => __('Slate 950', 'sigil'),
        'slate-900' => __('Slate 900', 'sigil'),
        'slate-800' => __('Slate 800', 'sigil'),
        'slate-700' => __('Slate 700', 'sigil'),
        'slate-600' => __('Slate 600', 'sigil'),
        'slate-500' => __('Slate 500', 'sigil'),
        'slate-450' => __('Slate 450', 'sigil'),
        'slate-400' => __('Slate 400', 'sigil'),
        'slate-300' => __('Slate 300', 'sigil'),
        'slate-200' => __('Slate 200', 'sigil'),
        'slate-100' => __('Slate 100', 'sigil'),
        'slate-50' => __('Slate 50', 'sigil'),
    );
}

/**
 * Sanitize Pico CSS color values
 */
function sigil_sanitize_pico_color($color) {
    $valid_colors = array_keys(sigil_get_pico_color_choices());
    return in_array($color, $valid_colors) ? $color : 'blue-450';
}

/**
 * Output dynamic CSS in header
 */
function sigil_output_dynamic_css() {
    // Debug: Always show this function is running
    echo '<!-- Sigil Dynamic CSS Function Running -->' . PHP_EOL;
    
    try {
        // Get resolved colors using new system (preset or custom)
        $primary_color = sigil_get_resolved_color('primary');
        $secondary_color = sigil_get_resolved_color('secondary');
        $accent_color = sigil_get_resolved_color('accent');
        
        // Get resolved foreground colors (handles both preset and custom)
        $light_fg_color = sigil_get_resolved_foreground_color('light_fg');
        $dark_fg_color = sigil_get_resolved_foreground_color('dark_fg');
        
        // Get resolved background colors (handles both preset and custom)
        $light_bg_color = sigil_get_resolved_color('light_bg');
        $dark_bg_color = sigil_get_resolved_color('dark_bg');
        
        // Use Background Colors for body/page background (REORGANIZED)
        $light_body_color = $light_bg_color;  // Background colors now control body
        $dark_body_color = $dark_bg_color;    // Background colors now control body
        
        // Get resolved text colors (converted from old body colors)
        $light_text_color = sigil_get_resolved_body_color('light_body');
        $dark_text_color = sigil_get_resolved_body_color('dark_body');
        
        // Debug: Show what we're getting
        echo '<!-- Debug Light Body (from BG): ' . esc_html($light_body_color) . ' -->' . PHP_EOL;
        echo '<!-- Debug Dark Body (from BG): ' . esc_html($dark_body_color) . ' -->' . PHP_EOL;
        echo '<!-- Debug Light Text (from old Body): ' . esc_html($light_text_color) . ' -->' . PHP_EOL;
        echo '<!-- Debug Dark Text (from old Body): ' . esc_html($dark_text_color) . ' -->' . PHP_EOL;
        
        // Generate color variations
        $primary_vars = sigil_generate_color_variations($primary_color);
        $secondary_vars = sigil_generate_color_variations($secondary_color);
        $accent_vars = sigil_generate_color_variations($accent_color);
    
    ?>
    <style id="sigil-dynamic-colors">
        /* Sigil Dynamic Colors - Generated <?php echo date('Y-m-d H:i:s'); ?> */
        :root {
            /* Primary Color System */
            --primary: <?php echo esc_attr($primary_vars['base']); ?>;
            --primary-background: <?php echo esc_attr($primary_vars['base']); ?>;
            --primary-border: <?php echo esc_attr($primary_vars['base']); ?>;
            --primary-hover: <?php echo esc_attr($primary_vars['hover']); ?>;
            --primary-hover-background: <?php echo esc_attr($primary_vars['hover']); ?>;
            --primary-hover-border: <?php echo esc_attr($primary_vars['hover']); ?>;
            --primary-focus: <?php echo esc_attr($primary_vars['focus']); ?>;
            --primary-underline: <?php echo esc_attr($primary_vars['focus']); ?>;
            --primary-hover-underline: <?php echo esc_attr($primary_vars['hover']); ?>;
            
            /* Secondary Color System */
            --secondary: <?php echo esc_attr($secondary_vars['base']); ?>;
            --secondary-background: <?php echo esc_attr($secondary_vars['base']); ?>;
            --secondary-border: <?php echo esc_attr($secondary_vars['base']); ?>;
            --secondary-hover: <?php echo esc_attr($secondary_vars['hover']); ?>;
            --secondary-hover-background: <?php echo esc_attr($secondary_vars['hover']); ?>;
            --secondary-hover-border: <?php echo esc_attr($secondary_vars['hover']); ?>;
            --secondary-focus: <?php echo esc_attr($secondary_vars['focus']); ?>;
            
            /* Accent Color System */
            --accent: <?php echo esc_attr($accent_vars['base']); ?>;
            --accent-background: <?php echo esc_attr($accent_vars['base']); ?>;
            --accent-border: <?php echo esc_attr($accent_vars['base']); ?>;
            --accent-hover: <?php echo esc_attr($accent_vars['hover']); ?>;
            --accent-hover-background: <?php echo esc_attr($accent_vars['hover']); ?>;
            --accent-hover-border: <?php echo esc_attr($accent_vars['hover']); ?>;
            --accent-focus: <?php echo esc_attr($accent_vars['focus']); ?>;
            
            /* Form Elements */
            --form-element-active-border-color: <?php echo esc_attr($primary_vars['base']); ?>;
            --form-element-focus-color: <?php echo esc_attr($primary_vars['focus']); ?>;
            
            /* Background Colors */
            --background-color: <?php echo esc_attr($light_bg_color); ?>;
            --card-background-color: <?php echo esc_attr($light_bg_color); ?>;
            
            /* Body Colors (now uses Background Colors) */
            --body-background-color: <?php echo esc_attr($light_body_color); ?>;
            /* Debug: Light body color = <?php echo esc_attr($light_body_color); ?> */
            
            /* Text Colors (converted from old Body Colors) */
            --text-color: <?php echo esc_attr($light_text_color); ?>;
            --heading-color: <?php echo esc_attr($light_text_color); ?>;
            
            /* Foreground Colors (for cards/content areas) */
            --foreground-color: <?php echo esc_attr($light_fg_color); ?>;
            --card-foreground-color: <?php echo esc_attr($light_fg_color); ?>;
            --blockquote-color: <?php echo esc_attr($light_fg_color); ?>;
        }
        
        /* Dark mode adjustments */
        .dark {
            --primary: <?php echo esc_attr($primary_vars['light']); ?>;
            --primary-background: <?php echo esc_attr($primary_vars['light']); ?>;
            --primary-border: <?php echo esc_attr($primary_vars['light']); ?>;
            --primary-hover: <?php echo esc_attr($primary_vars['base']); ?>;
            --primary-hover-background: <?php echo esc_attr($primary_vars['base']); ?>;
            --primary-hover-border: <?php echo esc_attr($primary_vars['base']); ?>;
            
            --secondary: <?php echo esc_attr($secondary_vars['light']); ?>;
            --secondary-background: <?php echo esc_attr($secondary_vars['light']); ?>;
            --secondary-border: <?php echo esc_attr($secondary_vars['light']); ?>;
            --secondary-hover: <?php echo esc_attr($secondary_vars['base']); ?>;
            --secondary-hover-background: <?php echo esc_attr($secondary_vars['base']); ?>;
            --secondary-hover-border: <?php echo esc_attr($secondary_vars['base']); ?>;
            
            --accent: <?php echo esc_attr($accent_vars['light']); ?>;
            --accent-background: <?php echo esc_attr($accent_vars['light']); ?>;
            --accent-border: <?php echo esc_attr($accent_vars['light']); ?>;
            --accent-hover: <?php echo esc_attr($accent_vars['base']); ?>;
            --accent-hover-background: <?php echo esc_attr($accent_vars['base']); ?>;
            --accent-hover-border: <?php echo esc_attr($accent_vars['base']); ?>;
            
            --form-element-active-border-color: <?php echo esc_attr($primary_vars['light']); ?>;
            --form-element-focus-color: <?php echo esc_attr($primary_vars['focus']); ?>;
            
            /* Background Colors */
            --background-color: <?php echo esc_attr($dark_bg_color); ?>;
            --card-background-color: <?php echo esc_attr($dark_bg_color); ?>;
            
            /* Body Colors (now uses Background Colors) */
            --body-background-color: <?php echo esc_attr($dark_body_color); ?>;
            /* Debug: Dark body color = <?php echo esc_attr($dark_body_color); ?> */
            
            /* Text Colors (converted from old Body Colors) */
            --text-color: <?php echo esc_attr($dark_text_color); ?>;
            --heading-color: <?php echo esc_attr($dark_text_color); ?>;
            
            /* Foreground Colors (for cards/content areas) */
            --foreground-color: <?php echo esc_attr($dark_fg_color); ?>;
            --card-foreground-color: <?php echo esc_attr($dark_fg_color); ?>;
            --blockquote-color: <?php echo esc_attr($dark_fg_color); ?>;
        }
    </style>
    <?php
    
    } catch (Exception $e) {
        echo '<!-- Sigil Dynamic CSS Error: ' . esc_html($e->getMessage()) . ' -->' . PHP_EOL;
        // Fallback CSS with sand-600
        ?>
        <style id="sigil-dynamic-colors-fallback">
        :root {
            --body-background-color: #fefefe;
        }
        .dark {
            --body-background-color: #615e55; /* Sand-600 fallback */
        }
        </style>
        <?php
    }
}
add_action('wp_head', 'sigil_output_dynamic_css', 20); // Load after other styles

// Force test removed - dynamic CSS is working correctly

/**
 * Get theme option with default fallback
 * 
 * @param string $option_name
 * @param mixed $default
 * @return mixed
 */
function sigil_get_theme_option($option_name, $default = '') {
    return get_theme_mod($option_name, $default);
}

/**
 * Add theme options page as top-level menu
 */
function sigil_add_theme_options_page() {
    add_menu_page(
        __('Sigil Theme Options', 'sigil'),           // Page title
        __('Sigil Theme', 'sigil'),                   // Menu title
        'edit_theme_options',                         // Capability
        'sigil-theme-options',                        // Menu slug
        'sigil_theme_options_page',                   // Callback function
        'dashicons-art',                              // Icon (paint brush)
        30                                            // Position (after Appearance)
    );
}
add_action('admin_menu', 'sigil_add_theme_options_page');

/**
 * Clear any conflicting customizer settings on theme activation
 */
function sigil_clear_customizer_conflicts() {
    // Remove any old customizer settings that might conflict
    $conflicting_settings = [
        'sigil_light_bg_color',
        'sigil_dark_bg_color',
        'sigil_light_fg_color',
        'sigil_dark_fg_color',
    ];
    
    foreach ($conflicting_settings as $setting) {
        remove_theme_mod($setting);
    }
}
add_action('after_switch_theme', 'sigil_clear_customizer_conflicts');

/**
 * Add admin notice about theme options location
 */
function sigil_theme_options_admin_notice() {
    $screen = get_current_screen();
    if ($screen && $screen->id === 'customize') {
        ?>
        <div class="notice notice-info is-dismissible">
            <p>
                <strong><?php _e('Sigil Theme Options have moved!', 'sigil'); ?></strong>
                <?php _e('Theme colors and options are now available in the dedicated', 'sigil'); ?>
                <a href="<?php echo admin_url('admin.php?page=sigil-theme-options'); ?>"><?php _e('Sigil Theme Options', 'sigil'); ?></a>
                <?php _e('page in the admin menu.', 'sigil'); ?>
            </p>
        </div>
        <?php
    }
}
add_action('admin_notices', 'sigil_theme_options_admin_notice');

/**
 * Debug function to show current color values (for testing)
 * Uncomment the add_action line below to enable debug output
 */
function sigil_debug_colors() {
    if (current_user_can('manage_options') && isset($_GET['debug_colors'])) {
        echo '<div style="position: fixed; top: 50px; right: 20px; background: white; border: 2px solid #ccc; padding: 15px; z-index: 9999; max-width: 300px;">';
        echo '<h4>Sigil Color Debug</h4>';
        
        // Test sand-600 specifically
        $sand_600_hex = sigil_get_pico_color_hex('sand-600');
        echo '<p><strong>Sand-600:</strong> ' . $sand_600_hex . ' <span style="display:inline-block;width:20px;height:20px;background:' . $sand_600_hex . ';border:1px solid #000;vertical-align:middle;"></span></p>';
        
        // Test current dark body color
        $dark_body_color = sigil_get_resolved_body_color('dark_body');
        echo '<p><strong>Dark Body Color:</strong> ' . $dark_body_color . ' <span style="display:inline-block;width:20px;height:20px;background:' . $dark_body_color . ';border:1px solid #000;vertical-align:middle;"></span></p>';
        
        // Show current settings
        $dark_body_mode = get_theme_mod('sigil_dark_body_color_mode', 'preset');
        $dark_body_name = get_theme_mod('sigil_dark_body_color_name', 'grey');
        $dark_body_shade = get_theme_mod('sigil_dark_body_color_shade', '900');
        
        echo '<p><strong>Settings:</strong><br>';
        echo 'Mode: ' . $dark_body_mode . '<br>';
        echo 'Name: ' . $dark_body_name . '<br>';
        echo 'Shade: ' . $dark_body_shade . '</p>';
        
        echo '<p><small>Add ?debug_colors=1 to URL to see this debug info</small></p>';
        echo '</div>';
    }
}
add_action('wp_footer', 'sigil_debug_colors');
add_action('admin_footer', 'sigil_debug_colors');

/**
 * Test function to verify color resolution is working
 */
function sigil_test_color_resolution() {
    if (current_user_can('manage_options') && isset($_GET['test_colors'])) {
        echo '<div style="position: fixed; top: 100px; right: 20px; background: white; border: 2px solid #ccc; padding: 15px; z-index: 9999; max-width: 400px; font-family: monospace; font-size: 12px;">';
        echo '<h4>Color Resolution Test</h4>';
        
        // Test all the functions
        echo '<p><strong>Primary:</strong> ' . sigil_get_resolved_color('primary') . '</p>';
        echo '<p><strong>Light BG:</strong> ' . sigil_get_resolved_color('light_bg') . '</p>';
        echo '<p><strong>Dark BG:</strong> ' . sigil_get_resolved_color('dark_bg') . '</p>';
        echo '<p><strong>Light Body:</strong> ' . sigil_get_resolved_body_color('light_body') . '</p>';
        echo '<p><strong>Dark Body:</strong> ' . sigil_get_resolved_body_color('dark_body') . '</p>';
        
        // Show raw theme_mod values
        echo '<hr><h5>Raw Theme Mod Values:</h5>';
        echo '<p>dark_body_mode: ' . get_theme_mod('sigil_dark_body_color_mode', 'NOT SET') . '</p>';
        echo '<p>dark_body_name: ' . get_theme_mod('sigil_dark_body_color_name', 'NOT SET') . '</p>';
        echo '<p>dark_body_shade: ' . get_theme_mod('sigil_dark_body_color_shade', 'NOT SET') . '</p>';
        
        // Test sand-600 directly
        echo '<hr><h5>Sand-600 Test:</h5>';
        echo '<p>Sand-600 hex: ' . sigil_get_pico_color_hex('sand-600') . '</p>';
        
        echo '<p><small>Add ?test_colors=1 to URL to see this test</small></p>';
        echo '</div>';
    }
}
add_action('wp_footer', 'sigil_test_color_resolution');
add_action('admin_footer', 'sigil_test_color_resolution');

/**
 * Theme options page content
 */
function sigil_theme_options_page() {
    // Handle form submission
    if (isset($_POST['submit']) && wp_verify_nonce($_POST['sigil_options_nonce'], 'sigil_options')) {
        // Save all the options
        $options_to_save = [
            // Primary colors
            'sigil_primary_color_mode', 'sigil_primary_color_name', 'sigil_primary_color_shade', 'sigil_primary_custom_color',
            // Secondary colors
            'sigil_secondary_color_mode', 'sigil_secondary_color_name', 'sigil_secondary_color_shade', 'sigil_secondary_custom_color',
            // Accent colors
            'sigil_accent_color_mode', 'sigil_accent_color_name', 'sigil_accent_color_shade', 'sigil_accent_custom_color',
            // Light mode background colors
            'sigil_light_bg_color_mode', 'sigil_light_bg_color_name', 'sigil_light_bg_color_shade', 'sigil_light_bg_custom_color',
            // Dark mode background colors
            'sigil_dark_bg_color_mode', 'sigil_dark_bg_color_name', 'sigil_dark_bg_color_shade', 'sigil_dark_bg_custom_color',
            // Light mode foreground colors
            'sigil_light_fg_color_mode', 'sigil_light_fg_color_name', 'sigil_light_fg_color_shade', 'sigil_light_fg_custom_color',
            // Dark mode foreground colors
            'sigil_dark_fg_color_mode', 'sigil_dark_fg_color_name', 'sigil_dark_fg_color_shade', 'sigil_dark_fg_custom_color',
            // Body colors (new)
            'sigil_light_body_color_mode', 'sigil_light_body_color_name', 'sigil_light_body_color_shade', 'sigil_light_body_custom_color',
            'sigil_dark_body_color_mode', 'sigil_dark_body_color_name', 'sigil_dark_body_color_shade', 'sigil_dark_body_custom_color',
        ];
        
        foreach ($options_to_save as $option) {
            if (isset($_POST[$option])) {
                set_theme_mod($option, sanitize_text_field($_POST[$option]));
            }
        }
        
        echo '<div class="notice notice-success is-dismissible"><p>' . __('Settings saved!', 'sigil') . '</p></div>';
    }
    
    // Include the theme options form
    sigil_render_theme_options_form();
}

/**
 * Render the theme options form
 */
function sigil_render_theme_options_form() {
    // Get current values for all options
    $primary_color_mode = get_theme_mod('sigil_primary_color_mode', 'preset');
    $primary_color_name = get_theme_mod('sigil_primary_color_name', 'blue');
    $primary_color_shade = get_theme_mod('sigil_primary_color_shade', '450');
    $primary_custom_color = get_theme_mod('sigil_primary_custom_color', '#5c7ef8');
    
    $secondary_color_mode = get_theme_mod('sigil_secondary_color_mode', 'preset');
    $secondary_color_name = get_theme_mod('sigil_secondary_color_name', 'green');
    $secondary_color_shade = get_theme_mod('sigil_secondary_color_shade', '450');
    $secondary_custom_color = get_theme_mod('sigil_secondary_custom_color', '#47a417');
    
    $accent_color_mode = get_theme_mod('sigil_accent_color_mode', 'preset');
    $accent_color_name = get_theme_mod('sigil_accent_color_name', 'purple');
    $accent_color_shade = get_theme_mod('sigil_accent_color_shade', '450');
    $accent_custom_color = get_theme_mod('sigil_accent_custom_color', '#c652dc');
    
    // New body color options
    $light_body_color_mode = get_theme_mod('sigil_light_body_color_mode', 'preset');
    $light_body_color_name = get_theme_mod('sigil_light_body_color_name', 'grey');
    $light_body_color_shade = get_theme_mod('sigil_light_body_color_shade', '50');
    $light_body_custom_color = get_theme_mod('sigil_light_body_custom_color', '#fefefe');
    
    $dark_body_color_mode = get_theme_mod('sigil_dark_body_color_mode', 'preset');
    $dark_body_color_name = get_theme_mod('sigil_dark_body_color_name', 'grey');
    $dark_body_color_shade = get_theme_mod('sigil_dark_body_color_shade', '900');
    $dark_body_custom_color = get_theme_mod('sigil_dark_body_custom_color', '#11191f');
    
    // Background and foreground colors (existing)
    $light_bg_color_mode = get_theme_mod('sigil_light_bg_color_mode', 'preset');
    $light_bg_color_name = get_theme_mod('sigil_light_bg_color_name', 'grey');
    $light_bg_color_shade = get_theme_mod('sigil_light_bg_color_shade', '50');
    $light_bg_custom_color = get_theme_mod('sigil_light_bg_custom_color', '#ffffff');
    
    $dark_bg_color_mode = get_theme_mod('sigil_dark_bg_color_mode', 'preset');
    $dark_bg_color_name = get_theme_mod('sigil_dark_bg_color_name', 'grey');
    $dark_bg_color_shade = get_theme_mod('sigil_dark_bg_color_shade', '950');
    $dark_bg_custom_color = get_theme_mod('sigil_dark_bg_custom_color', '#111111');
    
    $light_fg_color_mode = get_theme_mod('sigil_light_fg_color_mode', 'preset');
    $light_fg_color_name = get_theme_mod('sigil_light_fg_color_name', 'grey');
    $light_fg_color_shade = get_theme_mod('sigil_light_fg_color_shade', '950');
    $light_fg_custom_color = get_theme_mod('sigil_light_fg_custom_color', '#000000');
    
    $dark_fg_color_mode = get_theme_mod('sigil_dark_fg_color_mode', 'preset');
    $dark_fg_color_name = get_theme_mod('sigil_dark_fg_color_name', 'grey');
    $dark_fg_color_shade = get_theme_mod('sigil_dark_fg_color_shade', '50');
    $dark_fg_custom_color = get_theme_mod('sigil_dark_fg_custom_color', '#ffffff');
    ?>
    
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        
        <form method="post" action="">
            <?php wp_nonce_field('sigil_options', 'sigil_options_nonce'); ?>
            
            <div class="sigil-theme-options">
                <style>
                .sigil-theme-options { max-width: 1200px; }
                .sigil-color-section { background: #fff; border: 1px solid #ccd0d4; border-radius: 4px; padding: 20px; margin-bottom: 20px; }
                .sigil-color-section h2 { margin-top: 0; border-bottom: 1px solid #eee; padding-bottom: 10px; }
                .sigil-color-row { display: flex; align-items: center; margin-bottom: 15px; gap: 15px; }
                .sigil-color-label { min-width: 200px; font-weight: 600; }
                .sigil-color-mode { display: flex; gap: 10px; align-items: center; }
                .sigil-preset-controls { display: flex; gap: 10px; align-items: center; }
                .shade-selector { transition: opacity 0.2s ease; }
                .sigil-custom-controls { display: flex; align-items: center; gap: 10px; }
                .color-preview { width: 30px; height: 30px; border: 1px solid #ccc; border-radius: 3px; display: inline-block; }
                </style>
                
                <!-- Text Colors Section (converted from Body Colors) -->
                <div class="sigil-color-section">
                    <h2><?php _e('Text Colors', 'sigil'); ?></h2>
                    <p><?php _e('Set the main text colors for headings, paragraphs, and other typography elements.', 'sigil'); ?></p>
                    
                    <h3><?php _e('Light Mode Text Color', 'sigil'); ?></h3>
                    <?php sigil_render_color_controls('light_body', $light_body_color_mode, $light_body_color_name, $light_body_color_shade, $light_body_custom_color, __('Light Text Color', 'sigil')); ?>
                    
                    <h3><?php _e('Dark Mode Text Color', 'sigil'); ?></h3>
                    <?php sigil_render_color_controls('dark_body', $dark_body_color_mode, $dark_body_color_name, $dark_body_color_shade, $dark_body_custom_color, __('Dark Text Color', 'sigil')); ?>
                </div>

                <!-- Primary Colors -->
                <div class="sigil-color-section">
                    <h2><?php _e('Primary Colors', 'sigil'); ?></h2>
                    <?php sigil_render_color_controls('primary', $primary_color_mode, $primary_color_name, $primary_color_shade, $primary_custom_color, __('Primary Color', 'sigil')); ?>
                </div>

                <!-- Secondary Colors -->
                <div class="sigil-color-section">
                    <h2><?php _e('Secondary Colors', 'sigil'); ?></h2>
                    <?php sigil_render_color_controls('secondary', $secondary_color_mode, $secondary_color_name, $secondary_color_shade, $secondary_custom_color, __('Secondary Color', 'sigil')); ?>
                </div>

                <!-- Accent Colors -->
                <div class="sigil-color-section">
                    <h2><?php _e('Accent Colors', 'sigil'); ?></h2>
                    <?php sigil_render_color_controls('accent', $accent_color_mode, $accent_color_name, $accent_color_shade, $accent_custom_color, __('Accent Color', 'sigil')); ?>
                </div>

                <!-- Background Colors (now controls body/page background) -->
                <div class="sigil-color-section">
                    <h2><?php _e('Background Colors', 'sigil'); ?></h2>
                    <p><?php _e('Set the main page/body background colors. Also used for cards and content areas.', 'sigil'); ?></p>
                    
                    <h3><?php _e('Light Mode Background', 'sigil'); ?></h3>
                    <?php sigil_render_color_controls('light_bg', $light_bg_color_mode, $light_bg_color_name, $light_bg_color_shade, $light_bg_custom_color, __('Light Background Color', 'sigil')); ?>
                    
                    <h3><?php _e('Dark Mode Background', 'sigil'); ?></h3>
                    <?php sigil_render_color_controls('dark_bg', $dark_bg_color_mode, $dark_bg_color_name, $dark_bg_color_shade, $dark_bg_custom_color, __('Dark Background Color', 'sigil')); ?>
                </div>

                <!-- Foreground Colors -->
                <div class="sigil-color-section">
                    <h2><?php _e('Foreground Colors', 'sigil'); ?></h2>
                    <p><?php _e('Colors for cards, content areas, and blockquotes (separate from main text colors).', 'sigil'); ?></p>
                    
                    <h3><?php _e('Light Mode Foreground', 'sigil'); ?></h3>
                    <?php sigil_render_color_controls('light_fg', $light_fg_color_mode, $light_fg_color_name, $light_fg_color_shade, $light_fg_custom_color, __('Light Foreground Color', 'sigil')); ?>
                    
                    <h3><?php _e('Dark Mode Foreground', 'sigil'); ?></h3>
                    <?php sigil_render_color_controls('dark_fg', $dark_fg_color_mode, $dark_fg_color_name, $dark_fg_color_shade, $dark_fg_custom_color, __('Dark Foreground Color', 'sigil')); ?>
                </div>
            </div>
            
            <?php submit_button(__('Save Settings', 'sigil')); ?>
        </form>
        
        <script>
        jQuery(document).ready(function($) {
            $('.mode-toggle').on('change', function() {
                var target = $(this).data('target');
                var mode = $(this).val();
                
                if (mode === 'preset') {
                    $('.' + target + '-preset').show();
                    $('.' + target + '-custom').hide();
                } else {
                    $('.' + target + '-preset').hide();
                    $('.' + target + '-custom').show();
                }
            });
            
            // Update color previews when color inputs change
            $('input[type="color"]').on('change', function() {
                $(this).siblings('.color-preview').css('background-color', $(this).val());
            });
            
            // Hide shade selector for white and black colors
            function toggleShadeSelector(colorNameSelect) {
                var selectedColor = colorNameSelect.val();
                var type = colorNameSelect.data('type');
                var shadeSelector = $('select[name="sigil_' + type + '_color_shade"]');
                
                if (selectedColor === 'white' || selectedColor === 'black') {
                    shadeSelector.hide();
                } else {
                    shadeSelector.show();
                }
            }
            
            // Initialize shade selector visibility on page load
            $('.color-name-selector').each(function() {
                toggleShadeSelector($(this));
            });
            
            // Handle color name changes
            $('.color-name-selector').on('change', function() {
                toggleShadeSelector($(this));
            });
        });
        </script>
    </div>
    <?php
}

/**
 * Render color controls for a specific color type
 */
function sigil_render_color_controls($type, $mode, $color_name, $color_shade, $custom_color, $label) {
    ?>
    <div class="sigil-color-row">
        <div class="sigil-color-label"><?php echo esc_html($label . ' Mode'); ?></div>
        <div class="sigil-color-mode">
            <label><input type="radio" name="sigil_<?php echo esc_attr($type); ?>_color_mode" value="preset" <?php checked($mode, 'preset'); ?> class="mode-toggle" data-target="<?php echo esc_attr($type); ?>"> <?php _e('Preset Color', 'sigil'); ?></label>
            <label><input type="radio" name="sigil_<?php echo esc_attr($type); ?>_color_mode" value="custom" <?php checked($mode, 'custom'); ?> class="mode-toggle" data-target="<?php echo esc_attr($type); ?>"> <?php _e('Custom Color', 'sigil'); ?></label>
        </div>
    </div>
    
    <div class="sigil-color-row preset-controls <?php echo esc_attr($type); ?>-preset" <?php echo $mode === 'custom' ? 'style="display:none;"' : ''; ?>>
        <div class="sigil-color-label"><?php echo esc_html($label); ?></div>
        <div class="sigil-preset-controls">
            <select name="sigil_<?php echo esc_attr($type); ?>_color_name" class="color-name-selector" data-type="<?php echo esc_attr($type); ?>">
                <?php foreach (sigil_get_color_name_choices() as $value => $option_label): ?>
                    <option value="<?php echo esc_attr($value); ?>" <?php selected($color_name, $value); ?>><?php echo esc_html($option_label); ?></option>
                <?php endforeach; ?>
            </select>
            <select name="sigil_<?php echo esc_attr($type); ?>_color_shade" class="shade-selector" data-type="<?php echo esc_attr($type); ?>">
                <?php foreach (sigil_get_color_shade_choices() as $value => $option_label): ?>
                    <option value="<?php echo esc_attr($value); ?>" <?php selected($color_shade, $value); ?>><?php echo esc_html($option_label); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    
    <div class="sigil-color-row custom-controls <?php echo esc_attr($type); ?>-custom" <?php echo $mode === 'preset' ? 'style="display:none;"' : ''; ?>>
        <div class="sigil-color-label"><?php echo esc_html($label . ' Custom'); ?></div>
        <div class="sigil-custom-controls">
            <input type="color" name="sigil_<?php echo esc_attr($type); ?>_custom_color" value="<?php echo esc_attr($custom_color); ?>">
            <span class="color-preview" style="background-color: <?php echo esc_attr($custom_color); ?>"></span>
        </div>
    </div>
    <?php
}