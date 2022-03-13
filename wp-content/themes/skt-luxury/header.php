<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package SKT Luxury
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="header">
  <div class="container">
	<!--HEADER INFO AREA STARTS-->
<?php 
$email_add = get_theme_mod('email_add');
$contact_no = get_theme_mod('contact_no');
$fb_link = get_theme_mod('fb_link'); 
$twitt_link = get_theme_mod('twitt_link');
$gplus_link = get_theme_mod('gplus_link');
$youtube_link = get_theme_mod('youtube_link');
$instagram_link = get_theme_mod('instagram_link');
$linked_link = get_theme_mod('linked_link');
?>
<!--HEADER INFO AREA ENDS-->
	<div class="clear"></div> 
    <div class="logo">
		<?php skt_luxury_the_custom_logo(); ?>
        <div class="clear"></div>
		<?php	
        $description = get_bloginfo( 'description', 'display' );
        ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <h2 class="site-title"><?php bloginfo('name'); ?></h2>
        <?php if ( $description || is_customize_preview() ) :?>
        <p class="site-description"><?php echo esc_html($description); ?></p>                          
        <?php endif; ?>
        </a>
    </div> 
    <div id="topmenu">
    	         <div class="toggle"><a class="toggleMenu" href="#" style="display:none;"><?php esc_html_e('Menu','skt-luxury'); ?></a></div> 
        <div class="sitenav">
          <?php wp_nav_menu( array('theme_location' => 'primary') ); ?>         
        </div><!-- .sitenav--> 
        <div class="header-extras">
          <li>
            <div class="header-search-toggle"><img src="<?php echo esc_url(get_template_directory_uri());?>/images/icon-search.png"/></div>
          </li>
<?php if ( skt_luxury_is_woocommerce_activated() ) {  ?>
          <li>
          	 <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>" title="<?php echo esc_attr_e('Login / Register', 'skt-luxury');?>"><img src="<?php echo esc_url(get_template_directory_uri());?>/images/icon-profile.png"/></a>
          </li>
          <li><a class="cart-customlocation" href="<?php echo esc_url(get_permalink(get_option('woocommerce_cart_page_id'))); ?>" title="<?php echo esc_html('View your shopping cart', 'skt-luxury');?>"><img src="<?php echo esc_url(get_template_directory_uri());?>/images/icon-cart.png"/><span class="custom-cart-count"><?php echo esc_html(sprintf ('%d', WC()->cart->get_cart_contents_count()));?></span></a>
		  </li>
          <?php } ?>          
            <div class="header-search-form"> <span class="header-search-form-arrow"></span>
            <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
              <input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search', 'skt-luxury' ); ?>" name="s">
              <input type="submit" class="search-submit" value="<?php esc_attr_e( 'Search', 'skt-luxury' ); ?>">
            </form>
          </div>
        </div>
    </div>
  </div> <!-- container -->
  <div class="clear"></div>
</div><!--.header -->
<div class="clear"></div>