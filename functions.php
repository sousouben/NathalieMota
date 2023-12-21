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
}
add_action('wp_enqueue_scripts', 'nathaliemota_scripts');
