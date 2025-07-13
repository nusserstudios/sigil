/**
 * Off-Canvas Menu Module
 * 
 * Handles mobile menu toggle, navigation movement, and submenu functionality
 */

export class OffCanvasMenu {
    constructor() {
        this.isInitialized = false;
        this.mobileBreakpoint = 768;
    }

    /**
     * Initialize the off-canvas menu
     */
    init() {
        if (this.isInitialized) return;

        this.setupEventListeners();
        this.moveNavigation();
        this.addSubmenuToggles();
        this.isInitialized = true;
    }

    /**
     * Setup all event listeners
     */
    setupEventListeners() {
        // Mobile menu toggle
        const mobileToggle = document.querySelector('#primary-menu-toggle');
        if (mobileToggle) {
            mobileToggle.addEventListener('click', this.handleMobileToggle.bind(this));
        }

        // Close button
        const closeButton = document.querySelector('.nav-close');
        if (closeButton) {
            closeButton.addEventListener('click', this.closeMobileMenu.bind(this));
        }

        // Overlay click
        const overlay = document.querySelector('.menu-overlay');
        if (overlay) {
            overlay.addEventListener('click', this.closeMobileMenu.bind(this));
        }

        // Escape key
        document.addEventListener('keydown', this.handleEscapeKey.bind(this));

        // Resize handler
        window.addEventListener('resize', this.moveNavigation.bind(this));

        // Menu item clicks
        document.addEventListener('click', this.handleMenuItemClick.bind(this));
        document.addEventListener('click', this.handleSubmenuToggle.bind(this));
        document.addEventListener('click', this.handleOutsideClick.bind(this));
        document.addEventListener('click', this.handleBackButton.bind(this));

        // Keyboard navigation
        document.addEventListener('keydown', this.handleKeyboardNavigation.bind(this));
    }

    /**
     * Add back buttons to mobile submenus
     */
    addBackButtonsToMobileSubmenus() {
        const navLinks = document.querySelector('.nav-links');
        if (navLinks) {
            navLinks.querySelectorAll('.main-navigation .sub-menu').forEach(subMenu => {
                if (!subMenu.querySelector('.menu-back')) {
                    const backItem = document.createElement('li');
                    backItem.className = 'menu-back';
                    backItem.innerHTML = `
                        <button class="back-button" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="31.205" height="31.205" viewBox="0 0 50 50">
                                <polyline points="43 12.86 25 37.14 7 12.86" fill="none" stroke="#726e6e" stroke-linecap="round" stroke-miterlimit="10" stroke-width="6"/>
                            </svg>
                            ${window.sigilL10n?.back || 'Back'}
                        </button>
                    `;
                    subMenu.insertBefore(backItem, subMenu.firstChild);
                }
            });
        }
    }

    /**
     * Remove back buttons from submenus (for desktop mode)
     */
    removeBackButtonsFromSubmenus() {
        document.querySelectorAll('.main-navigation .menu-back').forEach(backButton => {
            backButton.remove();
        });
    }

    /**
     * Move navigation between desktop and mobile positions
     */
    moveNavigation() {
        if (window.innerWidth <= this.mobileBreakpoint) {
            const mainNav = document.querySelector('.nav-container .main-navigation');
            const navLinks = document.querySelector('.nav-links');
            
            if (mainNav && navLinks && !navLinks.querySelector('.main-navigation')) {
                navLinks.appendChild(mainNav);
                this.addBackButtonsToMobileSubmenus();
            }
        } else {
            const navContainer = document.querySelector('.nav-container');
            const navLinks = document.querySelector('.nav-links');
            const mainNav = navLinks?.querySelector('.main-navigation');
            
            if (mainNav && navContainer && !navContainer.querySelector('.main-navigation')) {
                navContainer.insertBefore(mainNav, navContainer.querySelector('#primary-menu-toggle'));
                this.removeBackButtonsFromSubmenus();
            }
        }
        
        this.checkMenuEdges();
    }

