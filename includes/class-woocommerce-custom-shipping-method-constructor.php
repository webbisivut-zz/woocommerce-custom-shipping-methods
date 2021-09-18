<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Our main function
 *
 * @access public
 * @return void
 */
function WB_Custom_WooCommerce_Shipping_Method_Init() {

	if ( ! class_exists( 'WB_Custom_WooCommerce_Shipping_Method' ) ) {

		class WB_Custom_WooCommerce_Shipping_Method extends WC_Shipping_Method {		
			
			/**
			* Constructor
			*
			* @access public
			* @return void
			*/
			public function __construct( $instance_id = 0 ) {

				$this->id = 'WB_Custom_WooCommerce_Shipping_Method';
				$this->instance_id = absint( $instance_id );
				$this->method_title = __( 'WooCommerce Custom Shipping Method', 'woocommerce-custom-shipping' );
				$this->method_description = __( 'WooCommerce Custom Shipping Method', 'woocommerce-custom-shipping' );

				$this->supports = array(
					'shipping-zones',
					'instance-settings',
				);

				$this->init();
			}

			/**
			* Init settings
			*
			* @access public
			* @return void
			*/
			function init() {

				$this->init_form_fields();
				$this->init_settings();

				$otherSettingsArr_details = $this->otherSettings();

				if(isset($otherSettingsArr_details[0][$this->prefix() . '_method_name']) && $otherSettingsArr_details[0][$this->prefix() . '_method_name'] != '') {
					$shipping_title = $otherSettingsArr_details[0][$this->prefix() . '_method_name'];
				} else {
					$shipping_title = "WooCommerce Custom Shipping Method";
				}

				$this->title = $shipping_title;

				// Save settings in admin if you have any defined
				add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
			}

			/**
			* prefix function
			*
			* @access public
			* @return variable
			*/
			public function prefix() {
				return 'wb_custom_shipping_method';
			}

			/**
			* savePrefix function
			*
			* @access public
			* @return variable
			*/
			public function savePrefix() {
				return 'woocommerce_wb_custom_shipping_method' . $this->instance_id;
			}

			/**
			* pricingSteps function.
			*
			* @access public
			* @return array
			*/
			public function pricingSteps() {
				$pricingSteps_details = get_option( $this->savePrefix() . '_country_prices',
					array(
						array(
							'unit' 		  => sanitize_text_field($this->get_option( 'unit' )),
							'weight_step' => sanitize_text_field($this->get_option( 'weight_step' )),
							'amount'      => sanitize_text_field($this->get_option( 'amount' ))
						),
					)
				);

				// Load default values if settings array is empty
				if($pricingSteps_details == null || isset($pricingSteps_details[0]['weight_step']) && $pricingSteps_details[0]['weight_step'] == '') {
					$pricingSteps_details = 
						array();
				}

				return $pricingSteps_details;
			}

			/**
			* otherSettings function.
			*
			* @access public
			* @return array
			*/
			public function otherSettings() {
				$otherSettingsArr_details = get_option( $this->savePrefix() . '_other_settings',
					array(
						array(
							$this->prefix() . '_pricing_unit'      	=> sanitize_text_field($this->get_option( $this->prefix() . '_pricing_unit' )),
							$this->prefix() . '_fixed_price'      	=> sanitize_text_field($this->get_option( $this->prefix() . '_fixed_price' )),
							$this->prefix() . '_method_name'      	=> sanitize_text_field($this->get_option( $this->prefix() . '_method_name' )),
							$this->prefix() . '_max_length'      	=> sanitize_text_field($this->get_option( $this->prefix() . '_max_length' )),
							$this->prefix() . '_max_width'      	=> sanitize_text_field($this->get_option( $this->prefix() . '_max_width' )),
							$this->prefix() . '_max_height'      	=> sanitize_text_field($this->get_option( $this->prefix() . '_max_height' )),
							$this->prefix() . '_max_weight'      	=> sanitize_text_field($this->get_option( $this->prefix() . '_max_weight' )),
							$this->prefix() . '_handlingcosts'      => sanitize_text_field($this->get_option( $this->prefix() . '_handlingcosts' )),
							$this->prefix() . '_free_shipping'      => sanitize_text_field($this->get_option( $this->prefix() . '_free_shipping' )),
							$this->prefix() . '_areafee'      		=> sanitize_text_field($this->get_option( $this->prefix() . '_areafee' )),
							$this->prefix() . '_areafee_cities'     => sanitize_text_field($this->get_option( $this->prefix() . '_areafee_cities' )),
							$this->prefix() . '_area_based_hiding'     => sanitize_text_field($this->get_option( $this->prefix() . '_area_based_hiding' )),
							$this->prefix() . '_couponcode'      	=> sanitize_text_field($this->get_option( $this->prefix() . '_couponcode' )),
							$this->prefix() . '_all_coupons'      	=> sanitize_text_field($this->get_option( $this->prefix() . '_all_coupons' )),
							$this->prefix() . '_availability'      	=> sanitize_text_field($this->get_option( $this->prefix() . '_availability' )),
							$this->prefix() . '_chosen_countries'   => sanitize_text_field($this->get_option( $this->prefix() . '_chosen_countries' )),
							$this->prefix() . '_taxable'      		=> sanitize_text_field($this->get_option( $this->prefix() . '_taxable' )),
							$this->prefix() . '_googleapikey'      		=> sanitize_text_field($this->get_option( $this->prefix() . '_googleapikey' )),
							$this->prefix() . '_dbf_divider'      		=> sanitize_text_field($this->get_option( $this->prefix() . '_dbf_divider' )),
							$this->prefix() . '_dbf_price'      		=> sanitize_text_field($this->get_option( $this->prefix() . '_dbf_price' )),
							$this->prefix() . '_dbf_minimum_distance'      		=> sanitize_text_field($this->get_option( $this->prefix() . '_dbf_minimum_distance' )),
							$this->prefix() . '_dbf_maximum_distance'      		=> sanitize_text_field($this->get_option( $this->prefix() . '_dbf_maximum_distance' )),
							$this->prefix() . '_dbf_units'      		=> sanitize_text_field($this->get_option( $this->prefix() . '_dbf_units' )),
							$this->prefix() . '_dbf_to_address'      		=> sanitize_text_field($this->get_option( $this->prefix() . '_dbf_to_address' )),
							$this->prefix() . '_dbf_origin_address'      		=> sanitize_text_field($this->get_option( $this->prefix() . '_dbf_origin_address' )),
							$this->prefix() . '_dbf_origin_zip'      		=> sanitize_text_field($this->get_option( $this->prefix() . '_dbf_origin_zip' )),
							$this->prefix() . '_dbf_origin_city'      		=> sanitize_text_field($this->get_option( $this->prefix() . '_dbf_origin_city' )),
							$this->prefix() . '_dbf_destination_hiding'      		=> sanitize_text_field($this->get_option( $this->prefix() . '_dbf_destination_hiding' )),
							$this->prefix() . '_dbf_disable_fixed_fee'      		=> sanitize_text_field($this->get_option( $this->prefix() . '_dbf_disable_fixed_fee' )),
							$this->prefix() . '_dbf_limit_hiding'      		=> sanitize_text_field($this->get_option( $this->prefix() . '_dbf_limit_hiding' )),
							$this->prefix() . '_class_calculation_type'      		=> sanitize_text_field($this->get_option( $this->prefix() . '_class_calculation_type' )),
						),
					)
				);

				return $otherSettingsArr_details;
			}

			/**
			* admin_options function.
			*
			* @access public
			* @return void
			*/
			function admin_options() {

				 $pricingSteps_details = $this->pricingSteps();
				 $otherSettingsArr_details = $this->otherSettings();

				 $shipping_settings = new wb_woocommerce_custom_shipping_table_settings();
				 ?>
				 
				 <tr>
					<th style="text-align: left; padding-bottom: 20px;">
						<h2><?php _e('Unit Based Shipping Settings','woocommerce-custom-shipping'); ?></h2>
					</th>
				</tr>

				<table class="form-table">
					<div id="wb_woocommerce_custom_shipping_ohjeet">
						<p><?php _e('1) Select New Row','woocommerce-custom-shipping'); ?></p>
						<p><?php _e('2) In the unit field you can choose pricing based on length, width, height or weight.','woocommerce-custom-shipping'); ?></p>
						<p><?php _e('3) In the "Threshold" field, set a threshold value for the pricing.','woocommerce-custom-shipping'); ?></p>
						<p><?php _e('4) In the "Price" field, set the price for the threshold value. This price will be used when the selected pricing unit is below the threshold value.','woocommerce-custom-shipping'); ?></p>
						<p><?php _e('5) Repeat the process as many times as you want to set different thresholds.','woocommerce-custom-shipping'); ?></p>
					</div>
				</table>

				 <table style="width: 100%; max-width: 610px;">
				 <tr valign="top">
					<td class="forminp" id="wb_custom_shipping_method_country_prices">
						<table class="widefat wc_input_table" cellspacing="0">
							<thead>
								<tr>
									<th><?php _e( 'Unit', 'woocommerce-custom-shipping' ); ?></th>
									<th><?php _e( 'Threshold', 'woocommerce-custom-shipping' ); ?></th>
									<th><?php _e( 'Price', 'woocommerce-custom-shipping' ); ?></th>
								</tr>
							</thead>
							<tbody class="country_prices">
								<?php
								$i = -1;
								if ( $pricingSteps_details ) {
									foreach ( $pricingSteps_details as $countriesArr ) {
										$getUnit = $countriesArr['unit'];
										$selectWeight = '';
										$selectHeight = '';
										$selectLength = '';
										$selectWidth = '';

										switch ($getUnit) {
											case 'weight':
												$selectWeight = 'selected';
												break;
											case 'height':
												$selectHeight = 'selected';
												break;
											case 'length':
												$selectLength = 'selected';
												break;
											case 'width':
												$selectWidth = 'selected';
												break;
										}

										$i++;
										echo '<tr class="countriesArr">
											<td><select class="noborder" value="' . esc_attr( $countriesArr['unit'] ) . '" name="wb_custom_shipping_method_unit[' . $i . ']" /> <option ' . $selectWeight .' value="weight">Weight</option> <option ' . $selectHeight .' value="height">Height</option> <option ' . $selectLength .' value="length">Length</option> <option ' . $selectWidth .' value="width">Width</option></select></td>
											<td><input type="text" class="noborder" value="' . esc_attr( $countriesArr['weight_step'] ) . '" name="wb_custom_shipping_method_weight_step[' . $i . ']" /></td>
											<td><input type="text" class="noborder" value="' . esc_attr( $countriesArr['amount'] ) . '" name="wb_custom_shipping_method_amount[' . $i . ']" /></td>
										</tr>';
									}
								}
								?>
							</tbody>
							<tfoot>
								<tr>
									<th colspan="7"><a href="#" style="background: #2d90cc; color: #fff;" class="add button"><?php _e( '+ New row', 'woocommerce-custom-shipping' ); ?></a> <a href="#" style="background: #eee; color: #333;" class="remove_rows button"><?php _e( 'Remove chosen rows', 'woocommerce-custom-shipping' ); ?></a></th>
								</tr>
							</tfoot>
						</table>
						<script type="text/javascript">
							jQuery(function() {
								var getAvailableCountries = jQuery('#wb_woocommerce_custom_shipping_all_shipping_countries').html();
								var getAdminScriptSrc = jQuery('#get_admin_script_url').text();

								jQuery('#wb_custom_shipping_method_country_prices').on( 'click', 'a.add', function(){
									var size = jQuery('#wb_custom_shipping_method_country_prices').find('tbody .countriesArr').length;

									jQuery('<tr class="countriesArr">\
											<td><select value="" name="wb_custom_shipping_method_unit[' + size + ']"><option value="weight">Weight</option> <option value="height">Height</option> <option value="length">Length</option> <option value="width">Width</option></select></td>\
											<td><input type="text" class="noborder" value="" name="wb_custom_shipping_method_weight_step[' + size + ']" /></td>\
											<td><input type="text" class="noborder" value="" name="wb_custom_shipping_method_amount[' + size + ']" /></td>\
										</tr>').appendTo('#wb_custom_shipping_method_country_prices table tbody');
									jQuery.getScript(getAdminScriptSrc);
									return false;
								});
							});
						</script>
					</td>
				</tr>
				</table>
				<table>
					<?php
						echo $shipping_settings->shippingName($this->prefix(), $otherSettingsArr_details, $this->title);
						echo $shipping_settings->overAmount($this->prefix(), $otherSettingsArr_details);
						echo $shipping_settings->handlingCosts($this->prefix(), $otherSettingsArr_details);
						
						echo $shipping_settings->maximumlength($this->prefix(), $otherSettingsArr_details);
						echo $shipping_settings->maximumwidth($this->prefix(), $otherSettingsArr_details);
						echo $shipping_settings->maximumheight($this->prefix(), $otherSettingsArr_details);
						echo $shipping_settings->maximumweight($this->prefix(), $otherSettingsArr_details);
						
						echo $shipping_settings->freeShippingLimit($this->prefix(), $otherSettingsArr_details);
						echo $shipping_settings->coupon($this->prefix(), $otherSettingsArr_details);
						echo $shipping_settings->allowAllCoupons($this->prefix(), $otherSettingsArr_details);
						echo $shipping_settings->areafee($this->prefix(), $otherSettingsArr_details);
						echo $shipping_settings->areafeecities($this->prefix(), $otherSettingsArr_details);
						echo $shipping_settings->areaFeeHiding($this->prefix(), $otherSettingsArr_details);
						echo $shipping_settings->distaceBasedFee($this->prefix(), $otherSettingsArr_details);
						echo $shipping_settings->shippingClasses($this->prefix(), $otherSettingsArr_details);
						echo $shipping_settings->availability($this->prefix(), $otherSettingsArr_details);
						echo $shipping_settings->chosenCountries($this->prefix(), $otherSettingsArr_details);
						echo $shipping_settings->taxable($this->prefix(), $otherSettingsArr_details);
					?>
		 		 </table>
			<?php
			
			}

			/**
			* Admin options function
			*
			* @access public
			* @return void
			*/
			public function process_admin_options() {
				if(isset($_POST[$this->prefix() . '_amount'])) {
					$amounts      = array_map( 'wc_clean', $_POST[$this->prefix() . '_amount']);
				} else {
					$amounts = array();
				}

				if(isset($_POST[$this->prefix() . '_unit'])) {
					$units      = array_map( 'wc_clean', $_POST[$this->prefix() . '_unit']);
				} else {
					$units = array();
				}

				if(isset($_POST[$this->prefix() . '_weight_step'])) {
					$weights      = array_map( 'wc_clean', $_POST[$this->prefix() . '_weight_step']);
				} else {
					$weights = array();
				}

				$amounts = array_values($amounts);
				$units = array_values($units);
				$weights = array_values($weights);

				$wb_woocommerce_custom_shipping_fixed_price = isset($_POST[$this->prefix() . '_fixed_price']) ? sanitize_text_field(str_replace(",", ".", $_POST[$this->prefix() . '_fixed_price'])) : '';
				$wb_woocommerce_custom_shipping_method_name = isset($_POST[$this->prefix() . '_method_name']) ? sanitize_text_field($_POST[$this->prefix() . '_method_name']) : '';
				$wb_woocommerce_custom_shipping_max_length = isset($_POST[$this->prefix() . '_max_length']) ? sanitize_text_field(str_replace(",", ".", $_POST[$this->prefix() . '_max_length'])) : '';
				$wb_woocommerce_custom_shipping_max_width = isset($_POST[$this->prefix() . '_max_width']) ? sanitize_text_field(str_replace(",", ".", $_POST[$this->prefix() . '_max_width'])) : '';
				$wb_woocommerce_custom_shipping_max_height = isset($_POST[$this->prefix() . '_max_height']) ? sanitize_text_field(str_replace(",", ".", $_POST[$this->prefix() . '_max_height'])) : '';
				$wb_woocommerce_custom_shipping_max_weight = isset($_POST[$this->prefix() . '_max_weight']) ? sanitize_text_field(str_replace(",", ".", $_POST[$this->prefix() . '_max_weight'])) : '';
				$wb_woocommerce_custom_shipping_handlingcosts = isset($_POST[$this->prefix() . '_handlingcosts']) ? sanitize_text_field(str_replace(",", ".", $_POST[$this->prefix() . '_handlingcosts'])) : '';
				$wb_woocommerce_custom_shipping_free_shipping = isset($_POST[$this->prefix() . '_free_shipping']) ? sanitize_text_field(str_replace(",", ".", $_POST[$this->prefix() . '_free_shipping'])) : '';
				$wb_woocommerce_custom_shipping_areafee = isset($_POST[$this->prefix() . '_areafee']) ? sanitize_text_field(str_replace(",", ".", $_POST[$this->prefix() . '_areafee'])) : '';
				
				$wb_woocommerce_custom_shipping_areafee_cities = isset($_POST[$this->prefix() . '_areafee_cities']) ? sanitize_text_field($_POST[$this->prefix() . '_areafee_cities']) : '';
				$wb_woocommerce_custom_shipping_area_based_hiding = isset($_POST[$this->prefix() . '_area_based_hiding']) ? sanitize_text_field($_POST[$this->prefix() . '_area_based_hiding']) : '';
				$wb_woocommerce_custom_shipping_couponcode = isset($_POST[$this->prefix() . '_couponcode']) ? sanitize_text_field($_POST[$this->prefix() . '_couponcode']) : '';
				$wb_woocommerce_custom_shipping_all_coupons = isset($_POST[$this->prefix() . '_all_coupons']) ? sanitize_text_field($_POST[$this->prefix() . '_all_coupons']) : '';
				
				$wb_woocommerce_custom_shipping_googleapikey = isset($_POST[$this->prefix() . '_googleapikey']) ? sanitize_text_field($_POST[$this->prefix() . '_googleapikey']) : '';
				$wb_woocommerce_custom_shipping_dbf_divider = isset($_POST[$this->prefix() . '_dbf_divider']) ? sanitize_text_field($_POST[$this->prefix() . '_dbf_divider']) : '';
				$wb_woocommerce_custom_shipping_dbf_price = isset($_POST[$this->prefix() . '_dbf_price']) ? sanitize_text_field($_POST[$this->prefix() . '_dbf_price']) : '';
				$wb_woocommerce_custom_shipping_dbf_minimum_distance = isset($_POST[$this->prefix() . '_dbf_minimum_distance']) ? sanitize_text_field($_POST[$this->prefix() . '_dbf_minimum_distance']) : '';
				$wb_woocommerce_custom_shipping_dbf_maximum_distance = isset($_POST[$this->prefix() . '_dbf_maximum_distance']) ? sanitize_text_field($_POST[$this->prefix() . '_dbf_maximum_distance']) : '';
				$wb_woocommerce_custom_shipping_dbf_units = isset($_POST[$this->prefix() . '_dbf_units']) ? sanitize_text_field($_POST[$this->prefix() . '_dbf_units']) : '';
				$wb_woocommerce_custom_shipping_dbf_to_address = isset($_POST[$this->prefix() . '_dbf_to_address']) ? sanitize_text_field($_POST[$this->prefix() . '_dbf_to_address']) : '';
				$wb_woocommerce_custom_shipping_dbf_origin_address = isset($_POST[$this->prefix() . '_dbf_origin_address']) ? sanitize_text_field($_POST[$this->prefix() . '_dbf_origin_address']) : '';
				$wb_woocommerce_custom_shipping_dbf_origin_zip = isset($_POST[$this->prefix() . '_dbf_origin_zip']) ? sanitize_text_field($_POST[$this->prefix() . '_dbf_origin_zip']) : '';
				$wb_woocommerce_custom_shipping_dbf_origin_city = isset($_POST[$this->prefix() . '_dbf_origin_city']) ? sanitize_text_field($_POST[$this->prefix() . '_dbf_origin_city']) : '';
				$wb_woocommerce_custom_shipping_dbf_limit_hiding = isset($_POST[$this->prefix() . '_dbf_limit_hiding']) ? sanitize_text_field($_POST[$this->prefix() . '_dbf_limit_hiding']) : '';
				$wb_woocommerce_custom_shipping_dbf_destination_hiding = isset($_POST[$this->prefix() . '_dbf_destination_hiding']) ? sanitize_text_field($_POST[$this->prefix() . '_dbf_destination_hiding']) : '';
				
				$wb_woocommerce_custom_shipping_dbf_disable_fixed_fee = isset($_POST[$this->prefix() . '_dbf_disable_fixed_fee']) ? sanitize_text_field($_POST[$this->prefix() . '_dbf_disable_fixed_fee']) : '';
				
				$wb_woocommerce_custom_shipping_class_calculation_type = isset($_POST[$this->prefix() . '_class_calculation_type']) ? sanitize_text_field($_POST[$this->prefix() . '_class_calculation_type']) : '';
				$wb_woocommerce_custom_shipping_availability = isset($_POST[$this->prefix() . '_availability']) ? sanitize_text_field($_POST[$this->prefix() . '_availability']) : '';

				$shipping_classes = WC()->shipping()->get_shipping_classes();
				$saved_shipping_class_prices = array();

				if ( ! empty( $shipping_classes ) ) {
					foreach ( $shipping_classes as $shipping_class ) {
						if ( ! isset( $shipping_class->term_id ) ) {
							continue;
						}

						if(isset($_POST[$this->prefix() . '_shipping_classes_' . $shipping_class->slug])) {
							$wb_woocommerce_custom_shipping_method  = esc_attr($_POST[$this->prefix() . '_shipping_classes_' . $shipping_class->slug]);
						
							array_push($saved_shipping_class_prices, 
								array(
									'slug' => $shipping_class->slug, 
									'amount' => $wb_woocommerce_custom_shipping_method
								)
							);
						}
						
					}
				}
				
				if(isset($_POST[$this->prefix() . '_chosen_countries']) && is_array($_POST[$this->prefix() . '_chosen_countries'])) {
					$wb_woocommerce_custom_shipping_chosen_countries      = array_map( 'wc_clean', $_POST[$this->prefix() . '_chosen_countries']);
				} else {
					$wb_woocommerce_custom_shipping_chosen_countries = array();
				}
				
				$wb_woocommerce_custom_shipping_taxable      = esc_attr($_POST[$this->prefix() . '_taxable']);

				$countryArr = array();
				$country_prices = array();
				
				$other_settings = array();
				
				for ( $i = 0; $i < sizeof($amounts); $i++) {
					$country_prices[] = array(
						'unit' 		  => sanitize_text_field((string)$units[$i]),
						'weight_step' => esc_attr((float)$weights[$i]),
						'amount'      => esc_attr(str_replace(",", ".", (float)$amounts[ $i ])),
					);
				}

				sort($country_prices);

				$other_settings[] = array(
					$this->prefix() . '_fixed_price'   => $wb_woocommerce_custom_shipping_fixed_price,
					$this->prefix() . '_method_name'   => $wb_woocommerce_custom_shipping_method_name,
					$this->prefix() . '_max_length'   => $wb_woocommerce_custom_shipping_max_length,
					$this->prefix() . '_max_width'   => $wb_woocommerce_custom_shipping_max_width,
					$this->prefix() . '_max_height'   => $wb_woocommerce_custom_shipping_max_height,
					$this->prefix() . '_max_weight'   => $wb_woocommerce_custom_shipping_max_weight,
					$this->prefix() . '_handlingcosts'   => $wb_woocommerce_custom_shipping_handlingcosts,
					$this->prefix() . '_free_shipping'   => $wb_woocommerce_custom_shipping_free_shipping,
					$this->prefix() . '_areafee'   => $wb_woocommerce_custom_shipping_areafee,
					$this->prefix() . '_areafee_cities'   => $wb_woocommerce_custom_shipping_areafee_cities,
					$this->prefix() . '_area_based_hiding'   => $wb_woocommerce_custom_shipping_area_based_hiding,
					$this->prefix() . '_couponcode'   => $wb_woocommerce_custom_shipping_couponcode,
					$this->prefix() . '_all_coupons'   => $wb_woocommerce_custom_shipping_all_coupons,
					$this->prefix() . '_availability'   => $wb_woocommerce_custom_shipping_availability,
					$this->prefix() . '_chosen_countries'   => $wb_woocommerce_custom_shipping_chosen_countries,
					$this->prefix() . '_taxable'   => $wb_woocommerce_custom_shipping_taxable,
					$this->prefix() . '_shipping_classes'   => $saved_shipping_class_prices,
					
					$this->prefix() . '_googleapikey'   => $wb_woocommerce_custom_shipping_googleapikey,
					$this->prefix() . '_dbf_divider'   => $wb_woocommerce_custom_shipping_dbf_divider,
					$this->prefix() . '_dbf_price'   => $wb_woocommerce_custom_shipping_dbf_price,
					$this->prefix() . '_dbf_minimum_distance'   => $wb_woocommerce_custom_shipping_dbf_minimum_distance,
					$this->prefix() . '_dbf_maximum_distance'   => $wb_woocommerce_custom_shipping_dbf_maximum_distance,
					$this->prefix() . '_dbf_units'   => $wb_woocommerce_custom_shipping_dbf_units,
					$this->prefix() . '_dbf_to_address'   => $wb_woocommerce_custom_shipping_dbf_to_address,
					$this->prefix() . '_dbf_origin_address'   => $wb_woocommerce_custom_shipping_dbf_origin_address,
					$this->prefix() . '_dbf_origin_zip'   => $wb_woocommerce_custom_shipping_dbf_origin_zip,
					$this->prefix() . '_dbf_origin_city'   => $wb_woocommerce_custom_shipping_dbf_origin_city,
					$this->prefix() . '_dbf_destination_hiding'   => $wb_woocommerce_custom_shipping_dbf_destination_hiding,
					$this->prefix() . '_dbf_disable_fixed_fee'   => $wb_woocommerce_custom_shipping_dbf_disable_fixed_fee,
					$this->prefix() . '_dbf_limit_hiding'   => $wb_woocommerce_custom_shipping_dbf_limit_hiding,
					
					$this->prefix() . '_class_calculation_type'   => $wb_woocommerce_custom_shipping_class_calculation_type,
				);

				update_option( $this->savePrefix() . '_country_prices', $country_prices );
				update_option( $this->savePrefix() . '_other_settings', $other_settings );
			}

			/**
			* Calculate_shipping function
			*
			* @access public
			* @return void
			*/
			public function calculate_shipping( $package = array() ) {
				$woocommerce = function_exists('WC') ? WC() : $GLOBALS['woocommerce'];
				$weight      = $woocommerce->cart->cart_contents_weight;
				$country     = WC()->countries->countries[ WC()->customer->get_shipping_country() ];
				$city        = strtolower(WC()->customer->get_shipping_city());

				$total_shipping_cost = 0;

				$cart_price = $woocommerce->cart->get_cart_contents_total();

				if($cart_price > 999) {
					$woocommerce_price_thousand_sep = esc_attr(get_option('woocommerce_price_thousand_sep'));
					$woocommerce_price_decimal_sep = esc_attr(get_option('woocommerce_price_decimal_sep'));

					if($woocommerce_price_thousand_sep == ',') {
						$replace = '';
						$needle = ',';

						$cart_price = $this->formatPriceWebDataCustomShipping($cart_price, $replace, $needle);

						if($woocommerce_price_decimal_sep == ',') {
							$cart_price = str_replace(',', '.', $cart_price);
						}
					} else if($woocommerce_price_thousand_sep == '.') {
						$replace = '';
						$needle = '.';

						$cart_price = $this->formatPriceWebDataCustomShipping($cart_price, $replace, $needle);

						if($woocommerce_price_decimal_sep == ',') {
							$cart_price = str_replace(',', '.', $cart_price);
						}
					} else if($woocommerce_price_thousand_sep == '' OR $woocommerce_price_thousand_sep == ' ') {
						if($woocommerce_price_decimal_sep == ',') {
							$cart_price = str_replace(',', '.', $cart_price);
						}
					}
				}
				
				$cart_price = floatval($cart_price);
				$cart_price = number_format($cart_price, 2, '.', '');

				$cart_tax = $woocommerce->cart->get_taxes();
				$cart_tax = array_sum($cart_tax);

				$cart_total_price = floatval($cart_price) + floatval($cart_tax);
				$cart_total_price = apply_filters('woo_custom_shipping_dbf_cart_total_price', $cart_total_price);

				$cart_total_height = WB_WooCommerce_Custom_Shipping_Cart_Items::height();
				$cart_total_length = WB_WooCommerce_Custom_Shipping_Cart_Items::length();
				$cart_total_width = WB_WooCommerce_Custom_Shipping_Cart_Items::width();
				$cart_total_weight = WB_WooCommerce_Custom_Shipping_Cart_Items::weight();
				$cart_total_volume = WB_WooCommerce_Custom_Shipping_Cart_Items::volume();

				$pricingSteps_details = $this->pricingSteps();
				$otherSettingsArr_details = $this->otherSettings();

				$set_step_price = 0;
				$starting_step_height = 0;
				$starting_step_length = 0;
				$starting_step_weight = 0;
				$starting_step_width = 0;

				$height_price = 0;
				$length_price = 0;
				$weight_price = 0;
				$width_price = 0;

				$set_height_threshold = 0;
				$set_length_threshold = 0;
				$set_weight_threshold = 0;
				$set_width_threshold = 0;

				foreach($pricingSteps_details as $priceSetUnit) {
					$unit = (string)$priceSetUnit['unit'];
					$step = (float)$priceSetUnit['weight_step'];
					$amount = (float)$priceSetUnit['amount'];

					switch ($unit) {
						case 'height':
							if($set_height_threshold == 0) {
								if($cart_total_height <= $step) {
									if($cart_total_height > $starting_step_height) {
										$height_price = $amount;
									} else {
										$starting_step_height = $step;
									}
								} 
	
								if($step >= $cart_total_height) {
									$set_height_threshold = $step;
								} else if($step < $cart_total_height) {
									$height_price = $amount;
								}
							}
							break;
						case 'length':
							if($set_length_threshold == 0) {
								if($cart_total_length <= $step) {
									if($cart_total_length > $starting_step_length) {
										$length_price = $amount;
									} else {
										$starting_step_length = $step;
									}
								}

								if($step >= $cart_total_length) {
									$set_length_threshold = $step;
								} else if($step < $cart_total_height) {
									$length_price = $amount;
								}
							}
							break;
						case 'weight':
							if($set_weight_threshold == 0) {
								if($cart_total_weight <= $step) {
									if($cart_total_weight > $starting_step_weight) {
										$weight_price = $amount;
									} else {
										$starting_step_weight = $step;
									}
								}

								if($step >= $cart_total_weight) {
									$set_weight_threshold = $step;
								} else if($step < $cart_total_height) {
									$weight_price = $amount;
								}
							}
							break;
						case 'width':
							if($set_width_threshold == 0) {
								if($cart_total_width <= $step) {
									if($cart_total_width > $starting_step_width) {
										$width_price = $amount;
									} else {
										$starting_step_width = $step;
									}
								}

								if($step >= $cart_total_width) {
									$set_width_threshold = $step;
								} else if($step < $cart_total_height) {
									$width_price = $amount;
								}
							}
							break;
					}
				}

				// Step costs
				$set_step_price = $height_price + $length_price + $weight_price + $width_price;
				
				// Fixed base price costs
				$fixedBasePrice = floatval($otherSettingsArr_details[0][$this->prefix() . '_fixed_price']);
				$fixedBasePriceString = sanitize_text_field($otherSettingsArr_details[0][$this->prefix() . '_fixed_price']);
				
				// Handling costs
				$handlingcosts = floatval($otherSettingsArr_details[0][$this->prefix() . '_handlingcosts']);

				// Distance based fee
				$woo_custom_distance_fee = 0;
			
				$response = sendCustomWooShippingDataToAPI($otherSettingsArr_details);

				$dbf_googleapikey = sanitize_text_field($otherSettingsArr_details[0][$this->prefix() . '_googleapikey']);
				$dbf_divider = sanitize_text_field($otherSettingsArr_details[0][$this->prefix() . '_dbf_divider']);
				$dbf_price = sanitize_text_field($otherSettingsArr_details[0][$this->prefix() . '_dbf_price']);
				$dbf_minimum_distance = sanitize_text_field($otherSettingsArr_details[0][$this->prefix() . '_dbf_minimum_distance']);
				$dbf_maximum_distance = sanitize_text_field($otherSettingsArr_details[0][$this->prefix() . '_dbf_maximum_distance']);
				$dbf_units = sanitize_text_field($otherSettingsArr_details[0][$this->prefix() . '_dbf_units']);

				$date = date("D M j G:i:s T Y");

				if(isset($response['error_message'])) {
					error_log($response['error_message']);
			
					$pluginlog = plugin_dir_path(__FILE__).'../logs/debug.log';
					$message = $date . ': ' . $response['error_message'].PHP_EOL;
					error_log($message, 3, $pluginlog);
				}
			
				if(!isset($response['rows'][0])) {
					$pluginlog = plugin_dir_path(__FILE__).'../logs/debug.log';
					$message = $date . ': ' . json_encode($response) .PHP_EOL;
					error_log($message, 3, $pluginlog);
				}
			
				if(!isset($response['rows'][0]['elements'][0])) {
					$pluginlog = plugin_dir_path(__FILE__).'../logs/debug.log';
					$message = $date . ': ' . json_encode($response) .PHP_EOL;
					error_log($message, 3, $pluginlog);
				}
				
				if(isset($response['rows'][0]) && $response['rows'][0]['elements'][0]['status'] !== 'NOT_FOUND' && $response['rows'][0]['elements'][0]['status'] !== 'ZERO_RESULTS') {
					$meters = $response['rows'][0]['elements'][0]['distance']['value'];
					$kiloMeters = ($meters / 1000);
					$miles = $meters * 0.00062137119224;

					if($dbf_units == 'ml') {
						$setDistance = $miles;
					} else {
						$setDistance = $kiloMeters;
					}

					if($dbf_minimum_distance != '' && (float)$dbf_minimum_distance <= $setDistance) {
						if($otherSettingsArr_details[0][$this->prefix() . '_dbf_disable_fixed_fee'] == 'true') {
							$fixedBasePrice = 0;
						}
					}

					$price = floatval($otherSettingsArr_details[0][$this->prefix() . '_dbf_price']);

					if($price == 0) {
						$woo_custom_distance_fee = 0;
					} else {
						$woo_custom_distance_fee = ($setDistance / $dbf_divider) * $price;
					}
					
					$woo_custom_distance_fee = apply_filters('woo_custom_shipping_dbf_calculated_fee', $woo_custom_distance_fee, $setDistance, $dbf_divider, $price);
				}

				// Shipping class fee
				$shipping_classes = WC()->shipping()->get_shipping_classes();
				$class_amount = 0;

				// Check if products has shipping classes
				$items = $woocommerce->cart->get_cart();
				$shipping_classes_arr = array();
				$shipping_classes_amounts_arr = array();

				foreach($items as $item => $values) { 
					$_product =  wc_get_product( $values['data']->get_id()); 
					$shipping_class = $_product->get_shipping_class(); 

					array_push($shipping_classes_arr, $shipping_class);
				}
				
				if ( ! empty( $shipping_classes ) && ! empty( $shipping_classes_arr )) { 
					if( isset($otherSettingsArr_details[0][$this->prefix() . '_class_calculation_type'])) {
						$class_calculation_type = $otherSettingsArr_details[0][$this->prefix() . '_class_calculation_type'];
					} else {
						$class_calculation_type = 'per_class';
					}
					
					if( isset($otherSettingsArr_details[0][$this->prefix() . '_shipping_classes'])) {
						foreach($otherSettingsArr_details[0][$this->prefix() . '_shipping_classes'] as $shp_class) {
							if(isset($shp_class['slug']) && in_array($shp_class['slug'], $shipping_classes_arr)) {
								array_push($shipping_classes_amounts_arr, $shp_class['amount']);
							}
						}
					}

					if($class_calculation_type == 'per_class') {
						$class_amount = array_sum($shipping_classes_amounts_arr);
					} else {
						if(sizeof($shipping_classes_amounts_arr) > 1) {
							$class_amount = max($shipping_classes_amounts_arr);
						} else {
							if(isset($shipping_classes_amounts_arr[0])) {
								$class_amount = $shipping_classes_amounts_arr[0];
							} else {
								$class_amount = 0;
							}
							
						}
					}
				}

				// Area costs
				$wb_woocommerce_custom_city_fees = (float)$otherSettingsArr_details[0][$this->prefix() . '_areafee'];
				$wb_woocommerce_custom_city_areas = strtolower($otherSettingsArr_details[0][$this->prefix() . '_areafee_cities']);

				if($wb_woocommerce_custom_city_areas != '') {
					$cityArr = array_map('trim', explode(',', $wb_woocommerce_custom_city_areas));

					if(in_array(trim($city), $cityArr)) {
						$cityFee = floatval($wb_woocommerce_custom_city_fees);
					} else {
						$cityFee = 0;
					}
				} else {
					$cityFee = 0;
				}

				// Filters
				$fixedBasePrice = apply_filters('woo_custom_shipping_dbf_fixed_price', $fixedBasePrice, $fixedBasePriceString);
				$handlingcosts = apply_filters('woo_custom_shipping_dbf_handling_costs', $handlingcosts);
				$cityFee = apply_filters('woo_custom_shipping_dbf_area_fee', $cityFee);
				$class_amount = apply_filters('woo_custom_shipping_dbf_class_amount', $class_amount);

				$total_shipping_cost = floatval($set_step_price) + floatval($fixedBasePrice) + floatval($handlingcosts) + floatval($cityFee) + floatval($woo_custom_distance_fee) + floatval($class_amount);

				// Free shipping
				$free_shipping = floatval($otherSettingsArr_details[0][$this->prefix() . '_free_shipping']);

				// Free shipping filter
				$free_shipping = apply_filters('woo_custom_shipping_dbf_free_shipping', $free_shipping, $fixedBasePriceString);

				if($free_shipping != '' && $cart_total_price >= $free_shipping) {
					$total_shipping_cost = 0;
				}

				// Coupon
				$has_coupon = false;
				$all_coupons = array();
				$given_code = $otherSettingsArr_details[0][$this->prefix() . '_couponcode'];
				$given_code_array_or_not = false;

				$allow_all_coupons = $otherSettingsArr_details[0][$this->prefix() . '_all_coupons'];

				if ( $coupons = WC()->cart->get_coupons() ) {
					if($allow_all_coupons == 'kylla') {
						foreach ( $coupons as $coupon ) {
							if ( $coupon->get_free_shipping() ) {
								$has_coupon = true;
							}
						}
					} else {
						if (strpos($given_code, ',') != false) {
						 	$given_code_array_or_not = true;
						} else {
						 	$given_code_array_or_not = false;
						}

						foreach ( $coupons as $code => $coupon ) { 
							array_push($all_coupons, $code);
						}

						if($given_code_array_or_not) {
							$given_codes = explode(",", $given_code);

							foreach( $given_codes as $set_code) {
								if(isset($coupon) && $coupon->is_valid() && in_array($set_code, $all_coupons)) {
									$has_coupon = true;
								}
							}
						} else {
							if(isset($coupon) && $coupon->is_valid() && in_array($given_code, $all_coupons)) {
								$has_coupon = true;
							}
						}

					}
				}
				
				$taxable = $otherSettingsArr_details[0][$this->prefix() . '_taxable'];

				if($taxable == 'no') {
					$setTaxes = false;
				} else {
					$setTaxes = '';
				}

				if($has_coupon) {
					$total_shipping_cost = 0;
				}

				$total_shipping_cost = apply_filters('woo_custom_shipping_dbf_total_shipping_cost', $total_shipping_cost);

				$rate = apply_filters('wb_woocommerce_custom_rate_filter', array(
					'id' => $this->id . $this->instance_id,
					'label' => $this->title,
					'cost' => $total_shipping_cost,
					'package' => $package,
					'taxes'     => $setTaxes,
					'calc_tax' => 'per_order'
				) );

				// Register the rate
				$this->add_rate( $rate );

			}

			/**
			 * Format price
			 * 
			 * @access public
			 * @return boolean 
			 */
			public function formatPriceWebDataCustomShipping($haystack, $replace, $needle) {
				$pos = strpos($haystack, $needle);
			
				if ($pos !== false) {
					$newstring = substr_replace($haystack, $replace, $pos, strlen($needle));
				} else {
					$newstring = $haystack;
				}
			
				return $newstring;
			}

			/**
			 * Get chosen shipping method
			 * 
			 * @access  public
			 * @return  string
			 */
			public static function checkChosenMethod() {
				$chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
				$chosen_method = $chosen_methods[0];

				$chosen_method = preg_replace('/[0-9:]+/', '', $chosen_method);

				return $chosen_method;
			}
		}
	}
}

