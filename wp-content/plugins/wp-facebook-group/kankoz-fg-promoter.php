<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wordpress.org/plugins/wp-facebook-group
 * @since             1.0.0
 * @package           Kankoz_Fg_Promoter
 *
 * @wordpress-plugin
 * Plugin Name:       WP Facebook Group Promoter
 * Plugin URI:        https://kankoz.com/product/wp-facebook-group-promoter-pro/
 * Description:       This Facebook Group Plugin lets people join your Facebook group from a link on your web page, widget or via shortcode.
 * Version:           1.0.5
 * Author:            Jamiu Oloyede
 * Author URI:        https://wordpress.org/plugins/wp-facebook-group
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       kankoz-fg-promoter
 * Domain Path:       /languages
 *
 *
 */
// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
    die;
}

if ( !function_exists( 'wfg_fs' ) ) {
    // Create a helper function for easy SDK access.
    function wfg_fs()
    {
        global  $wfg_fs ;
        
        if ( !isset( $wfg_fs ) ) {
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $wfg_fs = fs_dynamic_init( array(
                'id'              => '2366',
                'slug'            => 'kankoz-fg-promoter',
                'type'            => 'plugin',
                'public_key'      => 'pk_6df94c156827d01c09aabe5631010',
                'is_premium'      => false,
                'has_addons'      => false,
                'has_paid_plans'  => true,
                'trial'           => array(
                'days'               => 7,
                'is_require_payment' => true,
            ),
                'has_affiliation' => 'selected',
                'menu'            => array(
                'slug'    => 'kankoz-fg-promoter',
                'support' => false,
            ),
                'is_live'         => true,
            ) );
        }
        
        return $wfg_fs;
    }
    
    // Init Freemius.
    wfg_fs();
    // Signal that SDK was initiated.
    do_action( 'wfg_fs_loaded' );
    /**
     * The code that runs during plugin activation.
     * This action is documented in includes/class-kankoz-fg-promoter-activator.php
     */
    function activate_kankoz_fg_promoter()
    {
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-kankoz-fg-promoter-activator.php';
        Kankoz_Fg_Promoter_Activator::activate();
    }
    
    /**
     * The code that runs during plugin deactivation.
     * This action is documented in includes/class-kankoz-fg-promoter-deactivator.php
     */
    function deactivate_kankoz_fg_promoter()
    {
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-kankoz-fg-promoter-deactivator.php';
        Kankoz_Fg_Promoter_Deactivator::deactivate();
    }
    
    register_activation_hook( __FILE__, 'activate_kankoz_fg_promoter' );
    register_deactivation_hook( __FILE__, 'deactivate_kankoz_fg_promoter' );
    /**
     * The core plugin class that is used to define internationalization,
     * admin-specific hooks, and public-facing site hooks.
     */
    require plugin_dir_path( __FILE__ ) . 'includes/class-kankoz-fg-promoter.php';
    /**
     * Begins execution of the plugin.
     *
     * Since everything within the plugin is registered via hooks,
     * then kicking off the plugin from this point in the file does
     * not affect the page life cycle.
     *
     * @since    1.0.0
     */
    function run_kankoz_fg_promoter()
    {
        $plugin = new Kankoz_Fg_Promoter();
        $plugin->run();
    }
    
    run_kankoz_fg_promoter();
}
