<?php
/**
 * Output the customizer styling changes
 *
 * @package Cordero
 */
if ( !function_exists( 'cordero_css_font_family' ) ) {
	function cordero_css_font_family( $font_family ) {
		if ( strpos( $font_family, ':' ) ) {
			$font_family = substr( $font_family, 0, strpos( $font_family, ':' ) );
			return 'font-family:\'' . cordero_esc_font_family( $font_family ) . '\'';
		} else {			
			return 'font-family:' . cordero_esc_font_family( $font_family );
		}
	}
}


function cordero_esc_font_family( $input ) {
	$input = wp_kses( $input, array(
		'"' => array(),
		)
	);
	return $input;
}


if ( !function_exists( 'cordero_dynamic_style' ) ) {
	function cordero_dynamic_style( $css = array() ) {

		$font_content = get_theme_mod( 'font_content' );
		$font_headings = get_theme_mod( 'font_headings' );
		$font_site_title = get_theme_mod( 'font_site_title' );
		$font_nav = get_theme_mod( 'font_nav' );

		if ( $font_content ) {
			$font_site_title_on = 1;
			$font_nav_on = 1;
			$css[] = 'body,button,input,select,textarea{' . cordero_css_font_family( $font_content ) . ';}';
			if ( $font_site_title ) {
				$css[] = '.site-title{' . cordero_css_font_family( $font_site_title ) . ';}';
			} else {
				$css[] = '.site-title{font-family:\'Montserrat\';}';
			}
			if ( $font_nav ) {
				$css[] = '#site-navigation .site-main-menu{' . cordero_css_font_family( $font_nav ) . ';}';
			} else {
				$css[] = '#site-navigation .site-main-menu{font-family:\'Work Sans\';}';
			}
		} else {
			$font_site_title_on = 0;
			$font_nav_on = 0;
		}

		if ( $font_headings ) {
			$css[] = 'h1:not(.site-title),h2,h3,h4,h5,h6,blockquote,.wc-block-grid__product .wc-block-grid__product-title,.wp-block-latest-posts.is-grid li > a{' . cordero_css_font_family( $font_headings ) . ';}';
		}

		if ( $font_site_title && $font_site_title_on == 0 ) {
			$css[] = '.site-title{' . cordero_css_font_family( $font_site_title ) . ';}';
		}

		if ( $font_nav && $font_nav_on == 0 ) {
			$css[] = '#site-navigation .site-main-menu{' . cordero_css_font_family( $font_nav ) . ';}';
		}
		
		$fs_base = get_theme_mod( 'fs_base', '16' );
		if ( $fs_base && $fs_base != '16' ) {
			$css[] = 'body,button,input,select,textarea{font-size:' . esc_attr($fs_base) . 'px;}';
		}

		$menu_uppercase = get_theme_mod( 'menu_uppercase', 'uppercase' );
		if ( $menu_uppercase == 'none' ) {
			$css[] = '#primary-menu > li{text-transform:none;}';
		}

		if ( class_exists( 'WooCommerce' ) ) {
			$woo_uncat_id = term_exists( 'uncategorized', 'product_cat' );
			if ( $woo_uncat_id != NULL ) {
				$woo_uncat_id = $woo_uncat_id['term_id'];
				$css[] = '#shop-filters .widget_product_categories li.cat-item-' . $woo_uncat_id . '{display:none;}';
			}
		}

		$container_width = get_theme_mod( 'container_width', '1240' );
		if ( $container_width && $container_width != '1240' ) {
			$css[] = '.container,.wp-block-cover-image.alignfull > .wp-block-cover-image__inner-container > .wp-block-group,.wp-block-cover.alignfull > .wp-block-cover__inner-container > .wp-block-group,.wp-block-group.alignfull > .wp-block-group__inner-container > .wp-block-group{max-width:' . esc_attr($container_width) . 'px;}';
		}

		$accent_color = get_theme_mod( 'accent_color', '#d82978' );
		if ( $accent_color && $accent_color != '#d82978' ) {
			$accent_color = esc_attr($accent_color);

			$css[] = 'a,#masthead .top-account .mini-account a,#masthead.transparent #site-navigation .top-account .mini-account a:not(.button),#masthead .top-cart .mini-cart a,#masthead.transparent .top-cart .mini-cart a:not(.button),#masthead.transparent #site-navigation .top-cart .mini-cart a:not(.button),.site-footer a,#add_payment_method .cart-collaterals .cart_totals .discount td,.woocommerce-cart .cart-collaterals .cart_totals .discount td,.woocommerce-checkout .cart-collaterals .cart_totals .discount td,.woocommerce .product-addtocart-wrap a.button,.woocommerce .product-addtocart-wrap a.button:hover,.woocommerce .product-addtocart-wrap a.added_to_cart,.woocommerce .product-addtocart-wrap a.added_to_cart:hover,.wc-block-grid__product .wc-block-grid__product-add-to-cart a.add_to_cart_button,.wc-block-grid__product .wc-block-grid__product-add-to-cart a.added_to_cart,.infinite-loader,.has-accent-color-color,.wp-block-button__link.has-accent-color-color,.wp-block-button.is-style-outline .wp-block-button__link.has-accent-color-color,hr.wp-block-separator.has-accent-color-color,.wp-block-group.testimonial:before{color:' . $accent_color . ';}';

			$css[] = '.button,a.button,button,input[type="button"],input[type="reset"],input[type="submit"],#infinite-handle span button,#infinite-handle span button:hover,#infinite-handle span button:focus,#infinite-handle span button:active,.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt,.woocommerce a.added_to_cart,.woocommerce #respond input#submit.alt.disabled,.woocommerce #respond input#submit.alt.disabled:hover,.woocommerce #respond input#submit.alt:disabled,.woocommerce #respond input#submit.alt:disabled:hover,.woocommerce #respond input#submit.alt:disabled[disabled],.woocommerce #respond input#submit.alt:disabled[disabled]:hover,.woocommerce a.button.alt.disabled,.woocommerce a.button.alt.disabled:hover,.woocommerce a.button.alt:disabled,.woocommerce a.button.alt:disabled:hover,.woocommerce a.button.alt:disabled[disabled],.woocommerce a.button.alt:disabled[disabled]:hover,.woocommerce button.button.alt.disabled,.woocommerce button.button.alt.disabled:hover,.woocommerce button.button.alt:disabled,.woocommerce button.button.alt:disabled:hover,.woocommerce button.button.alt:disabled[disabled],.woocommerce button.button.alt:disabled[disabled]:hover,.woocommerce input.button.alt.disabled,.woocommerce input.button.alt.disabled:hover,.woocommerce input.button.alt:disabled,.woocommerce input.button.alt:disabled:hover,.woocommerce input.button.alt:disabled[disabled],.woocommerce input.button.alt:disabled[disabled]:hover,.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover,.woocommerce a.button.alt:hover,.woocommerce button.button.alt:hover,.woocommerce input.button.alt:hover,.woocommerce a.added_to_cart,.woocommerce a.added_to_cart:hover,#grid-loop article.sticky:before,#main .infinite-wrap article.sticky:before,#footer-menu a[href^="mailto:"]:before,.widget_nav_menu a[href^="mailto:"]:before,#footer-menu a[href^="tel:"]:before,.widget_nav_menu a[href^="tel:"]:before{background:' . $accent_color . ';}';

			$css[] = '.woocommerce span.onsale,.woocommerce ul.products li.product .onsale,.woocommerce .widget_price_filter .ui-slider .ui-slider-range,.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,.wp-block-button__link,.wc-block-price-filter .wc-block-price-filter__range-input::-webkit-slider-thumb,.wc-block-price-filter .wc-block-price-filter__range-input::-moz-range-thumb,.wc-block-price-filter .wc-block-price-filter__range-input::-webkit-slider-thumb,.wc-block-price-filter .wc-block-price-filter__range-input::-moz-range-thumb,.wc-block-grid__product-onsale,.has-accent-color-background-color,.wp-block-button__link.has-accent-color-background-color,hr.wp-block-separator.has-accent-color-background-color{background-color:' . $accent_color . ';}';

			$css[] = '.woocommerce-info,.woocommerce-message{border-color:' . $accent_color . ';}';

			$css[] = '.wc-block-price-filter .wc-block-price-filter__range-input-wrapper .wc-block-price-filter__range-input-progress,.rtl .wc-block-price-filter .wc-block-price-filter__range-input-wrapper .wc-block-price-filter__range-input-progress{--range-color:' . $accent_color . ';}';

		}

		$accent_color2 = get_theme_mod( 'accent_color2', '#2d2354' );
		if ( $accent_color2 && $accent_color2 != '#2d2354' ) {
			$accent_color2 = esc_attr($accent_color2);

			$css[] = '.has-accent-color-2-color,.wp-block-button__link.has-accent-color-2-color,.wp-block-button.is-style-outline .wp-block-button__link.has-accent-color-2-color,hr.wp-block-separator.has-accent-color-2-color{color:' . $accent_color2 . ';}';

			$css[] = '#masthead.transparent.scrolled,#colophon,.wp-block-cover,.wp-block-cover-image,.has-accent-color-2-background-color,.wp-block-button__link.has-accent-color-2-background-color,hr.wp-block-separator.has-accent-color-2-background-color,.featured-style-1 .wp-block-image figure,.wc-block-featured-product,.wc-block-featured-category{background-color:' . $accent_color2 . ';}';

			$accent_color2_rgb = cordero_hex2RGB($accent_color2);
			$css[] = '.featured-style-1 .wp-block-image figure{box-shadow: 0px 0px 0px 4px rgba( '.$accent_color2_rgb['r'].', '.$accent_color2_rgb['g'].', '.$accent_color2_rgb['b'].',0.45);}';

		}

		$accent_color3 = get_theme_mod( 'accent_color3', '#fbfbfb' );
		if ( $accent_color3 && $accent_color3 != '#fbfbfb' ) {
			$accent_color3 = esc_attr($accent_color3);

			$css[] = '.has-accent-color-3-color,.wp-block-button__link.has-accent-color-3-color,.wp-block-button.is-style-outline .wp-block-button__link.has-accent-color-3-color,hr.wp-block-separator.has-accent-color-3-color{color:' . $accent_color3 . ';}';

			$css[] = 'th,.woocommerce ul.products li.product,.woocommerce-page ul.products li.product,#secondary,ul.archive-sub-cats li,#shop-filters,article.comment-body,.wp-caption-text,.pagination span,.pagination .dots,.pagination a,.woocommerce nav.woocommerce-pagination ul li a,.woocommerce nav.woocommerce-pagination ul li span,.woocommerce div.product .woocommerce-tabs ul.tabs li,.wp-block-woocommerce-attribute-filter,.wp-block-woocommerce-price-filter,.wp-block-woocommerce-active-filters > h5,.wp-block-woocommerce-active-filters > div,.wp-block-woocommerce-active-filters > div:last-child,.wc-block-grid__product{background:' . $accent_color3 . ';}';

			$css[] = 'input[type="text"],input[type="email"],input[type="url"],input[type="password"],input[type="search"],input[type="number"],input[type="tel"],input[type="range"],input[type="date"],input[type="month"],input[type="week"],input[type="time"],input[type="datetime"],input[type="datetime-local"],input[type="color"],textarea,select,input[type="text"]:focus,input[type="email"]:focus,input[type="url"]:focus,input[type="password"]:focus,input[type="search"]:focus,input[type="number"]:focus,input[type="tel"]:focus,input[type="range"]:focus,input[type="date"]:focus,input[type="month"]:focus,input[type="week"]:focus,input[type="time"]:focus,input[type="datetime"]:focus,input[type="datetime-local"]:focus,input[type="color"]:focus,textarea:focus,select:focus,.shop-filter-wrap .shop-filter-toggle,.woocommerce div.product form.cart div.quantity input[type="button"],.featured-style-1 .wp-block-columns .wp-block-column,.wp-block-columns.featured-style-1 .wp-block-column,.wp-block-columns.pricing-table .wp-block-column,.has-accent-color-3-background-color,.wp-block-button__link.has-accent-color-3-background-color,hr.wp-block-separator.has-accent-color-3-background-color{background-color:' . $accent_color3 . ';}';

			$css[] = '.comment-navigation .nav-next a:after{border-left-color:' . $accent_color3 . ';}';
			$css[] = '.comment-navigation .nav-previous a:after{border-right-color:' . $accent_color3 . ';}';

			$css[] = '@media (min-width: 1025px){.masthead-left #masthead{background:' . $accent_color3 . ';}}';

			$css[] = '@media (max-width: 1024px){.toggle-nav-open,.toggle-nav-open:hover{background:' . $accent_color3 . ';}}';

		}

		if ( get_theme_mod( 'header_search_off' ) ) {
			$css[] = '#masthead .top-search{display:none;}';
		}

		$blog_post_style = get_theme_mod( 'blog_post_style', 'plain' );
		if ( $blog_post_style == 'border' ) {
			if ($accent_color3 && $accent_color3 != "#fbfbfb") {
				$blog_post_bg = $accent_color3;
			} else {
				$blog_post_bg = '#fbfbfb';
			}
			$css[] = '#grid-loop article,#main .infinite-wrap article,.wp-block-latest-posts.is-grid li{background:' . esc_attr($blog_post_bg) . ';border:1px solid #f1f1f1;padding:1em;}';
		} elseif ( $blog_post_style == 'shadow' ) {
			if ($accent_color3 && $accent_color3 != "#fbfbfb") {
				$blog_post_bg = $accent_color3;
			} else {
				$blog_post_bg = '#fbfbfb';
			}
			$css[] = '#grid-loop article,#main .infinite-wrap article,.wp-block-latest-posts.is-grid li{background:' . esc_attr($blog_post_bg) . ';border-radius:6px;padding:1em;box-shadow: 5px 5px 0 rgba(0, 0, 0, 0.03);}';
		}

		$post_spacing = get_theme_mod( 'post_spacing', 'space-between' );
		if ( $post_spacing && $post_spacing != 'space-between' ) {
			$css[] = '#grid-loop article,#main .infinite-wrap article,.wp-block-latest-posts.is-grid li{justify-content:' . esc_attr($post_spacing) . ';}';
		}

		$reading_width = get_theme_mod( 'reading_width', '640' );
		if ( $reading_width && $reading_width != '640' ) {
			$css[] = '.post-template-template-single-reading .single-entry-content,.post-template-template-single-reading-paragraph .single-entry-content p{max-width:' . esc_attr($reading_width) . 'px;}';
		}

		return implode( '', $css );

	}
}


