<?php get_header() ?>
<main>

    <h1>Résultats de la recherche</h1>
    <?php get_search_form(); ?>

    <?php if (have_posts()) : ?>
        
        <ul>
            <?php while (have_posts()) : the_post(); ?>
                <li>
                    <h2><?php the_title(); ?></h2>
                    <?php the_post_thumbnail("thumbnail"); ?>
                    <?php the_excerpt(); ?>
                    <a href="<?php the_permalink(); ?>">Lire la suite</a>
                </li>
            <?php endwhile ?>
        </ul>

        <?php the_posts_pagination([
            'prev_text' => '<i class="fa-solid fa-chevron-left"></i>',
            'next_text' => '<i class="fa-solid fa-chevron-right"></i>',
        ]);?>

    <?php else : ?>

        <p>Pas de résultats à votre requête</p>
        
    <?php endif; ?>
</main>
<?php get_footer() ?>