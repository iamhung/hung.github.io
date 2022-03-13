<?php
/**
 * Array of customizer settings, controls and outputs
 *
 * @package Cordero
 */
if ( !function_exists( 'cordero_customizer_array' ) ) {
	function cordero_customizer_array() {
		return array(

			'accent_color' => array(
				'type' => 'setting',
				'default' => '#d82978',
				'transport' => 'postMessage',
				'sanitize' => 'sanitize_hex_color',
					'control' => 'color',
					'label' => __( 'Accent Color', 'cordero' ),
					'description' => __( 'Links, buttons', 'cordero' ),
					'section' => 'colors',
					'priority' => '',
			),

			'accent_color2' => array(
				'type' => 'setting',
				'default' => '#2d2354',
				'transport' => 'postMessage',
				'sanitize' => 'sanitize_hex_color',
					'control' => 'color',
					'label' => __( 'Color 2', 'cordero' ),
					'description' => __( 'Background: transparent header on scrolling, footer', 'cordero' ),
					'section' => 'colors',
					'priority' => '',
			),

			'accent_color3' => array(
				'type' => 'setting',
				'default' => '#fbfbfb',
				'transport' => 'postMessage',
				'sanitize' => 'sanitize_hex_color',
					'control' => 'color',
					'label' => __( 'Color 3', 'cordero' ),
					'description' => __( 'Background: blog posts (not plain style), sidebar, page numbers, forms, tables', 'cordero' ),
					'section' => 'colors',
					'priority' => '',
			),

			'layout_options' => array(
				'type' => 'section',
				'label' => __( 'Layout Options', 'cordero' ),
				'description' => '',
				'priority' => 26,
			),

			'blog_options' => array(
				'type' => 'section',
				'label' => __( 'Blog Options', 'cordero' ),
				'description' => '',
				'priority' => 28,
			),

			'container_width' => array(
				'type' => 'setting',
				'default' => '1240',
				'transport' => 'postMessage',
				'sanitize' => 'absint',
					'control' => 'number',
					'label' => __( 'Container Width', 'cordero' ),
					'description' => '',
					'section' => 'layout_options',
					'attrs' => array(
                		'min'   => 1120,
                		'max'   => 2560,
                		'step'  => 1,
                	),
			),

			'header_search_off' => array(
				'type' => 'setting',
				'default' => 0,
				'transport' => 'postMessage',
				'sanitize' => 'cordero_sanitize_checkbox',
					'control' => 'checkbox',
					'label' => __( 'Disable Search Form in Header', 'cordero' ),
					'description' => '',
					'section' => 'layout_options',
					'priority' => 23,
			),

		);
	}
}


/**
 * Return customizer settings and controls
 */
if ( !function_exists( 'cordero_customizer_controls' ) ) {
	function cordero_customizer_controls() {

		global $wp_customize;

		$controls = cordero_customizer_array();

		foreach ( $controls as $control => $value ) {

			if ( $value['type'] == 'section' ) {

				$wp_customize->add_section(
					$control,
					array(
						'title'		=> $value['label'],
						'description'=> $value['description'],
						'priority'	=> $value['priority'],
					)
				);

			} elseif ( $value['type'] == 'setting' ) {

				$wp_customize->add_setting(
					$control,
					array(
						'default'			=> $value['default'],
						'transport'			=> $value['transport'],
						'sanitize_callback' => $value['sanitize'],
					)
				);

				if ( $value['control'] == 'color' ) {

					$wp_customize->add_control( 
						new WP_Customize_Color_Control(
							$wp_customize,
							$control,
							array( 
								'settings'   => $control,
								'section'    => $value['section'],
								'label'      => $value['label'],
								'description'=> $value['description'],
							)
						)
					);
				
				} elseif ( $value['control'] == 'number' ) {

					$wp_customize->add_control(
						$control,
						array(
							'settings'		=> $control,
							'section'    => $value['section'],
							'label'      => $value['label'],
							'description'=> $value['description'],
							'type'       => 'number',
							'input_attrs' => $value['attrs'],
						)
					);

				} elseif ( $value['control'] == 'checkbox' ) {

					$wp_customize->add_control(
						$control,
						array(
							'settings'		=> $control,
							'section'    => $value['section'],
							'label'      => $value['label'],
							'description'=> $value['description'],
							'type'       => 'checkbox',
							'priority'   => $value['priority'],
						)
					);

				}	
			
			}
		
		}

	}
}
