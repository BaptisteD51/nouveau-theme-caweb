<?php get_header() ?>
<main>
    <?php if (have_posts()) : ?>

        <div class="archive-title">
            <h1><?= __('Blog', 'theme_caweb'); ?></h1>
            <?php get_search_form(); ?>
        </div>

        <ul class="article-list">

            <?php while (have_posts()) : the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail("thumbnail"); ?>
                        <h2><?php the_title(); ?></h2>
                        <div class="post-meta">
                            <div class="post-categories">
                                <?php $categories = get_the_category(); foreach($categories as $categorie) :?>
                                    <p> <?= $categorie->name; ?></p>        
                                <?php endforeach; ?>
                            </div>

                            <time><?php echo get_the_date('Y-m-d'); ?></time>
                        </div>
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

        <h1><?= __("Pas d'articles à afficher", 'theme_caweb'); ?></h1>

    <?php endif; ?>
</main>
<?php get_footer() ?>

