<?php
/**
 * Template part for displaying related posts
 *
 * @package Cordero
 */

$categories = wp_get_post_categories( get_the_id() );

$related_posts = get_posts( array(
	'posts_per_page' => get_theme_mod( 'related_posts', '4' ),
	'category'       => $categories,
	'exclude'        => get_the_id()
) );

if ( count( $related_posts ) > 0 ) {
	?>

	<div class="related-posts post-columns-<?php echo esc_attr( get_theme_mod( 'blog_columns', '3' ) );?>">
		<h3><?php esc_html_e( 'Related', 'cordero' ) ;?></h3>
		<div id="grid-loop">
			<?php foreach ( $related_posts as $related_post ) { 
					$related_id = $related_post->ID;
				?>
			<article id="post-<?php echo $related_id; ?>" <?php post_class('', $related_id); ?><?php cordero_schema_item( 'article' ); ?>>

				<?php
				if ( get_post_format($related_id) == 'video' ) {
					$video_content = apply_filters( 'the_content', get_post($related_id)->post_content );
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
						cordero_related_post_thumbnail($related_id);
					}
				} else {
					cordero_related_post_thumbnail($related_id);
				}
				?>

				<header class="entry-header related">
					<?php
					if ( !get_the_title($related_id) ) {
					?>
						<h2 class="entry-title"<?php cordero_schema_prop( 'headline' ); ?>><a href="<?php echo esc_url( get_permalink($related_id) ); ?>" rel="bookmark"><?php esc_html_e( 'No Title', 'cordero' ); ?></a></h2>
					<?php
					} else {
						echo '<h2 class="entry-title"' . cordero_schema_prop( 'headline', 'false' ) . '><a href="' . esc_url( get_permalink($related_id) ) . '" rel="bookmark">' . wp_kses_post( get_the_title($related_id) ) . '</a></h2>';
					}
					?>
				</header><!-- .entry-header -->

				<div class="entry-meta">
					<?php
					if ( !get_theme_mod( 'disable_author' ) ) {
						cordero_posted_by_related( $related_id );
					}
					if ( !get_theme_mod( 'disable_date' ) ) {
						cordero_posted_on_related( $related_id );
					}
					if ( !get_theme_mod( 'disable_cats' ) ) {
						cordero_entry_cats_related( $related_id );
					}
					?>
				</div><!-- .entry-meta -->

				<div class="entry-content"<?php cordero_schema_prop( 'text' ); ?>>
					<?php $related_excerpt = wp_kses_post( wpautop( get_post_field( 'post_excerpt', $related_id ) ) );
					if ( $related_excerpt == '' ) {
						$related_excerpt = wp_kses_post( wpautop( wp_trim_words( get_post_field( 'post_content', $related_id ), get_theme_mod( 'excerpt_length', '20' ) ) ) );
					}
					if ( $related_excerpt != '' ) {
						echo $related_excerpt;
					}
					if ( 'post' === get_post_type($related_id) && !get_theme_mod( 'disable_readmore' ) ) {
						$readmore_text = get_theme_mod( 'readmore_text' );
						if ( $readmore_text == '' ) {
							$readmore_text = esc_html__( 'Read More', 'cordero' );
						} else {
							$readmore_text = esc_html( $readmore_text );
						}
					?>
						<a class="more-tag" href="<?php echo esc_url( get_the_permalink($related_id) ); ?>" title="<?php echo esc_attr( get_the_title($related_id) ); ?>"><?php echo $readmore_text; ?></a>
					<?php
					} ?>
				</div><!-- .entry-content -->

				<div class="entry-footer">
					<?php
					cordero_entry_tags_related( $related_id );
					?>
				</div><!-- .entry-footer -->

			</article><!-- #post-<?php echo $related_id; ?> -->
			<?php } ?>
		</div><!-- #grid-loop -->
	</div>

<?php
}
wp_reset_postdata();
