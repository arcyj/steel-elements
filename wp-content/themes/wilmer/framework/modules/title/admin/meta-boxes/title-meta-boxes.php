<?php

if ( ! function_exists( 'wilmer_mikado_get_title_types_meta_boxes' ) ) {
	function wilmer_mikado_get_title_types_meta_boxes() {
		$title_type_options = apply_filters( 'wilmer_mikado_filter_title_type_meta_boxes', $title_type_options = array( '' => esc_html__( 'Default', 'wilmer' ) ) );
		
		return $title_type_options;
	}
}

foreach ( glob( MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'wilmer_mikado_map_title_meta' ) ) {
	function wilmer_mikado_map_title_meta() {
		$title_type_meta_boxes = wilmer_mikado_get_title_types_meta_boxes();
		
		$title_meta_box = wilmer_mikado_create_meta_box(
			array(
				'scope' => apply_filters( 'wilmer_mikado_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'title_meta' ),
				'title' => esc_html__( 'Title', 'wilmer' ),
				'name'  => 'title_meta'
			)
		);
		
		wilmer_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_show_title_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'wilmer' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'wilmer' ),
				'parent'        => $title_meta_box,
				'options'       => wilmer_mikado_get_yes_no_select_array()
			)
		);
		
			$show_title_area_meta_container = wilmer_mikado_add_admin_container(
				array(
					'parent'          => $title_meta_box,
					'name'            => 'mkdf_show_title_area_meta_container',
					'dependency' => array(
						'hide' => array(
							'mkdf_show_title_area_meta' => 'no'
						)
					)
				)
			);
		
				wilmer_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_type_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area Type', 'wilmer' ),
						'description'   => esc_html__( 'Choose title type', 'wilmer' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => $title_type_meta_boxes
					)
				);
		
				wilmer_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_in_grid_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area In Grid', 'wilmer' ),
						'description'   => esc_html__( 'Set title area content to be in grid', 'wilmer' ),
						'options'       => wilmer_mikado_get_yes_no_select_array(),
						'parent'        => $show_title_area_meta_container
					)
				);
		
				wilmer_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_title_area_height_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Height', 'wilmer' ),
						'description' => esc_html__( 'Set a height for Title Area', 'wilmer' ),
						'parent'      => $show_title_area_meta_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px'
						)
					)
				);
				
				wilmer_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_title_area_background_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Background Color', 'wilmer' ),
						'description' => esc_html__( 'Choose a background color for title area', 'wilmer' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				wilmer_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_title_area_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'wilmer' ),
						'description' => esc_html__( 'Choose an Image for title area', 'wilmer' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				wilmer_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_background_image_behavior_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Behavior', 'wilmer' ),
						'description'   => esc_html__( 'Choose title area background image behavior', 'wilmer' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''                    => esc_html__( 'Default', 'wilmer' ),
							'hide'                => esc_html__( 'Hide Image', 'wilmer' ),
							'responsive'          => esc_html__( 'Enable Responsive Image', 'wilmer' ),
							'responsive-disabled' => esc_html__( 'Disable Responsive Image', 'wilmer' ),
							'parallax'            => esc_html__( 'Enable Parallax Image', 'wilmer' ),
							'parallax-zoom-out'   => esc_html__( 'Enable Parallax With Zoom Out Image', 'wilmer' ),
							'parallax-disabled'   => esc_html__( 'Disable Parallax Image', 'wilmer' )
						)
					)
				);
				
				wilmer_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_vertical_alignment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Vertical Alignment', 'wilmer' ),
						'description'   => esc_html__( 'Specify title area content vertical alignment', 'wilmer' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''              => esc_html__( 'Default', 'wilmer' ),
							'header-bottom' => esc_html__( 'From Bottom of Header', 'wilmer' ),
							'window-top'    => esc_html__( 'From Window Top', 'wilmer' )
						)
					)
				);
				
				wilmer_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_title_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Tag', 'wilmer' ),
						'options'       => wilmer_mikado_get_title_tag( true ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				wilmer_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_title_text_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Title Color', 'wilmer' ),
						'description' => esc_html__( 'Choose a color for title text', 'wilmer' ),
						'parent'      => $show_title_area_meta_container
					)
				);
				
				wilmer_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_subtitle_meta',
						'type'          => 'text',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Text', 'wilmer' ),
						'description'   => esc_html__( 'Enter your subtitle text', 'wilmer' ),
						'parent'        => $show_title_area_meta_container,
						'args'          => array(
							'col_width' => 6
						)
					)
				);
		
				wilmer_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_subtitle_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Tag', 'wilmer' ),
						'options'       => wilmer_mikado_get_title_tag( true, array( 'p' => 'p' ) ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				wilmer_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_subtitle_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Subtitle Color', 'wilmer' ),
						'description' => esc_html__( 'Choose a color for subtitle text', 'wilmer' ),
						'parent'      => $show_title_area_meta_container
					)
				);

		
		/***************** Additional Title Area Layout - start *****************/
		
		do_action( 'wilmer_mikado_action_additional_title_area_meta_boxes', $show_title_area_meta_container );

		        wilmer_mikado_add_admin_section_title(
                    array(
                        'parent' => $show_title_area_meta_container,
                        'name'   => 'title_additional_text',
                        'title'  => esc_html__( 'Title Additional Text', 'wilmer' )
                    )
                );

                wilmer_mikado_create_meta_box_field(
                    array(
                        'name'          => 'mkdf_title_area_title_additional_text_meta',
                        'type'          => 'text',
                        'default_value' => '',
                        'label'         => esc_html__( 'Title Additional Text', 'wilmer' ),
                        'description'   => esc_html__( 'Enter your additional text that will be displayed before title', 'wilmer' ),
                        'parent'        => $show_title_area_meta_container,
                        'args'          => array(
                            'col_width' => 6
                        )
                    )
                );

                wilmer_mikado_create_meta_box_field(
                    array(
                        'name'          => 'mkdf_title_area_title_additional_text_tag_meta',
                        'type'          => 'select',
                        'default_value' => '',
                        'label'         => esc_html__( 'Title Additional Text Tag', 'wilmer' ),
                        'options'       => wilmer_mikado_get_title_tag( true, array( 'p' => 'p' ) ),
                        'parent'        => $show_title_area_meta_container
                    )
                );

                wilmer_mikado_create_meta_box_field(
                    array(
                        'name'        => 'mkdf_title_additional_text_color_meta',
                        'type'        => 'color',
                        'label'       => esc_html__( 'Title Additional Text Color', 'wilmer' ),
                        'description' => esc_html__( 'Choose a color for additional title text', 'wilmer' ),
                        'parent'      => $show_title_area_meta_container
                    )
                );

                wilmer_mikado_add_admin_section_title(
                    array(
                        'parent' => $show_title_area_meta_container,
                        'name'   => 'title_background_text',
                        'title'  => esc_html__( 'Title Background Text', 'wilmer' )
                    )
                );

                wilmer_mikado_create_meta_box_field(
                    array(
                        'name'          => 'mkdf_title_area_background_text_meta',
                        'type'          => 'text',
                        'default_value' => '',
                        'label'         => esc_html__( 'Title Area Background Text', 'wilmer' ),
                        'description'   => esc_html__( 'Enter text that will be displayed before as title background text', 'wilmer' ),
                        'parent'        => $show_title_area_meta_container,
                        'args'          => array(
                            'col_width' => 6
                        )
                    )
                );

                wilmer_mikado_create_meta_box_field(
                    array(
                        'name'          => 'mkdf_title_area_background_text_color_meta',
                        'type'          => 'color',
                        'default_value' => '',
                        'label'         => esc_html__( 'Title Area Background Text Color', 'wilmer' ),
                        'parent'        => $show_title_area_meta_container,

                    )
                );

                wilmer_mikado_create_meta_box_field(
                    array(
                        'name'          => 'mkdf_title_area_background_text_size_meta',
                        'type'          => 'text',
                        'default_value' => '',
                        'label'         => esc_html__( 'Title Area Background Text Font Size', 'wilmer' ),
                        'parent'        => $show_title_area_meta_container,
                        'args'          => array(
                            'col_width' => 2,
                            'suffix'    => 'px'
                        )
                    )
                );

                wilmer_mikado_create_meta_box_field(
                    array(
                        'name'          => 'mkdf_title_area_background_text_top_offset_meta',
                        'type'          => 'text',
                        'default_value' => '',
                        'label'         => esc_html__( 'Title Area Background Text Top Offset', 'wilmer' ),
                        'parent'        => $show_title_area_meta_container,
                        'args'          => array(
                            'col_width' => 2,
                            'suffix'    => 'px or %'
                        )
                    )
                );

                wilmer_mikado_create_meta_box_field(
                    array(
                        'name'          => 'mkdf_title_area_background_text_left_offset_meta',
                        'type'          => 'text',
                        'default_value' => '',
                        'label'         => esc_html__( 'Title Area Background Text Left Offset', 'wilmer' ),
                        'parent'        => $show_title_area_meta_container,
                        'args'          => array(
                            'col_width' => 2,
                            'suffix'    => 'px or %'
                        )
                    )
                );

                wilmer_mikado_create_meta_box_field(
                    array(
                        'name'          => 'mkdf_title_area_background_text_left_offset_1440_meta',
                        'type'          => 'text',
                        'default_value' => '',
                        'label'         => esc_html__( 'Title Area Background Text Left Offset for Lap Top screen sizes', 'wilmer' ),
                        'parent'        => $show_title_area_meta_container,
                        'args'          => array(
                            'col_width' => 2,
                            'suffix'    => 'px or %'
                        )
                    )
                );

                wilmer_mikado_create_meta_box_field(
                    array(
                        'name'          => 'mkdf_title_area_background_text_vertical_align_offset_meta',
                        'type'          => 'select',
                        'default_value' => 'middle',
                        'label'         => esc_html__( 'Title Area Background Text Vertical Alignment', 'wilmer' ),
                        'parent'        => $show_title_area_meta_container,
                        'options'       => array(
                            'top'   => esc_html__('Top', 'wilmer'),
                            'middle'   => esc_html__('Middle', 'wilmer'),
                            'bottom'   => esc_html__('Bottom', 'wilmer')
                        ),
                        'args'          => array(
                            'col_width' => 2,
                        )
                    )
                );
		
		/***************** Additional Title Area Layout - end *****************/
		
	}
	
	add_action( 'wilmer_mikado_action_meta_boxes_map', 'wilmer_mikado_map_title_meta', 60 );
}