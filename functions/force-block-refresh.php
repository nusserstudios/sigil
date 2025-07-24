<?php
/**
 * Force block refresh - temporary debug function
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Force clear block cache and re-register blocks
 */
function sigil_force_block_refresh() {
    // Clear any WordPress object cache
    if (function_exists('wp_cache_flush')) {
        wp_cache_flush();
    }
    
    // Clear opcache if available
    if (function_exists('opcache_reset')) {
        opcache_reset();
    }
    
    // Log the refresh attempt
    error_log('Sigil Debug: Forcing block refresh and cache clear');
}

// Add admin action to manually refresh blocks
function sigil_add_block_refresh_admin_bar($wp_admin_bar) {
    if (!current_user_can('manage_options')) {
        return;
    }

    $wp_admin_bar->add_node([
        'id'    => 'sigil-refresh-blocks',
        'title' => 'Refresh Blocks',
        'href'  => add_query_arg('sigil_refresh_blocks', '1'),
    ]);
}
add_action('admin_bar_menu', 'sigil_add_block_refresh_admin_bar', 100);

/**
 * Handle block refresh request
 */
function sigil_handle_block_refresh_request() {
    if (!current_user_can('manage_options') || !isset($_GET['sigil_refresh_blocks'])) {
        return;
    }
    
    sigil_force_block_refresh();
    
    // Redirect to remove the query parameter
    wp_redirect(remove_query_arg('sigil_refresh_blocks'));
    exit;
}
add_action('init', 'sigil_handle_block_refresh_request', 5);

// Auto-refresh on theme file changes in development (commented out to reduce log spam)
// if (defined('WP_DEBUG') && WP_DEBUG) {
//     add_action('init', 'sigil_force_block_refresh', 5);
// } 