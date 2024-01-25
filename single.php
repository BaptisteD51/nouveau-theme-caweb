<?php get_header() ?>
<main>
    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>
            <h1><?php the_title(); ?></h1>
            <figure><?php the_post_thumbnail("medium"); ?></figure>
            <?php the_content(); ?>
        <?php endwhile ?>

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

            <p> Auteur : </p>
            <h4> <?php the_author_meta('display_name'); ?> </h4>
            <p><img src="<?= $authPicUrl ?>" alt="<?= $authPicAlt?>" title="<?= $authPicTitle ?>"></p>
            <p> <?php the_field('author_biography', $acfAuthorID); ?></p>
        </div>

        <nav class='next-previous-posts'>
            <p><?php echo previous_post_link(); ?></p>
            <p><?php echo next_post_link(); ?></p>
        </nav>

    <?php else : ?>

        <h1>Pas de posts</h1>

    <?php endif; ?>

</main>
<?php get_footer() ?>