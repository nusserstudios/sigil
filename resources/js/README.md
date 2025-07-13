# Sigil JavaScript Modules

This directory contains the modular JavaScript architecture for the Sigil theme. The code has been refactored from a single monolithic file into separate ES modules for better maintainability, reusability, and testing.

## Structure

```
js/
├── app.js              # Main entry point
├── modules/
│   ├── theme.js        # Main theme coordinator
│   ├── offCanvasMenu.js # Off-canvas menu functionality
│   ├── scrollEffects.js # Scroll-based effects
│   ├── themeToggle.js  # Light/dark mode toggle
│   └── utils.js        # Utility functions
└── README.md           # This file
```

## Modules Overview

### `app.js`
The main entry point that imports and initializes all theme modules. It also makes the theme available globally for debugging.

### `modules/theme.js`
The central theme coordinator that manages all other modules. Provides:
- Module initialization and configuration
- Event coordination
- Plugin-like architecture for adding custom modules
- Theme lifecycle management

### `modules/offCanvasMenu.js`
Handles all off-canvas menu functionality including:
- Mobile menu toggle
- Navigation positioning (desktop/mobile)
- Submenu management
- Keyboard navigation
- Back button functionality

### `modules/scrollEffects.js`
Manages scroll-based animations and effects:
- Header scroll state changes
- Throttled scroll handling
- Configurable scroll thresholds
- Extensible for additional scroll effects

### `modules/themeToggle.js`
Handles light/dark mode theme switching:
- Automatic system theme detection
- localStorage persistence
- Desktop and mobile toggle buttons
- Smooth theme transitions
- Custom events for theme changes

### `modules/utils.js`
Common utility functions used across modules:
- DOM manipulation helpers
- Event handling utilities
- Viewport and device detection
- Performance helpers (throttle, debounce)

## Usage

### Basic Initialization
```javascript
// The theme initializes automatically when app.js loads
// No additional code needed for basic functionality
```

### Custom Configuration
```javascript
import theme from './modules/theme.js';

// Initialize with custom configuration
theme.init({
    enableOffCanvasMenu: true,
    enableScrollEffects: true,
    enableThemeToggle: true,
    scrollEffectsOptions: {
        scrollThreshold: 100,
        scrollClass: 'custom-scrolled',
        targetElement: '#custom-header'
    },
    themeToggleOptions: {
        storageKey: 'my-theme-preference',
        darkClass: 'dark-mode',
        targetElement: document.body
    }
});
```

### Adding Custom Modules
```javascript
import theme from './modules/theme.js';

// Create a custom module
class CustomModule {
    init() {
        console.log('Custom module initialized');
    }
    
    destroy() {
        console.log('Custom module destroyed');
    }
}

// Add to theme
theme.addModule('customModule', new CustomModule());
```

### Using Individual Modules
```javascript
import { OffCanvasMenu, ScrollEffects, ThemeToggle } from './modules/offCanvasMenu.js';

// Use modules directly
const customMenu = new OffCanvasMenu();
customMenu.init();

const customScrolls = new ScrollEffects({
    scrollThreshold: 200,
    scrollClass: 'super-scrolled'
});
customScrolls.init();

const customTheme = new ThemeToggle({
    storageKey: 'custom-theme',
    darkClass: 'dark-theme',
    targetElement: document.body
});
customTheme.init();
```

### Accessing Theme Globally
```javascript
// Available in browser console or external scripts
window.SigilTheme.getInfo(); // Get theme information
window.SigilTheme.getModule('offCanvasMenu'); // Get specific module
window.SigilTheme.getModule('themeToggle').toggleTheme(); // Toggle theme
window.SigilTheme.getModule('themeToggle').setTheme('dark'); // Set specific theme
```

## Events

The theme fires custom events during its lifecycle:

```javascript
// Listen for theme initialization
document.addEventListener('sigil:initialized', (event) => {
    console.log('Theme initialized', event.detail.theme);
});

// Listen for theme destruction
document.addEventListener('sigil:destroyed', (event) => {
    console.log('Theme destroyed');
});

// Listen for theme changes
document.addEventListener('sigil:theme-changed', (event) => {
    console.log('Theme changed to:', event.detail.theme);
    console.log('Previous theme:', event.detail.previousTheme);
});
```

## Benefits of This Structure

1. **Modularity**: Each feature is in its own module
2. **Reusability**: Modules can be used independently
3. **Maintainability**: Easier to debug and update individual features
4. **Testability**: Each module can be tested in isolation
5. **Extensibility**: Easy to add new modules or extend existing ones
6. **Performance**: Only load what you need
7. **Modern JavaScript**: Uses ES6+ features and module system

## Development

### Adding New Modules

1. Create a new file in the `modules/` directory
2. Export a class with `init()` and optionally `destroy()` methods
3. Import and register it in `theme.js`
4. Initialize it in the theme's `initializeModules()` method

### Extending Existing Modules

Each module is designed to be extensible. You can:
- Extend classes to add new functionality
- Override methods to change behavior
- Add hooks and events for custom integration

### Building

The modules are designed to work with modern build tools like Vite, Webpack, or Rollup that support ES modules natively. 