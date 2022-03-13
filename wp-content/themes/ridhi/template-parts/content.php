<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ridhi
 */

?>

<article id="post-<?php the_ID(); ?>" itemscope itemtype="https://schema.org/Blog" <?php post_class(); ?>>
	<?php 
        /**
         * @hooked ridhi_post_thumbnail - 20
        */
        do_action( 'ridhi_before_posts_entry_content' );
    
        /**
         * @hooked ridhi_post_meta - 20
        */
        do_action( 'ridhi_posts_entry_content' );
    ?>
</article><!-- #post-<?php the_ID(); ?> -->