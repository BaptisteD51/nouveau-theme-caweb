<?php get_header()?>
<main>
    <h1>Résultats de la recherche</h1>
    <?php if (have_posts()): ?>
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
        <?php the_posts_pagination();/*echo paginate_links();*/ ?>
    <?php else: ?>
        <p>Pas de résultats à votre requête</p>
    <?php endif; ?>
</main>
<?php get_footer()?>
