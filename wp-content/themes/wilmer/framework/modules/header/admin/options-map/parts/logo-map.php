<?php

if ( ! function_exists( 'wilmer_mikado_logo_options_map' ) ) {
	function wilmer_mikado_logo_options_map() {
		
		wilmer_mikado_add_admin_page(
			array(
				'slug'  => '_logo_page',
				'title' => esc_html__( 'Logo', 'wilmer' ),
				'icon'  => 'fa fa-coffee'
			)
		);
		
		$panel_logo = wilmer_mikado_add_admin_panel(
			array(
				'page'  => '_logo_page',
				'name'  => 'panel_logo',
				'title' => esc_html__( 'Logo', 'wilmer' )
			)
		);
		
		wilmer_mikado_add_admin_field(
			array(
				'parent'        => $panel_logo,
				'type'          => 'yesno',
				'name'          => 'hide_logo',
				'default_value' => 'no',
				'label'         => esc_html__( 'Hide Logo', 'wilmer' ),
				'description'   => esc_html__( 'Enabling this option will hide logo image', 'wilmer' )
			)
		);
		
		$hide_logo_container = wilmer_mikado_add_admin_container(
			array(
				'parent'          => $panel_logo,
				'name'            => 'hide_logo_container',
				'dependency' => array(
					'hide' => array(
						'hide_logo'  => 'yes'
					)
				)
			)
		);

        wilmer_mikado_add_admin_field(
            array(
                'parent'        => $hide_logo_container,
                'type'          => 'select',
                'name'          => 'logo_source',
                'default_value' => 'image',
                'label'         => esc_html__( 'Select Logo Source', 'wilmer' ),
                'description'   => esc_html__( 'Choose whether you would like to use logo as image or text', 'wilmer' ),
                'options'       => array(
                    'image' => esc_html__( 'Image', 'wilmer' ),
                    'text' => esc_html__( 'Text', 'wilmer' )
                )
            )
        );

        $image_logo_container = wilmer_mikado_add_admin_container(
            array(
                'parent'          => $hide_logo_container,
                'name'            => 'image_logo_container',
                'dependency' => array(
                    'hide' => array(
                        'logo_source'  => 'text'
                    )
                )
            )
        );

        wilmer_mikado_add_admin_field(
            array(
                'name'          => 'logo_image',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT . "/img/logo.png",
                'label'         => esc_html__( 'Logo Image - Default', 'wilmer' ),
                'parent'        => $image_logo_container
            )
        );

        wilmer_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_dark',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT . "/img/logo.png",
                'label'         => esc_html__( 'Logo Image - Dark', 'wilmer' ),
                'parent'        => $image_logo_container
            )
        );

        wilmer_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_light',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT . "/img/logo_white.png",
                'label'         => esc_html__( 'Logo Image - Light', 'wilmer' ),
                'parent'        => $image_logo_container
            )
        );

        wilmer_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_sticky',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT . "/img/logo.png",
                'label'         => esc_html__( 'Logo Image - Sticky', 'wilmer' ),
                'parent'        => $image_logo_container
            )
        );

        wilmer_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_mobile',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT . "/img/logo.png",
                'label'         => esc_html__( 'Logo Image - Mobile', 'wilmer' ),
                'parent'        => $image_logo_container
            )
        );

        wilmer_mikado_add_admin_field(
            array(
                'parent'      => $hide_logo_container,
                'type'        => 'text',
                'name'        => 'logo_text',
                'label'       => esc_html__( 'Logo Text', 'wilmer' ),
                'description' => esc_html__( 'Enter your logo text here', 'wilmer' ),
                'dependency' => array(
                    'hide' => array(
                        'logo_source'  => 'image'
                    )
                ),
                'args' => array(
                    'col_width' => 3
                )
            )
        );

        wilmer_mikado_add_admin_field(
            array(
                'parent'      => $hide_logo_container,
                'type'        => 'color',
                'name'        => 'logo_text_color',
                'label'       => esc_html__( 'Logo Text Color', 'wilmer' ),
                'description' => esc_html__( 'Choose color for your logo text', 'wilmer' ),
                'dependency' => array(
                    'hide' => array(
                        'logo_source'  => 'image'
                    )
                )
            )
        );

        wilmer_mikado_add_admin_field(
            array(
                'parent'      => $hide_logo_container,
                'type'        => 'text',
                'name'        => 'logo_text_font_size',
                'label'       => esc_html__( 'Logo Text Font Size', 'wilmer' ),
                'description' => esc_html__( 'Set font size for your logo text', 'wilmer' ),
                'dependency' => array(
                    'hide' => array(
                        'logo_source'  => 'image'
                    )
                ),
                'args' => array(
                    'col_width' => 3,
                    'suffix' => 'px'
                )
            )
        );

        wilmer_mikado_add_admin_field(
            array(
                'parent'      => $hide_logo_container,
                'type'        => 'color',
                'name'        => 'logo_text_bg_color',
                'label'       => esc_html__( 'Logo Text Background Color', 'wilmer' ),
                'description' => esc_html__( 'Choose background color for your logo text', 'wilmer' ),
                'dependency' => array(
                    'hide' => array(
                        'logo_source'  => 'image'
                    )
                )
            )
        );

        wilmer_mikado_add_admin_field(
            array(
                'parent'      => $hide_logo_container,
                'type'        => 'text',
                'name'        => 'logo_text_side_padding',
                'label'       => esc_html__( 'Logo Text Side Padding', 'wilmer' ),
                'description' => esc_html__( 'Enter side padding for your logo', 'wilmer' ),
                'dependency' => array(
                    'hide' => array(
                        'logo_source'  => 'image'
                    )
                ),
                'args' => array(
                    'suffix'    => 'px',
                    'col_width' => 3
                )
            )
        );
	}
	
	add_action( 'wilmer_mikado_action_options_map', 'wilmer_mikado_logo_options_map', wilmer_mikado_set_options_map_position( 'logo' ) );
}