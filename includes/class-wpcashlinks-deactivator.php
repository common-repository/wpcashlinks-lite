<?php

/**
 * Fired during plugin deactivation
 *
 * @since      1.0.0
 * @package    wpcashlinks
 * @subpackage wpcashlinks/includes
 * @author     WPCashLinks <info@wpcashlinks.com>
 */
 
class WPCashLinks_Deactivator {

	/**
	 *
	 * Plugin deactivation
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {

        // Remove settings from options table
        delete_option( 'wpcl_options' );

	}

}
