<?php
function caweb_theme_supports(){
    add_theme_support( "title-tag" );
}

function caweb_theme_assets(){
    wp_register_style( 'baptiste', 'https://baptistedufour.fr/style.css');
    wp_enqueue_style('baptiste');
};

add_action('after_setup_theme', 'caweb_theme_supports');
add_action('wp_enqueue_scripts', 'caweb_theme_assets');
