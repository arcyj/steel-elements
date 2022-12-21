<?php
namespace WilmerCore\CPT\Shortcodes\Accordion;

use WilmerCore\Lib;

class Accordion implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkdf_accordion';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Accordion', 'wilmer-core' ),
					'base'                    => $this->base,
					'as_parent'               => array( 'only' => 'mkdf_accordion_tab' ),
					'content_element'         => true,
					'category'                => esc_html__( 'by WILMER', 'wilmer-core' ),
					'icon'                    => 'icon-wpb-accordions extended-custom-icon',
					'show_settings_on_create' => true,
					'js_view'                 => 'VcColumnView',
					'params'                  => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'wilmer-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'wilmer-core' )
						),
                        array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_bg_pattern',
							'heading'     => esc_html__( 'Enable Background Pattern', 'wilmer-core' ),
							'description' => esc_html__( 'Enable this option if you want to have default theme pattern applied as background of accordion', 'wilmer-core' ),
                            'value'       => array_flip(wilmer_mikado_get_yes_no_select_array(false, false))
						),
                        array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_accordion_number',
							'heading'     => esc_html__( 'Enable Accordion Order Number', 'wilmer-core' ),
							'description' => esc_html__( 'Enabling this option will show order number before each accordion', 'wilmer-core' ),
                            'value'       => array_flip(wilmer_mikado_get_yes_no_select_array(false, false))
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'style',
							'heading'    => esc_html__( 'Style', 'wilmer-core' ),
							'value'      => array(
								esc_html__( 'Accordion', 'wilmer-core' ) => 'accordion',
								esc_html__( 'Toggle', 'wilmer-core' )    => 'toggle'
							)
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'layout',
							'heading'    => esc_html__( 'Layout', 'wilmer-core' ),
							'value'      => array(
								esc_html__( 'Boxed', 'wilmer-core' )  => 'boxed',
								esc_html__( 'Simple', 'wilmer-core' ) => 'simple'
							)
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'background_skin',
							'heading'    => esc_html__( 'Background Skin', 'wilmer-core' ),
							'value'      => array(
								esc_html__( 'Default', 'wilmer-core' ) => '',
								esc_html__( 'White', 'wilmer-core' )   => 'white',
                                esc_html__( 'Dark', 'wilmer-core' )   => 'dark'
							),
							'dependency' => array( 'element' => 'layout', 'value' => array( 'boxed', 'simple' ) )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'custom_class'    => '',
			'enable_bg_pattern'    => 'no',
			'enable_accordion_number' => 'no',
			'title'           => '',
			'style'           => 'accordion',
			'layout'          => 'boxed',
			'background_skin' => '',
            'title_color'     => ''
		);
		$params       = shortcode_atts( $default_atts, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['content']        = $content;
		
		$output = wilmer_core_get_shortcode_module_template_part( 'templates/accordion-holder-template', 'accordions', '', $params );
		
		return $output;
	}
	
	private function getHolderClasses( $params ) {
		$holder_classes = array( 'mkdf-ac-default' );
		
		$holder_classes[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holder_classes[] = $params['style'] == 'toggle' ? 'mkdf-toggle' : 'mkdf-accordion';
		$holder_classes[] = ! empty( $params['layout'] ) ? 'mkdf-ac-' . esc_attr( $params['layout'] ) : '';
		$holder_classes[] = ! empty( $params['background_skin'] ) ? 'mkdf-' . esc_attr( $params['background_skin'] ) . '-skin' : '';
		$holder_classes[] = $params['enable_bg_pattern'] == 'yes' ? 'mkdf-ac-with-bg-pattern' : '';
		$holder_classes[] = $params['enable_accordion_number'] == 'yes' ? 'mkdf-ac-with-order-number' : '';

		return implode( ' ', $holder_classes );
	}
}
