<?php get_header(); ?>
<main>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
            <h1><?php the_title(); ?></h1>
            <?php the_content();?>
    <?php endwhile; ?>
    <?php else : ?>
        <h1><?= __('Pas de posts', 'theme_caweb');?></h1>
    <?php endif; ?>

</main>
<?php get_footer(); ?>