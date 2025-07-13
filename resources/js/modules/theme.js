/**
 * Sigil Theme Module
 * 
 * Main theme coordination and API
 */

import offCanvasMenu from './offCanvasMenu.js';
import scrollEffects from './scrollEffects.js';
import { ThemeToggle } from './themeToggle.js';
import { domReady } from './utils.js';

export class SigilTheme {
    constructor() {
        this.modules = {
            offCanvasMenu,
            scrollEffects,
            themeToggle: null // Will be created during initialization
        };
        this.isInitialized = false;
        this.config = {};
    }

    /**
     * Initialize the theme
     */
    init(config = {}) {
        if (this.isInitialized) return;

        this.config = {
            enableOffCanvasMenu: true,
            enableScrollEffects: true,
            enableThemeToggle: true,
            scrollEffectsOptions: {
                scrollThreshold: 50,
                scrollClass: 'scrolled',
                targetElement: '#masthead'
            },
            themeToggleOptions: {
                storageKey: 'sigil-theme',
                darkClass: 'dark',
                targetElement: document.documentElement,
                preferredTheme: 'light' // Fallback only (system preference takes priority)
            },
            ...config
        };

        domReady(() => {
            this.initializeModules();
            this.isInitialized = true;
            this.onInitialized();
        });
    }

    /**
     * Initialize all enabled modules
     */
    initializeModules() {
        if (this.config.enableOffCanvasMenu) {
            this.modules.offCanvasMenu.init();
        }

        if (this.config.enableScrollEffects) {
            this.modules.scrollEffects.init();
        }

        if (this.config.enableThemeToggle) {
            // Create theme toggle instance with configuration
            this.modules.themeToggle = new ThemeToggle(this.config.themeToggleOptions);
            this.modules.themeToggle.init();
        }
    }

    /**
     * Get a specific module
     */
    getModule(name) {
        return this.modules[name];
    }

    /**
     * Add a custom module
     */
    addModule(name, module) {
        this.modules[name] = module;
        
        // Initialize if theme is already initialized
        if (this.isInitialized && module.init) {
            module.init();
        }
    }

    /**
     * Remove a module
     */
    removeModule(name) {
        const module = this.modules[name];
        if (module && module.destroy) {
            module.destroy();
        }
        delete this.modules[name];
    }

    /**
     * Update theme configuration
     */
    updateConfig(newConfig) {
        this.config = { ...this.config, ...newConfig };
        
        // Re-initialize modules if needed
        if (this.isInitialized) {
            this.reinitializeModules();
        }
    }

    /**
     * Reinitialize modules after config change
     */
    reinitializeModules() {
        // Destroy existing modules
        Object.values(this.modules).forEach(module => {
            if (module.destroy) {
                module.destroy();
            }
        });

        // Reinitialize
        this.initializeModules();
    }

    /**
     * Hook for when theme is initialized
     */
    onInitialized() {
        // Fire custom event
        const event = new CustomEvent('sigil:initialized', {
            detail: { theme: this }
        });
        document.dispatchEvent(event);
    }

    /**
     * Get theme information
     */
    getInfo() {
        return {
            version: '1.0.0',
            modules: Object.keys(this.modules),
            config: this.config,
            isInitialized: this.isInitialized
        };
    }

    /**
     * Destroy the theme
     */
    destroy() {
        Object.values(this.modules).forEach(module => {
            if (module.destroy) {
                module.destroy();
            }
        });
        
        this.isInitialized = false;
        
        // Fire custom event
        const event = new CustomEvent('sigil:destroyed');
        document.dispatchEvent(event);
    }
}

// Export a default instance
export default new SigilTheme(); 