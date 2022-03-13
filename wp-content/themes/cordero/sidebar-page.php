<?php
/**
 * The sidebar containing the main widget area for pages
 *
 * @package Cordero
 */

if ( ! is_active_sidebar( 'cordero-sidebar-page' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area"<?php cordero_schema_item( 'sidebar' ); ?>>
	<?php dynamic_sidebar( 'cordero-sidebar-page' ); ?>
</div><!-- #secondary -->
