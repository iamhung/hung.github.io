<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Cordero
 */


/**
 * Adds custom classes to the array of body classes
 *
 * @param array $classes Classes for the body element
 * @return array
 */
if ( !function_exists( 'cordero_body_classes' ) ) {
	function cordero_body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		if ( get_theme_mod( 'hide_tagline' ) ) {
			$classes[] = 'tagline-hidden';
		}

		if ( post_password_required() ) {
			$classes[] = 'post-password-required';
		}

		$sidebar_position = get_theme_mod( 'sidebar_position' );
		if ( $sidebar_position === 'left' ) {
			$classes[] = 'sidebar-left';
		} elseif ( $sidebar_position === 'below' ) {
			$classes[] = 'sidebar-below';
		}

		if ( get_theme_mod( 'header_layout' ) === 'masthead-left' ) {
			$classes[] = 'masthead-left';
		}

		return $classes;
	}
}
add_filter( 'body_class', 'cordero_body_classes' );


if ( !function_exists( 'cordero_primary_menu_sub_trigger' ) ) {
	function cordero_primary_menu_sub_trigger( $args, $item ) {
		if ( 'primary' === $args->theme_location ) {
			if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {
				$args->after = '<button class="sub-trigger"></button>';
			} else {
				$args->after = '';
			}
		}
		return $args;
	}
}
add_filter( 'nav_menu_item_args', 'cordero_primary_menu_sub_trigger', 10, 2 );


if ( !function_exists( 'cordero_primary_menu_fallback' ) ) {
	function cordero_primary_menu_fallback() {
		echo '<ul id="primary-menu" class="demo-menu">';
		if ( is_user_logged_in() && current_user_can( 'edit_theme_options' ) ) {
			echo '<li class="menu-item"><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Create your Primary Menu here', 'cordero' ) . '</a></li>';
		} else {
			wp_list_pages( array( 'depth' => 1, 'sort_column' => 'post_name', 'title_li' => '' ) );
		}		
		echo '</ul>';
	}
}


if ( !function_exists( 'cordero_footer_menu_fallback' ) ) {
	function cordero_footer_menu_fallback() {
		if ( function_exists( 'the_privacy_policy_link' ) ) {
			echo '<div class="site-info-right">';
			the_privacy_policy_link( '', '' );
			echo '</div>';
		}
	}
}


if ( !function_exists( 'cordero_custom_excerpt_length' ) ) {
	function cordero_custom_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		} else {
			return get_theme_mod( 'excerpt_length', '20' );
		}
	}
}
add_filter( 'excerpt_length', 'cordero_custom_excerpt_length', 999 );


if ( !function_exists( 'cordero_excerpt_more' ) ) {
	function cordero_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		} else {
			return '&hellip;';
		}
	}
}
add_filter( 'excerpt_more', 'cordero_excerpt_more' );


if ( !function_exists( 'cordero_archive_title_prefix' ) ) {
	function cordero_archive_title_prefix( $title ) {
		if ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = single_tag_title( '', false );
		} elseif ( is_author() ) {
			$title = '<span class="author vcard">' . get_avatar( get_the_author_meta( 'ID' ), '90' ) . esc_html( get_the_author() ) . '</span>';
		}
		return $title;
	}
}
add_filter( 'get_the_archive_title', 'cordero_archive_title_prefix' );


if ( !function_exists( 'cordero_header_menu' ) ) {
	function cordero_header_menu() {
		$header_layout = get_theme_mod( 'header_layout', '' );
		?>
		<button class="toggle-nav"></button>
		<?php cordero_before_site_nav(); ?>
		<div id="site-navigation" role="navigation"<?php cordero_schema_item( 'nav' ); ?>>
			<button class="toggle-nav-open"></button>
			<?php
			if ( $header_layout == 'logo-right' ) {
				cordero_header_content_extra();
			}
			?>
			<div class="site-main-menu">
			<?php cordero_before_main_menu(); ?>
			<?php wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_id'		=> 'primary-menu',
					'fallback_cb'	=> 'cordero_primary_menu_fallback',
				)
			); ?>
			<?php cordero_after_main_menu(); ?>
			</div>
			<?php
			if ( $header_layout == 'logo-left' || $header_layout == 'logo-below' || $header_layout == 'masthead-left' || $header_layout == '' ) {
				cordero_header_content_extra();
			}
			?>
			<button class="menu-close"><?php esc_html_e( 'Close Menu', 'cordero' ); ?></button>
		</div>
		<div id="site-nav-after" class="site-nav-after"></div>
		<?php cordero_after_site_nav(); ?>
		<?php
	}
}


