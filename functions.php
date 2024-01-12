<?php

function nathaliemota_supports() {
    add_theme_support('title-tag');
    add_theme_support('menus');
    register_nav_menu('header', 'En tête du menu');
    register_nav_menu('footer', 'Pied de page');
    add_theme_support('custom-logo');
}
add_action('after_setup_theme', 'nathaliemota_supports');

// Ajout de la bibliothèque jQuery
function librairie_jquery() {
    wp_enqueue_script('jquery-js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', array('jquery'), '3.7.1', true);
}
add_action('wp_enqueue_scripts', 'librairie_jquery');

function nathaliemota_scripts() {
    wp_enqueue_style('styles', get_template_directory_uri() . '/styles/styles.css');
    wp_enqueue_script('hamburger', get_template_directory_uri() . '/js/hamburger.js', array(), '1.0.0', true);
    wp_enqueue_script('modale', get_template_directory_uri() . '/js/contact-modale.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('miniature', get_template_directory_uri() . '/js/miniature.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('lightbox', get_template_directory_uri() . '/js/lightBox.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('Ajax', get_stylesheet_directory_uri() . '/js/Ajax.js', array('jquery'), '1.0.0', true);
    wp_localize_script('Ajax', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));
          //cdn select2.js pour cutomizer le selecteur filtre et trie
    wp_enqueue_script('select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array('jquery'), '4.1.0', true);
    wp_enqueue_style('select2-css', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css', array(), '4.1.0');
}
add_action('wp_enqueue_scripts', 'nathaliemota_scripts');

/* Chargement photos Ajax load more */

function load_more_photos() {
    $paged = $_POST['page'] + 1;
    $query_vars = json_decode(stripslashes($_POST['query']), true);
    $query_vars['paged'] = $paged;
    $query_vars['posts_per_page'] = 12;
    $query_vars['orderby'] = 'date';

    $photos = new WP_Query($query_vars);
    if ($photos->have_posts()) {
        ob_start();
        while ($photos->have_posts()) {
            $photos->the_post();
            get_template_part('templates_part/photo_block', null);
        }
        wp_reset_postdata();

        $output = ob_get_clean(); 
        echo $output; 
    }
    else {
        ob_clean(); 
        echo 'no_posts';
    }
        die();

}
add_action('wp_ajax_nopriv_load_more', 'load_more_photos');
add_action('wp_ajax_load_more', 'load_more_photos');

function filter_and_sort_photos(){

    $filter = $_POST['filter'];

    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => -1,
        'tax_query' => array(
            'relation' => 'AND',
        )
    );

    // Ajoute chaque filtre a la tax query si elle est definie
    if(!empty($filter['categorie'])){
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field'    => 'slug',
            'terms'    => $filter['categorie'],
        );
    }

    if(!empty($filter['format'])){
        $args['tax_query'][] = array(
            'taxonomy' => 'format',
            'field'    => 'slug',
            'terms'    => $filter['format'],
        );
    }

    if(!empty($filter['annees'])){
        $args['tax_query'][] = array(
            'taxonomy' => 'annees',
            'field'    => 'slug',
            'terms'    => $filter['annees'],
        );
    }

    $query = new WP_Query($args);

    if($query->have_posts()){
        while($query->have_posts()){
            $query->the_post();

            get_template_part('templates_part/photo_block', null);
        }
        wp_reset_postdata();
    } else {
        echo '<p class="selectionFiltre">Aucune photo ne correspond aux critères de recherche spécifiés.</p>';
    }

    die();
}

add_action('wp_ajax_filter_photos', 'filter_and_sort_photos');
add_action('wp_ajax_nopriv_filter_photos', 'filter_and_sort_photos');
