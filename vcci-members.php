<?php

/**
 * Plugin Name:       VcciMembers
 * Description:       Плагін додає тип запису Члени ТПП для виводу на сторінці членської бази
 * Version:           1.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Oleksandr Timoshchuk
 * Author URI:        https://timoshchuk.pp.ua/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       vcci_members
 * Domain Path:       /languages
 */



//  https://developer.wordpress.org/plugins/hooks/


if(!defined("WPINC")){
    die;
}

define( 'PLUGIN_NAME_VERSION', '1.0.1' );


/**
 * Register the "book" custom post type
 */
function vcci_members_setup_post_type() {
    
        register_post_type( 'vcci_members', [
            'labels' => [
                'name'               => esc_html__('Члени ВТПП', 'vcci_members'),
                'singular_name'      => esc_html__('Член ВТПП', 'vcci_members'), 
                'add_new'            => esc_html__('Додати Члена', 'vcci_members'), 
                'add_new_item'       => esc_html__('Додавання Члена', 'vcci_members'), 
                'edit_item'          => esc_html__('Редагувати запис', 'vcci_members'), 
                'new_item'           => esc_html__('Новий запис', 'vcci_members'), 
                'view_item'          => esc_html__('Переглянути запис','vcci_members'),
                'search_items'       => esc_html__('Шукати Запис', 'vcci_members'), 
                'not_found'          => esc_html__('Данних запису не знайдено', 'vcci_members'), 
                'not_found_in_trash' => esc_html__('В смітнику нічого не знайдено', 'vcci_members'), 
                'menu_name'          => esc_html__('VCCI_Members', 'vcci_members'), 
            ],
            'description'         => esc_html__('Список членів Волинської ТПП', 'vcci_members'),
            'public'              => true,
            'show_in_menu'        => true, 
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-admin-multisite',
            'capability_type'   => 'post',
            'hierarchical'        => false,
            'supports'            => [ 'title', 'editor', 'thumbnail'], 
            'has_archive'         => false,
            'query_var'           => true,
            'publicly_queryable'  => false,
            'register_meta_box_cb' => 'vcci_members_add_event_metaboxes',
        ] );
} 

add_action( 'init', 'vcci_members_setup_post_type' );

require plugin_dir_path( __FILE__ ) . 'includes/metabox.php';
require plugin_dir_path( __FILE__ ) . 'includes/custom-search.php';
 
/**
 * Activate the plugin.
 */
function vcci_members_activate() { 
    // Trigger our function that registers the custom post type plugin.
    vcci_members_setup_post_type(); 
    // Clear the permalinks after the post type has been registered.
    flush_rewrite_rules(); 
    
}
register_activation_hook( __FILE__, 'vcci_members_activate' );


/**
 * Deactivation hook.
 */
function vcci_members_deactivate() {
    // Unregister the post type, so the rules are no longer in memory.
    unregister_post_type( 'vcci_members' );
    // Clear the permalinks to remove our post type's rules from the database.
    flush_rewrite_rules();
} 

register_deactivation_hook( __FILE__ , 'vcci_members_deactivate' );


add_action( 'wp_enqueue_scripts', 'vcci_members_add_assets' );

function vcci_members_add_assets(){
    
   wp_enqueue_style( 'vcci_members', plugin_dir_url( __FILE__ ) . 'assets/css/vcci-members.css', [], '1.0.1' );
}