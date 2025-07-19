/**
 * Theme Toggle Module
 * 
 * Handles light/dark mode switching functionality
 */

import { getElement, addClass, removeClass, hasClass } from './utils.js';

export class ThemeToggle {
    constructor(options = {}) {
        this.isInitialized = false;
        this.storageKey = options.storageKey || 'sigil-theme';
        this.darkClass = options.darkClass || 'dark';
        this.lightIconSelector = options.lightIconSelector || '#theme-toggle-light-icon';
        this.darkIconSelector = options.darkIconSelector || '#theme-toggle-dark-icon';
        this.desktopToggleSelector = options.desktopToggleSelector || '#theme-toggle';
        this.mobileToggleSelector = options.mobileToggleSelector || '#mobile-theme-toggle';
        this.targetElement = options.targetElement || document.documentElement;
        this.preferredTheme = options.preferredTheme || 'light'; // Default preferred theme
        
        this.currentTheme = this.getStoredTheme() || this.getSystemTheme() || this.preferredTheme;
    }

    /**
     * Initialize the theme toggle
     */
    init() {
        if (this.isInitialized) return;

        this.preventInitialTransitions();
        this.setupEventListeners();
        this.applyTheme(this.currentTheme);
        this.updateToggleStates();
        this.enableTransitions();
        this.isInitialized = true;
    }

    /**
     * Setup event listeners for theme toggle buttons
     */
    setupEventListeners() {
        // Desktop toggle
        const desktopToggle = getElement(this.desktopToggleSelector);
        if (desktopToggle) {
            desktopToggle.addEventListener('click', this.handleToggleClick.bind(this));
        }

        // Mobile toggle
        const mobileToggle = getElement(this.mobileToggleSelector);
        if (mobileToggle) {
            mobileToggle.addEventListener('click', this.handleToggleClick.bind(this));
        }

        // Note: We only support manual theme toggle, not system preference detection
    }

    /**
     * Handle toggle button clicks
     */
    handleToggleClick(event) {
        event.preventDefault();
        this.toggleTheme();
    }



    /**
     * Toggle between light and dark themes
     */
    toggleTheme() {
        const newTheme = this.currentTheme === 'dark' ? 'light' : 'dark';
        this.setTheme(newTheme);
    }

    /**
     * Set the theme to a specific value
     */
    setTheme(theme) {
        if (theme !== 'light' && theme !== 'dark') {
            console.warn('Invalid theme value. Use "light" or "dark".');
            return;
        }

        // Temporarily disable transitions during theme change
        this.preventTransitions();
        
        this.currentTheme = theme;
        
        this.applyTheme(theme);
        this.storeTheme(theme);
        this.updateToggleStates();
        this.onThemeChange(theme);
        
        // Re-enable transitions after a brief delay
        this.enableTransitionsDelayed();
    }

    /**
     * Apply the theme to the document
     */
    applyTheme(theme) {
        if (theme === 'dark') {
            addClass(this.targetElement, this.darkClass);
            removeClass(this.targetElement, 'light');
        } else {
            removeClass(this.targetElement, this.darkClass);
            addClass(this.targetElement, 'light');
        }
    }

    /**
     * Prevent transitions during initial load
     */
    preventInitialTransitions() {
        addClass(document.body, 'preload');
    }

    /**
     * Enable transitions after initial load
     */
    enableTransitions() {
        // Use requestAnimationFrame to ensure DOM is updated
        requestAnimationFrame(() => {
            removeClass(document.body, 'preload');
        });
    }

    /**
     * Prevent transitions during theme changes
     */
    preventTransitions() {
        addClass(document.body, 'preload');
    }

    /**
     * Enable transitions after theme change with delay
     */
    enableTransitionsDelayed() {
        // Wait a bit longer for theme change to ensure all elements are updated
        setTimeout(() => {
            requestAnimationFrame(() => {
                removeClass(document.body, 'preload');
            });
        }, 50); // 50ms delay
    }