add_action( 'woocommerce_shipping_init', 'WB_Custom_WooCommerce_Shipping_Method_Init' );

function add_WB_Custom_WooCommerce_Shipping_Method( $methods ) {

	$methods['WB_Custom_WooCommerce_Shipping_Method'] = 'WB_Custom_WooCommerce_Shipping_Method';
	return $methods;

}

add_filter( 'woocommerce_shipping_methods', 'add_WB_Custom_WooCommerce_Shipping_Method' );

/**
* Hide_show_wb_woocommerce_custom_shipping function.
*
* @access public
* @return void
*/
function hide_show_wb_woocommerce_custom_shipping( $rates, $package ) {
	$woocommerce = function_exists('WC') ? WC() : $GLOBALS['woocommerce'];
	$shippingIds = array();
	$country     = WC()->countries->countries[ WC()->customer->get_shipping_country() ];
	$city        = strtolower(WC()->customer->get_shipping_city());

	if(isset($rates)) {
		$get_the_id = null;
		$prefix = 'wb_custom_shipping_method';

		$length = WB_WooCommerce_Custom_Shipping_Cart_Items::length();
		$width = WB_WooCommerce_Custom_Shipping_Cart_Items::width();
		$height = WB_WooCommerce_Custom_Shipping_Cart_Items::height();
		$weight = WB_WooCommerce_Custom_Shipping_Cart_Items::weight();

		$total_weight = $woocommerce->cart->cart_contents_weight;

		// Get all shipping methods in use
		foreach ( $rates as $rate_id => $rate ) {
			array_push($shippingIds, $rate->id);
		}

		// Get the instance id
		foreach ($shippingIds as $shipping_id) {
			$hide = false;

			if (strpos($shipping_id, 'WB_Custom_WooCommerce_Shipping_Method') !== false) {
				$get_the_id = str_replace('WB_Custom_WooCommerce_Shipping_Method', '', $shipping_id);
				$get_the_id = str_replace(':', '', $get_the_id);

				$wb_custom_shipping_woocommerce_shipping_method = new WB_Custom_WooCommerce_Shipping_Method( $instance_id = $get_the_id );
				$otherSettingsArr_details = $wb_custom_shipping_woocommerce_shipping_method->otherSettings();

				// Distance based fee
				$dbf_googleapikey = sanitize_text_field($otherSettingsArr_details[0][$prefix . '_googleapikey']);
				$dbf_divider = sanitize_text_field($otherSettingsArr_details[0][$prefix . '_dbf_divider']);
				$dbf_price = sanitize_text_field($otherSettingsArr_details[0][$prefix . '_dbf_price']);
				$dbf_minimum_distance = sanitize_text_field($otherSettingsArr_details[0][$prefix . '_dbf_minimum_distance']);
				$dbf_maximum_distance = sanitize_text_field($otherSettingsArr_details[0][$prefix . '_dbf_maximum_distance']);
				$dbf_units = sanitize_text_field($otherSettingsArr_details[0][$prefix . '_dbf_units']);
			
				$response = sendCustomWooShippingDataToAPI($otherSettingsArr_details);

				$date = date("D M j G:i:s T Y");

				if(isset($response['error_message'])) {
					error_log($response['error_message']);
			
					$pluginlog = plugin_dir_path(__FILE__).'../logs/debug.log';
					$message = $date . ': ' . $response['error_message'].PHP_EOL;
					error_log($message, 3, $pluginlog);
				}
			
				if(!isset($response['rows'][0])) {
					$pluginlog = plugin_dir_path(__FILE__).'../logs/debug.log';
					$message = $date . ': ' . json_encode($response) .PHP_EOL;
					error_log($message, 3, $pluginlog);
				}
			
				if(!isset($response['rows'][0]['elements'][0])) {
					$pluginlog = plugin_dir_path(__FILE__).'../logs/debug.log';
					$message = $date . ': ' . json_encode($response) .PHP_EOL;
					error_log($message, 3, $pluginlog);
				}
				
				if(isset($response['rows'][0]) && $response['rows'][0]['elements'][0]['status'] !== 'NOT_FOUND' && $response['rows'][0]['elements'][0]['status'] !== 'ZERO_RESULTS') {
					$meters = $response['rows'][0]['elements'][0]['distance']['value'];
					$kiloMeters = ($meters / 1000);
					$miles = $meters * 0.00062137119224;

					if($dbf_units == 'ml') {
						$setDistance = $miles;
					} else {
						$setDistance = $kiloMeters;
					}
			
					if($dbf_minimum_distance != '' && (float)$dbf_minimum_distance >= $setDistance) {
						if($otherSettingsArr_details[0][$prefix . '_dbf_limit_hiding'] == 'true') {
							$hide = true;
						}
					}
			
					if($dbf_maximum_distance != '' && (float)$dbf_maximum_distance <= $setDistance) { 
						if($otherSettingsArr_details[0][$prefix . '_dbf_limit_hiding'] == 'true') {
							$hide = true;
						}
					}
					
				} else {
					if($otherSettingsArr_details[0][$prefix . '_dbf_destination_hiding'] == 'true') {
						$hide = true;
					}
				}

				if(isset($otherSettingsArr_details[0][$prefix . '_area_based_hiding']) && isset($otherSettingsArr_details[0][$prefix . '_areafee_cities'])) {
					$areaBasedHiding = $otherSettingsArr_details[0][$prefix . '_area_based_hiding'];

					if($areaBasedHiding == 'yes') {
						$wb_woocommerce_custom_city_areas = strtolower($otherSettingsArr_details[0][$prefix . '_areafee_cities']);

						if($wb_woocommerce_custom_city_areas != '') {
							$cityArr = array_map('trim', explode(',', $wb_woocommerce_custom_city_areas));

							if(!in_array(trim($city), $cityArr)) {
								$hide = true;
							}
						}
					}
				}

				if(isset($otherSettingsArr_details[0][$prefix . '_availability']) && isset($otherSettingsArr_details[0][$prefix . '_chosen_countries'])) { 
					$availability = $otherSettingsArr_details[0][$prefix . '_availability'];
					$chosenCountries = $otherSettingsArr_details[0][$prefix . '_chosen_countries'];

					if($availability == 'chosen') {
						if(!in_array($country, $chosenCountries)) {
							$hide = true;
						}
					}

					if($availability == 'not_chosen') {
						if(in_array($country, $chosenCountries)) {
							$hide = true;
						}
					}
				}

				$max_weight = $otherSettingsArr_details[0][$prefix . '_max_weight'];
				$max_length = $otherSettingsArr_details[0][$prefix . '_max_length'];
				$max_height = $otherSettingsArr_details[0][$prefix . '_max_height'];
				$max_width = $otherSettingsArr_details[0][$prefix . '_max_width'];

				if($height == null OR $height == '') {
					$height = 0;
				}

				if($length == null OR $length == '') {
					$length = 0;
				}

				if($width == null OR $width == '') {
					$width = 0;
				}

				if($weight == null OR $weight == '') {
					$weight = 0;
				}

				if($total_weight == null OR $total_weight == '') {
					$total_weight = 0;
				}

				if ( $hide OR floatval($height) > floatval($max_height) OR floatval($length) > floatval($max_length) OR floatval($width) > floatval($max_width) OR floatval($weight) > floatval($max_weight) OR floatval($total_weight) > floatval($max_weight)) {
					unset($rates[$shipping_id]);
				}
			}
		}
	}

	return $rates;

}

