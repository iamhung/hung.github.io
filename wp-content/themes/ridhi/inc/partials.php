<?php
/**
 * Ridhi Customizer Partials
 *
 * @package Ridhi
 */

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function ridhi_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function ridhi_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

if( ! function_exists( 'ridhi_get_blog_title' ) ) :
/**
 * Blog Title
 */
function ridhi_get_blog_title(){
    return esc_html( get_theme_mod( 'blog_section_title', __( 'Latest Articles', 'ridhi' ) ) );
}
endif;

if( ! function_exists( 'ridhi_get_blog_subtitle' ) ) :
/**
 * Blog Subtitle
 */
function ridhi_get_blog_subtitle(){
    return wp_kses_post( get_theme_mod( 'blog_section_subtitle', __( 'Show your latest blog posts here. You can modify this section from Appearance > Customize > Front Page Settings > Blog Section.', 'ridhi' ) ) );
}
endif;

if( ! function_exists( 'ridhi_get_related_title' ) ) :
/**
 * Display blog readmore button
*/
function ridhi_get_related_title(){
    return esc_html( get_theme_mod( 'related_post_title', __( 'You may also like...', 'ridhi' ) ) );
}
endif;

if( ! function_exists( 'ridhi_get_footer_copyright' ) ) :
/**
 * Footer Copyright
*/
function ridhi_get_footer_copyright(){
    $copyright = get_theme_mod( 'footer_copyright' );
    echo '<span class="copyright">';
    if( $copyright ){
        echo wp_kses_post( $copyright );
    }else{
        esc_html_e( '&copy; Copyright ', 'ridhi' );
        echo date_i18n( esc_html__( 'Y', 'ridhi' ) );
        echo ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>. ';
        esc_html_e( 'All Rights Reserved. ', 'ridhi' );
    }
    echo '</span>'; 
}
endif;