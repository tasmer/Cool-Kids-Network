<?php
/**
 * Class User.
 *
 * @package CoolKidsNetwork
 */

/**
 *  Class user to implement Cool Kid User.
 *
 * @property \WP_User $user
 * @property string $first_name
 */
class CKN_User {

	use CKN_Singleton;

	/**
	 * WP user object.
	 *
	 * @var \WP_User
	 */
	private $user;

	/**
	 * User fist name.
	 *
	 * @var string
	 */
	private $fist_name;

	/**
	 * User last name
	 *
	 * @var string
	 */
	private $last_name;

	/**
	 * User country.
	 *
	 * @var string
	 */
	private $country;

	/**
	 * User email
	 *
	 * @var string
	 */
	private $email;

	/**
	 * User role.
	 *
	 * @var string
	 */
	private $role;

	/**
	 * Init user class.
	 *
	 * @param int $user_id User ID default 0.
	 *
	 * @return void
	 */
	protected function init( int $user_id = 0 ) {
		if ( ! $user_id ) {
			$this->user = wp_get_current_user();
		} else {
			$this->user = get_user_by( 'id', $user_id );
		}
		$this->set_user_data();
	}

	/**
	 * Set class properties.
	 *
	 * @return void
	 */
	private function set_user_data() {
		$this->fist_name = $this->user->first_name;
		$this->last_name = $this->user->last_name;
		$this->country   = get_user_meta( $this->user->ID, 'country', true );
		$this->email     = $this->user->user_email;
		$this->role      = ckn_get_role_name( $this->user->roles[0] ?? '' );
	}

	/**
	 * Retrieve user fist name.
	 *
	 * @return string
	 */
	public function get_fist_name() {
		return $this->fist_name;
	}

	/**
	 * Retrieve user last name.
	 *
	 * @return string
	 */
	public function get_last_name() {
		return $this->last_name;
	}

	/**
	 * Retrieve user email.
	 *
	 * @return string
	 */
	public function get_email() {
		return $this->email;
	}

	/**
	 * Retrieve user country.
	 *
	 * @return string
	 */
	public function get_country() {
		return $this->country;
	}

	/**
	 * Retrieve user role.
	 *
	 * @return string
	 */
	public function get_role() {
		return $this->role;
	}
}
