<?php
namespace WpnoncesWrapperLibrary;

/**
 * Class Nonce. Custom class wrapping core WordPress nonces related functions.
 *
 * @package WpnoncesWrapperLibrary
 */
class Nonce {
	/**
	 * Creates a cryptographic token tied to a specific action, user, user session, and window of time.
	 * https://codex.wordpress.org/Function_Reference/wp_create_nonce
	 *
	 * @param string|int $action Scalar value to add context to the nonce.
	 * @return string The token.
	 */
	public function generate( $action = -1 ) {
		return wp_create_nonce( $action );
	}

	/**
	 * Verify that correct nonce was used with time limit.
	 * https://codex.wordpress.org/Function_Reference/wp_nonce_url
	 *
	 * @param string     $actionurl URL to add nonce action.
	 * @param int|string $action    Optional. Nonce action name. Default -1.
	 * @param string     $name      Optional. Nonce name. Default '_wpnonce'.
	 * @return string Escaped URL with nonce action added.
	 */
	public function generate_url( $actionurl = null, $action = -1, $name = '_wpnonce' ) {
		return wp_nonce_url( $actionurl, $action, $name );
	}

	/**
	 * Verify that correct nonce was used with time limit.
	 * https://codex.wordpress.org/Function_Reference/wp_verify_nonce
	 *
	 * @param string     $nonce  Nonce that was used in the form to verify
	 * @param string|int $action Should give context to what is taking place and be the same when nonce was created.
	 * @return false|int False if the nonce is invalid, 1 if the nonce is valid and generated between
	 *                   0-12 hours ago, 2 if the nonce is valid and generated between 12-24 hours ago.
	 */
	public function verify( $nonce = null, $action = -1 ) {
		return wp_verify_nonce( $nonce, $action );
	}

	/**
	 * Retrieve or display nonce hidden field for forms.
	 * https://codex.wordpress.org/Function_Reference/wp_nonce_field
	 *
	 * @param int|string $action  Optional. Action name. Default -1.
	 * @param string     $name    Optional. Nonce name. Default '_wpnonce'.
	 * @param bool       $referer Optional. Whether to set the referer field for validation. Default true.
	 * @param bool       $echo    Optional. Whether to display or return hidden form field. Default true.
	 * @return string Nonce field HTML markup.
	 */
	public function field( $action = -1, $name = '_wpnonce', $referer = true, $echo = true ) {
		return wp_nonce_field( $action, $name, $referer, $echo );
	}

	/**
	 * Display "Are You Sure" message to confirm the action being taken.
	 * https://codex.wordpress.org/Function_Reference/wp_nonce_ays
	 *
	 * @param string $action The nonce action.
	 */
	public function display_ays( $action = null ) {
		return wp_nonce_ays( $action );
	}

	/**
	 * Makes sure that a user was referred from another admin page.
	 * https://codex.wordpress.org/Function_Reference/check_admin_referer
	 *
	 * @param int|string $action    Action nonce.
	 * @param string     $query_arg Optional. Key to check for nonce in `$_REQUEST` (since 2.5).
	 *                              Default '_wpnonce'.
	 * @return false|int False if the nonce is invalid, 1 if the nonce is valid and generated between
	 *                   0-12 hours ago, 2 if the nonce is valid and generated between 12-24 hours ago.
	 */
	public function check_admin_referer( $action = -1, $query_arg = '_wpnonce' ) {
		return check_admin_referer( $action, $query_arg );
	}

	/**
	 * Verifies the Ajax request to prevent processing requests external of the blog.
	 * https://codex.wordpress.org/Function_Reference/check_ajax_referer
	 *
	 * @param int|string   $action    Action nonce.
	 * @param false|string $query_arg Optional. Key to check for the nonce in `$_REQUEST` (since 2.5). If false,
	 *                                `$_REQUEST` values will be evaluated for '_ajax_nonce', and '_wpnonce'
	 *                                (in that order). Default false.
	 * @param bool         $die       Optional. Whether to die early when the nonce cannot be verified.
	 *                                Default true.
	 * @return false|int False if the nonce is invalid, 1 if the nonce is valid and generated between
	 *                   0-12 hours ago, 2 if the nonce is valid and generated between 12-24 hours ago.
	 */
	public function check_ajax_referer( $action = -1, $query_arg = false, $die = true ) {
		return check_ajax_referer( $action, $query_arg, $die );
	}

}
