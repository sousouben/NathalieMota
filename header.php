<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <?php wp_head(); ?>
</head>

<header>     
  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
    <img class='logo' src="<?php echo get_template_directory_uri() . '/assets/logo/Logo.png'; ?>" alt="Logo de Nathalie Mota">
  </a>
    
  <?php wp_nav_menu(['theme_location' => 'header']) ?>   
  
  <div class="mobile-menu">
        <?php wp_nav_menu(['theme_location' => 'header']) ?>
      </div>
      <div class="hamburger-icon">
        <img src="<?php echo get_template_directory_uri() . '/assets/images/burger.png'; ?> " alt="icon hamburger">
      </div>
      <div class="cross-icon">
        <img src="<?php echo get_template_directory_uri() . '/assets/images/cross.png'; ?> " alt="icon cross">
      </div>
</header>

<body>