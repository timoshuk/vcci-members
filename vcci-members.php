<?php

/**
 * Plugin Name:       VcciMembers
 * Description:       Плагін додає тип запису Члени ТПП для виводу на сторінці членської бази
 * Version:           0.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Oleksandr Timoshchuk
 * Author URI:        https://timoshchuk.pp.ua/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       vcci_members
 * Domain Path:       /languages
 */



if(!defined("WPINC")){
    die;
}


 /**
 * Register the "book" custom post type
 */
function vcci_members_setup_post_type() {
    function register_post_types(){
        register_post_type( 'vcci_members', [
            'label'  => null,
            'labels' => [
                'name'               => 'Члени ВТПП',
                'singular_name'      => 'Член ВТПП', 
                'add_new'            => 'Додати Члена', 
                'add_new_item'       => 'Додавання Члена', 
                'edit_item'          => 'Редагувати запис', 
                'new_item'           => 'Новий запис', 
                'view_item'          => 'Переглянути запис',
                'search_items'       => 'Шукати Запис', 
                'not_found'          => 'Данних запису не знайдено', 
                'not_found_in_trash' => 'В смітнику нічого не знайдено', 
                'menu_name'          => 'VCCI_Members', 
            ],
            'description'         => 'Список членів Волинської ТПП',
            'public'              => true,
            'show_in_menu'        => true, 
            'show_in_rest'        => true, 
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-admin-multisite',
            'capability_type'   => 'post',
           
            'hierarchical'        => false,
            'supports'            => [ 'title', 'editor', 'thumbnail', 'excerpt' ], 
            'has_archive'         => false,
            'query_var'           => true,
        ] );
} 
add_action( 'init', 'vcci_members_setup_post_type' );
 
 
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

?>