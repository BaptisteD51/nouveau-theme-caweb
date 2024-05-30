<?php
/**
 * Contains all the caweb_theme custom functions and the relative filter and Hooks
 */
 
/**
 * Link this function to the hook after_setup_theme
 */
function caweb_theme_supports(){
    load_theme_textdomain( 'theme_caweb', get_template_directory() . '/languages' );
    
    /**
     * Allow <title> tag in <head>
     */
    add_theme_support( "title-tag" );

    /**
     * Activate the post-thumbnail fonctionality for posts and "intervenants" pages
     */
    add_theme_support('post-thumbnails',['post', 'intervenant', 'creation']);

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
    /**
     * Add a color palette to the editor.
     * This also generate CSS variables, 
     * but you have to add CSS rules in style.css to the classes that WordPress uses,
     * so that the colors are displayed in the front-end.
     * 
     * You may have to add some CSS rules in the css/editor-style.css,
     * so that the colors are visible in the editor
     */
    add_theme_support('editor-color-palette', $palette);

    $gradients = [
        [
            "slug" => "gradient-caweb",
            "gradient" => "linear-gradient(90deg,#da2014 44.27%,#fca45d 100%)",
            "name" => "Dégradé Caweb",
        ]
    ];
    /**
     * Create the CSS variables and class relative to the slug.
     * It's the same system as for the color palette :
     * You need to create rule in style.css,
     * so that you gradient is displayed in the front-end
     */
    add_theme_support('editor-gradient-presets', $gradients);
    
    add_theme_support('menus');

    /**
     * Added a height and a width to the logo
     */
     add_theme_support( 'custom-logo');
    
    /**
     * Here you can register menus.
     * Then you have to add them to the relevant template part (such as header.php or footer.php)
     * with the function wp_nav_menu()
     */
    register_nav_menus([
        'footer-menu'=> __('Menu secondaire', 'theme_caweb'),
        'main-menu'=> __('Menu principal', 'theme_caweb'),
        'social-menu'=> __('Menu réseaux sociaux', 'theme_caweb'),
        'contact-menu'=> __('Menu contact secrétariat', 'theme_caweb'),
    ]);

    /**
     * By default, when you upload an image via the library,
     * WordPress generate 3 image sizes (thumbail, medium, large).
     * You can register another image size via the following function.
     * This "author-format" can be reused in template files to display
     * an image at the right size in the front-end. 
     * This helps improving the page loading performance.
     * The fourth argument 'true' is here to automatically crop the image at the right
     * aspect-ratio.
     */
    add_image_size('author-format', 150, 150, true);

    /**
     * Allow custom styles in the editor.
     * To add an editor stylesheet, use the function add_editor_style
     */
    add_theme_support('editor-styles');
    
    /**
     * This add an align-wide and an alignfull alignment in the editor.
     * Then, you have to add CSS rules in style.css for the WordPress
     * class .alignfull
     */
    add_theme_support('align-wide');

    /**
     * This Theme Support works when installing the gutenberg plugin.
     * It adds the same block layout options (margin, vw and vh...)
     * as for the block themes, 
     * but in the classic themes (such as this one).
     * 
     * This functionality should available in WordPress 6.5 without the plugin
     */
    add_theme_support('appearance-tools'); // this work when installing the gutenberg plugin, should be available in wordpress core 6.5
    
    /**
     * To add paddings for some blocks directly with the page Editor
     */
    add_theme_support('custom-spacing');
};

/**
 * Add CSS rules to customize the gutenberg editor appearance
 */
add_editor_style(get_template_directory_uri() . '/css/editor-style.css');

/**
 * Must be linked to the hook wp_enqueue_scripts
 * Register and add styles and scripts that can be loaded in the <head> tag
 * 
 * First you have to register the script with a name you choose,
 * then add it with wp_enqueue_script
 */
function caweb_theme_assets(){
    wp_register_style( 'caweb_theme_style', get_template_directory_uri() . '/style.css');
    wp_register_script('fontawesome', 'https://kit.fontawesome.com/1c552aca57.js');
    wp_enqueue_style('caweb_theme_style');
    wp_enqueue_script('fontawesome');
};

/**
 * Must be linked to the hook wp_footer
 * Register scripts and put them before the closure of <body>
 * 
 * First you have to register the script with a name you choose,
 * then add it with wp_enqueue_script
 */
function caweb_theme_assets_footer(){
    /**
     * The javascript used for the burger menu
     */
    wp_register_script( 'menu-burger', get_template_directory_uri() . '/js/menu-burger.js');
    wp_enqueue_script('menu-burger');

    /**
     * The javascript used for the custom WPML language switcher
     */
    wp_register_script('language-switcher', get_template_directory_uri() . '/js/language-switcher.js');
    wp_enqueue_script('language-switcher');

        /**
     * The JavaScript used to switch tabs in careers and program pages
     */
    wp_register_script('tab-switcher', get_template_directory_uri() . '/js/tab-switcher.js');
    wp_enqueue_script('tab-switcher');
}

