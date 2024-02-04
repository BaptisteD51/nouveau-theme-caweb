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
            <div class="site-logo">
                <?php the_custom_logo();?>
                <a href="<?= get_site_url() ?>" class="custom-icon-link" rel="home" aria-current="page">
                    <img src="<?=get_site_icon_url()?>" height="50px" width="50px">
                    <?= bloginfo('name');?>
                </a>
            </div>
            <?php
            wp_nav_menu(['theme_location' => 'main-menu', 'container' => 'nav', 'container_id' => 'main-menu-wrapper', 'container_class' => 'main-menu-wrapper', 'menu_id' => 'main-menu',]); //theme_location with underscore !!!
            ?>
            <div id="burger">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
    </header>