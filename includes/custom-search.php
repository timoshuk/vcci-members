<?php

function vcciSearchFilter( $query ) {
    $post_type = $_GET['post_type'];
    if (!$post_type) {
       $post_type = 'any';
    }
    if ( $query->is_search ) {
       $query->set( 'post_type', array( esc_attr( $post_type ) ) );
    }
    return $query;
}
add_filter( 'pre_get_posts', 'vcciSearchFilter' );