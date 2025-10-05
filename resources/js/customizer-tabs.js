/**
 * Customizer Tabs Interface
 * 
 * Creates a tabbed interface for the WordPress Customizer
 */

(function($) {
    'use strict';

    // Wait for customizer to be ready
    wp.customize.bind('ready', function() {
        
        // Create tabbed interface
        function createCustomizerTabs() {
            var $customizer = $('#customize-theme-controls');
            var $sections = $customizer.find('.control-section');
            
            // Create tabs container
            var $tabsContainer = $('<div class="sigil-customizer-tabs"></div>');
            var $tabsNav = $('<ul class="sigil-tabs-nav"></ul>');
            var $tabsContent = $('<div class="sigil-tabs-content"></div>');
            
            // Define tabs
            var tabs = [
                {
                    id: 'header',
                    title: 'Header',
                    sections: ['sigil_header']
                },
                {
                    id: 'colors', 
                    title: 'Colors',
                    sections: ['sigil_colors']
                },
                {
                    id: 'footer',
                    title: 'Footer', 
                    sections: ['sigil_footer']
                }
            ];
            
            // Create tab navigation
            tabs.forEach(function(tab, index) {
                var $tabNav = $('<li class="sigil-tab-nav-item">')
                    .append($('<a href="#' + tab.id + '" class="sigil-tab-link">').text(tab.title))
                    .data('tab', tab.id);
                
                if (index === 0) {
                    $tabNav.addClass('active');
                }
                
                $tabsNav.append($tabNav);
            });
            
            // Create tab content areas
            tabs.forEach(function(tab, index) {
                var $tabContent = $('<div class="sigil-tab-content" id="' + tab.id + '">');
                
                // Move relevant sections into this tab
                tab.sections.forEach(function(sectionId) {
                    var $section = $sections.filter('[id*="' + sectionId + '"]');
                    if ($section.length) {
                        $tabContent.append($section);
                    }
                });
                
                if (index === 0) {
                    $tabContent.addClass('active');
                }
                
                $tabsContent.append($tabContent);
            });
            
            // Assemble tabs container
            $tabsContainer.append($tabsNav).append($tabsContent);
            
            // Insert tabs before the first section
            $customizer.prepend($tabsContainer);
            
            // Hide original sections
            $sections.hide();
        }
        
        // Tab switching functionality
        function initTabSwitching() {
            $(document).on('click', '.sigil-tab-link', function(e) {
                e.preventDefault();
                
                var targetTab = $(this).attr('href').substring(1);
                
                // Update nav
                $('.sigil-tab-nav-item').removeClass('active');
                $(this).parent().addClass('active');
                
                // Update content
                $('.sigil-tab-content').removeClass('active');
                $('#' + targetTab).addClass('active');
            });
        }
        
        // Initialize
        createCustomizerTabs();
        initTabSwitching();
        
    });

})(jQuery);
