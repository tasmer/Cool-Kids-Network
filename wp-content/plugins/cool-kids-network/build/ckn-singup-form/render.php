<?php
/**
 * Render form sing-up.
 *
 * @package CoolKidsNetwork
 */
?>
<form id="cnk_register" >
    <label for="cnk_email">Email Address : </label>
    <input type="email" id="cnk_email" name="cnk_email" required />
    <button type="submit">Register</button>
	<?php wp_nonce_field( 'register_cool_kid', 'security_cool_kid' ); ?>
    <input type="hidden" name="action" value="register_user" />
    <div id="cnk_message"></div>
</form>