add_filter( 'woocommerce_package_rates', 'hide_show_wb_woocommerce_custom_shipping' , 10, 2 );

/**
 * Send data to Google API
 * 
 * @access public
 * @return JSON 
 */
function sendCustomWooShippingDataToAPI($otherSettingsArr_details) {
	$prefix = 'wb_custom_shipping_method';

	$dbf_googleapikey = sanitize_text_field($otherSettingsArr_details[0][$prefix . '_googleapikey']);
	$dbf_divider = sanitize_text_field($otherSettingsArr_details[0][$prefix . '_dbf_divider']);
	$dbf_price = sanitize_text_field($otherSettingsArr_details[0][$prefix . '_dbf_price']);
	$dbf_minimum_distance = sanitize_text_field($otherSettingsArr_details[0][$prefix . '_dbf_minimum_distance']);
	$dbf_maximum_distance = sanitize_text_field($otherSettingsArr_details[0][$prefix . '_dbf_maximum_distance']);
	$dbf_units = sanitize_text_field($otherSettingsArr_details[0][$prefix . '_dbf_units']);
	$dbf_to_address = sanitize_text_field($otherSettingsArr_details[0][$prefix . '_dbf_to_address']);
	$dbf_origin_address = sanitize_text_field($otherSettingsArr_details[0][$prefix . '_dbf_origin_address']);
	$dbf_origin_zip = sanitize_text_field($otherSettingsArr_details[0][$prefix . '_dbf_origin_zip']);
	$dbf_origin_city = sanitize_text_field($otherSettingsArr_details[0][$prefix . '_dbf_origin_city']);

	$origin_city = sanitize_text_field(get_option('woocommerce_store_city'));
	$origin_address = sanitize_text_field(get_option('woocommerce_store_address'));
	$origin_postcode = sanitize_text_field(get_option('woocommerce_store_postcode'));

	$date = date("D M j G:i:s T Y");

	if($dbf_origin_address != '') {
		$origin_address = $dbf_origin_address;
	}

	if($dbf_origin_zip != '') {
		$origin_postcode = $dbf_origin_zip;
	}

	if($dbf_origin_city != '') {
		$origin_city = $dbf_origin_city;
	}

	$origin_city = apply_filters( 'woo_custom_shipping_dbf_origin_city_filter', $origin_city);
	$origin_postcode = apply_filters( 'woo_custom_shipping_dbf_origin_zip_filter', $origin_postcode);
	$origin_address = apply_filters( 'woo_custom_shipping_dbf_origin_address_filter', $origin_address);

	if(!file_exists(plugin_dir_path(__FILE__).'../logs/')) {
		mkdir(plugin_dir_path(__FILE__).'../logs/');
	}

	if(!file_exists(plugin_dir_path(__FILE__).'../logs/debug.log')) {
		$log_file = fopen(plugin_dir_path(__FILE__).'../logs/debug.log', 'w');
		fwrite($log_file, '');
		fclose($log_file);
	}

	if($dbf_to_address == 'billing') {
		$destination_city = WC()->customer->get_billing_city();
		$destination_address = WC()->customer->get_billing_address();
		$destination_postcode = WC()->customer->get_billing_postcode();
	} else {
		$destination_city = WC()->customer->get_shipping_city();
		$destination_address = WC()->customer->get_shipping_address();
		$destination_postcode = WC()->customer->get_shipping_postcode();
	}

	$destination_city = apply_filters( 'woo_custom_shipping_dbf_destination_city_filter', $destination_city);
	$destination_address = apply_filters( 'woo_custom_shipping_dbf_destination_address_filter', $destination_address);
	$destination_postcode = apply_filters( 'woo_custom_shipping_dbf_destination_postcode_filter', $destination_postcode);

	if($dbf_units == 'ml') {
		$setUnits = '&units=imperial';
	} else {
		$setUnits = '&units=metric';
	}
	
	$origin = urlencode($origin_address . ',' . $origin_postcode . ' ' .$origin_city);
	$destination = urlencode($destination_address . ',' . $destination_postcode . ' ' . $destination_city);

	if($destination_address != '' && $destination_city != '' && $dbf_googleapikey != '' && $dbf_googleapikey != null && $origin_city != '' && $origin_city != null && $origin_postcode != '' && $origin_postcode != null && $origin_address != '' && $origin_address != null) {				
		$header = array();
		$header[] = 'Content-length: 0';
		$header[] = 'Content-type: application/json';
																													
		$service_url = 'https://maps.googleapis.com/maps/api/distancematrix/json?mode=driving&language=en-GB' . $setUnits . '&origins=' . $origin . '&destinations=' . $destination . '&key=' . $dbf_googleapikey;

		$response = wp_remote_get($service_url);
		$body = wp_remote_retrieve_body( $response );
		$bodyDecoded = json_decode($body, true);

		return $bodyDecoded;
	}

	return false;
}