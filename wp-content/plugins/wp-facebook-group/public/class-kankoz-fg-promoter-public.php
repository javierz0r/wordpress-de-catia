<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://wordpress.org/plugins/kankoz-facebook-group-promoter
 * @since      1.0.0
 *
 * @package    Kankoz_Fg_Promoter
 * @subpackage Kankoz_Fg_Promoter/public
 */
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Kankoz_Fg_Promoter
 * @subpackage Kankoz_Fg_Promoter/public
 * @author     Jamiu Oloyede <oloyedejamiu@gmail.com>
 */
class Kankoz_Fg_Promoter_Public
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
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version )
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }
    
    /**
     * Register the stylesheets for the public-facing side of the site.
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
            plugin_dir_url( __FILE__ ) . 'css/kankoz-fg-promoter-public.css',
            array(),
            $this->version,
            'all'
        );
    }
    
    /**
     * Register the JavaScript for the public-facing side of the site.
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
            plugin_dir_url( __FILE__ ) . 'js/kankoz-fg-promoter-public.js',
            array( 'jquery' ),
            $this->version,
            false
        );
    }
    
    /**
     * Add Group SDK code inside the head
     *
     * @since    1.0.0
     */
    public function kankozfgp_head_scripts()
    {
        $kankozfgp_options_global = get_option( 'kankozfgp_option_name' );
        $kankozfgp_enable = $kankozfgp_options_global['enable'];
        $kankozfgp_appid = $kankozfgp_options_global['appid'];
        $kankozfgp_groupurl = $kankozfgp_options_global['groupurl'];
        
        if ( isset( $kankozfgp_enable ) && !empty($kankozfgp_appid) && !empty($kankozfgp_groupurl) ) {
            ?>

		<!-- Load Facebook SDK for JavaScript -->
    	<div id="fb-root"></div>	    
	    <script>
	        (function(d, s, id) {
	            var js, fjs = d.getElementsByTagName(s)[0];
	            if (d.getElementById(id)) return;
	            js = d.createElement(s);
	            js.id = id;
	            js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.11&appId=<?php 
            echo  $kankozfgp_appid ;
            ?>&autoLogAppEvents=1';
	            fjs.parentNode.insertBefore(js, fjs);
	        }(document, 'script', 'facebook-jssdk'));
	    </script>
	    
	    <?php 
        }
    
    }
    
    public function kankozfgp_post_type_display_html( $content )
    {
        $kankozfgp_options_global = get_option( 'kankozfgp_option_name' );
        $kankozfgp_enable = esc_attr( $kankozfgp_options_global['enable'] );
        $kankozfgp_appid = esc_attr( $kankozfgp_options_global['appid'] );
        $kankozfgp_groupurl = esc_attr( $kankozfgp_options_global['groupurl'] );
        $kankozfgp_post_type_display = esc_attr( $kankozfgp_options_global['post_type_display'] );
        $kankozfgp_display_position = esc_attr( $kankozfgp_options_global['display_position'] );
        $kankozfgp_inc_metadata = ( isset( $kankozfgp_options_global['inc_metadata'] ) ? true : false );
        $kankozfgp_inc_social_context = ( isset( $kankozfgp_options_global['inc_social_context'] ) ? true : false );
        $kankozfgp_banner_width = esc_attr( $kankozfgp_options_global['banner_width'] );
        $kankozfgp_change_theme_color = ( isset( $kankozfgp_options_global['change_theme_color'] ) ? true : false );
        // test for social context
        
        if ( !empty($kankozfgp_inc_social_context) && isset( $kankozfgp_inc_social_context ) ) {
            $kankozfgp_inc_social_context = "true";
        } else {
            $kankozfgp_inc_social_context = "false";
        }
        
        // test for social context
        
        if ( !empty($kankozfgp_inc_metadata) && isset( $kankozfgp_inc_metadata ) ) {
            $kankozfgp_inc_metadata = "true";
        } else {
            $kankozfgp_inc_metadata = "false";
        }
        
        
        if ( empty($kankozfgp_banner_width) ) {
            $kankozfgp_banner_width = 280;
        } else {
            $kankozfgp_banner_width = esc_attr( $kankozfgp_banner_width );
        }
        
        // test for skin color
        
        if ( !empty($kankozfgp_change_theme_color) && isset( $kankozfgp_change_theme_color ) ) {
            $kankozfgp_change_theme_color = "dark";
        } else {
            $kankozfgp_change_theme_color = "light";
        }
        
        if ( $kankozfgp_post_type_display == "posts" && is_singular( 'post' ) ) {
            
            if ( $kankozfgp_display_position === "belowcontent" ) {
                // test for below content
                ?>

				<!--Your Group Plugin for the Web code-->
				<?php 
                $kankozfgp_box = '';
                $kankozfgp_box .= '<div style="text-align:center;">
						<div class="fb-group" 
				    	         data-href="' . $kankozfgp_groupurl . '" 
				    	         data-width="' . $kankozfgp_banner_width . '" 
				    	         data-show-social-context="' . $kankozfgp_inc_social_context . '" 
				    	         data-show-metadata="' . $kankozfgp_inc_metadata . '"
				    	         data-skin="' . $kankozfgp_change_theme_color . '"
				    	         >
				    	</div>
				    	</div>';
                return $content . $kankozfgp_box;
            } elseif ( $kankozfgp_display_position === "abovecontent" ) {
                // test for above content
                ?>

				<!--Your Group Plugin for the Web code-->
				<?php 
                $kankozfgp_box = '';
                $kankozfgp_box .= '<div style="text-align:center; margin-bottom: 20px">
						<div class="fb-group" 
				    	         data-href="' . $kankozfgp_groupurl . '" 
				    	         data-width="' . $kankozfgp_banner_width . '" 
				    	         data-show-social-context="' . $kankozfgp_inc_social_context . '" 
				    	         data-show-metadata="' . $kankozfgp_inc_metadata . '"
				    	         data-skin="' . $kankozfgp_change_theme_color . '"
				    	         >
				    	</div>
				    	</div>';
                return $kankozfgp_box . $content;
            } elseif ( $kankozfgp_display_position === "belowabovecontent" ) {
                // test for below & above content
                ?>

				<!--Your Group Plugin for the Web code-->
				<?php 
                $kankozfgp_box = '';
                $kankozfgp_box .= '<div style="text-align:center; margin-bottom: 20px">
						<div class="fb-group" 
				    	         data-href="' . $kankozfgp_groupurl . '" 
				    	         data-width="' . $kankozfgp_banner_width . '" 
				    	         data-show-social-context="' . $kankozfgp_inc_social_context . '" 
				    	         data-show-metadata="' . $kankozfgp_inc_metadata . '"
				    	         data-skin="' . $kankozfgp_change_theme_color . '"
				    	         >
				    	</div>
				    	</div>';
                return $kankozfgp_box . $content . $kankozfgp_box;
            }
        
        }
        
        if ( $kankozfgp_post_type_display == "pages" && is_page() && is_singular( 'page' ) ) {
            
            if ( $kankozfgp_display_position === "belowcontent" ) {
                // test for below content
                ?>

				<!--Your Group Plugin for the Web code-->
				<?php 
                $kankozfgp_box = '';
                $kankozfgp_box .= '<div style="text-align:center;">
						<div class="fb-group" 
				    	         data-href="' . $kankozfgp_groupurl . '" 
				    	         data-width="' . $kankozfgp_banner_width . '" 
				    	         data-show-social-context="' . $kankozfgp_inc_social_context . '" 
				    	         data-show-metadata="' . $kankozfgp_inc_metadata . '"
				    	         data-skin="' . $kankozfgp_change_theme_color . '"
				    	         >
				    	</div>
				    	</div>';
                return $content . $kankozfgp_box;
            } elseif ( $kankozfgp_display_position === "abovecontent" ) {
                // test for above content
                ?>

				<!--Your Group Plugin for the Web code-->
				<?php 
                $kankozfgp_box = '';
                $kankozfgp_box .= '<div style="text-align:center; margin-bottom: 20px">
						<div class="fb-group" 
				    	         data-href="' . $kankozfgp_groupurl . '" 
				    	         data-width="' . $kankozfgp_banner_width . '" 
				    	         data-show-social-context="' . $kankozfgp_inc_social_context . '" 
				    	         data-show-metadata="' . $kankozfgp_inc_metadata . '"
				    	         data-skin="' . $kankozfgp_change_theme_color . '"
				    	         >
				    	</div>
				    	</div>';
                return $kankozfgp_box . $content;
            } elseif ( $kankozfgp_display_position === "belowabovecontent" ) {
                // test for below & above content
                ?>

				<!--Your Group Plugin for the Web code-->
				<?php 
                $kankozfgp_box = '';
                $kankozfgp_box .= '<div style="text-align:center; margin-bottom: 20px">
						<div class="fb-group" 
				    	         data-href="' . $kankozfgp_groupurl . '" 
				    	         data-width="' . $kankozfgp_banner_width . '" 
				    	         data-show-social-context="' . $kankozfgp_inc_social_context . '" 
				    	         data-show-metadata="' . $kankozfgp_inc_metadata . '"
				    	         data-skin="' . $kankozfgp_change_theme_color . '"
				    	         >
				    	</div>
				    	</div>';
                return $kankozfgp_box . $content . $kankozfgp_box;
            }
        
        } else {
            return $content;
        }
    
    }

}