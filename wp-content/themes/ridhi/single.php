<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Ridhi
 */

get_header(); ?>
	<div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php
                while ( have_posts() ) : the_post();
                    get_template_part( 'template-parts/content', 'single' );
                endwhile; // End of the loop.
            ?>
        </main><!-- #main -->        
        <?php
            /**
             * @hooked ridhi_author        - 15 
             * @hooked ridhi_navigation    - 20 
             * @hooked ridhi_related_posts - 25
             * @hooked ridhi_comment       - 30
             */
            do_action( 'ridhi_after_post_content' );
        ?>        
	</div><!-- #primary -->
    <?php
get_sidebar();
get_footer();