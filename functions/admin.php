<?php
/**
 * Admin Functions
 * 
 * Contains admin-specific functionality including admin menus,
 * meta boxes, custom columns, and other admin interface modifications.
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Customize admin area
 */
function sigil_admin_init() {
    // Add custom admin functionality here
    // Example: remove unnecessary menu items, add custom meta boxes, etc.
}
add_action('admin_init', 'sigil_admin_init');

/**
 * Enqueue admin scripts and styles
 */
function sigil_admin_enqueue_scripts($hook) {
    // Only load on specific admin pages if needed
    // wp_enqueue_style('sigil-admin', get_template_directory_uri() . '/assets/admin.css');
    // wp_enqueue_script('sigil-admin', get_template_directory_uri() . '/assets/admin.js');
}
add_action('admin_enqueue_scripts', 'sigil_admin_enqueue_scripts');

/**
 * Add custom meta boxes
 */
function sigil_add_meta_boxes() {
    // Example meta box
    // add_meta_box(
    //     'sigil_custom_meta',
    //     __('Custom Settings', 'sigil'),
    //     'sigil_custom_meta_callback',
    //     'post'
    // );
}
add_action('add_meta_boxes', 'sigil_add_meta_boxes');

/**
 * Custom admin footer text
 */
function sigil_admin_footer_text($text) {
    return sprintf(
        __('Thank you for using %s theme.', 'sigil'),
        '<strong>Sigil</strong>'
    );
}
// Uncomment to enable custom footer text
// add_filter('admin_footer_text', 'sigil_admin_footer_text'); 

// Show template name in footer
function show_template() {
	if ( current_user_can( 'administrator' ) ) {
		global $template;
		echo '<div class="template-name" style="position: fixed; bottom: 0; left: 0; background: rgba(0,0,0,0.5); color: #fff; padding: 5px 10px; font-size: 0.85rem; font-family: monospace; z-index: 999;">Template: ' . basename( $template ) . '</div>';
	}
}
add_action( 'wp_footer', 'show_template' );