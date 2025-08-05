<?php
/**
 * Asset loading for Vite
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue theme assets
 */
function sigil_enqueue_assets() {
    $dev_server = 'http://localhost:3000';
    $is_dev = false;
    
    // Check if we're in development mode
    $vite_dev_indicator = get_template_directory() . '/.vite-dev';
    $manifest_path = get_template_directory() . '/dist/.vite/manifest.json';
    
    if (isset($_GET['force_dev'])) {
        $is_dev = true;
    } elseif (file_exists($vite_dev_indicator)) {
        $is_dev = true;
    } elseif (!file_exists($manifest_path)) {
        $is_dev = true;
    }
    
    if ($is_dev) {
        // Development mode - load from Vite dev server
        wp_enqueue_script(
            'sigil-vite-client',
            $dev_server . '/@vite/client',
            [],
            null,
            true
        );
        
        wp_enqueue_script(
            'sigil-scripts',
            $dev_server . '/resources/js/app.js',
            [],
            null,
            true
        );
        
        wp_enqueue_style(
            'sigil-app',
            $dev_server . '/resources/scss/app.scss',
            [],
            null
        );
        
        // Add type="module" to script tags
        add_filter('script_loader_tag', function($tag, $handle) {
            if (strpos($handle, 'sigil-') === 0) {
                return str_replace('<script ', '<script type="module" ', $tag);
            }
            return $tag;
        }, 10, 2);
        
    } else {
        // Production mode - load from manifest
        if (file_exists($manifest_path)) {
            $manifest = json_decode(file_get_contents($manifest_path), true);
            $theme_uri = get_template_directory_uri();
            
            // Load scripts
            if (isset($manifest['resources/js/app.js']['file'])) {
                wp_enqueue_script(
                    'sigil-scripts',
                    $theme_uri . '/dist/' . $manifest['resources/js/app.js']['file'],
                    [],
                    filemtime(get_template_directory() . '/dist/' . $manifest['resources/js/app.js']['file']),
                    true
                );
            }
            
            // Load styles
            if (isset($manifest['resources/scss/app.scss']['file'])) {
                wp_enqueue_style(
                    'sigil-app',
                    $theme_uri . '/dist/' . $manifest['resources/scss/app.scss']['file'],
                    [],
                    filemtime(get_template_directory() . '/dist/' . $manifest['resources/scss/app.scss']['file'])
                );
            }
        }
    }
}
add_action('wp_enqueue_scripts', 'sigil_enqueue_assets');

/**
 * Enqueue editor assets
 */
function sigil_enqueue_editor_assets() {
    $dev_server = 'http://localhost:3000';
    $is_dev = false;
    
    // Check if we're in development mode
    $vite_dev_indicator = get_template_directory() . '/.vite-dev';
    $manifest_path = get_template_directory() . '/dist/.vite/manifest.json';
    
    if (isset($_GET['force_dev'])) {
        $is_dev = true;
    } elseif (file_exists($vite_dev_indicator)) {
        $is_dev = true;
    } elseif (!file_exists($manifest_path)) {
        $is_dev = true;
    }
    
    if ($is_dev) {
        // Development mode
        wp_enqueue_script(
            'sigil-editor',
            $dev_server . '/resources/js/editor.js',
            ['wp-blocks', 'wp-i18n', 'wp-element', 'wp-components', 'wp-block-editor'],
            null,
            true
        );
        
        wp_enqueue_style(
            'sigil-editor-style',
            $dev_server . '/resources/scss/editor-style.scss',
            ['wp-edit-blocks'],
            null
        );
        
        // Add type="module" to script tags
        add_filter('script_loader_tag', function($tag, $handle) {
            if (strpos($handle, 'sigil-') === 0) {
                return str_replace('<script ', '<script type="module" ', $tag);
            }
            return $tag;
        }, 10, 2);
        
    } else {
        // Production mode
        if (file_exists($manifest_path)) {
            $manifest = json_decode(file_get_contents($manifest_path), true);
            $theme_uri = get_template_directory_uri();
            
            // Load editor scripts
            if (isset($manifest['resources/js/editor.js']['file'])) {
                wp_enqueue_script(
                    'sigil-editor',
                    $theme_uri . '/dist/' . $manifest['resources/js/editor.js']['file'],
                    ['wp-blocks', 'wp-i18n', 'wp-element', 'wp-components', 'wp-block-editor'],
                    filemtime(get_template_directory() . '/dist/' . $manifest['resources/js/editor.js']['file']),
                    true
                );
            }
            
            // Load editor styles
            if (isset($manifest['resources/scss/editor-style.scss']['file'])) {
                wp_enqueue_style(
                    'sigil-editor-style',
                    $theme_uri . '/dist/' . $manifest['resources/scss/editor-style.scss']['file'],
                    ['wp-edit-blocks'],
                    filemtime(get_template_directory() . '/dist/' . $manifest['resources/scss/editor-style.scss']['file'])
                );
            }
        }
    }
}
add_action('enqueue_block_editor_assets', 'sigil_enqueue_editor_assets'); 