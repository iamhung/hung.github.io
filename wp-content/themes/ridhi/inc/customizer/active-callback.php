<?php
/**
 * Active Callback
 * 
 * @package Ridhi
*/

/**
 * Active Callback for Banner Slider
*/
function ridhi_banner_ac( $control ){
    $banner      = $control->manager->get_setting( 'ed_banner_section' )->value();
    $slider_type = $control->manager->get_setting( 'slider_type' )->value();
    $control_id  = $control->id;
    
    if ( $control_id == 'header_image' && $banner == 'static_nl_banner' ) return true;
    if ( $control_id == 'banner_newsletter' && $banner == 'static_nl_banner' ) return true;
    if ( $control_id == 'newsletter_recommend' && $banner == 'static_nl_banner' ) return true;
    
    if ( $control_id == 'slider_type' && $banner == 'slider_banner' ) return true;          
    if ( $control_id == 'slider_animation' && $banner == 'slider_banner' ) return true;    
    if ( $control_id == 'slider_cat' && $banner == 'slider_banner' && $slider_type == 'cat' ) return true;
    if ( $control_id == 'no_of_slides' && $banner == 'slider_banner' && $slider_type == 'latest_posts' ) return true;
    
    return false;
}