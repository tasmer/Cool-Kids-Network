<?php
/**
 * Functions register block server side.
 *
 * @package CoolKidsNetwork
 */

/**
 * Register block server side.
 *
 * @author Zainoudine Soulé
 *
 * @return void
 */
function ckn_register_block() {
	register_block_type( CKN_PLUGIN_BLOCK_BUILD_DIR . 'ckn-singup-form/block.json' );
}

add_action( 'init', 'ckn_register_block' );