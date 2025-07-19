import { defineConfig } from 'vite'
import { resolve } from 'path'
import { fileURLToPath } from 'url'
import chokidar from 'chokidar'

export default defineConfig(({ command }) => {
    const isBuild = command === 'build';
    const __dirname = fileURLToPath(new URL('.', import.meta.url));

    return {
        base: isBuild ? '/wp-content/themes/sigil/dist/' : '/',
        publicDir: 'static', // Static files copied to outDir (dist) in production, served from /static/ in dev
        server: {
            port: 3000,
            cors: true,
            origin: 'http://localhost:3000',
            host: '0.0.0.0', // Allow external connections
            https: false, // Use HTTP for dev server - mixed content handled by CSP
            watch: {
                usePolling: true,
                interval: 100,
            },
            // Handle mixed content by allowing insecure requests in dev
            headers: {
                'Access-Control-Allow-Origin': 'https://sigil.test',
                'Access-Control-Allow-Methods': 'GET, POST, PUT, DELETE, OPTIONS',
                'Access-Control-Allow-Headers': 'Content-Type, Authorization',
            },
            // Serve static assets directly from static folder in development
            fs: {
                allow: ['..']
            }
        },
        css: {
            preprocessorOptions: {
                scss: {
                    api: 'modern-compiler'
                }
            },
            devSourcemap: true
        },
        build: {
            manifest: true,
            outDir: 'dist',
            emptyOutDir: true,
            assetsDir: '', // Keep processed assets in root of dist
            rollupOptions: {
                input: [
                    resolve(__dirname, 'resources/js/app.js'),
                    resolve(__dirname, 'resources/scss/app.scss'),
                    resolve(__dirname, 'resources/scss/editor-style.scss')
                ],
                output: {
                    entryFileNames: 'js/[name].[hash].js',
                    chunkFileNames: 'js/[name].[hash].js',
                    assetFileNames: (assetInfo) => {
                        const info = assetInfo.name.split('.')
                        const extType = info[info.length - 1]
                        
                        if (/\.(css)$/.test(assetInfo.name)) {
                            return 'css/[name].[hash].[ext]'
                        }
                        if (/\.(png|jpe?g|gif|svg|webp|avif|ico)$/.test(assetInfo.name)) {
                            return 'images/[name].[hash].[ext]'
                        }
                        if (/\.(woff2?|eot|ttf|otf)$/.test(assetInfo.name)) {
                            return 'fonts/[name].[hash].[ext]'
                        }
                        return 'assets/[name].[hash].[ext]'
                    }
                },
                // Only exclude large media files from processing
                external: (id) => {
                    // Exclude large media files that shouldn't be processed
                    return /\.(mp4|webm|ogg|mp3|wav|pdf)$/.test(id);
                }
            },
        },
        plugins: [
            // Enhanced PHP/HTML file watcher
            {
                name: 'php-watcher',
                configureServer(server) {
                    console.log('🔍 PHP Watcher - Theme directory:', __dirname);
                    
                    // Primary watcher with relative paths
                    const watchPaths = [
                        '*.php',                        // Root PHP files
                        '**/*.php',
                        'inc/**/*.php',      // Template parts
                        'src/**/*.php',                 // Source files
                        '*/*.html',
                        '**/*.html'                     // HTML files
                    ];
                    
                    console.log('🔍 PHP Watcher - Watching paths:', watchPaths);
                    
                    const watcher = chokidar.watch(watchPaths, {
                        cwd: __dirname,                 // Use current directory as base
                        ignoreInitial: true,
                        usePolling: true,
                        interval: 200,                  // Faster polling
                        ignored: ['**/node_modules/**', '**/vendor/**', '**/dist/**'],
                        followSymlinks: true
                    });
                    
                    // Fallback watcher for specific files
                    const fallbackWatcher = chokidar.watch([
                        resolve(__dirname, 'header.php'),
                        resolve(__dirname, 'footer.php'),
                        resolve(__dirname, 'index.php'),
                        resolve(__dirname, 'single.php'),
                        resolve(__dirname, 'functions.php'),
                        resolve(__dirname, '404.php'),
                        resolve(__dirname, 'comments.php'),
                        resolve(__dirname, 'searchform.php')
                    ], {
                        ignoreInitial: true,
                        usePolling: true,
                        interval: 200,
                        followSymlinks: true
                    });
                    
                    watcher.on('ready', () => {
                        console.log('✅ PHP Watcher (primary) is ready and watching files');
                    });

                    fallbackWatcher.on('ready', () => {
                        console.log('✅ PHP Watcher (fallback) is ready and watching specific files');
                    });

                    const handleChange = (file, watcherType = 'primary') => {
                        console.log(`🔄 [${watcherType}] PHP/HTML file changed: ${file}`);
                        server.ws.send({ type: 'full-reload' });
                    };

                    watcher.on('change', (file) => handleChange(file, 'primary'));
                    fallbackWatcher.on('change', (file) => handleChange(file, 'fallback'));

                    watcher.on('add', (file) => {
                        console.log(`📁 New PHP/HTML file: ${file}`);
                        server.ws.send({ type: 'full-reload' });
                    });

                    watcher.on('unlink', (file) => {
                        console.log(`🗑️ Deleted PHP/HTML file: ${file}`);
                        server.ws.send({ type: 'full-reload' });
                    });

                    watcher.on('error', (error) => {
                        console.error('❌ PHP Watcher error:', error);
                    });

                    fallbackWatcher.on('error', (error) => {
                        console.error('❌ Fallback PHP Watcher error:', error);
                    });

                    // Debug: List all watched files after 2 seconds
                    setTimeout(() => {
                        const watched = watcher.getWatched();
                        console.log('🔍 PHP Watcher - Currently watched files:', watched);
                        
                        const fallbackWatched = fallbackWatcher.getWatched();
                        console.log('🔍 Fallback PHP Watcher - Currently watched files:', fallbackWatched);
                    }, 2000);
                }
            },
            // SCSS file watcher for enhanced HMR
            {
                name: 'scss-watcher',
                configureServer(server) {
                    const watcher = chokidar.watch(
                        [
                            resolve(__dirname, 'resources/scss/**/*.scss'),
                            resolve(__dirname, 'resources/scss/**/*.sass')
                        ],
                        {
                            ignoreInitial: true,
                            usePolling: true,
                            interval: 200,
                            ignored: ['**/node_modules/**', '**/dist/**']
                        }
                    );
                    
                    watcher.on('change', (file) => {
                        console.log(`🎨 SCSS file changed: ${file}`);
                        // Let Vite handle the HMR automatically
                    });

                    watcher.on('add', (file) => {
                        console.log(`📁 New SCSS file: ${file}`);
                        server.ws.send({ type: 'full-reload' });
                    });

                    watcher.on('unlink', (file) => {
                        console.log(`🗑️ Deleted SCSS file: ${file}`);
                        server.ws.send({ type: 'full-reload' });
                    });
                }
            },
            // Static file watcher for images
            {
                name: 'static-watcher',
                configureServer(server) {
                    const watcher = chokidar.watch(
                        [
                            resolve(__dirname, 'static/**/*')
                        ],
                        {
                            ignoreInitial: true,
                            usePolling: true,
                            interval: 200
                        }
                    );
                    
                    watcher.on('change', (file) => {
                        console.log(`🖼️ Static file changed: ${file}`);
                        server.ws.send({ type: 'full-reload' });
                    });

                    watcher.on('add', (file) => {
                        console.log(`📁 New static file: ${file}`);
                        server.ws.send({ type: 'full-reload' });
                    });

                    watcher.on('unlink', (file) => {
                        console.log(`🗑️ Deleted static file: ${file}`);
                        server.ws.send({ type: 'full-reload' });
                    });
                }
            }
        ],
    }
});