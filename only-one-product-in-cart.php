<?php
/**
* Plugin Name: Only 1 Product in Woocommerce Cart
* Plugin URI: -
* Description: Allow only one product in Woocommerce Cart Page
* Version: 1.0
* Author: Tantri Mindrawan
* Author URI: https://github.com/tantriabenk
**/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'plugins_loaded', 'load_plugin' );
function load_plugin() {
    if( class_exists( 'WooCommerce' ) ):
        add_filter( 'woocommerce_add_cart_item_data', 'empty_cart' );
    else:
		add_action( 'admin_notices', 'failed_load_plugin' );
    endif;
}

function failed_load_plugin() {
    load_plugin_textdomain( 'only-one-product' );
    $message = '<p>' . __( 'Woocommerce not activated, please activate Woocommer Plugin before install this plugin', 'only-one-product' ) . '</p>';

    echo '<div class="error"><p>' . $message . '</p></div>';
}

function empty_cart( $cart_item_data ) {
    global $woocommerce;
    $woocommerce->cart->empty_cart();

    return $cart_item_data;
}