<?php
/**
 * Ridhi Custom functions and definitions
 *
 * @package Ridhi
 */

if ( ! function_exists( 'ridhi_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ridhi_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Ridhi, use a find and replace
	 * to change 'ridhi' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'ridhi', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'ridhi' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'ridhi_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 
        'custom-logo', 
        apply_filters( 
            'ridhi_custom_logo_args', 
            array( 
                'height'      => 70, 
                'width'       => 70,
                'flex-height' => true,
                'flex-width'  => true,
                'header-text' => array( 'site-title', 'site-description' ) 
            )
        ) 
    );
    
    /**
     * Add support for custom header.
    */
    add_theme_support( 
        'custom-header', 
        apply_filters( 
            'ridhi_custom_header_args', 
            array(
                'default-image' => esc_url( get_template_directory_uri() . '/images/banner-img.jpg' ),
                'width'         => 1920,
                'height'        => 1008,
                'header-text'   => false
            ) 
        ) 
    );

    // Register default headers.
    register_default_headers( array(
        'default-banner' => array(
            'url'           => '%s/images/banner-img.jpg',
            'thumbnail_url' => '%s/images/banner-img.jpg',
            'description'   => esc_html_x( 'Default Banner', 'header image description', 'ridhi' ),
        ),

    ) );
 
    /**
     * Add Custom Images sizes.
    */    
    add_image_size( 'ridhi-featured', 1920, 640, true );
    add_image_size( 'ridhi-related', 110, 83, true );
    add_image_size( 'ridhi-blog', 370, 285, true );
    
    /** Starter Content */
    $starter_content = array(
        // Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts' => array( 'home', 'blog' ),
		
        // Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),
        
        // Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "top" location.
			'primary' => array(
				'name' => __( 'Primary', 'ridhi' ),
				'items' => array(
					'page_home',
					'page_blog'
				)
			)
		),
    );
    
    $starter_content = apply_filters( 'ridhi_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
    
    // Add theme support for Responsive Videos.
    add_theme_support( 'jetpack-responsive-videos' );
}
endif;
add_action( 'after_setup_theme', 'ridhi_setup' );

if( ! function_exists( 'ridhi_content_width' ) ) :
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ridhi_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ridhi_content_width', 750 );
}
endif;
add_action( 'after_setup_theme', 'ridhi_content_width', 0 );

if( ! function_exists( 'ridhi_template_redirect_content_width' ) ) :
/**
 * Adjust content_width value according to template.
 *
 * @return void
*/
function ridhi_template_redirect_content_width(){
	$sidebar = ridhi_sidebar();
    if( $sidebar ){	   
        $GLOBALS['content_width'] = 750;      
	}else{
        $GLOBALS['content_width'] = 1140;
	}
}
endif;
add_action( 'template_redirect', 'ridhi_template_redirect_content_width' );

if( ! function_exists( 'ridhi_scripts' ) ) :
/**
 * Enqueue scripts and styles.
 */
