<?php //Custom search form. Isn't necessary to create a searchform.php ?> 
<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) );?>">
        <label for="s">Moteur de recherche : </label>
        <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="Votre recherche" />
        <input type="submit" id="searchsubmit" value="Rechercher" />
</form>
