<?php
/**
 * Assets Management
 * 
 * Contains all asset loading functionality including Vite integration
 * for both development and production environments.
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Custom Vite asset loading function
 */
function pico_load_vite_assets() {
    $dev_server = 'http://localhost:3000';
    $is_dev = false;
    
    // Simple file-based detection for development mode
    $vite_dev_indicator = get_template_directory() . '/.vite-dev';
    $manifest_path = get_template_directory() . '/dist/.vite/manifest.json';
    
    // Force dev mode via URL parameter (for testing)
    if (isset($_GET['force_dev'])) {
        $is_dev = true;
    }
    // Primary detection: .vite-dev file exists (created by dev script)
    elseif (file_exists($vite_dev_indicator)) {
        $is_dev = true;
    }
    // Fallback: if no manifest file exists, assume dev mode
    elseif (!file_exists($manifest_path)) {
        $is_dev = true;
    }
    
    // Debug output - always show for now to troubleshoot
    add_action('wp_head', function() use ($dev_server, $is_dev, $vite_dev_indicator, $manifest_path) {
        echo "<!-- VITE DEBUG -->\n";
        echo "<!-- Dev server: {$dev_server} -->\n";
        echo "<!-- Is dev mode: " . ($is_dev ? 'YES' : 'NO') . " -->\n";
        echo "<!-- Dev indicator file: " . (file_exists($vite_dev_indicator) ? 'EXISTS' : 'MISSING') . " ({$vite_dev_indicator}) -->\n";
        echo "<!-- Manifest file: " . (file_exists($manifest_path) ? 'EXISTS' : 'MISSING') . " ({$manifest_path}) -->\n";
        echo "<!-- Force dev param: " . (isset($_GET['force_dev']) ? 'YES' : 'NO') . " -->\n";
        echo "<!-- Current URL: " . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . " -->\n";
        echo "<!-- Theme directory: " . get_template_directory() . " -->\n";
        echo "<!-- /VITE DEBUG -->\n";
    });
    
    if ($is_dev) {
        // Development mode - load from Vite dev server
        wp_enqueue_script('vite-client', $dev_server . '/@vite/client', [], null, false);
        wp_enqueue_script('pico-app-js', $dev_server . '/resources/js/app.js', [], null, true);
        
        // Add Vite module attributes
        add_filter('script_loader_tag', function($tag, $handle) {
            if (in_array($handle, ['vite-client', 'pico-app-js'])) {
                return str_replace('<script ', '<script type="module" ', $tag);
            }
            return $tag;
        }, 10, 2);
        
        // Dev mode setup
        add_action('wp_head', function() use ($dev_server) {
            echo "<!-- Vite dev server detected at {$dev_server} -->\n";
            echo "<!-- CSS will be loaded via JavaScript module -->\n";
            echo "<!-- Scripts loaded: vite-client, pico-app-js -->\n";
            // Allow mixed content for development by removing the CSP restriction
            echo '<meta http-equiv="Content-Security-Policy" content="default-src \'self\' \'unsafe-inline\' \'unsafe-eval\' http://localhost:3000 ws://localhost:3000 data: blob:; script-src \'self\' \'unsafe-inline\' \'unsafe-eval\' http://localhost:3000; style-src \'self\' \'unsafe-inline\' http://localhost:3000; img-src \'self\' https: http: data: blob:; connect-src \'self\' ws://localhost:3000 http://localhost:3000;">' . "\n";
        });
        
        // Add debugging to footer to show HMR status
        add_action('wp_footer', function() use ($dev_server) {
            echo '<script type="module">
            // Test dev server connection
            try {
                const response = await fetch("' . $dev_server . '/resources/js/app.js", {mode: "no-cors"});
                console.log("✅ Dev server is reachable");
                
                if (import.meta.hot) {
                    console.log("✅ Vite HMR is connected!");
                    import.meta.hot.on("vite:beforeUpdate", () => {
                        console.log("🔄 HMR update incoming...");
                    });
                } else {
                    console.log("⚠️ Vite HMR not detected - but scripts are loading");
                }
            } catch (error) {
                console.log("❌ Dev server not reachable:", error);
            }
            
            // Additional debugging
            console.log("🔍 Dev server check:");
            console.log("- Window location:", window.location.href);
            console.log("- Import meta:", typeof import.meta);
            console.log("- Import meta hot:", typeof import.meta.hot);
            </script>';
        });
        
    } else {
        // Production mode - load built assets
        $manifest_path = get_template_directory() . '/dist/.vite/manifest.json';
        $theme_uri = get_template_directory_uri();
        
        if (file_exists($manifest_path)) {
            $manifest = json_decode(file_get_contents($manifest_path), true);
            
            // Load CSS
            if (isset($manifest['resources/scss/app.scss']['file'])) {
                wp_enqueue_style(
                    'pico-app-css',
                    $theme_uri . '/dist/' . $manifest['resources/scss/app.scss']['file'],
                    [],
                    filemtime(get_template_directory() . '/dist/' . $manifest['resources/scss/app.scss']['file'])
                );
            }
            
            // Load JS
            if (isset($manifest['resources/js/app.js']['file'])) {
                wp_enqueue_script(
                    'pico-app-js',
                    $theme_uri . '/dist/' . $manifest['resources/js/app.js']['file'],
                    [],
                    filemtime(get_template_directory() . '/dist/' . $manifest['resources/js/app.js']['file']),
                    true
                );
            }
            
            // Load editor styles
            if (isset($manifest['resources/scss/editor-style.scss']['file'])) {
                add_editor_style($theme_uri . '/dist/' . $manifest['resources/scss/editor-style.scss']['file']);
            }
        }
        
        // Production mode - assets are handled by manifest
    }
}

// Load assets
add_action('wp_enqueue_scripts', 'pico_load_vite_assets');

/**
 * Load customizer preview scripts
 */
function sigil_load_customizer_assets() {
    // Only load in customizer preview
    if (is_customize_preview()) {
        wp_enqueue_script(
            'sigil-customizer-preview',
            get_template_directory_uri() . '/resources/js/customizer.js',
            ['jquery', 'customize-preview'],
            filemtime(get_template_directory() . '/resources/js/customizer.js'),
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'sigil_load_customizer_assets');

/**
 * Load customizer controls scripts in admin
 */
function sigil_load_customizer_controls() {
    wp_enqueue_script(
        'sigil-customizer-controls',
        get_template_directory_uri() . '/resources/js/customizer.js',
        ['jquery', 'customize-controls'],
        filemtime(get_template_directory() . '/resources/js/customizer.js'),
        true
    );
}
add_action('customize_controls_enqueue_scripts', 'sigil_load_customizer_controls'); 