<?php get_header() ?>
<main>
    <?php if (have_posts()) : ?>

        <h1>Derniers posts</h1>

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

        <?php the_posts_pagination(['container' => 'nav']); ?>

    <?php else : ?>

        <h1>Pas de posts</h1>

    <?php endif; ?>
</main>
<?php get_footer() ?>