<?php get_header()?>
<main>
    Hello CAWEB !
    <?php if (have_posts()): ?>
        <h1>Derniers posts</h1>
        <ul>
        <?php while (have_posts()): the_post();?>
            <li>
                <h3><?php the_title();?></h3>
                <?php the_post_thumbnail("medium");?> 
                <?php the_excerpt();?>
                <a href="<?php the_permalink(); ?>">Lire la suite</a>
            </li>
        <?php endwhile ?>
        </ul>
        <?php the_posts_pagination();?>
        <?php /*echo previous_posts_link();*/?>
        <?php /*echo next_posts_link();*/?>
    <?php else: ?>
        <h1>Pas de posts</h1>
    <?php endif; ?>
</main>
<?php get_footer()?>

<!-- in_category() pour faire une condition sur l'ID de la catégorie 
the_category_ID() pour afficher l'ID de catégorie (198 pour intervenant)
-->
