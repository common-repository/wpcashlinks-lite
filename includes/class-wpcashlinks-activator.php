<?php
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    wpcashlinks
 * @subpackage wpcashlinks/includes
 * @author     WPCashLinks <info@wpcashlinks.com>
 */
 
class WPCashLinks_Activator {

	/**
	 * Plugin activation
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
	   
        // Create keyword table
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . "wpcl_keywords";
        $sql = "CREATE TABLE $table_name (
            id BIGINT(10) NOT NULL AUTO_INCREMENT,
            anchor TEXT,
            url TEXT,
            UNIQUE KEY id (id)
        );";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

        $wpcl_options = array (
            'numofkeywords' => 0,
            'keywordsrepeat' => 0,
            'enablenofollow' => 1,
            'showonhomepage' => 0,
            'showonposts' => 1,
            'showonpages' => 0,
        );

        add_option('wpcl_options', $wpcl_options);

	}
}
