<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ridhi
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="post-wrapper">
        <?php    
            /**
             * @hooked ridhi_entry_content - 15
            */
            do_action( 'ridhi_post_entry_content' );
        ?>
    </div><!-- .post-wrapper -->
    <?php ridhi_entry_footer(); ?>
</article><!-- #post-<?php the_ID(); ?> -->