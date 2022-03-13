<?php
/**
 * Cordero functions and definitions
 *
 * @package Cordero
 */

if ( ! function_exists( 'cordero_setup' ) ) :

//Sets up theme defaults and registers support for various WordPress features

function cordero_setup() {
	// Make theme available for translation
	load_theme_textdomain( 'cordero', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title
	add_theme_support( 'title-tag' );

	// Support for WooCommerce
	add_theme_support( 'woocommerce', array(
		'product_grid' => array(
			'min_columns' => 2,
			'max_columns' => 8,
		),
	) );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Add custom image size(s)
	add_image_size( 'cordero-featured-service', 60, 60, true );


	// Make custom image size(s) available to editor
	add_filter( 'image_size_names_choose', 'cordero_custom_image_sizes' );
	function cordero_custom_image_sizes( $sizes ) {
		return array_merge( $sizes, array(
			'cordero-featured-service' => __( 'Featured Service', 'cordero' ),
		));
	}

	// This theme uses wp_nav_menu() in two locations
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'cordero' ),
		'footer' => esc_html__( 'Footer Menu', 'cordero' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Enable support for post formats
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat',
	) );

	// Set up the WordPress core custom background feature
	add_theme_support( 'custom-background', apply_filters( 'cordero_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for Custom Logo
	add_theme_support( 'custom-logo', array(
		'width'		=> '',
		'height'	=> '',
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// Enable support for widgets selective refresh
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Style the visual editor to resemble the theme style
	add_editor_style( array( 'css/editor-style.css', cordero_editor_fonts_url() ) );

	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	// Support for Gutenberg (5.0+ block editor)
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-color-palette', cordero_custom_color_palette() );
	add_theme_support( 'editor-font-sizes', cordero_custom_font_sizes() );
	add_theme_support( 'custom-line-height' );

	// https://jetpack.com/support/infinite-scroll/
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer' => false,
	) );

}
endif; // cordero_setup
add_action( 'after_setup_theme', 'cordero_setup' );

function cordero_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cordero_content_width', 1160 );
}
add_action( 'after_setup_theme', 'cordero_content_width', 0 );

// Set up the WordPress core custom header feature
function cordero_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'cordero_custom_header_args', array(
		'default-image'			=> '',
		'default-text-color'	=> 'ffffff',
		'header-text'			=> false,
		'width'					=> '1920',
		'height'				=> '180',
		'flex-height'			=> false,
		'flex-width'			=> false,
		'wp-head-callback'		=> '',
	) ) );
}
add_action( 'after_setup_theme', 'cordero_custom_header_setup' );

// Enables the Excerpt meta box in Page edit screen
function cordero_add_excerpt_support_for_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'cordero_add_excerpt_support_for_pages' );

