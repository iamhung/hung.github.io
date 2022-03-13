<?php

/**
 * Plugin Name: Casso - Tự động xác nhận thanh toán chuyển khoản ngân hàng
 * Plugin URI: https://casso.vn/plugin-ket-noi-ngan-hang/
 * Description: Plugin Casso phát triển để kết nối các ngân hàng Việt Nam vào Wordpress. Giúp tự động xác nhận các đơn hàng được thanh toán bằng hình thức chuyển khoản ngân hàng Việt Nam.
 * Author: Casso Team
 * Author URI: http://casso.vn
 * Version: 1.2.0
 * Tested up to: 5.5.3
 * License: GNU General Public License v3.0
 */

defined('ABSPATH') or exit;


// Make sure WooCommerce is active
if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    return;
}

add_action('plugins_loaded', 'casso_gateway_init', 11);

function casso_gateway_init()
{
    require_once(plugin_basename('classes/class-wc-gateway-casso.php'));
}

function casso_add_gateways($gateways)
{
    $gateways[] = 'WC_Gateway_Casso';
    return $gateways;
}
add_filter('woocommerce_payment_gateways', 'casso_add_gateways');


// Register new status
function register_casso_order_status() {
    register_post_status( 'wc-paid', array(
        'label'                     => 'Đã thanh toán',
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Đã thanh toán (%s)', 'Đã thanh toán (%s)' )
    ) );
    register_post_status( 'wc-underpaid', array(
        'label'                     => 'Thanh toán thiếu',
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Thanh toán thiếu (%s)', 'Thanh toán thiếu (%s)' )
    ) );
}

add_action( 'init', 'register_casso_order_status' );


// Add to list of WC Order statuses
function add_casso_order_statuses( $order_statuses ) {
 
    $new_order_statuses = array();
 
    // add new order status after processing
    foreach ( $order_statuses as $key => $status ) {
        $new_order_statuses[ $key ] = $status;
    }

    $new_order_statuses['wc-paid'] = 'Đã thanh toán';
    $new_order_statuses['wc-underpaid'] = 'Thanh toán thiếu';

    return $new_order_statuses;
}
add_filter( 'wc_order_statuses', 'add_casso_order_statuses' );

add_action( 'init', 'add_reviews');
add_action( 'init', 'add_docs');
add_action( 'init', 'add_settting');

function add_settting(){
    if ( class_exists( 'WooCommerce' ) ) {
        // Add "Settings" link when the plugin is active
        add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ),'add_settings_link');
    }
}
    /**
 * Add "Settings" link in the Plugins list page when the plugin is active
 *
 * @since 1.4
 * @author Longkt
 */
function add_settings_link( $links ) {
    $settings = array( '<a href="' . admin_url( 'admin.php?page=wc-settings&tab=checkout&section=casso' ) . '">' . __( 'Cài đặt', 'woocommerce' ) . '</a>' );
    $links    = array_reverse( array_merge( $links, $settings ) );

    return $links;
}

function add_reviews(){
    if ( class_exists( 'WooCommerce' ) ) {
        // Add "Settings" link when the plugin is active
        add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ),'add_settings_review');
    }
}

function add_settings_review($links){
    $settings = array( '<a href="https://wordpress.org/support/plugin/casso-tu-dong-xac-nhan-thanh-toan-chuyen-khoan-ngan-hang/reviews/" target="_blank">' . __( 'Review', 'woocommerce' ) . '</a>' );
    $links    = array_reverse( array_merge( $links, $settings ) );

    return $links;
}

function add_docs(){
    if ( class_exists( 'WooCommerce' ) ) {
        // Add "Settings" link when the plugin is active
        add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ),'add_settings_doc');
    }
}

function add_settings_doc($links){
    $settings = array( '<a href="https://casso.vn/plugin-ket-noi-ngan-hang/" target="_blank">' . __( 'Docs', 'woocommerce' ) . '</a>' );
    $links    = array_reverse( array_merge( $links, $settings ) );

    return $links;
}
