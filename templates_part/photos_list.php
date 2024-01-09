<?php
// récupération des photos
$args_photos = array(
    'post_type' => 'photos',
    'posts_per_page' => 8, 
    'orderby' => 'date', 
    'order' => 'ASC',
);

$photos_query = new WP_Query($args_photos);

wp_localize_script('Ajax', 'ajaxChargerPlus', array(
    'ajaxurl' => admin_url('admin-ajax.php'),
    'query_vars' => json_encode($args_photos)
    )
);

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