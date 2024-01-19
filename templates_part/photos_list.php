<div id="dropdown">
<?php
// Affichage des taxonomies
$taxonomies = [
    'categorie' => 'CATÉGORIES',
    'format'    => 'FORMATS',
    'annees'    => 'TRIER PAR',
];

foreach ($taxonomies as $taxonomy_slug => $label) {
    $terms = get_terms($taxonomy_slug);

    if (!is_wp_error($terms) && !empty($terms)) {
        echo "<select id='{$taxonomy_slug}' class='custom-select taxonomy-select'>";
        echo "<option value=''>{$label}</option>";

        foreach ($terms as $term) {
            echo "<option value='{$term->slug}'>{$term->name}</option>";
        }

        echo "</select>";
    }
}
?>
</div>
<div id="galerie">
<?php
// récupération des photos
$args_photos = array(
    'post_type' => 'photos',
    'posts_per_page' => 12, 
    'orderby' => 'date', 
    'order' => 'ASC',
);

$photos_query = new WP_Query($args_photos);

//La fonction wp_localize_script permet de passer des données du côté serveur (PHP) au côté client (JavaScript).
wp_localize_script('Ajax', 'ajaxChargerPlus', array(
    'ajaxurl' => admin_url('admin-ajax.php'),
    'query_vars' => json_encode($args_photos)
    )
);
 //Une boucle vérifie si des photos sont disponibles. Si oui, elle itère sur chaque photo, initialise des variables et inclut le modèle de bloc de photo spécifié par get_template_part.
if ($photos_query->have_posts()) :

set_query_var('photo_block_args', array('context' => 'front-page'));
while ($photos_query->have_posts()) :
$photos_query->the_post();
get_template_part('templates_part/photo_block', get_post_format()); 
?>

<?php
endwhile; 
wp_reset_postdata(); 
else :
echo 'Aucune photo trouvée.';
endif; 
?>

<div id="btnchargPlus">
<button id="imagePlus" data-page="1" data-url="<?php echo admin_url('admin-ajax.php'); ?>">Charger plus</button>
</div>
</div> 