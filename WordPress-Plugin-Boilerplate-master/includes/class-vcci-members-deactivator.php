<?php

class Vcci_Members_Deactivator {

    
	public static function deactivate() {
         // Unregister the post type, so the rules are no longer in memory.
    unregister_post_type( 'vcci_members' );
    // Clear the permalinks to remove our post type's rules from the database.
    flush_rewrite_rules();
	}

}
