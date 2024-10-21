<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

if ( is_user_logged_in() ) :
	$user = CKN_User::get_instance();
	?>
    <div <?php echo get_block_wrapper_attributes(); ?>>
        <div class="card-block">
            <h3 class="card-title-section">Information</h3>
            <div>
                <div>
                    First name : <?php echo $user->get_fist_name(); ?>
                </div>
                <div>
                    Last name : <?php echo $user->get_last_name(); ?>
                </div>
                <div>
                    country : <?php echo $user->get_country(); ?>
                </div>
                <div>
                    Email : <?php echo $user->get_email(); ?>
                </div>
                <div>
                    Role : <?php echo $user->get_role(); ?>
                </div>
            </div>
        </div>
    </div>
<?php
endif;