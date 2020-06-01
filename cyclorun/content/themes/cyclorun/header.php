<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body>

<header class="header">
    <nav class="navbar authentified navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#"><img class="logo" src=" <?= get_stylesheet_directory_uri() .'/public/images/logo-complet.png';?>" alt=""></a>
      <a class="navbar__item__is-active" href="<?php echo get_permalink(7); ?>">Home</a>
      <a class="navbar__item" href="#">Profil</a>
      <a class="navbar__item" href="#">Participer à une sortie</a>
      <a class="navbar__item" href="<?php echo get_permalink(16); ?>">Organiser une sortie</a>
      <?php if(is_user_logged_in()): ?>
         <button type="logout-button" class="btn"><?= wp_loginout(home_url());?></button>
      <?php  else: ?>
        <button type="button" class="btn btn-dark connexion-button"><a href="<?= get_bloginfo('url') . '/login/' ?>">Connexion</a></button>
       <?php endif; ?>
    

    </nav>
</header>