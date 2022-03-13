<?php
/**
 * Ridhi Front Page Settings
 *
 * @package Ridhi
 */

function ridhi_customize_register_frontpage( $wp_customize ) {
	
    /** Front Page Settings */
    $wp_customize->add_panel( 
        'frontpage_settings',
         array(
            'priority'    => 60,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'Front Page Settings', 'ridhi' ),
            'description' => __( 'Static Home Page settings.', 'ridhi' ),
        ) 
    );
    
    $wp_customize->get_section( 'header_image' )->panel           = 'frontpage_settings';
    $wp_customize->get_section( 'header_image' )->title           = __( 'Banner Section', 'ridhi' );
    $wp_customize->get_section( 'header_image' )->priority        = 10;
    $wp_customize->get_control( 'header_image' )->active_callback = 'ridhi_banner_ac';
    $wp_customize->get_section( 'header_image' )->description     = '';
    $wp_customize->get_setting( 'header_image' )->transport       = 'refresh';
    
    /** Banner Options */
    $wp_customize->add_setting(
		'ed_banner_section',
		array(
			'default'			=> 'static_nl_banner',
			'sanitize_callback' => 'ridhi_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Ridhi_Select_Control(
    		$wp_customize,
    		'ed_banner_section',
    		array(
                'label'	      => __( 'Banner Options', 'ridhi' ),
                'description' => __( 'Choose banner as static image/video or as a slider.', 'ridhi' ),
    			'section'     => 'header_image',
    			'choices'     => array(
                    'no_banner'        => __( 'Disable Banner Section', 'ridhi' ),
                    'static_nl_banner' => __( 'Static Banner', 'ridhi' ),
                    'slider_banner'    => __( 'Banner as Slider', 'ridhi' ),
                ),
                'priority' => 5	
     		)            
		)
    );
    
    if( ridhi_is_btnw_activated() ){
        /** Newsletter Shortcode */
        $wp_customize->add_setting(
            'banner_newsletter',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post' 
            )
        );
        
        $wp_customize->add_control(
            'banner_newsletter',
            array(
                'type'            => 'text',
                'section'         => 'header_image',
                'label'           => __( 'Newsletter Shortcode', 'ridhi' ),
                'description'     => __( 'Enter the BlossomThemes Email Newsletters Shortcode. Ex. [BTEN id="356"]', 'ridhi' ),
                'active_callback' => 'ridhi_banner_ac'
            )
        );
    }else{
        $wp_customize->add_setting(
			'newsletter_recommend',
			array(
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			new Ridhi_Plugin_Recommend_Control(
				$wp_customize,
				'newsletter_recommend',
				array(
					'section'         => 'header_image',
					'label'           => __( 'Newsletter Shortcode', 'ridhi' ),
					'capability'      => 'install_plugins',
					'plugin_slug'     => 'blossomthemes-email-newsletter',//This is the slug of recommended plugin.
					'description'     => sprintf( __( 'Please install and activate the recommended plugin %1$sBlossomThemes Email Newsletter%2$s.', 'ridhi' ), '<strong>', '</strong>' ),
					'active_callback' => 'ridhi_banner_ac'
				)
			)
		);
    }
    
    /** Slider Content Style */
    $wp_customize->add_setting(
		'slider_type',
		array(
			'default'			=> 'latest_posts',
			'sanitize_callback' => 'ridhi_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Ridhi_Select_Control(
    		$wp_customize,
    		'slider_type',
    		array(
                'label'	  => __( 'Slider Content Style', 'ridhi' ),
    			'section' => 'header_image',
    			'choices' => array(
                    'latest_posts' => __( 'Latest Posts', 'ridhi' ),
                    'cat'          => __( 'Category', 'ridhi' )
                ),
                'active_callback' => 'ridhi_banner_ac'	
     		)
		)
	);
    
    /** Slider Category */
    $wp_customize->add_setting(
		'slider_cat',
		array(
			'default'			=> '',
			'sanitize_callback' => 'ridhi_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Ridhi_Select_Control(
    		$wp_customize,
    		'slider_cat',
    		array(
                'label'	          => __( 'Slider Category', 'ridhi' ),
    			'section'         => 'header_image',
    			'choices'         => ridhi_get_categories(),
                'active_callback' => 'ridhi_banner_ac'	
     		)
		)
	);
    
    /** No. of slides */
    $wp_customize->add_setting(
        'no_of_slides',
        array(
            'default'           => 3,
            'sanitize_callback' => 'ridhi_sanitize_number_absint'
        )
    );
    
    $wp_customize->add_control(
		new Ridhi_Slider_Control( 
			$wp_customize,
			'no_of_slides',
			array(
				'section'     => 'header_image',
                'label'       => __( 'Number of Slides', 'ridhi' ),
                'description' => __( 'Choose the number of slides you want to display', 'ridhi' ),
                'choices'	  => array(
					'min' 	=> 1,
					'max' 	=> 20,
					'step'	=> 1,
				),
                'active_callback' => 'ridhi_banner_ac'                 
			)
		)
	);
    
    /** Slider Animation */
    $wp_customize->add_setting(
		'slider_animation',
		array(
			'default'			=> '',
			'sanitize_callback' => 'ridhi_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Ridhi_Select_Control(
    		$wp_customize,
    		'slider_animation',
    		array(
                'label'	      => __( 'Slider Animation', 'ridhi' ),
                'section'     => 'header_image',
    			'choices'     => array(
                    'fadeOut'        => __( 'Fade Out', 'ridhi' ),
                    'fadeOutLeft'    => __( 'Fade Out Left', 'ridhi' ),
                    'fadeOutRight'   => __( 'Fade Out Right', 'ridhi' ),
                    'fadeOutUp'      => __( 'Fade Out Up', 'ridhi' ),
                    'fadeOutDown'    => __( 'Fade Out Down', 'ridhi' ),
                    ''               => __( 'Slide', 'ridhi' ),
                    'slideOutLeft'   => __( 'Slide Out Left', 'ridhi' ),
                    'slideOutRight'  => __( 'Slide Out Right', 'ridhi' ),
                    'slideOutUp'     => __( 'Slide Out Up', 'ridhi' ),
                    'slideOutDown'   => __( 'Slide Out Down', 'ridhi' ),                    
                ),
                'active_callback' => 'ridhi_banner_ac'                                	
     		)
		)
	);
    /** Slider Settings Ends */

    /** Newsletter Section */
    $wp_customize->add_section(
        'newsletter_section',
        array(
            'title'    => __( 'Newsletter Section', 'ridhi' ),
            'priority' => 80,
            'panel'    => 'frontpage_settings'
        )
    );

    if( ridhi_is_btnw_activated() ){
        /** Enable Newsletter Section */
        $wp_customize->add_setting(
            'ed_newsletter_section',
            array(
                'default'           => false,
                'sanitize_callback' => 'ridhi_sanitize_checkbox'
            )
        );

        $wp_customize->add_control(
            new Ridhi_Toggle_Control(
                $wp_customize,
                'ed_newsletter_section',
                array(
                    'label'       => __( 'Enable Newsletter Section', 'ridhi' ),
                    'description' => __( 'Enable to show newsletter section.', 'ridhi' ),
                    'section'     => 'newsletter_section',
                )            
            )
        );

        /** Newsletter Shortcode */
        $wp_customize->add_setting(
            'bt_newsletter',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post'
            )
        );
        
        $wp_customize->add_control(
            'bt_newsletter',
            array(
                'section'     => 'newsletter_section',
                'label'       => __( 'Newsletter Shortcode', 'ridhi' ),
                'description' => __( 'Enter the BlossomThemes Email Newsletters Shortcode. Ex. [BTEN id="356"]', 'ridhi' ),
                'type'        => 'text',
            )
        );
    }else{
        //plugin recommendation
        $wp_customize->add_setting(
			'newsletter_re',
			array(
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			new Ridhi_Plugin_Recommend_Control(
				$wp_customize,
				'newsletter_re',
				array(
					'section'     => 'newsletter_section',
					'label'       => __( 'Newsletter Shortcode', 'ridhi' ),
					'capability'  => 'install_plugins',
					'plugin_slug' => 'blossomthemes-email-newsletter',//This is the slug of recommended plugin.
					'description' => sprintf( __( 'Please install and activate the recommended plugin %1$sBlossomThemes Email Newsletter%2$s.', 'ridhi' ), '<strong>', '</strong>' ),
				)
			)
		);
    }
    
    /** Blog Section */
    $wp_customize->add_section(
        'blog_section',
        array(
            'title'    => __( 'Blog Section', 'ridhi' ),
            'priority' => 95,
            'panel'    => 'frontpage_settings',
        )
    );

    /** Enable Blog Section */
    $wp_customize->add_setting(
        'ed_blog_section',
        array(
            'default'           => true,
            'sanitize_callback' => 'ridhi_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        new Ridhi_Toggle_Control(
            $wp_customize,
            'ed_blog_section',
            array(
                'label'       => __( 'Enable Blog Section', 'ridhi' ),
                'description' => __( 'Enable to show blog section.', 'ridhi' ),
                'section'     => 'blog_section',
            )            
        )
    );

    /** Blog title */
    $wp_customize->add_setting(
        'blog_section_title',
        array(
            'default'           => __( 'Latest Articles', 'ridhi' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'blog_section_title',
        array(
            'section'     => 'blog_section',
            'label'       => __( 'Blog Title', 'ridhi' ),
            'description' => __( 'Add Title for this section.', 'ridhi' ),
            'type'        => 'text',
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'blog_section_title', 
        array(
            'selector'        => '#blog_section .widget_text .widget-title',
            'render_callback' => 'ridhi_get_blog_title',
        ) 
    );

    /** Blog description */
    $wp_customize->add_setting(
        'blog_section_subtitle',
        array(
            'default'           => __( 'Show your latest blog posts here. You can modify this section from Appearance > Customize > Front Page Settings > Blog Section.', 'ridhi' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'blog_section_subtitle',
        array(
            'section'     => 'blog_section',
            'label'       => __( 'Blog Description', 'ridhi' ),
            'description' => __( 'Add Content for this section.', 'ridhi' ),
            'type'        => 'text',
        )
    ); 

    $wp_customize->selective_refresh->add_partial( 
        'blog_section_subtitle', 
        array(
            'selector'            => '#blog_section .widget_text .textwidget',
            'render_callback'     => 'ridhi_get_blog_subtitle',
        ) 
    );
    /** Blog Section Ends */    
}
add_action( 'customize_register', 'ridhi_customize_register_frontpage' );