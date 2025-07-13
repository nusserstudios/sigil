# Sigil WordPress Theme

A modern, modular WordPress theme built with Vite, Sass, and a custom JavaScript framework. Sigil provides a robust foundation for building fast, maintainable WordPress websites with modern development tools.

## Features

- **Modern Build System**: Vite for lightning-fast development and optimized production builds
- **Modular JavaScript**: ES6 modules with a plugin-like architecture
- **Advanced SCSS**: Organized Sass structure with abstracts, components, and layouts
- **WordPress Integration**: Built on the Sigil framework for seamless WordPress development
- **Hot Module Replacement**: Instant updates during development
- **Responsive Design**: Mobile-first approach with modern CSS
- **Theme Toggle**: Light/dark mode switching with system preference detection
- **Off-Canvas Menu**: Mobile-friendly navigation system
- **Scroll Effects**: Smooth scroll-based animations and state changes

## Requirements

- **PHP**: 8.0.2 or higher
- **Node.js**: 16.0 or higher
- **WordPress**: 6.0 or higher
- **Composer**: For PHP dependencies

## Installation

### 1. Clone or Download the Theme

```bash
# Clone from repository
git clone https://github.com/nusserstudios/sigil.git wp-content/themes/sigil

# Or download and extract to wp-content/themes/sigil/
```

### 2. Install Dependencies

```bash
# Navigate to theme directory
cd wp-content/themes/sigil

# Install Node.js dependencies
npm install
# or
pnpm install

# Install PHP dependencies
composer install
```

### 3. Configure Development Environment

Update the Vite configuration for your local development URL:

```javascript
// vite.config.mjs - Update the server configuration
server: {
    port: 3000,
    cors: true,
    origin: 'http://localhost:3000',
    host: '0.0.0.0',
    headers: {
        'Access-Control-Allow-Origin': 'https://your-local-site.test', // Update this
        'Access-Control-Allow-Methods': 'GET, POST, PUT, DELETE, OPTIONS',
        'Access-Control-Allow-Headers': 'Content-Type, Authorization',
    }
}
```

### 4. Activate the Theme

1. Go to your WordPress admin panel
2. Navigate to **Appearance > Themes**
3. Activate the **Sigil** theme

## Development

### Starting Development Server

```bash
# Start Vite development server
npm run dev
# or
pnpm dev
```

This will:
- Start the Vite dev server on `http://localhost:3000`
- Watch for changes in PHP, SCSS, and JavaScript files
- Enable Hot Module Replacement (HMR)
- Auto-reload on PHP/HTML changes

### Building for Production

```bash
# Build optimized assets for production
npm run build
# or
pnpm build
```

### Watch Mode for Production

```bash
# Build and watch for changes
npm run build:watch
# or
pnpm build:watch
```

## Project Structure

```
sigil/
├── resources/                 # Source files
│   ├── js/                   # JavaScript modules
│   │   ├── app.js           # Main entry point
│   │   └── modules/         # Modular JavaScript
│   └── scss/                # Sass stylesheets
│       ├── app.scss         # Main stylesheet
│       ├── abstracts/       # Variables, mixins, functions
│       ├── base/            # Base styles and resets
│       ├── components/      # Reusable components
│       ├── layout/          # Layout and grid systems
│       ├── pages/           # Page-specific styles
│       └── wordpress/       # WordPress-specific styles
├── dist/                     # Built assets (generated)
├── template-parts/           # WordPress template parts
├── functions/                # PHP functions and classes
├── acf/                      # Advanced Custom Fields
├── static/                   # Static assets (images, fonts)
├── vendor/                   # Composer dependencies
├── vite.config.mjs          # Vite configuration
├── package.json             # Node.js dependencies
├── composer.json            # PHP dependencies
└── theme.json               # WordPress theme configuration
```

## JavaScript Architecture

The theme uses a modular JavaScript architecture with ES6 modules:

### Core Modules

