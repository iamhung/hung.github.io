<?php
/**
 * Template part for displaying results in search pages
 *
 * @package Cordero
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?><?php cordero_schema_item( 'article' ); ?>>

	<?php
	if ( get_post_format() == 'video' ) {
		$video_content = apply_filters( 'the_content', get_the_content() );
		$video = false;
		// Only get video from the content if a playlist isn't present.
		if ( false === strpos( $video_content, 'wp-playlist-script' ) ) {
			$video = get_media_embedded_in_content( $video_content, array( 'video', 'object', 'embed', 'iframe' ) );
		}
		if ( ! empty( $video ) ) {

			$first_video = true;
			foreach ( $video as $video_html ) {
				if ( $first_video ) {
					echo '<div class="entry-video">';
						echo $video_html;
					echo '</div>';
					$first_video = false;
				}
			}
		} else {
			cordero_post_thumbnail();
		}
	} else {
		cordero_post_thumbnail();
	}
	?>

	<header class="entry-header">
		<?php
		if ( !get_the_title() ) {
		?>
			<h2 class="entry-title"<?php cordero_schema_prop( 'headline' ); ?>><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php esc_html_e( 'No Title', 'cordero' ); ?></a></h2>
		<?php
		} else {
			the_title( '<h2 class="entry-title"' . cordero_schema_prop( 'headline', 'false' ) . '><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
		?>
	</header><!-- .entry-header -->

	<div class="entry-content"<?php cordero_schema_prop( 'text' ); ?>>
		<?php the_excerpt();
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cordero' ),
			'after'  => '</div>',
		) );
		cordero_read_more();
		?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
