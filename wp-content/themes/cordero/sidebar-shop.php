<?php
/**
 * The sidebar containing the main widget area for WooCommerce archives
 *
 * @package Cordero
 */

if ( ! is_active_sidebar( 'cordero-sidebar-shop' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area"<?php cordero_schema_item( 'sidebar' ); ?>>
	<?php dynamic_sidebar( 'cordero-sidebar-shop' ); ?>
</div><!-- #secondary -->
