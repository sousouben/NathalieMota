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
}
add_action('wp_enqueue_scripts', 'nathaliemota_scripts');

/* Chargement photos Ajax load more */

function load_more_photos() {
    $paged = $_POST['page'] + 1;
    $query_vars = json_decode(stripslashes($_POST['query']), true);
    $query_vars['paged'] = $paged;
    $query_vars['posts_per_page'] = 8;
    $query_vars['orderby'] = 'date';

    $photos = new WP_Query($query_vars);
    if ($photos->have_posts()) {
        ob_start();
        while ($photos->have_posts()) {
            $photos->the_post();
            get_template_part('templates_part/photo_block', null);
        }
        wp_reset_postdata();

        $output = ob_get_clean(); // Get the buffer and clean it
        echo $output; // Echo the output
    }
    else {
        ob_clean(); // Clean any previous output
        echo 'no_posts';
    }
        die();

}
add_action('wp_ajax_nopriv_load_more', 'load_more_photos');
add_action('wp_ajax_load_more', 'load_more_photos');