if ( !function_exists( 'cordero_header_content' ) ) {
	function cordero_header_content() {
			cordero_site_branding_start();
		?>
				<?php if ( get_theme_mod( 'custom_logo' ) ) { ?>
					<div class="site-logo">
						<?php the_custom_logo(); ?>
					</div>
				<?php } else { ?>
				<?php if ( is_front_page() ) { ?>
					<h1 class="site-title"<?php cordero_schema_prop( 'name' ); ?>><a class="<?php echo esc_attr( get_theme_mod( 'site_title_style' ) );?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"<?php cordero_schema_prop( 'url' ); ?>><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a></h1>
				<?php } else { ?>
					<p class="site-title"<?php cordero_schema_prop( 'name' ); ?>><a class="<?php echo esc_attr( get_theme_mod( 'site_title_style' ) );?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"<?php cordero_schema_prop( 'url' ); ?>><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a></p>
				<?php } 
				} ?>				
					<div class="site-description"<?php cordero_schema_prop( 'desc' ); ?>><?php echo esc_html( get_bloginfo( 'description' ) ); ?></div>
		<?php
			cordero_site_branding_end();
	}
}


if ( !function_exists( 'cordero_transparent_header_content' ) ) {
	function cordero_transparent_header_content() {
			cordero_site_branding_start();
		?>
				<?php if ( get_theme_mod( 'logo_transparent_header' ) ) { ?>
					<div class="site-logo">
						<?php cordero_custom_logo_transparent(); ?>
					</div>
				<?php } else { ?>
				<?php if ( is_front_page() ) { ?>
					<h1 class="site-title"<?php cordero_schema_prop( 'name' ); ?>><a class="<?php echo esc_attr( get_theme_mod( 'site_title_style' ) );?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"<?php cordero_schema_prop( 'url' ); ?>><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a></h1>
				<?php } else { ?>
					<p class="site-title"<?php cordero_schema_prop( 'name' ); ?>><a class="<?php echo esc_attr( get_theme_mod( 'site_title_style' ) );?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"<?php cordero_schema_prop( 'url' ); ?>><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a></p>
				<?php } 
				} ?>				
					<div class="site-description"<?php cordero_schema_prop( 'desc' ); ?>><?php echo esc_html( get_bloginfo( 'description' ) ); ?></div>
		<?php
			cordero_site_branding_end();
	}
}


if ( !function_exists( 'cordero_custom_logo_transparent' ) ) {
	function cordero_custom_logo_transparent() {
		$html		  = '';
		$custom_logo_id = get_theme_mod( 'logo_transparent_header' );
	 
		// We have a logo. Logo is go.
		if ( $custom_logo_id ) {
			$custom_logo_attr = array(
				'class' => 'custom-logo',
			);

			if ( is_front_page() ) {
				/*
				 * If on the home page, set the logo alt attribute to an empty string,
				 * as the image is decorative and doesn't need its purpose to be described.
				 */
				$custom_logo_attr['alt'] = '';
			} else {
				/*
				 * If the logo alt attribute is empty, get the site title and explicitly pass it
				 * to the attributes used by wp_get_attachment_image().
				 */
				$image_alt = get_post_meta( $custom_logo_id, '_wp_attachment_image_alt', true );
				if ( empty( $image_alt ) ) {
					$custom_logo_attr['alt'] = get_bloginfo( 'name', 'display' );
				}
			}

			/*
			 * If the alt attribute is not empty, there's no need to explicitly pass it
			 * because wp_get_attachment_image() already adds the alt attribute.
			 */
			$image = wp_get_attachment_image( $custom_logo_id, 'full', false, $custom_logo_attr );

			if ( is_front_page() ) {
				// If on the home page, don't link the logo to home.
				$html = sprintf(
					'<span class="custom-logo-link">%1$s</span>',
					$image
				);
			} else {
				$html = sprintf(
					'<a href="%1$s" class="custom-logo-link" rel="home">%2$s</a>',
					esc_url( home_url( '/' ) ),
					$image
				);
			}
		} elseif ( is_customize_preview() ) {
			// If no logo is set but we're in the Customizer, leave a placeholder (needed for the live preview).
			$html = sprintf(
				'<a href="%1$s" class="custom-logo-link" style="display:none;"><img class="custom-logo"/></a>',
				esc_url( home_url( '/' ) )
			);
		}
	 	 
		echo $html;
	}
}


