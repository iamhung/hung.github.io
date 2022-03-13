<?php
/**
 * The theme header.
 *
 * @package Cordero
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
<?php endif; ?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?><?php cordero_schema_body(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'cordero' ); ?></a>
<?php
	if ( get_theme_mod( 'sticky_footer' ) ) {
		$page_class = ' class="sticky-footer"';
	} else {
		$page_class = '';
	}

	if ( get_theme_mod( 'sticky_header_off' ) ) {
		$header_sticky = ' not-fixed';
	} else {
		$header_sticky = '';
	}

	$header_color = get_theme_mod( 'header_color', '' );
	if ( $header_color === 'light' ) {
		$use_header_color = ' light';
	} else {
		$use_header_color = '';
	}

	$header_image = get_header_image();
	if ( $header_image ) {
		$use_header_image = ' style="background-image: url(' . esc_url( $header_image ) . ')"';
	} else {
		$use_header_image = '';
	}
?>
<?php cordero_before_page(); ?>

<div id="page"<?php echo $page_class; ?>>

<?php cordero_before_header(); ?>

	<header id="masthead" class="site-header <?php echo $header_sticky . $use_header_color; ?>"<?php echo $use_header_image; ?><?php cordero_schema_item( 'masthead' ); ?>>

		<?php if ( is_active_sidebar( 'cordero-top-bar' ) ) : ?>
		<?php cordero_before_top_bar(); ?>
		<div id="top-bar">
			<div class="container">
				<?php dynamic_sidebar( 'cordero-top-bar' ); ?>
			</div>
		</div>
		<?php cordero_after_top_bar(); ?>
		<?php endif; ?>

		<?php cordero_before_masthead_inner(); ?>

		<?php $header_layout = get_theme_mod( 'header_layout', '' ); ?>
		<div id="masthead-inner" class="container <?php echo esc_attr( $header_layout ); ?>">
		<?php
		if ( $header_layout == 'logo-below' || $header_layout == 'logo-right' ) {
			cordero_header_menu();
			if ( is_customize_preview() ) {
				cordero_header_content_customizer();
			} else {
				cordero_header_content();
			}
		} else {
			if ( is_customize_preview() ) {
				cordero_header_content_customizer();
			} else {
				cordero_header_content();
			}
			cordero_header_menu();
		}
		?>
		</div>

		<?php cordero_after_masthead_inner(); ?>

	</header><!-- #masthead -->

<?php cordero_after_header(); ?>

	<div id="content" class="site-content clearfix">
		<div class="container clearfix">
