<?php get_header() ?>
<main>
    <article>
    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>
            <h1><?php the_title(); ?></h1>
            <figure class='post-image'><?php the_post_thumbnail("medium"); ?></figure>
            <?php the_content(); ?>
        <?php endwhile ?>

        <hr>

        <div class='author-box'>

            <?php
                $authorID = get_the_author_meta('id');
                $acfAuthorID = 'user_'.$authorID; // need to add 'user_' before the id, check on acf doc
                $authPic = get_field('author_picture', $acfAuthorID);
                //echo get_avatar($authorID);
                //the_author_meta('description');

                $authPicAlt = $authPic['alt'];
                $authPicTitle = $authPic['title'];
                $authPicUrl = $authPic['sizes']['author-format'];
            ?>

            <div>
                <h4>
                    <a href="<?php the_field('author_linkedin', $acfAuthorID); ?>" rel="author">
                        <i class="fa-brands fa-linkedin"></i> <?php the_author_meta('display_name'); ?>
                    </a> 
                </h4>
                <figure><img src="<?= $authPicUrl ?>" alt="<?= $authPicAlt?>" title="<?= $authPicTitle ?>"></figure>
            </div>
            <blockquote> <?php the_field('author_biography', $acfAuthorID); ?></blockquote>
        </div>

        <hr>

        <nav class='next-previous-posts'>
            <p><?php echo previous_post_link(); ?></p>
            <p><?php echo next_post_link(); ?></p>
        </nav>

    <?php else : ?>

        <h1>Pas de posts</h1>

    <?php endif; ?>
    </article>
    <aside>
        <h3> Autres articles </h3>
        <ul>
        <?php
        $query = new WP_Query([
            'post_type' => 'post',
            'post_status' => 'publish',
            'post__not_in' => [get_the_id()],
            'orderby' => 'rand',
            'posts_per_page' => 3,
        ]);
        //var_dump($query->get_posts());
        ?>
        <?php if ( $query->have_posts() ) : ?>
            <?php while ( $query->have_posts() ) : $query->the_post();?>
                <li>
                    <a href="<?php the_permalink();?>">
                        <?= the_title();?>
                        <?php the_post_thumbnail("thumbnail"); ?>
                    </a>
                </li>
            <?php endwhile; wp_reset_postdata();?>
        <?php endif;?>
        </ul>
    </aside>
</main>
<?php get_footer() ?>