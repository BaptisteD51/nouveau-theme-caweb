<?php
/**
 * Custom made function working with ACF fields to display an author box in an article for a WordPress author. 
 */
function the_author_box()
{
    /** If ACF is active and if the field display_author_box is checked, display the author-box */
    if (function_exists('get_field') && (get_field("display_author_box") != [])) {
        /** Retrieves the post author id */
        $authorID = get_the_author_meta('id');

        /** Need to add 'user_' before the id, in order to make it work with ACF */
        $acfAuthorID = 'user_' . $authorID;

        $authPic = get_field('author_picture', $acfAuthorID);

        /** Checks if all custom fields are filled in order to display */
        if ($authPic && get_field('author_linkedin', $acfAuthorID) && get_field('author_biography', $acfAuthorID)) {
            /** The ACF picture field returns a table with infos about the image */
            $authPicAlt = $authPic['alt'];
            $authPicTitle = $authPic['title'];
            $authPicUrl = $authPic['sizes']['author-format'];
            /** author-format is the custom image size resgistered in functions.php */

            /** ob_get_start and ob_get_clean are useful native php function to generate html */
            ob_start(); ?>
            <div class="author-box">
                <div>
                    <h4>
                        <a href="<?php the_field('author_linkedin', $acfAuthorID); ?>" rel="author">
                            <i class="fa-brands fa-linkedin"></i>
                            <?php
                            the_author_meta('display_name');
                            /** A WP function that echo the 'Display name publicly as' of WP user profile */ ?>
                        </a>
                    </h4>

                    <figure><img src="<?= $authPicUrl ?>" alt="<?= $authPicAlt ?>" title="<?= $authPicTitle ?>"></figure>
                </div>

                <blockquote> <?php the_field('author_biography', $acfAuthorID); ?></blockquote>
            </div>
            <?php $html = ob_get_clean();

            echo $html;
            return $html;
        } else {
            return;
        }
    } else {
        return;
    }
}