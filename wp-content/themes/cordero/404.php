<?php
/**
 * The template for displaying 404 page
 *
 * @package Cordero
 */

get_header();
?>

	<p><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'cordero' ); ?></p>

	<p><?php esc_html_e( 'Maybe try a search?', 'cordero' ); ?> <?php get_search_form(); ?></p>

	<p><?php esc_html_e( 'Browse our pages.', 'cordero' ); ?></p>
	<ul>
	<?php wp_list_pages( array( 'title_li' => '' ) ); ?>
	</ul>		

<?php get_footer(); ?>
