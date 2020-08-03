<?php

/**
 * Triger this file on Plugin uninstall
 * 
 * @package VcciMembers
 * 
 */

// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}
 

//  Clear database DELL VcciMembers post
function vcci_members_delete_plugin() {
	global $wpdb;

	delete_option( 'vcci_members' );

	$posts = get_posts(
		array(
			'numberposts' => -1,
			'post_type' => 'vcci_members',
			'post_status' => 'any',
		)
	);

	foreach ( $posts as $post ) {
		wp_delete_post( $post->ID, true );
	}

	$wpdb->query( sprintf( "DROP TABLE IF EXISTS %s",
		$wpdb->prefix . 'vcci_members' ) );
}

vcci_members_delete_plugin();

