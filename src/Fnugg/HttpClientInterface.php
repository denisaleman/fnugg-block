<?php
/**
 * Gutenberg Fnugg Whether Block
 *
 * @package   Dekode\Fnugg
 * @author    Denis Fedorov <barmaglot7@gmail.com>
 * @copyright 2022
 * @license   MIT
 * @link      https://www.upwork.com/freelancers/~01ad0e773956a34ffd
 */

declare( strict_types = 1 );

namespace Dekode\Fnugg;

/**
 * HTTP Client Interface.
 *
 * @package Dekode\Fnugg
 * @since 0.0.0
 */
interface HttpClientInterface {
	public function getRemoteBody( string $uri ): string;
}
