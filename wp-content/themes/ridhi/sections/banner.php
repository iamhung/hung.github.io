<?php
/**
 * Banner Section
 * 
 * @package Ridhi
 */

$ed_banner      = get_theme_mod( 'ed_banner_section', 'static_nl_banner' );
$slider_type    = get_theme_mod( 'slider_type', 'latest_posts' );
$slider_cat     = get_theme_mod( 'slider_cat' );
$posts_per_page = get_theme_mod( 'no_of_slides', 3 );
$newsletter     = get_theme_mod( 'banner_newsletter' );
    
if( ( $ed_banner == 'static_nl_banner' ) && has_custom_header() ){ ?>
    <div id="banner_section" class="banner">
        <?php 
            the_custom_header_markup(); 
            if( $newsletter ){
                echo '<div class="banner-content"><div class="container"><div class="banner-box">';
                echo do_shortcode( $newsletter );
                echo '</div><!-- .banner-box --></div><!-- .container --></div><!-- .banner-content -->';
            }
        ?>
    </div>
<?php
}elseif( $ed_banner == 'slider_banner' ){
    $args = array(
        'post_type'           => 'post',
        'post_status'         => 'publish',            
        'ignore_sticky_posts' => true
    );
    
    if( $slider_type === 'cat' && $slider_cat ){
        $args['cat']            = $slider_cat; 
        $args['posts_per_page'] = -1;  
    }else{
        $args['posts_per_page'] = $posts_per_page;
    }
        
    $qry = new WP_Query( $args );
    
    if( $qry->have_posts() ){ ?>
    <div id="banner_section" class="banner">
		<div id="banner-slider" class="owl-carousel">
			<?php while( $qry->have_posts() ){ $qry->the_post(); ?>
            <div class="item">
				<?php 
                if( has_post_thumbnail() ){
				    the_post_thumbnail( 'ridhi-featured', array( 'itemprop' => 'image' ) );    
				}else{ 
				    ridhi_get_fallback_svg( 'ridhi-featured' );//fallback
                }
                ?>                        
				<div class="banner-text">
					<div class="container">
						<div class="text-holder">
							<?php
                                ridhi_category();
                                the_title( '<h2 class="title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                            ?>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
            
		</div>
	</div>
    <?php
    wp_reset_postdata();
    }
}