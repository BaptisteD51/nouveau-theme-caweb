<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>
	<!-- Script pour lier Matomo à CookieYes -->
	<script>
		var _paq = window._paq = window._paq || [];
		_paq.push(['trackPageView']);
		_paq.push(['enableLinkTracking']);
		(function() {
			var u="//webomat.unistra.fr/";
			_paq.push(['setTrackerUrl', u+'matomo.php']);
			_paq.push(['setSiteId', '42']);
			var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
			g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
		})();
	</script>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open();?>
    <header>
        <div class="header-wrapper">
            <div class="site-logo">
                <?php 
                    /**
                     * As the Webdesigners wanted a different logo for the mobile display,
                     * we use the classic WordPress logo for the desktop logo, echoed with the function the_custom_logo(),
                     * and we use the site icon for the mobile logo.
                     * We use get_site_icon_url() to get the icon url and use it as an <img> src.
                     * 
                     * Then, in CSS we use display:none; with media queries to display the one we want,
                     * according to the screen size.
                     */
                    the_custom_logo();
                ?>

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

            <?php caweb_theme_custom_language_switcher();?>
        </div>
    </header>