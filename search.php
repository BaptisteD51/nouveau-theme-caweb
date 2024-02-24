<?php get_header() ?>
<main>

    <h1><?= __("Résultats de la recherche", 'theme_caweb'); ?></h1>
    <?php get_search_form(); ?>

    <?php if (have_posts()) : ?>
        
        <ul class='article-list'>
        <?php while (have_posts()) : the_post(); ?>
                <?php $postType = get_post_type();?>
                <li class='<?= $postType ?>'>
                    <?php if($postType == 'post'): ?> 
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
                    <?php else: ?>
                        <a href="<?php the_permalink(); ?>">
                            <h2><?php the_title(); ?></h2>
                            <p class="post-excerpt"><?= get_the_excerpt(); ?></p>
                        </a>
                    <?php endif; ?>
                </li>
            <?php endwhile ?>
        </ul>

        <?php the_posts_pagination([
            'prev_text' => '<i class="fa-solid fa-chevron-left"></i>',
            'next_text' => '<i class="fa-solid fa-chevron-right"></i>',
        ]);?>

    <?php else : ?>

        <p><?= __("Pas de résultats à votre requête", 'theme_caweb'); ?></p>
        
    <?php endif; ?>
</main>
<?php get_footer() ?>