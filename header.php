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
                        
                        <button id="theme-toggle" type="button" class="order-1 p-2 mr-2 w-9 h-9 text-sm rounded-lg text-zinc-500 md:dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-700 focus:outline-none focus:ring-2 focus:ring-zinc-200 dark:focus:ring-zinc-700 md:ml-4 xs:hidden md:order-2 md:mr-2.5" aria-label="Toggle theme">
                            <svg id="theme-toggle-dark-icon" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                            </svg>
                            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-label="Dark or Light Mode" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        
                        <button type="button" aria-label="Toggle navigation" id="primary-menu-toggle">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                    <?php endif; ?>
                </div>
            </div><!-- .header-content -->
        </div><!-- .container -->
    </header><!-- #masthead -->

    <main id="primary" class="site-main" role="main">