if ( !function_exists( 'cordero_header_content_customizer' ) ) {
	function cordero_header_content_customizer() {
			cordero_site_branding_start();
		?>
					<div class="site-logo">
						<?php the_custom_logo(); ?>
					</div>
				<?php if ( is_front_page() ) { ?>
					<h1 class="site-title"<?php cordero_schema_prop( 'name' ); ?>><a class="<?php echo esc_attr( get_theme_mod( 'site_title_style' ) );?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"<?php cordero_schema_prop( 'url' ); ?>><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a></h1>
				<?php } else { ?>
					<p class="site-title"<?php cordero_schema_prop( 'name' ); ?>><a class="<?php echo esc_attr( get_theme_mod( 'site_title_style' ) );?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"<?php cordero_schema_prop( 'url' ); ?>><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a></p>
				<?php } 
				?>				
					<div class="site-description"<?php cordero_schema_prop( 'desc' ); ?>><?php echo esc_html( get_bloginfo( 'description' ) ); ?></div>
		<?php
			cordero_site_branding_end();
	}
}


if ( !function_exists( 'cordero_transparent_header_content_customizer' ) ) {
	function cordero_transparent_header_content_customizer() {
			cordero_site_branding_start();
		?>
					<div class="site-logo">
						<?php cordero_custom_logo_transparent(); ?>
					</div>
				<?php if ( is_front_page() ) { ?>
					<h1 class="site-title"<?php cordero_schema_prop( 'name' ); ?>><a class="<?php echo esc_attr( get_theme_mod( 'site_title_style' ) );?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"<?php cordero_schema_prop( 'url' ); ?>><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a></h1>
				<?php } else { ?>
					<p class="site-title"<?php cordero_schema_prop( 'name' ); ?>><a class="<?php echo esc_attr( get_theme_mod( 'site_title_style' ) );?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"<?php cordero_schema_prop( 'url' ); ?>><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a></p>
				<?php } 
				?>				
					<div class="site-description"<?php cordero_schema_prop( 'desc' ); ?>><?php echo esc_html( get_bloginfo( 'description' ) ); ?></div>
		<?php
			cordero_site_branding_end();
	}
}


if ( !function_exists( 'cordero_site_branding_start' ) ) {
	function cordero_site_branding_start() {
		?>
			<?php cordero_before_site_branding(); ?>
			<div id="site-branding" class="<?php echo esc_attr( get_theme_mod( 'site_title_style', 'border' ) ); ?>"<?php cordero_schema_item( 'org' ); ?>>
		<?php
	}
}


if ( !function_exists( 'cordero_site_branding_end' ) ) {
	function cordero_site_branding_end() {
		?>
			</div><!-- #site-branding -->
			<?php cordero_after_site_branding(); ?>
		<?php
	}
}


if ( !function_exists( 'cordero_header_content_extra' ) ) {
	function cordero_header_content_extra() {
		?>
			<div class="extra-wrap noSwipe">
				<?php cordero_before_header_search(); ?>
				<?php cordero_header_search() ?>
				<?php cordero_header_account(); ?>
				<?php cordero_header_wishlist(); ?>
				<?php cordero_header_cart(); ?>
				<?php cordero_after_header_cart(); ?>
			</div>
		<?php
	}
}


