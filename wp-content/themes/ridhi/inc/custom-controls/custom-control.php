<?php
/**
 * Ridhi Custom Control
 * 
 * @package Ridhi
*/

if( ! function_exists( 'ridhi_register_custom_controls' ) ) :
/**
 * Register Custom Controls
*/
function ridhi_register_custom_controls( $wp_customize ){    
    // Load our custom control.
    require_once get_template_directory() . '/inc/custom-controls/note/class-note-control.php';
    require_once get_template_directory() . '/inc/custom-controls/radioimg/class-radio-image-control.php';
    require_once get_template_directory() . '/inc/custom-controls/select/class-select-control.php';
    require_once get_template_directory() . '/inc/custom-controls/slider/class-slider-control.php';
    require_once get_template_directory() . '/inc/custom-controls/toggle/class-toggle-control.php';
            
    // Register the control type.
    $wp_customize->register_control_type( 'Ridhi_Radio_Image_Control' );
    $wp_customize->register_control_type( 'Ridhi_Select_Control' );
    $wp_customize->register_control_type( 'Ridhi_Slider_Control' );
    $wp_customize->register_control_type( 'Ridhi_Toggle_Control' );
}
endif;
add_action( 'customize_register', 'ridhi_register_custom_controls' );