- **`theme.js`**: Main theme coordinator and module manager
- **`offCanvasMenu.js`**: Mobile navigation and menu functionality
- **`scrollEffects.js`**: Scroll-based animations and state changes
- **`themeToggle.js`**: Light/dark mode switching
- **`utils.js`**: Common utility functions

### Usage Examples

```javascript
// Access theme globally
window.SigilTheme.getInfo();

// Toggle theme mode
window.SigilTheme.getModule('themeToggle').toggleTheme();

// Custom module initialization
import theme from './modules/theme.js';

theme.init({
    enableOffCanvasMenu: true,
    enableScrollEffects: true,
    enableThemeToggle: true
});
```

## Sass Architecture

The SCSS is organized using the 7-1 pattern:

### Directory Structure

- **`abstracts/`**: Variables, mixins, functions
- **`base/`**: Base styles, resets, typography
- **`components/`**: Reusable UI components
- **`layout/`**: Grid systems, headers, footers
- **`pages/`**: Page-specific styles
- **`wordpress/`**: WordPress-specific styles
- **`app.scss`**: Main entry point

### Usage

```scss
// Import in your components
@import 'abstracts/variables';
@import 'abstracts/mixins';

.my-component {
    @include responsive-font(16px, 24px);
    color: $primary-color;
}
```

## WordPress Integration

### Template Parts

The theme uses WordPress template parts for modular template structure:

```php
// Include template parts
get_template_part('template-parts/content', 'page');
get_template_part('template-parts/header', 'navigation');
```

### Functions

Custom functions are organized in the `functions/` directory:

- **`setup.php`**: Theme setup and configuration
- **`enqueue.php`**: Script and style enqueuing
- **`customizer.php`**: WordPress customizer integration
- **`acf.php`**: Advanced Custom Fields integration

### Advanced Custom Fields

The theme includes ACF integration for custom fields:

```php
// Get ACF field
$hero_title = get_field('hero_title');

// Check if ACF is active
if (function_exists('get_field')) {
    // ACF code here
}
```

## Configuration

### Vite Configuration

The `vite.config.mjs` file includes:

- **Development server** with CORS support
- **PHP/HTML file watching** with auto-reload
- **SCSS compilation** with source maps
- **Asset optimization** for production
- **Static file handling**

### WordPress Configuration

The `theme.json` file configures:

- **Theme supports** and features
- **Editor styles** and block patterns
- **Custom properties** and settings

## Deployment

### Production Build

1. Run the build command:
   ```bash
   npm run build
   ```

2. Upload the theme files to your WordPress installation

3. Ensure the `dist/` directory is included in your deployment

### Environment Considerations

- Update the Vite base path for your production URL
- Configure your web server to serve static assets efficiently
- Consider using a CDN for static assets in production

## Troubleshooting

### Common Issues

1. **Vite dev server not connecting**:
   - Check your local development URL in `vite.config.mjs`
   - Ensure CORS headers are properly configured

2. **Assets not loading**:
   - Verify the `dist/` directory exists and contains built assets
   - Check file permissions on the `dist/` directory

3. **PHP changes not reflecting**:
   - The Vite dev server watches PHP files and should auto-reload
   - Check the console for watcher status messages

4. **SCSS not compiling**:
   - Ensure Sass dependencies are installed
   - Check for syntax errors in your SCSS files

### Debug Mode

Enable debug mode by accessing the theme globally:

```javascript
// In browser console
window.SigilTheme.getInfo();
window.SigilTheme.getModule('themeToggle').getCurrentTheme();
```

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## License

This theme is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Support

For support and questions:

- **Author**: Jeremy Nusser
- **Website**: https://sigil.io
- **Email**: hello@nusserstudios.com
- **Repository**: https://github.com/sigil/sigil

## Changelog

### Version 0.1.0
- Initial release
- Vite build system integration
- Modular JavaScript architecture
- Advanced SCSS structure
- WordPress integration with Sigil framework
