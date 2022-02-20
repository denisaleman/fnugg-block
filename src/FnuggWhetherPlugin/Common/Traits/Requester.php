<?php
/**
 * Gutenberg Fnugg Whether Block
 *
 * @package   Dekode\FnuggWhetherPlugin\Common\Traits\Requester
 * @author    Denis Fedorov <barmaglot7@gmail.com>
 * @copyright 2022
 * @license   MIT
 * @link      https://www.upwork.com/freelancers/~01ad0e773956a34ffd
 */

declare( strict_types = 1 );

namespace Dekode\FnuggWhetherPlugin\Common\Traits;

use Dekode\FnuggWhetherPlugin\Common\Utils\Errors;

/**
 * The requester trait to determine what we request; used to determine
 * which classes we instantiate in the Bootstrap class
 *
 * @see Bootstrap
 *
 * @package Dekode\FnuggWhetherPlugin\Common\Traits
 * @since 0.0.0
 */
trait Requester {

	/**
	 * What type of request is this?
	 *
	 * @param string $type admin, cron, cli, amp or frontend.
	 * @return bool
	 * @since 0.0.0
	 */
	public function request( string $type ): bool {
		switch ( $type ) {
			case 'installing_wp':
				return $this->isInstallingWp();
			case 'frontend':
				return $this->isFrontend();
			case 'backend':
				return $this->isAdminBackend();
			case 'rest':
				return $this->isRest();
			case 'cron':
				return $this->isCron();
			case 'cli':
				return $this->isCli();
			default:
				Errors::wpDie(
					sprintf( /* translators: %s: request function */
						__( 'Unknown request type: %s', 'gutenberg-fnugg-whether-block' ),
						$type
					),
					__( 'Classes are not being correctly requested', 'gutenberg-fnugg-whether-block' ),
					__FILE__
				);
				return false;
		}
	}

	/**
	 * Is installing WP
	 *
	 * @return bool
	 * @since 0.0.0
	 */
	public function isInstallingWp(): bool {
		return defined( 'WP_INSTALLING' );
	}

	/**
	 * Is frontend
	 *
	 * @return bool
	 * @since 0.0.0
	 */
	public function isFrontend(): bool {
		return ! $this->isAdminBackend() && ! $this->isCron() && ! $this->isRest();
	}

	/**
	 * Is admin
	 *
	 * @return bool
	 * @since 0.0.0
	 */
	public function isAdminBackend(): bool {
		return is_user_logged_in() && is_admin();
	}

	/**
	 * Is rest
	 *
	 * @return bool
	 * @since 0.0.0
	 */
	public function isRest(): bool {
		return defined( 'REST_REQUEST' );
	}

	/**
	 * Is cron
	 *
	 * @return bool
	 * @since 0.0.0
	 */
	public function isCron(): bool {
		return ( function_exists( 'wp_doing_cron' ) && wp_doing_cron() ) || defined( 'DOING_CRON' );
	}

	/**
	 * Is cli
	 *
	 * @return bool
	 * @since 0.0.0
	 */
	public function isCli(): bool {
		return defined( 'WP_CLI' ) && WP_CLI; // phpcs:disable ImportDetection.Imports.RequireImports.Symbol -- this constant is global
	}
}
