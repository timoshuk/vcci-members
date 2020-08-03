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


// global $wpdb;


//     $vcci_post_table = $wpdb->prefix . '_posts';
//     $vcci_postmeta_table = $wpdb->prefix . '_postmeta';
//     $vcci_post_term_table = $wpdb->prefix . '_term_relationships';

// $wpdb->query("DELETE FROM $vcci_post_table WHERE post_type = 'vcci_members'");
// $wpdb->query("DELETE FROM $vcci_postmeta_table WHERE post_id NOT IN (SELECT id FROM wp_posts)");
// $wpdb->query("DELETE FROM $vcci_post_term_table WHERE object_id NOT IN (SELECT id FROM wp_posts)");



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

