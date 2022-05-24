<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Get shippint methods settings
 *
 * @access public
 * @return void
 */
class wb_woocommerce_custom_shipping_table_settings {

	/**
	* Constructor
	*
	* @access public
	* @return void
	*/
	public function __construct() {
		$this->getCountries = WC()->countries->get_shipping_countries();
	}

	/**
	* Shipping name set
	*
	* @access public
	* @return void
	*/
	public function shippingName($prefix, $otherSettings, $defaultTitle) {
		?>
		<tr>
			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Shipping methods name','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<?php if( isset($otherSettings[0][$prefix . '_method_name'] ) && $otherSettings[0][$prefix . '_method_name'] !='' ) { $method = $otherSettings[0][$prefix . '_method_name']; } else { $method = $defaultTitle; } ?>
				<input type="text" style="width: 350px; padding: 5px; margin: 25px 0px 15px 0px;" value="<?php echo $method ?>" name="<?php echo $prefix; ?>_method_name"><br>
				<?php _e('Set the shipping method´s name the customer sees on the checkout page.','woocommerce-custom-shipping') ?>
			</th>
		</tr>
		<?php
	}

	/**
	* Fixed price
	*
	* @access public
	* @return void
	*/
	public function overAmount($prefix, $otherSettings) {
		?>
		<tr>
			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Fixed price','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<?php if( isset($otherSettings[0][$prefix . '_fixed_price'] ) && $otherSettings[0][$prefix . '_fixed_price'] !='' ) { $method = $otherSettings[0][$prefix . '_fixed_price']; } else { $method = ''; } ?>
				<input type="text" style="width: 350px; padding: 5px; margin: 25px 0px 15px 0px;" value="<?php echo $method ?>" name="<?php echo $prefix; ?>_fixed_price"><br>
				<?php _e('If you want to use fixed base price for the shipping, please enter it here. Leave this field empty to disable this feature. You can also disable fixed price if minimun distance is reaced. Set then setting "Disable fixed fee if minimum distance is reached?" to "Disable" at the "Distance Based Fee Settings" section below.','woocommerce-custom-shipping') ?>
			</th>
		</tr>
		<?php
	}

	/**
	* Maximum length
	*
	* @access public
	* @return void
	*/
	public function maximumLength($prefix, $otherSettings) {
		?>
		<tr>
			<th style="text-align: left; padding-bottom: 20px;">
				<h2><?php _e('Limit settings','woocommerce-custom-shipping'); ?></h2>
			</th>
		</tr>
		<tr>
			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Maximum length','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<?php if( isset($otherSettings[0][$prefix . '_max_length']) && $otherSettings[0][$prefix . '_max_length'] !='' ) { $method = $otherSettings[0][$prefix . '_max_length']; } else { $method = '100'; } ?>
				<input type="text" style="width: 350px; padding: 5px; margin: 25px 0px 15px 0px;" value="<?php echo $method ?>" name="<?php echo $prefix; ?>_max_length"><br>
				<?php _e('Set maximum length, after which the shipping method will no longer be displayed at checkout. Dimensions should be entered in the same unit of measurement as set in WooCommerce!','woocommerce-custom-shipping') ?>
			</th>
		</tr>
		<?php
	}

	/**
	* Maximum width
	*
	* @access public
	* @return void
	*/
	public function maximumWidth($prefix, $otherSettings) {
		?>
		<tr>
			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Maximum width','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<?php if( isset($otherSettings[0][$prefix . '_max_width']) && $otherSettings[0][$prefix . '_max_width'] !='' ) { $method = $otherSettings[0][$prefix . '_max_width']; } else { $method = '100'; } ?>
				<input type="text" style="width: 350px; padding: 5px; margin: 25px 0px 15px 0px;" value="<?php echo $method ?>" name="<?php echo $prefix; ?>_max_width"><br>
				<?php _e('Set maximum width, after which the shipping method will no longer be displayed at checkout. Dimensions should be entered in the same unit of measurement as set in WooCommerce!','woocommerce-custom-shipping') ?>
			</th>
		</tr>
		<?php
	}

