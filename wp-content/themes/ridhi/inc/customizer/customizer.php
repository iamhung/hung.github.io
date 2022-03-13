<?php
/**
 * Ridhi Theme Customizer
 *
 * @package Ridhi
 */

/**
 * Requiring customizer panels & sections
*/
$ridhi_panels = array( 'info', 'site', 'appearance', 'layout', 'general', 'frontpage', 'footer' );

foreach( $ridhi_panels as $p ){
    require get_template_directory() . '/inc/customizer/' . $p . '.php';
}

/**
 * Sanitization Functions
*/
require get_template_directory() . '/inc/customizer/sanitization-functions.php';

/**
 * Active Callbacks
*/
require get_template_directory() . '/inc/customizer/active-callback.php';

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ridhi_customize_preview_js() {
	wp_enqueue_script( 'ridhi-customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), RIDHI_THEME_VERSION, true );
}
add_action( 'customize_preview_init', 'ridhi_customize_preview_js' );

function ridhi_customize_script(){
	$array = array(
        'home' => get_permalink( get_option( 'page_on_front' ) )
    );
    wp_enqueue_style( 'ridhi-customize', get_template_directory_uri() . '/inc/css/customize.css', array(), RIDHI_THEME_VERSION );
	wp_enqueue_script( 'ridhi-customize', get_template_directory_uri() . '/inc/js/customize.js', array( 'jquery', 'customize-controls' ), RIDHI_THEME_VERSION, true );
	wp_localize_script( 'ridhi-customize', 'ridhi_cdata', $array );
}
add_action( 'customize_controls_enqueue_scripts', 'ridhi_customize_script' );

/*
 * Notifications in customizer
 */
require get_template_directory() . '/inc/customizer-plugin-recommend/customizer-notice/class-customizer-notice.php';

require get_template_directory() . '/inc/customizer-plugin-recommend/plugin-install/class-plugin-install-helper.php';

require get_template_directory() . '/inc/customizer-plugin-recommend/plugin-install/class-plugin-recommend.php';

$config_customizer = array(
	'recommended_plugins' => array(
		//change the slug for respective plugin recomendation
        'ridhi-companion' => array(
			'recommended' => true,
			'description' => sprintf(
				/* translators: %s: plugin name */
				esc_html__( 'If you want to take full advantage of the features this theme has to offer, please install and activate %s plugin.', 'ridhi' ), '<strong>Ridhi Companion</strong>'
			),
		),
	),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'ridhi' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'ridhi' ),
	'activate_button_label'     => esc_html__( 'Activate', 'ridhi' ),
	'deactivate_button_label'   => esc_html__( 'Deactivate', 'ridhi' ),
);
Ridhi_Customizer_Notice::init( apply_filters( 'ridhi_customizer_notice_array', $config_customizer ) );