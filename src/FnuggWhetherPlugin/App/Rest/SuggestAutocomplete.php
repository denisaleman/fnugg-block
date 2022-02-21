<?php
/**
 * Gutenberg Fnugg Whether Block
 *
 * @package   Dekode\FnuggWhetherPlugin\App\Rest
 * @author    Denis Fedorov <barmaglot7@gmail.com>
 * @copyright 2022
 * @license   MIT
 * @link      https://www.upwork.com/freelancers/~01ad0e773956a34ffd
 */

declare( strict_types = 1 );

namespace Dekode\FnuggWhetherPlugin\App\Rest;

/**
 * Define `search` rest controller.
 *
 * @package Dekode\FnuggWhetherPlugin\App\Rest
 * @since 0.0.0
 */
class SuggestAutocomplete extends \WP_REST_Controller {

	/**
	 * Constructor.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->namespace = 'fnugg/v1';
		$this->rest_base = 'suggest-autocomplete';
	}

	/**
	 * Initialize class and so provide it as service
	 *
	 * @return void
	 */
	public function init(): void {
		if ( class_exists( 'WP_REST_Server' ) ) {
			add_action( 'rest_api_init', [ $this, 'register_routes' ] );
		}
	}

	/**
	 * Registers the routes for the objects of the controller.
	 *
	 * @see register_rest_route()
	 *
	 * @return void
	 */
	public function register_routes(): void {
		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base,
			[
				[
					'methods'  => 'GET',
					'callback' => [ $this, 'get_items' ],
				],
			]
		);
	}

	/**
	 * Retrieves a collection of search results.
	 *
	 * @param \WP_REST_Request $request Full details about the request.
	 *
	 * @return \WP_REST_Response|\WP_Error Response object on success, or WP_Error object on failure.
	 */
	public function get_items( $request ) {

		$q = $request->get_params();

		$url    = add_query_arg( $q, 'https://api.fnugg.no' . '/suggest/autocomplete/' );
		$result = wp_remote_get( $url );
		$result = wp_remote_retrieve_body( $result );
		$result = json_decode( $result, true );

		if ( empty( $result ) ) {
			return [];
		}

		return $result;
	}
}