if ( !function_exists( 'cordero_header_account' ) ) {
	function cordero_header_account() {
		if ( class_exists( 'WooCommerce' ) ) { ?>
			<div class="top-account">
			<?php $woo_account_page_id = get_option( 'woocommerce_myaccount_page_id' );
			if ( $woo_account_page_id ) { ?>
				<a class="cordero-account" href="<?php echo esc_url( get_permalink( $woo_account_page_id ) ); ?>" role="button"><span id="icon-user" class="icons cordero-icon-user"></span></a>
			<?php } else { ?>
				<span class="cordero-account" role="button"><span id="icon-user" class="icons cordero-icon-user"></span></span>
			<?php } ?>
				<div class="mini-account">
				<?php if ( is_user_logged_in() ) {
					woocommerce_account_navigation();
				} else {
					wc_get_template( 'myaccount/form-login.php' );
				} ?>
				</div>
			</div>
		<?php }
	}
}


if ( !function_exists( 'cordero_header_search' ) ) {
	function cordero_header_search() {
		?>
		<div class="top-search">
			<button class="icons cordero-icon-search"></button>
			<div class="mini-search">
			<?php if ( class_exists( 'WooCommerce' ) ) {
				get_product_search_form();
			} else {
				get_search_form();
			} ?>
			<button class="icons search-close"><?php esc_html_e( 'Close Search', 'cordero' ); ?></button>
			</div>
		</div>
	<?php }
}


if ( !function_exists( 'cordero_header_wishlist' ) ) {
	function cordero_header_wishlist() {
		if ( class_exists( 'WooCommerce' ) ) {
			if ( class_exists( 'YITH_WCWL' ) ) { ?>
				<div class="top-wishlist"><a class="cordero-wishlist" href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url() ); ?>" role="button"><span class="icons cordero-icon-heart"></span><span class="wishlist_products_counter_number"><?php echo yith_wcwl_count_all_products(); ?></span></a></div>
			<?php } elseif ( class_exists( 'TInvWL' ) ) { ?>
				<div class="top-wishlist"> <?php
				echo do_shortcode( '[ti_wishlist_products_counter show_icon="off" show_text="off"]' ); ?>
				</div> <?php
			}
		}
	}
}


if ( !function_exists( 'cordero_update_wishlist_count' ) ) {
	function cordero_update_wishlist_count() {
		if( class_exists( 'YITH_WCWL' ) ){
			wp_send_json( array(
				'count' => yith_wcwl_count_all_products()
			) );
		}
	}
}
add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'cordero_update_wishlist_count' );
add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'cordero_update_wishlist_count' );


if ( !function_exists( 'cordero_header_cart' ) ) {
	function cordero_header_cart() {
		if ( class_exists( 'WooCommerce' ) ) {
			$cart_items = WC()->cart->get_cart_contents_count();
			if ( $cart_items > 0 ) {
				$cart_class = ' items';
			} else {
				$cart_class = '';
			} ?>
					<div class="top-cart<?php echo $cart_class; ?>"><a class="cordero-cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>" role="button"><span class="icons cordero-icon-shopping-cart"></span><?php echo sprintf ( '<span class="item-count">%d</span>', $cart_items ); ?></a><div class="mini-cart"><?php woocommerce_mini_cart();?></div></div>
		<?php }
	}
}


/**
 * Update header mini-cart contents when products are added to the cart via AJAX
 */
if ( !function_exists( 'cordero_header_cart_update' ) ) {
	function cordero_header_cart_update( $fragments ) {
		$cart_items = WC()->cart->get_cart_contents_count();
		if ( $cart_items > 0 ) {
			$cart_class = ' items';
		} else {
			$cart_class = '';
		}
		ob_start();
		?>
					<div class="top-cart<?php echo $cart_class; ?>"><a class="cordero-cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>" role="button"><span class="icons cordero-icon-shopping-cart"></span><?php echo sprintf ( '<span class="item-count">%d</span>', $cart_items ); ?></a><div class="mini-cart"><?php woocommerce_mini_cart();?></div></div>
		<?php	
		$fragments['.top-cart'] = ob_get_clean();	
		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'cordero_header_cart_update' );


/**
 * Powered by WordPress
 */
if ( !function_exists( 'cordero_powered_by' ) ) {
	function cordero_powered_by() {
		?>
		<div class="site-info">
			<div class="copyright">
				<?php echo '&copy; ' . date_i18n( 'Y' ) . ' ' . esc_html( get_bloginfo( 'name' ) );	?>
			</div>
			<div class="theme">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'cordero' ) ); ?>"><?php printf( esc_html__( 'Powered by %s', 'cordero' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<?php /* translators: %2$s link to theme page, %1$s theme author */
				printf( esc_html__( 'Theme: %2$s by %1$s', 'cordero' ), 'UXL Themes', '<a href="https://uxlthemes.com/theme/cordero/" rel="designer">Cordero</a>' ); ?>
			</div>
		</div>
		<?php
	}
}


remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

add_action( 'woocommerce_before_main_content', 'cordero_theme_wrapper_start', 10);
add_action( 'woocommerce_after_main_content', 'cordero_theme_wrapper_end', 10);
add_action( 'woocommerce_before_shop_loop', 'cordero_shop_filter_section', 15);

add_action( 'woocommerce_before_shop_loop_item', 'cordero_before_shop_loop_item', 0);
add_action( 'woocommerce_before_subcategory', 'cordero_before_shop_loop_item', 0);

add_action( 'woocommerce_shop_loop_item_title', 'cordero_before_shop_loop_item_title', 0);
add_action( 'woocommerce_after_shop_loop_item_title', 'cordero_after_shop_loop_item_title', 100);

add_action( 'woocommerce_shop_loop_subcategory_title', 'cordero_before_shop_loop_cat_title', 0);
add_action( 'woocommerce_shop_loop_subcategory_title', 'cordero_after_shop_loop_item_title', 100);

add_action( 'woocommerce_after_shop_loop_item', 'cordero_before_shop_loop_addtocart', 6);
add_action( 'woocommerce_after_shop_loop_item', 'cordero_after_shop_loop_addtocart', 100);
add_action( 'woocommerce_after_subcategory', 'cordero_after_subcategory', 100);


if ( !function_exists( 'cordero_before_shop_loop_item' ) ) {
	function cordero_before_shop_loop_item() {
		echo '<div class="product-wrap">';
	}
}


if ( !function_exists( 'cordero_before_shop_loop_item_title' ) ) {
	function cordero_before_shop_loop_item_title() {
		global $product;
		$attachment_ids = $product->get_gallery_image_ids();
		if ( $attachment_ids && $product->get_image_id() ) {
			echo '<div class="product-extra-img">' . wp_get_attachment_image( $attachment_ids[0], 'woocommerce_thumbnail' ) . '</div>';
		}
		echo '<div class="product-detail-wrap">';
	}
}


if ( !function_exists( 'cordero_before_shop_loop_cat_title' ) ) {
	function cordero_before_shop_loop_cat_title() {
		echo '<div class="product-detail-wrap">';
	}
}


if ( !function_exists( 'cordero_after_shop_loop_item_title' ) ) {
	function cordero_after_shop_loop_item_title() {
		echo '</div>';
	}
}


if ( !function_exists( 'cordero_before_shop_loop_addtocart' ) ) {
	function cordero_before_shop_loop_addtocart() {
		echo '<div class="product-addtocart-wrap">';
	}
}


if ( !function_exists( 'cordero_after_shop_loop_addtocart' ) ) {
	function cordero_after_shop_loop_addtocart() {
		echo '</div></div>';
	}
}


if ( !function_exists( 'cordero_after_subcategory' ) ) {
	function cordero_after_subcategory() {
		echo '</div>';
	}
}


if ( !function_exists( 'cordero_shop_filter_section' ) ) {
	function cordero_shop_filter_section() {
		if ( !is_product() ) {
			get_sidebar( 'shop-filters' );
		}
	}
}


if ( !function_exists( 'cordero_theme_wrapper_start' ) ) {
	function cordero_theme_wrapper_start() {
		if ( !is_active_sidebar( 'cordero-sidebar-shop' ) || is_product() || get_theme_mod( 'sidebar_position' ) === 'below' ) {
			$page_full_width = ' full-width';
		} else {
			$page_full_width = '';
		}
		cordero_before_primary_content();
		echo '<div id="primary" class="content-area'.$page_full_width.'">
			<main id="main" class="site-main" role="main">';
	}
}


