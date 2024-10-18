<?php
/**
 * Functions init plugin.
 *
 * @package CoolKidsNetwork
 */

/**
 * Register new roles.
 *
 * @return void
 */
function ckn_add_custom_roles() {
	// Role "Cool Kid"
	add_role( 'cool_kid', 'Cool Kid', array(
			'read' => true,
		) );


	add_role( 'cooler_kid', 'Cooler Kid', array(
			'read'       => true,
			'list_users' => true,
		) );


	add_role( 'coolest_kid', 'Coolest Kid', array(
			'read'                => true,
			'list_users'          => true,
			'edit_users'          => true,
			'promote_users'       => true,
			'view_sensitive_data' => true,
		) );
}

add_action( 'init', 'ckn_add_custom_roles' );
