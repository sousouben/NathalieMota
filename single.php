<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage NathalieMota
 * @since Nathalie Mota 1.0
 */

get_header();

// Inclusion d'un template part spécifique pour les articles simples
get_template_part('single_photo');

get_footer();
