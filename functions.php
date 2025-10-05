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
    'template-wrappers.php', // Breakout grid template wrappers
    'breakout-enhancements.php', // Block-level breakout enhancements
    'force-block-refresh.php', // Temporary debug functions (remove when blocks work)
    'debug-blocks.php',     // Temporary block debug info (remove when blocks work)
    'off-canvas-menu.php',  // Off-canvas menu functionality
    'walkers.php',          // Walker functionality
    'theme-options-loader.php', // Modular theme options loader
    'theme-options-admin.php', // Theme options admin pages
    'pagination.php',       // Pagination helpers
    'admin.php',            // Admin functionality
    'seo.php',              // SEO enhancements and meta tags
    'footer-menus.php',     // Footer menu functionality
];

foreach ($function_files as $file) {
    $file_path = SIGIL_THEME_DIR . '/functions/' . $file;
    if (file_exists($file_path)) {
        require_once $file_path;
    }
} 