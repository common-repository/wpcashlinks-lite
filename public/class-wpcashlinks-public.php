<?php
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @since      1.0.0
 * @package    wpcashlinks
 * @subpackage wpcashlinks/public
 * @author     WPCashLinks <info@wpcashlinks.com>
 * 
 */
 
class WPCashLinks_Public {

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
	 * @since    1.0.0
	 * @param    string    $plugin_name       The name of the plugin.
	 * @param    string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wpcashlinks-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wpcashlinks-public.js', array( 'jquery' ), $this->version, false );

	}


	/**
	 * Embed ad code
	 *
	 * @since    1.0.0
	 */
	public function wpcashlinks_addlinks( $post_content ) {

    	global $post, $wpdb;
        $wpcl_options = get_option('wpcl_options');
        //var_dump($wpcl_options);
        
        if( is_home() && $wpcl_options['showonhomepage'] != 1 )
            return $post_content;

        else if( is_page() && $wpcl_options['showonposts'] != 1 )
            return $post_content;

        else if( is_single() && $wpcl_options['showonposts'] != 1 )
            return $post_content;
        
        else if( is_feed() )
            return $post_content;
            
        if( is_main_query() ) {

            $keywordsPerPost = ( $wpcl_options['numofkeywords'] == 0 ? 999 : $wpcl_options['numofkeywords'] );
            $keywordsrepeat = ( $wpcl_options['keywordsrepeat'] == 0 ? 999 : $wpcl_options['keywordsrepeat'] );
            if( $keywordsPerPost > 5 ) $keywordsPerPost = 5; 

            /* Get the current post ID. */
            $post_id = get_the_ID();
            $checkFlag = 0;
            $replace_counter = 0;

            $keywordLists = $wpdb->get_results("SELECT * FROM `wp_wpcl_keywords`");
            foreach ( $keywordLists as $keywordList ) {

                $anchorString = $keywordList->anchor;
                $urlString = $keywordList->url;

//   		$post_content = preg_replace( '/\b'.$anchorString.'\b/', '<a href="'.$urlString.'" target="_blank">'.$anchorString.'</a>', $post_content);
                if( $wpcl_options['enablenofollow'] == '1' ) {
                    $post_content = preg_replace(  '/(\b'.$anchorString.'\b)(?=[^<>]*(?:<|$))/i', '<a href="'.$urlString.'" rel=nofollow target="_blank">$1</a>', $post_content, $keywordsrepeat, $replace_counter);
                }
                else {
                    $post_content = preg_replace(  '/(\b'.$anchorString.'\b)(?=[^<>]*(?:<|$))/i', '<a href="'.$urlString.'" target="_blank">$1</a>', $post_content, $keywordsrepeat, $replace_counter);
                }

                if( $replace_counter > 0 ) {
                    $checkFlag++;
                    $replace_counter = 0;
                }
                if( $checkFlag >= $keywordsPerPost ) break;
            }
        }
        
        return $post_content;
    }
    
}
