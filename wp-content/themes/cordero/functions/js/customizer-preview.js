/**
 * Theme Customizer enhancements for a better user experience
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously
 */

jQuery(document).ready(function($){
	if ( $('.custom-logo').attr('src') ) {
		$('.site-title').css( {'display': 'none'} );
	} else {
		$('.site-title').css( {'display': 'block'} );
	}
});


( function( $ ) {

	wp.customize('custom_logo', function( value ) {
		value.bind( function( to ) {
			if ( to ) {
				$('.site-title').css( {'display': 'none'} );
			} else {
				$('.site-title').css( {'display': 'block'} );
			}
		} );
	} );

	wp.customize('blogname', function( value ) {
		value.bind( function( to ) {
			$('.site-title a').text( to );
		} );
	} );
	wp.customize('blogdescription', function( value ) {
		value.bind( function( to ) {
			$('.site-description').text( to );
		} );
	} );

	wp.customize('hide_tagline', function( value ) {
		value.bind( function( to ) {
			if ( to == 1 ) {
				$( 'body' ).addClass( 'tagline-hidden' );
			} else {
				$( 'body' ).removeClass( 'tagline-hidden' );
			}			
		} );
	} );

	wp.customize('site_title_style', function( value ) {
		value.bind( function( to ) {
			$( '#site-branding' ).removeClass();
			$( '#site-branding' ).addClass( to );			
		} );
	} );

	wp.customize('container_width', function( value ) {
		value.bind( function( to ) {
			$('.container,.wp-block-cover-image.alignfull > .wp-block-group__inner-container > .wp-block-group,.wp-block-cover.alignfull > .wp-block-group__inner-container > .wp-block-group,.wp-block-group.alignfull > .wp-block-group__inner-container > .wp-block-group').css( {'max-width': to + 'px'} );
		} );
	} );

	wp.customize('header_search_off', function( value ) {
		value.bind( function( to ) {
			if ( to == 1 ) {
				$('#masthead .top-search').css( {'display': 'none'} );
			} else {
				$('#masthead .top-search').css( {'display': 'inline-block'} );
			}			
		} );
	} );

	wp.customize('accent_color', function( value ) {
		value.bind( function( to ) {

			var styleColor = 'a,#masthead .top-account .mini-account a,#masthead.transparent #site-navigation .top-account .mini-account a:not(.button),#masthead .top-cart .mini-cart a,#masthead.transparent .top-cart .mini-cart a:not(.button),#masthead.transparent #site-navigation .top-cart .mini-cart a:not(.button),.site-footer a,#add_payment_method .cart-collaterals .cart_totals .discount td,.woocommerce-cart .cart-collaterals .cart_totals .discount td,.woocommerce-checkout .cart-collaterals .cart_totals .discount td,.woocommerce .product-addtocart-wrap a.button,.woocommerce .product-addtocart-wrap a.button:hover,.woocommerce .product-addtocart-wrap a.added_to_cart,.woocommerce .product-addtocart-wrap a.added_to_cart:hover,.wc-block-grid__product .wc-block-grid__product-add-to-cart a.add_to_cart_button,.wc-block-grid__product .wc-block-grid__product-add-to-cart a.added_to_cart,.infinite-loader,.has-accent-color-color,.wp-block-button__link.has-accent-color-color,hr.wp-block-separator.has-accent-color-color{color:' + to + ';}';

			var styleBackground = '.button,a.button,button,input[type="button"],input[type="reset"],input[type="submit"],#infinite-handle span button,#infinite-handle span button:hover,#infinite-handle span button:focus,#infinite-handle span button:active,.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt,.woocommerce a.added_to_cart,.woocommerce #respond input#submit.alt.disabled,.woocommerce #respond input#submit.alt.disabled:hover,.woocommerce #respond input#submit.alt:disabled,.woocommerce #respond input#submit.alt:disabled:hover,.woocommerce #respond input#submit.alt:disabled[disabled],.woocommerce #respond input#submit.alt:disabled[disabled]:hover,.woocommerce a.button.alt.disabled,.woocommerce a.button.alt.disabled:hover,.woocommerce a.button.alt:disabled,.woocommerce a.button.alt:disabled:hover,.woocommerce a.button.alt:disabled[disabled],.woocommerce a.button.alt:disabled[disabled]:hover,.woocommerce button.button.alt.disabled,.woocommerce button.button.alt.disabled:hover,.woocommerce button.button.alt:disabled,.woocommerce button.button.alt:disabled:hover,.woocommerce button.button.alt:disabled[disabled],.woocommerce button.button.alt:disabled[disabled]:hover,.woocommerce input.button.alt.disabled,.woocommerce input.button.alt.disabled:hover,.woocommerce input.button.alt:disabled,.woocommerce input.button.alt:disabled:hover,.woocommerce input.button.alt:disabled[disabled],.woocommerce input.button.alt:disabled[disabled]:hover,.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover,.woocommerce a.button.alt:hover,.woocommerce button.button.alt:hover,.woocommerce input.button.alt:hover,.woocommerce a.added_to_cart,.woocommerce a.added_to_cart:hover,#grid-loop article.sticky:before,#main .infinite-wrap article.sticky:before,#footer-menu a[href^="mailto:"]:before,.widget_nav_menu a[href^="mailto:"]:before,#footer-menu a[href^="tel:"]:before,.widget_nav_menu a[href^="tel:"]:before{background:' + to + ';}';

			var styleBgColor = '.woocommerce span.onsale,.woocommerce ul.products li.product .onsale,.woocommerce .widget_price_filter .ui-slider .ui-slider-range,.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,.wp-block-button__link,.wc-block-price-filter .wc-block-price-filter__range-input::-webkit-slider-thumb,.wc-block-price-filter .wc-block-price-filter__range-input::-moz-range-thumb,.wc-block-price-filter .wc-block-price-filter__range-input::-webkit-slider-thumb,.wc-block-price-filter .wc-block-price-filter__range-input::-moz-range-thumb,.wc-block-grid__product-onsale,.has-accent-color-background-color,.wp-block-button__link.has-accent-color-background-color,hr.wp-block-separator.has-accent-color-background-color{background-color:' + to + ';}';

			var styleBorderColor = '.woocommerce-info,.woocommerce-message,.featured-style-1 .wp-block-columns .wp-block-column,.wp-block-columns.featured-style-1 .wp-block-column{border-color:' + to + ';}';

			var styleRangeColor = '.wc-block-price-filter .wc-block-price-filter__range-input-wrapper .wc-block-price-filter__range-input-progress,.rtl .wc-block-price-filter .wc-block-price-filter__range-input-wrapper .wc-block-price-filter__range-input-progress{--range-color:' + to + ';}';

			$('head').append('<style>' + styleColor + styleBackground + styleBgColor + styleBorderColor + styleRangeColor + '</style>');
		} );
	} );

	wp.customize('accent_color2', function( value ) {
		value.bind( function( to ) {

			var featicon = cordero_hex2rgba(to, '0.45');

			var styleColor = '.has-accent-color-2-color,.wp-block-button__link.has-accent-color-2-color,hr.wp-block-separator.has-accent-color-2-color{color:' + to + ';}';

			var styleBgColor = '#masthead.transparent.scrolled,#colophon,.wp-block-cover,.wp-block-cover-image,.has-accent-color-2-background-color,.wp-block-button__link.has-accent-color-2-background-color,hr.wp-block-separator.has-accent-color-2-background-color,.featured-style-1 .wp-block-image figure,.wc-block-featured-product,.wc-block-featured-category{background-color:' + to + ';}';

			var styleBoxShadow = '.featured-style-1 .wp-block-image figure{box-shadow: 0px 0px 0px 4px ' + featicon + ';}';

			$('head').append('<style>' + styleColor + styleBgColor + styleBoxShadow + '</style>');
		} );
	} );

	wp.customize('accent_color3', function( value ) {
		value.bind( function( to ) {
			var blog_post_style = wp.customize.value( 'blog_post_style' )();
			var blog_post_tag = '';
			if ( blog_post_style == 'border' || blog_post_style == 'shadow' ) {
				blog_post_tag = ',#grid-loop article,#main .infinite-wrap article,.wp-block-latest-posts.is-grid li';
			}

			var styleColor = '.has-accent-color-3-color,.wp-block-button__link.has-accent-color-3-color,hr.wp-block-separator.has-accent-color-3-color{color:' + to + ';}';

			var styleBackground = 'th,.woocommerce ul.products li.product,.woocommerce-page ul.products li.product,#secondary,ul.archive-sub-cats li,#shop-filters,article.comment-body,.wp-caption-text,.pagination span,.pagination .dots,.pagination a,.woocommerce nav.woocommerce-pagination ul li a,.woocommerce nav.woocommerce-pagination ul li span,.woocommerce div.product .woocommerce-tabs ul.tabs li,.wp-block-woocommerce-attribute-filter,.wp-block-woocommerce-price-filter,.wp-block-woocommerce-active-filters > h5,.wp-block-woocommerce-active-filters > div,.wp-block-woocommerce-active-filters > div:last-child,.wc-block-grid__product' + blog_post_tag + '{background:' + to + ';}';

			var styleBgColor = 'input[type="text"],input[type="email"],input[type="url"],input[type="password"],input[type="search"],input[type="number"],input[type="tel"],input[type="range"],input[type="date"],input[type="month"],input[type="week"],input[type="time"],input[type="datetime"],input[type="datetime-local"],input[type="color"],textarea,select,input[type="text"]:focus,input[type="email"]:focus,input[type="url"]:focus,input[type="password"]:focus,input[type="search"]:focus,input[type="number"]:focus,input[type="tel"]:focus,input[type="range"]:focus,input[type="date"]:focus,input[type="month"]:focus,input[type="week"]:focus,input[type="time"]:focus,input[type="datetime"]:focus,input[type="datetime-local"]:focus,input[type="color"]:focus,textarea:focus,select:focus,.shop-filter-wrap .shop-filter-toggle,.woocommerce div.product form.cart div.quantity input[type="button"],.featured-style-1 .wp-block-columns .wp-block-column,.wp-block-columns.featured-style-1 .wp-block-column,.wp-block-columns.pricing-table .wp-block-column,.has-accent-color-3-background-color,.wp-block-button__link.has-accent-color-3-background-color,hr.wp-block-separator.has-accent-color-3-background-color{background-color:' + to + ';}';

			var styleBorderLeftColor = '.comment-navigation .nav-next a:after{border-left-color:' + to + ';}';
			var styleBorderRightColor = '.comment-navigation .nav-previous a:after{border-right-color:' + to + ';}';

			var styleResponsive = '@media (min-width: 1025px){.masthead-left #masthead{background:' + to + ';}}';

			var styleResponsive2 = '@media (max-width: 1024px){.toggle-nav-open,.toggle-nav-open:hover{background:' + to + ';}}';

			$('head').append('<style>' + styleColor + styleBackground + styleBgColor + styleBorderLeftColor + styleBorderRightColor + styleResponsive + styleResponsive2 + '</style>');
		} );
	} );

	wp.customize('font_site_title', function( value ) {
		value.bind( function( to ) {
			cordero_font_bind( to, '.site-title' );
		} );
	} );

	wp.customize('font_nav', function( value ) {
		value.bind( function( to ) {
			cordero_font_bind( to, '#site-navigation .site-main-menu' );
		} );
	} );

	wp.customize('font_content', function( value ) {
		value.bind( function( to ) {
			var font_nav = wp.customize.value( 'font_nav' )();
			var font_site_title = wp.customize.value( 'font_site_title' )();
			cordero_font_bind( to, 'body, button, input, select, textarea' );
			if ( font_site_title === '' ) {
				$('.site-title').css({ fontFamily: 'initial' });
			} else {
				cordero_font_bind( font_site_title, '.site-title' );
			}
			if ( font_nav === '' ) {
				$('#site-navigation .site-main-menu').css({ fontFamily: 'initial' });
			} else {
				cordero_font_bind( font_nav, '#site-navigation .site-main-menu' );
			}
		} );
	} );

	wp.customize('font_headings', function( value ) {
		value.bind( function( to ) {
			cordero_font_bind( to, 'h1:not(.site-title), h2, h3, h4, h5, h6, blockquote, .wc-block-grid__product .wc-block-grid__product-title, .wp-block-latest-posts.is-grid li > a' );
		} );
	} );

	wp.customize('fs_base', function( value ) {
		value.bind( function( to ) {
			$('body,button,input,select,textarea').css( {'font-size': to + 'px'} );
		} );
	} );

	wp.customize('menu_uppercase', function( value ) {
		value.bind( function( to ) {
			$('#primary-menu > li').css( {'text-transform': to} );
		} );
	} );

} )( jQuery );

