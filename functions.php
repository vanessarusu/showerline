<?php

// Defines
define( 'FL_CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'FL_CHILD_THEME_URL', get_stylesheet_directory_uri() );

// Classes
require_once 'classes/class-fl-child-theme.php';

// Actions
add_action( 'wp_enqueue_scripts', 'FLChildTheme::enqueue_scripts', 1000 );


function _showerline_assets() {
    wp_enqueue_style( '_showerline-admin-stylesheet', get_stylesheet_directory_uri() . '/dist/css/admin.css', array(), '1.0.0', 'all' );
    wp_enqueue_style( '_showerline-stylesheet', get_stylesheet_directory_uri() . '/dist/css/bundle.css', array(), '1.0.0', 'all' );
    wp_enqueue_script( '_showerline-scripts', get_stylesheet_directory_uri() . '/dist/js/bundle.js', array(), '1.0.0', true );
}

// disable comments on media uploads
function filter_media_comment_status( $open, $post_id ) {
    $post = get_post( $post_id );
    if( $post->post_type == 'attachment' ) {
        return false;
    }
    return $open;
}

add_filter( 'comments_open', 'filter_media_comment_status', 10 , 2 );

add_action('wp_enqueue_scripts', '_showerline_assets', 1000 );