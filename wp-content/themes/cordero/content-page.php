<?php
/**
 * Template part for displaying page content in page.php
 *
 * @package Cordero
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?><?php cordero_schema_item( 'article' ); ?>>

	<header class="page-header">
		<?php the_title( '<h1 class="page-title"' . cordero_schema_prop( 'headline', 'false' ) . '>', '</h1>' ); ?>
	</header><!-- .page-header -->

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
