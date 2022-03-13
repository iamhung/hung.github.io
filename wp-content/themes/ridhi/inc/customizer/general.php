<?php
/**
 * Ridhi General Settings
 *
 * @package Ridhi
 */

function ridhi_customize_register_general( $wp_customize ) {
	
    /** General Settings */
    $wp_customize->add_panel( 
        'general_settings',
         array(
            'priority'    => 85,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'General Settings', 'ridhi' ),
            'description' => __( 'Customize Header, Social, SEO, Post/Page settings.', 'ridhi' ),
        ) 
    );
    
    /** SEO Settings */
    $wp_customize->add_section(
        'seo_settings',
        array(
            'title'    => __( 'SEO Settings', 'ridhi' ),
            'priority' => 40,
            'panel'    => 'general_settings',
        )
    );
    
    /** Enable Social Links */
    $wp_customize->add_setting( 
        'ed_post_update_date', 
        array(
            'default'           => true,
            'sanitize_callback' => 'ridhi_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Ridhi_Toggle_Control( 
			$wp_customize,
			'ed_post_update_date',
			array(
				'section'     => 'seo_settings',
				'label'	      => __( 'Enable Last Update Post Date', 'ridhi' ),
                'description' => __( 'Enable to show last updated post date on listing as well as in single post.', 'ridhi' ),
			)
		)
	);        
    /** SEO Settings Ends */
    
    /** Posts(Blog) & Pages Settings */
    $wp_customize->add_section(
        'post_page_settings',
        array(
            'title'    => __( 'Posts(Blog) & Pages Settings', 'ridhi' ),
            'priority' => 50,
            'panel'    => 'general_settings',
        )
    );
    
    /** Prefix Archive Page */
    $wp_customize->add_setting( 
        'ed_prefix_archive', 
        array(
            'default'           => false,
            'sanitize_callback' => 'ridhi_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Ridhi_Toggle_Control( 
			$wp_customize,
			'ed_prefix_archive',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Prefix in Archive Page', 'ridhi' ),
                'description' => __( 'Enable to hide prefix in archive page.', 'ridhi' ),
			)
		)
	);
    
    /** Note */
    $wp_customize->add_setting(
        'post_note_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Ridhi_Note_Control( 
			$wp_customize,
			'post_note_text',
			array(
				'section'	  => 'post_page_settings',
				'description' => __( '<hr/>These options affect your individual posts.', 'ridhi' ),
			)
		)
    );
    
    /** Hide Author Section */
    $wp_customize->add_setting( 
        'ed_author', 
        array(
            'default'           => false,
            'sanitize_callback' => 'ridhi_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Ridhi_Toggle_Control( 
			$wp_customize,
			'ed_author',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Author Section', 'ridhi' ),
                'description' => __( 'Enable to hide author section.', 'ridhi' ),
			)
		)
	);
    
    /** Show Related Posts */
    $wp_customize->add_setting( 
        'ed_related', 
        array(
            'default'           => true,
            'sanitize_callback' => 'ridhi_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Ridhi_Toggle_Control( 
			$wp_customize,
			'ed_related',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Show Related Posts', 'ridhi' ),
                'description' => __( 'Enable to show related posts in single page.', 'ridhi' ),
			)
		)
	);
    
    /** Related Posts section title */
    $wp_customize->add_setting(
        'related_post_title',
        array(
            'default'           => __( 'You may also like...', 'ridhi' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'related_post_title',
        array(
            'type'    => 'text',
            'section' => 'post_page_settings',
            'label'   => __( 'Related Posts Section Title', 'ridhi' ),
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 
        'related_post_title', 
        array(
            'selector'        => '.related-posts .heading-title',
            'render_callback' => 'ridhi_get_related_title',
        ) 
    );
    
    /** Hide Category */
    $wp_customize->add_setting( 
        'ed_category', 
        array(
            'default'           => false,
            'sanitize_callback' => 'ridhi_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Ridhi_Toggle_Control( 
			$wp_customize,
			'ed_category',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Category', 'ridhi' ),
                'description' => __( 'Enable to hide category.', 'ridhi' ),
			)
		)
	);
    
    /** Hide Post Author */
    $wp_customize->add_setting( 
        'ed_post_author', 
        array(
            'default'           => false,
            'sanitize_callback' => 'ridhi_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Ridhi_Toggle_Control( 
			$wp_customize,
			'ed_post_author',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Post Author', 'ridhi' ),
                'description' => __( 'Enable to hide post author.', 'ridhi' ),
			)
		)
	);
    
    /** Hide Posted Date */
    $wp_customize->add_setting( 
        'ed_post_date', 
        array(
            'default'           => false,
            'sanitize_callback' => 'ridhi_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Ridhi_Toggle_Control( 
			$wp_customize,
			'ed_post_date',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Posted Date', 'ridhi' ),
                'description' => __( 'Enable to hide posted date.', 'ridhi' ),
			)
		)
	);
    /** Posts(Blog) & Pages Settings Ends */

    /** Miscellaneous Settings */
    $wp_customize->add_section(
        'misc_settings',
        array(
            'title'    => __( 'Misc Settings', 'ridhi' ),
            'priority' => 85,
            'panel'    => 'general_settings',
        )
    );

    /** Shop Page Description */
    $wp_customize->add_setting( 
        'ed_shop_archive_description', 
        array(
            'default'           => false,
            'sanitize_callback' => 'ridhi_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Ridhi_Toggle_Control( 
            $wp_customize,
            'ed_shop_archive_description',
            array(
                'section'         => 'misc_settings',
                'label'           => __( 'Shop Page Description', 'ridhi' ),
                'description'     => __( 'Enable to show Shop Page Description.', 'ridhi' ),
                'active_callback' => 'ridhi_is_woocommerce_activated'
            )
        )
    );
    /** Miscellaneous Settings Ends */
}
add_action( 'customize_register', 'ridhi_customize_register_general' );