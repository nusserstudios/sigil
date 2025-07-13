<?php

// Autoloader for Sigil classes
spl_autoload_register(function ($class) {
    $prefix = 'Sigil\\';
    $base_dir = __DIR__ . '/functions/';

    // Check if the class uses the Sigil namespace
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    // Get the relative class name
    $relative_class = substr($class, $len);

    // Replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators, and append with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // If the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

// Load modular function files
$function_files = [
    'theme-setup.php',      // Theme setup and supports
    'assets.php',           // Asset loading (Vite)
    'asset-helpers.php',    // Asset URL helpers for images
    'off-canvas-menu.php',  // Off-canvas menu functionality
    'walkers.php',          // Walker functionality
    'pagination.php',       // Pagination helpers
    'admin.php',            // Admin functionality
    'theme-options.php',    // Theme options and customizer
];

foreach ($function_files as $file) {
    $file_path = __DIR__ . '/functions/' . $file;
    if (file_exists($file_path)) {
        require_once $file_path;
    }
}