function cordero_font_bind( to, style_class ) {
	if ( to == '' || to == 'Arial, Helvetica, sans-serif' || to == 'Impact, Charcoal, sans-serif' || to == '"Lucida Sans Unicode", "Lucida Grande", sans-serif' || to == 'Tahoma, Geneva, sans-serif' || to == '"Trebuchet MS", Helvetica, sans-serif' || to == 'Verdana, Geneva, sans-serif' || to == 'Georgia, serif' || to == '"Palatino Linotype", "Book Antiqua", Palatino, serif' || to == '"Times New Roman", Times, serif' ) {
	} else {
		var googlefont = encodeURI(to.replace(" ", "+"));
		jQuery('head').append('<link href="//fonts.googleapis.com/css?family=' + googlefont + '" type="text/css" media="all" rel="stylesheet">');
		to = to.substr(0, to.indexOf(':'));
		to = "'" + to + "'";
	}
	jQuery(style_class).css({
		fontFamily: to
	});
}

function cordero_font_style( to, style_class ) {
	if ( to == 'italic' ) {
		var to_style = 'italic';
	} else {
		var to_style = 'normal';
	}
	jQuery(style_class).css( {'font-style': to_style } );
}

function cordero_hex2rgba( colour, opacity ) {
	var r,g,b;
	if ( colour.charAt(0) == '#') {
	colour = colour.substr(1);
	}

	r = colour.charAt(0) + '' + colour.charAt(1);
	g = colour.charAt(2) + '' + colour.charAt(3);
	b = colour.charAt(4) + '' + colour.charAt(5);

	r = parseInt( r,16 );
	g = parseInt( g,16 );
	b = parseInt( b,16);
	return 'rgba(' + r + ',' + g + ',' + b + ',' + opacity + ')';
}
