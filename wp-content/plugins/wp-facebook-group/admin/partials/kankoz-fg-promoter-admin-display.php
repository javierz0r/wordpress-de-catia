<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://wordpress.org/plugins/kankoz-facebook-group-promoter
 * @since      1.0.0
 *
 * @package    Kankoz_Fg_Promoter
 * @subpackage Kankoz_Fg_Promoter/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">
	<h1><?php esc_html_e( 'Facebook Group Promoter Settings', 'kankoz-fg-promoter' ); ?></h1>
    <?php settings_errors(); ?>  

    <h1 class="nav-tab-wrapper">
    <?php
        $my_tabs = array(
            'settings' => __( 'Main Settings', 'kankoz-fg-promoter' ),            
            'email-marketing' => __( 'Email Marketing', 'kankoz-fg-promoter' ),
            'about' => __( 'Help & Docs', 'kankoz-fg-promoter' )
        );
        
        //set current tab
        $my_tab = ( isset($_GET['tab'] ) ? $_GET['tab'] : 'settings' );
    ?>
        <?php foreach( $my_tabs as $key => $value ): ?>
            <a class="nav-tab <?php if( $my_tab == $key ){ echo 'nav-tab-active'; } ?>" href="<?php echo admin_url() ?>?page=kankoz-fg-promoter&tab=<?php echo $key; ?>"><?php echo $value; ?></a>
        <?php endforeach; ?>
    </h1>
    
    <form action="options.php" method="post">
    	<?php            
        // output security fields for the registered setting 
        if( $my_tab == 'settings' ) {
        settings_fields( 'kankoz-fg-promoter' ); 
        // output setting sections and their fields
        // (sections are registered for "kankoz-fg-promoter", each field is registered to a specific section)		
        do_settings_sections( 'kankoz-fg-promoter' );
        // output save settings button
        submit_button( 'Save Settings' ); 
        }
        elseif( $my_tab == 'email-marketing' ) {
            include plugin_dir_path( dirname( __FILE__ ) ) . 'partials/email-marketing/email-marketing.php';
        } else {
            include plugin_dir_path( dirname( __FILE__ ) ) . 'partials/help/help.php';
        
        } // end if/else

        ?>
    </form>     
</div>