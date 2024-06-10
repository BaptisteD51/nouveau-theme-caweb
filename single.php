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

        <?php the_author_box(); ?>
        
        <div class="next-previous-posts">
            <h3> <?= __("Articles précedents et suivants", 'theme_caweb'); ?></h3>
            
            <ul class='next-previous-posts'>
                    <?php if(get_next_post()!=""): /** Checks is there is a next post */?>
                        <?php $nextPostId = get_next_post()->ID; ?>
                        <li>
                            <a href="<?= get_permalink($nextPostId); ?>">
                                <?php caweb_theme_the_post_thumbnail($nextPostId)?>
                                <h4><i class="fa-solid fa-arrow-left"></i> <?= get_next_post()->post_title; ?></h4>
                            </a> 
                        </li>
                    <?php endif;?>

                    <?php if(get_previous_post()!=""): /** Checks is there is a previous post */?>
                        <?php $previousPostId = get_previous_post()->ID; ?>
                        <li>
                            <a href="<?= get_permalink($previousPostId); ?>">
                                <?php caweb_theme_the_post_thumbnail($previousPostId);?>
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
                            <?php caweb_theme_the_post_thumbnail();?>
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