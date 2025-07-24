import { defineConfig } from 'vite';
import { resolve } from 'path';

export default defineConfig({
  build: {
    outDir: 'dist',
    rollupOptions: {
      input: {
        'app': resolve(__dirname, 'resources/js/app.js'),
        'editor': resolve(__dirname, 'resources/js/editor.js'),
        'app-css': resolve(__dirname, 'resources/scss/app.scss'),
        'editor-style': resolve(__dirname, 'resources/scss/editor-style.scss'),
      },
      external: [
        '@wordpress/blocks',
        '@wordpress/block-editor',
        '@wordpress/components',
        '@wordpress/i18n',
        '@wordpress/hooks',
        '@wordpress/compose',
        '@wordpress/element',
        '@wordpress/data',
        'react',
        'react-dom'
      ],
      output: {
        entryFileNames: 'js/[name].js',
        chunkFileNames: 'js/[name].js',
        assetFileNames: (assetInfo) => {
          const info = assetInfo.name.split('.');
          const ext = info[info.length - 1];
          if (/\.(css)$/.test(assetInfo.name)) {
            return `css/[name].${ext}`;
          }
          return `assets/[name].[ext]`;
        }
      }
    },
    manifest: true
  }
}); 