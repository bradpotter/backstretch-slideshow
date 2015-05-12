<?php
/**
 * Backstretch Slideshow
 *
 * @package           Backstretch_Slideshow
 * @author            Brad Potter
 * @license           GPL-2.0+
 * @link              http://www.bradpotter.com/plugins/backstretch-slideshow
 * @copyright         2015, Brad Potter
 *
 * @wordpress-plugin
 * Plugin Name:       Backstretch Slideshow
 * Plugin URI:        https://github.com/bradpotter/backstretch-slideshow
 * Description:       Creates a Backstretch Slideshow with images uploaded via the Customizer.
 * Version:           0.9.0
 * Author:            Brad Potter
 * Author URI:        http://www.bradpotter.com
 * Text Domain:       stretchshow
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/bradpotter/backstretch-slideshow
 * GitHub Branch:     master
 */

/**
 * If this file is called directly, abort.
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Set constants
 *
 * @since 0.9.0
 */
define( 'BSS_PLUGIN_DIR', dirname( __FILE__ ) );
define( 'BSS_URL' , plugins_url() . '/' . str_replace( basename( __FILE__ ), "" , plugin_basename( __FILE__ ) ) );

/**
 * Initialize Backstretch Slideshow
 *
 * @since 0.9.0
 */
function backstretch_slideshow_init() {

	load_plugin_textdomain( 'backstretch-slideshow', false, basename( dirname( __FILE__ ) ) . '/languages/' );

	require_once( BSS_PLUGIN_DIR . '/backstretch-slideshow-functions.php' );
	require_once( BSS_PLUGIN_DIR . '/backstretch-slideshow-customize.php' );
}
add_action( 'genesis_init', 'backstretch_slideshow_init', 99 );