	/**
	* Maximum height
	*
	* @access public
	* @return void
	*/
	public function maximumHeight($prefix, $otherSettings) {
		?>
		<tr>
			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Maximum height','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<?php if( isset($otherSettings[0][$prefix . '_max_height']) && $otherSettings[0][$prefix . '_max_height'] !='' ) { $method = $otherSettings[0][$prefix . '_max_height']; } else { $method = '100'; } ?>
				<input type="text" style="width: 350px; padding: 5px; margin: 25px 0px 15px 0px;" value="<?php echo $method ?>" name="<?php echo $prefix; ?>_max_height"><br>
				<?php _e('Set maximum height, after which the shipping method will no longer be displayed at checkout. Dimensions should be entered in the same unit of measurement as set in WooCommerce!','woocommerce-custom-shipping') ?>
			</th>
		</tr>
		<?php
	}

	/**
	* Maximum weight
	*
	* @access public
	* @return void
	*/
	public function maximumWeight($prefix, $otherSettings) {
		?>
		<tr>
			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Maximum weight','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<?php if( isset($otherSettings[0][$prefix . '_max_weight']) && $otherSettings[0][$prefix . '_max_weight'] !='' ) { $method = $otherSettings[0][$prefix . '_max_weight']; } else { $method = '100'; } ?>
				<input type="text" style="width: 350px; padding: 5px; margin: 25px 0px 15px 0px;" value="<?php echo $method ?>" name="<?php echo $prefix; ?>_max_weight"><br>
				<?php _e('Set maximum weight, after which the shipping method will no longer be displayed at checkout. Dimensions should be entered in the same unit of measurement as set in WooCommerce!','woocommerce-custom-shipping') ?>
			</th>
		</tr>
		<?php
	}

	/**
	* Handling costs
	*
	* @access public
	* @return void
	*/
	public function handlingCosts($prefix, $otherSettings) {
		?>
		<tr>
			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Handling costs','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<?php if( isset($otherSettings[0][$prefix . '_handlingcosts']) ) { $method = $otherSettings[0][$prefix . '_handlingcosts']; } else { $method = '0'; } ?>
				<input type="text" style="width: 350px; padding: 5px; margin: 25px 0px 15px 0px;" value="<?php echo $method ?>" name="<?php echo $prefix; ?>_handlingcosts"><br>
				<?php _e('Set handling costs.','woocommerce-custom-shipping') ?>
			</th>
		</tr>
		<?php
	}

	/**
	* Free shipping limit
	*
	* @access public
	* @return void
	*/
	public function freeShippingLimit($prefix, $otherSettings) {
		?>
		<tr>
			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Free Shipping Limit','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<?php if( isset($otherSettings[0][$prefix . '_free_shipping']) ) { $method = $otherSettings[0][$prefix . '_free_shipping']; } else { $method = ''; } ?>
				<input type="text" style="width: 350px; padding: 5px; margin: 25px 0px 15px 0px;" value="<?php echo $method ?>" name="<?php echo $prefix; ?>_free_shipping"><br>
				<?php _e('If given, shipping charges will no longer be added when the cart products exceed this amount.','woocommerce-custom-shipping') ?>
			</th>
		</tr>
		<?php
	}

	/**
	* Coupons
	*
	* @access public
	* @return void
	*/
	public function coupon($prefix, $otherSettings) {
		?>
		<tr>
			<th style="text-align: left; padding-bottom: 20px;">
				<h2><?php _e('Coupon settings','woocommerce-custom-shipping'); ?></h2>
			</th>
		</tr>

		<tr>
			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Coupon code','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<?php if( isset($otherSettings[0][$prefix . '_couponcode']) ) { $method = $otherSettings[0][$prefix . '_couponcode']; } else { $method = ''; } ?>
				<input type="text" style="width: 350px; padding: 5px; margin: 25px 0px 15px 0px;" value="<?php echo $method ?>" name="<?php echo $prefix; ?>_couponcode"><br>
				<?php _e('Enter this coupon code for free shipping. If you want to enter more than one code, separate the codes with a comma.','woocommerce-custom-shipping') ?>
			</th>
		</tr>
		<?php
	}

