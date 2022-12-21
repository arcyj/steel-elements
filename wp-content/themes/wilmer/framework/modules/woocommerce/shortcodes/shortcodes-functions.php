<?php

if ( ! function_exists( 'wilmer_mikado_include_woocommerce_shortcodes' ) ) {
	function wilmer_mikado_include_woocommerce_shortcodes() {
	    if(wilmer_mikado_is_theme_registered()) {
	        foreach ( glob( MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/shortcodes/*/load.php' ) as $shortcode_load ) {
                include_once $shortcode_load;
            }
		}
	}
	
	if ( wilmer_mikado_is_plugin_installed( 'core' ) ) {
		add_action( 'wilmer_core_action_include_shortcodes_file', 'wilmer_mikado_include_woocommerce_shortcodes' );
	}
}

// Load woo elementor widgets
if ( ! function_exists( 'wilmer_mikado_include_woo_elementor_widgets_files' ) ) {
    /**
     * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
     */
    function wilmer_mikado_include_woo_elementor_widgets_files() {
        if ( wilmer_mikado_is_plugin_installed('core') && wilmer_mikado_is_theme_registered() ) {
            foreach ( glob( MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/shortcodes/*/elementor-*.php' ) as $shortcode_load ) {
                include_once $shortcode_load;
            }
        }
    }

    add_action( 'elementor/widgets/widgets_registered', 'wilmer_mikado_include_woo_elementor_widgets_files' );
}