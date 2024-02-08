<?php

include 'advanced-custom-fields.php';

function caweb_theme_supports(){
    add_theme_support( "title-tag" );

    /**
     * Activate the post-thumbnail fonctionality only for posts ans intervanant pages
     */
    add_theme_support('post-thumbnails',['post', 'intervenant']);

    $palette = [
        [
            "slug" => "bleu",
            "color" => "#27526A",
            "name" => "Bleu"
        ],[
            "slug" => "vert",
            "color" => "#78999C",
            "name" => "Vert"
        ],[
            "slug" => "orange",
            "color" => "#FCA45D",
            "name" => "Orange"
        ],[
            "slug" => "rose",
            "color" => "#F77B65",
            "name" => "Rose"
        ],[
            "slug" => "rouge",
            "color" => "#DA2317",
            "name" => "Rouge"
        ],
    ];
    add_theme_support('editor-color-palette', $palette);

    $gradients = [
        [
            "slug" => "gradient-caweb",
            "gradient" => "linear-gradient(90deg,#da2014 44.27%,#fca45d 100%)",
            "name" => "Dégradé Caweb",
        ]
    ];
    /**
     * This function crate the css variable and the class relative to the slug. But you need to 
     * create a rule in style.css in order for it to be displayed in front end
     */
    add_theme_support('editor-gradient-presets', $gradients);
    
    add_theme_support('menus');
    add_theme_support( 'custom-logo', ["height"=>60,"width"=>210]);
    register_nav_menus([
        'footer-menu'=> 'Menu secondaire',
        'main-menu'=>'Menu principal',
        'social-menu'=>'Menu réseaux sociaux',
        'contact-menu'=>'Menu contact secrétariat ',
    ]);

    add_image_size('author-format', 150, 150, true);
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

function caweb_theme_init(){
    register_post_type('intervenant',[
        'label' => 'Intervenant',
        'public' => true,
        'menu_position' => 22,
        'has_archive' => true,
        'menu_icon' => 'dashicons-businesswoman',
        'supports' => ['title', 'thumbnail', 'editor'],
        'show_in_nav_menus' => false,
    ]);
}

/**
 * That's such a pain... I figured out how to make it work in the end though
 * $items are each individual menu items
 * $args is an anonymous object (stdobject) that contains infos on each menu items
 * Don't hesitate to var_dump
 */
function caweb_theme_wp_nav_menu_objects($items, $args){
    if($args->theme_location == 'social-menu'){
        foreach($items as $item){
            $item->title = get_field('social_icon', $item);
        }
    }

    if($args->theme_location == 'contact-menu'){
        foreach($items as $item){
            $phone = get_field('secretary_phone', $item);
            $email = get_field('secretary_email', $item);

            $html = '<ul>';
            $html .= '<li>'.$item->title.'</li>';
            $html .= '<li><a href="tel:'.$phone.'">'.$phone.'</a></li>';
            $html .= '<li><a href="mailto:'.$email.'">'.$email.'</a></li>';
            $html .= '</ul>';
            
            $item->title = $html;
            $item->url = '';
        }
    }

    if($args->theme_location == 'main-menu'){
        foreach($items as $item){
            if(get_field('menu-item-class', $item)!==''){
                $item->classes[0] = get_field('menu-item-class', $item);
            }
        }
    }

    if(($args->theme_location == 'contact-menu') || ($args->theme_location == 'footer-menu') || ($args->theme_location == 'social-menu')){
        $menu = wp_get_nav_menu_object($args->menu);
        $navTitle = get_field('nav_title', $menu);
        echo '<h4>'.$navTitle.'</h4>';
    }

    return $items;
}

function caweb_theme_register_widgets(){
    register_sidebar([
        'id' => 'bottom-footer-sidebar',
        'name'=>'Bandeau en bas du footer',
        'before_widget'=>"<div class='bottom-footer-widget-element'>",
        'after_widget'=>"</div>",
        'before_sidebar'=>"<div class='bottom-footer-sidebar'>",
        'after_sidebar'=>"</div>",
    ]);
}

function caweb_theme_excerpt_length($length){
    return 20;
}

/**
 * This add a shortcode to easily display the current year in WordPress posts and widgets 
 */
//[year]
function display_current_year(){
    return date('Y');
}
add_shortcode('year', 'display_current_year');

add_action('init', 'caweb_theme_init');
add_action('after_setup_theme', 'caweb_theme_supports');
add_action('wp_enqueue_scripts', 'caweb_theme_assets');
add_action( 'wp_footer', 'caweb_theme_assets_footer');
add_action( 'widgets_init', 'caweb_theme_register_widgets');

/**
 * 10 -> the priority
 * 2 -> the number of arguments that the callback takes
 * They are needed in order to avoid any error messages
 */
add_filter('wp_nav_menu_objects', 'caweb_theme_wp_nav_menu_objects', 10, 2);
add_filter( 'excerpt_length', 'caweb_theme_excerpt_length'/*, 999 */);

