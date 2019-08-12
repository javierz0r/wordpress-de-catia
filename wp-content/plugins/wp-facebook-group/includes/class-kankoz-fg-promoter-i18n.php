<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://wordpress.org/plugins/kankoz-facebook-group-promoter
 * @since      1.0.0
 *
 * @package    Kankoz_Fg_Promoter
 * @subpackage Kankoz_Fg_Promoter/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Kankoz_Fg_Promoter
 * @subpackage Kankoz_Fg_Promoter/includes
 * @author     Jamiu Oloyede <oloyedejamiu@gmail.com>
 */
class Kankoz_Fg_Promoter_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'kankoz-fg-promoter',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
