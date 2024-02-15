<?php get_header() ?>
<main>
    <?php if (have_posts()) : ?>

        <h1>Intervenants du Master Caweb</h1>
        <?php 
            $allMatieres = []; 
            foreach(get_terms('matiere') as $matiere){
                $allMatieres[] = [
                    'name'=>$matiere->name, 
                    'slug'=>$matiere->slug,
                ];
            }; 
        ?>
        <?php foreach($allMatieres as $matiere):?>
            <button id="<?= $matiere['slug'];?>"><?= $matiere['name'];?></button>
        <?php endforeach;?>

        <ul class='teacher-list'>
            <?php while (have_posts()) : the_post(); ?>
                <?php 
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
                <li class="<?php foreach($postMatieres as $matiere){echo $matiere['slug'];} ?>">
                    <div class='teacher-header'>
                        <figure>
                            <?php the_post_thumbnail("author-format"); ?>
                        </figure>
                        <div>
                        <h2><?php the_title(); ?></h2>
                        <?php foreach($postMatieres as $matiere):?>
                            <p class='teacher-subject'><?= $matiere['name']; ?></p>
                        <?php endforeach;?>
                        <?php if(get_field("youtube_video")!=null):?>
                            <a class='teacher-interview' href="<?= get_field("youtube_video"); ?>">Entretien <i class="fa-solid fa-play"></i></a>
                        <?php endif; ?>
                        </div>
                    </div>
                    <div class='teacher-description'>
                        <?php the_content(); ?>
                        <a class="teacher-linkedin" href="<?= get_field("linkedin_profile"); ?>"><i class="fa-brands fa-linkedin"></i> <?php the_title();?></a>
                    </div>
                </li>
            <?php endwhile ?>
        </ul>

    <?php else : ?>

        <h1>Pas d'intervants à présenter</h1>

    <?php endif; ?>
</main>
<?php get_footer() ?>