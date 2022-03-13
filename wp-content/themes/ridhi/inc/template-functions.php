<?php
/**
 * Ridhi Template Functions which enhance the theme by hooking into WordPress
 *
 * @package Ridhi
*/

if( ! function_exists( 'ridhi_doctype' ) ) :
/**
 * Doctype Declaration
*/
function ridhi_doctype(){ ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <?php
}
endif;
add_action( 'ridhi_doctype', 'ridhi_doctype' );

if( ! function_exists( 'ridhi_head' ) ) :
/**
 * Before wp_head 
*/
function ridhi_head(){ ?>
    <meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php
}
endif;
add_action( 'ridhi_before_wp_head', 'ridhi_head' );

if( ! function_exists( 'ridhi_page_start' ) ) :
/**
 * Page Start
*/
function ridhi_page_start(){ ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content (Press Enter)', 'ridhi' ); ?></a>
    <?php
}
endif;
add_action( 'ridhi_before_header', 'ridhi_page_start', 20 );

if( ! function_exists( 'ridhi_mobile_header' ) ) :
/**
 * Mobile Header
 */
function ridhi_mobile_header(){ ?>
    <div class="mobile-header">
        <div class="container">
            <button class="mobile-menu-opener" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".close-main-nav-toggle">
                <span></span>
            </button>
            <?php
                ridhi_site_branding( true );
                ridhi_mobile_header_search();
            ?>            
            <div class="mobile-menu-wrapper">
                <?php ridhi_mobile_primary_navigation(); ?>
            </div><!-- .mobile-menu-wrapper -->
        </div><!-- .container -->
    </div><!-- .mobile-header -->
    <?php
}
endif;
add_action( 'ridhi_header', 'ridhi_mobile_header', 15 );

if( ! function_exists( 'ridhi_header' ) ) :
/**
 * Header Start
*/
function ridhi_header(){ ?>    
    <header id="masthead" class="site-header" itemscope itemtype="https://schema.org/WPHeader">
        <div class="header-t">
            <div class="container clearfix">
                <?php 
                    /**
                     * Hook Email, Phone & social link from Companion plugin
                     */
                    do_action( 'ridhi_header_top', 'header', true );
                ?>
            </div>
        </div><!-- .header-t -->
        <div class="header-b">
            <div class="container">
                <?php ridhi_site_branding(); ?>
                
                <div class="right-panel">
                    <?php 
                        ridhi_primary_navigation();
                        ridhi_header_search();
                    
                        /**
                         * Hooked CTA button from companion plugin
                         */
                        do_action( 'ridhi_header_after_nav' );
                    ?>
                </div>
            </div>
        </div><!-- .header-b -->
    </header><!-- .site-header -->
    <?php 
}
endif;
add_action( 'ridhi_header', 'ridhi_header', 20 );

