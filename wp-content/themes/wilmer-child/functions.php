<?php

/*** Child Theme Function  ***/

if ( ! function_exists( 'wilmer_mikado_child_theme_enqueue_scripts' ) ) {
	function wilmer_mikado_child_theme_enqueue_scripts() {
		$parent_style = 'wilmer-mikado-default-style';
		$modules_style = 'wilmer-mikado-modules';
		
		wp_enqueue_style( 'wilmer-mikado-child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style, $modules_style ) );
	}
	
	add_action( 'wp_enqueue_scripts', 'wilmer_mikado_child_theme_enqueue_scripts' );
}