/**
 * The default languages switchers provided by WPML where not fit to correspond to the Figma models.
 * That's why there is this function that generate a custom language switcher.
 * You have to call it in the template part where you want the swithcher (header.php in our case)
 */
function caweb_theme_custom_language_switcher(){
    /**
     * This filter return an array with the active languages on the current page
     */
    $languages = apply_filters('wpml_active_languages', NULL);

    if(($languages !== NULL) && ($languages !== [])){
        $activeLanguage = [];
        $otherLanguages = [];

        /**
         * This loop is here to sort out the active language from the other languages,
         * as we want the active language on top of the switcher
         */
        foreach($languages as $language){
            if($language['active']){
                $activeLanguage = $language;
            }else{
                $otherLanguages[] = $language;
            }
        }

        /**
         * The HTML output
         */
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
 * Must be linked to the hook init.
 * It registers the 'intervenant' post type and the relative 'matiere' taxonomy
 */
function caweb_theme_init(){
    /**
     * Registers the post type intervenant
     */
    register_post_type('intervenant',[
        
        /**
         * The label shown in the admin right menu.
         */
        'label' => __('Intervenants', 'theme_caweb'),

        /**
         * By default, the buttons to edit custom posts in the admin keep the same labels as post types.
         * You have to update them to correspond to the custom post
         */
        'labels' => [
            'name'=>__('Intervenants', 'theme_caweb'),
            'singular_name'=>__('Intervenant', 'theme_caweb'),
            'add_new_item' => __('Ajouter un intervenant', 'theme_caweb'),
            'edit_item' => __('Modifier l\'intervant', 'theme_caweb'),
            'add_new' => __('Ajouter un intervenant', 'theme_caweb'),
            'add_new_item' => __('Ajouter un intervenant', 'theme_caweb'),
        ],

        /**
         * To make the post accessible from the front end
         */
        'public' => true,

        /**
         * The higher the number is, the lower the menu item will be.
         */
        'menu_position' => 22,

        /**
         * Must be set to true, because we want to display all the teachers on one archive page
         */
        'has_archive' => true,

        /**
         * Here you can set the icon you want to be displayed in the menu.
         * It can be an url or an icon from the Dashicons WordPress icon bank. 
         */
        'menu_icon' => 'dashicons-businesswoman',

        /**
         * Title and editor are activated by default,
         * but you have to activate the post-thumbnail fonctionnality
         */
        'supports' => ['title', 'thumbnail', 'editor'],
        
        /**
         * We don't want to individually add the intervants in the menu. 
         * No need to clutter the back-end with that
         */
        'show_in_nav_menus' => false,

        /**
         * Don't need to clutter the search results with that 
         */
        'exclude_from_search' => true,
        
        /**
         * The rewrite rule is here to rewrite the slug for the archive page.
         * We want it with a plural.
         * I don't use internationalization functions here, 
         * because it causes compatibility problems with WPML.
         * To translate the slug, you must use WPML :
         * Settings -> Post Types
         * Set the intervenant post type as translatable, then -> Set different slugs  
         */
        'rewrite'=>[
            'slug'=>'intervenants',
            /**
             * with_front is set to false. If true, the rewriting will follow the rules set in the permalink
             * settings of the back-office : we don't want the same url struture as for posts   
             */
            'with_front'=>false,
        ],
    ]);

    /**
     * Registers the custom taxonomy matiere for intervenant
     */
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

            /**
             * We put hierarchical as true to have checkoxes in the post editor,
             * the same way as for categories
             */
            'hierarchical'=>true,
        
            'show_in_nav_menus' => false,

            /**
             * We need that to access the matiere in the admin menu
             */
            'show_admin_column' =>true,
        ],
    );

    /** 
     * Creation post type for the websites created by the M1 students
     */
    register_post_type('creation',[
        'label' => __('Créations', 'theme_caweb'),

        'labels' => [
            'name'=>__('Créations', 'theme_caweb'),
            'singular_name'=>__('Création', 'theme_caweb'),
            'add_new_item' => __('Ajouter une création', 'theme_caweb'),
            'edit_item' => __('Modifier la création', 'theme_caweb'),
            'add_new' => __('Ajouter une création', 'theme_caweb'),
            'add_new_item' => __('Ajouter une création', 'theme_caweb'),
        ],

        'public' => true,
        
        'menu_position' => 23,

        'has_archive' => true,

        'menu_icon' => 'dashicons-admin-site-alt3',

        'supports' => ['title', 'thumbnail', 'editor'],
        
        'show_in_nav_menus' => false,

        'exclude_from_search' => false,

        
        /** 
            * To activate gutenberg 
            */
        'show_in_rest' => true,
            
        'rewrite'=>[
                'slug'=>'creations',
                'with_front'=>false,
        ],
    ]);

    /**
     * As the website doesn't use comments in any ways,
     * we can deactivate them for posts and pages
     */
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
}

/**
 * Must be hooked with admin_menu.
 * 
 * As we don't use the comments, we remove the comment menu in the admin menu. 
 * It avoids cluttering the admin with useless menus.
 */
function caweb_theme_admin_menu(){
    remove_menu_page( 'edit-comments.php' );
}

