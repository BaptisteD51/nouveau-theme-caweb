<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>
</head>

<body <?php body_class(); ?>>
    <header>
        <?php the_custom_logo(); ?>
        <p class="site-title"> <?php bloginfo('name'); ?> </p>
        <?php
        wp_nav_menu(['theme_location' => 'main-menu', "nav", 'container' => 'nav']); //theme_location with underscore !!!
        ?>
    </header>