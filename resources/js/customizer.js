/**
 * Theme Customizer Live Preview
 * Handles live updates for color customizations
 */

(function($) {
    'use strict';

    // Pico CSS colors mapping (matching PHP)
    const picoColors = {
        'red-950': '#1c0d06', 'red-900': '#30130a', 'red-850': '#45150c', 'red-800': '#5c160d',
        'red-750': '#72170f', 'red-700': '#861d13', 'red-650': '#9b2318', 'red-600': '#af291d',
        'red-550': '#c52f21', 'red-500': '#d93526', 'red-450': '#ee402e', 'red-400': '#f06048',
        'red-350': '#f17961', 'red-300': '#f38f79', 'red-250': '#f5a390', 'red-200': '#f5b7a8',
        'red-150': '#f6cabf', 'red-100': '#f8dcd6', 'red-50': '#faeeeb',
        
        'pink-950': '#25060c', 'pink-900': '#380916', 'pink-850': '#4b0c1f', 'pink-800': '#5f0e28',
        'pink-750': '#740f31', 'pink-700': '#88143b', 'pink-650': '#9d1945', 'pink-600': '#b21e4f',
        'pink-550': '#c72259', 'pink-500': '#d92662', 'pink-450': '#f42c6f', 'pink-400': '#f6547e',
        'pink-350': '#f7708e', 'pink-300': '#f8889e', 'pink-250': '#f99eae', 'pink-200': '#f9b4be',
        'pink-150': '#f9c8ce', 'pink-100': '#f9dbdf', 'pink-50': '#fbedef',
        
        'fuchsia-950': '#230518', 'fuchsia-900': '#360925', 'fuchsia-850': '#480b33', 'fuchsia-800': '#5c0d41',
        'fuchsia-750': '#700e4f', 'fuchsia-700': '#84135e', 'fuchsia-650': '#98176d', 'fuchsia-600': '#ac1c7c',
        'fuchsia-550': '#c1208b', 'fuchsia-500': '#d9269d', 'fuchsia-450': '#ed2aac', 'fuchsia-400': '#f748b7',
        'fuchsia-350': '#f869bf', 'fuchsia-300': '#f983c7', 'fuchsia-250': '#fa9acf', 'fuchsia-200': '#f9b1d8',
        'fuchsia-150': '#f9c6e1', 'fuchsia-100': '#f9daea', 'fuchsia-50': '#fbedf4',
        
        'purple-950': '#1e0820', 'purple-900': '#2d0f33', 'purple-850': '#3d1545', 'purple-800': '#4d1a57',
        'purple-750': '#5e206b', 'purple-700': '#6f277d', 'purple-650': '#802e90', 'purple-600': '#9236a4',
        'purple-550': '#aa40bf', 'purple-500': '#b645cd', 'purple-450': '#c652dc', 'purple-400': '#cd68e0',
        'purple-350': '#d47de4', 'purple-300': '#db90e8', 'purple-250': '#e2a3eb', 'purple-200': '#e7b6ee',
        'purple-150': '#edc9f1', 'purple-100': '#f2dcf4', 'purple-50': '#f8eef9',
        
        'violet-950': '#190928', 'violet-900': '#251140', 'violet-850': '#321856', 'violet-800': '#3f1e6d',
        'violet-750': '#4d2585', 'violet-700': '#5b2d9c', 'violet-650': '#6935b3', 'violet-600': '#7540bf',
        'violet-550': '#8352c5', 'violet-500': '#9062ca', 'violet-450': '#9b71cf', 'violet-400': '#a780d4',
        'violet-350': '#b290d9', 'violet-300': '#bd9fdf', 'violet-250': '#c9afe4', 'violet-200': '#d3bfe8',
        'violet-150': '#decfed', 'violet-100': '#e8dff2', 'violet-50': '#f3eff7',
        
        'indigo-950': '#110b31', 'indigo-900': '#181546', 'indigo-850': '#1f1e5e', 'indigo-800': '#272678',
        'indigo-750': '#2f2f92', 'indigo-700': '#3838ab', 'indigo-650': '#4040bf', 'indigo-600': '#524ed2',
        'indigo-550': '#655cd6', 'indigo-500': '#7569da', 'indigo-450': '#8577dd', 'indigo-400': '#9486e1',
        'indigo-350': '#a294e5', 'indigo-300': '#b0a3e8', 'indigo-250': '#bdb2ec', 'indigo-200': '#cac1ee',
        'indigo-150': '#d8d0f1', 'indigo-100': '#e5e0f4', 'indigo-50': '#f2f0f9',
        
        'blue-950': '#080f2d', 'blue-900': '#0c1a41', 'blue-850': '#0e2358', 'blue-800': '#0f2d70',
        'blue-750': '#0f3888', 'blue-700': '#1343a0', 'blue-650': '#184eb8', 'blue-600': '#1d59d0',
        'blue-550': '#2060df', 'blue-500': '#3c71f7', 'blue-450': '#5c7ef8', 'blue-400': '#748bf8',
        'blue-350': '#8999f9', 'blue-300': '#9ca7fa', 'blue-250': '#aeb5fb', 'blue-200': '#bfc3fa',
        'blue-150': '#d0d2fa', 'blue-100': '#e0e1fa', 'blue-50': '#f0f0fb',
        
        'azure-950': '#04121d', 'azure-900': '#061e2f', 'azure-850': '#052940', 'azure-800': '#033452',
        'azure-750': '#014063', 'azure-700': '#014c75', 'azure-650': '#015887', 'azure-600': '#02659a',
        'azure-550': '#0172ad', 'azure-500': '#017fc0', 'azure-450': '#018cd4', 'azure-400': '#029ae8',
        'azure-350': '#01aaff', 'azure-300': '#51b4ff', 'azure-250': '#79c0ff', 'azure-200': '#9bccfd',
        'azure-150': '#b7d9fc', 'azure-100': '#d1e5fb', 'azure-50': '#e9f2fc',
        
        'cyan-950': '#041413', 'cyan-900': '#051f1f', 'cyan-850': '#052b2b', 'cyan-800': '#043737',
        'cyan-750': '#014343', 'cyan-700': '#015050', 'cyan-650': '#025d5d', 'cyan-600': '#046a6a',
        'cyan-550': '#047878', 'cyan-500': '#058686', 'cyan-450': '#059494', 'cyan-400': '#05a2a2',
        'cyan-350': '#0ab1b1', 'cyan-300': '#0ac2c2', 'cyan-250': '#0ccece', 'cyan-200': '#25dddd',
        'cyan-150': '#3deceb', 'cyan-100': '#58faf9', 'cyan-50': '#c3fcfa',
        
        'jade-950': '#04140c', 'jade-900': '#052014', 'jade-850': '#042c1b', 'jade-800': '#033823',
        'jade-750': '#00452b', 'jade-700': '#015234', 'jade-650': '#005f3d', 'jade-600': '#006d46',
        'jade-550': '#007a50', 'jade-500': '#00895a', 'jade-450': '#029764', 'jade-400': '#00a66e',
        'jade-350': '#00b478', 'jade-300': '#00c482', 'jade-250': '#00cc88', 'jade-200': '#21e299',
        'jade-150': '#39f1a6', 'jade-100': '#70fcba', 'jade-50': '#cbfce1',
        
        'green-950': '#0b1305', 'green-900': '#131f07', 'green-850': '#152b07', 'green-800': '#173806',
        'green-750': '#1a4405', 'green-700': '#205107', 'green-650': '#265e09', 'green-600': '#2c6c0c',
        'green-550': '#33790f', 'green-500': '#398712', 'green-450': '#409614', 'green-400': '#47a417',
        'green-350': '#4eb31b', 'green-300': '#55c21e', 'green-250': '#5dd121', 'green-200': '#62d926',
        'green-150': '#77ef3d', 'green-100': '#95fb62', 'green-50': '#d7fbc1',
        
        'lime-950': '#101203', 'lime-900': '#191d03', 'lime-850': '#202902', 'lime-800': '#273500',
        'lime-750': '#304100', 'lime-700': '#394d00', 'lime-650': '#435a00', 'lime-600': '#4d6600',
        'lime-550': '#577400', 'lime-500': '#628100', 'lime-450': '#6c8f00', 'lime-400': '#779c00',
        'lime-350': '#82ab00', 'lime-300': '#8eb901', 'lime-250': '#99c801', 'lime-200': '#a5d601',
        'lime-150': '#b2e51a', 'lime-100': '#c1f335', 'lime-50': '#defc85',
        
        'yellow-950': '#141103', 'yellow-900': '#1f1c02', 'yellow-850': '#2b2600', 'yellow-800': '#363100',
        'yellow-750': '#423c00', 'yellow-700': '#4e4700', 'yellow-650': '#5b5300', 'yellow-600': '#685f00',
        'yellow-550': '#756b00', 'yellow-500': '#827800', 'yellow-450': '#908501', 'yellow-400': '#9e9200',
        'yellow-350': '#ad9f00', 'yellow-300': '#bbac00', 'yellow-250': '#caba01', 'yellow-200': '#d9c800',
        'yellow-150': '#e8d600', 'yellow-100': '#f2df0d', 'yellow-50': '#fdf1b4',
        
        'amber-950': '#161003', 'amber-900': '#231a03', 'amber-850': '#312302', 'amber-800': '#3f2d00',
        'amber-750': '#4d3700', 'amber-700': '#5b4200', 'amber-650': '#694d00', 'amber-600': '#785800',
        'amber-550': '#876400', 'amber-500': '#977000', 'amber-450': '#a77c00', 'amber-400': '#b78800',
        'amber-350': '#c79400', 'amber-300': '#d8a100', 'amber-250': '#e8ae01', 'amber-200': '#ffbf00',
        'amber-150': '#fecc63', 'amber-100': '#fddea6', 'amber-50': '#fcefd9',
        
        'pumpkin-950': '#180f04', 'pumpkin-900': '#271805', 'pumpkin-850': '#372004', 'pumpkin-800': '#482802',
        'pumpkin-750': '#593100', 'pumpkin-700': '#693a00', 'pumpkin-650': '#7a4400', 'pumpkin-600': '#8b4f00',
        'pumpkin-550': '#9c5900', 'pumpkin-500': '#ad6400', 'pumpkin-450': '#bf6e00', 'pumpkin-400': '#d27a01',
        'pumpkin-350': '#e48500', 'pumpkin-300': '#ff9500', 'pumpkin-250': '#ffa23a', 'pumpkin-200': '#feb670',
        'pumpkin-150': '#fcca9b', 'pumpkin-100': '#fcdcc1', 'pumpkin-50': '#fceee3',
        
        'orange-950': '#1b0d06', 'orange-900': '#2d1509', 'orange-850': '#411a0a', 'orange-800': '#561e0a',
        'orange-750': '#6b220a', 'orange-700': '#7f270b', 'orange-650': '#942d0d', 'orange-600': '#a83410',
        'orange-550': '#bd3c13', 'orange-500': '#d24317', 'orange-450': '#e74b1a', 'orange-400': '#f45d2c',
        'orange-350': '#f56b3d', 'orange-300': '#f68e68', 'orange-250': '#f8a283', 'orange-200': '#f8b79f',
        'orange-150': '#f8cab9', 'orange-100': '#f9dcd2', 'orange-50': '#faeeea',
        
        'sand-950': '#111110', 'sand-900': '#1c1b19', 'sand-850': '#272622', 'sand-800': '#32302b',
        'sand-750': '#3d3b35', 'sand-700': '#49463f', 'sand-650': '#55524a', 'sand-600': '#615e55',
        'sand-550': '#6e6a60', 'sand-500': '#7b776b', 'sand-450': '#888377', 'sand-400': '#959082',
        'sand-350': '#a39e8f', 'sand-300': '#b0ab9b', 'sand-250': '#beb8a7', 'sand-200': '#ccc6b4',
        'sand-150': '#dad4c2', 'sand-100': '#e8e2d2', 'sand-50': '#f2f0ec',
        
        'grey-950': '#111111', 'grey-900': '#1b1b1b', 'grey-850': '#262626', 'grey-800': '#303030',
        'grey-750': '#3b3b3b', 'grey-700': '#474747', 'grey-650': '#525252', 'grey-600': '#5e5e5e',
        'grey-550': '#6a6a6a', 'grey-500': '#777777', 'grey-450': '#808080', 'grey-400': '#919191',
        'grey-350': '#9e9e9e', 'grey-300': '#ababab', 'grey-250': '#b9b9b9', 'grey-200': '#c6c6c6',
        'grey-150': '#d4d4d4', 'grey-100': '#e2e2e2', 'grey-50': '#f1f1f1',
        
        'zinc-950': '#0f1114', 'zinc-900': '#191c20', 'zinc-850': '#23262c', 'zinc-800': '#2d3138',
        'zinc-750': '#373c44', 'zinc-700': '#424751', 'zinc-650': '#4d535e', 'zinc-600': '#5c6370',
        'zinc-550': '#646b79', 'zinc-500': '#6f7887', 'zinc-450': '#7b8495', 'zinc-400': '#8891a4',
        'zinc-350': '#969eaf', 'zinc-300': '#a4acba', 'zinc-250': '#b3b9c5', 'zinc-200': '#c2c7d0',
        'zinc-150': '#d1d5db', 'zinc-100': '#e0e3e7', 'zinc-50': '#f0f1f3',
        
        'slate-950': '#0e1118', 'slate-900': '#181c25', 'slate-850': '#202632', 'slate-800': '#2a3140',
        'slate-750': '#333c4e', 'slate-700': '#3d475c', 'slate-650': '#48536b', 'slate-600': '#525f7a',
        'slate-550': '#5d6b89', 'slate-500': '#687899', 'slate-450': '#7385a9', 'slate-400': '#8191b5',
        'slate-350': '#909ebe', 'slate-300': '#a0acc7', 'slate-250': '#b0b9d0', 'slate-200': '#bfc7d9',
        'slate-150': '#cfd5e2', 'slate-100': '#dfe3eb', 'slate-50': '#eff1f4',
        
        'light': '#ffffff',
        'dark': '#000000'
    };



    /**
     * Get hex value for Pico CSS color name
     */
    function getPicoColorHex(colorName) {
        return picoColors[colorName] || '#5c7ef8';
    }

    /**
     * Generate color variations for light and dark modes
     */
    function generateColorVariations(hex) {
        const baseColor = hex.replace('#', '');
        const r = parseInt(baseColor.substr(0, 2), 16);
        const g = parseInt(baseColor.substr(2, 2), 16);
        const b = parseInt(baseColor.substr(4, 2), 16);

        return {
            base: hex,
            hover: darkenColor(hex, 15),
            focus: lightenColor(hex, 20),
            light: lightenColor(hex, 20)
        };
    }

    /**
     * Lighten a hex color by percentage
     */
    function lightenColor(hex, percent) {
        const num = parseInt(hex.replace("#", ""), 16);
        const amt = Math.round(2.55 * percent);
        const R = (num >> 16) + amt;
        const G = (num >> 8 & 0x00FF) + amt;
        const B = (num & 0x0000FF) + amt;
        return "#" + (0x1000000 + (R > 255 ? 255 : R) * 0x10000 +
            (G > 255 ? 255 : G) * 0x100 +
            (B > 255 ? 255 : B)).toString(16).slice(1);
    }

    /**
     * Darken a hex color by percentage
     */
    function darkenColor(hex, percent) {
        const num = parseInt(hex.replace("#", ""), 16);
        const amt = Math.round(2.55 * percent);
        const R = (num >> 16) - amt;
        const G = (num >> 8 & 0x00FF) - amt;
        const B = (num & 0x0000FF) - amt;
        return "#" + (0x1000000 + (R > 255 ? 255 : R < 0 ? 0 : R) * 0x10000 +
            (G > 255 ? 255 : G < 0 ? 0 : G) * 0x100 +
            (B > 255 ? 255 : B < 0 ? 0 : B)).toString(16).slice(1);
    }

    /**
     * Update CSS custom properties with color variations
     */
    function updateColorProperties(primaryName, secondaryName, accentName, lightBgName = 'light', darkBgName = 'grey-900', lightFgName = 'grey-800', darkFgName = 'grey-200') {
        // Convert color names to hex values
        const primary = getPicoColorHex(primaryName);
        const secondary = getPicoColorHex(secondaryName);
        const accent = getPicoColorHex(accentName);
        const lightBg = getPicoColorHex(lightBgName);
        const darkBg = getPicoColorHex(darkBgName);
        const lightFg = getPicoColorHex(lightFgName);
        const darkFg = getPicoColorHex(darkFgName);
        
        const primaryVars = generateColorVariations(primary);
        const secondaryVars = generateColorVariations(secondary);
        const accentVars = generateColorVariations(accent);

        // Create or update the dynamic styles
        let dynamicStyles = $('#sigil-dynamic-colors');
        if (dynamicStyles.length === 0) {
            dynamicStyles = $('<style id="sigil-dynamic-colors"></style>');
            $('head').append(dynamicStyles);
        }

        const css = `
            :root {
                /* Primary Color System */
                --primary: ${primaryVars.base};
                --primary-background: ${primaryVars.base};
                --primary-border: ${primaryVars.base};
                --primary-hover: ${primaryVars.hover};
                --primary-hover-background: ${primaryVars.hover};
                --primary-hover-border: ${primaryVars.hover};
                --primary-focus: ${primaryVars.focus};
                --primary-underline: ${primaryVars.focus};
                --primary-hover-underline: ${primaryVars.hover};
                
                /* Secondary Color System */
                --secondary: ${secondaryVars.base};
                --secondary-background: ${secondaryVars.base};
                --secondary-border: ${secondaryVars.base};
                --secondary-hover: ${secondaryVars.hover};
                --secondary-hover-background: ${secondaryVars.hover};
                --secondary-hover-border: ${secondaryVars.hover};
                --secondary-focus: ${secondaryVars.focus};
                
                /* Accent Color System */
                --accent: ${accentVars.base};
                --accent-background: ${accentVars.base};
                --accent-border: ${accentVars.base};
                --accent-hover: ${accentVars.hover};
                --accent-hover-background: ${accentVars.hover};
                --accent-hover-border: ${accentVars.hover};
                --accent-focus: ${accentVars.focus};
                
                /* Form Elements */
                --form-element-active-border-color: ${primaryVars.base};
                --form-element-focus-color: ${primaryVars.focus};
                
                /* Background Colors */
                --background-color: ${lightBg};
                --card-background-color: ${lightBg};
                
                /* Foreground Colors */
                --foreground-color: ${lightFg};
                --card-foreground-color: ${lightFg};
                --blockquote-color: ${lightFg};
            }
            
            /* Dark mode adjustments */
            .dark {
                --primary: ${primaryVars.light};
                --primary-background: ${primaryVars.light};
                --primary-border: ${primaryVars.light};
                --primary-hover: ${primaryVars.base};
                --primary-hover-background: ${primaryVars.base};
                --primary-hover-border: ${primaryVars.base};
                
                --secondary: ${secondaryVars.light};
                --secondary-background: ${secondaryVars.light};
                --secondary-border: ${secondaryVars.light};
                --secondary-hover: ${secondaryVars.base};
                --secondary-hover-background: ${secondaryVars.base};
                --secondary-hover-border: ${secondaryVars.base};
                
                --accent: ${accentVars.light};
                --accent-background: ${accentVars.light};
                --accent-border: ${accentVars.light};
                --accent-hover: ${accentVars.base};
                --accent-hover-background: ${accentVars.base};
                --accent-hover-border: ${accentVars.base};
                
                --form-element-active-border-color: ${primaryVars.light};
                --form-element-focus-color: ${primaryVars.focus};
                
                /* Background Colors */
                --background-color: ${darkBg};
                --card-background-color: ${darkBg};
                
                /* Foreground Colors */
                --foreground-color: ${darkFg};
                --card-foreground-color: ${darkFg};
                --blockquote-color: ${darkFg};
            }
        `;

        dynamicStyles.html(css);
    }

    /**
     * Get current color values (handling new primary color system)
     */
    function getCurrentColors() {
        return {
            primary: getResolvedPrimaryColor(),
            secondary: getResolvedSecondaryColor(),
            accent: getResolvedAccentColor(),
            light_bg: getResolvedLightBgColor(),
            dark_bg: getResolvedDarkBgColor(),
            light_fg: getResolvedLightFgColor(),
            dark_fg: getResolvedDarkFgColor()
        };
    }

    /**
     * Get resolved primary color based on mode
     */
    function getResolvedPrimaryColor() {
        const mode = wp.customize('sigil_primary_color_mode')();
        
        if (mode === 'custom') {
            return wp.customize('sigil_primary_custom_color')();
        } else {
            const colorName = wp.customize('sigil_primary_color_name')();
            const colorShade = wp.customize('sigil_primary_color_shade')();
            const picoColorName = colorName + '-' + colorShade;
            return getPicoColorHex(picoColorName);
        }
    }

    /**
     * Get resolved secondary color based on mode
     */
    function getResolvedSecondaryColor() {
        const mode = wp.customize('sigil_secondary_color_mode')();
        
        if (mode === 'custom') {
            return wp.customize('sigil_secondary_custom_color')();
        } else {
            const colorName = wp.customize('sigil_secondary_color_name')();
            const colorShade = wp.customize('sigil_secondary_color_shade')();
            return getPicoColorHex(colorName + '-' + colorShade);
        }
    }

    /**
     * Get resolved accent color based on mode
     */
    function getResolvedAccentColor() {
        const mode = wp.customize('sigil_accent_color_mode')();
        
        if (mode === 'custom') {
            return wp.customize('sigil_accent_custom_color')();
        } else {
            const colorName = wp.customize('sigil_accent_color_name')();
            const colorShade = wp.customize('sigil_accent_color_shade')();
            return getPicoColorHex(colorName + '-' + colorShade);
        }
    }

    /**
     * Get resolved light background color based on mode
     */
    function getResolvedLightBgColor() {
        const mode = wp.customize('sigil_light_bg_color_mode')();
        
        if (mode === 'custom') {
            return wp.customize('sigil_light_bg_custom_color')();
        } else {
            const colorName = wp.customize('sigil_light_bg_color_name')();
            const colorShade = wp.customize('sigil_light_bg_color_shade')();
            return getPicoColorHex(colorName + '-' + colorShade);
        }
    }

    /**
     * Get resolved dark background color based on mode
     */
    function getResolvedDarkBgColor() {
        const mode = wp.customize('sigil_dark_bg_color_mode')();
        
        if (mode === 'custom') {
            return wp.customize('sigil_dark_bg_custom_color')();
        } else {
            const colorName = wp.customize('sigil_dark_bg_color_name')();
            const colorShade = wp.customize('sigil_dark_bg_color_shade')();
            return getPicoColorHex(colorName + '-' + colorShade);
        }
    }

    /**
     * Get resolved light foreground color based on mode
     */
    function getResolvedLightFgColor() {
        const mode = wp.customize('sigil_light_fg_color_mode')();
        
        if (mode === 'custom') {
            return wp.customize('sigil_light_fg_custom_color')();
        } else {
            const colorName = wp.customize('sigil_light_fg_color_name')();
            const colorShade = wp.customize('sigil_light_fg_color_shade')();
            return getPicoColorHex(colorName + '-' + colorShade);
        }
    }

    /**
     * Get resolved dark foreground color based on mode
     */
    function getResolvedDarkFgColor() {
        const mode = wp.customize('sigil_dark_fg_color_mode')();
        
        if (mode === 'custom') {
            return wp.customize('sigil_dark_fg_custom_color')();
        } else {
            const colorName = wp.customize('sigil_dark_fg_color_name')();
            const colorShade = wp.customize('sigil_dark_fg_color_shade')();
            return getPicoColorHex(colorName + '-' + colorShade);
        }
    }

    // Wait for customizer to be ready
    wp.customize.bind('ready', function() {
        
        // Handle visibility of color controls based on mode
        function togglePrimaryColorControls() {
            const mode = wp.customize('sigil_primary_color_mode')();
            const presetControls = ['sigil_primary_color_name', 'sigil_primary_color_shade'];
            const customControls = ['sigil_primary_custom_color'];
            
            if (mode === 'preset') {
                presetControls.forEach(control => {
                    wp.customize.control(control).container.show();
                });
                customControls.forEach(control => {
                    wp.customize.control(control).container.hide();
                });
            } else {
                presetControls.forEach(control => {
                    wp.customize.control(control).container.hide();
                });
                customControls.forEach(control => {
                    wp.customize.control(control).container.show();
                });
            }
        }

        function toggleSecondaryColorControls() {
            const mode = wp.customize('sigil_secondary_color_mode')();
            const presetControls = ['sigil_secondary_color_name', 'sigil_secondary_color_shade'];
            const customControls = ['sigil_secondary_custom_color'];
            
            if (mode === 'preset') {
                presetControls.forEach(control => {
                    wp.customize.control(control).container.show();
                });
                customControls.forEach(control => {
                    wp.customize.control(control).container.hide();
                });
            } else {
                presetControls.forEach(control => {
                    wp.customize.control(control).container.hide();
                });
                customControls.forEach(control => {
                    wp.customize.control(control).container.show();
                });
            }
        }

        function toggleAccentColorControls() {
            const mode = wp.customize('sigil_accent_color_mode')();
            const presetControls = ['sigil_accent_color_name', 'sigil_accent_color_shade'];
            const customControls = ['sigil_accent_custom_color'];
            
            if (mode === 'preset') {
                presetControls.forEach(control => {
                    wp.customize.control(control).container.show();
                });
                customControls.forEach(control => {
                    wp.customize.control(control).container.hide();
                });
            } else {
                presetControls.forEach(control => {
                    wp.customize.control(control).container.hide();
                });
                customControls.forEach(control => {
                    wp.customize.control(control).container.show();
                });
            }
        }

        function toggleLightBgColorControls() {
            const mode = wp.customize('sigil_light_bg_color_mode')();
            const presetControls = ['sigil_light_bg_color_name', 'sigil_light_bg_color_shade'];
            const customControls = ['sigil_light_bg_custom_color'];
            
            if (mode === 'preset') {
                presetControls.forEach(control => {
                    wp.customize.control(control).container.show();
                });
                customControls.forEach(control => {
                    wp.customize.control(control).container.hide();
                });
            } else {
                presetControls.forEach(control => {
                    wp.customize.control(control).container.hide();
                });
                customControls.forEach(control => {
                    wp.customize.control(control).container.show();
                });
            }
        }

        function toggleDarkBgColorControls() {
            const mode = wp.customize('sigil_dark_bg_color_mode')();
            const presetControls = ['sigil_dark_bg_color_name', 'sigil_dark_bg_color_shade'];
            const customControls = ['sigil_dark_bg_custom_color'];
            
            if (mode === 'preset') {
                presetControls.forEach(control => {
                    wp.customize.control(control).container.show();
                });
                customControls.forEach(control => {
                    wp.customize.control(control).container.hide();
                });
            } else {
                presetControls.forEach(control => {
                    wp.customize.control(control).container.hide();
                });
                customControls.forEach(control => {
                    wp.customize.control(control).container.show();
                });
            }
        }

        function toggleLightFgColorControls() {
            const mode = wp.customize('sigil_light_fg_color_mode')();
            const presetControls = ['sigil_light_fg_color_name', 'sigil_light_fg_color_shade'];
            const customControls = ['sigil_light_fg_custom_color'];
            
            if (mode === 'preset') {
                presetControls.forEach(control => {
                    wp.customize.control(control).container.show();
                });
                customControls.forEach(control => {
                    wp.customize.control(control).container.hide();
                });
            } else {
                presetControls.forEach(control => {
                    wp.customize.control(control).container.hide();
                });
                customControls.forEach(control => {
                    wp.customize.control(control).container.show();
                });
            }
        }

        function toggleDarkFgColorControls() {
            const mode = wp.customize('sigil_dark_fg_color_mode')();
            const presetControls = ['sigil_dark_fg_color_name', 'sigil_dark_fg_color_shade'];
            const customControls = ['sigil_dark_fg_custom_color'];
            
            if (mode === 'preset') {
                presetControls.forEach(control => {
                    wp.customize.control(control).container.show();
                });
                customControls.forEach(control => {
                    wp.customize.control(control).container.hide();
                });
            } else {
                presetControls.forEach(control => {
                    wp.customize.control(control).container.hide();
                });
                customControls.forEach(control => {
                    wp.customize.control(control).container.show();
                });
            }
        }
        
        // Initialize visibility on load
        togglePrimaryColorControls();
        toggleSecondaryColorControls();
        toggleAccentColorControls();
        toggleLightBgColorControls();
        toggleDarkBgColorControls();
        toggleLightFgColorControls();
        toggleDarkFgColorControls();

        
        // Handle primary color system changes
        wp.customize('sigil_primary_color_mode', function(value) {
            value.bind(function(newval) {
                togglePrimaryColorControls();
                const colors = getCurrentColors();
                updateColorProperties(colors.primary, colors.secondary, colors.accent, colors.light_bg, colors.dark_bg, colors.light_fg, colors.dark_fg);
            });
        });

        wp.customize('sigil_primary_color_name', function(value) {
            value.bind(function(newval) {
                const colors = getCurrentColors();
                updateColorProperties(colors.primary, colors.secondary, colors.accent, colors.light_bg, colors.dark_bg, colors.light_fg, colors.dark_fg);
            });
        });

        wp.customize('sigil_primary_color_shade', function(value) {
            value.bind(function(newval) {
                const colors = getCurrentColors();
                updateColorProperties(colors.primary, colors.secondary, colors.accent, colors.light_bg, colors.dark_bg, colors.light_fg, colors.dark_fg);
            });
        });

        wp.customize('sigil_primary_custom_color', function(value) {
            value.bind(function(newval) {
                const colors = getCurrentColors();
                updateColorProperties(colors.primary, colors.secondary, colors.accent, colors.light_bg, colors.dark_bg, colors.light_fg, colors.dark_fg);
            });
        });

        // Handle secondary color system changes
        wp.customize('sigil_secondary_color_mode', function(value) {
            value.bind(function(newval) {
                toggleSecondaryColorControls();
                const colors = getCurrentColors();
                updateColorProperties(colors.primary, colors.secondary, colors.accent, colors.light_bg, colors.dark_bg, colors.light_fg, colors.dark_fg);
            });
        });

        wp.customize('sigil_secondary_color_name', function(value) {
            value.bind(function(newval) {
                const colors = getCurrentColors();
                updateColorProperties(colors.primary, colors.secondary, colors.accent, colors.light_bg, colors.dark_bg, colors.light_fg, colors.dark_fg);
            });
        });

        wp.customize('sigil_secondary_color_shade', function(value) {
            value.bind(function(newval) {
                const colors = getCurrentColors();
                updateColorProperties(colors.primary, colors.secondary, colors.accent, colors.light_bg, colors.dark_bg, colors.light_fg, colors.dark_fg);
            });
        });

        wp.customize('sigil_secondary_custom_color', function(value) {
            value.bind(function(newval) {
                const colors = getCurrentColors();
                updateColorProperties(colors.primary, colors.secondary, colors.accent, colors.light_bg, colors.dark_bg, colors.light_fg, colors.dark_fg);
            });
        });

        // Handle accent color system changes
        wp.customize('sigil_accent_color_mode', function(value) {
            value.bind(function(newval) {
                toggleAccentColorControls();
                const colors = getCurrentColors();
                updateColorProperties(colors.primary, colors.secondary, colors.accent, colors.light_bg, colors.dark_bg, colors.light_fg, colors.dark_fg);
            });
        });

        wp.customize('sigil_accent_color_name', function(value) {
            value.bind(function(newval) {
                const colors = getCurrentColors();
                updateColorProperties(colors.primary, colors.secondary, colors.accent, colors.light_bg, colors.dark_bg, colors.light_fg, colors.dark_fg);
            });
        });

        wp.customize('sigil_accent_color_shade', function(value) {
            value.bind(function(newval) {
                const colors = getCurrentColors();
                updateColorProperties(colors.primary, colors.secondary, colors.accent, colors.light_bg, colors.dark_bg, colors.light_fg, colors.dark_fg);
            });
        });

        wp.customize('sigil_accent_custom_color', function(value) {
            value.bind(function(newval) {
                const colors = getCurrentColors();
                updateColorProperties(colors.primary, colors.secondary, colors.accent, colors.light_bg, colors.dark_bg, colors.light_fg, colors.dark_fg);
            });
        });

        // Handle light background color system changes
        wp.customize('sigil_light_bg_color_mode', function(value) {
            value.bind(function(newval) {
                toggleLightBgColorControls();
                const colors = getCurrentColors();
                updateColorProperties(colors.primary, colors.secondary, colors.accent, colors.light_bg, colors.dark_bg, colors.light_fg, colors.dark_fg);
            });
        });

        wp.customize('sigil_light_bg_color_name', function(value) {
            value.bind(function(newval) {
                const colors = getCurrentColors();
                updateColorProperties(colors.primary, colors.secondary, colors.accent, colors.light_bg, colors.dark_bg, colors.light_fg, colors.dark_fg);
            });
        });

        wp.customize('sigil_light_bg_color_shade', function(value) {
            value.bind(function(newval) {
                const colors = getCurrentColors();
                updateColorProperties(colors.primary, colors.secondary, colors.accent, colors.light_bg, colors.dark_bg, colors.light_fg, colors.dark_fg);
            });
        });

        wp.customize('sigil_light_bg_custom_color', function(value) {
            value.bind(function(newval) {
                const colors = getCurrentColors();
                updateColorProperties(colors.primary, colors.secondary, colors.accent, colors.light_bg, colors.dark_bg, colors.light_fg, colors.dark_fg);
            });
        });

        // Handle dark background color system changes
        wp.customize('sigil_dark_bg_color_mode', function(value) {
            value.bind(function(newval) {
                toggleDarkBgColorControls();
                const colors = getCurrentColors();
                updateColorProperties(colors.primary, colors.secondary, colors.accent, colors.light_bg, colors.dark_bg, colors.light_fg, colors.dark_fg);
            });
        });

        wp.customize('sigil_dark_bg_color_name', function(value) {
            value.bind(function(newval) {
                const colors = getCurrentColors();
                updateColorProperties(colors.primary, colors.secondary, colors.accent, colors.light_bg, colors.dark_bg, colors.light_fg, colors.dark_fg);
            });
        });

        wp.customize('sigil_dark_bg_color_shade', function(value) {
            value.bind(function(newval) {
                const colors = getCurrentColors();
                updateColorProperties(colors.primary, colors.secondary, colors.accent, colors.light_bg, colors.dark_bg, colors.light_fg, colors.dark_fg);
            });
        });

        wp.customize('sigil_dark_bg_custom_color', function(value) {
            value.bind(function(newval) {
                const colors = getCurrentColors();
                updateColorProperties(colors.primary, colors.secondary, colors.accent, colors.light_bg, colors.dark_bg, colors.light_fg, colors.dark_fg);
            });
        });

        // Handle light foreground color system changes
        wp.customize('sigil_light_fg_color_mode', function(value) {
            value.bind(function(newval) {
                toggleLightFgColorControls();
                const colors = getCurrentColors();
                updateColorProperties(colors.primary, colors.secondary, colors.accent, colors.light_bg, colors.dark_bg, colors.light_fg, colors.dark_fg);
            });
        });

        wp.customize('sigil_light_fg_color_name', function(value) {
            value.bind(function(newval) {
                const colors = getCurrentColors();
                updateColorProperties(colors.primary, colors.secondary, colors.accent, colors.light_bg, colors.dark_bg, colors.light_fg, colors.dark_fg);
            });
        });

        wp.customize('sigil_light_fg_color_shade', function(value) {
            value.bind(function(newval) {
                const colors = getCurrentColors();
                updateColorProperties(colors.primary, colors.secondary, colors.accent, colors.light_bg, colors.dark_bg, colors.light_fg, colors.dark_fg);
            });
        });

        wp.customize('sigil_light_fg_custom_color', function(value) {
            value.bind(function(newval) {
                const colors = getCurrentColors();
                updateColorProperties(colors.primary, colors.secondary, colors.accent, colors.light_bg, colors.dark_bg, colors.light_fg, colors.dark_fg);
            });
        });

        // Handle dark foreground color system changes
        wp.customize('sigil_dark_fg_color_mode', function(value) {
            value.bind(function(newval) {
                toggleDarkFgColorControls();
                const colors = getCurrentColors();
                updateColorProperties(colors.primary, colors.secondary, colors.accent, colors.light_bg, colors.dark_bg, colors.light_fg, colors.dark_fg);
            });
        });

        wp.customize('sigil_dark_fg_color_name', function(value) {
            value.bind(function(newval) {
                const colors = getCurrentColors();
                updateColorProperties(colors.primary, colors.secondary, colors.accent, colors.light_bg, colors.dark_bg, colors.light_fg, colors.dark_fg);
            });
        });

        wp.customize('sigil_dark_fg_color_shade', function(value) {
            value.bind(function(newval) {
                const colors = getCurrentColors();
                updateColorProperties(colors.primary, colors.secondary, colors.accent, colors.light_bg, colors.dark_bg, colors.light_fg, colors.dark_fg);
            });
        });

        wp.customize('sigil_dark_fg_custom_color', function(value) {
            value.bind(function(newval) {
                const colors = getCurrentColors();
                updateColorProperties(colors.primary, colors.secondary, colors.accent, colors.light_bg, colors.dark_bg, colors.light_fg, colors.dark_fg);
            });
        });
        
        // Initialize with current values on load
        const colors = getCurrentColors();
        updateColorProperties(colors.primary, colors.secondary, colors.accent, colors.light_bg, colors.dark_bg, colors.light_fg, colors.dark_fg);
    });

})(jQuery); 