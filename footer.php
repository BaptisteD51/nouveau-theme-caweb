    <footer>
        <div id="footer-wrapper">

            <div class="footer-element-container">
                <h4><?= __("Master Caweb", 'theme_caweb'); ?></h4>
                <?php
                    wp_nav_menu(['theme_location'=>'footer-menu','container' => 'nav','container_id'=>'footer-menu-wrapper','container_class'=>'footer-menu-wrapper','menu_id'=>'footer-menu',]);
                ?>
            </div>

            <div class="footer-element-container">
            <h4><?= __("Rejoignez-nous", 'theme_caweb'); ?></h4>
                <?php
                    wp_nav_menu(['theme_location' => 'social-menu', 'container' => 'nav', 'container_id' => 'social-menu-wrapper', 'container_class' => 'social-menu-wrapper', 'menu_id' => 'social-menu',]);
                ?>
            </div>

            <div class="footer-element-container">
            <h4><?= __("Contactez-nous !", 'theme_caweb'); ?></h4>
                <?php
                    wp_nav_menu(['theme_location' => 'contact-menu', 'container' => 'nav', 'container_id' => 'contact-menu-wrapper', 'container_class' => 'contact-menu-wrapper', 'menu_id' => 'contact-menu',]);
                ?>
            </div>

            <div class="footer-element-container">
                <?= get_sidebar('column-footer-sidebar');?>
            </div>

        </div>
        <div id="bottom-footer-wrapper">
            <?= get_sidebar('bottom-footer-sidebar');?>
        </div>
    </footer>
<?php wp_footer(); ?>
</body>
</html>