// Register widget area
function cordero_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'cordero' ),
		'id'            => 'cordero-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="sidebar-widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Page Sidebar', 'cordero' ),
		'id'            => 'cordero-sidebar-page',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="page-sidebar-widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'cordero' ),
		'id'            => 'cordero-sidebar-shop',
		'description'   => esc_html__( 'Requires WooCommerce plugin.', 'cordero' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="shop-sidebar-widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Shop Filters', 'cordero' ),
		'id'            => 'cordero-sidebar-shop-filters',
		'description'   => esc_html__( 'Horizontal widget area for product archives. Requires WooCommerce plugin.', 'cordero' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="shop-filters-widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Top Bar', 'cordero' ),
		'id'            => 'cordero-top-bar',
		'description'   => esc_html__( 'Add your own content above the header.', 'cordero' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="top-bar-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Top Footer', 'cordero' ),
		'description'   => esc_html__( 'Full width area above the footer columns.', 'cordero' ),
		'id'            => 'cordero-top-footer',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="top-footer-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'cordero' ),
		'id'            => 'cordero-footer1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'cordero' ),
		'id'            => 'cordero-footer2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'cordero' ),
		'id'            => 'cordero-footer3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

}
add_action( 'widgets_init', 'cordero_widgets_init' );

if ( ! function_exists( 'cordero_fonts_url' ) ) :
/**
 * Register Google fonts for Cordero
 * @return string Google fonts URL for the theme
 */
function cordero_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Google fonts: on or off', 'cordero' ) ) {

		$fonts[] = get_theme_mod( 'font_site_title', 'Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i' );
		$fonts[] = get_theme_mod( 'font_nav', 'Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i' );
		$fonts[] = get_theme_mod( 'font_content', 'Work Sans:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i' );
		$fonts[] = get_theme_mod( 'font_headings', 'Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i' );

		$fonts = str_replace('Arial, Helvetica, sans-serif', '', $fonts);
		$fonts = str_replace('Impact, Charcoal, sans-serif', '', $fonts);
		$fonts = str_replace('"Lucida Sans Unicode", "Lucida Grande", sans-serif', '', $fonts);
		$fonts = str_replace('Tahoma, Geneva, sans-serif', '', $fonts);
		$fonts = str_replace('"Trebuchet MS", Helvetica, sans-serif', '', $fonts);
		$fonts = str_replace('Verdana, Geneva, sans-serif', '', $fonts);
		$fonts = str_replace('Georgia, serif', '', $fonts);
		$fonts = str_replace('"Palatino Linotype", "Book Antiqua", Palatino, serif', '', $fonts);
		$fonts = str_replace('"Times New Roman", Times, serif', '', $fonts);

	}

	$fonts = array_filter( $fonts );

	if ( empty( $fonts ) ) {
		$google_fonts_empty = 1;
	} else {
		$google_fonts_empty = 0;
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'cordero' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $google_fonts_empty == 0 ) {
		$fonts_url = add_query_arg( array(
			'family' =>  urlencode( implode( '|', array_unique($fonts) ) ),
			'subset' =>  urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
		return esc_url_raw($fonts_url);
	} else {
		return;
	}
}
endif;

if ( ! function_exists( 'cordero_editor_fonts_url' ) ) :
/**
 * Register Google fonts for Cordero
 * @return string Google fonts URL for the tinyMCE editor
 */
function cordero_editor_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Google fonts: on or off', 'cordero' ) ) {

		$fonts[] = get_theme_mod( 'font_site_title', 'Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i' );
		$fonts[] = get_theme_mod( 'font_nav', 'Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i' );
		$fonts[] = get_theme_mod( 'font_content', 'Work Sans:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i' );
		$fonts[] = get_theme_mod( 'font_headings', 'Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i' );

		$fonts = str_replace('Arial, Helvetica, sans-serif', '', $fonts);
		$fonts = str_replace('Impact, Charcoal, sans-serif', '', $fonts);
		$fonts = str_replace('"Lucida Sans Unicode", "Lucida Grande", sans-serif', '', $fonts);
		$fonts = str_replace('Tahoma, Geneva, sans-serif', '', $fonts);
		$fonts = str_replace('"Trebuchet MS", Helvetica, sans-serif', '', $fonts);
		$fonts = str_replace('Verdana, Geneva, sans-serif', '', $fonts);
		$fonts = str_replace('Georgia, serif', '', $fonts);
		$fonts = str_replace('"Palatino Linotype", "Book Antiqua", Palatino, serif', '', $fonts);
		$fonts = str_replace('"Times New Roman", Times, serif', '', $fonts);

	}

	$fonts = array_filter( $fonts );

	if ( empty( $fonts ) ) {
		$google_fonts_empty = 1;
	} else {
		$google_fonts_empty = 0;
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'cordero' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $google_fonts_empty == 0 ) {
		$fonts_url = add_query_arg( array(
			'family' =>  urlencode( implode( '|', array_unique($fonts) ) ),
			'subset' =>  urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
		return esc_url_raw($fonts_url);
	} else {
		return;
	}
}
endif;

/**
 * Enqueue scripts and styles.
 */
function cordero_scripts() {
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_script( 'touchswipe', get_template_directory_uri() . '/js/jquery.touchSwipe.min.js', array( 'jquery' ), '1.6.18', true );
	wp_enqueue_script( 'cordero-custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'cordero-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '1.0', true );
	wp_enqueue_style( 'cordero-fonts', cordero_fonts_url(), array(), null );
	wp_enqueue_style( 'cordero-style', get_stylesheet_uri() );
	wp_add_inline_style( 'cordero-style', cordero_dynamic_style() );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cordero_scripts' );

/**
 * Enqueue scripts and styles for Block Editor.
 */
function cordero_block_editor_assets() {
	wp_enqueue_style( 'cordero-block-editor-fonts', cordero_editor_fonts_url() );
	wp_enqueue_style( 'cordero-block-editor-style', get_template_directory_uri() . '/css/block-editor-style.css' );
	wp_add_inline_style( 'cordero-block-editor-style', cordero_block_editor_dynamic_style() );
}
add_action( 'enqueue_block_editor_assets', 'cordero_block_editor_assets' );

/**
 * Custom block editor color palette.
 */
if ( !function_exists( 'cordero_custom_color_palette' ) ) {
	function cordero_custom_color_palette() {
		return array(
			array(
				'name' => esc_html__( 'Cordero - Accent color', 'cordero' ),
				'slug' => 'accent-color',
				'color' => get_theme_mod( 'accent_color', '#d82978' ),
			),
			array(
				'name' => esc_html__( 'Cordero - Color 2', 'cordero' ),
				'slug' => 'accent-color2',
				'color' => get_theme_mod( 'accent_color2', '#2d2354' ),
			),
			array(
				'name' => esc_html__( 'Cordero - Color 3', 'cordero' ),
				'slug' => 'accent-color3',
				'color' => get_theme_mod( 'accent_color3', '#fbfbfb' ),
			),
			array(
				'name' => esc_html__( 'Black', 'cordero' ),
				'slug' => 'black',
				'color' => '#000000'
			),
			array(
				'name' => esc_html__( 'White', 'cordero' ),
				'slug' => 'white',
				'color' => '#ffffff'
			),
			array(
				'name' => esc_html__( 'Pale pink', 'cordero' ),
				'slug' => 'pale-pink',
				'color' => '#f78da7'
			),
			array(
				'name' => esc_html__( 'Vivid red', 'cordero' ),
				'slug' => 'vivid-red',
				'color' => '#cf2e2e',
			),
			array(
				'name' => esc_html__( 'Luminous vivid orange', 'cordero' ),
				'slug' => 'luminous-vivid-orange',
				'color' => '#ff6900',
			),
			array(
				'name' => esc_html__( 'Luminous vivid amber', 'cordero' ),
				'slug' => 'luminous-vivid-amber',
				'color' => '#fcb900',
			),
			array(
				'name' => esc_html__( 'Light green cyan', 'cordero' ),
				'slug' => 'light-green-cyan',
				'color' => '#7bdcb5',
			),
			array(
				'name' => esc_html__( 'Vivid green cyan', 'cordero' ),
				'slug' => 'vivid-green-cyan',
				'color' => '#00d084',
			),
			array(
				'name' => esc_html__( 'Pale cyan blue', 'cordero' ),
				'slug' => 'pale-cyan-blue',
				'color' => '#8ed1fc',
			),
			array(
				'name' => esc_html__( 'Vivid cyan blue', 'cordero' ),
				'slug' => 'vivid-cyan-blue',
				'color' => '#0693e3',
			),
			array(
				'name' => esc_html__( 'Vivid purple', 'cordero' ),
				'slug' => 'vivid-purple',
				'color' => '#9b51e0',
			),
			array(
				'name' => esc_html__( 'Very light gray', 'cordero' ),
				'slug' => 'very-light-gray',
				'color' => '#eeeeee',
			),
			array(
				'name' => esc_html__( 'Cyan bluish gray', 'cordero' ),
				'slug' => 'cyan-bluish-gray',
				'color' => '#abb8c3',
			),
			array(
				'name' => esc_html__( 'Very dark gray', 'cordero' ),
				'slug' => 'very-dark-gray',
				'color' => '#313131',
			),
		);
	}
}

/**
 * Custom block editor font sizes.
 */
if ( !function_exists( 'cordero_custom_font_sizes' ) ) {
	function cordero_custom_font_sizes() {
		return array(
			array(
				'name' => __( 'Tiny', 'cordero' ),
				'size' => 10,
				'slug' => 'tiny'
			),
			array(
				'name' => __( 'Small', 'cordero' ),
				'size' => 13,
				'slug' => 'small'
			),
			array(
				'name' => __( 'Normal', 'cordero' ),
				'size' => 16,
				'slug' => 'normal'
			),
			array(
				'name' => __( 'Medium', 'cordero' ),
				'size' => 24,
				'slug' => 'medium'
			),
			array(
				'name' => __( 'Large', 'cordero' ),
				'size' => 36,
				'slug' => 'large'
			),
			array(
				'name' => __( 'Huge', 'cordero' ),
				'size' => 48,
				'slug' => 'huge'
			),
			array(
				'name' => __( 'Gigantic', 'cordero' ),
				'size' => 60,
				'slug' => 'gigantic'
			),
			array(
				'name' => __( 'Massive', 'cordero' ),
				'size' => 72,
				'slug' => 'massive'
			),
		);
	}
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/functions/template-tags.php';

/**
 * Custom functions.
 */
require get_template_directory() . '/functions/extras.php';
require get_template_directory() . '/functions/hooks.php';
require get_template_directory() . '/functions/schema.php';
require get_template_directory() . '/functions/style-output.php';
require get_template_directory() . '/functions/fonts.php';

/**
 * Block patterns.
 */
if ( function_exists( 'register_block_pattern' ) ) {
	require get_template_directory() . '/functions/block-patterns.php';
}

/**
 * Block styles.
 */
if ( function_exists( 'register_block_style' ) ) {
	require get_template_directory() . '/functions/block-styles.php';
}

/**
 * Customizer additions.
 */
require get_template_directory() . '/functions/customizer-controls.php';
require get_template_directory() . '/functions/customizer.php';

/**
 * Theme help page.
 */
if ( is_admin() ) {
	require get_template_directory() . '/functions/theme-help.php';
}

if ( !function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

/**
 * TGM Plugin activation.
 */
require_once get_template_directory() . '/functions/class-tgm-plugin-activation.php';
function cordero_reg_plugin() {
	$plugins[] = array(
		'name'		=> esc_html__( 'Starter Sites', 'cordero' ),
		'slug'		=> 'starter-sites',
		'required'	=> false,
	);
	tgmpa( $plugins);
}
add_action( 'tgmpa_register', 'cordero_reg_plugin' );
