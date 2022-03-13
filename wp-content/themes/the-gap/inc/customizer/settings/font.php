<?php
	
/*
*
* All font related settings and controls
*
*/


	
$body_font = the_gap_get_body_font_family_mod();
//Primary Fonts
$wp_customize->add_setting(
        'site-primary-font-family',
        array(
            'default' => $body_font,
            'sanitize_callback' => 'the_gap_sanitize_text2',
			'transport'         => 'postMessage'
        )
);
	

    $wp_customize->add_control(new The_Gap_Custom_Font_Control(
		$wp_customize,
        'site-primary-font-family',
        array(
            'label' => __( 'Site Body Font Family', 'the-gap' ),
            'section' => 'general',
            
            'priority' => 110,
			'type' => 'nl-font-family',
			
            )
		)
    );
	
	
	if ( !class_exists('The_Gap_Pro')) { 
	
	$wp_customize->add_setting(
        'site-title-font-family',
        array(
            'default' => 'Poiret One',
            'sanitize_callback' => 'the_gap_sanitize_text2',
			'transport'         => 'refresh'
        )
	);
	

    $wp_customize->add_control(new The_Gap_Custom_Font_Control(
		$wp_customize,
        'site-title-font-family',
        array(
            'label' => __( 'Site Title Font Family', 'the-gap' ),
            'section' => 'header_image',
            
            'priority' => 73,
			'type' => 'nl-font-family',
			
            )
		)
    );
	
	}
	
	
	