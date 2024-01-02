<?php
/**
 * Template Name: Post with no author info
 * Template Post Type: post
 */
?>
<?php get_header() ?>
<main>
    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>
            <h1><?php the_title(); ?></h1>
            <figure><?php the_post_thumbnail("large"); ?></figure>
            <?php the_content(); ?>
        <?php endwhile ?>

        <nav class='next-previous-posts'>
            <p><?php echo previous_post_link(); ?></p>
            <p><?php echo next_post_link(); ?></p>
        </nav>

    <?php else : ?>

        <h1>Pas de posts</h1>

    <?php endif; ?>

</main>
<?php get_footer() ?>