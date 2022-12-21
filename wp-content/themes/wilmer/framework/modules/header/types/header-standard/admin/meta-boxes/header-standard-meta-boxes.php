<?php

if ( ! function_exists( 'wilmer_mikado_get_hide_dep_for_header_standard_meta_boxes' ) ) {
	function wilmer_mikado_get_hide_dep_for_header_standard_meta_boxes() {
		$hide_dep_options = apply_filters( 'wilmer_mikado_filter_header_standard_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'wilmer_mikado_header_standard_meta_map' ) ) {
	function wilmer_mikado_header_standard_meta_map( $parent ) {
		$hide_dep_options = wilmer_mikado_get_hide_dep_for_header_standard_meta_boxes();
		
		wilmer_mikado_create_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'mkdf_set_menu_area_position_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Menu Area Position', 'wilmer' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'wilmer' ),
				'options'         => array(
					''       => esc_html__( 'Default', 'wilmer' ),
					'left'   => esc_html__( 'Left', 'wilmer' ),
					'right'  => esc_html__( 'Right', 'wilmer' ),
					'center' => esc_html__( 'Center', 'wilmer' )
				),
				'dependency' => array(
					'hide' => array(
						'mkdf_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'wilmer_mikado_action_additional_header_area_meta_boxes_map', 'wilmer_mikado_header_standard_meta_map' );
}