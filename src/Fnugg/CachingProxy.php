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

use Dekode\Fnugg\HttpClientInterface;

/**
 * Proxy for HttpClient implements caching.
 *
 * @package Dekode\Fnugg
 * @since 0.0.0
 */
class CachingProxy implements HttpClientInterface {

	/**
	 * Constructor.
	 *
	 * @return void
	 */
	public function __construct( HttpClientInterface $client ) {
		$this->client = $client;
	}

	/**
	 * Perform data caching via transients
	 *
	 * @param array $uri URI.
	 *
	 * @return string Body of the response.
	 */
	public function getRemoteBody( string $uri ): string {

		$transient = hash( 'sha256', $uri );
		$content   = get_transient( $transient );

		if ( ! empty( $content ) ) {
			return $content;
		}

		$content = $this->client->getRemoteBody( $uri );

		set_transient( $transient, $content, MINUTE_IN_SECONDS );

		return $content;
	}
}
