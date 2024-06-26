<?php
/**
 * Archive page where the intervenants are displayed.
 */     
get_header(); 
?>
<main>
    <?php if (have_posts()) : ?>

        <h1><?= __('Intervenants du Master Caweb', 'theme_caweb'); ?></h1>
        
        <?php
            /**
             * Here we want to retrieve each item from the custom taxonomy 'matiere', with get_terms()
             * Then, we create a div.subject-list HTML element containing buttons for each matiere.
             * Each button has the slug of a matiere as id attribute.
             * Below, each intervenant-box presenting a teacher has a class that contains the matieres it teaches.
             * 
             * Then, with Javascript, we can make a system that filter intervants by matiere,
             * with a system of display:none
             */
            $allMatieres = []; 
            foreach(get_terms('matiere') as $matiere){
                $allMatieres[] = [
                    'name'=>$matiere->name, 
                    'slug'=>$matiere->slug,
                ];
            }; 
        ?>

        <div class='subject-list'>
            <button id='all' class='selected-subject'> <?= __('Tous', 'theme_caweb'); ?> </button>
            <?php foreach($allMatieres as $matiere):?>
                <button id="<?= $matiere['slug'];?>"><?= $matiere['name'];?></button>
            <?php endforeach;?>
        </div>

        <ul class='teacher-list'>
            <?php while (have_posts()) : the_post(); ?>
                <?php
                    /**
                     * Retrieves each matiere that the intervenant teaches
                     */
                    $postId = get_the_ID();
                    $postMatieres = [];
                    if(get_the_terms($postId, 'matiere')){
                        foreach(get_the_terms($postId, 'matiere') as $matiere){
                            $postMatieres[] = [
                                'name'=>$matiere->name,
                                'slug'=>$matiere->slug,
                            ];
                        };
                    }
                ?>

                <li class="<?php foreach($postMatieres as $matiere){echo $matiere['slug'].' ';} ?>">
                    
                    <div class='teacher-header'>

                        <figure>
                            <?php the_post_thumbnail("author-format"); ?>
                        </figure>

                        <div>
                            <h2><a href="<?php the_permalink();?>" class="link-to-instructor"><?php the_title(); ?></a></h2>

                            <?php foreach($postMatieres as $matiere):?>
                                <p class='teacher-subject'><?= $matiere['name']; ?></p>
                            <?php endforeach;?>

                            <?php
                                /**
                                 * Display a link to the youtube video of the intervant,
                                 * if there is a video
                                 */ 
                                if(function_exists('get_field') && (get_field("youtube_video")!=null)):
                            ?>
                                <a class='teacher-interview' href="<?= get_field("youtube_video"); ?>">Entretien <i class="fa-solid fa-play"></i></a>
                            <?php endif; ?>

                        </div>
                    </div>

                    <div class='teacher-description'>
                        <?php the_content(); ?>

                        <?php 
                            /**
                             * Display a link to the intervant's LinkedIn,
                             */ 
                            if(function_exists('get_field')): 
                        ?>
                            <a class="teacher-linkedin" href="<?= get_field("linkedin_profile"); ?>"><i class="fa-brands fa-linkedin"></i> <?php the_title();?></a>
                        <?php endif;?> 
                    </div>
                </li>
            <?php endwhile ?>
        </ul>

    <?php else : ?>

        <h1><?= __("Pas d'intervants à présenter", 'theme_caweb'); ?></h1>

    <?php endif; ?>
</main>
<script src='<?php echo get_template_directory_uri()."/js/subject-selector.js"; ?>'></script>
<?php get_footer() ?>