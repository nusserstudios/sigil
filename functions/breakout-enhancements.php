<?php
/**
 * Breakout Enhancements for Core Blocks
 *
 * @package Sigil
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue block editor scripts for breakout enhancements
 */
function sigil_enqueue_breakout_enhancements() {
    // Dependencies needed for our breakout enhancements
    $dependencies = [
        'wp-blocks',
        'wp-block-editor', 
        'wp-components',
        'wp-i18n',
        'wp-hooks',
        'wp-compose',
        'wp-element'
    ];
    
    wp_enqueue_script(
        'sigil-breakout-enhancements',
        SIGIL_THEME_URI . '/dist/js/breakout-enhancements.js',
        $dependencies,
        SIGIL_VERSION,
        false
    );
    
    // Pass data to the script
    wp_localize_script('sigil-breakout-enhancements', 'sigilBreakout', [
        'enabledBlocks' => sigil_get_breakout_enabled_blocks(),
        'defaultBreakout' => 'normal',
        'breakoutOptions' => [
            'normal' => __('Normal (896px)', 'sigil'),
            'wide' => __('Wide (1280px)', 'sigil'),
            'full' => __('Full Width (100%)', 'sigil')
        ]
    ]);
}
add_action('enqueue_block_editor_assets', 'sigil_enqueue_breakout_enhancements');

/**
 * Get list of blocks that should have breakout controls
 * 
 * @return array
 */
function sigil_get_breakout_enabled_blocks() {
    $blocks = [
        'core/image',
        'core/gallery',
        'core/cover',
        'core/group',
        'core/columns',
        'core/media-text',
        'core/video',
        'core/audio',
        'core/table',
        'core/separator',
        // Add custom blocks
        'sigil/hero-banner',
    ];
    
    return apply_filters('sigil_breakout_enabled_blocks', $blocks);
}

/**
 * Add breakout classes to block wrapper
 * 
 * @param string $block_content
 * @param array $block
 * @return string
 */
function sigil_add_breakout_classes($block_content, $block) {
    // Skip blocks that handle breakout classes themselves
    $self_handling_blocks = [
        'sigil/hero-banner', // Hero banner handles its own breakout classes
    ];
    
    if (in_array($block['blockName'], $self_handling_blocks)) {
        return $block_content;
    }
    
    // Only process blocks that support breakout
    if (!in_array($block['blockName'], sigil_get_breakout_enabled_blocks())) {
        return $block_content;
    }
    
    // Get breakout setting from block attributes
    $breakout_type = $block['attrs']['breakoutType'] ?? 'normal';
    
    // Skip if normal (default grid behavior)
    if ($breakout_type === 'normal') {
        return $block_content;
    }
    
    // For core blocks, we can use a simple string replacement approach
    // since they typically have predictable class structures
    $breakout_class = 'breakout-' . $breakout_type;
    
    // Look for the wp-block-* class and add our breakout class after it
    $pattern = '/class="([^"]*wp-block-[^"]*?)"/';
    if (preg_match($pattern, $block_content)) {
        $block_content = preg_replace($pattern, 'class="$1 ' . $breakout_class . '"', $block_content, 1);
    } else {
        // Fallback: add class to the first element if no wp-block class found
        $block_content = preg_replace('/^(\s*<[^>]+?)>/', '$1 class="' . $breakout_class . '">', $block_content, 1);
    }
    
    return $block_content;
}
add_filter('render_block', 'sigil_add_breakout_classes', 10, 2);

/**
 * Register block attributes for breakout support
 */
function sigil_register_breakout_attributes() {
    $enabled_blocks = sigil_get_breakout_enabled_blocks();
    
    foreach ($enabled_blocks as $block_name) {
        register_block_type_from_metadata($block_name, [
            'attributes' => [
                'breakoutType' => [
                    'type' => 'string',
                    'default' => 'normal'
                ]
            ]
        ]);
    }
}
// Note: This needs to run after blocks are registered
add_action('init', 'sigil_register_breakout_attributes', 20); 