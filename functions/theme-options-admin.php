<?php
/**
 * Theme Options Admin Pages
 * 
 * Creates dedicated admin pages for theme options under Appearance menu.
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add theme options pages to Appearance menu
 */
function sigil_add_theme_options_pages() {
    // Main Theme Options page
    add_theme_page(
        __('Sigil Theme Options', 'sigil'),
        __('Sigil Options', 'sigil'),
        'manage_options',
        'sigil-theme-options',
        'sigil_theme_options_page'
    );
    
    // Colors page
    add_theme_page(
        __('Colors', 'sigil'),
        __('Colors', 'sigil'),
        'manage_options',
        'sigil-colors',
        'sigil_colors_page'
    );
    
    // Header page
    add_theme_page(
        __('Header', 'sigil'),
        __('Header', 'sigil'),
        'manage_options',
        'sigil-header',
        'sigil_header_page'
    );
    
    // Footer page
    add_theme_page(
        __('Footer', 'sigil'),
        __('Footer', 'sigil'),
        'manage_options',
        'sigil-footer',
        'sigil_footer_page'
    );
}
add_action('admin_menu', 'sigil_add_theme_options_pages');

/**
 * Main Theme Options page
 */
function sigil_theme_options_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('Sigil Theme Options', 'sigil'); ?></h1>
        
        <div class="sigil-options-grid">
            <div class="sigil-option-card">
                <h2><?php _e('Colors', 'sigil'); ?></h2>
                <p><?php _e('Customize your theme colors including background, text, and accent colors for both light and dark modes.', 'sigil'); ?></p>
                <a href="<?php echo admin_url('themes.php?page=sigil-colors'); ?>" class="button button-primary">
                    <?php _e('Manage Colors', 'sigil'); ?>
                </a>
            </div>
            
            <div class="sigil-option-card">
                <h2><?php _e('Header', 'sigil'); ?></h2>
                <p><?php _e('Configure your header layout, logo, and styling options. Choose from multiple header styles.', 'sigil'); ?></p>
                <a href="<?php echo admin_url('themes.php?page=sigil-header'); ?>" class="button button-primary">
                    <?php _e('Manage Header', 'sigil'); ?>
                </a>
            </div>
            
            <div class="sigil-option-card">
                <h2><?php _e('Footer', 'sigil'); ?></h2>
                <p><?php _e('Set up your footer content, social media links, and choose from different footer layouts.', 'sigil'); ?></p>
                <a href="<?php echo admin_url('themes.php?page=sigil-footer'); ?>" class="button button-primary">
                    <?php _e('Manage Footer', 'sigil'); ?>
                </a>
            </div>
            
            <div class="sigil-option-card">
                <h2><?php _e('Customizer', 'sigil'); ?></h2>
                <p><?php _e('Use the WordPress Customizer for live preview of your changes with the tabbed interface.', 'sigil'); ?></p>
                <a href="<?php echo admin_url('customize.php'); ?>" class="button button-secondary">
                    <?php _e('Open Customizer', 'sigil'); ?>
                </a>
            </div>
        </div>
        
        <div class="sigil-options-info">
            <h3><?php _e('Quick Links', 'sigil'); ?></h3>
            <p>
                <a href="<?php echo admin_url('themes.php?page=sigil-colors'); ?>"><?php _e('Colors', 'sigil'); ?></a> |
                <a href="<?php echo admin_url('themes.php?page=sigil-header'); ?>"><?php _e('Header', 'sigil'); ?></a> |
                <a href="<?php echo admin_url('themes.php?page=sigil-footer'); ?>"><?php _e('Footer', 'sigil'); ?></a> |
                <a href="<?php echo admin_url('customize.php'); ?>"><?php _e('Customizer', 'sigil'); ?></a>
            </p>
        </div>
    </div>
    
    <style>
    .sigil-options-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin: 20px 0;
    }
    
    .sigil-option-card {
        background: #fff;
        border: 1px solid #ccd0d4;
        border-radius: 4px;
        padding: 20px;
        box-shadow: 0 1px 1px rgba(0,0,0,.04);
    }
    
    .sigil-option-card h2 {
        margin-top: 0;
        color: #1d2327;
    }
    
    .sigil-option-card p {
        color: #646970;
        margin-bottom: 15px;
    }
    
    .sigil-options-info {
        background: #f0f0f1;
        border-left: 4px solid #2271b1;
        padding: 15px;
        margin: 20px 0;
    }
    
    .sigil-options-info h3 {
        margin-top: 0;
    }
    
    .sigil-options-info a {
        text-decoration: none;
        color: #2271b1;
    }
    
    .sigil-options-info a:hover {
        text-decoration: underline;
    }
    </style>
    <?php
}

