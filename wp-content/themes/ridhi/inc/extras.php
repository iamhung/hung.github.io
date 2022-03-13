<?php
/**
 * Ridhi Standalone Functions.
 *
 * @package Ridhi
*/

if( ! function_exists( 'ridhi_site_branding' ) ) :
/**
 * Site Branding
 */
function ridhi_site_branding( $mobile = false ){ 
    $itemscope = $mobile ? '' : ' itemscope itemtype="https://schema.org/Organization"'; ?>
    <div class="site-branding">
        <div class="text-logo"<?php echo $itemscope; ?>>
            <?php 
                if( has_custom_logo() ){
                    the_custom_logo();
                } 
                
                if( is_front_page() ){ ?>
                    <h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php 
                }else{ ?>
                    <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></p>
                    <?php
                }

                $description = get_bloginfo( 'description', 'display' );
                if ( $description || is_customize_preview() ){ ?>
                    <p class="site-description" itemprop="description"><?php bloginfo( 'description' ); ?></p>
                    <?php        
                }
            ?>
        </div><!-- .text-logo -->
    </div><!-- .site-branding -->
    <?php
}    
endif;

if( ! function_exists( 'ridhi_mobile_primary_navigation' ) ) :
/**
 * Primary Navigation
 */
function ridhi_mobile_primary_navigation(){ ?>
    <nav id="mobile-site-navigation" class="main-navigation mobile-navigation">        
        <div class="primary-menu-list main-menu-modal cover-modal" data-modal-target-string=".main-menu-modal">
            <button class="close close-main-nav-toggle" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".main-menu-modal"></button>
            <div class="mobile-menu" aria-label="<?php esc_attr_e( 'Mobile', 'ridhi' ); ?>">
                <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'mobile-primary-menu',
                        'menu_class'     => 'nav-menu main-menu-modal',
                        'fallback_cb'    => 'ridhi_primary_menu_fallback',
                    ) );

                    /**
                     * Hook Email, Phone & social link from Companion plugin
                    */
                    do_action( 'ridhi_header_top', 'header', true );
                ?>
            </div>
        </div>
    </nav><!-- #mobile-site-navigation -->
    <?php
}
endif;

if( ! function_exists( 'ridhi_primary_navigation' ) ) :
/**
 * Primary Navigation
 */
function ridhi_primary_navigation(){ ?>
    <nav id="site-navigation" class="main-navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
        <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'menu_id'        => 'primary-menu',
                'fallback_cb'    => 'ridhi_primary_menu_fallback',
            ) );
        ?>
    </nav><!-- #site-navigation -->
    <?php
}
endif;

if( ! function_exists( 'ridhi_primary_menu_fallback' ) ) :
/**
 * Fallback for primary menu
*/
function ridhi_primary_menu_fallback(){
    if( current_user_can( 'manage_options' ) ){
        echo '<ul id="primary-menu" class="menu">';
        echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Click here to add a menu', 'ridhi' ) . '</a></li>';
        echo '</ul>';
    }
}
endif;

if( ! function_exists( 'ridhi_header_search' ) ) :
/**
 * Header Search
 */
function ridhi_header_search(){ ?>
    <div class="search-icon">
        <button class="search-btn" data-toggle-target=".header-search-modal" data-toggle-body-class="showing-search-modal" aria-expanded="false" data-set-focus=".header-search-modal .search-field">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                <path id="Path_196" data-name="Path 196" class="cls-1" d="M11.572,19.163a7.532,7.532,0,0,0,4.676-1.624L20.709,22,22,20.709l-4.461-4.461a7.57,7.57,0,1,0-5.967,2.915Zm0-13.363A5.782,5.782,0,1,1,5.8,11.572,5.782,5.782,0,0,1,11.572,5.8Z" transform="translate(-4 -4)" />
            </svg>
        </button>
        <div class="search header-searh-wrap header-search-modal cover-modal" data-modal-target-string=".header-search-modal">
            <div>
                <?php get_search_form(); ?>
                <button class="btn-form-close" data-toggle-target=".header-search-modal" data-toggle-body-class="showing-search-modal" aria-expanded="false" data-set-focus=".header-search-modal"></button>
            </div>
        </div>
    </div>
    <?php
}
endif;