    /**
     * Close mobile menu
     */
    closeMobileMenu() {
        document.body.classList.remove('menu-open');
        document.querySelector('.menu-overlay')?.classList.remove('active');
        
        // Reset any open submenus
        document.querySelectorAll('.sub-menu').forEach(submenu => {
            submenu.classList.remove('active');
        });
        document.querySelectorAll('.submenu-toggle').forEach(toggle => {
            toggle.classList.remove('active');
            toggle.setAttribute('aria-expanded', 'false');
        });
        document.querySelector('.main-navigation')?.classList.remove('submenu-active');
        
        // Reset mobile menu toggle
        const toggle = document.querySelector('#primary-menu-toggle');
        if (toggle) {
            toggle.setAttribute('aria-expanded', 'false');
        }
    }

    /**
     * Open mobile menu
     */
    openMobileMenu() {
        document.body.classList.add('menu-open');
        document.querySelector('.menu-overlay')?.classList.add('active');
        
        // Set mobile menu toggle
        const toggle = document.querySelector('#primary-menu-toggle');
        if (toggle) {
            toggle.setAttribute('aria-expanded', 'true');
        }
    }

    /**
     * Handle mobile menu toggle click
     */
    handleMobileToggle(e) {
        e.preventDefault();
        if (document.body.classList.contains('menu-open')) {
            this.closeMobileMenu();
        } else {
            this.openMobileMenu();
        }
    }

    /**
     * Handle escape key press
     */
    handleEscapeKey(e) {
        if (e.key === 'Escape' && document.body.classList.contains('menu-open')) {
            this.closeMobileMenu();
        }
    }