/**
 * Colors page
 */
function sigil_colors_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('Colors', 'sigil'); ?></h1>
        
        <div class="sigil-page-header">
            <p><?php _e('Customize your theme colors including background, text, and accent colors for both light and dark modes.', 'sigil'); ?></p>
            <a href="<?php echo admin_url('customize.php?autofocus[section]=sigil_colors'); ?>" class="button button-primary">
                <?php _e('Open in Customizer', 'sigil'); ?>
            </a>
        </div>
        
        <div class="sigil-colors-grid">
            <div class="sigil-color-section">
                <h2><?php _e('Primary Colors', 'sigil'); ?></h2>
                <?php sigil_render_color_options('primary'); ?>
            </div>
            
            <div class="sigil-color-section">
                <h2><?php _e('Background Colors', 'sigil'); ?></h2>
                <?php sigil_render_color_options('light_bg'); ?>
                <?php sigil_render_color_options('dark_bg'); ?>
            </div>
            
            <div class="sigil-color-section">
                <h2><?php _e('Text Colors', 'sigil'); ?></h2>
                <?php sigil_render_color_options('light_text'); ?>
                <?php sigil_render_color_options('dark_text'); ?>
            </div>
        </div>
        
        <div class="sigil-page-footer">
            <a href="<?php echo admin_url('themes.php?page=sigil-theme-options'); ?>" class="button">
                <?php _e('← Back to Theme Options', 'sigil'); ?>
            </a>
        </div>
    </div>
    
    <style>
    .sigil-page-header {
        background: #f0f0f1;
        border-left: 4px solid #2271b1;
        padding: 15px;
        margin: 20px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .sigil-colors-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin: 20px 0;
    }
    
    .sigil-color-section {
        background: #fff;
        border: 1px solid #ccd0d4;
        border-radius: 4px;
        padding: 20px;
        box-shadow: 0 1px 1px rgba(0,0,0,.04);
    }
    
    .sigil-color-section h2 {
        margin-top: 0;
        color: #1d2327;
    }
    
    .sigil-page-footer {
        margin: 20px 0;
        padding-top: 20px;
        border-top: 1px solid #ccd0d4;
    }
    </style>
    <?php
}

/**
 * Header page
 */
function sigil_header_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('Header', 'sigil'); ?></h1>
        
        <div class="sigil-page-header">
            <p><?php _e('Configure your header layout, logo, and styling options. Choose from multiple header styles.', 'sigil'); ?></p>
            <a href="<?php echo admin_url('customize.php?autofocus[section]=sigil_header'); ?>" class="button button-primary">
                <?php _e('Open in Customizer', 'sigil'); ?>
            </a>
        </div>
        
        <div class="sigil-header-options">
            <div class="sigil-option-group">
                <h2><?php _e('Header Style', 'sigil'); ?></h2>
                <?php sigil_render_header_options(); ?>
            </div>
            
            <div class="sigil-option-group">
                <h2><?php _e('Logo Settings', 'sigil'); ?></h2>
                <?php sigil_render_logo_options(); ?>
            </div>
        </div>
        
        <div class="sigil-page-footer">
            <a href="<?php echo admin_url('themes.php?page=sigil-theme-options'); ?>" class="button">
                <?php _e('← Back to Theme Options', 'sigil'); ?>
            </a>
        </div>
    </div>
    
    <style>
    .sigil-header-options {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin: 20px 0;
    }
    
    .sigil-option-group {
        background: #fff;
        border: 1px solid #ccd0d4;
        border-radius: 4px;
        padding: 20px;
        box-shadow: 0 1px 1px rgba(0,0,0,.04);
    }
    
    .sigil-option-group h2 {
        margin-top: 0;
        color: #1d2327;
    }
    </style>
    <?php
}

