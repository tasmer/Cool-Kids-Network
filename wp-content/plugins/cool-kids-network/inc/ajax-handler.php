<?php
/**
 * TODO file description.
 */


add_action( 'wp_ajax_register_user', 'handler_register_user' );
add_action( 'wp_ajax_nopriv_register_user', 'handler_register_user' );

/**
 * @return void
 */
function handler_register_user() {

	$email = isset($_POST['email'])? sanitize_email( $_POST['email'] ): '';

	if( empty( $email ) ) {
		wp_send_json_error(array( 'message'=> 'Invalid email'));
	}

	$data = CKN_Registrer_User::create_new_user( $email );

	if( is_wp_error( $data ) ) {
		wp_send_json_error(array( 'message'=> $data->get_error_message()));
	}

	wp_send_json_success(array( 'status'=> 'user created'));
}