	/**
	* All coupons
	*
	* @access public
	* @return void
	*/
	public function allowAllCoupons($prefix, $otherSettings) {
		?>
		<tr>
			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Allow all coupons','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<?php if( isset($otherSettings[0][$prefix . '_all_coupons']) && $otherSettings[0][$prefix . '_all_coupons'] == 'yes') { 
					$kyllaSelected = 'selected';
					$eiSelected = '';
					} else {
						$kyllaSelected = '';
						$eiSelected = 'selected';
					}
				?>
				<select name="<?php echo $prefix; ?>_all_coupons" style="margin-bottom: 15px;">
					<option value="yes" <?php echo $kyllaSelected; ?>><?php _e('Yes','woocommerce-custom-shipping') ?></option>
					<option value="no" <?php echo $eiSelected; ?>><?php _e('No','woocommerce-custom-shipping') ?></option>
				</select><br>
				<?php _e('If selected, coupon codes do not need to be added separately, but free shipping is allowed on any coupon for which it is defined in WooCommerce - Coupons and set to be used for free shipping.','woocommerce-custom-shipping') ?>
			</th>
		</tr>
		<?php
	}

	/**
	* Area fee
	*
	* @access public
	* @return void
	*/
	public function areaFee($prefix, $otherSettings) {
		
		?>
		<tr>
			<th style="text-align: left; padding-bottom: 20px;">
				<h2><?php _e('Area Based Fee Settings','woocommerce-custom-shipping'); ?></h2>
			</th>
		</tr>

		<tr>
			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Area Fee','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<?php if( isset($otherSettings[0][$prefix . '_areafee']) ) { $method = $otherSettings[0][$prefix . '_areafee']; } else { $method = ''; } ?>
				<input type="text" style="width: 350px; padding: 5px; margin: 25px 0px 15px 0px;" value="<?php echo $method ?>" name="<?php echo $prefix; ?>_areafee"><br>
				<?php _e('Set area fee','woocommerce-custom-shipping') ?>
			</th>
		</tr>
		<?php
	}

	/**
	* Area fee cities
	*
	* @access public
	* @return void
	*/
	public function areaFeeCities($prefix, $otherSettings) {
		?>
		<tr>
			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Area fee cities','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<?php if( isset($otherSettings[0][$prefix . '_areafee_cities']) ) { $method = $otherSettings[0][$prefix . '_areafee_cities']; } else { $method = ''; } ?>
				<textarea name="<?php echo $prefix; ?>_areafee_cities" style="width: 450px; padding: 5px; margin: 25px 0px 15px 0px;"><?php echo $method ?></textarea><br>
				<?php _e('Enter here the cities, separated by commas, that are affected by the area fee defined above.','woocommerce-custom-shipping') ?>
			</th>
		</tr>
		<?php
	}

	/**
	* Area fee hiding
	*
	* @access public
	* @return void
	*/
	public function areaFeeHiding($prefix, $otherSettings) {
		?>
		<tr>
		<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Area based hiding','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<?php if( isset($otherSettings[0][$prefix . '_area_based_hiding']) && $otherSettings[0][$prefix . '_area_based_hiding'] == 'yes') { 
					$kyllaSelected = 'selected';
					$eiSelected = '';
					} else {
						$kyllaSelected = '';
						$eiSelected = 'selected';
					}
				?>
				<select name="<?php echo $prefix; ?>_area_based_hiding" style="margin-bottom: 15px;">
					<option value="yes" <?php echo $kyllaSelected; ?>><?php _e('Yes','woocommerce-custom-shipping') ?></option>
					<option value="no" <?php echo $eiSelected; ?>><?php _e('No','woocommerce-custom-shipping') ?></option>
				</select><br>
				<?php _e('If selected, shipping method will be hided if user does not enter the area listed above','woocommerce-custom-shipping') ?>
			</th>
		</tr>
		<?php
	}

