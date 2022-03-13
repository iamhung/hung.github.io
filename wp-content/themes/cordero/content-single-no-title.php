<?php
/**
 * Template part for displaying single posts with template-single-transparent-header.php
 *
 * @package Cordero
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?><?php cordero_schema_item( 'article' ); ?>>

	<div class="entry-content single-entry-content"<?php cordero_schema_prop( 'text' ); ?>>
		<?php

		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cordero' ),
			'after'  => '</div>',
		) );
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
		if ( !get_theme_mod( 'disable_author_single' ) ) {
			cordero_posted_by();
		}

		if ( !get_theme_mod( 'disable_date_single' ) ) {
			cordero_posted_on();
		}

		if ( !get_theme_mod( 'disable_cats_single' ) ) {
			cordero_entry_cats();
		}

		cordero_entry_footer();
		?>
	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->
