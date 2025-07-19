<?php
/**
 * Theme header template.
 *
 * @package Sigil
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <!-- Early theme detection to prevent FOUC -->
    <script>
        (function() {
            // Use same logic as ThemeToggle class
            const getStoredTheme = () => {
                try {
                    		return localStorage.getItem('sigil-theme');
                } catch (e) {
                    return null;
                }
            };
            
            const getSystemTheme = () => {
                if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    return 'dark';
                }
                return 'light';
            };
            
            // Priority: stored theme > system preference > light fallback
            const theme = getStoredTheme() || getSystemTheme() || 'light';
            document.documentElement.className = theme;
        })();
    </script>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'sigil'); ?></a>

    <header id="masthead" class="site-header" role="banner">
        <div class="container">
            <div class="header-content">
                <div class="site-branding">
                    <div class="site-title-area">
                        <?php if (is_front_page() && is_home()) : ?>
                            <div class="site-title">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                    <?php bloginfo('name'); ?>
                                </a>
                            </div>
                        <?php else : ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title" rel="home">
                                <?php bloginfo('name'); ?>
                            </a>
                        <?php endif; ?>
                        
                        <?php
                        $description = get_bloginfo('description', 'display');
                        if ($description || is_customize_preview()) :
                        ?>
                            <span class="separator" aria-hidden="true">|</span>
                            <p class="site-description"><?php echo $description; ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="nav-container">
                    <?php if (has_nav_menu('menu-1')) : ?>
                        		<?php sigil_main_nav(); ?>
                        
                        <button id="theme-toggle" type="button" class="order-1 p-2 mr-2 w-9 h-9 text-sm rounded-lg text-zinc-500 md:dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-700 focus:outline-none focus:ring-2 focus:ring-zinc-200 dark:focus:ring-zinc-700 md:ml-4 xs:hidden md:order-2 md:mr-2.5" aria-label="<?php esc_attr_e('Toggle between light and dark theme', 'sigil'); ?>" aria-pressed="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32" fill="currentColor" class="icon-theme-toggle" aria-hidden="true">
                                <clipPath id="theme-toggle-cutout">
                                    <path d="M0-11h25a1 1 0 0017 13v30H0Z"></path>
                                </clipPath>
                                <g clip-path="url(#theme-toggle-cutout)">
                                    <circle cx="16" cy="16" r="8.4"></circle>
                                    <path d="M18.3 3.2c0 1.3-1 2.3-2.3 2.3s-2.3-1-2.3-2.3S14.7.9 16 .9s2.3 1 2.3 2.3zm-4.6 25.6c0-1.3 1-2.3 2.3-2.3s2.3 1 2.3 2.3-1 2.3-2.3 2.3-2.3-1-2.3-2.3zm15.1-10.5c-1.3 0-2.3-1-2.3-2.3s1-2.3 2.3-2.3 2.3 1 2.3 2.3-1 2.3-2.3 2.3zM3.2 13.7c1.3 0 2.3 1 2.3 2.3s-1 2.3-2.3 2.3S.9 17.3.9 16s1-2.3 2.3-2.3zm5.8-7C9 7.9 7.9 9 6.7 9S4.4 8 4.4 6.7s1-2.3 2.3-2.3S9 5.4 9 6.7zm16.3 21c-1.3 0-2.3-1-2.3-2.3s1-2.3 2.3-2.3 2.3 1 2.3 2.3-1 2.3-2.3 2.3zm2.4-21c0 1.3-1 2.3-2.3 2.3S23 7.9 23 6.7s1-2.3 2.3-2.3 2.4 1 2.4 2.3zM6.7 23C8 23 9 24 9 25.3s-1 2.3-2.3 2.3-2.3-1-2.3-2.3 1-2.3 2.3-2.3z"></path>
                                </g>
                            </svg>
                        </button>
                        
                        <button type="button" aria-label="<?php esc_attr_e('Toggle navigation menu', 'sigil'); ?>" aria-expanded="false" aria-controls="primary-menu" id="primary-menu-toggle">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                    <?php endif; ?>
                </div>
            </div><!-- .header-content -->
        </div><!-- .container -->
    </header><!-- #masthead -->

    <main id="primary" class="site-main" role="main">
