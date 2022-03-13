<?php
/**
 * Template part for displaying page content in page.php
 *
 * @package Cordero
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?><?php cordero_schema_item( 'article' ); ?>>

	<div class="entry-content single-entry-content"<?php cordero_schema_prop( 'text' ); ?>>
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cordero' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'cordero' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link"><span class="cordero-icon-edit-2"></span>',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->