/**
 * Must be hooked with wp_before_admin_bar_render.
 * Removes the comment section in the top admin bar.
 * We have to declare the global variable $wp_admin_bar in order to make it work.
 */
function caweb_theme_admin_bar() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}

/**
 * Must be linked to the wp_nav_menu_objects filter.
 * This function is here to personalize menu items with the help of ACF fields.
 * The $items argument is an array that contains each individual menu item.
 * The $args argument is an anonymous object (stdobject) that contains infos on each menu items
 * 
 * This is a filter : you can modify each individual items that pass through it,
 * at the end, you must return them with the return statement 
 */
function caweb_theme_wp_nav_menu_objects($items, $args){

    /**
     * As the menu items custom fields are created with the ACF plugin,
     * we check if the ACF function get_field() exists,
     * so that there is no error when the plugin is deactivated 
     */
    if(function_exists('get_field')){

        /**
         * Displays the fontawesome icon inputed in the ACF field for the social menu 
         */
        if($args->theme_location == 'social-menu'){
            foreach($items as $item){
                $item->title = get_field('social_icon', $item);
            }
        }

        /**
         * Add the class inputed in the ACF field for the main menu
         */
        if($args->theme_location == 'main-menu'){
            foreach($items as $item){
                if(get_field('menu-item-class', $item)!==''){
                    $item->classes[0] = get_field('menu-item-class', $item);
                }
            }
        }

        /**
         * Retrieves the phone number and the email inputed in the contact-menu item,
         * Then create a custom HTML structure to display phone and email.
         */
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
    }

    return $items;
}

/**
 * Must ke linked to the widgets_init hook.
 * This function is here to register sidebars.
 * Sidebars are zone where you can input WordPress blocks (or widgets) via the admin.
 * On the Caweb Theme, there is a sidebar at the bottom of the footer, 
 * and a sidebar for the fourth column of the footer.
 * 
 * After registration, we also need to create template parts for each sidebar,
 * named like this : sidebar + 'id' + .php  
 */
function caweb_theme_register_widgets(){
    register_sidebar([
        'id' => 'bottom-footer-sidebar',

        /**
         * The name displayed in the admin
         */
        'name'=>__('Bandeau en bas du footer', 'theme_caweb'),

        /**
         * HTML content before and after each individual widget of the side bar
         */
        'before_widget'=>"<div class='bottom-footer-widget-element'>",
        'after_widget'=>"</div>",

        /**
         * HTML before and after the sidebar in itself
         */
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

/**
 * This function is here to change the number of posts per page for the post type intervenant.
 * By default it is limited at the same number as posts.
 */
function caweb_theme_pre_get_posts($query){
    /**
     * Checks if we are on the admin interface or if we are not on the main query. If it's the
     * case, no modifications are added.
     */
    if(is_admin() || !$query->is_main_query()){
        return;
    }

    /**
     * If we are on the archive page of intervenant, show max 100 posts per page.
     * That will be enough for all the teachers of the master
     */
    if(is_post_type_archive('intervenant')){
        $query->set('posts_per_page', 100);
    }
}

/**
 * Must be added to the filter excerpt_length
 * It's here ta change the default excerpt length for the archive pages
 * The default 55 words were too long
 */
function caweb_theme_excerpt_length($length){
    return 20;
}

/**
 * This add a shortcode to easily display the current year in WordPress posts and widgets.
 * You just have to write [year] in the content.
 * 
 * In the add_shortcode() action, the first parameter is the tag you want to use for the shortcode (between the []),
 * the second parameter is the function that will be called.
 */
function display_current_year(){
    /**
     * This is the native date() PHP function
     */
    return date('Y');
}
add_shortcode('year', 'display_current_year');

/**
 * This allow to echo the post thumbnail if one is defined, and display a default placeholder if no
 * post thumbnail was defined.
 * It avoids posts without images in archive pages
 */
function caweb_theme_the_post_thumbnail($post = null){
    if(get_the_post_thumbnail($post)!=''){
        echo get_the_post_thumbnail($post, "thumbnail");
    }else{
        echo '<img src="'. get_template_directory_uri() .'/images/thumbnail-placeholder.webp">';
    }
}

add_action('init', 'caweb_theme_init');
add_action('after_setup_theme', 'caweb_theme_supports');
add_action('wp_enqueue_scripts', 'caweb_theme_assets');
add_action( 'wp_footer', 'caweb_theme_assets_footer');
add_action( 'widgets_init', 'caweb_theme_register_widgets');
add_action( 'admin_menu', 'caweb_theme_admin_menu' );
add_action( 'wp_before_admin_bar_render', 'caweb_theme_admin_bar' );

/**
 * 10 -> the priority
 * 2 -> the number of arguments that the callback takes
 * These 2 numerical arguments are needed in order to avoid any error messages
 */
add_filter('wp_nav_menu_objects', 'caweb_theme_wp_nav_menu_objects', 10, 2);
add_filter( 'excerpt_length', 'caweb_theme_excerpt_length'/*, 999 */);
add_filter('pre_get_posts', 'caweb_theme_pre_get_posts');