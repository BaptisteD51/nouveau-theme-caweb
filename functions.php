<?php
function caweb_theme_supports(){
    add_theme_support( "title-tag" );
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    add_theme_support( 'custom-logo');
    register_nav_menus([
        'footer-menu'=> 'Menu secondaire',
        'main-menu'=>'Menu principal',
    ]);
};

function caweb_theme_assets(){
    wp_register_style( 'baptiste', 'https://baptistedufour.fr/style.css');
    wp_register_style( 'caweb_theme_style', get_template_directory_uri() . '/style.css');
    /*wp_enqueue_style('baptiste');*/
    wp_enqueue_style('caweb_theme_style');
};

add_action('after_setup_theme', 'caweb_theme_supports');
add_action('wp_enqueue_scripts', 'caweb_theme_assets');