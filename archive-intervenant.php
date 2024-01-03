<?php get_header() ?>
<main>
    <?php if (have_posts()) : ?>

        <h1>Intervenants du Master Caweb</h1>

        <ul>
            <?php while (have_posts()) : the_post(); ?>
                <li>
                    <h2><?php the_title(); ?></h2>
                    <?php the_post_thumbnail("thumbnail"); ?>
                    <?php the_content(); ?>
                </li>
            <?php endwhile ?>
        </ul>

    <?php else : ?>

        <h1>Pas d'intervants à présenter</h1>

    <?php endif; ?>
</main>
<?php get_footer() ?>