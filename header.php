<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <header>
    <!-- Logo -->
    <?php
    $custom_logo_id = get_theme_mod('custom_logo');
    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');

    if ($logo) :
    ?>
      <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
        <img src="<?php echo esc_url($logo[0]); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
      </a>
    <?php else : ?>
      <h1><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html(get_bloginfo('name')); ?></a></h1>
    <?php endif; ?>
    <!-- Fin Logo -->

    <!-- Menu de navigation -->
    <?php
    $menu_args = array(
      'theme_location' => 'header',
      'container'      => 'nav',
      'container_class'=> 'main-menu',
    );

    wp_nav_menu($menu_args);
    ?>

    <!-- Mobile Menu -->
    <div class="mobile-menu">
      <?php wp_nav_menu($menu_args); ?>
    </div>
    <div class="hamburger-icon">
      <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/burger.png'); ?>" alt="Icon Hamburger">
    </div>
    <div class="cross-icon">
      <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/cross.png'); ?>" alt="Icon Cross">
    </div>
  </header>

  <!-- Le reste de votre contenu va ici -->
