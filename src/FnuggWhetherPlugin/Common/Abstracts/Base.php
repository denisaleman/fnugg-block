<?php
/**
 * Gutenberg Fnugg Whether Block
 *
 * @package   Dekode\FnuggWhetherPlugin\Common\Abstracts\Base
 * @author    Denis Fedorov <barmaglot7@gmail.com>
 * @copyright 2022
 * @license   MIT
 * @link      https://www.upwork.com/freelancers/~01ad0e773956a34ffd
 */

declare( strict_types = 1 );

namespace Dekode\FnuggWhetherPlugin\Common\Abstracts;

use Dekode\FnuggWhetherPlugin\Config\Plugin;

/**
 * The Base class which can be extended by other classes to load in default methods
 *
 * @package Dekode\FnuggWhetherPlugin\Common\Abstracts
 * @since 0.0.0
 */
abstract class Base {
	/**
	 * @var array : will be filled with data from the plugin config class
	 * @see Plugin
	 */
	protected $plugin = [];

	/**
	 * Base constructor.
	 *
	 * @since 0.0.0
	 */
	public function __construct() {
		$this->plugin = Plugin::init();
	}
}