if( ! function_exists( 'ridhi_top_bar' ) ) :
/**
 * Top bar for single page and post
*/
function ridhi_top_bar(){
    $ed_banner = get_theme_mod( 'ed_banner_section', 'static_nl_banner' );

    if( is_front_page() ){
        if( is_home() ){
            get_template_part( 'sections/banner' );
        }

        if( $ed_banner == 'no_banner' && is_page() ){ ?>
            <div class="banner">
                <div class="banner-bg-wrap" style="background:url(<?php echo esc_url( ridhi_inner_page_banner_image() ); ?>)">
                    <div class="banner-content">
                        <div class="container">                    
                            <div class="text-holder">
                                <?php the_title( '<h2 class="banner-title">', '</h2>' ); ?>                        
                            </div><!-- .text-holder -->   
                        </div><!-- .container -->   
                    </div><!-- .banner-content -->
                </div>
            </div>
            <?php
        }
    }else{
        $ed_cat_single  = get_theme_mod( 'ed_category', false );
        $ed_post_date   = get_theme_mod( 'ed_post_date', false );
        $ed_post_author = get_theme_mod( 'ed_post_author', false ); ?>
        <div class="banner">
            <div class="banner-bg-wrap" style="background:url(<?php echo esc_url( ridhi_inner_page_banner_image() ); ?>)">
                <div class="banner-content">
                    <div class="container">                    
                        <div class="text-holder">
                            <?php 
                                if( is_home() ){ 
                                    echo '<h1 class="banner-title">';
                                    single_post_title();
                                    echo '</h1>';
                                }

                                if( is_archive() ){
                                    if( is_author() ){ ?>
                                        <div class="author-section">
                                            <div class="img-holder"><?php echo get_avatar( get_the_author_meta( 'ID' ), 120 ); ?></div>
                                            <div class="text-holder">
                                                <h1 class="author-name"><?php the_author_meta( 'display_name' ); ?></h1>
                                                <?php if( get_the_author_meta( 'description' ) ) echo '<div class="author-description">' . wpautop( wp_kses_post( get_the_author_meta( 'description' ) ) ) . '</div>'; ?>
                                            </div>
                                        </div><!-- .author-section -->
                                        <?php
                                    }else{ 
                                        the_archive_title();
                                        the_archive_description( '<div class="description">', '</div>' );
                                    }
                                }

                                if( is_search() ){ ?>
                                    <h1 class="screen-reader-text"><?php esc_html_e( 'Search Result Page', 'ridhi' ); ?></h1>
                                    <span><?php esc_html_e( 'Search Results for:', 'ridhi' ); ?></span>
                                    <?php
                                    get_search_form();
                                }

                                if( is_404() ){ ?>
                                    <h1 class="banner-title"><?php esc_html_e( 'Uh-Oh...', 'ridhi' ); ?></h1>
                                    <div class="description">
                                        <?php echo wpautop( esc_html__( 'The page you are looking for may have been moved, deleted, or possibly never existed.', 'ridhi' ) ); ?>                                    
                                    </div>
                                    <?php
                                }

                                if( is_singular() ){ 
                                    if( get_post_type() == 'post' ){ 
                                        if( ! $ed_cat_single ) ridhi_category(); 
                                        the_title( '<h1 class="entry-title">', '</h1>' );
                                        if( ! $ed_post_author || ! $ed_post_date ){
                                            echo '<div class="entry-meta">';
                                            if( ! $ed_post_author ) ridhi_posted_by();
                                            if( ! $ed_post_date )  ridhi_posted_on();
                                            echo '</div>'; 
                                        }                                    
                                    }else{ 
                                        the_title( '<h1 class="banner-title">', '</h1>' );
                                    }
                                }
                            ?>                        
                        </div><!-- .text-holder -->   
                    </div><!-- .container -->   
                </div><!-- .banner-content --> 
            </div>  
        </div><!-- .banner -->   
        <?php 
    }
}
endif;
add_action( 'ridhi_after_header', 'ridhi_top_bar', 20 );

if( ! function_exists( 'ridhi_content_start' ) ) :
/**
 * Content Start
*/
function ridhi_content_start(){ 
    $home_sections = ridhi_get_home_sections();    
    if( ! ( is_front_page() && ! is_home() && $home_sections ) && ! is_404() ){ ?>
        <div id="content" class="site-content">
            <div class="container">
                <div class="holder">
        <?php
    }        
}
endif;
add_action( 'ridhi_content', 'ridhi_content_start' );

if ( ! function_exists( 'ridhi_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function ridhi_post_thumbnail(){
    if( is_home() || is_archive() || is_search() ){
        echo '<a href="' . esc_url( get_permalink() ) . '" class="post-thumbnail">';
        if( has_post_thumbnail() ){
            the_post_thumbnail( 'ridhi-blog', array( 'itemprop' => 'image' ) );    
        }else{
            ridhi_get_fallback_svg( 'ridhi-blog' );//fallback
        }
        echo '</a>';
    }
}
endif;
add_action( 'ridhi_before_posts_entry_content', 'ridhi_post_thumbnail', 20 );

if( ! function_exists( 'ridhi_post_meta' ) ):
/**
 * Post Meta
 */
function ridhi_post_meta(){
    echo '<div class="text-holder">';
    ridhi_category();
    the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
    ridhi_posted_on();
    echo '</div><!-- .text-holder -->';
}
endif;
add_action( 'ridhi_posts_entry_content', 'ridhi_post_meta', 20 );

if( ! function_exists( 'ridhi_entry_content' ) ) :
/**
 * Entry Content
*/
function ridhi_entry_content(){ ?>
    <div class="entry-content" itemprop="text">
		<?php
			the_content();    
            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ridhi' ),
                'after'  => '</div>',
            ) );
		?>
	</div><!-- .entry-content -->
    <?php
}
endif;
add_action( 'ridhi_page_entry_content', 'ridhi_entry_content', 15 );
add_action( 'ridhi_post_entry_content', 'ridhi_entry_content', 15 );

