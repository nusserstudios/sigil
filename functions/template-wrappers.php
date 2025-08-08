<?php
/**
 * Template Wrappers for Breakout Grid System
 *
 * @package Sigil
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Output opening breakout grid wrapper
 */
function sigil_breakout_grid_open() {
    $class = 'wp-block-sigil-breakout-grid content-wrapper';
    
    // Add specific class based on content type
    if (is_page()) {
        $class .= ' page-content';
    } elseif (is_single()) {
        $class .= ' single-content';
    }
    
    echo '<div class="' . esc_attr($class) . '">';
}

/**
 * Output closing breakout grid wrapper
 */
function sigil_breakout_grid_close() {
    echo '</div>';
}

/**
 * Check if current page should use breakout grid
 * 
 * @return bool
 */
function sigil_should_use_breakout_grid() {
    // Skip breakout grid for certain page types if needed
    $skip_pages = apply_filters('sigil_skip_breakout_grid', [
        // Add page templates that shouldn't use breakout grid
        // 'page-landing.php',
        // 'page-fullwidth.php'
    ]);
    
    $current_template = get_page_template_slug();
    
    // Skip if current template is in the skip list
    if (in_array($current_template, $skip_pages)) {
        return false;
    }
    
    // Skip for certain post types if needed
    $skip_post_types = apply_filters('sigil_skip_breakout_grid_post_types', [
        // 'product', // Example: skip for WooCommerce products
    ]);
    
    if (in_array(get_post_type(), $skip_post_types)) {
        return false;
    }
    
    // Allow themes/plugins to override
    return apply_filters('sigil_use_breakout_grid', true);
}

/**
 * Add breakout grid wrapper to content
 * 
 * @param string $content
 * @return string
 */
function sigil_wrap_content_in_breakout_grid($content) {
    // Only wrap if we should use breakout grid
    if (!sigil_should_use_breakout_grid()) {
        return $content;
    }
    
    // Don't double-wrap if already has breakout grid
    if (strpos($content, 'wp-block-sigil-breakout-grid') !== false) {
        return $content;
    }
    
    // Determine the appropriate class based on content type
    $class = 'wp-block-sigil-breakout-grid content-wrapper';
    
    if (is_page()) {
        $class .= ' page-content';
    } elseif (is_single()) {
        $class .= ' single-content';
    }
    
    // Wrap the content
    return '<div class="' . esc_attr($class) . '">' . $content . '</div>';
}

// Apply the wrapper to the_content
add_filter('the_content', 'sigil_wrap_content_in_breakout_grid', 10);

/**
 * Add body class when breakout grid is active
 * 
 * @param array $classes
 * @return array
 */
function sigil_add_breakout_grid_body_class($classes) {
    if (sigil_should_use_breakout_grid()) {
        $classes[] = 'has-breakout-grid';
    }
    return $classes;
}
add_filter('body_class', 'sigil_add_breakout_grid_body_class');

/**
 * Enqueue breakout grid styles when needed
 */
function sigil_enqueue_breakout_grid_styles() {
    if (sigil_should_use_breakout_grid()) {
        // The styles are already enqueued by the block system
        // This is here for any additional template-specific styles
        wp_add_inline_style('sigil-blocks', '
            .content-wrapper.wp-block-sigil-breakout-grid {
                /* Additional template-level styles if needed */
            }
        ');
    }
}
add_action('wp_enqueue_scripts', 'sigil_enqueue_breakout_grid_styles'); 