/**
 * Footer page
 */
function sigil_footer_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('Footer', 'sigil'); ?></h1>
        
        <div class="sigil-page-header">
            <p><?php _e('Set up your footer content, social media links, and choose from different footer layouts.', 'sigil'); ?></p>
            <a href="<?php echo admin_url('customize.php?autofocus[section]=sigil_footer'); ?>" class="button button-primary">
                <?php _e('Open in Customizer', 'sigil'); ?>
            </a>
        </div>
        
        <div class="sigil-footer-options">
            <div class="sigil-option-group">
                <h2><?php _e('Footer Style', 'sigil'); ?></h2>
                <?php sigil_render_footer_options(); ?>
            </div>
            
            <div class="sigil-option-group">
                <h2><?php _e('Social Media Links', 'sigil'); ?></h2>
                <?php sigil_render_social_options(); ?>
            </div>
        </div>
        
        <div class="sigil-page-footer">
            <a href="<?php echo admin_url('themes.php?page=sigil-theme-options'); ?>" class="button">
                <?php _e('← Back to Theme Options', 'sigil'); ?>
            </a>
        </div>
    </div>
    
    <style>
    .sigil-footer-options {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin: 20px 0;
    }
    
    .sigil-option-group {
        background: #fff;
        border: 1px solid #ccd0d4;
        border-radius: 4px;
        padding: 20px;
        box-shadow: 0 1px 1px rgba(0,0,0,.04);
    }
    
    .sigil-option-group h2 {
        margin-top: 0;
        color: #1d2327;
    }
    </style>
    <?php
}

/**
 * Render color options for admin pages
 */
function sigil_render_color_options($color_type) {
    $current_value = get_theme_mod("sigil_{$color_type}_color_mode", 'preset');
    $color_name = get_theme_mod("sigil_{$color_type}_color_name", 'blue');
    $color_shade = get_theme_mod("sigil_{$color_type}_color_shade", '450');
    $custom_color = get_theme_mod("sigil_{$color_type}_custom_color", '#5c7ef8');
    
    ?>
    <div class="sigil-color-option">
        <h3><?php echo ucfirst(str_replace('_', ' ', $color_type)); ?> Color</h3>
        
        <div class="sigil-color-mode">
            <label>
                <input type="radio" name="sigil_{$color_type}_color_mode" value="preset" <?php checked($current_value, 'preset'); ?>>
                <?php _e('Use Preset Color', 'sigil'); ?>
            </label>
            <label>
                <input type="radio" name="sigil_{$color_type}_color_mode" value="custom" <?php checked($current_value, 'custom'); ?>>
                <?php _e('Use Custom Color', 'sigil'); ?>
            </label>
        </div>
        
        <div class="sigil-color-preset" style="<?php echo $current_value === 'custom' ? 'display: none;' : ''; ?>">
            <label for="sigil_{$color_type}_color_name"><?php _e('Color Name:', 'sigil'); ?></label>
            <select name="sigil_{$color_type}_color_name" id="sigil_{$color_type}_color_name">
                <?php
                $color_choices = sigil_get_color_name_choices();
                foreach ($color_choices as $value => $label) {
                    echo '<option value="' . esc_attr($value) . '"' . selected($color_name, $value, false) . '>' . esc_html($label) . '</option>';
                }
                ?>
            </select>
            
            <label for="sigil_{$color_type}_color_shade"><?php _e('Shade:', 'sigil'); ?></label>
            <select name="sigil_{$color_type}_color_shade" id="sigil_{$color_type}_color_shade">
                <?php
                $shade_choices = sigil_get_color_shade_choices();
                foreach ($shade_choices as $value => $label) {
                    echo '<option value="' . esc_attr($value) . '"' . selected($color_shade, $value, false) . '>' . esc_html($label) . '</option>';
                }
                ?>
            </select>
        </div>
        
        <div class="sigil-color-custom" style="<?php echo $current_value === 'preset' ? 'display: none;' : ''; ?>">
            <label for="sigil_{$color_type}_custom_color"><?php _e('Custom Color:', 'sigil'); ?></label>
            <input type="color" name="sigil_{$color_type}_custom_color" id="sigil_{$color_type}_custom_color" value="<?php echo esc_attr($custom_color); ?>">
        </div>
        
        <p class="description">
            <a href="<?php echo admin_url('customize.php?autofocus[section]=sigil_colors]'); ?>">
                <?php _e('Open in Customizer for live preview', 'sigil'); ?>
            </a>
        </p>
    </div>
    <?php
}

