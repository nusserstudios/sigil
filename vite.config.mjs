import { defineConfig } from 'vite';
import { resolve } from 'path';
import react from '@vitejs/plugin-react';

export default defineConfig({
  plugins: [react()],
  publicDir: 'static',
  build: {
    outDir: 'dist',
    rollupOptions: {
      input: {
        'app': resolve(__dirname, 'resources/js/app.js'),
        'editor': resolve(__dirname, 'resources/js/editor.js'),
        'breakout-enhancements': resolve(__dirname, 'resources/js/breakout-enhancements.jsx'),
        'customizer-tabs': resolve(__dirname, 'resources/js/customizer-tabs.js'),
        'customizer-preview': resolve(__dirname, 'resources/js/customizer-preview.js'),
        'app-css': resolve(__dirname, 'resources/scss/app.scss'),
        'editor-style': resolve(__dirname, 'resources/scss/editor-style.scss'),
        'customizer-tabs-css': resolve(__dirname, 'resources/scss/customizer-tabs.scss'),
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
        'react-dom',
        'react/jsx-runtime'
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