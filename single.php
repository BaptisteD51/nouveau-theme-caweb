<?php 
/**
 * Template for posts
 */
get_header();
?>
<main>
    <article>
    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>
            <?php
                /** Retrieves the post categories */
                $categories = [];
                foreach(get_the_category() as $categorie){
                    $categories[] = $categorie->name;
                }
            ?>

            <h1><?php the_title(); ?></h1>
            
            <div class="post-meta">
                <p class="post-categories">
                    <?php foreach($categories as $categorie):?>
                        <span><?= $categorie; ?></span>
                    <?php endforeach;?>
                </p>
                <time><?php the_date();?></time>
            
            </div>

            <?php
                /**
                 * If ACF is activated and if the field display_post_thumbnail is checked,
                 * display the post thumbnail at the top of the post
                 * 
                 * If ACF in't active, display the post_thumbnail anyway
                 */ 
                if(function_exists('get_field') && (get_field("display_post_thumbnail")!=[])): 
            ?>
                <figure class='post-image'><?php the_post_thumbnail("medium"); ?></figure>
            <?php elseif(!function_exists('get_field')):?>
                <figure class='post-image'><?php the_post_thumbnail("medium"); ?></figure>
            <?php endif;?>

            <?php the_content(); ?>

        <?php endwhile ?>

        <?php
            /** If ACF is active and if the field display_author_box is checked, display the author-box */ 
            if(function_exists('get_field') && (get_field("display_author_box")!=[])): 
        ?>
            <div class='author-box'>

                <?php
                    /** Retrieves the post author id */
                    $authorID = get_the_author_meta('id');

                    /** Need to add 'user_' before the id, in order to make it work with ACF */
                    $acfAuthorID = 'user_'.$authorID;

                    $authPic = get_field('author_picture', $acfAuthorID);

                    /** The ACF picture field returns a table with infos about the image */
                    $authPicAlt = $authPic['alt'];
                    $authPicTitle = $authPic['title'];
                    $authPicUrl = $authPic['sizes']['author-format'] /** author-format is the custom image size resgistered in functions.php */;
                ?>

                <div>
                    <h4>
                        <a href="<?php the_field('author_linkedin', $acfAuthorID); ?>" rel="author">
                            <i class="fa-brands fa-linkedin"></i> 
                            <?php 
                                the_author_meta('display_name');
                                /** A WP function that echo the 'Display name publicly as' of WP user profile */?>
                        </a> 
                    </h4>

                    <figure><img src="<?= $authPicUrl ?>" alt="<?= $authPicAlt?>" title="<?= $authPicTitle ?>"></figure>
                </div>
                
                <blockquote> <?php the_field('author_biography', $acfAuthorID); ?></blockquote>
            </div>
        <?php endif; ?>
        
        <div class="next-previous-posts">
            <h3> <?= __("Articles précedents et suivants", 'theme_caweb'); ?></h3>
            
            <ul class='next-previous-posts'>
                    <?php if(get_next_post()!=""): /** Checks is there is a next post */?>
                        <?php $nextPostId = get_next_post()->ID; ?>
                        <li>
                            <a href="<?= get_permalink($nextPostId); ?>">
                                <?= get_the_post_thumbnail($nextPostId, 'thumbnail');?>
                                <h4><i class="fa-solid fa-arrow-left"></i> <?= get_next_post()->post_title; ?></h4>
                            </a> 
                        </li>
                    <?php endif;?>

                    <?php if(get_previous_post()!=""): /** Checks is there is a previous post */?>
                        <?php $previousPostId = get_previous_post()->ID; ?>
                        <li>
                            <a href="<?= get_permalink($previousPostId); ?>">
                                <?= get_the_post_thumbnail($previousPostId, 'thumbnail');?>
                                <h4><?= get_previous_post()->post_title; ?> <i class="fa-solid fa-arrow-right"></i></h4>
                            </a>
                        </li>
                    <?php endif;?>
            </ul>
        </div>

    <?php else : ?>

        <h1><?= __("Pas de posts", 'theme_caweb'); ?></h1>

    <?php endif; ?>
    
    <div class='other-posts'>
        <h3> <?= __("Autres articles", 'theme_caweb'); ?></h3>
        
        <ul>
            <?php
            /**
             * The WP_Query object is used to make a query to the database.
             * Here we want to get 4 random posts to show to the user.
             * Then, we can use the WP loop system on the query.
             */
            $query = new WP_Query([
                'post_type' => 'post',
                'post_status' => 'publish',

                /** We don't want the current post to be displayed */
                'post__not_in' => [get_the_id()], 
                
                /** We want random posts, not the 4 last posts */
                'orderby' => 'rand',
                
                'posts_per_page' => 4,
            ]);
            ?>
            <?php if($query->have_posts()) : ?>
                <?php while($query->have_posts()): $query->the_post();?>
                    <li>
                        <a href="<?php the_permalink();?>">
                            <?php the_post_thumbnail("thumbnail"); ?>
                            <h4><?= the_title();?></h4>
                        </a>
                    </li>
                <?php 
                    endwhile; wp_reset_postdata(); 
                    /** 
                     * After having looped through the query,
                     * we use wp_reset_postdata to go back to the current context.
                     */
                ?>
            <?php endif;?>
        </ul>
    <div>
    </article>
</main>
<?php get_footer() ?>