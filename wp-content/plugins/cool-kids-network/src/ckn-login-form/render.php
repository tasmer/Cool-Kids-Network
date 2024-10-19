<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
if ( ! is_user_logged_in() ):
	?>
    <p <?php echo get_block_wrapper_attributes(); ?>>
		<?php
		wp_login_form( array(
			'label_username' => ( 'Email Address' ),
		) );
		?>
    </p>
<?php
endif;