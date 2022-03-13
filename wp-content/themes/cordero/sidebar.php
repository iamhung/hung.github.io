<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Cordero
 */

if ( ! is_active_sidebar( 'cordero-sidebar' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area"<?php cordero_schema_item( 'sidebar' ); ?>>
	<?php dynamic_sidebar( 'cordero-sidebar' ); ?>
</div><!-- #secondary -->
