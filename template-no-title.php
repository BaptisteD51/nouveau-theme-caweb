<?php
/**
 * Template Name: Page with no title
 * Template Post Type: page
 */
?>
<?php 
/**
 * By default, WordPress puts an <h1> tag at the top of the page.
 * But for some layouts, we want to put the <h1> elsewhere.
 * With this template, the <h1> must be added manually with gutenberg. 
 */
get_header();
?>
<main>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
            <?php the_content();?>
    <?php endwhile; ?>
<?php else : ?>
    <h1><?= __('Pas de posts', 'theme_caweb');?></h1>
<?php endif; ?>

</main>
<?php get_footer(); ?>