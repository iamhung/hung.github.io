<?php
/**
 * Theme help
 *
 * Adds a simple Theme help page to the Appearance section of the WordPress Dashboard.
 *
 * @package Cordero
 */

// Add Theme help page to admin menu.
add_action( 'admin_menu', 'cordero_add_theme_help_page' );

function cordero_add_theme_help_page() {

	// Get Theme Details from style.css
	$theme = wp_get_theme();

	/* translators: %s: theme name. */
	add_theme_page(
		esc_html( $theme->get( 'Name' ) ) . ' ' .  esc_html( $theme->get( 'Version' ) ), sprintf( esc_html__( '%s Options', 'cordero' ), $theme->get( 'Name' ) ), 'edit_theme_options', 'cordero', 'cordero_display_theme_help_page'
	);

}

// Display Theme help page.
function cordero_display_theme_help_page() {

	// Get Theme Details from style.css.
	$theme = wp_get_theme();
	?>

	<div class="wrap theme-help-wrap">

		<h1><?php echo esc_html( $theme->get( 'Name' ) ) . ' <span class="theme-version">' .  esc_html( $theme->get( 'Version' ) ); ?></span></h1>

		<div class="theme-description"><?php echo esc_html( $theme->get( 'Description' ) ); ?></div>

		<div id="getting-started">

			<h3><?php
				/* translators: %s: theme name. */
				printf( esc_html__( 'Getting Started with %s', 'cordero' ), $theme->get( 'Name' ) ); ?>
			</h3>

			<h4><strong><?php esc_html_e( 'NEW! - Block Patterns', 'cordero' ); ?></strong></h4>

			<p class="about">
				<?php esc_html_e( 'With WordPress 5.5 there is a new Block Patterns feature. This allows you to easily insert block designs into your pages or posts.', 'cordero' ); ?>
			</p>
			<p class="about">
				<?php esc_html_e( 'Cordero has a variety of patterns to help you get started, including a full width hero, featured services and pricing table.', 'cordero' ); ?>
			</p>
			<p class="about">
				<?php esc_html_e( 'To begin, add or edit a page, click the "Add Block" button and then the "Patterns" tab.', 'cordero' ); ?>
			</p>
			<p class="about">
				<?php esc_html_e( 'Find a pattern you like, and click it to add the pattern to your page.', 'cordero' ); ?>
			</p>
			<p class="about">
				<?php esc_html_e( 'Thats it! You can now edit the text or images of the pattern to really make it your own!', 'cordero' ); ?>
			</p>
			
			<?php
			$this_wp_version = get_bloginfo( 'version' );
			if ( $this_wp_version < 5.5 ) { ?>
				<p class="about">
					<?php esc_html_e( 'You appear to be using an old version of WordPress. Block patterns require at least version 5.5 of WordPress.', 'cordero' ); ?>
				</p>
				<p>
					<a href="<?php echo esc_url( get_admin_url() . 'update-core.php' ); ?>" class="button button-primary">
						<?php esc_html_e( 'Update WordPress', 'cordero' ); ?>
					</a>
				</p>
			<?php } else {
			?>
				<p class="about">
					<?php esc_html_e( 'Add or edit a page now to try it out.', 'cordero' ); ?>
				</p>
				<p>
					<a href="<?php echo esc_url( get_admin_url() . 'post-new.php?post_type=page' ); ?>" class="button button-primary">
						<?php esc_html_e( 'Add New Page', 'cordero' ); ?>
					</a>
				</p>
			<?php }
			?>
			
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/help-block-pattern-inserted.jpg" class="pattern-img" />

			<div class="columns-wrapper clearfix">

				<div class="column column-half clearfix">

					<div class="section">
						<h4><?php esc_html_e( 'Options', 'cordero' ); ?></h4>

						<p class="about">
							<?php
							/* translators: %s: theme name. */
							printf( esc_html__( '%s makes use of the Customizer for the theme settings.', 'cordero' ), $theme->get( 'Name' ) ); ?>
						</p>
						<p>
							<a href="<?php echo esc_url( wp_customize_url() ); ?>" class="button button-primary">
								<?php esc_html_e( 'Customize', 'cordero' ); ?>
							</a>
						</p>
					</div>

					<div class="section">
						<h4><?php esc_html_e( 'Demo Content', 'cordero' ); ?></h4>

						<p class="about">
							<?php
							/* translators: %s: theme name. */
							printf( esc_html__( 'Import %s demo content and Starter Sites.', 'cordero' ), $theme->get( 'Name' ) ); ?>
						</p>
						<?php
						if ( class_exists( 'Starter_Sites' ) ) {
							$plugin_page = 'starter-sites';
							$plugin_text = esc_html__( 'View Demo Content', 'cordero' );
						} else {
							$plugin_page = 'tgmpa-install-plugins';
							$plugin_text = esc_html__( 'Get Starter Sites Plugin', 'cordero' );
						}
						?>
						<p>
							<a href="<?php echo esc_url( get_admin_url() . 'themes.php?page=' . $plugin_page ); ?>" class="button button-primary">
								<?php echo $plugin_text; ?>
							</a>
						</p>
					</div>

					<div class="section">
						<h4><?php esc_html_e( 'Documentation', 'cordero' ); ?></h4>

						<p class="about">
							<?php esc_html_e( 'Do you need help to setup and customize this theme? Check out the theme documentation.', 'cordero' ); ?>
						</p>
						<p>
							<a href="<?php echo esc_url( 'https://uxlthemes.com/documentation/' ); ?>" target="_blank" class="button button-secondary">
								<?php esc_html_e( 'View Documentation', 'cordero' ); ?>
							</a>
						</p>
					</div>

					<div class="section">
						<h4><?php esc_html_e( 'Support', 'cordero' ); ?></h4>

						<p class="about">
							<?php esc_html_e( 'Any questions?', 'cordero' ); ?>
						</p>
						<p>
							<a href="<?php echo esc_url( 'https://uxlthemes.com/forums/forum/cordero/' ); ?>" target="_blank" class="button button-secondary">
								<?php esc_html_e( 'Get Support', 'cordero' ); ?>
							</a>
						</p>
					</div>


					<div class="section">
						<h4><?php esc_html_e( 'Upgrade', 'cordero' ); ?></h4>

						<p class="about">
							<?php esc_html_e( 'Upgrade to Cordero Pro for even more cool features and customization options.', 'cordero' ) ; ?>
						</p>
						<p>
							<a href="<?php echo esc_url( 'https://uxlthemes.com/theme/cordero-pro/' ); ?>" target="_blank" class="button button-pro">
								<?php esc_html_e( 'GO PRO', 'cordero' ); ?>
							</a>
						</p>
					</div>

				</div>

				<div class="column column-half clearfix">

					<div class="screenshot">
						<a href="<?php echo esc_url( 'https://uxlthemes.com/theme/cordero/' ); ?>" target="_blank">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/screenshot.png" />
						</a>
						<a href="<?php echo esc_url( 'https://uxlthemes.com/theme/cordero/' ); ?>" target="_blank" class="button button-primary">
							<?php esc_html_e( 'Theme Details', 'cordero' ); ?>
						</a>
					</div>

				</div>

			</div>

		</div>

		<hr>

		<div id="theme-author">

			<p>
				<?php /* translators: %1$s: theme name, %2$s: theme author, %3$s: link to theme review page. */
				printf( esc_html__( '%1$s is proudly brought to you by %2$s. If you like this theme, %3$s :)', 'cordero' ),  $theme->get( 'Name' ) , '<a target="_blank" href="https://uxlthemes.com/">' . $theme->get( 'Author' ) . '</a>', '<a target="_blank" href="https://wordpress.org/support/theme/cordero/reviews/?filter=5">' . __( 'rate it', 'cordero' ) . '</a>' ); ?>
			</p>

		</div>

	</div>

	<?php
}

// Add CSS for Theme help Panel.
add_action( 'admin_enqueue_scripts', 'cordero_theme_help_page_css' );

function cordero_theme_help_page_css( $hook ) {

	// Load styles and scripts only on theme help page.
	if ( 'appearance_page_cordero' != $hook ) {
		return;
	}

	// Embed theme help css style.
	wp_enqueue_style( 'cordero-theme-help-css', get_template_directory_uri() . '/css/theme-help.css' );
}