if( ! function_exists( 'ridhi_author' ) ) :
/**
 * Author Section
*/
function ridhi_author(){ 
    $ed_author = get_theme_mod( 'ed_author', false );
    if( ! $ed_author && get_the_author_meta( 'description' ) ){ ?>
        <div class="author-section">
            <div class="img-holder"><?php echo get_avatar( get_the_author_meta( 'ID' ), 120 ); ?></div>
            <div class="text-holder">
                <h3 class="author-name"><?php the_author_meta( 'display_name' ); ?></h3>                
                <?php echo '<div class="author-description">' . wpautop( wp_kses_post( get_the_author_meta( 'description' ) ) ) . '</div>'; ?>		
            </div>
        </div>
        <?php
    }
}
endif;
add_action( 'ridhi_after_post_content', 'ridhi_author', 15 );

if( ! function_exists( 'ridhi_navigation' ) ) :
/**
 * Navigation
*/
function ridhi_navigation(){
    if( is_single() ){
        $previous = get_previous_post_link(
    		'<div class="nav-previous">%link</div>',
    		'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 8"><path id="Path_201" data-name="Path 201" class="cls-1" d="M16.01,11H8v2h8.01v3L22,12,16.01,8Z" transform="translate(22 16) rotate(180)" /></svg><span class="meta-nav">' . esc_html__( 'Previous Article', 'ridhi' ) . '</span><span class="screen-reader-text">' . esc_html__( 'Previous post:', 'ridhi' ) . '</span><span class="post-title">%title</span>',
    		false,
    		'',
    		'category'
    	);
    
    	$next = get_next_post_link(
    		'<div class="nav-next">%link</div>',
    		'<span class="meta-nav">' . esc_html__( 'Next Article', 'ridhi' ) . '</span><span class="screen-reader-text">' . esc_html__( 'Next post:', 'ridhi' ) . '</span><span class="post-title">%title</span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 8"><path id="Path_202" data-name="Path 202" class="cls-1" d="M16.01,11H8v2h8.01v3L22,12,16.01,8Z" transform="translate(-8 -8)" /></svg>',
    		false,
    		'',
    		'category'
    	); 
        
        if( $previous || $next ){?>            
            <nav class="navigation post-navigation" role="navigation">
    			<h2 class="screen-reader-text"><?php esc_html_e( 'Post Navigation', 'ridhi' ); ?></h2>
    			<div class="nav-links">
    				<?php
                        if( $previous ) echo $previous;
                        if( $next ) echo $next;
                    ?>
    			</div>
    		</nav>        
            <?php
        }
    }else{
        the_posts_pagination( array(
            'prev_text'          => __( 'Previous', 'ridhi' ),
            'next_text'          => __( 'Next', 'ridhi' ),
            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'ridhi' ) . ' </span>',
        ) );
    }
}
endif;
add_action( 'ridhi_after_post_content', 'ridhi_navigation', 20 );
add_action( 'ridhi_after_posts_content', 'ridhi_navigation' );

if( ! function_exists( 'ridhi_related_posts' ) ) :
/**
 * Related Posts 
*/
function ridhi_related_posts(){ 
    $ed_related_post = get_theme_mod( 'ed_related', true );
    if( $ed_related_post ){
        ridhi_get_posts_list( 'related' );    
    }
}
endif;                                                                               
add_action( 'ridhi_after_post_content', 'ridhi_related_posts', 25 );

