<?php
/**
 * Plugin Name:     Wisdm Banner
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          YOUR NAME HERE
 * Author URI:      YOUR SITE HERE
 * Text Domain:     wdm-banner
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Wdm_Banner
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( ! defined( 'WDM_PATH' ) ) {
	define( 'WDM_PATH', plugin_dir_path( __FILE__ ) ); // Plugin dir
}

if( ! defined( 'WDM_URL' ) ) {
	define( 'WDM_URL', plugin_dir_url( __FILE__ ) ); // Plugin URL
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package Wisdm Banner
 * @since 1.0
 */
function wdm_load_plugin_text_domain() {

	global $wp_version;

	// Set filter for plugin's languages directory
	$wdm_banner_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
	$wdm_banner_lang_dir = apply_filters( 'wdm_banner_languages_directory', $wdm_banner_lang_dir );

	// Traditional WordPress plugin locale filter.
	$get_locale = get_locale();

	if ( $wp_version >= 4.7 ) {
		$get_locale = get_user_locale();
	}

	// Traditional WordPress plugin locale filter
	$locale = apply_filters( 'plugin_locale',  $get_locale, 'wdm-banner' );
	$mofile = sprintf( '%1$s-%2$s.mo', 'wdm-banner', $locale );

	// Setup paths to current locale file
	$mofile_global  = WP_LANG_DIR . '/plugins/' . basename( WDM_PATH ) . '/' . $mofile;

	if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/plugin-name folder
		load_textdomain( 'wdm-banner', $mofile_global );
	} else { // Load the default language files
		load_plugin_textdomain( 'wdm-banner', false, $wdm_banner_lang_dir );
	}
}

add_action( 'plugins_loaded', 'wdm_load_plugin_text_domain' );

// Include shortcode file
require_once WDM_PATH . 'includes/shortcodes/wdm-banner-shortcode.php';

// Include class setting file
require_once WDM_PATH . 'includes/class-wdm-banner-settings.php';

$settings	= array();
$init		= new Wdm_Banner( $settings );