if ( !function_exists( 'cordero_editor_dynamic_style' ) ) {
	function cordero_editor_dynamic_style( $mceInit, $css = array() ) {

		$font_content = get_theme_mod( 'font_content' );
		if ( $font_content ) {
			$css[] = 'body.mce-content-body{' . cordero_css_font_family( $font_content ) . ';}';
		}

		$font_headings = get_theme_mod( 'font_headings' );
		if ( $font_headings ) {
			$css[] = '.mce-content-body h1,.mce-content-body h2,.mce-content-body h3,.mce-content-body h4,.mce-content-body h5,.mce-content-body h6{' . cordero_css_font_family( $font_headings ) . ';}';
		}

		$accent_color = get_theme_mod( 'accent_color' );
		if ( $accent_color ) {
			$css[] = '.mce-content-body a:not(.button),.mce-content-body a:hover:not(.button),.mce-content-body a:focus:not(.button),.mce-content-body a:active:not(.button){color:' . esc_attr( $accent_color ) . '}';
		}

		$styles = implode( '', $css );

		if ( isset( $mceInit['content_style'] ) ) {
			$mceInit['content_style'] .= ' ' . $styles . ' ';
		} else {
			$mceInit['content_style'] = $styles . ' ';
		}
		return $mceInit;

	}
}
add_filter( 'tiny_mce_before_init', 'cordero_editor_dynamic_style' );


