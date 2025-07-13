<?php
/**
 * Asset Helper Functions
 * 
 * Functions to handle asset paths for images in both development and production
 */

/**
 * Get the correct path for static images
 * Works in both development (Vite dev server) and production (built theme)
 * 
 * @param string $path Path relative to the images folder (e.g., 'backgrounds/ripple.svg')
 * @return string Full URL to the image
 */
function get_image_url($path) {
    $theme_uri = get_template_directory_uri();
    
    // Remove leading slash if present
    $path = ltrim($path, '/');
    
    // Check if we're in development mode (Vite dev server running)
    $is_dev = file_exists(get_template_directory() . '/.vite-dev');
    
    if ($is_dev) {
        // In development, images are served from static folder via Vite dev server
        return $theme_uri . '/static/images/' . $path;
    } else {
        // In production, Vite copies static files to dist/images/
        return $theme_uri . '/dist/images/' . $path;
    }
}

/**
 * Get CSS custom property for an image URL
 * Useful for setting CSS variables with image paths
 * 
 * @param string $property_name CSS custom property name (without --)
 * @param string $image_path Path relative to images folder
 * @return string CSS custom property declaration
 */
function get_image_css_property($property_name, $image_path) {
    $url = get_image_url($image_path);
    return '--' . $property_name . ': url("' . esc_url($url) . '");';
}

/**
 * Output inline CSS for image variables
 * This allows you to use images in CSS that work in both dev and production
 * 
 * @param array $images Array of property_name => image_path pairs
 */
function output_image_css_variables($images = []) {
    if (empty($images)) {
        return;
    }
    
    echo "<style>\n:root {\n";
    foreach ($images as $property_name => $image_path) {
        echo "    " . get_image_css_property($property_name, $image_path) . "\n";
    }
    echo "}\n</style>\n";
}

/**
 * Get background CSS for an element with an image
 * 
 * @param string $image_path Path relative to images folder
 * @param array $options Additional CSS options (size, position, repeat, etc.)
 * @return string CSS background declaration
 */
function get_background_css($image_path, $options = []) {
    $url = get_image_url($image_path);
    $css = 'background-image: url("' . esc_url($url) . '");';
    
    $defaults = [
        'size' => null,
        'position' => null,
        'repeat' => null,
        'attachment' => null
    ];
    
    $options = array_merge($defaults, $options);
    
    if ($options['size']) {
        $css .= ' background-size: ' . $options['size'] . ';';
    }
    if ($options['position']) {
        $css .= ' background-position: ' . $options['position'] . ';';
    }
    if ($options['repeat']) {
        $css .= ' background-repeat: ' . $options['repeat'] . ';';
    }
    if ($options['attachment']) {
        $css .= ' background-attachment: ' . $options['attachment'] . ';';
    }
    
    return $css;
} 