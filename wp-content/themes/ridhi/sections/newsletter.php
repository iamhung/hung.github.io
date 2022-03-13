<?php
/**
 * Newsletter Section
 * 
 * @package Ridhi
 */

$newsletter = get_theme_mod( 'bt_newsletter' );

if( $newsletter ){
	echo '<div id="newsletter_section" class="newsletter-section bg-fullwidth">' . do_shortcode( $newsletter ) . '</div><!-- .newsletter-section -->';
}