function cordero_block_editor_dynamic_style( $css = array() ) {

	$container_width = get_theme_mod( 'container_width', '1240' );
	if ( $container_width && $container_width != '1240' ) {
		$css[] = '.edit-post-visual-editor,[data-align="full"] .wp-block-cover-image > .wp-block-cover-image__inner-container > .wp-block-group,[data-align="full"] .wp-block-cover > .wp-block-cover__inner-container > .wp-block-group,[data-align="full"] .wp-block-group > .wp-block-group__inner-container > .wp-block-group{max-width:' . esc_attr ( $container_width ) . 'px;}';
	}

	$full_width = $container_width + 280;
	$css[] = '@media (max-width:' . esc_attr ( $full_width ) . 'px){.edit-post-layout.is-sidebar-opened .wp-block[data-align="full"]{margin-left: 0 !important;margin-right: 0 !important;}}';

	$background_color = get_theme_mod( 'background_color', 'ffffff' );
	if ( $background_color && $background_color != 'ffffff' ) {
		$css[] = '.edit-post-layout .interface-interface-skeleton__content,.block-editor-editor-skeleton__body,.edit-post-visual-editor{background-color:#' . esc_attr( $background_color ) . '}';
	}

	$font_content = get_theme_mod( 'font_content', 'Work Sans:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i' );
	if ($font_content && $font_content != 'Work Sans:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i' ) {
		$css[] = '.editor-default-block-appender textarea.editor-default-block-appender__content,.editor-styles-wrapper div,.editor-styles-wrapper p,.editor-styles-wrapper ul,.editor-styles-wrapper li{' . cordero_css_font_family( $font_content ) . ';}';
	}

	$font_headings = get_theme_mod( 'font_headings', 'Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i' );
	if ($font_headings && $font_headings != 'Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i' ) {
		$css[] = '.editor-post-title__block .editor-post-title__input,.editor-styles-wrapper h1,.editor-styles-wrapper h2,.editor-styles-wrapper h3,.editor-styles-wrapper h4,.editor-styles-wrapper h5,.editor-styles-wrapper h6,.wp-block-latest-posts.is-grid li > a > div,.editor-styles-wrapper .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-title,.wc-block-grid__product .wc-block-grid__product-title{' . cordero_css_font_family( $font_headings ) . ';}';
	}

	$accent_color = get_theme_mod( 'accent_color' );
	if ($accent_color && $accent_color != "#d82978") {		
		$css[] = '.editor-rich-text__tinymce a,.block-editor-rich-text__editable a,.wp-block-latest-posts.is-grid li > a,.wc-block-grid__product .wc-block-grid__product-add-to-cart,.wc-block-grid__product .wc-block-grid__product-add-to-cart a.add_to_cart_button,.wc-block-grid__product .wc-block-grid__product-add-to-cart a.added_to_cart,.wp-block-group.testimonial:before{color:'.esc_attr($accent_color).'}';

		$css[] = '.wp-block-button__link,.wc-block-price-filter .wc-block-price-filter__range-input::-webkit-slider-thumb,.wc-block-price-filter .wc-block-price-filter__range-input::-moz-range-thumb,.wc-block-price-filter .wc-block-price-filter__range-input::-webkit-slider-thumb,.wc-block-price-filter .wc-block-price-filter__range-input::-moz-range-thumb,.editor-styles-wrapper .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-onsale,.wc-block-grid__product-onsale{background-color:' . esc_attr( $accent_color ) . ';}';

		$css[] = '.wc-block-price-filter .wc-block-price-filter__range-input-wrapper .wc-block-price-filter__range-input-progress,.rtl .wc-block-price-filter .wc-block-price-filter__range-input-wrapper .wc-block-price-filter__range-input-progress{--range-color:' . esc_attr( $accent_color ) . ';}';
	}

	$accent_color2 = get_theme_mod( 'accent_color2' );
	if ($accent_color2 && $accent_color2 != "#2d2354") {		

		$css[] = '.wc-block-featured-product,.wc-block-featured-category,.featured-style-1 figure.wp-block-image > div{background-color:' . esc_attr( $accent_color2 ) . ';}';

		$accent_color2_rgb = cordero_hex2RGB($accent_color2);
		$css[] = '.featured-style-1 figure.wp-block-image > div{box-shadow: 0px 0px 0px 4px rgba( '.$accent_color2_rgb['r'].', '.$accent_color2_rgb['g'].', '.$accent_color2_rgb['b'].',0.45);}';

	}

	$accent_color3 = get_theme_mod( 'accent_color3' );
	if ($accent_color3 && $accent_color3 != "#fbfbfb") {		
		$css[] = '{color:'.esc_attr($accent_color3).'}';

		$css[] = '.wc-block-grid__product{background:' . esc_attr( $accent_color3 ) . ';}';

		$css[] = '.featured-style-1 .wp-block-columns .wp-block-column,.wp-block-columns.featured-style-1 .wp-block-column,.wp-block-columns.pricing-table .wp-block-column{background-color:' . esc_attr( $accent_color3 ) . ';}';

	}

	$blog_post_style = get_theme_mod( 'blog_post_style', 'plain' );
	if ( $blog_post_style == 'border' ) {
		if ($accent_color3 && $accent_color3 != "#fbfbfb") {
			$blog_post_bg = $accent_color3;
		} else {
			$blog_post_bg = '#fbfbfb';
		}
		$css[] = '.wp-block-latest-posts.is-grid li{background:' . esc_attr($blog_post_bg) . ';border:1px solid #f1f1f1;padding:1em;}';
	} elseif ( $blog_post_style == 'shadow' ) {
		if ($accent_color3 && $accent_color3 != "#fbfbfb") {
			$blog_post_bg = $accent_color3;
		} else {
			$blog_post_bg = '#fbfbfb';
		}
		$css[] = '.wp-block-latest-posts.is-grid li{background:' . esc_attr($blog_post_bg) . ';border-radius:6px;padding:1em;box-shadow: 5px 5px 0 rgba(0, 0, 0, 0.03);}';
	}

	$post_spacing = get_theme_mod( 'post_spacing', 'space-between' );
	if ( $post_spacing && $post_spacing != 'space-between' ) {
		$css[] = '.wp-block-latest-posts.is-grid li{justify-content:' . esc_attr($post_spacing) . ';}';
	}

	return implode( '', $css );

}


function cordero_hex2RGB($hex) {
	$hex = str_replace("#", "", $hex);

	preg_match("/^#{0,1}([0-9a-f]{1,6})$/i",$hex,$match);
	if(!isset($match[1]))
	{
		return false;
	}

	if(strlen($match[1]) == 6)
	{
		list($r, $g, $b) = array($hex[0].$hex[1],$hex[2].$hex[3],$hex[4].$hex[5]);
	}
	elseif(strlen($match[1]) == 3)
	{
		list($r, $g, $b) = array($hex[0].$hex[0],$hex[1].$hex[1],$hex[2].$hex[2]);
	}
	else if(strlen($match[1]) == 2)
	{
		list($r, $g, $b) = array($hex[0].$hex[1],$hex[0].$hex[1],$hex[0].$hex[1]);
	}
	else if(strlen($match[1]) == 1)
	{
		list($r, $g, $b) = array($hex.$hex,$hex.$hex,$hex.$hex);
	}
	else
	{
		return false;
	}

	$color = array();
	$color['r'] = hexdec($r);
	$color['g'] = hexdec($g);
	$color['b'] = hexdec($b);

	return $color;
}
