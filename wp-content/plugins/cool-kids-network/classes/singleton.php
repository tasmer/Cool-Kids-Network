<?php
/**
 * Class Singleton.
 *
 * @package CoolKidsNetwork
 */

/**
 * Class Singleton
 */
trait CKN_Singleton {

	/**
	 * Instance of class.
	 *
	 * @var null
	 */
	private static $instance = null;

	/**
	 * Constructor.
	 *
	 * Private constructor to prevent instantiation outside the class.
	 */
	private function __construct() {
		$this->init();
	}

	private function __clone() {}

	private function __wakeup() {}

	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Method that performs class action.
	 *
	 * @return void
	 */
	protected function init() {
		// must be implemented into all child classes.
	}
}
