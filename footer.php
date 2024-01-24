    <footer>
        <?php
            wp_nav_menu(['theme_location'=>'footer-menu','container' => 'nav','container_id'=>'footer-menu-wrapper','menu_id'=>'footer-menu',]);//theme_location with underscore !!!
            wp_nav_menu(['theme_location' => 'social-menu', 'container' => 'nav', 'container_id' => 'social-menu-wrapper', 'menu_id' => 'social-menu',]);
            wp_nav_menu(['theme_location' => 'contact-menu', 'container' => 'nav', 'container_id' => 'contact-menu-wrapper', 'menu_id' => 'contact-menu',]);
            get_search_form();
        ?>
    </footer>
<?php wp_footer(); ?>
</body>
</html>