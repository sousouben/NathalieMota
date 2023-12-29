

    <?php
    // récupération des photos
    $args_photos = array(
        'post_type' => 'photos',
        'posts_per_page' => 12, 
        'orderby' => 'date', 
        'order' => 'ASC',
    );

    
    $photos_query = new WP_Query($args_photos);

    // Vérification si des photos ont été trouvées
    if ($photos_query->have_posts()) :
        while ($photos_query->have_posts()) : $photos_query->the_post();

            
            get_template_part('templates_part/photo_block');

        endwhile;
        wp_reset_postdata(); 
    else :
        // Aucune photo trouvée
        echo "<p class='notPhoto'>Aucune photo trouvée.</p>";
    endif;
    ?>


