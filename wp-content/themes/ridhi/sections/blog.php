<?php
/**
 * Blog Section
 * 
 * @package Ridhi
 */

$bl_title  = get_theme_mod( 'blog_section_title', __( 'Latest Articles', 'ridhi' ) );
$sub_title = get_theme_mod( 'blog_section_subtitle', __( 'Show your latest blog posts here. You can modify this section from Appearance > Customize > Front Page Settings > Blog Section.', 'ridhi' ) );

$args = array(
    'post_type'           => 'post',
    'posts_per_page'      => 3,
    'ignore_sticky_posts' => true
);

$qry = new WP_Query( $args );

if( $bl_title || $sub_title || $qry->have_posts() ){ ?>
    <div id="blog_section" class="blog-section">
        <div class="container">
            
            <?php if( $bl_title || $sub_title ){ ?>
                <section class="widget widget_text">	
                    <?php 
                        if( $bl_title ) echo '<h2 class="widget-title">' . esc_html( $bl_title ) . '</h2>';
                        if( $sub_title ) echo '<div class="textwidget">' . wp_kses_post( wpautop( $sub_title ) ) . '</div>'; 
                    ?>
                </section>
            <?php } ?>
            
            <?php if( $qry->have_posts() ){ ?>
                <div class="holder">
                    <?php 
                    while( $qry->have_posts() ){
                        $qry->the_post(); ?>
                        <article class="post" itemscope itemtype="https://schema.org/Blog">
                            <div class="post-holder">                            
                                <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                                    <?php 
                                        if( has_post_thumbnail() ){
                                            the_post_thumbnail( 'ridhi-blog', array( 'itemprop' => 'image' ) );
                                        }else{ 
                                            ridhi_get_fallback_svg( 'ridhi-blog' );//fallback
                                        }                            
                                    ?>                        
                                </a>
                                <div class="text-holder">
                                    <?php
                                        ridhi_category();
                                        the_title( '<h3 class="entry-title" itemprop="headline"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
                                        ridhi_posted_on();
                                    ?>	
                                </div>                            
                            </div>
                        </article>			
                        <?php 
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php 
}