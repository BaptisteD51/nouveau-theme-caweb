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
    wp_register_script('fontawesome', 'https://kit.fontawesome.com/1c552aca57.js');
    /*wp_enqueue_style('baptiste');*/
    wp_enqueue_style('caweb_theme_style');
    wp_enqueue_script('fontawesome');
};

function caweb_theme_assets_footer(){//to add script at the bottom of the body
    wp_register_script( 'menu-burger', get_template_directory_uri() . '/js/menu-burger.js');
    wp_enqueue_script('menu-burger');
}

add_action('after_setup_theme', 'caweb_theme_supports');
add_action('wp_enqueue_scripts', 'caweb_theme_assets');
add_action( 'wp_footer', 'caweb_theme_assets_footer');