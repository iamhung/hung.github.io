<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Cordero
 */

if ( ! function_exists( 'cordero_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function cordero_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s"' . cordero_schema_prop( 'time-publish', 'false' ) . '>%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s"' . cordero_schema_prop( 'time-publish', 'false' ) . '>%2$s</time><time class="updated" datetime="%3$s"' . cordero_schema_prop( 'time-update', 'false' ) . '>%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		echo '<span class="posted-on">' . $time_string . '</span>';

		$meta_separator = '<span class="meta-separator">|</span>';

		if ( is_single() ) {
			if ( get_theme_mod( 'disable_cats_single' ) ) {
				$meta_separator = '';
			}
		} else {
			if ( get_theme_mod( 'disable_cats' ) ) {
				$meta_separator = '';
			}
		}

		echo $meta_separator;

	}
endif;

if ( ! function_exists( 'cordero_posted_on_related' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function cordero_posted_on_related( $related_id ) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s"' . cordero_schema_prop( 'time-publish', 'false' ) . '>%2$s</time>';
		if ( get_the_time( 'U', $related_id ) !== get_the_modified_time( 'U', $related_id ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s"' . cordero_schema_prop( 'time-publish', 'false' ) . '>%2$s</time><time class="updated" datetime="%3$s"' . cordero_schema_prop( 'time-update', 'false' ) . '>%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c', $related_id ) ),
			esc_html( get_the_date( '', $related_id ) ),
			esc_attr( get_the_modified_date( 'c', $related_id ) ),
			esc_html( get_the_modified_date( '', $related_id ) )
		);

		echo '<span class="posted-on">' . $time_string . '</span>';

		$meta_separator = '<span class="meta-separator">|</span>';

		if ( get_theme_mod( 'disable_cats' ) ) {
			$meta_separator = '';
		}
		
		echo $meta_separator;

	}
endif;

if ( ! function_exists( 'cordero_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function cordero_posted_by() {
		$meta_separator = '<span class="meta-separator">|</span>';
		if ( is_single() ) {
			if ( get_theme_mod( 'disable_date_single' ) && get_theme_mod( 'disable_cats_single' ) ) {
				$meta_separator = '';
			}
			echo '<span class="byline"><span class="author vcard"' . cordero_schema_item( 'author', 'false' ) . '><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"' . cordero_schema_prop( 'url', 'false' ) . '><span class="author-name"' . cordero_schema_prop( 'name', 'false' ) . '>' . esc_html( get_the_author() ) . '</span></a></span></span>' . $meta_separator;
		} else {
			if ( get_theme_mod( 'disable_date' ) && get_theme_mod( 'disable_cats' ) ) {
				$meta_separator = '';
			}
			echo '<span class="byline"><span class="author vcard"' . cordero_schema_item( 'author', 'false' ) . '><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"' . cordero_schema_prop( 'url', 'false' ) . '><span class="author-name"' . cordero_schema_prop( 'name', 'false' ) . '>' . esc_html( get_the_author() ) . '</span></a></span></span>' . $meta_separator;
		}

	}
endif;

if ( ! function_exists( 'cordero_posted_by_related' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function cordero_posted_by_related( $related_id ) {

		$author_id = get_post_field( 'post_author', $related_id );

		$meta_separator = '<span class="meta-separator">|</span>';

		if ( get_theme_mod( 'disable_date' ) && get_theme_mod( 'disable_cats' ) ) {
			$meta_separator = '';
		}
		echo '<span class="byline"><span class="author vcard"' . cordero_schema_item( 'author', 'false' ) . '><a class="url fn n" href="' . esc_url( get_author_posts_url( $author_id ) ) . '"' . cordero_schema_prop( 'url', 'false' ) . '><span class="author-name"' . cordero_schema_prop( 'name', 'false' ) . '>' . esc_html( get_the_author_meta( 'display_name', $author_id ) ) . '</span></a></span></span>' . $meta_separator;

	}
endif;

if ( ! function_exists( 'cordero_entry_cats' ) ) :
	/**
	 * Prints HTML with meta information for the categories only.
	 */
	function cordero_entry_cats() {
		// Hide category text for pages.
		if ( 'post' === get_post_type() ) {

			/* translators: used between list items, there is a space after the comma */
			$list_item_seperator = esc_html__( ', ', 'cordero' );

			$categories_list = get_the_category_list( $list_item_seperator );
			if ( $categories_list ) {
				echo '<span class="cat-links">' . $categories_list . '</span>';
			}

		}

	}
endif;

if ( ! function_exists( 'cordero_entry_cats_related' ) ) :
	/**
	 * Prints HTML with meta information for the categories only.
	 */
	function cordero_entry_cats_related( $related_id ) {

		/* translators: used between list items, there is a space after the comma */
		$list_item_seperator = esc_html__( ', ', 'cordero' );

		$categories_list = get_the_category_list( $list_item_seperator, '', $related_id );
		if ( $categories_list ) {
			echo '<span class="cat-links">' . $categories_list . '</span>';
		}

	}
endif;

if ( ! function_exists( 'cordero_entry_tags' ) ) :
	/**
	 * Prints HTML with meta information for the tags only.
	 */
	function cordero_entry_tags() {
		if ( !get_theme_mod( 'disable_tags' ) ) {
			// Hide tag text for pages.
			if ( 'post' === get_post_type() ) {

				/* translators: used between list items, there is a space after the comma */
				$list_item_seperator = esc_html__( ', ', 'cordero' );

				$tags_list = get_the_tag_list( '', $list_item_seperator );
				if ( $tags_list ) {
					echo '<span class="tags-links"><i class="cordero-icon-tag"></i> ' . $tags_list . '</span>';
				}

			}
		}
	}
endif;

if ( ! function_exists( 'cordero_entry_tags_related' ) ) :
	/**
	 * Prints HTML with meta information for the tags only.
	 */
	function cordero_entry_tags_related( $related_id ) {
		if ( !get_theme_mod( 'disable_tags' ) ) {

			/* translators: used between list items, there is a space after the comma */
			$list_item_seperator = esc_html__( ', ', 'cordero' );

			$tags_list = get_the_tag_list( '', $list_item_seperator, '', $related_id );
			if ( $tags_list ) {
				echo '<span class="tags-links"><i class="cordero-icon-tag"></i> ' . $tags_list . '</span>';
			}

		}
	}
endif;

if ( ! function_exists( 'cordero_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function cordero_entry_footer() {
		if ( !get_theme_mod( 'disable_tags_single' ) ) {
			// Hide tag text for pages.
			if ( 'post' === get_post_type() ) {

				/* translators: used between list items, there is a space after the comma */
				$list_item_seperator = esc_html__( ', ', 'cordero' );

				$tags_list = get_the_tag_list( '', $list_item_seperator );
				if ( $tags_list ) {
					echo '<span class="tags-links"><i class="cordero-icon-tag"></i> ' . $tags_list . '</span>';
				}

			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'cordero' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'cordero' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'cordero_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function cordero_post_thumbnail() {

		$thumbnail_on = false;
		$thumbnail_exists = false;

		if ( has_post_thumbnail() ) {
			$thumbnail_on = true;
			$thumbnail_exists = true;
		}

		$thumbnail_placeholder = get_theme_mod( 'featured_image' );
		if ( $thumbnail_placeholder != '' ) {
			$thumbnail_on = true;
		}

		if ( get_theme_mod( 'disable_img' ) ) {
			$thumbnail_on = false;
		}

		if ( post_password_required() || is_attachment() || ! $thumbnail_on ) {
			return;
		}

		if ( is_singular() ) :
			?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail( get_theme_mod( 'single_img_size', 'full' ), cordero_schema_prop( 'wp-thumb', 'false' ) ); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php
		if ( $thumbnail_exists ) {
			the_post_thumbnail( get_theme_mod( 'archive_img_size', 'large' ), array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
		} else {
			echo '<img class="featured-image-placeholder" src="' . $thumbnail_placeholder . '">';
		}
		?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'cordero_related_post_thumbnail' ) ) :
	function cordero_related_post_thumbnail($related_id) {

		$thumbnail_on = false;
		$thumbnail_exists = false;

		if ( has_post_thumbnail($related_id) ) {
			$thumbnail_on = true;
			$thumbnail_exists = true;
		}

		$thumbnail_placeholder = get_theme_mod( 'featured_image' );
		if ( $thumbnail_placeholder != '' ) {
			$thumbnail_on = true;
		}

		if ( get_theme_mod( 'disable_img' ) ) {
			$thumbnail_on = false;
		}

		if ( post_password_required($related_id) || is_attachment($related_id) || ! $thumbnail_on ) {
			return;
		}
		?>

		<a class="post-thumbnail" href="<?php the_permalink($related_id); ?>" aria-hidden="true">
		<?php
		if ( $thumbnail_exists ) {
			echo get_the_post_thumbnail( $related_id, get_theme_mod( 'archive_img_size', 'large' ), array(
				'alt' => the_title_attribute( array(
					'echo' => false,
					'post' => $related_id,
				) ),
			) );
		} else {
			echo '<img class="featured-image-placeholder" src="' . $thumbnail_placeholder . '">';
		}
		?>
		</a>

		<?php
	}
endif;

if ( ! function_exists( 'cordero_read_more' ) ) :
	function cordero_read_more() {

		if ( 'post' === get_post_type() && !get_theme_mod( 'disable_readmore' ) ) {
			$readmore_text = get_theme_mod( 'readmore_text' );
			if ( $readmore_text == '' ) {
				$readmore_text = esc_html__( 'Read More', 'cordero' );
			} else {
				$readmore_text = esc_html( $readmore_text );
			}
		?>
			<a class="more-tag" href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php echo $readmore_text; ?></a>
		<?php
		}

	}
endif;
