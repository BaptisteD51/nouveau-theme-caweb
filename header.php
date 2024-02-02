<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open();?>
    <header>
        <div class="header-wrapper">
            <div class="site-logo"><?php the_custom_logo(); ?></div>
            <!--<p class="site-title"> <?php bloginfo('name'); ?> </p>-->
            <?php
            wp_nav_menu(['theme_location' => 'main-menu', 'container' => 'nav', 'container_id' => 'main-menu-wrapper', 'container_class' => 'main-menu-wrapper', 'menu_id' => 'main-menu',]); //theme_location with underscore !!!
            ?>
            <div id="burger">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
    </header>