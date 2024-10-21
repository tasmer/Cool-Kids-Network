<?php
/**
 * Class Rest API.
 *
 * @package CoolKidsNetwork
 */

/**
 * Class register Rest API.
 * Handles the registration of REST API routes and endpoints for user role
 * management.
 */
class CKN_Rest_API {

	use CKN_Singleton;

	/**
	 * Initialise the classe.
	 *
	 * @return void
	 */
	protected function init() {
		add_action( 'rest_api_init', array( $this, 'rest_api_init' ) );
	}

	/**
	 * Register the REST API route for editing user roles.
	 *
	 * @return void
	 */
	public function rest_api_init() {
		register_rest_route( 'cool-kids-network/v1',
			'/user/edit_role/',
			array(
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => array( $this, 'edit_role' ),
				'permission_callback' => array(
					$this,
					'edit_role_permission_callback',
				),
			) );
	}

	/**
	 * Permission callback for editing user roles.
	 * Ensures that only users with `edit_users` capability can modify roles.
	 *
	 * @return bool
	 */
	public function edit_role_permission_callback() {
		return current_user_can( 'edit_users' );
	}

	/**
	 * Endpoint callback to update the role of a user.
	 * This method identifies the user either by email or by first name and
	 * last name. Validates the new role before updating it.
	 *
	 * @param \WP_REST_Request $request The rest request object.
	 *
	 * @return \WP_Error|\WP_REST_Response
	 */
	public function edit_role( WP_REST_Request $request ) {
		$email      = $request->get_param( sanitize_email( 'email' ) );
		$first_name = $request->get_param( sanitize_text_field( 'first_name' ) );
		$last_name  = $request->get_param( sanitize_text_field( 'last_name' ) );
		$new_role   = $request->get_param( sanitize_text_field( 'new_role' ) );

		// Define valid roles.
		$valid_roles = array( 'cool_kid', 'cooler_kid', 'coolest_kid' );
		// Check the given role with de valid roles.
		if ( ! in_array( $new_role, $valid_roles, true ) ) {
			return new WP_Error(
				'invalid_role',
				__( 'Invalid role.', 'cool-kids-network' ),
				array( 'status' => 400 )
			);
		}

		// Check if email is provided.
		if ( $email ) {
			if ( ! is_email( $email ) ) {
				return new WP_Error(
					'invalid_email',
					__( 'Invalid email address.', 'cool-kids-network' ),
					array( 'status' => 400 )
				);
			}
			$user = get_user_by( 'email', $email );

			if ( ! $user ) {
				return new WP_Error( 'user_not_found', __( 'User not found.', 'cool-kids-network' ), array( 'status' => 404 ) );
			}
			// Check if first name and last name are provided.
		} elseif ( $first_name && $last_name ) {
			$users = get_users( array(
				'meta_query' => array(
					array(
						'key'   => 'first_name',
						'value' => $first_name,
					),
					array(
						'key'   => 'last_name',
						'value' => $last_name,
					),
				),
			) );

			if ( empty( $users ) ) {
				return new WP_Error(
					'user_not_found',
					'User with first name and last name not found.',
					array( 'status' => 404 )
				);
			}

			// Retrieve the first element in case there is more thant one.
			$user = $users[0];

		} else {
			return new WP_Error(
				'missing_param', 'Please provide a valid email address or first name and last name.',
				array( 'status' => 400 )
			);
		}

		// Set the new role for the user.
		$user->set_role( $new_role );

		return new WP_REST_Response( array(
			'status'   => 'success',
			'message'  => 'User role updated successfully.',
			'new_role' => $new_role,
		), 200 );
	}

}