	/**
	* Distance based fee
	*
	* @access public
	* @return void
	*/
	public function distaceBasedFee($prefix, $otherSettings) {
		?>
		<tr>
			<th style="text-align: left; padding-bottom: 20px;">
				<h2><?php _e('Distance Based Fee Settings','woocommerce-custom-shipping'); ?></h2>
			</th>
		</tr>
		<tr>
			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Google API key','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<?php if( isset($otherSettings[0][$prefix . '_googleapikey']) ) { $method = $otherSettings[0][$prefix . '_googleapikey']; } else { $method = ''; } ?>
				<input type="text" style="width: 350px; padding: 5px; margin: 25px 0px 15px 0px;" value="<?php echo $method ?>" name="<?php echo $prefix; ?>_googleapikey"><br>
				<?php _e('Set Google API key','woocommerce-custom-shipping') ?>
			</th>
		</tr>

		<tr>
			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Divider','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<?php if( isset($otherSettings[0][$prefix . '_dbf_divider']) ) { $method = $otherSettings[0][$prefix . '_dbf_divider']; } else { $method = ''; } ?>
				<input type="text" style="width: 350px; padding: 5px; margin: 25px 0px 15px 0px;" value="<?php echo $method ?>" name="<?php echo $prefix; ?>_dbf_divider"><br>
				<?php _e('Enter your divider number here. Price will be calculated by dividing the distance, and then multiplicated by the price.','woocommerce-custom-shipping') ?>
			</th>
		</tr>

		<tr>
			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Price','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<?php if( isset($otherSettings[0][$prefix . '_dbf_price']) ) { $method = $otherSettings[0][$prefix . '_dbf_price']; } else { $method = ''; } ?>
				<input type="text" style="width: 350px; padding: 5px; margin: 25px 0px 15px 0px;" value="<?php echo $method ?>" name="<?php echo $prefix; ?>_dbf_price"><br>
				<?php _e('Enter your price for the calculated distance.','woocommerce-custom-shipping') ?>
			</th>
		</tr>

		<tr>
			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Minimum distance','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<?php if( isset($otherSettings[0][$prefix . '_dbf_minimum_distance']) ) { $method = $otherSettings[0][$prefix . '_dbf_minimum_distance']; } else { $method = ''; } ?>
				<input type="text" style="width: 350px; padding: 5px; margin: 25px 0px 15px 0px;" value="<?php echo $method ?>" name="<?php echo $prefix; ?>_dbf_minimum_distance"><br>
				<?php _e('Enter the distance after the fee will be added. If distance is lower than this, only the shipping costs will be used without a distance based fee. Leave empty to disable this feature.','woocommerce-custom-shipping') ?>
			</th>
		</tr>

		<tr>
			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Maximum distance','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<?php if( isset($otherSettings[0][$prefix . '_dbf_maximum_distance']) ) { $method = $otherSettings[0][$prefix . '_dbf_maximum_distance']; } else { $method = ''; } ?>
				<input type="text" style="width: 350px; padding: 5px; margin: 25px 0px 15px 0px;" value="<?php echo $method ?>" name="<?php echo $prefix; ?>_dbf_maximum_distance"><br>
				<?php _e('Enter the maximum distance for the shipping method, that can be used with the fee. Leave empty to disable this feature.','woocommerce-custom-shipping') ?>
			</th>
		</tr>

		<tr>
			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Units','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<?php if( isset($otherSettings[0][$prefix . '_dbf_units']) && $otherSettings[0][$prefix . '_dbf_units'] == 'km') { 
						$dbf_kilometers = 'selected';
						$dbf_miles = '';
					} else if(isset($otherSettings[0][$prefix . '_dbf_units']) && $otherSettings[0][$prefix . '_dbf_units'] == 'ml') {
						$dbf_kilometers = '';
						$dbf_miles = 'selected';
					} else {
						$dbf_kilometers = 'selected';
						$dbf_miles = '';
					}
				?>
				<select name="<?php echo $prefix; ?>_dbf_units" style="margin-bottom: 15px;">
					<option value="km" <?php echo $dbf_kilometers; ?>><?php _e('Kilometers','woocommerce-custom-shipping') ?></option>
					<option value="ml" <?php echo $dbf_miles; ?>><?php _e('Miles','woocommerce-custom-shipping') ?></option>
				</select><br>
				<?php _e('Choose your units for the calculated distance.','woocommerce-custom-shipping') ?>
			</th>
		</tr>

		<tr>
			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('To Address','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<?php if( isset($otherSettings[0][$prefix . '_dbf_to_address']) && $otherSettings[0][$prefix . '_dbf_to_address'] == 'billing') { 
						$dbf_billing = 'selected';
						$dbf_shipping = '';
					} else if(isset($otherSettings[0][$prefix . '_dbf_to_address']) && $otherSettings[0][$prefix . '_dbf_to_address'] == 'shipping') {
						$dbf_billing = '';
						$dbf_shipping = 'selected';
					} else {
						$dbf_billing = '';
						$dbf_shipping = 'selected';
					}
				?>
				<select name="<?php echo $prefix; ?>_dbf_to_address" style="margin-bottom: 15px;">
					<option value="billing" <?php echo $dbf_billing; ?>><?php _e('Billing Address','woocommerce-custom-shipping') ?></option>
					<option value="shipping" <?php echo $dbf_shipping; ?>><?php _e('Shipping Address','woocommerce-custom-shipping') ?></option>
				</select><br>
				<?php _e('Choose if destination should be calculated by billing or shipping address. By default, shipping address will be used.','woocommerce-custom-shipping') ?>
			</th>
		</tr>

		<tr>
			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Origin address','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<?php if( isset($otherSettings[0][$prefix . '_dbf_origin_address']) ) { $method = $otherSettings[0][$prefix . '_dbf_origin_address']; } else { $method = ''; } ?>
				<input type="text" style="width: 350px; padding: 5px; margin: 25px 0px 15px 0px;" value="<?php echo $method ?>" name="<?php echo $prefix; ?>_dbf_origin_address"><br>
				<?php _e('Enter the from address, where the distance will be calucalted. If empty, the address set in WooCommerce settings will be used. Make also sure your address can be discovered by the Google API. You can try to locate your address at Google Maps service: <a href="https://www.google.com/maps" target="_blank">https://www.google.com/maps</a>','woocommerce-custom-shipping') ?>
			</th>
		</tr>

		<tr>
			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Origin zip','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<?php if( isset($otherSettings[0][$prefix . '_dbf_origin_zip']) ) { $method = $otherSettings[0][$prefix . '_dbf_origin_zip']; } else { $method = ''; } ?>
				<input type="text" style="width: 350px; padding: 5px; margin: 25px 0px 15px 0px;" value="<?php echo $method ?>" name="<?php echo $prefix; ?>_dbf_origin_zip"><br>
				<?php _e('Enter the from zipcode, where the distance will be calucalted. If empty, the zipcode set in WooCommerce settings will be used.','woocommerce-custom-shipping') ?>
			</th>
		</tr>

		<tr>
			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Origin city','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<?php if( isset($otherSettings[0][$prefix . '_dbf_origin_city']) ) { $method = $otherSettings[0][$prefix . '_dbf_origin_city']; } else { $method = ''; } ?>
				<input type="text" style="width: 350px; padding: 5px; margin: 25px 0px 15px 0px;" value="<?php echo $method ?>" name="<?php echo $prefix; ?>_dbf_origin_city"><br>
				<?php _e('Enter the from city, where the distance will be calucalted. If empty, the city set in WooCommerce settings will be used.','woocommerce-custom-shipping') ?>
			</th>
		</tr>

		<tr>
			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Disable fixed fee if minimum distance is reached?','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<?php if( isset($otherSettings[0][$prefix . '_dbf_disable_fixed_fee']) && $otherSettings[0][$prefix . '_dbf_disable_fixed_fee'] == 'true') { 
						$disable_fixed_fee_true = 'selected';
						$disable_fixed_fee_false = '';
					} else {
						$disable_fixed_fee_true = '';
						$disable_fixed_fee_false = 'selected';
					}
				?>
				<select name="<?php echo $prefix; ?>_dbf_disable_fixed_fee" style="margin-bottom: 15px;">
					<option value="true" <?php echo $disable_fixed_fee_true; ?>><?php _e('Disable','woocommerce-custom-shipping') ?></option>
					<option value="false" <?php echo $disable_fixed_fee_false; ?>><?php _e('Don´t disable','woocommerce-custom-shipping') ?></option>
				</select><br>
				<?php _e('If minimun distance is exceeded, should the fixed fee disabled?','woocommerce-custom-shipping') ?>
			</th>
		</tr>

		<tr>
			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Hide if destination cannot be found','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<?php if( isset($otherSettings[0][$prefix . '_dbf_destination_hiding']) && $otherSettings[0][$prefix . '_dbf_destination_hiding'] == 'true') { 
						$dbf_hiding_true = 'selected';
						$dbf_hiding_false = '';
					} else {
						$dbf_hiding_true = '';
						$dbf_hiding_false = 'selected';
					}
				?>
				<select name="<?php echo $prefix; ?>_dbf_destination_hiding" style="margin-bottom: 15px;">
					<option value="true" <?php echo $dbf_hiding_true; ?>><?php _e('Hide','woocommerce-custom-shipping') ?></option>
					<option value="false" <?php echo $dbf_hiding_false; ?>><?php _e('Don´t hide','woocommerce-custom-shipping') ?></option>
				</select><br>
				<?php _e('If destination cannot be found, should the shipping method be hided?','woocommerce-custom-shipping') ?>
			</th>
		</tr>

		<tr>
			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Hide if limits are exceeded','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<?php if( isset($otherSettings[0][$prefix . '_dbf_limit_hiding']) && $otherSettings[0][$prefix . '_dbf_limit_hiding'] == 'true') { 
						$dbf_limit_hiding_true = 'selected';
						$dbf_limit_hiding_false = '';
					} else {
						$dbf_limit_hiding_true = '';
						$dbf_limit_hiding_false = 'selected';
					}
				?>
				<select name="<?php echo $prefix; ?>_dbf_limit_hiding" style="margin-bottom: 15px;">
					<option value="true" <?php echo $dbf_limit_hiding_true; ?>><?php _e('Hide','woocommerce-custom-shipping') ?></option>
					<option value="false" <?php echo $dbf_limit_hiding_false; ?>><?php _e('Don´t hide','woocommerce-custom-shipping') ?></option>
				</select><br>
				<?php _e('If minimum or maximum limit is reached, should the shipping method be hided?','woocommerce-custom-shipping') ?>
			</th>
		</tr>

		<tr>
			<?php
				$pluginlog = plugin_dir_path(__FILE__).'../../logs/debug.log';
				if(file_exists($pluginlog)) {
					$plugin_text = file_get_contents($pluginlog);
				} else {
					$plugin_text = 'No errors!';
				}
			?>

			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Google API Log','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<textarea disabled name="<?php echo $prefix; ?>_dbf_log" style="width: 450px; height: 300px; padding: 5px; margin: 25px 0px 15px 0px;"><?php echo $plugin_text ?></textarea><br>
				<?php _e('If distance based fee isn´t working, see the log here from the Google API to fix any issues.','woocommerce-custom-shipping') ?>
			</th>
		</tr>

		<?php
	}

