<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wordpress.org/plugins/kankoz-facebook-group-promoter
 * @since      1.0.0
 *
 * @package    Kankoz_Fg_Promoter
 * @subpackage Kankoz_Fg_Promoter/admin
 */
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Kankoz_Fg_Promoter
 * @subpackage Kankoz_Fg_Promoter/admin
 * @author     Jamiu Oloyede <oloyedejamiu@gmail.com>
 */
class Kankoz_Fg_Promoter_Admin
{
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private  $plugin_name ;
    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private  $version ;
    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version )
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }
    
    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Kankoz_Fg_Promoter_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Kankoz_Fg_Promoter_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_style(
            $this->plugin_name,
            plugin_dir_url( __FILE__ ) . 'css/kankoz-fg-promoter-admin.css',
            array(),
            $this->version,
            'all'
        );
    }
    
    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Kankoz_Fg_Promoter_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Kankoz_Fg_Promoter_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script(
            $this->plugin_name,
            plugin_dir_url( __FILE__ ) . 'js/kankoz-fg-promoter-admin.js',
            array( 'jquery' ),
            $this->version,
            false
        );
    }
    
    /**
     * Add settings action link to the plugins page.
     *
     * @since    1.0.0
     */
    public function add_action_links( $links )
    {
        /*
         *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
         */
        $kankozfgp_settings_link = array( '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __( 'Settings', $this->plugin_name ) . '</a>' );
        return array_merge( $kankozfgp_settings_link, $links );
    }
    
    public function add_plugin_admin_menu()
    {
        /**
         * add top level menu
         */
        add_menu_page(
            'Facebook Group Promoter',
            'FB Group Promoter',
            'manage_options',
            'kankoz-fg-promoter',
            array( $this, 'display_plugin_setup_page' ),
            'dashicons-groups',
            70.28371780000001
        );
    }
    
    /**
     * Render the settings page for this plugin.
     *
     * @since    1.0.0
     */
    public function display_plugin_setup_page()
    {
        // check user capabilities
        if ( !current_user_can( 'manage_options' ) ) {
            return;
        }
        include_once 'partials/kankoz-fg-promoter-admin-display.php';
    }
    
    /**
     * custom option and settings
     */
    public function kankozfgp_settings_init()
    {
        // register a new setting for "$this->plugin_name" page
        register_setting( 'kankoz-fg-promoter', 'kankozfgp_option_name' );
        // register new sections in the "kankoz-fg-promoter" page
        add_settings_section(
            'kankozfgp_section_basic',
            __( 'Basic Settings', 'kankoz-fg-promoter' ),
            array( $this, 'kankozfgp_section_basic_cb' ),
            'kankoz-fg-promoter'
        );
        add_settings_section(
            'kankozfgp_section_display',
            __( 'Display Settings', 'kankoz-fg-promoter' ),
            array( $this, 'kankozfgp_section_display_cb' ),
            'kankoz-fg-promoter'
        );
        add_settings_field(
            'enable',
            __( 'Enable', 'kankoz-fg-promoter' ),
            array( $this, 'kankozfgp_enable_plugin_cb' ),
            'kankoz-fg-promoter',
            'kankozfgp_section_basic',
            [
            'label_for'             => 'enable',
            'class'                 => 'kankozfgp_row',
            'kankozfgp_custom_data' => 'custom',
        ]
        );
        add_settings_field(
            'appid',
            __( 'Facebook App ID', 'kankoz-fg-promoter' ),
            array( $this, 'kankozfgp_appid_plugin_cb' ),
            'kankoz-fg-promoter',
            'kankozfgp_section_basic',
            [
            'label_for'             => 'appid',
            'class'                 => 'kankozfgp_row',
            'kankozfgp_custom_data' => 'custom',
        ]
        );
        add_settings_field(
            'groupurl',
            __( 'Group URL', 'kankoz-fg-promoter' ),
            array( $this, 'kankozfgp_groupurl_plugin_cb' ),
            'kankoz-fg-promoter',
            'kankozfgp_section_basic',
            [
            'label_for'             => 'groupurl',
            'class'                 => 'kankozfgp_row',
            'kankozfgp_custom_data' => 'custom',
        ]
        );
        add_settings_field(
            'banner_width',
            __( 'Width of the Plugin', 'kankoz-fg-promoter' ),
            array( $this, 'kankozfgp_banner_width_cb' ),
            'kankoz-fg-promoter',
            'kankozfgp_section_basic',
            [
            'label_for'             => 'banner_width',
            'class'                 => 'kankozfgp_row',
            'kankozfgp_custom_data' => 'custom',
        ]
        );
        add_settings_field(
            'post_type_display',
            __( 'Post Type Display', 'kankoz-fg-promoter' ),
            array( $this, 'kankozfgp_post_type_display_cb' ),
            'kankoz-fg-promoter',
            'kankozfgp_section_display',
            [
            'label_for'             => 'post_type_display',
            'class'                 => 'kankozfgp_row',
            'kankozfgp_custom_data' => 'custom',
        ]
        );
        add_settings_field(
            'display_position',
            __( 'Display Position', 'kankoz-fg-promoter' ),
            array( $this, 'kankozfgp_display_position_cb' ),
            'kankoz-fg-promoter',
            'kankozfgp_section_display',
            [
            'label_for'             => 'display_position',
            'class'                 => 'kankozfgp_row',
            'kankozfgp_custom_data' => 'custom',
        ]
        );
        add_settings_field(
            'inc_social_context',
            __( 'Include Social Context', 'kankoz-fg-promoter' ),
            array( $this, 'kankozfgp_inc_social_context_cb' ),
            'kankoz-fg-promoter',
            'kankozfgp_section_display',
            [
            'label_for'             => 'inc_social_context',
            'class'                 => 'kankozfgp_row',
            'kankozfgp_custom_data' => 'custom',
        ]
        );
        add_settings_field(
            'inc_metadata',
            __( 'Include Metadata', 'kankoz-fg-promoter' ),
            array( $this, 'kankozfgp_inc_metadata_cb' ),
            'kankoz-fg-promoter',
            'kankozfgp_section_display',
            [
            'label_for'             => 'inc_metadata',
            'class'                 => 'kankozfgp_row',
            'kankozfgp_custom_data' => 'custom',
        ]
        );
        add_settings_field(
            'change_theme_color',
            __( 'Set Theme Color:', 'kankoz-fg-promoter' ),
            array( $this, 'kankozfgp_change_theme_color_cb' ),
            'kankoz-fg-promoter',
            'kankozfgp_section_display',
            [
            'label_for'             => 'change_theme_color',
            'class'                 => 'kankozfgp_row',
            'kankozfgp_custom_data' => 'custom',
        ]
        );
    }
    
    public function kankozfgp_section_basic_cb( $args )
    {
        ?>
		
		<hr>
	<?php 
    }
    
    public function kankozfgp_section_display_cb( $args )
    {
        ?>
		
		<hr>
	<?php 
    }
    
    public function kankozfgp_enable_plugin_cb( $args )
    {
        $kankozfgp_options_global = get_option( 'kankozfgp_option_name' );
        ?>
		<input type="checkbox" id="<?php 
        echo  esc_attr( $args['label_for'] ) ;
        ?>" 
	    data-custom="<?php 
        echo  esc_attr( $args['kankozfgp_custom_data'] ) ;
        ?>"
	    name="kankozfgp_option_name[<?php 
        echo  esc_attr( $args['label_for'] ) ;
        ?>]"
	     
	    value="1"<?php 
        echo  ( isset( $kankozfgp_options_global[$args['label_for']] ) ? checked( '1', $kankozfgp_options_global[$args['label_for']] ) : '' ) ;
        ?>>	    
	    </input>
	    <p class="description">
	        <?php 
        esc_html_e( 'Please tick this to enable the plugin', $this->plugin_name );
        ?>
	    </p> 
	    <?php 
    }
    
    public function kankozfgp_appid_plugin_cb( $args )
    {
        $kankozfgp_options_global = get_option( 'kankozfgp_option_name' );
        ?>
    <input type="text" id="<?php 
        echo  esc_attr( $args['label_for'] ) ;
        ?>" 
    data-custom="<?php 
        echo  esc_attr( $args['kankozfgp_custom_data'] ) ;
        ?>"
    name="kankozfgp_option_name[<?php 
        echo  esc_attr( $args['label_for'] ) ;
        ?>]" 
    value="<?php 
        echo  ( isset( $kankozfgp_options_global[$args['label_for']] ) ? esc_attr( $kankozfgp_options_global[$args['label_for']] ) : '' ) ;
        ?>">
    
    </input>
    <p class="description">
        <?php 
        esc_html_e( 'Please enter your facebook app ID. It\'s compulsory. You can create one from ', $this->plugin_name );
        ?><a href="https://developers.facebook.com/apps"><?php 
        esc_html_e( 'here', $this->plugin_name );
        ?></a>        
    </p>      
    <?php 
    }
    
    public function kankozfgp_groupurl_plugin_cb( $args )
    {
        $kankozfgp_options_global = get_option( 'kankozfgp_option_name' );
        ?>
    <input type="text" id="<?php 
        echo  esc_attr( $args['label_for'] ) ;
        ?>" class="regular-text" 
    data-custom="<?php 
        echo  esc_attr( $args['kankozfgp_custom_data'] ) ;
        ?>"
    name="kankozfgp_option_name[<?php 
        echo  esc_attr( $args['label_for'] ) ;
        ?>]" 
    value="<?php 
        echo  ( isset( $kankozfgp_options_global[$args['label_for']] ) ? esc_attr( $kankozfgp_options_global[$args['label_for']] ) : '' ) ;
        ?>">
    
    </input>      

    <p class="description">
        <?php 
        esc_html_e( 'Please enter your facebook group URL. It must start with https:// e.g. https://web.facebook.com/groups/461636247644138/', $this->plugin_name );
        ?>     
    </p>     
    <?php 
    }
    
    public function kankozfgp_banner_width_cb( $args )
    {
        $kankozfgp_options_global = get_option( 'kankozfgp_option_name' );
        ?>
	    <input type="text" id="<?php 
        echo  esc_attr( $args['label_for'] ) ;
        ?>" 
	    data-custom="<?php 
        echo  esc_attr( $args['kankozfgp_custom_data'] ) ;
        ?>"
	    name="kankozfgp_option_name[<?php 
        echo  esc_attr( $args['label_for'] ) ;
        ?>]" 
	    value="<?php 
        echo  ( isset( $kankozfgp_options_global[$args['label_for']] ) ? esc_attr( $kankozfgp_options_global[$args['label_for']] ) : '' ) ;
        ?>">
	    
	    </input>
	    <p class="description">
	        <?php 
        esc_html_e( 'Set the plugin width in pixels. Minimum is 180, default is 280, maximum is 500.', $this->plugin_name );
        ?>        

	    </p>      
    <?php 
    }
    
    public function kankozfgp_post_type_display_cb( $args )
    {
        $kankozfgp_options_global = get_option( 'kankozfgp_option_name' );
        ?>

	<select id="<?php 
        echo  esc_attr( $args['label_for'] ) ;
        ?>"
	 data-custom="<?php 
        echo  esc_attr( $args['kankozfgp_custom_data'] ) ;
        ?>"
	 name="kankozfgp_option_name[<?php 
        echo  esc_attr( $args['label_for'] ) ;
        ?>]"
	 >
	 <option value ="">--Please select an item-- </option> 
	 <option value="posts" <?php 
        echo  ( isset( $kankozfgp_options_global[$args['label_for']] ) ? selected( $kankozfgp_options_global[$args['label_for']], 'posts', false ) : '' ) ;
        ?>>
	 <?php 
        esc_html_e( 'Posts', $this->plugin_name );
        ?>
	 </option>
	 <option value="pages" <?php 
        echo  ( isset( $kankozfgp_options_global[$args['label_for']] ) ? selected( $kankozfgp_options_global[$args['label_for']], 'pages', false ) : '' ) ;
        ?>>
	 <?php 
        esc_html_e( 'Pages', $this->plugin_name );
        ?>
	 </option>
	 </select>
	 <p class="description">
	 <?php 
        esc_html_e( 'Please choose a criteria to display plugin either in posts or pages', $this->plugin_name );
        ?>
	 </p>
    <?php 
    }
    
    public function kankozfgp_display_position_cb( $args )
    {
        $kankozfgp_options_global = get_option( 'kankozfgp_option_name' );
        ?>

	<select id="<?php 
        echo  esc_attr( $args['label_for'] ) ;
        ?>"
	 data-custom="<?php 
        echo  esc_attr( $args['kankozfgp_custom_data'] ) ;
        ?>"
	 name="kankozfgp_option_name[<?php 
        echo  esc_attr( $args['label_for'] ) ;
        ?>]"
	 >
	 <option value ="">--Please select an item-- </option> 
	 <option value="belowcontent" <?php 
        echo  ( isset( $kankozfgp_options_global[$args['label_for']] ) ? selected( $kankozfgp_options_global[$args['label_for']], 'belowcontent', false ) : '' ) ;
        ?>>
	 <?php 
        esc_html_e( 'Below Content', $this->plugin_name );
        ?>
	 </option>
	 <option value="abovecontent" <?php 
        echo  ( isset( $kankozfgp_options_global[$args['label_for']] ) ? selected( $kankozfgp_options_global[$args['label_for']], 'abovecontent', false ) : '' ) ;
        ?>>
	 <?php 
        esc_html_e( 'Above Content', $this->plugin_name );
        ?>
	 </option>
	 <option value="belowabovecontent" <?php 
        echo  ( isset( $kankozfgp_options_global[$args['label_for']] ) ? selected( $kankozfgp_options_global[$args['label_for']], 'belowabovecontent', false ) : '' ) ;
        ?>>
	 <?php 
        esc_html_e( 'Below & Above Content ', $this->plugin_name );
        ?>
	 </option>
	 </select>
	 <p class="description">
	 <?php 
        esc_html_e( 'Please choose a criteria to display the banner below content, above content or in both', $this->plugin_name );
        ?>
	 </p>
    <?php 
    }
    
    public function kankozfgp_inc_social_context_cb( $args )
    {
        $kankozfgp_options_global = get_option( 'kankozfgp_option_name' );
        ?>
		
		<input type="checkbox" id="<?php 
        echo  esc_attr( $args['label_for'] ) ;
        ?>" 
	    data-custom="<?php 
        echo  esc_attr( $args['kankozfgp_custom_data'] ) ;
        ?>"
	    name="kankozfgp_option_name[<?php 
        echo  esc_attr( $args['label_for'] ) ;
        ?>]"
	     
	    value="1"<?php 
        echo  ( isset( $kankozfgp_options_global[$args['label_for']] ) ? checked( '1', $kankozfgp_options_global[$args['label_for']] ) : '' ) ;
        ?>>	    
	    </input>
	    <p class="description">
	        <?php 
        esc_html_e( 'Please tick to show the number of friends who are already a member in the group.', $this->plugin_name );
        ?>
	    </p> 
	    <?php 
    }
    
    public function kankozfgp_inc_metadata_cb( $args )
    {
        $kankozfgp_options_global = get_option( 'kankozfgp_option_name' );
        ?>
		<input type="checkbox" id="<?php 
        echo  esc_attr( $args['label_for'] ) ;
        ?>" 
	    data-custom="<?php 
        echo  esc_attr( $args['kankozfgp_custom_data'] ) ;
        ?>"
	    name="kankozfgp_option_name[<?php 
        echo  esc_attr( $args['label_for'] ) ;
        ?>]"
	     
	    value="1"<?php 
        echo  ( isset( $kankozfgp_options_global[$args['label_for']] ) ? checked( '1', $kankozfgp_options_global[$args['label_for']] ) : '' ) ;
        ?>>	    
	    </input>
	    <p class="description">
	        <?php 
        esc_html_e( 'Please tick to show other metadata about the group. E.g., Description', $this->plugin_name );
        ?>
	    </p> 
	    <?php 
    }
    
    public function kankozfgp_change_theme_color_cb( $args )
    {
        $kankozfgp_options_global = get_option( 'kankozfgp_option_name' );
        ?>
		<input type="checkbox" id="<?php 
        echo  esc_attr( $args['label_for'] ) ;
        ?>" 
	    data-custom="<?php 
        echo  esc_attr( $args['kankozfgp_custom_data'] ) ;
        ?>"
	    name="kankozfgp_option_name[<?php 
        echo  esc_attr( $args['label_for'] ) ;
        ?>]"	     
	    value="1"<?php 
        echo  ( isset( $kankozfgp_options_global[$args['label_for']] ) ? checked( '1', $kankozfgp_options_global[$args['label_for']] ) : '' ) ;
        ?>>	    
	    </input>
	    <p class="description">
	        <?php 
        esc_html_e( 'Please tick this to darken the plugin content color. Only light & dark colors are allowed for now.', $this->plugin_name );
        ?>
	    </p> 

	    <?php 
    }

}