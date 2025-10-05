<?php
/**
 * Theme Options Loader
 * 
 * Loads all modular theme options files and registers them with WordPress Customizer.
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Load all theme options modules
 */
function sigil_load_theme_options_modules() {
    // Define the theme options directory
    $theme_options_dir = get_template_directory() . '/functions/theme-options/';
    
    // List of theme options files to load
    $theme_options_files = [
        'header-options.php',
        'colors-options.php', 
        'footer-options.php',
    ];
    
    // Load each theme options file
    foreach ($theme_options_files as $file) {
        $file_path = $theme_options_dir . $file;
        if (file_exists($file_path)) {
            require_once $file_path;
        }
    }
}

/**
 * Register all theme options with WordPress Customizer
 */
function sigil_register_all_theme_options($wp_customize) {
    // Load the modules first
    sigil_load_theme_options_modules();
    
    // Register each module's options
    if (function_exists('sigil_register_header_options')) {
        sigil_register_header_options($wp_customize);
    }
    
    if (function_exists('sigil_register_colors_options')) {
        sigil_register_colors_options($wp_customize);
    }
    
    if (function_exists('sigil_register_footer_options')) {
        sigil_register_footer_options($wp_customize);
    }
}

// Hook into WordPress Customizer
add_action('customize_register', 'sigil_register_all_theme_options');

/**
 * Add customizer scripts for tabbed interface
 */
function sigil_customizer_scripts($hook) {
    if ('customize.php' !== $hook) {
        return;
    }
    
    wp_enqueue_script(
        'sigil-customizer-tabs',
        get_template_directory_uri() . '/dist/js/customizer-tabs.js',
        ['jquery', 'customize-controls'],
        '1.0.0',
        true
    );
    
    wp_enqueue_style(
        'sigil-customizer-tabs',
        get_template_directory_uri() . '/dist/css/customizer-tabs.css',
        ['customize-controls'],
        '1.0.0'
    );
}
add_action('admin_enqueue_scripts', 'sigil_customizer_scripts');

/**
 * Add customizer preview scripts
 */
function sigil_customizer_preview_scripts() {
    wp_enqueue_script(
        'sigil-customizer-preview',
        get_template_directory_uri() . '/dist/js/customizer-preview.js',
        ['jquery', 'customize-preview'],
        '1.0.0',
        true
    );
}
add_action('customize_preview_init', 'sigil_customizer_preview_scripts');
