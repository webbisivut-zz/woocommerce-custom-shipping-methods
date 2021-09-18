<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Get cart items
 *
 * @access public
 * @return array
 */
class WB_WooCommerce_Custom_Shipping_Cart_Items {

	public static function get_woo_cart() {
		 global $woocommerce;
		 $items = $woocommerce->cart->get_cart();

		 return $items;
	 }

	 public static function height() {
		 $all_products_height = array();

		 $items = WB_WooCommerce_Custom_Shipping_Cart_Items::get_woo_cart();
		 foreach ($items as $item) {
			 $height = floatval($item['data']->get_height());
			 $qty = $item['quantity'];

			 array_push($all_products_height, $height * $qty);
		 }
		 return array_sum($all_products_height);
	 }

	 public static function length() {
		 $all_products_length = array();

		 $items = WB_WooCommerce_Custom_Shipping_Cart_Items::get_woo_cart();
		 foreach ($items as $item) {
			 $length = floatval($item['data']->get_length());
			 $qty = $item['quantity'];

			 array_push($all_products_length, $length * $qty);
		 }
		 return array_sum($all_products_length);
	 }

	 public static function width() {
		 $all_products_width = array();

		 $items = WB_WooCommerce_Custom_Shipping_Cart_Items::get_woo_cart();
		 foreach ($items as $item) {
			 $width = floatval($item['data']->get_width());
			 $qty = $item['quantity'];

			 array_push($all_products_width, $width * $qty);
		 }
		 return array_sum($all_products_width);
	 }

	 public static function weight() {
		 $all_products_weight = array(); 

		 $items = WB_WooCommerce_Custom_Shipping_Cart_Items::get_woo_cart();
		 foreach ($items as $item) {
			 $weight = floatval($item['data']->get_weight());
			 $qty = $item['quantity'];

			 array_push($all_products_weight, $weight * $qty);
		 }
		 return array_sum($all_products_weight);
	 }

	 public static function volume() {
		 $all_products_volume = array();

		 $items = WB_WooCommerce_Custom_Shipping_Cart_Items::get_woo_cart();
		 foreach ($items as $item) {
			 $width = floatval($item['data']->get_width());
			 $length = floatval($item['data']->get_length());
			 $height = floatval($item['data']->get_height());
			 $qty = $item['quantity'];
			 
			 $volume = $width * $length * $height;
			 
			 array_push($all_products_volume, $volume * $qty);
		 }
		 return array_sum($all_products_volume);
	 }


	public static function qty() {
		$all_products_qty = array();
		$all_products_qty_height = array();

		$items_qty = WB_WooCommerce_Custom_Shipping_Cart_Items::get_woo_cart();
		foreach ($items_qty as $item_qty) {
			$height_qty = floatval($item_qty['data']->get_height());
			array_push($all_products_qty_height, $height_qty);
		}

		$items = WB_WooCommerce_Custom_Shipping_Cart_Items::get_woo_cart();
		foreach ($items as $item => $item) {
			$qty = $item['quantity'];

			array_push($all_products_qty, $qty);
		}

		$all_qty_yht = array();

		for($i = 0; $i < count($all_products_qty_height); $i++) {
			array_push($all_qty_yht, $all_products_qty_height[$i] * $all_products_qty[$i]);
		}

		return $all_qty_yht;
	}

}
?>