<?php

include 'advanced-custom-fields.php';

function caweb_theme_supports(){
    load_theme_textdomain( 'theme_caweb', get_template_directory() . '/languages' );

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
        'footer-menu'=> __('Menu secondaire', 'theme_caweb'),
        'main-menu'=> __('Menu principal', 'theme_caweb'),
        'social-menu'=> __('Menu réseaux sociaux', 'theme_caweb'),
        'contact-menu'=> __('Menu contact secrétariat', 'theme_caweb'),
    ]);

    add_image_size('author-format', 150, 150, true);

    add_theme_support('editor-styles');
    add_theme_support('align-wide');
    add_theme_support('appearance-tools'); // this work when installing the gutenberg plugin, should be available in wordpress core 6.5
    add_theme_support('custom-spacing');
};

add_editor_style(get_template_directory_uri() . '/css/editor-style.css');

function caweb_theme_assets(){
    wp_register_style( 'caweb_theme_style', get_template_directory_uri() . '/style.css');
    wp_register_script('fontawesome', 'https://kit.fontawesome.com/1c552aca57.js');
    wp_enqueue_style('caweb_theme_style');
    wp_enqueue_script('fontawesome');
};

function caweb_theme_assets_footer(){//to add script at the bottom of the body
    wp_register_script( 'menu-burger', get_template_directory_uri() . '/js/menu-burger.js');
    wp_enqueue_script('menu-burger');
    wp_register_script('language-switcher', get_template_directory_uri() . '/js/language-switcher.js');
    wp_enqueue_script('language-switcher');
}

function caweb_theme_init(){
    register_post_type('intervenant',[
        'label' => __('Intervenants', 'theme_caweb'),
        'labels' => [
            'name'=>__('Intervenants', 'theme_caweb'),
            'singular_name'=>__('Intervenant', 'theme_caweb'),
            'add_new_item' => __('Ajouter un intervenant', 'theme_caweb'),
            'edit_item' => __('Modifier l\'intervant', 'theme_caweb'),
            'add_new' => __('Ajouter un intervenant', 'theme_caweb'),
            'add_new_item' => __('Ajouter un intervenant', 'theme_caweb'),
        ],
        'public' => true,
        'menu_position' => 22,
        'has_archive' => true,//test
        'menu_icon' => 'dashicons-businesswoman',
        'supports' => ['title', 'thumbnail', 'editor'],
        'show_in_nav_menus' => false,
        'exclude_from_search' => true,
        'rewrite'=>[
            'slug'=>__('intervenants', 'theme_caweb'),
        ],
    ]);

    register_taxonomy(
        'matiere',
        'intervenant',[
            'labels'=>[
                'name'=>__('Matières', 'theme_caweb'),
                'singular_name'=>__('Matière', 'theme_caweb'),
                'add_new_item'=>__('Ajouter une nouvelle matière', 'theme_caweb'),
                'not_found'=>__('Aucune matière trouvée', 'theme_caweb'),
                'edit_item'=>__('Modifier la matière', 'theme_caweb'),
                'back_to_items'=>__('&larr; Aller aux matières', 'theme_caweb'),
            ],
            'hierarchical'=>true,
            'show_in_nav_menus' => false,
            'show_admin_column' =>true,
        ],
    );
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
        'name'=>__('Bandeau en bas du footer', 'theme_caweb'),
        'before_widget'=>"<div class='bottom-footer-widget-element'>",
        'after_widget'=>"</div>",
        'before_sidebar'=>"<div class='bottom-footer-sidebar'>",
        'after_sidebar'=>"</div>",
    ]);
    register_sidebar([
        'id' => 'column-footer-sidebar',
        'name'=>__('Colonne de droite du footer', 'theme_caweb'),
        'before_widget'=>"<div class='column-footer-widget-element'>",
        'after_widget'=>"</div>",
        'before_sidebar'=>"<div class='column-footer-sidebar'>",
        'after_sidebar'=>"</div>",
    ]);
}

function caweb_theme_excerpt_length($length){
    return 20;
}

function caweb_theme_custom_language_switcher(){
    $languages = apply_filters('wpml_active_languages', NULL);
    if($languages !== NULL){
        $activeLanguage = [];
        $otherLanguages = [];

        foreach($languages as $language){
            if($language['active']){
                $activeLanguage = $language;
            }else{
                $otherLanguages[] = $language;
            }
        }

        echo "<nav class='language-switcher-wrapper'><ul class='language-switcher'>";
        echo "<li class='language-item active-language'><a>".$activeLanguage['translated_name']." <i class='fa-solid fa-chevron-down'></i>"."</a></li>";
        echo "<li class='other-languages'><ul>";
        foreach($otherLanguages as $language){
            $name = $language['translated_name'];
            $url = $language['url'];
            echo '<li class="language-item">';
            echo '<a href='.$url.'>'.$name.'</a>';
            echo '</li>';
        }
        echo "</li></ul>";
        echo "</ul></nav>";
    }
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