	/**
	* Shipping class fees
	*
	* @access public
	* @return void
	*/
	public function shippingClasses($prefix, $otherSettings) {
		$shipping_classes = WC()->shipping()->get_shipping_classes();

		if ( ! empty( $shipping_classes ) ) {
			?>
			<tr>
				<th style="text-align: left; padding-bottom: 20px;">
					<h2><?php _e('Shipping Class Settings','woocommerce-custom-shipping'); ?></h2>
				</th>
			</tr>

			<?php foreach ( $shipping_classes as $shipping_class ) {
				if ( ! isset( $shipping_class->term_id ) ) {
					continue;
				}
				
				$class_amount = '';
			?>
				<tr>
					<th style="text-align: left; padding-bottom: 20px;" width="250">
						<p>Shipping cost for class: <?php echo $shipping_class->name; ?></p>
					</th>


					<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
						<?php 
							if( isset($otherSettings[0][$prefix . '_shipping_classes'])) {
								foreach($otherSettings[0][$prefix . '_shipping_classes'] as $shp_class) {
									if(isset($shp_class['slug']) && $shp_class['slug'] == $shipping_class->slug) {
										$class_amount = $shp_class['amount'];
										continue;
									}
								
								}
								?>

								<input type="text" style="width: 350px; padding: 5px; margin: 25px 0px 15px 0px;" value="<?php echo $class_amount; ?>" name="<?php echo $prefix . '_shipping_classes_' . $shipping_class->slug; ?>">
								
								<?php
							}
							?>
					</th>
				</tr>

			<?php } ?>

			<tr>
			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Calculation type','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<?php if( isset($otherSettings[0][$prefix . '_class_calculation_type']) && $otherSettings[0][$prefix . '_class_calculation_type'] == 'per_class') { 
						$shipping_class_per_class = 'selected';
						$shipping_class_per_order = '';
					} else if(isset($otherSettings[0][$prefix . '_class_calculation_type']) && $otherSettings[0][$prefix . '_class_calculation_type'] == 'per_order') {
						$shipping_class_per_class = '';
						$shipping_class_per_order = 'selected';
					} else {
						$shipping_class_per_class = 'selected';
						$shipping_class_per_order = '';
					}
				?>
				<select name="<?php echo $prefix; ?>_class_calculation_type" style="margin-bottom: 15px;">
					<option value="per_class" <?php echo $shipping_class_per_class; ?>><?php _e('Per class: Charge shipping for each shipping class individually','woocommerce-custom-shipping') ?></option>
					<option value="per_order" <?php echo $shipping_class_per_order; ?>><?php _e('Per order: Charge shipping for the most expensive shipping class','woocommerce-custom-shipping') ?></option>
				</select><br>
				<?php _e('Choose calculation type for the shipping classes','woocommerce-custom-shipping') ?>
			</th>
		</tr>
		
		<?php }
	}

