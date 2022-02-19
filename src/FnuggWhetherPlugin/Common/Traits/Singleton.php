<?php
/**
 * Gutenberg Fnugg Whether Block
 *
 * @package   Dekode\FnuggWhetherPlugin\Common\Traits\Singleton
 * @author    Denis Fedorov <barmaglot7@gmail.com>
 * @copyright 2022
 * @license   MIT
 * @link      https://www.upwork.com/freelancers/~01ad0e773956a34ffd
 */

declare( strict_types = 1 );

namespace Dekode\FnuggWhetherPlugin\Common\Traits;

/**
 * The singleton skeleton trait to instantiate the class only once
 *
 * @package Dekode\FnuggWhetherPlugin\Common\Traits
 * @since 0.0.0
 */
trait Singleton {
	private static $instance;

	final private function __construct() {
	}

	final private function __clone() {
	}

	final private function __wakeup() {
	}

	/**
	 * @return self
	 * @since 0.0.0
	 */
	final public static function init(): self {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}
