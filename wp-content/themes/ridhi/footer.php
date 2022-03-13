<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ridhi
 */
    
    /**
     * After Content
     * 
     * @hooked ridhi_content_end - 20
    */
    do_action( 'ridhi_before_footer' );
    
    /**
     * Footer
     * 
     * @hooked ridhi_footer_start  - 20
     * @hooked ridhi_footer_top    - 30
     * @hooked ridhi_footer_bottom - 40
     * @hooked ridhi_footer_end    - 50
    */
    do_action( 'ridhi_footer' );
    
    /**
     * After Footer
     * 
     * @hooked ridhi_page_end - 20
    */
    do_action( 'ridhi_after_footer' );

    wp_footer(); ?>

</body>
</html>
