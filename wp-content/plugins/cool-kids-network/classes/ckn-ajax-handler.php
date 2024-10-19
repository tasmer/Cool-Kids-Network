<?php
/**
 * Class ajax handler.
 *
 * @package CoolKidsNetwork
 */

/**
 * Class Ajax Handler.
 */
class CKN_Ajax_Handler {

	use CKN_Singleton;

	/**
	 * Initialise hook.
	 *
	 * @return void
	 */
	protected function init() {
		add_action( 'wp_ajax_register_user', array( $this, 'register_user' ) );
		add_action( 'wp_ajax_nopriv_register_user', array( $this, 'register_user' ) );

		add_action( 'wp_ajax_list_user_info', array( $this, 'get_users_info' ) );
		add_action( 'wp_ajax_nopriv_list_user_info', array( $this, 'get_users_info' ) );
	}

	/**
	 * Register user from ajax request.
	 *
	 * @return void
	 */
	public function register_user() {
		if ( ! isset( $_POST['security_cool_kid'] ) ||
		     ! wp_verify_nonce( $_POST['security_cool_kid'], 'register_cool_kid' ) ) {
			wp_send_json_error( array( 'message' => __( 'Something went wrong.' ) ) );
		}

		$email = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';

		if ( empty( $email ) ) {
			wp_send_json_error( array( 'message' => 'Invalid email' ) );
		}

		$data = CKN_Registrer_User::create_new_user( $email );

		if ( is_wp_error( $data ) ) {
			wp_send_json_error( array( 'message' => $data->get_error_message() ) );
		}

		wp_send_json_success( array( 'message' => 'user created' ) );
	}

	/**
	 * Retrieve list user and send a json response.
	 *
	 * @return void
	 */
	public function get_users_info() {
		// Check if user is connected.
		if ( ! is_user_logged_in() ) {
			wp_send_json_error( array( 'message' => __( 'You must be logged in to view information' ) ) );
		}

		if ( ! current_user_can( 'cooler_kid' ) && ! current_user_can( 'coolest_kid' ) ) {
			wp_send_json_error( array( 'message' => 'You do not have permission to view this information' ) );
		}

		$users_data  = array();
		$user_fields = array( 'Name', 'Country', );

		$users = get_users( array(
			'role__in' => array(
				'cooler_kid',
				'coolest_kid',
				'cool_kid',
			),
		) );

		foreach ( $users as $user ) {
			$users_data[] = array(
				'name'    => $user->first_name . " " . $user->last_name,
				'country' => get_user_meta( $user->ID, 'country', true ),
			);
		}

		wp_send_json_success( array(
			'users'  => $users_data,
			'fields' => $user_fields,
		) );
	}
}