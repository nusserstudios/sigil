/**
 * Utility Functions Module
 * 
 * Common helper functions for the Sigil theme
 */

/**
 * Debounce function to limit function calls
 */
export function debounce(func, delay) {
    let timeoutId;
    return function(...args) {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => func.apply(this, args), delay);
    };
}

/**
 * Throttle function to limit function calls
 */
export function throttle(func, delay) {
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
 * Check if element exists in DOM
 */
export function elementExists(selector) {
    return document.querySelector(selector) !== null;
}

/**
 * Get viewport dimensions
 */
export function getViewportDimensions() {
    return {
        width: window.innerWidth,
        height: window.innerHeight
    };
}

/**
 * Check if device is mobile based on viewport width
 */
export function isMobile(breakpoint = 768) {
    return window.innerWidth <= breakpoint;
}

/**
 * Check if device is desktop based on viewport width
 */
export function isDesktop(breakpoint = 768) {
    return window.innerWidth > breakpoint;
}

/**
 * Add multiple event listeners to an element
 */
export function addEventListeners(element, events, handler) {
    events.split(' ').forEach(event => {
        element.addEventListener(event, handler);
    });
}

/**
 * Remove multiple event listeners from an element
 */
export function removeEventListeners(element, events, handler) {
    events.split(' ').forEach(event => {
        element.removeEventListener(event, handler);
    });
}

/**
 * Get all elements matching a selector
 */
export function getElements(selector) {
    return Array.from(document.querySelectorAll(selector));
}

/**
 * Get single element matching a selector
 */
export function getElement(selector) {
    return document.querySelector(selector);
}

/**
 * Check if element has class
 */
export function hasClass(element, className) {
    return element && element.classList.contains(className);
}

/**
 * Toggle class on element
 */
export function toggleClass(element, className) {
    if (element) {
        element.classList.toggle(className);
    }
}

/**
 * Add class to element
 */
export function addClass(element, className) {
    if (element) {
        element.classList.add(className);
    }
}

/**
 * Remove class from element
 */
export function removeClass(element, className) {
    if (element) {
        element.classList.remove(className);
    }
}

/**
 * Wait for DOM to be ready
 */
export function domReady(callback) {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', callback);
    } else {
        callback();
    }
}

/**
 * Get element's offset position
 */
export function getOffset(element) {
    const rect = element.getBoundingClientRect();
    return {
        top: rect.top + window.pageYOffset,
        left: rect.left + window.pageXOffset
    };
}

/**
 * Check if element is in viewport
 */
export function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

/**
 * Get scroll position
 */
export function getScrollPosition() {
    return {
        x: window.pageXOffset || document.documentElement.scrollLeft,
        y: window.pageYOffset || document.documentElement.scrollTop
    };
}

/**
 * Smooth scroll to element
 */
export function scrollToElement(element, options = {}) {
    const defaultOptions = {
        behavior: 'smooth',
        block: 'start',
        inline: 'nearest'
    };
    
    const scrollOptions = { ...defaultOptions, ...options };
    
    if (element) {
        element.scrollIntoView(scrollOptions);
    }
}

/**
 * Create element with attributes
 */
export function createElement(tag, attributes = {}, innerHTML = '') {
    const element = document.createElement(tag);
    
    Object.entries(attributes).forEach(([key, value]) => {
        if (key === 'className') {
            element.className = value;
        } else if (key === 'dataset') {
            Object.entries(value).forEach(([dataKey, dataValue]) => {
                element.dataset[dataKey] = dataValue;
            });
        } else {
            element.setAttribute(key, value);
        }
    });
    
    if (innerHTML) {
        element.innerHTML = innerHTML;
    }
    
    return element;
} 