    /**
     * Add toggle buttons to menu items with children
     */
    addSubmenuToggles() {
        document.querySelectorAll('.menu-item-has-children').forEach(menuItem => {
            // Only add if it doesn't already exist
            if (!menuItem.querySelector('.submenu-toggle')) {
                const toggleButton = document.createElement('button');
                toggleButton.className = 'submenu-toggle';
                toggleButton.setAttribute('aria-expanded', 'false');
                toggleButton.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                        <polyline points="7 12.86 25 37.14 43 12.86" fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="8" />
                    </svg>
                    <span class="screen-reader-text">Toggle submenu</span>
                `;
                menuItem.appendChild(toggleButton);
            }
        });
    }

    /**
     * Toggle submenu visibility
     */
    toggleSubmenu(menuItem) {
        const subMenu = menuItem.querySelector('.sub-menu');
        const toggle = menuItem.querySelector('.submenu-toggle');
        const mainNav = document.querySelector('.nav-links .main-navigation');
        const parentSubMenu = menuItem.closest('.sub-menu');
        
        if (window.innerWidth <= this.mobileBreakpoint) {
            // Mobile behavior - slide menu
            if (!subMenu.classList.contains('active')) {
                // Close any active submenus at the same level
                if (parentSubMenu) {
                    parentSubMenu.querySelectorAll(':scope > li > .sub-menu').forEach(s => {
                        if (s !== subMenu) s.classList.remove('active');
                    });
                    parentSubMenu.querySelectorAll(':scope > li > .submenu-toggle').forEach(t => {
                        if (t !== toggle) {
                            t.classList.remove('active');
                            t.setAttribute('aria-expanded', 'false');
                        }
                    });
                } else {
                    document.querySelectorAll('.main-navigation > ul > li > .sub-menu').forEach(s => {
                        if (s !== subMenu) s.classList.remove('active');
                    });
                    document.querySelectorAll('.main-navigation > ul > li > .submenu-toggle').forEach(t => {
                        if (t !== toggle) {
                            t.classList.remove('active');
                            t.setAttribute('aria-expanded', 'false');
                        }
                    });
                }
                
                // Open this submenu
                subMenu.classList.add('active');
                toggle.classList.add('active');
                toggle.setAttribute('aria-expanded', 'true');
                
                // Handle nested menus
                if (parentSubMenu) {
                    parentSubMenu.classList.add('submenu-active');
                } else if (mainNav) {
                    mainNav.classList.add('submenu-active');
                }
            } else {
                // Close this submenu and its children
                subMenu.classList.remove('active');
                toggle.classList.remove('active');
                toggle.setAttribute('aria-expanded', 'false');
                subMenu.querySelectorAll('.sub-menu').forEach(s => s.classList.remove('active'));
                subMenu.querySelectorAll('.submenu-toggle').forEach(t => {
                    t.classList.remove('active');
                    t.setAttribute('aria-expanded', 'false');
                });
                
                if (parentSubMenu) {
                    parentSubMenu.classList.remove('submenu-active');
                } else if (mainNav) {
                    mainNav.classList.remove('submenu-active');
                }
            }
        } else {
            // Desktop behavior
            const siblings = menuItem.parentNode.children;
            Array.from(siblings).forEach(sibling => {
                if (sibling !== menuItem) {
                    const siblingSubMenu = sibling.querySelector('.sub-menu');
                    const siblingToggle = sibling.querySelector('.submenu-toggle');
                    if (siblingSubMenu) siblingSubMenu.classList.remove('active');
                    if (siblingToggle) {
                        siblingToggle.classList.remove('active');
                        siblingToggle.setAttribute('aria-expanded', 'false');
                    }
                }
            });
            
            subMenu.classList.toggle('active');
            toggle.classList.toggle('active');
            toggle.setAttribute('aria-expanded', subMenu.classList.contains('active') ? 'true' : 'false');
        }
    }

    /**
     * Handle menu item clicks (mobile)
     */
    handleMenuItemClick(e) {
        const menuLink = e.target.closest('.menu-item-has-children > a');
        if (menuLink && window.innerWidth <= this.mobileBreakpoint) {
            e.preventDefault();
            this.toggleSubmenu(menuLink.parentNode);
        }
    }

    /**
     * Handle submenu toggle button clicks
     */
    handleSubmenuToggle(e) {
        const toggleButton = e.target.closest('.submenu-toggle');
        if (toggleButton) {
            e.preventDefault();
            e.stopPropagation();
            this.toggleSubmenu(toggleButton.parentNode);
        }
    }

    /**
     * Handle clicks outside menu (desktop)
     */
    handleOutsideClick(e) {
        if (!e.target.closest('.main-navigation') && window.innerWidth > this.mobileBreakpoint) {
            document.querySelectorAll('.sub-menu').forEach(submenu => {
                submenu.classList.remove('active');
            });
            document.querySelectorAll('.submenu-toggle').forEach(toggle => {
                toggle.classList.remove('active');
                toggle.setAttribute('aria-expanded', 'false');
            });
        }
    }

    /**
     * Handle back button clicks
     */
    handleBackButton(e) {
        const backButton = e.target.closest('.back-button');
        if (backButton) {
            e.preventDefault();
            e.stopPropagation();
            
            const subMenu = backButton.closest('.sub-menu');
            const menuItem = subMenu.parentNode;
            const mainNav = document.querySelector('.nav-links .main-navigation');
            const parentSubMenu = menuItem.closest('.sub-menu');
            
            // Close current submenu
            subMenu.classList.remove('active');
            const toggle = menuItem.querySelector('.submenu-toggle');
            if (toggle) {
                toggle.classList.remove('active');
                toggle.setAttribute('aria-expanded', 'false');
            }
            
            // If this is a nested submenu, keep parent submenu active
            if (parentSubMenu) {
                parentSubMenu.classList.remove('submenu-active');
            } else if (mainNav) {
                mainNav.classList.remove('submenu-active');
            }
        }
    }

    /**
     * Handle keyboard navigation
     */
    handleKeyboardNavigation(e) {
        const menuLink = e.target.closest('.main-navigation li a');
        if (menuLink && (e.key === 'Enter' || e.key === ' ')) {
            const menuItem = menuLink.parentNode;
            if (menuItem.classList.contains('menu-item-has-children')) {
                e.preventDefault();
                this.toggleSubmenu(menuItem);
            }
        }
    }

    /**
     * Check menu edges for third level menus
     */
    checkMenuEdges() {
        if (window.innerWidth >= this.mobileBreakpoint) { // Only on desktop
            document.querySelectorAll('.main-navigation .sub-menu .menu-item-has-children').forEach(menuItem => {
                const subMenu = menuItem.querySelector('.sub-menu');
                if (subMenu) {
                    const rect = subMenu.getBoundingClientRect();
                    const menuRight = rect.left + rect.width;
                    
                    // If submenu would go off screen, add edge class
                    if (menuRight > window.innerWidth) {
                        menuItem.classList.add('edge');
                    } else {
                        menuItem.classList.remove('edge');
                    }
                }
            });
        }
    }
}

// Export a default instance
export default new OffCanvasMenu(); 