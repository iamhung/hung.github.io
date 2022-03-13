<?php
/**
 * Cordero Theme Customizer
 *
 * @package Cordero
 */

/**
 * @param WP_Customize_Manager $wp_customize Theme Customizer object
 */
function cordero_customize_register( $wp_customize ) {
	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('custom_logo')->transport      = 'postMessage';

	$wp_customize->add_setting(
		'logo_transparent_header',
		array(
			'default'			=> '',
			'sanitize_callback' => 'absint',
		)
	);
	$cordero_custom_logo_args = get_theme_support( 'custom-logo' );
	$wp_customize->add_control(
		new WP_Customize_Cropped_Image_Control(
			$wp_customize,
			'logo_transparent_header',
			array(
				'label'			=> esc_html__( 'Logo - Transparent Header', 'cordero' ),
                'description'	=> esc_html__( 'The logo on the **Transparent Header** page template. If empty, main logo is displayed.', 'cordero' ),
				'section'       => 'title_tagline',
				'priority'      => 9,
				'height'        => isset( $cordero_custom_logo_args[0]['height'] ) ? $cordero_custom_logo_args[0]['height'] : null,
				'width'         => isset( $cordero_custom_logo_args[0]['width'] ) ? $cordero_custom_logo_args[0]['width'] : null,
				'flex_height'   => isset( $cordero_custom_logo_args[0]['flex-height'] ) ? $cordero_custom_logo_args[0]['flex-height'] : null,
				'flex_width'    => isset( $cordero_custom_logo_args[0]['flex-width'] ) ? $cordero_custom_logo_args[0]['flex-width'] : null,
				'button_labels' => array(
					'select'       => esc_html__( 'Select logo', 'cordero' ),
					'change'       => esc_html__( 'Change logo', 'cordero' ),
					'remove'       => esc_html__( 'Remove', 'cordero' ),
					'default'      => esc_html__( 'Default', 'cordero' ),
					'placeholder'  => esc_html__( 'No logo selected', 'cordero' ),
					'frame_title'  => esc_html__( 'Select logo', 'cordero' ),
					'frame_button' => esc_html__( 'Choose logo', 'cordero' ),
				),
			)
		)
	);

	$wp_customize->add_setting(
		'hide_tagline',
		array(
			'default'			=> 0,
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'cordero_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
			'hide_tagline',
			array(
				'settings'		=> 'hide_tagline',
				'section'		=> 'title_tagline',
				'label'			=> esc_html__( 'Hide Tagline', 'cordero' ),
				'type'       	=> 'checkbox',
			)
	);

	$wp_customize->add_setting(
		'site_title_style',
		array(
			'default'			=> 'border',
			'transport'			=> 'postMessage',
			'sanitize_callback'	=> 'cordero_sanitize_choices',
		)
	);
	$wp_customize->add_control(
		'site_title_style',
		array(
			'label'		=> esc_html__( 'Site Title Style', 'cordero' ),
			'description'		=> esc_html__( 'Applies to textual Site Title only, not custom logo.', 'cordero' ),
			'type'		=> 'select',
			'section'	=> 'title_tagline',
			'choices'	=> array(
				'border'	=> esc_html__( 'With Border', 'cordero' ),
				'stfls'	=> esc_html__( 'Highlight 1st Letter', 'cordero' ),
				'background'	=> esc_html__( 'With Background', 'cordero' ),
				'no-styling'	=> esc_html__( 'No Styling', 'cordero' ),
			),
		)
	);

	$wp_customize->add_setting(
		'heading_schema',
		array(
			'default'			=> '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control(
		new Cordero_Customize_Heading_Large(
			$wp_customize,
			'heading_schema',
			array(
				'settings'		=> 'heading_schema',
				'section'		=> 'title_tagline',
				'label'			=> esc_html__( 'Schema Markup', 'cordero' ),
				'priority'		=> 100
			)
		)
	);

	$wp_customize->add_setting(
		'schema_off',
		array(
			'default'			=> 0,
			'sanitize_callback' => 'cordero_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
			'schema_off',
			array(
				'settings'		=> 'schema_off',
				'section'		=> 'title_tagline',
				'label'			=> esc_html__( 'Remove Schema Tags', 'cordero' ),
				'type'       	=> 'checkbox',
				'priority'		=> 101
			)
	);

	$wp_customize->add_setting(
		'header_image_helper',
		array(
			'default'			=> '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control(
		new Cordero_Customize_Heading_Small(
			$wp_customize,
			'header_image_helper',
			array(
				'settings'		=> 'header_image_helper',
				'section'		=> 'header_image',
				'label'			=> esc_html__( 'Note: header image is not displayed on the **Transparent Header** page template.', 'cordero' )
			)
		)
	);

	cordero_customizer_controls();

	// Section - Layout Options
	$wp_customize->add_setting(
		'heading_header',
		array(
			'default'			=> '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control(
		new Cordero_Customize_Heading_Large(
			$wp_customize,
			'heading_header',
			array(
				'settings'		=> 'heading_header',
				'section'		=> 'layout_options',
				'label'			=> esc_html__( 'Header', 'cordero' ),
				'priority'		=> 20
			)
		)
	);

	$wp_customize->add_setting(
		'header_layout',
		array(
			'default'			=> '',
			'sanitize_callback' => 'cordero_sanitize_radio_select'
		)
	);
	$wp_customize->add_control(
		new Cordero_Image_Radio_Control(
		$wp_customize,
		'header_layout',
		array(
			'type' => 'radio',
			'label' => esc_html__( 'Layout', 'cordero' ),
			'section' => 'layout_options',
			'settings' => 'header_layout',
			'priority' => 21,
			'choices' => array(
				'' => esc_url( get_template_directory_uri() ) . '/images/header-standard.png',
				'logo-below' => esc_url( get_template_directory_uri() ) . '/images/header-logo-below.png',
				'logo-left' => esc_url( get_template_directory_uri() ) . '/images/header-logo-left.png',
				'logo-right' => esc_url( get_template_directory_uri() ) . '/images/header-logo-right.png',
				'masthead-left' => esc_url( get_template_directory_uri() ) . '/images/header-masthead-left.png',
				)
			)
		)
	);

	$wp_customize->add_setting(
		'sticky_header_off',
		array(
			'default'			=> 0,
			'sanitize_callback' => 'cordero_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
		'sticky_header_off',
		array(
			'settings'		=> 'sticky_header_off',
			'section'		=> 'layout_options',
			'label'			=> esc_html__( 'Disable Fixed Header', 'cordero' ),
			'type'       	=> 'checkbox',
			'priority'		=> 22,
		)
	);

	$wp_customize->add_setting(
		'heading_sidebar',
		array(
			'default'			=> '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control(
		new Cordero_Customize_Heading_Large(
			$wp_customize,
			'heading_sidebar',
			array(
				'settings'		=> 'heading_sidebar',
				'section'		=> 'layout_options',
				'label'			=> esc_html__( 'Sidebar', 'cordero' ),
				'priority'		=> 30,
			)
		)
	);

	$wp_customize->add_setting(
		'sidebar_position',
		array(
			'default'			=> 'right',
			'sanitize_callback'	=> 'cordero_sanitize_choices',
		)
	);
	$wp_customize->add_control(
		'sidebar_position',
		array(
			'label'		=> esc_html__( 'Position', 'cordero' ),
			'type'		=> 'select',
			'section'	=> 'layout_options',
			'choices'	=> array(
				'left'	=> esc_html__( 'Left', 'cordero' ),
				'right'	=> esc_html__( 'Right', 'cordero' ),
				'below'	=> esc_html__( 'Bottom (below content)', 'cordero' ),
			),
			'priority'	=> 31,
		)
	);

	$wp_customize->add_setting(
		'heading_footer',
		array(
			'default'			=> '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control(
		new Cordero_Customize_Heading_Large(
			$wp_customize,
			'heading_footer',
			array(
				'settings'		=> 'heading_footer',
				'section'		=> 'layout_options',
				'label'			=> esc_html__( 'Footer', 'cordero' ),
				'priority'		=> 40,
			)
		)
	);

	$wp_customize->add_setting(
		'footer_layout',
		array(
			'default'			=> '',
			'sanitize_callback' => 'cordero_sanitize_radio_select'
		)
	);
	$wp_customize->add_control(
		new Cordero_Image_Radio_Control(
			$wp_customize,
			'footer_layout',
			array(
				'type' => 'radio',
				'label' => esc_html__( 'Footer Layout', 'cordero' ),
				'section' => 'layout_options',
				'settings' => 'footer_layout',
				'choices' => array(
					'' => esc_url( get_template_directory_uri() ) . '/images/footer-standard.png',
					'info-right' => esc_url( get_template_directory_uri() ) . '/images/footer-info-right.png',
					'centered' => esc_url( get_template_directory_uri() ) . '/images/footer-centered.png',
					'centered-info-below' => esc_url( get_template_directory_uri() ) . '/images/footer-centered-info-below.png',
				),
				'priority' => 41
			)
		)
	);

	$wp_customize->add_setting(
		'sticky_footer',
		array(
			'default'			=> 0,
			'sanitize_callback' => 'cordero_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
		'sticky_footer',
		array(
			'settings'		=> 'sticky_footer',
			'section'		=> 'layout_options',
			'label'			=> esc_html__( 'Enable Sticky Footer', 'cordero' ),
			'description'	=> esc_html__( 'On pages with little or no content, the footer will appear at the bottom of the page.', 'cordero' ),
			'type'       	=> 'checkbox',
			'priority'		=> 42,
		)
	);


	// Section - Blog Options
	$wp_customize->add_setting(
		'heading_blog_archive',
		array(
			'default'			=> '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control(
		new Cordero_Customize_Heading_Large(
			$wp_customize,
			'heading_blog_archive',
			array(
				'settings'		=> 'heading_blog_archive',
				'section'		=> 'blog_options',
				'label'			=> esc_html__( 'Archives', 'cordero' ),
				'description'	=> esc_html__( 'Blog page, post archives, related posts', 'cordero' ),
			)
		)
	);

	$wp_customize->add_setting(
		'blog_columns',
		array(
			'default'			=> '2',
			'sanitize_callback'	=> 'cordero_sanitize_choices',
		)
	);
	$wp_customize->add_control(
		'blog_columns',
		array(
			'label'		=> esc_html__( 'Columns (posts per row)', 'cordero' ),
			'type'		=> 'select',
			'section'	=> 'blog_options',
			'choices'	=> array(
				'1'	=> esc_html__( '1', 'cordero' ),
				'2'	=> esc_html__( '2', 'cordero' ),
				'3'	=> esc_html__( '3', 'cordero' ),
				'4'	=> esc_html__( '4', 'cordero' ),
			),
		)
	);

	$wp_customize->add_setting(
		'blog_post_style',
		array(
			'default'			=> 'plain',
			'sanitize_callback'	=> 'cordero_sanitize_choices',
		)
	);
	$wp_customize->add_control(
		'blog_post_style',
		array(
			'label'		=> esc_html__( 'Post Style', 'cordero' ),
			'type'		=> 'select',
			'section'	=> 'blog_options',
			'choices'	=> array(
				'plain'	=> esc_html__( 'Plain', 'cordero' ),
				'border'	=> esc_html__( 'Bordered', 'cordero' ),
				'shadow'	=> esc_html__( 'Box Shadow', 'cordero' ),
			),
		)
	);

	$wp_customize->add_setting(
		'excerpt_length',
		array(
			'default'			=> '20',
			'sanitize_callback' => 'absint'
		)
	);
	$wp_customize->add_control(
		'excerpt_length',
		array(
			'settings'		=> 'excerpt_length',
			'section'		=> 'blog_options',
			'label'			=> esc_html__( 'Excerpt Word Length', 'cordero' ),
			'type'       	=> 'number',
			'input_attrs' => array(
            'min'   => 1,
            'max'   => 255,
            'step'  => 1,
        ),
		)
	);

	$wp_customize->add_setting(
		'post_spacing',
		array(
			'default'			=> 'space-between',
			'sanitize_callback'	=> 'cordero_sanitize_choices',
		)
	);
	$wp_customize->add_control(
		'post_spacing',
		array(
			'label'		=> esc_html__( 'Post Content Vertical Alignment', 'cordero' ),
			'type'		=> 'select',
			'section'	=> 'blog_options',
			'choices'	=> array(
				'normal'	=> esc_html__( 'Normal', 'cordero' ),
				'space-between'	=> esc_html__( 'Space Between', 'cordero' ),
				'space-around'	=> esc_html__( 'Space Around', 'cordero' ),
				'space-evenly'	=> esc_html__( 'Space Evenly', 'cordero' ),
				'center'	=> esc_html__( 'Centered', 'cordero' ),
				'end'	=> esc_html__( 'Bottom', 'cordero' ),
			),
		)
	);

	$wp_customize->add_setting(
		'disable_author',
		array(
			'default'			=> 0,
			'sanitize_callback' => 'cordero_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
		'disable_author',
		array(
			'settings'		=> 'disable_author',
			'section'		=> 'blog_options',
			'label'			=> esc_html__( 'Remove Author', 'cordero' ),
			'type'       	=> 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'disable_date',
		array(
			'default'			=> 0,
			'sanitize_callback' => 'cordero_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
		'disable_date',
		array(
			'settings'		=> 'disable_date',
			'section'		=> 'blog_options',
			'label'			=> esc_html__( 'Remove Date', 'cordero' ),
			'type'       	=> 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'disable_cats',
		array(
			'default'			=> 0,
			'sanitize_callback' => 'cordero_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
		'disable_cats',
		array(
			'settings'		=> 'disable_cats',
			'section'		=> 'blog_options',
			'label'			=> esc_html__( 'Remove Categories', 'cordero' ),
			'type'       	=> 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'disable_tags',
		array(
			'default'			=> 0,
			'sanitize_callback' => 'cordero_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
		'disable_tags',
		array(
			'settings'		=> 'disable_tags',
			'section'		=> 'blog_options',
			'label'			=> esc_html__( 'Remove Tags', 'cordero' ),
			'type'       	=> 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'disable_readmore',
		array(
			'default'			=> 0,
			'sanitize_callback' => 'cordero_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
		'disable_readmore',
		array(
			'settings'		=> 'disable_readmore',
			'section'		=> 'blog_options',
			'label'			=> esc_html__( 'Remove Read More Link', 'cordero' ),
			'type'       	=> 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'disable_img',
		array(
			'default'			=> 0,
			'sanitize_callback' => 'cordero_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
		'disable_img',
		array(
			'settings'		=> 'disable_img',
			'section'		=> 'blog_options',
			'label'			=> esc_html__( 'Remove Featured Image', 'cordero' ),
			'type'       	=> 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'readmore_text',
		array(
			'default'			=> '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control(
		'readmore_text',
		array(
			'settings'		=> 'readmore_text',
			'section'		=> 'blog_options',
			'type'			=> 'text',
			'label'			=> esc_html__( 'Read More Text', 'cordero' ),
		)
	);

	$wp_customize->add_setting(
		'archive_img_size',
		array(
			'default'			=> 'large',
			'sanitize_callback'	=> 'cordero_sanitize_choices',
		)
	);
	$wp_customize->add_control(
		'archive_img_size',
		array(
			'label'		=> esc_html__( 'Featured Image Size', 'cordero' ),
			'description'	=> esc_html__( 'See: "Settings" > "Media" (or any active plugins that control image sizes)', 'cordero' ),
			'type'		=> 'select',
			'section'	=> 'blog_options',
			'choices' => cordero_image_size_options(),
		)
	);

	$wp_customize->add_setting(
		'featured_image',
		array(
			'default'			=> '',
			'sanitize_callback' => 'esc_url_raw'
		)
	);
	$wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'featured_image',
           array(
               'label'       => esc_html__( 'Featured Image Placeholder', 'cordero' ),
               'description' => esc_html__( 'Displays where a post does not have a Featured Image', 'cordero' ),
               'section'     => 'blog_options',
               'settings'    => 'featured_image',
           )
       )
    );


	$wp_customize->add_setting(
		'heading_blog_single',
		array(
			'default'			=> '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control(
		new Cordero_Customize_Heading_Large(
			$wp_customize,
			'heading_blog_single',
			array(
				'settings'		=> 'heading_blog_single',
				'section'		=> 'blog_options',
				'label'			=> esc_html__( 'Single Posts', 'cordero' ),
			)
		)
	);

	$wp_customize->add_setting(
		'disable_img_single',
		array(
			'default'			=> 0,
			'sanitize_callback' => 'cordero_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
		'disable_img_single',
		array(
			'settings'		=> 'disable_img_single',
			'section'		=> 'blog_options',
			'label'			=> esc_html__( 'Remove Featured Image', 'cordero' ),
			'type'       	=> 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'disable_author_single',
		array(
			'default'			=> 0,
			'sanitize_callback' => 'cordero_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
		'disable_author_single',
		array(
			'settings'		=> 'disable_author_single',
			'section'		=> 'blog_options',
			'label'			=> esc_html__( 'Remove Author', 'cordero' ),
			'type'       	=> 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'disable_date_single',
		array(
			'default'			=> 0,
			'sanitize_callback' => 'cordero_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
		'disable_date_single',
		array(
			'settings'		=> 'disable_date_single',
			'section'		=> 'blog_options',
			'label'			=> esc_html__( 'Remove Date', 'cordero' ),
			'type'       	=> 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'disable_cats_single',
		array(
			'default'			=> 0,
			'sanitize_callback' => 'cordero_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
		'disable_cats_single',
		array(
			'settings'		=> 'disable_cats_single',
			'section'		=> 'blog_options',
			'label'			=> esc_html__( 'Remove Categories', 'cordero' ),
			'type'       	=> 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'disable_tags_single',
		array(
			'default'			=> 0,
			'sanitize_callback' => 'cordero_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
		'disable_tags_single',
		array(
			'settings'		=> 'disable_tags_single',
			'section'		=> 'blog_options',
			'label'			=> esc_html__( 'Remove Tags', 'cordero' ),
			'type'       	=> 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'disable_prevnext',
		array(
			'default'			=> 0,
			'sanitize_callback' => 'cordero_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
		'disable_prevnext',
		array(
			'settings'		=> 'disable_prevnext',
			'section'		=> 'blog_options',
			'label'			=> esc_html__( 'Remove Previous and Next Links', 'cordero' ),
			'type'       	=> 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'disable_related',
		array(
			'default'			=> 0,
			'sanitize_callback' => 'cordero_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
		'disable_related',
		array(
			'settings'		=> 'disable_related',
			'section'		=> 'blog_options',
			'label'			=> esc_html__( 'Remove Related Posts', 'cordero' ),
			'type'       	=> 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'single_img_size',
		array(
			'default'			=> 'full',
			'sanitize_callback'	=> 'cordero_sanitize_choices',
		)
	);
	$wp_customize->add_control(
		'single_img_size',
		array(
			'label'		=> esc_html__( 'Featured Image Size', 'cordero' ),
			'description'	=> esc_html__( 'See: "Settings" > "Media" (or any active plugins that control image sizes)', 'cordero' ),
			'type'		=> 'select',
			'section'	=> 'blog_options',
			'choices' => cordero_image_size_options(),
		)
	);

	$wp_customize->add_setting(
		'related_posts',
		array(
			'default'			=> '4',
			'sanitize_callback'	=> 'cordero_sanitize_choices',
		)
	);
	$wp_customize->add_control(
		'related_posts',
		array(
			'label'		=> esc_html__( 'Number of Related Posts', 'cordero' ),
			'type'		=> 'select',
			'section'	=> 'blog_options',
			'choices'	=> array(
				'1'	=> esc_html__( '1', 'cordero' ),
				'2'	=> esc_html__( '2', 'cordero' ),
				'3'	=> esc_html__( '3', 'cordero' ),
				'4'	=> esc_html__( '4', 'cordero' ),
				'5'	=> esc_html__( '5', 'cordero' ),
				'6'	=> esc_html__( '6', 'cordero' ),
				'7'	=> esc_html__( '7', 'cordero' ),
				'8'	=> esc_html__( '8', 'cordero' ),
			),
		)
	);

	$wp_customize->add_setting(
		'reading_width',
		array(
			'default'			=> '640',
			'sanitize_callback' => 'absint'
		)
	);
	$wp_customize->add_control(
		'reading_width',
		array(
			'settings'		=> 'reading_width',
			'section'		=> 'blog_options',
			'label'			=> esc_html__( 'Reading View Template Width', 'cordero' ),
			'description'	=> esc_html__( 'The maximum width of the content when using the **Reading View** post template. Note: will not display wider than the main container.', 'cordero' ),
			'type'       	=> 'number',
			'input_attrs' => array(
            'min'   => 100,
            'max'   => 1920,
            'step'  => 1,
        ),
		)
	);


	// SECTION - Typography
	$wp_customize->add_section(
		'typography',
		array(
			'title'		=> esc_html__( 'Typography & Fonts', 'cordero' ),
			'priority'	=> 42,
		)
	);

	// Setting - Font - Header
	$wp_customize->add_setting( 'font_site_title', array(
		'default'           => 'Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i',
		'transport'			=> 'postMessage',
		'sanitize_callback' => 'cordero_sanitize_choices',
	) );
	$wp_customize->add_control( 'font_site_title', array(
		'label'   => esc_html__( 'Site Title', 'cordero' ),
		'type'    => 'select',
		'section' => 'typography',
		'choices' => cordero_google_fonts_array(),
	) );

	// Setting - Font - Navigation
	$wp_customize->add_setting( 'font_nav', array(
		'default'           => 'Work Sans:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i',
		'transport'			=> 'postMessage',
		'sanitize_callback' => 'cordero_sanitize_choices',
	) );
	$wp_customize->add_control( 'font_nav', array(
		'label'   => esc_html__( 'Navigation', 'cordero' ),
		'type'    => 'select',
		'section' => 'typography',
		'choices' => cordero_google_fonts_array(),
	) );

	// Setting - Font - Content
	$wp_customize->add_setting( 'font_content', array(
		'default'           => 'Work Sans:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i',
		'transport'			=> 'postMessage',
		'sanitize_callback' => 'cordero_sanitize_choices',
	) );
	$wp_customize->add_control( 'font_content', array(
		'label'   => esc_html__( 'Content', 'cordero' ),
		'type'    => 'select',
		'section' => 'typography',
		'choices' => cordero_google_fonts_array(),
	) );

	// Setting - Font - Headings
	$wp_customize->add_setting( 'font_headings', array(
		'default'           => 'Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i',
		'transport'			=> 'postMessage',
		'sanitize_callback' => 'cordero_sanitize_choices',
	) );
	$wp_customize->add_control( 'font_headings', array(
		'label'   => esc_html__( 'Headings', 'cordero' ),
		'type'    => 'select',
		'section' => 'typography',
		'choices' => cordero_google_fonts_array(),
	) );

	$wp_customize->add_setting(
		'fs_base',
		array(
			'default'			=> '16',
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'absint'
		)
	);
	$wp_customize->add_control(
			'fs_base',
			array(
				'settings'		=> 'fs_base',
				'section'		=> 'typography',
				'label'			=> esc_html__( 'Base Font Size', 'cordero' ),
				'type'       	=> 'number',
				'input_attrs' => array(
                'min'   => 10,
                'max'   => 40,
                'step'  => 1,
            ),
			)
	);

	$wp_customize->add_setting(
		'menu_uppercase',
		array(
			'default'			=> 'uppercase',
			'transport'			=> 'postMessage',
			'sanitize_callback'	=> 'cordero_sanitize_choices',
		)
	);
	$wp_customize->add_control(
		'menu_uppercase',
		array(
			'label'		=> esc_html__( 'Menu Text Style', 'cordero' ),
			'type'		=> 'select',
			'section'	=> 'typography',
			'choices'	=> array(
				'uppercase'	=> esc_html__( 'UPPERCASE', 'cordero' ),
				'none'	=> esc_html__( 'Normal', 'cordero' ),
			),
		)
	);

	// Section - Go Pro
	$wp_customize->add_section( 'go_pro_sec' , array(
		'title'      => esc_html__( 'Go Pro', 'cordero' ),
		'priority'   => 1,
		'description' => esc_html__( 'Upgrade to Cordero Pro for even more cool features and customization options.', 'cordero' ),
	) );
	$wp_customize->add_control(
		new Cordero_Customize_Extra_Control(
			$wp_customize,
			'go_pro',
			array(
				'section'   => 'go_pro_sec',
				'type'      => 'pro-link',
				'label'		=> esc_html__( 'Go Pro', 'cordero' ),
				'url'		=> 'https://uxlthemes.com/theme/cordero-pro/',
				'priority'	=> 10
			)
		)
	);

}
add_action('customize_register', 'cordero_customize_register');


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cordero_customize_preview_js() {
	wp_enqueue_script('cordero-customizer-preview', get_template_directory_uri() . '/functions/js/customizer-preview.js', array('customize-preview'), '1.0', true );
}
add_action('customize_preview_init', 'cordero_customize_preview_js');


function cordero_customizer_script() {
	wp_enqueue_script('cordero-customizer-script', get_template_directory_uri() .'/functions/js/customizer-script.js', array('jquery'),'', true  );
	wp_enqueue_style('cordero-customizer-style', get_template_directory_uri() .'/functions/css/customizer-style.css');	
}
add_action('customize_controls_enqueue_scripts', 'cordero_customizer_script');


if( class_exists('WP_Customize_Control') ):

class Cordero_Image_Radio_Control extends WP_Customize_Control {

	public function render_content() {

		if ( empty( $this->choices ) )
			return;

		$name = '_customize-radio-' . $this->id;

		?>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php if ( $this->description ) {
			echo '<span class="customize-control-description">' . esc_html( $this->description ) . '</span>';
		}
		?>
		<ul class="controls cordero-img-container" id='cordero-img-container-<?php echo $this->id; ?>'>
		<?php
		foreach ( $this->choices as $value => $label ) :
			$class = ($this->value() == $value)?'cordero-radio-img-selected cordero-radio-img-img':'cordero-radio-img-img';
			?>
			<li>
				<label>
					<input <?php $this->link(); ?>style='display:none' type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
					<img src = '<?php echo esc_attr( $label ); ?>' class = '<?php echo esc_attr( $class ); ?>' />
				</label>
			</li>
			<?php
			endforeach;
		?>
		</ul>
	<?php
	}
}


class Cordero_Customize_Heading_Large extends WP_Customize_Control {
    public function render_content() {
    	?>

        <?php if ( !empty( $this->label ) ) : ?>
            <h3 class="cordero-accordion-section-title"><?php echo esc_html( $this->label ); ?></h3>
        <?php endif; ?>
        <?php if ( !empty( $this->description ) ) : ?>
            <p class="cordero-accordion-section-paragraph"><?php echo esc_html( $this->description ); ?></p>
        <?php endif; ?>
    <?php }
}


class Cordero_Customize_Heading_Small extends WP_Customize_Control {
    public function render_content() {
    	?>

        <?php if ( !empty( $this->label ) ) : ?>
            <h5 class="cordero-accordion-section-title"><?php echo esc_html( $this->label ); ?></h5>
        <?php endif; ?>
        <?php if ( !empty( $this->description ) ) : ?>
            <p class="cordero-accordion-section-paragraph"><?php echo esc_html( $this->description ); ?></p>
        <?php endif; ?>
    <?php }
}


class Cordero_Customize_Extra_Control extends WP_Customize_Control {
	public $settings = 'blogname';
	public $description = '';
	public $url = '';
	public $group = '';

	public function render_content() {
		switch ( $this->type ) {
			default:

			case 'extra':
				echo '<p style="margin-top:40px;">' . sprintf(
							'<a href="%1$s" target="_blank">%2$s</a>',
							esc_url( $this->url ),
							esc_html__( 'More options available', 'cordero' )
						) . '</p>';
				echo '<p class="description" style="margin-top:5px;">' . esc_html( $this->description ) . '</p>';
				break;

			case 'docs':
				echo sprintf(
							'<a href="%1$s" class="button-primary" target="_blank">%2$s</a>',
							esc_url( $this->url ),
							esc_html__( 'Documentation', 'cordero' )
						);
				break;

			case 'pro-link':
				echo sprintf(
							'<a href="%1$s" class="button-primary" target="_blank">%2$s</a>',
							esc_url( $this->url ),
							esc_html__( 'Go Pro', 'cordero' )
						);
				break;
					
			case 'line' :
				echo '<hr />';
				break;
		}
	}
}


endif;


/**
 * Sanitization functions
 */

function cordero_sanitize_checkbox( $input ){
	if ( $input ) {
		$output = '1';
	} else {
		$output = false;
	}
	return $output;
}


function cordero_sanitize_choices( $input, $setting ) {
    global $wp_customize;
 
    $control = $wp_customize->get_control( $setting->id );
 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}


function cordero_sanitize_radio_select( $input, $setting ) {
	// Ensuring that the input is a slug.
	$input = sanitize_key( $input );
	// Get the list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	// If the input is a valid key, return it, else, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}


/**
 * Get registered image sizes
 */
function cordero_get_image_sizes() {
	global $_wp_additional_image_sizes;

	$sizes = array();

	foreach ( get_intermediate_image_sizes() as $_size ) {
		if ( in_array( $_size, array('thumbnail', 'medium', 'medium_large', 'large') ) ) {
			$sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
			$sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
			$sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
		} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
			$sizes[ $_size ] = array(
				'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
				'height' => $_wp_additional_image_sizes[ $_size ]['height'],
				'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
			);
		}
	}

	return $sizes;
}

function cordero_image_size_options() {
	$image_size_configs = cordero_get_image_sizes();
	// Hardcoded 'full' because not a registered image size
	// 'full' will result in the original uploaded image size being used
	$sizes = array(
		'full' => esc_html__( 'Full (original full size image)', 'cordero' ),
	);
	foreach( $image_size_configs as $name => $size_config) {
		if ( $size_config['crop'] == 1 ) {
			$hardcrop = esc_html__( '(exact dimensions)', 'cordero' );
		} else {
			$hardcrop = esc_html__( '(proportional)', 'cordero' );
		}
		$sizes[$name] = ucwords(preg_replace('/[-_]/', ' ', $name)) . ' (' . $size_config['width'] . 'x' . $size_config['height'] . ') ' . $hardcrop;
	}

	return $sizes;
}