/**
 * Render header options for admin pages
 */
function sigil_render_header_options() {
    $header_style = get_theme_mod('sigil_header_style', 'default');
    $header_height = get_theme_mod('sigil_header_height', '4rem');
    $sticky_header = get_theme_mod('sigil_sticky_header', false);
    
    ?>
    <div class="sigil-header-option">
        <label for="sigil_header_style"><?php _e('Header Style:', 'sigil'); ?></label>
        <select name="sigil_header_style" id="sigil_header_style">
            <option value="default" <?php selected($header_style, 'default'); ?>><?php _e('Default Header', 'sigil'); ?></option>
            <option value="centered" <?php selected($header_style, 'centered'); ?>><?php _e('Centered Header', 'sigil'); ?></option>
            <option value="minimal" <?php selected($header_style, 'minimal'); ?>><?php _e('Minimal Header', 'sigil'); ?></option>
        </select>
    </div>
    
    <div class="sigil-header-option">
        <label for="sigil_header_height"><?php _e('Header Height:', 'sigil'); ?></label>
        <input type="text" name="sigil_header_height" id="sigil_header_height" value="<?php echo esc_attr($header_height); ?>" placeholder="4rem">
    </div>
    
    <div class="sigil-header-option">
        <label>
            <input type="checkbox" name="sigil_sticky_header" <?php checked($sticky_header); ?>>
            <?php _e('Sticky Header', 'sigil'); ?>
        </label>
    </div>
    
    <p class="description">
        <a href="<?php echo admin_url('customize.php?autofocus[section]=sigil_header'); ?>">
            <?php _e('Open in Customizer for live preview', 'sigil'); ?>
        </a>
    </p>
    <?php
}

/**
 * Render logo options for admin pages
 */
function sigil_render_logo_options() {
    $header_logo = get_theme_mod('sigil_header_logo', '');
    $header_logo_dark = get_theme_mod('sigil_header_logo_dark', '');
    
    ?>
    <div class="sigil-logo-option">
        <label for="sigil_header_logo"><?php _e('Header Logo:', 'sigil'); ?></label>
        <input type="url" name="sigil_header_logo" id="sigil_header_logo" value="<?php echo esc_attr($header_logo); ?>" placeholder="https://example.com/logo.png">
        <?php if ($header_logo): ?>
            <div class="sigil-logo-preview">
                <img src="<?php echo esc_url($header_logo); ?>" alt="Logo Preview" style="max-height: 50px;">
            </div>
        <?php endif; ?>
    </div>
    
    <div class="sigil-logo-option">
        <label for="sigil_header_logo_dark"><?php _e('Header Logo (Dark Mode):', 'sigil'); ?></label>
        <input type="url" name="sigil_header_logo_dark" id="sigil_header_logo_dark" value="<?php echo esc_attr($header_logo_dark); ?>" placeholder="https://example.com/logo-dark.png">
        <?php if ($header_logo_dark): ?>
            <div class="sigil-logo-preview">
                <img src="<?php echo esc_url($header_logo_dark); ?>" alt="Dark Logo Preview" style="max-height: 50px;">
            </div>
        <?php endif; ?>
    </div>
    
    <p class="description">
        <a href="<?php echo admin_url('customize.php?autofocus[section]=sigil_header'); ?>">
            <?php _e('Open in Customizer for live preview', 'sigil'); ?>
        </a>
    </p>
    <?php
}

