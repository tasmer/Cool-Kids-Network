<?php
/**
 * Cool Kids Network
 *
 * @package CoolKidsNetwork
 * @author Zainoudine Soulé
 *
 * Plugin Name: Cool Kids Network
 * Plugin URI: https://github.com/tasmer/Cool-Kids-Network
 * Description: Generate user with Email
 * Author: Zainoudine Soulé
 * Version: 1.0.0
 * Requires PHP: 7.4
 * Author URI: https://zainoudine-soule.net/
 * Text Domain: cool-kids-network
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit to avoid access directly.
}

// Define plugin constante.
define( 'CKN_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'CKN_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );

define( 'CKN_PLUGIN_BLOCK_BUILD_DIR', CKN_PLUGIN_DIR_PATH . 'build/' );
define( 'CKN_PLUGIN_INC_DIR_PATH', CKN_PLUGIN_DIR_PATH . 'inc/' );


require_once CKN_PLUGIN_INC_DIR_PATH . 'init.php';
require_once CKN_PLUGIN_INC_DIR_PATH . 'blocks.php';
require_once CKN_PLUGIN_INC_DIR_PATH . 'ajax-handler.php';

require_once CKN_PLUGIN_DIR_PATH . 'classes/singleton.php';
require_once CKN_PLUGIN_DIR_PATH . 'classes/ckn-user.php';
require_once CKN_PLUGIN_DIR_PATH . 'classes/ckn-registrer-user.php';
