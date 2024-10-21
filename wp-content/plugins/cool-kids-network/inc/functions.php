<?php
/**
 * Functions utils.
 *
 * @package CoolKidsNetwork
 */

/**
 * Retrieve role name.
 *
 * @param string $role Role slug.
 *
 * @return string
 */
function ckn_get_role_name( $role ) {
	$roles = wp_roles()->roles;

	return $roles[ $role ]['name'] ?? '';
}
