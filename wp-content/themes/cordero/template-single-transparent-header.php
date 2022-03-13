<?php
/**
 * Template Name: Transparent Header
 * Template Post Type: post
 *
 * A post template with a transparent header and no sidebar.
 *
 * @package Cordero
 */

if ( get_theme_mod( 'header_layout') === 'masthead-left' ) {
	get_header();
} else {
	get_header( 'transparent' );
}
?>

	<?php cordero_before_primary_content(); ?>

	<div id="primary" class="content-area full-width">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single-no-title' ); ?>

				<?php
					if ( !get_theme_mod( 'disable_prevnext' ) ) {
						the_post_navigation( array(
							'prev_text' => '<span class="nav-title"><i class="dashicons dashicons-arrow-left-alt2"></i>%title</span>',
							'next_text' => '<span class="nav-title">%title<i class="dashicons dashicons-arrow-right-alt2"></i></span>',
						) );
					}

					if ( !get_theme_mod( 'disable_related' ) ) {
						get_template_part( 'content', 'related' );
					}

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php cordero_after_primary_content(); ?>

<?php get_footer(); ?>
