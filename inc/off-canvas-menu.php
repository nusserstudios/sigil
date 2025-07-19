<?php
/**
 * Template part for off-canvas mobile menu
 */
?>
<div class="nav-links">
    <button type="button" class="nav-close" aria-label="Close menu">
        <svg xmlns="http://www.w3.org/2000/svg" width="31.205" height="31.205" viewBox="0 0 31.205 31.205">
            <path id="x-mark" d="M32.205,28.188,20.6,16.576,32.205,4.981,28.188,1,16.583,12.6,4.986,1,1,4.986,12.611,16.611,1,28.219l3.986,3.986,11.635-11.62,11.6,11.62Z" transform="translate(-1 -1)" fill="#726e6e"/>
        </svg>
    </button>
    <?php
    // The main navigation will be moved here via JavaScript on mobile
    ?>
    
    <button id="mobile-theme-toggle" type="button" class="contrast theme-toggle-mobile" aria-label="Toggle theme">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32" fill="currentColor" class="icon-theme-toggle">
            <clipPath id="mobile-theme-toggle-cutout">
                <path d="M0-11h25a1 1 0 0017 13v30H0Z"></path>
            </clipPath>
            <g clip-path="url(#mobile-theme-toggle-cutout)">
                <circle cx="16" cy="16" r="8.4"></circle>
                <path d="M18.3 3.2c0 1.3-1 2.3-2.3 2.3s-2.3-1-2.3-2.3S14.7.9 16 .9s2.3 1 2.3 2.3zm-4.6 25.6c0-1.3 1-2.3 2.3-2.3s2.3 1 2.3 2.3-1 2.3-2.3 2.3-2.3-1-2.3-2.3zm15.1-10.5c-1.3 0-2.3-1-2.3-2.3s1-2.3 2.3-2.3 2.3 1 2.3 2.3-1 2.3-2.3 2.3zM3.2 13.7c1.3 0 2.3 1 2.3 2.3s-1 2.3-2.3 2.3S.9 17.3.9 16s1-2.3 2.3-2.3zm5.8-7C9 7.9 7.9 9 6.7 9S4.4 8 4.4 6.7s1-2.3 2.3-2.3S9 5.4 9 6.7zm16.3 21c-1.3 0-2.3-1-2.3-2.3s1-2.3 2.3-2.3 2.3 1 2.3 2.3-1 2.3-2.3 2.3zm2.4-21c0 1.3-1 2.3-2.3 2.3S23 7.9 23 6.7s1-2.3 2.3-2.3 2.4 1 2.4 2.3zM6.7 23C8 23 9 24 9 25.3s-1 2.3-2.3 2.3-2.3-1-2.3-2.3 1-2.3 2.3-2.3z"></path>
            </g>
        </svg>
        <span class="toggle-text">Turn off dark mode</span>
    </button>
</div>
<div class="menu-overlay"></div> 