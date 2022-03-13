<?php
/**
 * Right Buttons Panel.
 *
 * @package Ridhi
 */
?>
<div class="panel-right">
	<div class="panel-aside">
		<h4><?php esc_html_e( 'Upgrade To Pro', 'ridhi' ); ?></h4>
		<p><?php esc_html_e( 'The Pro version of the theme allows you to change the look and feel of the website with just a few clicks. You can easily change the color, background image and pattern as well as fonts of the website with the Pro version. Also, the Pro theme features more homepage sections than free version to allow you to showcase your organization services in a better way boosting the growth of the organization. Furthermore, the premium theme comes with multiple predefined page templates.', 'ridhi' ); ?></p>
		<p><?php esc_html_e( 'Also, the Pro version gets regular updates and has a dedicated support team to solve your queries.', 'ridhi' ); ?></p>
		<a class="button button-primary" href="<?php echo esc_url( 'https://rarathemes.com/wordpress-themes/ridhi-pro/' ); ?>" title="<?php esc_attr_e( 'View Premium Version', 'ridhi' ); ?>" target="_blank">
            <?php esc_html_e( 'Read more about the features here', 'ridhi' ); ?>
        </a>
	</div><!-- .panel-aside Theme Support -->
	<!-- Knowledge base -->
	<div class="panel-aside">
		<h4><?php esc_html_e( 'Visit the Knowledge Base', 'ridhi' ); ?></h4>
		<p><?php esc_html_e( 'Need help with WordPress and our theme as quickly as possible? Visit our well-organized documentation.', 'ridhi' ); ?></p>
		<p><?php esc_html_e( 'Our documentation comes with a step-by-step guide from installing WordPress to customizing our theme to creating an attractive and engaging website.', 'ridhi' ); ?></p>

		<a class="button button-primary" href="<?php echo esc_url( 'https://docs.rarathemes.com/docs/' . RIDHI_THEME_TEXTDOMAIN . '/' ); ?>" title="<?php esc_attr_e( 'Visit the knowledge base', 'ridhi' ); ?>" target="_blank"><?php esc_html_e( 'Visit the Knowledge Base', 'ridhi' ); ?></a>
	</div><!-- .panel-aside knowledge base -->
</div><!-- .panel-right -->