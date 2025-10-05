<?php
/**
 * Theme footer template.
 *
 * @package Sigil
 */
?>
    </main>
        <?php do_action('sigil_content_end'); ?>
    </div>

    <?php do_action('sigil_content_after'); ?>

    <footer id="colophon" class="site-footer" role="contentinfo">
        <div class="footer-container">
            <?php do_action('sigil_footer'); ?>
            <div class="footer-content">
                <div class="footer-grid">
                    <div class="footer-brand">
                        <?php 
                        $footer_logo = get_theme_mod('sigil_footer_logo');
                        $footer_logo_dark = get_theme_mod('sigil_footer_logo_dark');
                        if ($footer_logo): ?>
                            <img src="<?php echo esc_url($footer_logo); ?>" alt="<?php bloginfo('name'); ?>" class="footer-logo footer-logo-light">
                        <?php endif; ?>
                        
                        <?php if ($footer_logo_dark): ?>
                            <img src="<?php echo esc_url($footer_logo_dark); ?>" alt="<?php bloginfo('name'); ?>" class="footer-logo footer-logo-dark">
                        <?php elseif ($footer_logo): ?>
                            <img src="<?php echo esc_url($footer_logo); ?>" alt="<?php bloginfo('name'); ?>" class="footer-logo footer-logo-dark">
                        <?php endif; ?>
                        
                        <?php if (!$footer_logo && !$footer_logo_dark): ?>
                            <div class="footer-site-title">
                                <h3><?php bloginfo('name'); ?></h3>
                            </div>
                        <?php endif; ?>
                        
                        <p class="footer-description">
                            <?php echo esc_html(get_theme_mod('sigil_footer_description', 'Making the world a better place through constructing elegant hierarchies.')); ?>
                        </p>
                        
                        <div class="footer-social">
                            <?php
                            $social_links = [
                                'facebook' => ['icon' => 'facebook', 'label' => 'Facebook'],
                                'instagram' => ['icon' => 'instagram', 'label' => 'Instagram'],
                                'twitter' => ['icon' => 'twitter', 'label' => 'X'],
                                'github' => ['icon' => 'github', 'label' => 'GitHub'],
                                'youtube' => ['icon' => 'youtube', 'label' => 'YouTube'],
                            ];
                            
                            foreach ($social_links as $platform => $data) {
                                $url = get_theme_mod('sigil_footer_' . $platform);
                                if ($url): ?>
                                    <a href="<?php echo esc_url($url); ?>" class="footer-social-link" aria-label="<?php echo esc_attr($data['label']); ?>" target="_blank" rel="noopener nofollow">
                                        <span class="sr-only"><?php echo esc_html($data['label']); ?></span>
                                        <?php echo sigil_get_social_icon($data['icon']); ?>
                                    </a>
                                <?php endif;
                            }
                            ?>
                        </div>
                    </div>
                    
                    <div class="footer-menus">
                        <div class="footer-menu-columns">
                            <div class="footer-menu-column">
                                <?php if (has_nav_menu('footer-solutions')): ?>
                                    <div class="footer-menu-section">
                                        <h3 class="footer-menu-title"><?php _e('Solutions', 'sigil'); ?></h3>
                                        <?php echo sigil_get_footer_menu('footer-solutions'); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if (has_nav_menu('footer-support')): ?>
                                    <div class="footer-menu-section">
                                        <h3 class="footer-menu-title"><?php _e('Support', 'sigil'); ?></h3>
                                        <?php echo sigil_get_footer_menu('footer-support'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="footer-menu-column">
                                <?php if (has_nav_menu('footer-company')): ?>
                                    <div class="footer-menu-section">
                                        <h3 class="footer-menu-title"><?php _e('Company', 'sigil'); ?></h3>
                                        <?php echo sigil_get_footer_menu('footer-company'); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if (has_nav_menu('footer-legal')): ?>
                                    <div class="footer-menu-section">
                                        <h3 class="footer-menu-title"><?php _e('Legal', 'sigil'); ?></h3>
                                        <?php echo sigil_get_footer_menu('footer-legal'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="footer-bottom">
                    <p class="footer-copyright">
                        <?php echo esc_html(get_theme_mod('sigil_footer_copyright', '© ' . date('Y') . ' ' . get_bloginfo('name') . ', Inc. All rights reserved.')); ?>
                    </p>
                </div>
            </div>
        </div>
    </footer>
</div>

<?php wp_footer(); ?>
</body>

</html>
