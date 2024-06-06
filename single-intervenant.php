<?php

/**
 * Page where a single intervenant is displayed.
 */
get_header();
?>
<main>
    <article>
        <?php if (have_posts()) : ?>

            <?php while (have_posts()) : the_post(); ?>
                <?php
                /**
                 * Retrieves each matiere that the intervenant teaches
                 */
                $postId = get_the_ID();
                $postMatieres = [];
                if (get_the_terms($postId, 'matiere')) {
                    foreach (get_the_terms($postId, 'matiere') as $matiere) {
                        $postMatieres[] = [
                            'name' => $matiere->name,
                            'slug' => $matiere->slug,
                        ];
                    };
                }
                ?>

                <h1 class='instructor-name'><?php the_title(); ?></h1>

                <?php foreach ($postMatieres as $matiere) : ?>
                    <p class='teacher-subject'><?= $matiere['name']; ?></p>
                <?php endforeach; ?>

                <figure class="instructor-picture">
                    <?php the_post_thumbnail("author-format"); ?>
                </figure>

                <div class='teacher-description'>
                    <?php the_content(); ?>

                    <?php
                    /**
                     * Display a link to the intervant's LinkedIn,
                     */
                    if (function_exists('get_field')) :
                    ?>
                        <p><a class="teacher-linkedin" href="<?= get_field("linkedin_profile"); ?>"><i class="fa-brands fa-linkedin"></i> <?php the_title(); ?></a></p>
                    <?php endif; ?>

                    <?php
                    /**
                     * Display a link to the youtube video of the intervant,
                     * if there is a video
                     */
                    if (function_exists('get_field') && (get_field("youtube_video") != null)) :
                    ?>
                        <p><a class='teacher-interview' href="<?= get_field("youtube_video"); ?>">Entretien <i class="fa-solid fa-play"></i></a></p>
                    <?php endif; ?>
                </div>
            <?php endwhile ?>

        <?php else : ?>

            <h1><?= __("Pas d'intervants à présenter", 'theme_caweb'); ?></h1>

        <?php endif; ?>
    </article>
</main>
<?php get_footer() ?>