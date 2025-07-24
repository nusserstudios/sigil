<?php
/**
 * Block registration and asset loading
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Auto-register blocks from the build directory
 */
function sigil_register_theme_blocks() {
    $blocks_dir = get_template_directory() . '/dist/blocks';
    
    // error_log('Sigil Blocks Debug: Looking for blocks directory at: ' . $blocks_dir);
    // error_log('Sigil Blocks Debug: get_template_directory() returns: ' . get_template_directory());
    
    if (!is_dir($blocks_dir)) {
        // error_log('Sigil Blocks Debug: blocks directory not found at: ' . $blocks_dir);
        return;
    }
    
    // error_log('Sigil Blocks Debug: Found blocks directory');
    
    // Find all block directories (flat structure: block-name)
    $block_folders = glob($blocks_dir . '/*', GLOB_ONLYDIR);
    
    foreach ($block_folders as $block_path) {
        $block_json = $block_path . '/block.json';
        
        if (file_exists($block_json)) {
            register_block_type($block_path);
        }
    }
}
add_action('init', 'sigil_register_theme_blocks');

/**
 * Create block category for theme blocks
 */
function sigil_add_block_categories($categories) {
    $new_category = [
        'slug'  => 'sigil-blocks',
        'title' => __('Sigil Blocks', 'sigil'),
        'icon'  => 'layout',
    ];
    
    return array_merge([$new_category], $categories);
}
add_filter('block_categories_all', 'sigil_add_block_categories'); 