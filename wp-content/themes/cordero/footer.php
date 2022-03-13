<?php
/**
 * The template for displaying the footer
 *
 * @package Cordero
 */

?>
	</div><!-- .container -->

	</div><!-- #content -->

<?php
	if ( get_theme_mod( 'sticky_footer' ) ) {
		$footer_class = ' sticky-footer';
	} else {
		$footer_class = '';
	}
?>
	<?php cordero_before_footer(); ?>

	<footer id="colophon" class="site-footer<?php echo $footer_class; ?>"<?php cordero_schema_item( 'footer' ); ?>>

		<?php if(is_active_sidebar( 'cordero-top-footer' )): ?>
		<?php cordero_before_top_footer(); ?>
		<div id="top-footer">
			<div class="container">
				<?php dynamic_sidebar( 'cordero-top-footer' ); ?>
			</div>
		</div>
		<?php cordero_after_top_footer(); ?>
		<?php endif; ?>

		<?php if(is_active_sidebar( 'cordero-footer1' ) || is_active_sidebar( 'cordero-footer2' ) || is_active_sidebar( 'cordero-footer3' ) ): ?>
		<?php cordero_before_middle_footer(); ?>
		<div id="middle-footer">
			<div class="container">
				<div class="middle-footer clearfix">
					<div class="footer footer1">
						<?php if(is_active_sidebar( 'cordero-footer1' )): 
							dynamic_sidebar( 'cordero-footer1' );
						endif;
						?>	
					</div>

					<div class="footer footer2">
						<?php if(is_active_sidebar( 'cordero-footer2' )): 
							dynamic_sidebar( 'cordero-footer2' );
						endif;
						?>	
					</div>

					<div class="footer footer3">
						<?php if(is_active_sidebar( 'cordero-footer3' )): 
							dynamic_sidebar( 'cordero-footer3' );
						endif;
						?>	
					</div>
				</div>
			</div>
		</div>
		<?php cordero_after_middle_footer(); ?>
		<?php endif; ?>

		<?php cordero_before_bottom_footer(); ?>

		<?php $footer_layout = get_theme_mod( 'footer_layout', '' ); ?>
		<div id="bottom-footer" class="<?php echo esc_attr( $footer_layout ) ?>">
			<div class="container">

			<?php
			if ( $footer_layout === '' || $footer_layout === 'centered' ) {
				cordero_powered_by();
			}
			?>

				<?php wp_nav_menu( array( 
                	'theme_location' => 'footer',
                	'container_id' => 'footer-menu',
                	'menu_id' => 'footer-menu', 
                	'menu_class' => 'cordero-footer-nav',
                	'depth' => 1,
                	'fallback_cb' => 'cordero_footer_menu_fallback',
				) ); ?>

			<?php
			$footer_layout = get_theme_mod( 'footer_layout', '' );

			if ( $footer_layout === 'info-right' || $footer_layout === 'centered-info-below' ) {
				cordero_powered_by();
			}
			?>

			</div>
		</div>
		<?php cordero_after_bottom_footer(); ?>

	</footer><!-- #colophon -->
	<?php cordero_after_footer(); ?>
</div><!-- #page -->

<?php cordero_after_page(); ?>

<?php wp_footer(); ?>

</body>
</html>
