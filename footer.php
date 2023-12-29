    <footer>
        <?php
            wp_nav_menu(['theme_location'=>'footer-menu','container' => 'nav']);//theme_location with underscore !!!
            get_search_form();
        ?>
    </footer>
<?php wp_footer(); ?>
</body>
</html>