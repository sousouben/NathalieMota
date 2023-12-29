<?php
// Récupération des informations
$photo = get_the_post_thumbnail_url(null, "large");
$photo_titre = get_the_title();
$post_url = get_permalink();
$reference = get_field('reference');
$categories = get_the_terms(get_the_ID(), 'categorie');
$categorie_name = $categories[0]->name;

// Modification du titre en majuscules
$PHOTO_TITRE = strtoupper($photo_titre);

// Vérification si la catégorie existe avant de la modifier en majuscules
$CATEGORIE_NAME = $categories ? strtoupper($categorie_name) : '';
?>

<div class="photo-block">
    <img class="photo-image" src="<?php echo esc_url($photo); ?>" alt="<?php echo esc_attr($photo_titre); ?>">

    <div class="photo-overlay">

        <h2 class="photo-title"><?php echo esc_html($photo_titre); ?></h2>
        <h3 class="photo-categorie"><?php echo esc_html($CATEGORIE_NAME); ?></h3>

        <div class="eye-icon">
            <a class="eye-link" href="<?php echo esc_url($post_url); ?>">
                <img class="eye-image" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/icon_eye.svg" alt="Icone oeil pour voir la photo">
            </a>
        </div>
        <div class="fullscreen-icon" data-full="<?php echo esc_url($photo); ?>" data-category="<?php echo esc_attr($categorie_name); ?>" data-reference="<?php echo esc_attr($reference); ?>">
            <img class="fullscreen-image" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/fullscreen.svg" alt="Icone fullscreen pour voir la photo en grand">
        </div>
    </div>
</div>
