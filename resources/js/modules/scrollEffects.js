/**
 * Scroll Effects Module
 * 
 * Handles scroll-based animations and header effects
 */

export class ScrollEffects {
    constructor(options = {}) {
        this.isInitialized = false;
        this.scrollThreshold = options.scrollThreshold || 50;
        this.scrollClass = options.scrollClass || 'scrolled';
        this.targetElement = options.targetElement || '#masthead';
        this.throttleDelay = options.throttleDelay || 16; // ~60fps
        this.isScrolling = false;
    }

    /**
     * Initialize scroll effects
     */
    init() {
        if (this.isInitialized) return;

        this.setupScrollHandler();
        this.checkInitialScrollPosition();
        this.isInitialized = true;
    }

    /**
     * Check initial scroll position on page load
     */
    checkInitialScrollPosition() {
        const header = document.querySelector(this.targetElement);
        if (header && window.scrollY > this.scrollThreshold) {
            header.classList.add(this.scrollClass);
        }
    }

    /**
     * Setup scroll event handler with throttling
     */
    setupScrollHandler() {
        window.addEventListener('scroll', this.throttle(this.handleScroll.bind(this), this.throttleDelay));
    }

    /**
     * Handle scroll events
     */
    handleScroll() {
        const header = document.querySelector(this.targetElement);
        if (!header) return;

        if (window.scrollY > this.scrollThreshold) {
            if (!header.classList.contains(this.scrollClass)) {
                header.classList.add(this.scrollClass);
                this.onScrolledDown();
            }
        } else {
            if (header.classList.contains(this.scrollClass)) {
                header.classList.remove(this.scrollClass);
                this.onScrolledUp();
            }
        }
    }

    /**
     * Throttle function to limit scroll event frequency
     */
    throttle(func, delay) {
        let timeoutId;
        let lastExecTime = 0;
        
        return function(...args) {
            const currentTime = Date.now();
            
            if (currentTime - lastExecTime > delay) {
                func.apply(this, args);
                lastExecTime = currentTime;
            } else {
                clearTimeout(timeoutId);
                timeoutId = setTimeout(() => {
                    func.apply(this, args);
                    lastExecTime = Date.now();
                }, delay - (currentTime - lastExecTime));
            }
        };
    }

    /**
     * Hook for when scrolled down past threshold
     */
    onScrolledDown() {
        // Override this method to add custom functionality
        // console.log('Scrolled down');
    }

    /**
     * Hook for when scrolled up past threshold
     */
    onScrolledUp() {
        // Override this method to add custom functionality
        // console.log('Scrolled up');
    }

    /**
     * Update scroll threshold
     */
    updateThreshold(newThreshold) {
        this.scrollThreshold = newThreshold;
    }

    /**
     * Update target element
     */
    updateTarget(newTarget) {
        this.targetElement = newTarget;
    }

    /**
     * Destroy scroll effects
     */
    destroy() {
        window.removeEventListener('scroll', this.handleScroll);
        const header = document.querySelector(this.targetElement);
        if (header) {
            header.classList.remove(this.scrollClass);
        }
        this.isInitialized = false;
    }
}

// Export a default instance with default options
export default new ScrollEffects(); 