if ( !function_exists( 'cordero_theme_wrapper_end' ) ) {
	function cordero_theme_wrapper_end() {
		echo '</main><!-- #main -->
		</div><!-- #primary -->';
		cordero_after_primary_content();
		if ( !is_product() ) {
			get_sidebar( 'shop' );
		}
	}
}


if ( !function_exists( 'cordero_change_prev_next' ) ) {
	function cordero_change_prev_next( $args ) {
		$args['prev_text'] = '<i class="dashicons dashicons-arrow-left-alt2"></i>';
		$args['next_text'] = '<i class="dashicons dashicons-arrow-right-alt2"></i>';
		return $args;
	}
}
add_filter( 'woocommerce_pagination_args', 'cordero_change_prev_next' );


if ( !function_exists( 'cordero_woocommerce_placeholder_img_src' ) ) {
	function cordero_woocommerce_placeholder_img_src() {
		return esc_url( get_template_directory_uri() ) . '/images/woocommerce-placeholder.png';
	}
}
if ( !get_option( 'woocommerce_placeholder_image', 0 ) ) {
	add_filter('woocommerce_placeholder_img_src', 'cordero_woocommerce_placeholder_img_src');
}


if ( !function_exists( 'cordero_upsell_products_args' ) ) {
	function cordero_upsell_products_args( $args ) {
		$col_per_page = esc_attr( get_option( 'woocommerce_catalog_columns', 5 ) );
		$args['posts_per_page'] = $col_per_page;
		$args['columns'] = $col_per_page;
		return $args;
	}
}
add_filter( 'woocommerce_upsell_display_args', 'cordero_upsell_products_args' );


if ( !function_exists( 'cordero_related_products_args' ) ) {
	function cordero_related_products_args( $args ) {
		$col_per_page = esc_attr( get_option( 'woocommerce_catalog_columns', 5 ) );
		$args['posts_per_page'] = $col_per_page;
		$args['columns'] = $col_per_page;
		return $args;
	}
}
add_filter( 'woocommerce_output_related_products_args', 'cordero_related_products_args' );


if ( !function_exists( 'cordero_woocommerce_gallery_thumbnail_size' ) ) {
	function cordero_woocommerce_gallery_thumbnail_size( $size ) {
		return 'woocommerce_thumbnail';
	}
}
add_filter( 'woocommerce_gallery_thumbnail_size', 'cordero_woocommerce_gallery_thumbnail_size' );


/*
 * see: woocommerce/packages/woocommerce-blocks/src/BlockTypes/AbstractProductGrid.php
*/
if ( !function_exists( 'cordero_wc_product_block' ) ) {
	function cordero_wc_product_block( $html, $data, $product ) {
		$html = '<li class="wc-block-grid__product">
			<a href="' . $data->permalink . '" class="wc-block-grid__product-link">
				' . $data->image . '
				' . cordero_wc_block_extra_img( $product ) . '
				' . $data->title . '
			</a>
			' . $data->badge . '
			' . $data->price . '
			' . $data->rating . '
			' . $data->button . '
		</li>';
		return $html;
	}
}
add_filter( 'woocommerce_blocks_product_grid_item_html', 'cordero_wc_product_block', 10, 3);


if ( !function_exists( 'cordero_wc_block_extra_img' ) ) {
	function cordero_wc_block_extra_img( $product ) {
		$attachment_ids = $product->get_gallery_image_ids();
		if ( $attachment_ids && $product->get_image_id() ) {
			return '<div class="product-extra-img">' . wp_get_attachment_image( $attachment_ids[0], 'woocommerce_thumbnail' ) . '</div>';
		}
	}
}


/**
 * Exclude custom logo image from Jetpack lazy load
 */
if(!function_exists( 'cordero_exclude_class_from_lazy_load' )){
	function cordero_exclude_class_from_lazy_load( $classes ) {
		$classes[] = 'custom-logo';
		return $classes;
	}
}
add_filter( 'jetpack_lazy_images_blocked_classes', 'cordero_exclude_class_from_lazy_load', 999, 1 );


/**
 * Disable image scaling
 * since WP 5.3 any uploaded image larger than 2560px (height or width) is scaled to max 2560px
 */
add_filter( 'big_image_size_threshold', '__return_false' );
