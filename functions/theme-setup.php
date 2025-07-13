<?php
/**
 * Theme Setup
 * 
 * Contains all theme setup functionality including theme supports,
 * navigation menus, and textdomain loading.
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup function
 */
function sigil_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
    add_theme_support('align-wide');
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ]);

    // Register navigation menus
    register_nav_menus([
        'primary' => __('Primary Menu', 'sigil'),
    ]);
}
add_action('after_setup_theme', 'sigil_setup');

/**
 * Load theme textdomain
 */
function sigil_load_textdomain() {
    load_theme_textdomain('sigil', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'sigil_load_textdomain'); 