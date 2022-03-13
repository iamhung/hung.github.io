<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 * @package Ridhi
 */

get_header(); ?>

	<div class="error-holder">
        <div class="container">
            <h2 class="error-title"><?php esc_html_e( '404', 'ridhi' ); ?></h2>
            <div class="btn-holder">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-primary"><?php esc_html_e( 'Take me to the home page', 'ridhi' ); ?></a>
            </div>
            <?php get_search_form(); ?>
        </div>
    </div>

    <?php
    /**
     * @see ridhi_latest_posts
    */
    do_action( 'ridhi_latest_posts' );
    
get_footer();