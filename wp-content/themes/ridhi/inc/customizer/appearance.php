<?php
/**
 * Ridhi Appearance Settings
 *
 * @package Ridhi
 */

function ridhi_customize_register_appearance( $wp_customize ) {
    
    /** Appearance Settings */
    $wp_customize->add_panel( 
        'appearance_settings',
         array(
            'priority'    => 50,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'Appearance Settings', 'ridhi' ),
            'description' => __( 'Customize Typography, Background Image & Color.', 'ridhi' ),
        ) 
    );
    
    /** Typography */
    $wp_customize->add_section(
        'typography_settings',
        array(
            'title'    => __( 'Typography', 'ridhi' ),
            'priority' => 20,
            'panel'    => 'appearance_settings',
        )
    );
    
    /** Primary Font */
    $wp_customize->add_setting(
		'primary_font',
		array(
			'default'			=> 'Nunito Sans',
			'sanitize_callback' => 'ridhi_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Ridhi_Select_Control(
    		$wp_customize,
    		'primary_font',
    		array(
                'label'	      => __( 'Primary Font', 'ridhi' ),
                'description' => __( 'Primary font of the site.', 'ridhi' ),
    			'section'     => 'typography_settings',
    			'choices'     => ridhi_get_all_fonts(),	
     		)
		)
	);
    
    /** Move Background Image section to appearance panel */
    $wp_customize->get_section( 'colors' )->panel              = 'appearance_settings';
    $wp_customize->get_section( 'colors' )->priority           = 10;
    $wp_customize->get_section( 'background_image' )->panel    = 'appearance_settings';
    $wp_customize->get_section( 'background_image' )->priority = 15;
    
}
add_action( 'customize_register', 'ridhi_customize_register_appearance' );