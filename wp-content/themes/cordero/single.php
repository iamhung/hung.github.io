<?php
/**
 * The template for displaying all single posts
 *
 * @package Cordero
 */

get_header();

if ( ! is_active_sidebar( 'cordero-sidebar' ) || get_theme_mod( 'sidebar_position' ) === 'below' ) {
	$page_full_width = ' full-width';
} else {
	$page_full_width = '';
}
?>

	<?php cordero_before_primary_content(); ?>

	<div id="primary" class="content-area<?php echo $page_full_width;?>">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>

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

<?php get_sidebar(); ?>

<?php get_footer(); ?>
