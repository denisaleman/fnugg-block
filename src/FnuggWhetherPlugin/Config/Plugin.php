<?php
/**
 * Gutenberg Fnugg Whether Block
 *
 * @package   Dekode\FnuggWhetherPlugin\Config\Plugin
 * @author    Denis Fedorov <barmaglot7@gmail.com>
 * @copyright 2022
 * @license   MIT
 * @link      https://www.upwork.com/freelancers/~01ad0e773956a34ffd
 */

declare( strict_types = 1 );

namespace Dekode\FnuggWhetherPlugin\Config;

use Dekode\FnuggWhetherPlugin\Common\Traits\Singleton;

/**
 * Plugin data which are used through the plugin, most of them are defined
 * by the root file meta data. The data is being inserted in each class
 * that extends the Base abstract class
 *
 * @see Base
 * @package Dekode\FnuggWhetherPlugin\Config
 * @since 0.0.0
 */
final class Plugin {
	/**
	 * Singleton trait
	 */
	use Singleton;

	/**
	 * Get the plugin meta data from the root file and include own data
	 *
	 * @return array
	 * @since 0.0.0
	 */
	public function data(): array {
		$plugin_data = apply_filters( 'dekode_fnugg_plugin_data', [
			'settings'               => get_option( 'the-plugin-name-settings' ),
			'plugin_path'            => untrailingslashit(
				plugin_dir_path( DEKODE_FNUGG_PLUGIN_FILE )  // phpcs:disable ImportDetection.Imports.RequireImports.Symbol -- this constant is global
			),
			'plugin_blocks_folder'   => 'assets/blocks',
			/**
			 * Add extra data here
			 */
		] );
		return array_merge(
			apply_filters( 'dekode_fnugg_plugin_metadata',
				get_file_data( DEKODE_FNUGG_PLUGIN_FILE, // phpcs:disable ImportDetection.Imports.RequireImports.Symbol -- this constant is global
					[
						'name'         => 'Plugin Name',
						'uri'          => 'Plugin URI',
						'description'  => 'Description',
						'version'      => 'Version',
						'author'       => 'Author',
						'author-uri'   => 'Author URI',
						'text-domain'  => 'Text Domain',
						'domain-path'  => 'Domain Path',
						'required-php' => 'Requires PHP',
						'required-wp'  => 'Requires WP',
						'namespace'    => 'Namespace',
					], 'plugin'
				)
			), $plugin_data
		);
	}

	/**
	 * Get the plugin path
	 *
	 * @return string
	 * @since 0.0.0
	 */
	public function pluginPath(): string {
		return $this->data()['plugin_path'];
	}

	/**
	 * Get the plugin Gutenberg blocks path
	 *
	 * @return string
	 * @since 0.0.0
	 */
	public function blocksPath(): string {
		return $this->data()['plugin_path'] . '/' . $this->data()['plugin_blocks_folder'];
	}

	/**
	 * Get the plugin Gutenberg blocks folder name
	 *
	 * @return string
	 * @since 0.0.0
	 */
	public function blocksFolder(): string {
		return $this->data()['plugin_blocks_folder'];
	}

	/**
	 * Get the plugin version number
	 *
	 * @return string
	 * @since 0.0.0
	 */
	public function version(): string {
		return $this->data()['version'];
	}

	/**
	 * Get the required minimum PHP version
	 *
	 * @return string
	 * @since 0.0.0
	 */
	public function requiredPhp(): string {
		return $this->data()['required-php'];
	}

	/**
	 * Get the required minimum WP version
	 *
	 * @return string
	 * @since 0.0.0
	 */
	public function requiredWp(): string {
		return $this->data()['required-wp'];
	}

	/**
	 * Get the plugin name
	 *
	 * @return string
	 * @since 0.0.0
	 */
	public function name(): string {
		return $this->data()['name'];
	}

	/**
	 * Get the plugin url
	 *
	 * @return string
	 * @since 0.0.0
	 */
	public function uri(): string {
		return $this->data()['uri'];
	}

	/**
	 * Get the plugin description
	 *
	 * @return string
	 * @since 0.0.0
	 */
	public function description(): string {
		return $this->data()['description'];
	}

	/**
	 * Get the plugin author
	 *
	 * @return string
	 * @since 0.0.0
	 */
	public function author(): string {
		return $this->data()['author'];
	}

	/**
	 * Get the plugin author uri
	 *
	 * @return string
	 * @since 0.0.0
	 */
	public function authorUri(): string {
		return $this->data()['author-uri'];
	}

	/**
	 * Get the plugin text domain
	 *
	 * @return string
	 * @since 0.0.0
	 */
	public function textDomain(): string {
		return $this->data()['text-domain'];
	}

	/**
	 * Get the plugin domain path
	 *
	 * @return string
	 * @since 0.0.0
	 */
	public function domainPath(): string {
		return $this->data()['domain-path'];
	}

	/**
	 * Get the plugin namespace
	 *
	 * @return string
	 * @since 0.0.0
	 */
	public function namespace(): string {
		return $this->data()['namespace'];
	}
}
