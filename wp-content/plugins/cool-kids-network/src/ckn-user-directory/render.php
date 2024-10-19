<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

if ( current_user_can( 'cooler_kid' ) || current_user_can( 'coolest_kid' ) ):
	?>
    <div <?php echo get_block_wrapper_attributes(); ?>>
        <button id="view-users-btn">View Users</button>
        <table id="user-list" style="display: block">
            <thead>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
<?php
endif;