	/**
	* Availability
	*
	* @access public
	* @return void
	*/
	public function availability($prefix, $otherSettings) {
		?>
		<tr>
			<th style="text-align: left; padding-bottom: 20px;">
				<h2><?php _e('Availability settings','woocommerce-custom-shipping'); ?></h2>
			</th>
		</tr>
		<tr>
			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Availability','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<?php if( isset($otherSettings[0][$prefix . '_availability']) && $otherSettings[0][$prefix . '_availability'] == 'not_chosen') { 
						$allSelected = '';
						$chosenSelected = '';
						$eiValitutSelected = 'selected';
					} else if(isset($otherSettings[0][$prefix . '_availability']) && $otherSettings[0][$prefix . '_availability'] == 'chosen') {
						$allSelected = '';
						$chosenSelected = 'selected';
						$eiValitutSelected = '';
					} else {
						$allSelected = 'selected';
						$chosenSelected = '';
						$eiValitutSelected = '';
					}
				?>
				<select name="<?php echo $prefix; ?>_availability" style="margin-bottom: 15px;">
					<option value="all" <?php echo $allSelected; ?>><?php _e('Shipped to all countries','woocommerce-custom-shipping') ?></option>
					<option value="chosen" <?php echo $chosenSelected; ?>><?php _e('Shippied to only chosen countries','woocommerce-custom-shipping') ?></option>
					<option value="not_chosen" <?php echo $eiValitutSelected; ?>><?php _e('Not shipped to the chosen countries','woocommerce-custom-shipping') ?></option>
				</select><br>
				<?php _e('Select shipping countries.','woocommerce-custom-shipping') ?>
			</th>
		</tr>
		<?php
	}

