<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>
</head>
<body <?php body_class();?>>
    <header>
        <?php 
            bloginfo('name');
            wp_nav_menu(['theme_location'=>'main-menu']); //theme_location with underscore !!!
            get_search_form();
        ?>
    </header>