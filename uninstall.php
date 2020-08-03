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


global $wpdb;

    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/wp-blog-header.php";

    function get_table_prefix() {
        global $wpdb;
        $table_prefix = $wpdb->prefix . "outsider_plugin";
        return $table_prefix;
    }
    $vcci_prefix = get_table_prefix();

    $vcci_post_table = $vcci_prefix . '_posts';
    $vcci_postmeta_table = $vcci_prefix . '_postmeta';
    $vcci_post_term_table = $vcci_prefix . '_term_relationships';

$wpdb->query("DELETE FROM $vcci_post_table WHERE post_type = 'vcci_members'");
$wpdb->query("DELETE FROM $vcci_postmeta_table WHERE post_id NOT IN (SELECT id FROM wp_posts)");
$wpdb->query("DELETE FROM $vcci_post_term_table WHERE object_id NOT IN (SELECT id FROM wp_posts)");