if( ! function_exists( 'ridhi_mobile_header_search' ) ) :
/**
 * Header Search
 */
function ridhi_mobile_header_search(){ ?>
    <div class="search-icon">
        <button class="search-btn" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" aria-expanded="false" data-set-focus=".search-modal .search-field">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                <path id="Path_196" data-name="Path 196" class="cls-1" d="M11.572,19.163a7.532,7.532,0,0,0,4.676-1.624L20.709,22,22,20.709l-4.461-4.461a7.57,7.57,0,1,0-5.967,2.915Zm0-13.363A5.782,5.782,0,1,1,5.8,11.572,5.782,5.782,0,0,1,11.572,5.8Z" transform="translate(-4 -4)" />
            </svg>
        </button>
        <div class="search header-searh-wrap search-modal cover-modal" data-modal-target-string=".search-modal">
            <div>
                <?php get_search_form(); ?>
                <button class="btn-form-close" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" aria-expanded="false" data-set-focus=".search-modal"></button>
            </div>
        </div>
    </div>
    <?php
}
endif;

if( ! function_exists( 'ridhi_inner_page_banner_image' ) ) :
/**
 * Inner Page Banner Image 
*/
function ridhi_inner_page_banner_image(){    
    $img = '';
    if( is_singular() ){
        global $post;
        if( has_post_thumbnail( $post ) ){
            $img = get_the_post_thumbnail_url( $post, 'ridhi-featured' );
        }        
    }else{
        if( is_404() ){
            $img = get_template_directory_uri() . '/images/img-404.jpg';
        }else{
            $img = get_template_directory_uri() . '/images/img-archive.jpg';
        }
    }
    return $img;
}
endif;

if( ! function_exists( 'ridhi_search_post_count' ) ) :
/**
 * Search Result Page Count 
*/    
function ridhi_search_post_count(){
    global $wp_query;
    $found_posts  = $wp_query->found_posts;
    $paged        = get_query_var( 'paged', 0 );
    $visible_post = get_option( 'posts_per_page' );
    $paged_index  = $found_posts / $visible_post;

    if( $found_posts > 0 ){
        echo '<div class="post-count">';
        if( $found_posts > $visible_post ){
            if( $paged == 0 ){
                $start_post = 1;
                $end_post = $visible_post;
            }elseif( $paged < $paged_index ){
                $start_post = ( ( $paged - 1 ) * $visible_post ) + 1;
                $end_post = $paged * $visible_post;
            }else{
                $start_post = ( ( $paged - 1 ) * $visible_post ) + 1;
                $end_post = ( $paged - 1 ) * $visible_post + ( $found_posts - ( ( $paged - 1 ) * $visible_post ) );
            }            
            printf( esc_html__( 'Showing: %1$s - %2$s of %3$s RESULTS', 'ridhi' ), number_format_i18n( $start_post ), number_format_i18n( $end_post ), number_format_i18n( $found_posts ) );
        }else{
            /* translators: 1: found posts. */
            printf( _nx( '%s RESULT', '%s RESULTS', $found_posts, 'found posts', 'ridhi' ), number_format_i18n( $found_posts ) );
        }
        echo '</div>';
    }
}
endif;

