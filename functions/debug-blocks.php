<?php
/**
 * Debug block registration
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add debug info to admin bar
 */
function sigil_add_debug_admin_bar($wp_admin_bar) {
    if (!current_user_can('manage_options')) {
        return;
    }

    $wp_admin_bar->add_node([
        'id'    => 'sigil-debug-blocks',
        'title' => 'Debug Blocks',
        'href'  => add_query_arg('sigil_debug_blocks', '1'),
    ]);
}
add_action('admin_bar_menu', 'sigil_add_debug_admin_bar', 100);

/**
 * Show debug information
 */
function sigil_show_debug_info() {
    if (!current_user_can('manage_options') || !isset($_GET['sigil_debug_blocks'])) {
        return;
    }

    echo '<div class="notice notice-info">';
    echo '<h3>Sigil Blocks Debug Information</h3>';

    // Check build directory
    $build_dir = get_template_directory() . '/build';
    echo '<p><strong>Build Directory:</strong> ' . $build_dir . '</p>';
    echo '<p><strong>Directory Exists:</strong> ' . (is_dir($build_dir) ? 'Yes' : 'No') . '</p>';

    if (is_dir($build_dir)) {
        $block_folders = glob($build_dir . '/*/*', GLOB_ONLYDIR);
        echo '<p><strong>Block Folders Found:</strong> ' . count($block_folders) . '</p>';

        foreach ($block_folders as $folder) {
            $name = basename(dirname($folder)) . '/' . basename($folder);
            $json_file = $folder . '/block.json';
            echo '<p>- ' . $name . ' (block.json: ' . (file_exists($json_file) ? 'Found' : 'Missing') . ')</p>';
        }
    }

    // Check registered blocks
    $registered_blocks = WP_Block_Type_Registry::get_instance()->get_all_registered();
    $sigil_blocks = array_filter($registered_blocks, function($block_name) {
        return strpos($block_name, 'sigil/') === 0;
    }, ARRAY_FILTER_USE_KEY);

    echo '<p><strong>Registered Sigil Blocks:</strong> ' . count($sigil_blocks) . '</p>';
    foreach ($sigil_blocks as $name => $block) {
        echo '<p>- ' . $name . '</p>';
    }

    echo '</div>';
}
add_action('admin_notices', 'sigil_show_debug_info'); 