if( ! function_exists( 'ridhi_latest_posts' ) ) :
/**
 * Latest Posts
*/
function ridhi_latest_posts(){ 
    ridhi_get_posts_list( 'latest' );
}
endif;
add_action( 'ridhi_latest_posts', 'ridhi_latest_posts' );

if( ! function_exists( 'ridhi_comment' ) ) :
/**
 * Comments Template 
*/
function ridhi_comment(){
    // If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
}
endif;
add_action( 'ridhi_after_post_content', 'ridhi_comment', 30 );
add_action( 'ridhi_after_page_content', 'ridhi_comment' );

if( ! function_exists( 'ridhi_content_end' ) ) :
/**
 * Content End
*/
function ridhi_content_end(){ 
    $home_sections = ridhi_get_home_sections();    
    if( ! ( is_front_page() && ! is_home() && $home_sections ) && ! is_404() ){ ?>            
                </div><!-- .holder -->
            </div><!-- .container -->        
        </div><!-- .site-content -->
        <?php
    }
}
endif;
add_action( 'ridhi_before_footer', 'ridhi_content_end', 20 );

if( ! function_exists( 'ridhi_footer_start' ) ) :
/**
 * Footer Start
*/
function ridhi_footer_start(){ ?>
    <footer id="colophon" class="site-footer" itemscope itemtype="https://schema.org/WPFooter">
    <?php
}
endif;
add_action( 'ridhi_footer', 'ridhi_footer_start', 20 );

if( ! function_exists( 'ridhi_footer_top' ) ) :
/**
 * Footer Top
*/
function ridhi_footer_top(){    
    $footer_sidebars = array( 'footer-one', 'footer-two', 'footer-three', 'footer-four' );
    $active_sidebars = array();
    $sidebar_count   = 0;
    
    foreach ( $footer_sidebars as $sidebar ) {
        if( is_active_sidebar( $sidebar ) ){
            array_push( $active_sidebars, $sidebar );
            $sidebar_count++ ;
        }
    }
                 
    if( $active_sidebars ){ ?>
        <div class="footer-t">
    		<div class="container">
    			<div class="grid column-<?php echo esc_attr( $sidebar_count ); ?>">
                    <?php foreach( $active_sidebars as $active ){ ?>
                        <div class="col">
                        <?php dynamic_sidebar( $active ); ?>	
                        </div>
                    <?php } ?>
                </div>
    		</div><!-- .container -->
    	</div><!-- .footer-t -->
        <?php 
    }   
}
endif;
add_action( 'ridhi_footer', 'ridhi_footer_top', 30 );

if( ! function_exists( 'ridhi_footer_bottom' ) ) :
/**
 * Footer Bottom
*/
function ridhi_footer_bottom(){ ?>
    <div class="footer-b">
		<div class="container">
			<div class="site-info">            
            <?php
                ridhi_get_footer_copyright();
                echo esc_html__( ' Ridhi | Developed By ', 'ridhi' ); 
                echo '<a href="' . esc_url( 'https://rarathemes.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'Rara Theme', 'ridhi' ) . '</a>.';                
                printf( esc_html__( ' Powered by %s. ', 'ridhi' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'ridhi' ) ) .'" target="_blank">WordPress</a>' );
                if( function_exists( 'the_privacy_policy_link' ) ){
                    the_privacy_policy_link();
                }
            ?>               
            </div>
            <section class="widget widget_rtc_social_links">
                <?php do_action( 'ridhi_footer_social', 'footer', true ); ?>
            </section>
		</div>
	</div>
    <?php
}
endif;
add_action( 'ridhi_footer', 'ridhi_footer_bottom', 40 );

if( ! function_exists( 'ridhi_footer_end' ) ) :
/**
 * Footer End 
*/
function ridhi_footer_end(){ ?>
    </footer><!-- #colophon -->
    <?php
}
endif;
add_action( 'ridhi_footer', 'ridhi_footer_end', 50 );

if( ! function_exists( 'ridhi_page_end' ) ) :
/**
 * Page End
*/
function ridhi_page_end(){ ?>
    </div><!-- #page -->
    <?php
}
endif;
add_action( 'ridhi_after_footer', 'ridhi_page_end', 20 );
