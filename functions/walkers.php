<?php
/**
 * Walkers
 * 
 * Contains walker classes and related functionality for custom
 * navigation, comments, and other walker implementations.
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Custom Comment Walker
 * 
 * This walker is automatically loaded via the autoloader since it's in the
 * Sigil\Walkers namespace. The walker classes remain in their original
 * location under functions/Walkers/ directory.
 * 
 * Usage: 
 * wp_list_comments([
 *     'walker' => new Sigil\Walkers\CommentWalker(),
 *     // other options...
 * ]);
 */

/**
 * Helper function to get comment walker instance
 * 
 * @return Sigil\Walkers\CommentWalker
 */
function sigil_get_comment_walker() {
    return new Sigil\Walkers\CommentWalker();
}

// Future walker functions can be added here
// For example: navigation walker, category walker, etc. 