/**
 * Render footer options for admin pages
 */
function sigil_render_footer_options() {
    $footer_style = get_theme_mod('sigil_footer_style', 'default');
    $footer_description = get_theme_mod('sigil_footer_description', 'Making the world a better place through constructing elegant hierarchies.');
    $footer_copyright = get_theme_mod('sigil_footer_copyright', '© ' . date('Y') . ' ' . get_bloginfo('name') . ', Inc. All rights reserved.');
    
    ?>
    <div class="sigil-footer-option">
        <label for="sigil_footer_style"><?php _e('Footer Style:', 'sigil'); ?></label>
        <select name="sigil_footer_style" id="sigil_footer_style">
            <option value="default" <?php selected($footer_style, 'default'); ?>><?php _e('Default Footer', 'sigil'); ?></option>
            <option value="minimal" <?php selected($footer_style, 'minimal'); ?>><?php _e('Minimal Footer', 'sigil'); ?></option>
            <option value="extended" <?php selected($footer_style, 'extended'); ?>><?php _e('Extended Footer', 'sigil'); ?></option>
        </select>
    </div>
    
    <div class="sigil-footer-option">
        <label for="sigil_footer_description"><?php _e('Footer Description:', 'sigil'); ?></label>
        <textarea name="sigil_footer_description" id="sigil_footer_description" rows="3"><?php echo esc_textarea($footer_description); ?></textarea>
    </div>
    
    <div class="sigil-footer-option">
        <label for="sigil_footer_copyright"><?php _e('Copyright Text:', 'sigil'); ?></label>
        <input type="text" name="sigil_footer_copyright" id="sigil_footer_copyright" value="<?php echo esc_attr($footer_copyright); ?>">
    </div>
    
    <p class="description">
        <a href="<?php echo admin_url('customize.php?autofocus[section]=sigil_footer'); ?>">
            <?php _e('Open in Customizer for live preview', 'sigil'); ?>
        </a>
    </p>
    <?php
}

/**
 * Render social media options for admin pages
 */
function sigil_render_social_options() {
    $social_platforms = [
        'facebook' => 'Facebook',
        'instagram' => 'Instagram', 
        'twitter' => 'X (Twitter)',
        'github' => 'GitHub',
        'youtube' => 'YouTube',
        'linkedin' => 'LinkedIn',
    ];
    
    foreach ($social_platforms as $platform => $label) {
        $url = get_theme_mod("sigil_footer_{$platform}", '');
        ?>
        <div class="sigil-social-option">
            <label for="sigil_footer_<?php echo $platform; ?>"><?php echo $label; ?>:</label>
            <input type="url" name="sigil_footer_<?php echo $platform; ?>" id="sigil_footer_<?php echo $platform; ?>" value="<?php echo esc_attr($url); ?>" placeholder="https://<?php echo $platform; ?>.com/yourprofile">
        </div>
        <?php
    }
    ?>
    
    <p class="description">
        <a href="<?php echo admin_url('customize.php?autofocus[section]=sigil_footer'); ?>">
            <?php _e('Open in Customizer for live preview', 'sigil'); ?>
        </a>
    </p>
    <?php
}
