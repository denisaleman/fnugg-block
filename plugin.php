<?php

/**
 * Plugin Name:     Gutenberg Fnugg Whether Block
 * Description:     Provides a Gutenberg block presents data from a ski resort using the Fnugg API.
 * Version:         0.0.0
 * Author:          Denis Alemán
 * License:         MIT
 * Text Domain:     gutenberg-fnugg-whether-block
 */

// Silence is golden.
declare( strict_types = 1 );

/**
 * Define the default root file of the plugin
 *
 * @since 0.0.0
 */
const DEKODE_FNUGG_PLUGIN_FILE = __FILE__;

/**
 * Load PSR4 autoloader
 *
 * @since 0.0.0
 */
$dekode_fnugg_autoloader = require plugin_dir_path( DEKODE_FNUGG_PLUGIN_FILE ) . 'vendor/autoload.php';

/**
 * Setup hooks (activation, deactivation, uninstall)
 *
 * @since 0.0.0
 */
register_activation_hook( __FILE__, [ 'DekodeGutenbergBlocks\Config\Setup', 'activation' ] );
register_deactivation_hook( __FILE__, [ 'DekodeGutenbergBlocks\Config\Setup', 'deactivation' ] );
register_uninstall_hook( __FILE__, [ 'DekodeGutenbergBlocks\Config\Setup', 'uninstall' ] );

/**
 * Bootstrap the plugin
 *
 * @since 0.0.0
 */
if ( ! class_exists( 'Dekode\FnuggWhetherPlugin\Bootstrap' ) ) {
	wp_die( __( 'Dekode Gutenberg Blocks is unable to find the Bootstrap class.', 'gutenberg-fnugg-whether-block' ) );
}
add_action(
	'plugins_loaded',
	static function () use ( $dekode_fnugg_autoloader ) {
		/**
		 * @see \Dekode\FnuggWhetherPlugin\Bootstrap
		 */
		try {
			new \Dekode\FnuggWhetherPlugin\Bootstrap( $dekode_fnugg_autoloader );
		} catch ( Exception $e ) {
			wp_die( __( 'Dekode Gutenberg Blocks is unable to run the Bootstrap class.', 'gutenberg-fnugg-whether-block' ) );
		}
	}
);
