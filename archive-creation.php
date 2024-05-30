<?php 
get_header(); 
?>
<main class='article-page'>
    <?php if (have_posts()) : ?>

        <div class="archive-title">
            <h1><?= __('Créations étudiantes', 'theme_caweb'); ?></h1>
            <?php get_search_form(); ?>
        </div>

        <ul class="article-list">

            <?php while (have_posts()) : the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>">
                        <?php caweb_theme_the_post_thumbnail(); ?>
                        <h2><?php the_title(); ?></h2>
                        <p class="post-excerpt"><?= get_the_excerpt(); ?></p>
                    </a>
                </li>
            <?php endwhile ?>

        </ul>

        <?php the_posts_pagination([
            'prev_text' => '<i class="fa-solid fa-chevron-left"></i>',
            'next_text' => '<i class="fa-solid fa-chevron-right"></i>',
        ]);?>

    <?php else : ?>

        <h1><?= __("Pas de créations étudiantes à afficher", 'theme_caweb'); ?></h1>

    <?php endif; ?>
</main>
<?php get_footer() ?>

