<?php

class Vcci_Members_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
    
    private function vcci_members_setup_post_type() {
    
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
    
	public static function activate() {
         // Trigger our function that registers the custom post type plugin.
    Vcci_Members_Activator::vcci_members_setup_post_type(); 
    // Clear the permalinks after the post type has been registered.
    flush_rewrite_rules(); 
	}

}