if ( ! function_exists( 'ridhi_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time.
 */
function ridhi_posted_on(){
	$ed_updated_post_date = get_theme_mod( 'ed_post_update_date', true );
    
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		if( $ed_updated_post_date ){
            $time_string = '<time class="entry-date published updated" datetime="%3$s" itemprop="dateModified">%4$s</time><time class="updated" datetime="%1$s" itemprop="datePublished">%2$s</time>';
		}else{
            $time_string = '<time class="entry-date published" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';  
		}        
	}else{
	   $time_string = '<time class="entry-date published updated" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';   
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);
	
	echo '<span class="posted-on"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a></span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'ridhi_posted_by' ) ) :
/**
 * Prints HTML with meta information for the current author.
 */
function ridhi_posted_by(){
    global $post;
    $author_name = get_the_author_meta( 'display_name', $post->post_author );
    $author_url  = get_author_posts_url( get_the_author_meta( 'ID', $post->post_author ) );
    
    $byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( 'by %s', 'post author', 'ridhi' ),
		'<span itemprop="name"><a class="url fn n" href="' . esc_url( $author_url ) . '" itemprop="url">' . esc_html( $author_name ) . '</a></span>' 
    );
	echo '<span class="byline" itemprop="author" itemscope itemtype="https://schema.org/Person">' . $byline . '</span>';
}
endif;

if ( ! function_exists( 'ridhi_category' ) ) :
/**
 * Prints categories
 */
function ridhi_category(){
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'ridhi' ) );
		if ( $categories_list ) {
			echo '<span class="category" itemprop="about">' . $categories_list . '</span>';
		}
	}
}
endif;

if ( ! function_exists( 'ridhi_tag' ) ) :
/**
 * Prints tags
 */
function ridhi_tag(){
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'ridhi' ) );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<div class="tags" itemprop="about">' . esc_html__( '%1$sTags:%2$s %3$s', 'ridhi' ) . '</div>', '<span>', '</span>', $tags_list );
		}
	}
}
endif;

if( ! function_exists( 'ridhi_entry_footer' ) ) :
/**
 * Entry Footer
*/
function ridhi_entry_footer(){ ?>
    <footer class="entry-footer">
        <?php
            if( is_single() ){
                ridhi_tag();
            }
            
            if( get_edit_post_link() ){
                edit_post_link(
                    sprintf(
                        wp_kses(
                            /* translators: %s: Name of current post. Only visible to screen readers */
                            __( 'Edit <span class="screen-reader-text">%s</span>', 'ridhi' ),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        get_the_title()
                    ),
                    '<span class="edit-link">',
                    '</span>'
                );
            }
        ?>
    </footer><!-- .entry-footer -->
    <?php 
}
endif;

if( ! function_exists( 'ridhi_get_posts_list' ) ) :
/**
 * Returns Latest, Related & Popular Posts
*/
function ridhi_get_posts_list( $status ){
    global $post;
    
    $args = array(
        'post_type'           => 'post',
        'posts_per_page'      => 3,
        'ignore_sticky_posts' => true
    );
    
    switch( $status ){
        case 'latest':        
        $title = __( 'Recommended Articles', 'ridhi' );
        break;
        
        case 'related':
        $args['post__not_in']   = array( $post->ID );
        $args['orderby']        = 'rand';
        $title                  = get_theme_mod( 'related_post_title', __( 'You may also like...', 'ridhi' ) );
        $cats                   = get_the_category( $post->ID );        
        if( $cats ){
            $c = array();
            foreach( $cats as $cat ){
                $c[] = $cat->term_id; 
            }
            $args['category__in'] = $c;
        }        
        break;        
    }
    
    $qry = new WP_Query( $args );
    
    if( $qry->have_posts() ){ ?>    
        <div class="related-posts">
            <?php 
                if( is_404() ) echo '<div class="container">';
                if( $title ) echo '<h3 class="heading-title">' . esc_html( $title ) . '</h3>'; ?>
                <?php 
                    while( $qry->have_posts() ){ $qry->the_post(); ?>
                        <article class="post-holder">
                            <?php       
                                ridhi_posted_on();
                                the_title( '<h3 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );                                
                            ?>    
                            <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                                <?php
                                    if( has_post_thumbnail() ){
                                        the_post_thumbnail( 'ridhi-related', array( 'itemprop' => 'image' ) );
                                    }else{ 
                                        ridhi_get_fallback_svg( 'ridhi-related' );//fallback
                                    }
                                ?>
                            </a>                            
                        </article>
                        <?php 
                    } 
                if( is_404() ) echo '</div><!-- .container -->'; 
            ?>
    	</div><!-- .related-posts -->
        <?php
        wp_reset_postdata();
    }
}
endif;

if( ! function_exists( 'ridhi_theme_comment' ) ) :
/**
 * Callback function for Comment List *
 * 
 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments 
 */
function ridhi_theme_comment( $comment, $args, $depth ){
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
    }?>
    
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	
    <?php if ( 'div' != $args['style'] ) : ?>
    <article id="div-comment-<?php comment_ID() ?>" class="comment-body" itemscope itemtype="https://schema.org/UserComments">
	<?php endif; ?>
    	
        <footer class="comment-meta">
            <div class="comment-author vcard">
        	   <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
        	</div><!-- .comment-author vcard -->
        </footer>
        
        <div class="text-holder">
        	<div class="top">
                <div class="left">
                    <?php if ( $comment->comment_approved == '0' ) : ?>
                		<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'ridhi' ); ?></em>
                		<br />
                	<?php endif; ?>
                    <?php printf( __( '<b class="fn" itemprop="creator" itemscope itemtype="https://schema.org/Person">%s</b> <span class="says">says:</span>', 'ridhi' ), get_comment_author_link() ); ?>
                	<div class="comment-metadata commentmetadata">
                        <?php esc_html_e( 'On', 'ridhi' );?>
                        <a href="<?php echo esc_url( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ); ?>">
                    		<time itemprop="commentTime" datetime="<?php echo esc_attr( get_gmt_from_date( get_comment_date() . get_comment_time(), 'Y-m-d H:i:s' ) ); ?>"><?php printf( esc_html__( '%1$s at %2$s', 'ridhi' ), get_comment_date(),  get_comment_time() ); ?></time>
                        </a>
                	</div><!-- .comment-metadata -->
                </div><!-- .left -->
                <div class="comment-content" itemprop="commentText"><?php comment_text(); ?></div><!-- .comment-content -->
                <div class="reply">
                    <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            	</div><!-- .reply -->
            </div><!-- .top -->  
        </div><!-- .text-holder -->
        
	<?php if ( 'div' != $args['style'] ) : ?>
    </article><!-- .comment-body -->
	<?php endif;
}
endif;

