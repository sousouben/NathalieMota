<div class="banner">
    <h1>Photographe event</h1>

    <?php
    // Requête pour récupérer une image aléatoire du type de publication 'photos'
    $photo_args = array(
        'post_type'      => 'photos',
        'posts_per_page' => 1,
        'orderby'        => 'rand',
    );

    // Initialisation de la requête
    $photo_query = new WP_Query($photo_args);

     // Vérification s'il y a des images
     if ($photo_query->have_posts()) {
        while ($photo_query->have_posts()) {
            $photo_query->the_post();
            echo get_the_post_thumbnail(get_the_ID(), 'full'); 
        }
        wp_reset_postdata();
    }
    ?>
</div>