    /**
     * Update toggle button states and icons
     */
    updateToggleStates() {
        const lightIcon = getElement(this.lightIconSelector);
        const darkIcon = getElement(this.darkIconSelector);
        const desktopToggle = getElement(this.desktopToggleSelector);
        const mobileToggle = getElement(this.mobileToggleSelector);

        // Update SVG morphing for new icon-theme-toggle structure
        const desktopSvg = desktopToggle ? desktopToggle.querySelector('svg.icon-theme-toggle') : null;
        const mobileSvg = mobileToggle ? mobileToggle.querySelector('svg.icon-theme-toggle') : null;

        if (this.currentTheme === 'dark') {
            // Add moon class for SVG morphing
            if (desktopSvg) {
                addClass(desktopSvg, 'moon');
            }
            if (mobileSvg) {
                addClass(mobileSvg, 'moon');
            }

            // Legacy icon handling (for backward compatibility)
            if (lightIcon) {
                removeClass(lightIcon, 'hidden');
                lightIcon.style.display = 'block';
            }
            if (darkIcon) {
                addClass(darkIcon, 'hidden');
                darkIcon.style.display = 'none';
            }
            
            // Update button attributes
            if (desktopToggle) {
                desktopToggle.setAttribute('aria-label', 'Switch to light mode');
                desktopToggle.setAttribute('data-theme', 'dark');
            }
            if (mobileToggle) {
                mobileToggle.setAttribute('aria-label', 'Switch to light mode');
                mobileToggle.setAttribute('data-theme', 'dark');
                this.updateMobileToggleContent(mobileToggle, 'light');
            }
        } else {
            // Remove moon class for SVG morphing
            if (desktopSvg) {
                removeClass(desktopSvg, 'moon');
            }
            if (mobileSvg) {
                removeClass(mobileSvg, 'moon');
            }

            // Legacy icon handling (for backward compatibility)
            if (lightIcon) {
                addClass(lightIcon, 'hidden');
                lightIcon.style.display = 'none';
            }
            if (darkIcon) {
                removeClass(darkIcon, 'hidden');
                darkIcon.style.display = 'block';
            }
            
            // Update button attributes
            if (desktopToggle) {
                desktopToggle.setAttribute('aria-label', 'Switch to dark mode');
                desktopToggle.setAttribute('data-theme', 'light');
            }
            if (mobileToggle) {
                mobileToggle.setAttribute('aria-label', 'Switch to dark mode');
                mobileToggle.setAttribute('data-theme', 'light');
                this.updateMobileToggleContent(mobileToggle, 'dark');
            }
        }
    }

    /**
     * Update mobile toggle button content
     */
    updateMobileToggleContent(button, targetMode) {
        if (!button) return;

        const svg = button.querySelector('svg');
        const text = button.querySelector('.toggle-text');
        
        // For the new icon-theme-toggle structure, we don't need to update innerHTML
        // The morphing is handled by CSS and the moon class
        if (svg && svg.classList.contains('icon-theme-toggle')) {
            // Just update the text content
            if (text) {
                text.textContent = targetMode === 'dark' ? 'Turn on dark mode' : 'Turn off dark mode';
            }
            return;
        }

        // Legacy handling for old SVG structure
        if (targetMode === 'dark') {
            // Currently light, show option to go dark
            if (svg) {
                svg.innerHTML = `
                    <clipPath id="theme-toggle-cutout">
                        <path d="M0-11h25a1 1 0 0017 13v30H0Z"></path>
                    </clipPath>
                    <g clip-path="url(#theme-toggle-cutout)">
                        <circle cx="16" cy="16" r="8.4"></circle>
                        <path d="M18.3 3.2c0 1.3-1 2.3-2.3 2.3s-2.3-1-2.3-2.3S14.7.9 16 .9s2.3 1 2.3 2.3zm-4.6 25.6c0-1.3 1-2.3 2.3-2.3s2.3 1 2.3 2.3-1 2.3-2.3 2.3-2.3-1-2.3-2.3zm15.1-10.5c-1.3 0-2.3-1-2.3-2.3s1-2.3 2.3-2.3 2.3 1 2.3 2.3-1 2.3-2.3 2.3zM3.2 13.7c1.3 0 2.3 1 2.3 2.3s-1 2.3-2.3 2.3S.9 17.3.9 16s1-2.3 2.3-2.3zm5.8-7C9 7.9 7.9 9 6.7 9S4.4 8 4.4 6.7s1-2.3 2.3-2.3S9 5.4 9 6.7zm16.3 21c-1.3 0-2.3-1-2.3-2.3s1-2.3 2.3-2.3 2.3 1 2.3 2.3-1 2.3-2.3 2.3zm2.4-21c0 1.3-1 2.3-2.3 2.3S23 7.9 23 6.7s1-2.3 2.3-2.3 2.4 1 2.4 2.3zM6.7 23C8 23 9 24 9 25.3s-1 2.3-2.3 2.3-2.3-1-2.3-2.3 1-2.3 2.3-2.3z"></path>
                    </g>
                `;
            }
            if (text) text.textContent = 'Turn on dark mode';
        } else {
            // Currently dark, show option to go light
            if (svg) {
                svg.innerHTML = `
                    <circle cx="16" cy="16" r="8.4"></circle>
                    <path d="M18.3 3.2c0 1.3-1 2.3-2.3 2.3s-2.3-1-2.3-2.3S14.7.9 16 .9s2.3 1 2.3 2.3zm-4.6 25.6c0-1.3 1-2.3 2.3-2.3s2.3 1 2.3 2.3-1 2.3-2.3 2.3-2.3-1-2.3-2.3zm15.1-10.5c-1.3 0-2.3-1-2.3-2.3s1-2.3 2.3-2.3 2.3 1 2.3 2.3-1 2.3-2.3 2.3zM3.2 13.7c1.3 0 2.3 1 2.3 2.3s-1 2.3-2.3 2.3S.9 17.3.9 16s1-2.3 2.3-2.3zm5.8-7C9 7.9 7.9 9 6.7 9S4.4 8 4.4 6.7s1-2.3 2.3-2.3S9 5.4 9 6.7zm16.3 21c-1.3 0-2.3-1-2.3-2.3s1-2.3 2.3-2.3 2.3 1 2.3 2.3-1 2.3-2.3 2.3zm2.4-21c0 1.3-1 2.3-2.3 2.3S23 7.9 23 6.7s1-2.3 2.3-2.3 2.4 1 2.4 2.3zM6.7 23C8 23 9 24 9 25.3s-1 2.3-2.3 2.3-2.3-1-2.3-2.3 1-2.3 2.3-2.3z"></path>
                `;
            }
            if (text) text.textContent = 'Turn off dark mode';
        }
    }