if( ! function_exists( 'ridhi_sidebar' ) ) :
/**
 * Return sidebar layouts for pages/posts
*/
function ridhi_sidebar( $class = false ){
    global $post;
    $return = false;
    $page_layout = get_theme_mod( 'page_sidebar_layout', 'right-sidebar' ); //Default Layout Style for Pages
    $post_layout = get_theme_mod( 'post_sidebar_layout', 'right-sidebar' ); //Default Layout Style for Posts
    $layout      = get_theme_mod( 'layout_style', 'right-sidebar' ); //Default Layout Style for Styling Settings
    
    if( is_singular( array( 'page', 'post' ) ) ){         
        if( get_post_meta( $post->ID, '_ridhi_sidebar_layout', true ) ){
            $sidebar_layout = get_post_meta( $post->ID, '_ridhi_sidebar_layout', true );
        }else{
            $sidebar_layout = 'default-sidebar';
        }
        
        if( is_page() ){
            if( is_active_sidebar( 'sidebar' ) ){
                if( $sidebar_layout == 'no-sidebar' || ( $sidebar_layout == 'default-sidebar' && $page_layout == 'no-sidebar' ) ){
                    $return = $class ? 'full-width' : false;
                }elseif( ( $sidebar_layout == 'default-sidebar' && $page_layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ){
                    $return = $class ? 'rightsidebar' : 'sidebar';
                }elseif( ( $sidebar_layout == 'default-sidebar' && $page_layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ){
                    $return = $class ? 'leftsidebar' : 'sidebar';
                }
            }else{
                $return = $class ? 'full-width' : false;
            }
        }elseif( is_single() ){
            if( is_active_sidebar( 'sidebar' ) ){
                if( $sidebar_layout == 'no-sidebar' || ( $sidebar_layout == 'default-sidebar' && $post_layout == 'no-sidebar' ) ){
                    $return = $class ? 'full-width' : false;
                }elseif( ( $sidebar_layout == 'default-sidebar' && $post_layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ){
                    $return = $class ? 'rightsidebar' : 'sidebar';
                }elseif( ( $sidebar_layout == 'default-sidebar' && $post_layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ){
                    $return = $class ? 'leftsidebar' : 'sidebar';
                }
            }else{
                $return = $class ? 'full-width' : false;
            }
        }
    }elseif( ridhi_is_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() || get_post_type() == 'product' ) ){
        if( $layout == 'no-sidebar' ){
            $return = $class ? 'full-width' : false;
        }elseif( is_active_sidebar( 'shop-sidebar' ) ){            
            if( $class ){
                if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                if( $layout == 'left-sidebar' ) $return = 'leftsidebar';
            }         
        }else{
            $return = $class ? 'full-width' : false;
        } 
    }else{
        if( $layout == 'no-sidebar' ){
            $return = $class ? 'full-width' : false;
        }elseif( is_active_sidebar( 'sidebar' ) ){            
            if( $class ){
                if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                if( $layout == 'left-sidebar' ) $return = 'leftsidebar';
            }else{
                $return = 'sidebar';    
            }                         
        }else{
            $return = $class ? 'full-width' : false;
        } 
    }    
    return $return; 
}
endif;

if( ! function_exists( 'ridhi_get_posts' ) ) :
/**
 * Fuction to list Custom Post Type
*/
function ridhi_get_posts( $post_type = 'post' ){    
    $args = array(
    	'posts_per_page'   => -1,
    	'post_type'        => $post_type,
    	'post_status'      => 'publish',
    	'suppress_filters' => true 
    );
    $posts_array = get_posts( $args );
    
    // Initate an empty array
    $post_options = array();
    $post_options[''] = __( ' -- Choose -- ', 'ridhi' );
    if ( ! empty( $posts_array ) ) {
        foreach ( $posts_array as $posts ) {
            $post_options[ $posts->ID ] = $posts->post_title;
        }
    }
    return $post_options;
    wp_reset_postdata();
}
endif;

if( ! function_exists( 'ridhi_get_categories' ) ) :
/**
 * Function to list post categories in customizer options
*/
function ridhi_get_categories( $select = true, $taxonomy = 'category', $slug = false ){    
    /* Option list of all categories */
    $categories = array();
    
    $args = array( 
        'hide_empty' => false,
        'taxonomy'   => $taxonomy 
    );
    
    $catlists = get_terms( $args );
    if( $select ) $categories[''] = __( 'Choose Category', 'ridhi' );
    foreach( $catlists as $category ){
        if( $slug ){
            $categories[$category->slug] = $category->name;
        }else{
            $categories[$category->term_id] = $category->name;    
        }        
    }
    
    return $categories;
}
endif;

if( ! function_exists( 'ridhi_get_home_sections' ) ) :
/**
 * Returns Home Sections 
*/
function ridhi_get_home_sections(){
    $ed_banner      = get_theme_mod( 'ed_banner_section', 'static_nl_banner' );
    $ed_about       = get_theme_mod( 'ed_home_about_section', true );
    $ed_service     = get_theme_mod( 'ed_service_section', true );
    $ed_client      = get_theme_mod( 'ed_client_section', true );
    $ed_team        = get_theme_mod( 'ed_team_section', true );
    $ed_testimonial = get_theme_mod( 'ed_testimonial_section', true );
    $ed_newsletter  = get_theme_mod( 'ed_newsletter_section', false );
    $ed_blog        = get_theme_mod( 'ed_blog_section', true );
    $ed_contact     = get_theme_mod( 'ed_contact_section', true );
    $ed_social      = get_theme_mod( 'ed_social_section', true );
    
    $enabled_section = array();
    
    if( $ed_banner == 'static_nl_banner' || $ed_banner == 'slider_banner' ) array_push( $enabled_section, 'banner' );
    if( $ed_about ) array_push( $enabled_section, 'about' );
    if( $ed_service ) array_push( $enabled_section, 'service' );
    if( $ed_client ) array_push( $enabled_section, 'client' );
    if( $ed_team ) array_push( $enabled_section, 'team' );
    if( $ed_testimonial ) array_push( $enabled_section, 'testimonial' );
    if( $ed_newsletter ) array_push( $enabled_section, 'newsletter' );
    if( $ed_blog ) array_push( $enabled_section, 'blog' );
    if( $ed_contact ) array_push( $enabled_section, 'contact' );
    if( $ed_social ) array_push( $enabled_section, 'social' );
    
    return apply_filters( 'ridhi_home_sections', $enabled_section );
}
endif;

if( ! function_exists( 'ridhi_get_template_part' ) ) :
/**
 * Get template from plus, companion or theme.
 *
 * @param string $template Name of the section.
 */
function ridhi_get_template_part( $template ){
    if( locate_template( 'sections/' . $template . '.php' ) ){
        get_template_part( 'sections/' . $template );
    }else{
        if( defined( 'RIDHI_COMPANION_PATH' ) ){
                if( file_exists( RIDHI_COMPANION_PATH . 'sections/' . $template . '.php' ) ){
                require_once( RIDHI_COMPANION_PATH . 'sections/' . $template . '.php' );
            }
        }		
    }
}
endif;

if( ! function_exists( 'ridhi_get_image_sizes' ) ) :
/**
 * Get information about available image sizes
 */
function ridhi_get_image_sizes( $size = '' ){
 
    global $_wp_additional_image_sizes;
 
    $sizes = array();
    $get_intermediate_image_sizes = get_intermediate_image_sizes();
 
    // Create the full array with sizes and crop info
    foreach( $get_intermediate_image_sizes as $_size ) {
        if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
            $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
            $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
            $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );
        } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[ $_size ] = array( 
                'width' => $_wp_additional_image_sizes[ $_size ]['width'],
                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
            );
        }
    } 
    // Get only 1 size if found
    if ( $size ) {
        if( isset( $sizes[ $size ] ) ) {
            return $sizes[ $size ];
        } else {
            return false;
        }
    }
    return $sizes;
}
endif;