	/**
	* Countries
	*
	* @access public
	* @return void
	*/
	public function chosenCountries($prefix, $otherSettings) {
		?>
		<tr>
			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Chosen countries','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<select multiple="multiple" class="wc-enhanced-select noborder" style="width: 450px; margin-bottom: 15px;" name="<?php echo $prefix; ?>_chosen_countries[]">
					<?php
						if(isset($otherSettings[0][$prefix . '_chosen_countries']) && is_array($otherSettings[0][$prefix . '_chosen_countries'])) {
							foreach($otherSettings[0][$prefix . '_chosen_countries'] as $maa) {
								echo '<option selected value="' . $maa .'">' . $maa . '</option>';
							}
						}
					?>
					<?php foreach($this->getCountries as $getCountry) { ?>
						<option><?php echo $getCountry; ?></option>
					<?php } ?>
				</select><br>
				<?php _e('Choose countries for the availability.','woocommerce-custom-shipping') ?>
			</th>
		</tr>
		<?php
	}

	/**
	* Taxing
	*
	* @access public
	* @return void
	*/
	public function taxable($prefix, $otherSettings) {
		?>
		<tr>
			<th style="text-align: left; padding-bottom: 20px;" width="250">
				<p><?php _e('Taxable','woocommerce-custom-shipping') ?></p>
			</th>
			<th style="text-align: left; font-weight: normal; padding-bottom: 20px;" width="auto">
				<?php if( isset($otherSettings[0][$prefix . '_taxable']) && $otherSettings[0][$prefix . '_taxable'] == 'no') { 
						$kyllaSelected = '';
						$eiSelected = 'selected';
					} else {
						$kyllaSelected = 'selected';
						$eiSelected = '';
					}
				?>
				<select name="<?php echo $prefix; ?>_taxable" style="margin-bottom: 15px;">
					<option value="yes" <?php echo $kyllaSelected; ?>><?php _e('Yes','woocommerce-custom-shipping') ?></option>
					<option value="no" <?php echo $eiSelected; ?>><?php _e('No','woocommerce-custom-shipping') ?></option>
				</select><br>
				<?php _e('Taxable?','woocommerce-custom-shipping') ?>
			</th>
		</tr>
		<?php
	}
}
?>