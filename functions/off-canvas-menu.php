<?php
/**
 * Off-Canvas Menu Functions
 * 
 * Functions to handle off-canvas mobile menu functionality
 */

/**
 * Render the off-canvas menu structure
 */
function sigil_render_off_canvas_menu() {
    ?>
    <div class="nav-links">
        <button type="button" class="nav-close" aria-label="Close menu">
            <svg xmlns="http://www.w3.org/2000/svg" width="31.205" height="31.205" viewBox="0 0 31.205 31.205">
                <path id="x-mark" d="M32.205,28.188,20.6,16.576,32.205,4.981,28.188,1,16.583,12.6,4.986,1,1,4.986,12.611,16.611,1,28.219l3.986,3.986,11.635-11.62,11.6,11.62Z" transform="translate(-1 -1)" fill="#726e6e"/>
            </svg>
        </button>
        <?php
        // The main navigation will be moved here via JavaScript on mobile
        ?>
    </div>
    <div class="menu-overlay"></div>
    <?php
}

/**
 * Register navigation menus for the theme
 */
function sigil_register_nav_menus() {
    register_nav_menus(array(
        'menu-1'        => __('Primary Menu', 'sigil'),        // Main nav in header
        'footer-menu'   => __('Footer Menu', 'sigil'),         // Footer navigation
        'social-menu'   => __('Social Menu', 'sigil'),         // Social links
    ));
}
add_action('after_setup_theme', 'sigil_register_nav_menus');

/**
 * Custom walker for navigation menus with submenu support
 */
class Sigil_Menu_Walker extends Walker_Nav_Menu {
    
    /**
     * Start the list before the elements are added.
     */
    function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }

    /**
     * End the list after the elements are added.
     */
    function end_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    /**
     * Start the element output.
     */
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        // Check if item has children
        $has_children = in_array('menu-item-has-children', $classes);

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

        $item_output = isset($args->before) ? $args->before : '';
        $item_output .= '<a' . $attributes . '>';
        $item_output .= (isset($args->link_before) ? $args->link_before : '') . apply_filters('the_title', $item->title, $item->ID) . (isset($args->link_after) ? $args->link_after : '');
        $item_output .= '</a>';
        
        // Add submenu toggle button for items with children
        if ($has_children) {
            $item_output .= '<button class="submenu-toggle" aria-expanded="false">';
            $item_output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">';
            $item_output .= '<polyline points="7 12.86 25 37.14 43 12.86" fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="8" />';
            $item_output .= '</svg>';
            $item_output .= '<span class="screen-reader-text">Toggle submenu</span>';
            $item_output .= '</button>';
        }
        
        $item_output .= isset($args->after) ? $args->after : '';

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    /**
     * End the element output.
     */
    function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= "</li>\n";
    }
}

/**
 * Display the main navigation menu
 */
function sigil_main_nav() {
    wp_nav_menu(array(
        'theme_location'  => 'menu-1',
        'menu_id'         => 'primary-menu',
        'menu_class'      => 'primary-menu',
        'container'       => 'nav',
        'container_class' => 'main-navigation',
        'container_id'    => 'site-navigation',
        'fallback_cb'     => false,
        'depth'           => 3,
        'walker'          => new Sigil_Menu_Walker(),
        'items_wrap'      => '<ul id="%1$s" class="%2$s" role="menubar">%3$s</ul>',
    ));
}

/**
 * Display the footer navigation menu
 */
function sigil_footer_nav() {
    wp_nav_menu(array(
        'theme_location' => 'footer-menu',
        'menu_id'        => 'footer-menu',
        'menu_class'     => 'footer-menu',
        'container'      => false,
        'fallback_cb'    => false,
        'depth'          => 1,
        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
    ));
}

/**
 * Add active class to current menu items
 */
function sigil_active_nav_class($classes, $item) {
    // Get post type
    $post_type = get_post_type();
    
    // If menu item is current page or ancestor
    if ($item->current == 1 || $item->current_item_ancestor == true) {
        $classes[] = 'active';
    }
    
    // Handle custom post types
    if (is_singular($post_type) && $item->url == get_post_type_archive_link($post_type)) {
        $classes[] = 'active';
    }
    
    // Handle taxonomy pages
    if (is_tax() && $item->url == get_post_type_archive_link($post_type)) {
        $classes[] = 'active';
    }
    
    return $classes;
}
add_filter('nav_menu_css_class', 'sigil_active_nav_class', 10, 2);

/**
 * Add menu toggle functionality to header
 */
function sigil_add_menu_toggle() {
    if (has_nav_menu('menu-1')) {
        sigil_render_off_canvas_menu();
    }
}

// Hook the off-canvas menu into the header
add_action('wp_footer', 'sigil_add_menu_toggle'); 