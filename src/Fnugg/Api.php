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
 * Fnugg API Class.
 *
 * @package Dekode\Fnugg
 * @since 0.0.0
 */
class Api {

	/**
	 * Constructor.
	 *
	 * @return void
	 */
	public function __construct( HttpClientInterface $client ) {
		$this->endpoints = [
			'search'               => 'https://api.fnugg.no/search',
			'suggest-autocomplete' => 'https://api.fnugg.no/suggest/autocomplete',
		];
		$this->client = $client;
	}

	/**
	 * Fetch suggestions to autocomplete a partial query for a name of ski resort.
	 *
	 * @param array $query Partial query.
	 *
	 * @return array Collection of suggestions.
	 */
	public function suggestAutocomplete( $query ): array {
		$uri    = add_query_arg( $query, $this->endpoints['suggest-autocomplete'] );
		$result = json_decode( $this->client->getRemoteBody( $uri ), true ) ?? [];

		return $result;
	}

	/**
	 * Fetch ski resort details.
	 *
	 * @param array $query Ski resort name.
	 *
	 * @return array Ski resort details.
	 */
	public function search( $query ): array {
		$uri    = add_query_arg( $query, $this->endpoints['search'] );
		$result = json_decode( $this->client->getRemoteBody( $uri ), true ) ?? [];

		return $result;
	}
}
