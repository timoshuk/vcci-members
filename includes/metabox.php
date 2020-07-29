<?php

function vcci_members_add_event_metaboxes() {
	add_meta_box(
		'vcci_members_link',
		esc_html__('Site Link:', 'vcci_members'),
		'vcci_members_show_link',
		'vcci_members',
		'side',
		'default'
	);
}
 

function vcci_members_show_link() {
	global $post;

	// Nonce field to validate form request came from current site
	wp_nonce_field( basename( __FILE__ ), 'vcci_members_fields' );

	// Get the location data if it's already been entered
	$member_link = get_post_meta( $post->ID, 'member-link', true );

	// Output the field
	echo '<input type="text" name="member-link" value="' . esc_textarea( $member_link )  . '" class="member-link">';

}



/**
 * Save the metabox data
 */
function vcci_members_save_meta( $post_id, $post ) {

	// Return if the user doesn't have edit permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	// Verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times.
	if ( ! isset( $_POST['member-link'] ) || ! wp_verify_nonce( $_POST['vcci_members_fields'], basename(__FILE__) ) ) {
		return $post_id;
	}

	// Now that we're authenticated, time to save the data.
	// This sanitizes the data from the field and saves it into an array $events_meta.
	$events_meta['member-link'] = esc_textarea( $_POST['member-link'] );

	// Cycle through the $events_meta array.
	// Note, in this example we just have one item, but this is helpful if you have multiple.
	foreach ( $events_meta as $key => $value ) :

		// Don't store custom data twice
		if ( 'revision' === $post->post_type ) {
			return;
		}

		if ( get_post_meta( $post_id, $key, false ) ) {
			// If the custom field already has a value, update it.
			update_post_meta( $post_id, $key, $value );
		} else {
			// If the custom field doesn't have a value, add it.
			add_post_meta( $post_id, $key, $value);
		}

		if ( ! $value ) {
			// Delete the meta key if there's no value
			delete_post_meta( $post_id, $key );
		}

	endforeach;

}
add_action( 'save_post', 'vcci_members_save_meta', 1, 2 );

?>