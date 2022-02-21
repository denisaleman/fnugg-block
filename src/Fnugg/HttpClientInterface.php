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
 * HTTP Client Class sends request.
 *
 * @package Dekode\Fnugg
 * @since 0.0.0
 */
interface HttpClientInterface {

	/**
	 * Performs HTTP request with GET method and returns its body.
	 *
	 * @param array $uri URI.
	 *
	 * @return HttpClient self.
	 */
	public function get( string $uri ): HttpClient {

		$this->response = wp_remote_get( $uri );

		return $this;
	}
}