if ( ! function_exists( 'ridhi_get_fallback_svg' ) ) :    
/**
 * Get Fallback SVG
*/
function ridhi_get_fallback_svg( $post_thumbnail ){
    if( ! $post_thumbnail ){
        return;
    }
    
    $image_size = ridhi_get_image_sizes( $post_thumbnail );
     
    if( $image_size ){ ?>
        <div class="svg-holder">
             <svg class="fallback-svg" viewBox="0 0 <?php echo esc_attr( $image_size['width'] ); ?> <?php echo esc_attr( $image_size['height'] ); ?>" preserveAspectRatio="none">
                    <rect width="<?php echo esc_attr( $image_size['width'] ); ?>" height="<?php echo esc_attr( $image_size['height'] ); ?>" style="fill:#f2f2f2;"></rect>
            </svg>
        </div>
        <?php
    }
}
endif;

if( ! function_exists( 'wp_body_open' ) ) :
/**
 * Fire the wp_body_open action.
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
*/
function wp_body_open(){
	/**
	 * Triggered after the opening <body> tag.
    */
	do_action( 'wp_body_open' );
}
endif;

if( ! function_exists( 'ridhi_escape_text_tags' ) ) :
/**
 * Remove new line tags from string
 *
 * @param $text
 * @return string
 */
function ridhi_escape_text_tags( $text ){
    return (string) str_replace( array( "\r", "\n" ), '', strip_tags( $text ) );
}
endif;

/**
 * Is BlossomThemes Email Newsletters active or not
*/
function ridhi_is_btnw_activated(){
    return class_exists( 'Blossomthemes_Email_Newsletter' ) ? true : false;        
}

/**
 * Is BlossomThemes Instagram Feed active or not
*/
function ridhi_is_btif_activated(){
    return class_exists( 'Blossomthemes_Instagram_Feed' ) ? true : false;
}

/**
 * Query WooCommerce activation
 */
function ridhi_is_woocommerce_activated(){
	return class_exists( 'woocommerce' ) ? true : false;
}
