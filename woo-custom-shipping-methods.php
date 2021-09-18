<?php
/*
 * Plugin Name: WebData Custom Shipping Methods for WooCommerce
 * Version: 1.3.7
 * Plugin URI: https://www.web-data.online/
 * Description: Custom shipping methods for WooCommerce
 * Author: web-data.online
 * Requires at least: 4.0
 * Tested up to: 5.7
 *
 * Text Domain: woocommerce-custom-shipping
 * Domain Path: /lang/
 *
 * @package WordPress
 * @author web-data.io
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Load plugin class files
require_once( 'includes/class-woocommerce-custom-shipping-functions.php' );
require_once( 'includes/class-woocommerce-custom-shipping-settings-table.php' );
require_once( 'includes/class-woocommerce-custom-shipping-cart-items.php' );
require_once( 'includes/class-woocommerce-custom-shipping-method-constructor.php' );