<?php
/**
 * The main template file
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

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content' ); ?>

			<?php endwhile; ?>

			<?php the_posts_pagination( array(
						'prev_text' => '<i class="dashicons dashicons-arrow-left-alt2"></i>',
						'next_text' => '<i class="dashicons dashicons-arrow-right-alt2"></i>',
					) ); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php cordero_after_primary_content(); ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
