=== WebData Custom Shipping Methods for WooCommerce ===
Contributors: webdata
Tags: woocommerce, plugin, custom fee, distance, google, matrix, api, shipping
Requires at least: 4.0
Tested up to: 5.7
Stable tag: 1.3.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Create different types of logics for your shipping based on various options.

<a target="_blank" href="https://web-data.online/docs/webdata-custom-shipping-methods-for-woocommerce">Installation instructions here.</a>

Logics can be created based on:
- Weight
- Height
- Width
- Length
- Distance (Uses Google's Distance Matrix API)
- Destination city
- Shipping class
- Coupons
- Fixed price

Distance based shipping allows you to use different logics, based on minimum and maximum distance. If the conditions are not met you can also disable the shipping method.
See the plugin instructions to set up the distance based shipping.

== Installation ==

Installing "WooCommerce distance based fee" can be done either by searching for "WooCommerce distance based fee" via the "Plugins > Add New" screen in your WordPress dashboard, or by using the following steps:

1. Download the plugin via WordPress.org
2. Upload the ZIP file through the 'Plugins > Add New > Upload' screen in your WordPress dashboard
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Adjust settings at: Settings - Distance based fee settings

== Frequently Asked Questions ==

= I can not see distance based fee on my checkout =

1) Google has changed their policy, and now you need to have a billing account enabled, in order to use their API. More info: <a href="https://console.cloud.google.com/project/_/billing/enable" target="_blank">https://console.cloud.google.com/project/_/billing/enable</a> 

2) Check your plugin settings, you need to have enabled atleast one shipping method for the fee.

3) Check error log for possible errors. You can find the log at the plugin settings page on "Logs" tab.

4) Choose one of the WooCommerce shipping methods at WooCommerce - Shipping and save any of the shipping methods settings once to clear the cache.

5) Make sure you have entered your store location correctly on WooCommerce settings, and Google can locate it through Google Maps. 

6) Make sure you have enabled correct API. Try to enable the following APIs: Distance Matrix API, Places API for Web, Google Maps Geocoding API

7) Try to generate new API key and do NOT choose restricted mode.

8) If you still have issues, contact through the <a href="https://wordpress.org/support/plugin/woo-distance-based-fee/">Support forum</a>.

= I can not see any shipping methods  =

Check the limits you have setup to the plugin settings. Dimensions should be entered in the same unit of measurement as set in WooCommerce! If you are using centimeters, then the thresholds should also be in centimeters!

Also check if you have chosen to hide the method if distance cannot be found by the distance based shipping option.

== Changelog ==
= 1.3.7 =
* PHP8 & WC5 check

= 1.3.6 =
* Added argument for woo_custom_shipping_dbf_free_shipping filter

= 1.3.5 =
* Added more filters, see docs at web-data.online for more info

= 1.3.3 =
* City based hiding options
* Bug fixes

= 1.3.2 =
* Added support for Google API status: ZERO_RESULTS

= 1.3.1 =
* Minor code fixes

= 1.3 =
* Added option to disable fixed price if minimum distance is reached
* Minor code fixes

= 1.2.2 =
* Cart price fix
* Minor bug fixes

= 1.2.1 =
* Type casting fix

= 1.2 =
* Hiding function improved

= 1.1.4 =
* Better mileage support

= 1.1.3 =
* Mode changed to default for Matrix API

= 1.1.2 =
* Bug fixes

= 1.1.1 =
* No Google API calls if destination is empty

= 1.1 =
* WP 5.4 check

= 1.0 =
* Initial release