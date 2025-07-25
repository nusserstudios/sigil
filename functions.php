<?php
/**
 * Sigil Theme Functions
 *
 * @package Sigil
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define theme constants
define('SIGIL_VERSION', '1.0.0');
define('SIGIL_THEME_DIR', get_template_directory());
define('SIGIL_THEME_URI', get_template_directory_uri());

// Load function files
$function_files = [
    'theme-setup.php',      // Theme setup and supports
    'assets.php',           // Asset loading (Vite)
    'asset-helpers.php',    // Asset URL helpers for images
    'enqueue-blocks.php',   // Block asset loading and registration
    'force-block-refresh.php', // Temporary debug functions (remove when blocks work)
    'debug-blocks.php',     // Temporary block debug info (remove when blocks work)
    'off-canvas-menu.php',  // Off-canvas menu functionality
    'walkers.php',          // Walker functionality
    'pagination.php',       // Pagination helpers
    'admin.php',            // Admin functionality
    'theme-options.php',    // Theme options and customizer
    'seo.php',              // SEO enhancements and meta tags
];

foreach ($function_files as $file) {
    $file_path = SIGIL_THEME_DIR . '/functions/' . $file;
    if (file_exists($file_path)) {
        require_once $file_path;
    }
} 