function ridhi_scripts(){
	// Use minified libraries if SCRIPT_DEBUG is false
    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
    
    if( ridhi_is_woocommerce_activated() )
    wp_enqueue_style( 'ridhi-woocommerce', get_template_directory_uri(). '/css' . $build . '/woocommerce' . $suffix . '.css', array(), RIDHI_THEME_VERSION );
    
    wp_enqueue_style( 'owl-carousel', get_template_directory_uri(). '/css' . $build . '/owl.carousel' . $suffix . '.css', array(), '2.2.1' );
    wp_enqueue_style( 'animate', get_template_directory_uri(). '/css' . $build . '/animate' . $suffix . '.css', array(), '3.5.2' );
    wp_enqueue_style( 'ridhi-google-fonts', ridhi_fonts_url(), array(), null );
    wp_enqueue_style( 'ridhi', get_stylesheet_uri(), array(), RIDHI_THEME_VERSION );

	wp_enqueue_script( 'all', get_template_directory_uri() . '/js' . $build . '/all' . $suffix . '.js', array( 'jquery' ), '5.6.3', true );
    wp_enqueue_script( 'v4-shims', get_template_directory_uri() . '/js' . $build . '/v4-shims' . $suffix . '.js', array( 'jquery', 'all' ), '5.6.3', true );
    wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js' . $build . '/owl.carousel' . $suffix . '.js', array( 'jquery' ), '2.2.1', true );
    wp_enqueue_script( 'ridhi-modal-accessibility', get_template_directory_uri() . '/js' . $build . '/modal-accessibility' . $suffix . '.js', array( 'jquery' ), RIDHI_THEME_VERSION, true );
	wp_enqueue_script( 'ridhi', get_template_directory_uri() . '/js' . $build . '/custom' . $suffix . '.js', array( 'jquery' ), RIDHI_THEME_VERSION, true );
    
    $array = array( 
        'rtl'       => is_rtl(),
        'animation' => esc_attr( get_theme_mod( 'slider_animation' ) ),
        'ajax_url'  => admin_url( 'admin-ajax.php' ),
    );
    
    wp_localize_script( 'ridhi', 'ridhi_data', $array );
    
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
endif;
add_action( 'wp_enqueue_scripts', 'ridhi_scripts' );

if( ! function_exists( 'ridhi_admin_scripts' ) ) :
/**
 * Enqueue admin scripts and styles.
*/
function ridhi_admin_scripts(){
    wp_enqueue_style( 'ridhi-admin', get_template_directory_uri() . '/inc/css/admin.css', '', RIDHI_THEME_VERSION );
}
endif; 
add_action( 'admin_enqueue_scripts', 'ridhi_admin_scripts' );

if( ! function_exists( 'ridhi_body_classes' ) ) :
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ridhi_body_classes( $classes ) {
	$ed_banner = get_theme_mod( 'ed_banner_section', 'static_nl_banner' );
    $custom_header_image = get_header_image_tag();
    
    // Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
    
    // Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}
    
    // Adds a class of custom-background-color to sites with a custom background color.
    if ( get_background_color() != 'ffffff' ) {
		$classes[] = 'custom-background-color';
	}
    
    $classes[] = ridhi_sidebar( true );

    if( is_front_page() ){
        if( $ed_banner == 'slider_banner' || ( $ed_banner == 'static_nl_banner' && ! empty( $custom_header_image ) ) ){
            $classes[] = 'has-banner';
        }elseif( is_page() ){
            $classes[] = 'has-banner';
        }
    }elseif( is_archive() || is_search() || is_404() || ( ( is_home() || is_singular() ) && ! is_front_page() ) ){
        $classes[] = 'has-banner';
    }
    
	return $classes;
}
endif;
add_filter( 'body_class', 'ridhi_body_classes' );

if( ! function_exists( 'ridhi_post_classes' ) ) :
/**
 * Add custom classes to the array of post classes.
*/
function ridhi_post_classes( $classes ){
    
    if( is_search() ){
        $classes[] = 'search-post';
    }
    
    return $classes;
}
endif;
add_filter( 'post_class', 'ridhi_post_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function ridhi_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'ridhi_pingback_header' );

if( ! function_exists( 'ridhi_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
*/
function ridhi_change_comment_form_default_fields( $fields ){    
    // get the current commenter if available
    $commenter = wp_get_current_commenter();
 
    // core functionality
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' ); 
    $required = ( $req ? " required" : '' );
    $author   = ( $req ? __( 'Name*', 'ridhi' ) : __( 'Name', 'ridhi' ) );
    $email    = ( $req ? __( 'Email*', 'ridhi' ) : __( 'Email', 'ridhi' ) );   
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><label class="screen-reader-text" for="author">' . esc_html__( 'Name*', 'ridhi' ) . '<span class="required">*</span></label><input id="author" name="author" placeholder="' . esc_attr( $author ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $required . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><label class="screen-reader-text" for="email">' . esc_html__( 'Email*', 'ridhi' ) . '<span class="required">*</span></label><input id="email" name="email" placeholder="' . esc_attr( $email ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . $required . ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><label class="screen-reader-text" for="url">' . esc_html__( 'Website', 'ridhi' ) . '</label><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'ridhi' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;    
}
endif;
add_filter( 'comment_form_default_fields', 'ridhi_change_comment_form_default_fields' );

if( ! function_exists( 'ridhi_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
*/
function ridhi_change_comment_form_defaults( $defaults ){    
    $defaults['comment_field'] = '<p class="comment-form-comment"><label class="screen-reader-text" for="comment">' . esc_html__( 'Comment', 'ridhi' ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'ridhi' ) . '" cols="45" rows="8" aria-required="true" required></textarea></p>';
    
    return $defaults;    
}
endif;
add_filter( 'comment_form_defaults', 'ridhi_change_comment_form_defaults' );

if( ! function_exists( 'ridhi_exclude_cat' ) ) :
/**
 * Exclude post with Category from blog and archive page. 
*/
function ridhi_exclude_cat( $query ){
    $ed_banner      = get_theme_mod( 'ed_banner_section', 'static_nl_banner' );
    $slider_type    = get_theme_mod( 'slider_type', 'latest_posts' );
    $slider_cat     = get_theme_mod( 'slider_cat' );
    $posts_per_page = get_theme_mod( 'no_of_slides', 3 );
    
    if( ! is_admin() && $query->is_main_query() && $query->is_home() && $ed_banner == 'slider_banner' ){
        if( $slider_type === 'cat' && $slider_cat  ){            
 			$query->set( 'category__not_in', array( $slider_cat ) );    		
        }elseif( $slider_type == 'latest_posts' ){
            $args = array(
                'post_type'           => 'post',
                'post_status'         => 'publish',
                'posts_per_page'      => $posts_per_page,
                'ignore_sticky_posts' => true
            );
            $latest = get_posts( $args );
            $excludes = array();
            foreach( $latest as $l ){
                array_push( $excludes, $l->ID );
            }
            $query->set( 'post__not_in', $excludes );
        }  
    }      
}
endif;
add_filter( 'pre_get_posts', 'ridhi_exclude_cat' );

if( ! function_exists( 'ridhi_get_the_archive_title' ) ) :
/**
 * Filter Archive Title
*/
function ridhi_get_the_archive_title( $title ){
    $ed_prefix = get_theme_mod( 'ed_prefix_archive', false );
    if( is_category() ){
        if( $ed_prefix ){
            $title = '<h1 class="banner-title">' . single_cat_title( '', false ) . '</h1>';
        }else{
            /* translators: Category archive title. 1: Category name */
            $title = sprintf( __( '%1$sCategory%2$s %3$s', 'ridhi' ), '<span>', '</span>', '<h1 class="banner-title">' . single_cat_title( '', false ) . '</h1>' );
        }
    }elseif( is_tag() ){
        if( $ed_prefix ){
            $title = '<h1 class="banner-title">' . single_tag_title( '', false ) . '</h1>';    
        }else{
            /* translators: Tag archive title. 1: Tag name */
            $title = sprintf( __( '%1$sTag%2$s %3$s', 'ridhi' ), '<span>', '</span>', '<h1 class="banner-title">' . single_tag_title( '', false ) . '</h1>' );
        }
    }elseif( is_year() ){
        if( $ed_prefix ){
            $title = '<h1 class="banner-title">' . get_the_date( _x( 'Y', 'yearly archives date format', 'ridhi' ) ) . '</h1>';
        }else{
            /* translators: Yearly archive title. 1: Year */
            $title = sprintf( __( '%1$sYear%2$s %3$s', 'ridhi' ), '<span>', '</span>', '<h1 class="banner-title">' . get_the_date( _x( 'Y', 'yearly archives date format', 'ridhi' ) ) . '</h1>' );
        }
    }elseif( is_month() ){
        if( $ed_prefix ){
            $title = '<h1 class="banner-title">' . get_the_date( _x( 'F Y', 'monthly archives date format', 'ridhi' ) ) . '</h1>';
        }else{
            /* translators: Monthly archive title. 1: Month name and year */
            $title = sprintf( __( '%1$sMonth%2$s %3$s', 'ridhi' ), '<span>', '</span>', '<h1 class="banner-title">' . get_the_date( _x( 'F Y', 'monthly archives date format', 'ridhi' ) ) . '</h1>' );
        }
    }elseif( is_day() ){
        if( $ed_prefix ){
            $title = '<h1 class="banner-title">' . get_the_date( _x( 'F j, Y', 'daily archives date format', 'ridhi' ) ) . '</h1>';
        }else{
            /* translators: Daily archive title. 1: Date */
            $title = sprintf( __( '%1$sDay%2$s %3$s', 'ridhi' ), '<span>', '</span>', '<h1 class="banner-title">' . get_the_date( _x( 'F j, Y', 'daily archives date format', 'ridhi' ) ) . '</h1>' );
        }
    }elseif( is_post_type_archive() ) {
        if( is_post_type_archive( 'product' ) ){
            $title = '<h1 class="banner-title">' . get_the_title( get_option( 'woocommerce_shop_page_id' ) ) . '</h1>';
        }else{
            if( $ed_prefix ){
                $title = '<h1 class="banner-title">' . post_type_archive_title( '', false ) . '</h1>';
            }else{
                /* translators: Post type archive title. 1: Post type name */
                $title = sprintf( __( '%1$sArchives%2$s %3$s', 'ridhi' ), '<span>', '</span>', '<h1 class="banner-title">' . post_type_archive_title( '', false ) . '</h1>' );
            }
        }
    }elseif( is_tax() ) {
        $tax = get_taxonomy( get_queried_object()->taxonomy );
        if( $ed_prefix ){
            $title = '<h1 class="banner-title">' . single_term_title( '', false ) . '</h1>';
        }else{                                                            
            /* translators: Taxonomy term archive title. 1: Taxonomy singular name, 2: Current taxonomy term */
            $title = sprintf( __( '%1$s: %2$s', 'ridhi' ), '<span>' . $tax->labels->singular_name . '</span>', '<h1 class="banner-title">' . single_term_title( '', false ) . '</h1>' );
        }
    }else {
        $title = sprintf( __( '%1$sArchives%2$s', 'ridhi' ), '<h1 class="banner-title">', '</h1>' );
    }
    return $title;
}
endif;
add_filter( 'get_the_archive_title', 'ridhi_get_the_archive_title' );

if( ! function_exists( 'ridhi_remove_archive_description' ) ) :
/**
 * filter the_archive_description & get_the_archive_description to show post type archive
 * @param  string $description original description
 * @return string post type description if on post type archive
 */
function ridhi_remove_archive_description( $description ){
    $ed_shop_archive_description = get_theme_mod( 'ed_shop_archive_description', false );
    if( is_post_type_archive( 'product' ) ) {
        if( ! $ed_shop_archive_description ){
            $description = '';
        }
    }
    return $description;
}
endif;
add_filter( 'get_the_archive_description', 'ridhi_remove_archive_description' );

if( ! function_exists( 'ridhi_get_comment_author_link' ) ) :
/**
 * Filter to modify comment author link
 * @link https://developer.wordpress.org/reference/functions/get_comment_author_link/
 */
function ridhi_get_comment_author_link( $return, $author, $comment_ID ){
    $comment = get_comment( $comment_ID );
    $url     = get_comment_author_url( $comment );
    $author  = get_comment_author( $comment );
 
    if ( empty( $url ) || 'http://' == $url )
        $return = '<span itemprop="name">'. esc_html( $author ) .'</span>';
    else
        $return = '<span itemprop="name"><a href=' . esc_url( $url ) . ' rel="external nofollow noopener" class="url" itemprop="url">' . esc_html( $author ) . '</a></span>';

    return $return;
}
endif;
add_filter( 'get_comment_author_link', 'ridhi_get_comment_author_link', 10, 3 );

if( ! function_exists( 'ridhi_admin_notice' ) ) :
/**
 * Addmin notice for getting started page
*/
function ridhi_admin_notice(){
    global $pagenow;
    $theme_args      = wp_get_theme();
    $meta            = get_option( 'ridhi_admin_notice' );
    $name            = $theme_args->__get( 'Name' );
    $current_screen  = get_current_screen();
    
    if( 'themes.php' == $pagenow && !$meta ){
        
        if( $current_screen->id !== 'dashboard' && $current_screen->id !== 'themes' ){
            return;
        }

        if( is_network_admin() ){
            return;
        }

        if( ! current_user_can( 'manage_options' ) ){
            return;
        } ?>

        <div class="welcome-message notice notice-info">
            <div class="notice-wrapper">
                <div class="notice-text">
                    <h3><?php esc_html_e( 'Congratulations!', 'ridhi' ); ?></h3>
                    <p><?php printf( __( '%1$s is now installed and ready to use. Click below to see theme documentation, plugins to install and other details to get started.', 'ridhi' ), esc_html( $name ) ) ; ?></p>
                    <p><a href="<?php echo esc_url( admin_url( 'themes.php?page=ridhi-getting-started' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Go to the getting started.', 'ridhi' ); ?></a></p>
                    <p class="dismiss-link"><strong><a href="?ridhi_admin_notice=1"><?php esc_html_e( 'Dismiss', 'ridhi' ); ?></a></strong></p>
                </div>
            </div>
        </div>
    <?php }
}
endif;
add_action( 'admin_notices', 'ridhi_admin_notice' );

if( ! function_exists( 'ridhi_update_admin_notice' ) ) :
/**
 * Updating admin notice on dismiss
*/
function ridhi_update_admin_notice(){
    if ( isset( $_GET['ridhi_admin_notice'] ) && $_GET['ridhi_admin_notice'] = '1' ) {
        update_option( 'ridhi_admin_notice', true );
    }
}
endif;
add_action( 'admin_init', 'ridhi_update_admin_notice' );

if( ! function_exists( 'ridhi_get_search_form' ) ) :
/**
 * Search Form
*/
function ridhi_get_search_form(){ 
    $placeholder = is_404() ? _x( 'Try searching for what you were looking for&hellip;', 'placeholder', 'ridhi' ) : _x( 'Search&hellip;', 'placeholder', 'ridhi' );
    $form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
                <label>
                    <span class="screen-reader-text">' . esc_html_x( 'Search for:', 'label', 'ridhi' ) . '</span>
                    <input type="search" id="search-form-id" class="search-field" placeholder="' . esc_attr( $placeholder ) . '" value="' . get_search_query() . '" name="s"/>
                </label>                
                <input type="submit" class="search-submit" value="'. esc_attr_x( 'Search', 'submit button', 'ridhi' ) .'" /> 
            </form>';

    return $form;
}
endif;
add_filter( 'get_search_form', 'ridhi_get_search_form' );
