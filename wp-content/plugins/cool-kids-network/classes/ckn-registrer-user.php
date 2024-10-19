<?php
/**
 * Class for register User.
 *
 * @package CoolKidsNetwork
 */

/**
 * Register User with fake data.
 */
class CKN_Registrer_User {

	/**
	 * Create fake user by email.
	 *
	 * @param string $user_email Email to register user.
	 *
	 * @return array|\WP_Error
	 */
	public static function create_new_user( $user_email ) {
		// Check if user existe.
		$user = get_user_by_email( $user_email );

		if ( false !== $user ) {
			return new WP_Error( 'user_exist', __( 'User already exists.', 'cool-kids-network' ) );
		}

		$user_data = self::get_fake_user_data();
		if ( is_wp_error( $user_data ) ) {
			return $user_data;
		}

		$user_id = wp_insert_user( array(
			'user_login' => $user_data['login']['username'],
			'user_email' => $user_email,
			'user_pass'  => 'paswword', // $user_data['login']['password'],
			'first_name' => $user_data['name']['first'],
			'last_name'  => $user_data['name']['last'],
			'role'       => 'cool_kid', // Default role.
			'display'    => $user_data['name']['first'] . ' ' . $user_data['name']['last'],
			'meta_input' => array(
				'country' => $user_data['location']['country'],
			),
		) );

		if ( is_wp_error( $user_id ) ) {
			return new WP_Error( 'failed_to_create_user', __( 'Unable to create user.', 'cool-kids-network' ) );
		}

		return array( 'user_id' => $user_id );
	}

	/**
	 * Retrieve fake user data from Random User.
	 *
	 * @return array|\WP_Error
	 */
	private static function get_fake_user_data() {
		$response = wp_remote_get( 'https://randomuser.me/api/', array(
			'password' => 'upper,lower,special,1-16',
		) );

		if ( wp_remote_retrieve_response_code( $response ) !== 200 ) {
			return new WP_Error( 'fake_data_no_available', __( 'unable to create user.', 'cool-kids-network' ) );
		}
		$response_body = json_decode( wp_remote_retrieve_body( $response ), true );
		$results       = isset( $response_body['results'] ) ? array_shift( $response_body['results'] ) : array();

		return $results ?? array();
	}

}