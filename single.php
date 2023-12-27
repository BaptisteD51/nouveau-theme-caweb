<?php get_header() ?>
<main>
    
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
            <h1><?php the_title(); ?></h1>
            <?php the_post_thumbnail("large"); ?>
            <?php the_content(); ?>
    <?php endwhile ?>
    <nav class='next-previous-posts'>
        <span><?php echo previous_post_link();?></span>
        <span><?php echo next_post_link();?></span>
    </nav>
<?php else : ?>
    <h1>Pas de posts</h1>
<?php endif; ?>

</main>
<?php get_footer() ?>