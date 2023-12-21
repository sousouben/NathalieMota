<?php
/**
 * Template Name: Single_photo
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage NathalieMota
 * @since Nathalie Mota 1.0
 */

get_header();

// Get ACF fields
$photo = get_field('photo');
$reference = get_field('reference');
$type = get_field('type');
$title = get_the_title(); // Ajout de cette ligne pour récupérer le titre de la photo

// Get taxonomy terms
$annee_terms = get_the_terms(get_the_ID(), 'annees');
$categories = get_the_terms(get_the_ID(), 'categorie');
$format_terms = get_the_terms(get_the_ID(), 'format');

$next_photo = get_next_post();
$previous_photo = get_previous_post();
$previous_thumbnail = $previous_photo ? get_the_post_thumbnail_url($previous_photo->ID, 'thumbnail') : '';
$next_thumbnail = $next_photo ? get_the_post_thumbnail_url($next_photo->ID, 'thumbnail') : '';

?>
<section class="catalogue">
    <div class="infoPhoto">
    <div class="containerPhoto" data-reference="<?php echo esc_attr($reference); ?>">    
        <img src="<?php echo esc_url($photo); ?>" alt="<?php echo esc_attr($title); ?>">
    </div>

    <div class="entry-content">
        <h2><?php echo esc_html($title); ?></h2>
        <?php    
            if ($reference) {
                echo '<p>Reference : ' . esc_html($reference) . '</p>';
            }

            if ($categories) {
                echo '<p>Catégorie : ';
                foreach ($categories as $category) {
                    echo esc_html($category->name) . ' ';
                }
                echo '</p>';
            }

            if ($format_terms) {
                echo '<p>Format : ';
                foreach ($format_terms as $format) {
                    echo esc_html($format->name) . ' ';
                }
                echo '</p>';
            }

            if ($type) {
                echo '<p>Type : ' . esc_html($type) . '</p>';
            }
    
            if ($annee_terms) {
                echo '<p>Année : ';
                foreach ($annee_terms as $term) {
                    echo esc_html($term->name) . ' ';
                }
                echo '</p>';
            }

        ?>
    </div>
    </div>
    <div class="navContact">
        <div class="contact">
            <p class="interesser"> Cette photo vous intéresse ? </p>
            <button id="boutonContact" data-reference="<?php echo $reference; ?>">Contact</button>
        </div>
        <div class="navigationPhoto">
        <div class="miniaturePhoto" id="miniaturePhoto"></div>
        <div class="arrowNav">
        <?php if (!empty($previous_photo)) : ?>
            <img class="arrow arrow-left" src="<?php echo get_theme_file_uri() . '/assets/images/left.png'; ?>" alt="Photo précédente" data-thumbnail-url="<?php echo $previous_thumbnail; ?>" data-target-url="<?php echo esc_url(get_permalink($previous_photo->ID)); ?>">
        <?php endif; ?>

        <?php if (!empty($next_photo)) : ?>
            <img class="arrow arrow-right" src="<?php echo get_theme_file_uri() . '/assets/images/right.png'; ?>" alt="Photo suivante" data-thumbnail-url="<?php echo $next_thumbnail; ?>" data-target-url="<?php echo esc_url(get_permalink($next_photo->ID)); ?>">
        <?php endif; ?>
    </div>
        </div>
    </div>
    <div class="autre_photos">
        <div class="likePhotos">
            <h3>Vous aimerez AUSSI</h3>
        </div>
        <div class="card_photos"></div>
        <button id="button_card_photos" class="button_card">Toutes les photos</button>
    </div>

</section>

<?php
get_footer();
?>
