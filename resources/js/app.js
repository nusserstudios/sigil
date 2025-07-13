/**
 * Sigil Theme JavaScript
 * 
 * Main entry point for theme functionality
 */

// Import SCSS styles for Vite processing
import '../scss/app.scss';

// Import theme modules
import theme from './modules/theme.js';
import { OffCanvasMenu } from './modules/offCanvasMenu.js';
import { ScrollEffects } from './modules/scrollEffects.js';
import { ThemeToggle } from './modules/themeToggle.js';

// Initialize theme with default configuration
theme.init();

// Make theme available globally for debugging and external access
window.SigilTheme = theme;

// Export modules for external use
export { theme, OffCanvasMenu, ScrollEffects, ThemeToggle };

// Export theme as default
export default theme;
