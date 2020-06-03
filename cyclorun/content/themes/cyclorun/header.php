<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body>

<header class="header">
    <?php if(is_user_logged_in()): ?>
      <nav class="menu authentified navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="<?= get_bloginfo('url') . '/custom-home/' ?>""><img class="logo" src="<?= get_stylesheet_directory_uri(). '/public/images/logo-complet.png'?>" alt=""></a>
      <?php

        $args = [
          'menu' => 'Menu de Navigation Login',
          'container_class' => 'menu-list'
        ];
    
      
        wp_nav_menu($args);
       ?>
        <button type="button" class="btn"><a href="<?= wp_logout_url(home_url()) ?>">Déconnexion</a></button>
      </nav>
    
    <?php else : ?>
      <nav class="navbar navbar-expand-lg">
        <a class="navbar__brand" href="<?php home_url() ?>"><img src="<?= get_stylesheet_directory_uri(). '/public/images/logo-lightgrey.png'?>" alt=""></a>
        <button type="button" class="btn btn-dark navbar__button"><a class="navbar__link" href="<?= get_bloginfo('url') . '/login/' ?>">Connexion</a></button>
      </nav>
    <?php endif; ?>




</header>