    /**
     * Get the current theme
     */
    getCurrentTheme() {
        return this.currentTheme;
    }

    /**
     * Set the preferred theme (used when no user preference is stored)
     */
    setPreferredTheme(theme) {
        if (theme !== 'light' && theme !== 'dark') {
            console.warn('Invalid preferred theme value. Use "light" or "dark".');
            return;
        }
        
        this.preferredTheme = theme;
        
        // If user hasn't made a choice, apply the new preferred theme
        if (!this.getStoredTheme()) {
            this.currentTheme = this.getSystemTheme() || theme;
            this.applyTheme(this.currentTheme);
            this.updateToggleStates();
        }
    }

    /**
     * Get the preferred theme
     */
    getPreferredTheme() {
        return this.preferredTheme;
    }

    /**
     * Reset to preferred theme (clears user choice)
     */
    resetToPreferred() {
        try {
            localStorage.removeItem(this.storageKey);
        } catch (e) {
            console.warn('Unable to clear theme preference');
        }
        
        this.currentTheme = this.getSystemTheme() || this.preferredTheme;
        this.applyTheme(this.currentTheme);
        this.updateToggleStates();
        this.onThemeChange(this.currentTheme);
    }

    /**
     * Get stored theme from localStorage
     */
    getStoredTheme() {
        try {
            return localStorage.getItem(this.storageKey);
        } catch (e) {
            return null;
        }
    }

        /**
     * Store theme in localStorage
     */
    storeTheme(theme) {
        try {
            localStorage.setItem(this.storageKey, theme);
        } catch (e) {
            console.warn('Unable to store theme preference');
        }
    }

    /**
     * Get system theme preference (fallback only)
     */
    getSystemTheme() {
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            return 'dark';
        }
        return 'light';
    }

    /**
     * Hook for theme change events
     */
    onThemeChange(theme) {
        // Fire custom event
        const event = new CustomEvent('sigil:theme-changed', {
            detail: { 
                theme: theme,
                previousTheme: theme === 'dark' ? 'light' : 'dark'
            }
        });
        document.dispatchEvent(event);
    }

    /**
     * Destroy the theme toggle
     */
    destroy() {
        const desktopToggle = getElement(this.desktopToggleSelector);
        const mobileToggle = getElement(this.mobileToggleSelector);

        if (desktopToggle) {
            desktopToggle.removeEventListener('click', this.handleToggleClick);
        }
        if (mobileToggle) {
            mobileToggle.removeEventListener('click', this.handleToggleClick);
        }

        this.isInitialized = false;
    }
}

// Export a default instance
export default new ThemeToggle();