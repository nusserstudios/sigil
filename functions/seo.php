<?php
/**
 * SEO Functions
 * 
 * Functions to enhance SEO capabilities of the theme
 */

/**
 * Generate contextual meta description based on current page type
 *
 * @return string The meta description for the current page
 */
function sigil_get_meta_description() {
    $meta_description = '';
    
    if (is_front_page() && is_home()) {
        // Homepage - use site description/tagline
        $meta_description = get_bloginfo('description', 'display');
        if (empty($meta_description)) {
            $meta_description = sprintf(__('Welcome to %s - your source for quality content and insights.', 'sigil'), get_bloginfo('name'));
        }
    } elseif (is_home()) {
        // Blog homepage
        $meta_description = sprintf(__('Latest posts from %s - stay updated with our newest content.', 'sigil'), get_bloginfo('name'));
    } elseif (is_singular()) {
        // Single post/page
        if (has_excerpt()) {
            $meta_description = get_the_excerpt();
        } else {
            // Generate description from content
            $content = get_the_content();
            $meta_description = wp_trim_words(strip_shortcodes(strip_tags($content)), 25, '...');
        }
        if (empty($meta_description)) {
            $meta_description = sprintf(__('Read more about %s on %s.', 'sigil'), get_the_title(), get_bloginfo('name'));
        }
    } elseif (is_category()) {
        // Category archive
        $category_description = category_description();
        if (!empty($category_description)) {
            $meta_description = strip_tags($category_description);
        } else {
            $meta_description = sprintf(__('Browse all posts in %s category on %s.', 'sigil'), single_cat_title('', false), get_bloginfo('name'));
        }
    } elseif (is_tag()) {
        // Tag archive
        $tag_description = tag_description();
        if (!empty($tag_description)) {
            $meta_description = strip_tags($tag_description);
        } else {
            $meta_description = sprintf(__('All posts tagged with %s on %s.', 'sigil'), single_tag_title('', false), get_bloginfo('name'));
        }
    } elseif (is_author()) {
        // Author archive
        $author_description = get_the_author_meta('description');
        if (!empty($author_description)) {
            $meta_description = $author_description;
        } else {
            $meta_description = sprintf(__('All posts by %s on %s.', 'sigil'), get_the_author(), get_bloginfo('name'));
        }
    } elseif (is_search()) {
        // Search results
        $meta_description = sprintf(__('Search results for "%s" on %s.', 'sigil'), get_search_query(), get_bloginfo('name'));
    } elseif (is_archive()) {
        // Other archives
        $meta_description = sprintf(__('Archive of posts on %s.', 'sigil'), get_bloginfo('name'));
    } else {
        // Fallback
        $meta_description = get_bloginfo('description', 'display');
        if (empty($meta_description)) {
            $meta_description = sprintf(__('Quality content and insights from %s.', 'sigil'), get_bloginfo('name'));
        }
    }
    
    // Clean and limit the description
    $meta_description = wp_trim_words(strip_tags($meta_description), 30, '...');
    
    return $meta_description;
}

/**
 * Output meta description tag
 */
function sigil_output_meta_description() {
    $meta_description = sigil_get_meta_description();
    
    if (!empty($meta_description)) {
        printf('<meta name="description" content="%s">' . "\n", esc_attr($meta_description));
    }
}

/**
 * Get the canonical URL for the current page
 *
 * @return string The canonical URL
 */
function sigil_get_canonical_url() {
    if (is_front_page()) {
        return home_url('/');
    } elseif (is_singular()) {
        return get_permalink();
    } elseif (is_category()) {
        return get_category_link(get_queried_object_id());
    } elseif (is_tag()) {
        return get_tag_link(get_queried_object_id());
    } elseif (is_author()) {
        return get_author_posts_url(get_queried_object_id());
    } elseif (is_search()) {
        return get_search_link();
    } else {
        global $wp;
        return home_url(add_query_arg(array(), $wp->request));
    }
}

/**
 * Output canonical URL link tag
 */
function sigil_output_canonical_url() {
    $canonical_url = sigil_get_canonical_url();
    
    if (!empty($canonical_url)) {
        printf('<link rel="canonical" href="%s">' . "\n", esc_url($canonical_url));
    }
}

/**
 * Add Open Graph meta tags for better social sharing
 */
function sigil_output_open_graph_tags() {
    // Only output if not already handled by an SEO plugin
    if (function_exists('wpseo_get_value') || class_exists('RankMath') || class_exists('AIOSEO')) {
        return;
    }
    
    $og_title = '';
    $og_description = sigil_get_meta_description();
    $og_url = sigil_get_canonical_url();
    $og_image = '';
    
    // Get title
    if (is_front_page()) {
        $og_title = get_bloginfo('name');
    } elseif (is_singular()) {
        $og_title = get_the_title();
    } else {
        $og_title = wp_get_document_title();
    }
    
    // Get image
    if (is_singular() && has_post_thumbnail()) {
        $og_image = get_the_post_thumbnail_url(null, 'large');
    } else {
        // Use site icon or default
        $site_icon = get_site_icon_url(512);
        if ($site_icon) {
            $og_image = $site_icon;
        }
    }
    
    // Output Open Graph tags
    printf('<meta property="og:title" content="%s">' . "\n", esc_attr($og_title));
    printf('<meta property="og:description" content="%s">' . "\n", esc_attr($og_description));
    printf('<meta property="og:url" content="%s">' . "\n", esc_url($og_url));
    printf('<meta property="og:type" content="%s">' . "\n", is_singular() ? 'article' : 'website');
    printf('<meta property="og:site_name" content="%s">' . "\n", esc_attr(get_bloginfo('name')));
    
    if (!empty($og_image)) {
        printf('<meta property="og:image" content="%s">' . "\n", esc_url($og_image));
    }
    
    // Twitter Card tags
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    printf('<meta name="twitter:title" content="%s">' . "\n", esc_attr($og_title));
    printf('<meta name="twitter:description" content="%s">' . "\n", esc_attr($og_description));
    
    if (!empty($og_image)) {
        printf('<meta name="twitter:image" content="%s">' . "\n", esc_url($og_image));
    }
}

/**
 * Hook into wp_head to output SEO meta tags
 */
add_action('wp_head', 'sigil_output_meta_description', 1);
add_action('wp_head', 'sigil_output_canonical_url', 2);
add_action('wp_head', 'sigil_output_open_graph_tags', 3); 