<?php
/**
 * Gutenberg Fnugg Whether Block
 *
 * @package   Dekode\FnuggWhetherPlugin\Config\I18n
 * @author    Denis Fedorov <barmaglot7@gmail.com>
 * @copyright 2022
 * @license   MIT
 * @link      https://www.upwork.com/freelancers/~01ad0e773956a34ffd
 */

declare( strict_types = 1 );

namespace Dekode\FnuggWhetherPlugin\Config;

use Dekode\FnuggWhetherPlugin\Common\Abstracts\Base;

/**
 * Internationalization and localization definitions
 *
 * @package Dekode\FnuggWhetherPlugin\Config
 * @since 0.0.0
 */
final class I18n extends Base {
	/**
	 * Load the plugin text domain for translation
	 * @docs https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/#loading-text-domain
	 *
	 * @since 0.0.0
	 */
	public function load() {
		load_plugin_textdomain(
			$this->plugin->textDomain(),
			false,
			dirname( plugin_basename( DEKODE_FNUGG_PLUGIN_FILE ) ) . '/languages' // phpcs:disable ImportDetection.Imports.RequireImports.Symbol -- this constant is global
		);
	}
}
