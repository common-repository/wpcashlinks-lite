<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @since      1.0.0
 * @package    wpcashlinks
 * @subpackage wpcashlinks/admin
 * @author     WPCashLinks <info@wpcashlinks.com>
 */
 
class WPCashLinks_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since      1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * An instance of this class should be passed to the run() function
		 * defined in WPCashLinks_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WPCashLinks_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wpcashlinks-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * An instance of this class should be passed to the run() function
		 * defined in WPCashLinks_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WPCashLinks_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

        wp_enqueue_script('jquery');
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wpcashlinks-admin.js', array( 'jquery' ), NULL, false );
		wp_enqueue_script( 'jquery-validate', plugin_dir_url( __FILE__ ) . 'js/dist/jquery.validate.min.js', array( 'jquery' ), NULL, false );
		wp_enqueue_script( 'additional-methods', plugin_dir_url( __FILE__ ) . 'js/dist/additional-methods.min.js', array( 'jquery' ), NULL, false );

        // in javascript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
        //wp_enqueue_script( 'wpcashlinks-script' );
		wp_enqueue_script( 'wpcashlinks-localize', plugin_dir_url( __FILE__ ) . 'js/wpcashlinks-localize.js', array( 'jquery' ), NULL, false );
        wp_localize_script( 'wpcashlinks-localize', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
        wp_localize_script('wpcashlinks-localize', 'wpcl_img', array( 'loadingimg' => plugins_url('images/load.gif', __FILE__) ));    
	}

    public function wpcashlinks_admin_menu() {
        add_menu_page( $this->plugin_name, $this->plugin_name, 'administrator', 'wpcashlinks_home', array( $this, 'display_wpcashlinks_page' ), 'dashicons-id-alt' );

        // Create sub menu pages
        add_submenu_page( 'wpcashlinks_home', 'Settings', 'Settings', 'administrator', 'wpcl-settings', array( $this, 'display_settings_page' ) );
        //add_submenu_page( 'wpcashlinks_home', 'Help', 'Help', 'administrator', 'wpcl-help', array( $this, 'display_help_page' ) );
    }
    
    public function display_wpcashlinks_page() {
		require_once ( 'partials/wpcashlinks-admin-display.php' );
    }    

    public function display_settings_page() {
		require_once ( 'partials/wpcashlinks-admin-settings.php' );
    }    

    public function display_help_page() {
		require_once ( 'partials/wpcashlinks-admin-help.php' );
    }    

    function wpcl_save_callback() {

        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . "wpcl_keywords";

        $id = intval($_POST['id']);
        $anchor = sanitize_text_field($_POST['anchor']);
        $url = esc_url($_POST['url']);

        $wpdb->update ( 
            $table_name,
            array( 
                'anchor' => $anchor,
                'url' => $url
            ), 
            array( 'id' => $id ), 
            array( 
                '%s',
                '%s'
            ), 
            array( '%d' ) 
        );

        die(); // this is required to return a proper result
    }

}

