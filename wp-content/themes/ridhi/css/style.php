<?php
/**
 * Ridhi Dynamic Styles
 * 
 * @package Ridhi
*/

function ridhi_dynamic_css(){
    
    $primary_font  = get_theme_mod( 'primary_font', 'Nunito Sans' );
    $primary_fonts = ridhi_get_fonts( $primary_font, 'regular' );
    
    echo "<style type='text/css' media='all'>"; ?>
    
    /*Typography*/
    body,
    button,
    input,
    select,
    optgroup,
    textarea{
        font-family : <?php echo wp_kses_post( $primary_fonts['font'] ); ?>;
    }
    
    /*Typography*/
	.main-navigation ul,
	.banner .text-holder .title,
	.top-section .newsletter .blossomthemes-email-newsletter-wrapper .text-holder h3,
	.shop-section .header .title,
	#primary .post .entry-header .entry-title,
	#primary .post .post-shope-holder .header .title,
	.widget_bttk_author_bio .title-holder,
	.widget_bttk_popular_post ul li .entry-header .entry-title,
	.widget_bttk_pro_recent_post ul li .entry-header .entry-title,
	.widget-area .widget_blossomthemes_email_newsletter_widget .text-holder h3,
	.bottom-shop-section .bottom-shop-slider .item h3,
	.page-title,
	#primary .post .entry-content blockquote,
	#primary .page .entry-content blockquote,
	#primary .post .entry-content .dropcap,
	#primary .page .entry-content .dropcap,
	#primary .post .entry-content .pull-left,
	#primary .page .entry-content .pull-left,
	#primary .post .entry-content .pull-right,
	#primary .page .entry-content .pull-right,
	.author-section .text-holder .title,
	.single .newsletter .blossomthemes-email-newsletter-wrapper .text-holder h3,
	.related-posts .title, .popular-posts .title,
	.comments-area .comments-title,
	.comments-area .comment-reply-title,
	.single .single-header .title-holder .post-title{
		font-family: <?php echo wp_kses_post( $primary_fonts['font'] ); ?>;
	}
    <?php if( ridhi_is_woocommerce_activated() ) { ?>
    	.woocommerce div.product .product_title,
    	.woocommerce div.product .woocommerce-tabs .panel h2{
			font-family: <?php echo wp_kses_post( $primary_fonts['font'] ); ?>;
    	}    
    <?php } ?>
           
    <?php echo "</style>";
}
add_action( 'wp_head', 'ridhi_dynamic_css', 99 );

/**
 * Function for sanitizing Hex color 
 */
function ridhi_sanitize_hex_color( $color ){
	if ( '' === $color )
		return '';

    // 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
		return $color;
}

/**
 * convert hex to rgb
 * @link http://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/
*/
function ridhi_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}