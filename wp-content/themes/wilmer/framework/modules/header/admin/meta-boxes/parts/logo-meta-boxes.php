<?php

if ( ! function_exists( 'wilmer_mikado_logo_meta_box_map' ) ) {
    function wilmer_mikado_logo_meta_box_map() {

        $logo_meta_box = wilmer_mikado_create_meta_box(
            array(
                'scope' => apply_filters( 'wilmer_mikado_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'logo_meta' ),
                'title' => esc_html__( 'Logo', 'wilmer' ),
                'name'  => 'logo_meta'
            )
        );

        wilmer_mikado_create_meta_box_field(
            array(
                'parent'        => $logo_meta_box,
                'type'          => 'select',
                'name'          => 'mkdf_logo_source_meta',
                'default_value' => '',
                'label'         => esc_html__( 'Select Logo Source', 'wilmer' ),
                'description'   => esc_html__( 'Choose whether you would like to use logo as image or text', 'wilmer' ),
                'options'       => array(
                    ''     => esc_html__('Default', 'wilmer'),
                    'image' => esc_html__( 'Image', 'wilmer' ),
                    'text' => esc_html__( 'Text', 'wilmer' )
                )
            )
        );

        $image_logo_container = wilmer_mikado_add_admin_container(
            array(
                'parent'          => $logo_meta_box,
                'name'            => 'image_logo_container',
                'dependency' => array(
                    'hide' => array(
                        'mkdf_logo_source_meta'  => 'text'
                    )
                )
            )
        );

        wilmer_mikado_create_meta_box_field(
            array(
                'name'        => 'mkdf_logo_image_meta',
                'type'        => 'image',
                'label'       => esc_html__( 'Logo Image - Default', 'wilmer' ),
                'description' => esc_html__( 'Choose a default logo image to display ', 'wilmer' ),
                'parent'      => $image_logo_container
            )
        );

        wilmer_mikado_create_meta_box_field(
            array(
                'name'        => 'mkdf_logo_image_dark_meta',
                'type'        => 'image',
                'label'       => esc_html__( 'Logo Image - Dark', 'wilmer' ),
                'description' => esc_html__( 'Choose a default logo image to display ', 'wilmer' ),
                'parent'      => $image_logo_container
            )
        );

        wilmer_mikado_create_meta_box_field(
            array(
                'name'        => 'mkdf_logo_image_light_meta',
                'type'        => 'image',
                'label'       => esc_html__( 'Logo Image - Light', 'wilmer' ),
                'description' => esc_html__( 'Choose a default logo image to display ', 'wilmer' ),
                'parent'      => $image_logo_container
            )
        );

        wilmer_mikado_create_meta_box_field(
            array(
                'name'        => 'mkdf_logo_image_sticky_meta',
                'type'        => 'image',
                'label'       => esc_html__( 'Logo Image - Sticky', 'wilmer' ),
                'description' => esc_html__( 'Choose a default logo image to display ', 'wilmer' ),
                'parent'      => $image_logo_container
            )
        );

        wilmer_mikado_create_meta_box_field(
            array(
                'name'        => 'mkdf_logo_image_mobile_meta',
                'type'        => 'image',
                'label'       => esc_html__( 'Logo Image - Mobile', 'wilmer' ),
                'description' => esc_html__( 'Choose a default logo image to display ', 'wilmer' ),
                'parent'      => $image_logo_container
            )
        );

        wilmer_mikado_create_meta_box_field(
            array(
                'parent'      => $logo_meta_box,
                'type'        => 'text',
                'name'        => 'mkdf_logo_text_meta',
                'label'       => esc_html__( 'Logo Text', 'wilmer' ),
                'description' => esc_html__( 'Enter your logo text', 'wilmer' ),
                'dependency' => array(
                    'hide' => array(
                        'mkdf_logo_source_meta'  => 'image'
                    )
                ),
                'args' => array(
                    'col_width' => 3
                )
            )
        );

        wilmer_mikado_create_meta_box_field(
            array(
                'parent'      => $logo_meta_box,
                'type'        => 'color',
                'name'        => 'mkdf_logo_text_color_meta',
                'label'       => esc_html__( 'Logo Text Color', 'wilmer' ),
                'description' => esc_html__( 'Choose color for your logo text', 'wilmer' ),
                'dependency' => array(
                    'hide' => array(
                        'mkdf_logo_source_meta'  => 'image'
                    )
                )
            )
        );

        wilmer_mikado_create_meta_box_field(
            array(
                'parent'      => $logo_meta_box,
                'type'        => 'text',
                'name'        => 'mkdf_logo_text_font_size_meta',
                'label'       => esc_html__( 'Logo Text Font Size', 'wilmer' ),
                'description' => esc_html__( 'Set font size for your logo text', 'wilmer' ),
                'dependency' => array(
                    'hide' => array(
                        'mkdf_logo_source_meta'  => 'image'
                    )
                ),
                'args' => array(
                    'col_width' => 3,
                    'suffix' => 'px'
                )
            )
        );

        wilmer_mikado_create_meta_box_field(
            array(
                'parent'      => $logo_meta_box,
                'type'        => 'color',
                'name'        => 'mkdf_logo_text_bg_color_meta',
                'label'       => esc_html__( 'Logo Text Background Color', 'wilmer' ),
                'description' => esc_html__( 'Choose background color for your logo text', 'wilmer' ),
                'dependency' => array(
                    'hide' => array(
                        'mkdf_logo_source_meta'  => 'image'
                    )
                )
            )
        );

        wilmer_mikado_create_meta_box_field(
            array(
                'parent'      => $logo_meta_box,
                'type'        => 'text',
                'name'        => 'mkdf_logo_text_side_padding_meta',
                'label'       => esc_html__( 'Logo Text Side Padding', 'wilmer' ),
                'description' => esc_html__( 'Enter side padding for your logo', 'wilmer' ),
                'dependency' => array(
                    'hide' => array(
                        'mkdf_logo_source_meta'  => 'image'
                    )
                ),
                'args' => array(
                    'col_width' => 3,
                    'suffix'    => 'px'
                )
            )
        );
    }

    add_action( 'wilmer_mikado_action_meta_boxes_map', 'wilmer_mikado_logo_meta_box_map', 47 );
}