/**
 * Customizer Preview
 * 
 * Handles live preview updates in WordPress Customizer
 */

(function($) {
    'use strict';

    // Wait for customizer preview to be ready
    wp.customize.bind('preview-ready', function() {
        
        // Header style changes
        wp.customize('sigil_header_style', function(value) {
            value.bind(function(newval) {
                $('body').removeClass('header-default header-centered header-minimal')
                        .addClass('header-' + newval);
            });
        });
        
        // Footer style changes
        wp.customize('sigil_footer_style', function(value) {
            value.bind(function(newval) {
                $('body').removeClass('footer-default footer-minimal footer-extended')
                        .addClass('footer-' + newval);
            });
        });
        
        // Header height changes
        wp.customize('sigil_header_height', function(value) {
            value.bind(function(newval) {
                $('.site-header').css('height', newval);
            });
        });
        
        // Header background color changes
        wp.customize('sigil_header_bg_color', function(value) {
            value.bind(function(newval) {
                if (newval === 'transparent') {
                    $('.site-header').css('background-color', 'transparent');
                } else {
                    $('.site-header').css('background-color', newval);
                }
            });
        });
        
        // Header text color changes
        wp.customize('sigil_header_text_color', function(value) {
            value.bind(function(newval) {
                if (newval === 'inherit') {
                    $('.site-header').css('color', '');
                } else {
                    $('.site-header').css('color', newval);
                }
            });
        });
        
        // Footer background override
        wp.customize('sigil_footer_bg_override', function(value) {
            value.bind(function(newval) {
                if (newval) {
                    var customColor = wp.customize('sigil_footer_custom_bg_color').get();
                    $('.site-footer').css('background-color', customColor);
                } else {
                    $('.site-footer').css('background-color', '');
                }
            });
        });
        
        // Footer custom background color
        wp.customize('sigil_footer_custom_bg_color', function(value) {
            value.bind(function(newval) {
                if (wp.customize('sigil_footer_bg_override').get()) {
                    $('.site-footer').css('background-color', newval);
                }
            });
        });
        
    });

})(jQuery);
