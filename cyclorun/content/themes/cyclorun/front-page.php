
<?php

get_header();

// todo Ajouter 2 3 sorties pour avoir un premier visuel et donner envie de s'inscrire


?>

<main class="home-main">
    <div id="carousel-left" class="carousel slide home-main__left" data-ride="carousel" data-interval="1000">
      <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?= get_stylesheet_directory_uri() . '/public/images/cycl/1.jpg'?>" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="<?= get_stylesheet_directory_uri() . '/public/images/cycl/2.jpg'?>" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="<?= get_stylesheet_directory_uri() . '/public/images/cycl/3.jpg'?>" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="<?= get_stylesheet_directory_uri() . '/public/images/cycl/4.jpg'?>" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="<?= get_stylesheet_directory_uri() . '/public/images/cycl/5.jpg'?>" class="d-block w-100" alt="...">
        </div>
      </div>
    </div>

    <div class="home-main__welcome">
      <div class="home-main__welcome__message">
        <p> En France, il y a</p>
        <div id="carousel-sentence" class="carousel slide home-main__welcome__sentence" data-ride="carousel" data-interval="1000">
          <div class="carousel-inner">
              <div class="carousel-item active">
                  <p><span>12 Millions de runners</span><p>
              </div>
              <div class="carousel-item">
                <p><span>9 Millions de cyclistes<span></p>
              </div>
          </div>
        </div>
      </div>
      <div class="home-main__welcome__wrap">
        <p>Pourquoi,</p>
        <div id="carousel-word" class="carousel slide home-main__welcome__word" data-ride="carousel" data-interval="1000">
          <div class="carousel-inner">
              <div class="carousel-item active">
                  <p><span>courir</span><p>
              </div>
              <div class="carousel-item">
                <p><span>pedaler</span></p>
              </div>
          </div>
        </div>
        <p>tout seul ?</p>
      </div>

    </div>
   
      <div class="home-main__welcome__submessage">

      </div>
    </div>

    <div id="carousel-right" class="carousel slide home-main__right" data-ride="carousel" data-interval="1000">
      <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?= get_stylesheet_directory_uri() . '/public/images/run/1.jpg'?>" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="<?= get_stylesheet_directory_uri() . '/public/images/run/2.jpg'?>" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="<?= get_stylesheet_directory_uri() . '/public/images/run/3.jpg'?>" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="<?= get_stylesheet_directory_uri() . '/public/images/run/4.jpg'?>" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="<?= get_stylesheet_directory_uri() . '/public/images/run/5.jpg'?>" class="d-block w-100" alt="...">
        </div>
      </div>
    </div>

<?php

$wp_outings = $wp_outings = $wpdb->prefix . 'outings';

$randomOutingExemples = $wpdb->get_results(
  "SELECT *
  FROM $wp_outings
  ORDER BY `outing_id`DESC
  LIMIT 3",
  ARRAY_A
);
?>

<div class="exemples-outings">
  <h4>Un petit aperçu des dernières sorties proposées sur notre site ....</h4>
  
    <?php foreach($randomOutingExemples as $key => $value) : ?>
  <div class="exemples-outings-outing">
    <div class="exemples-outings__title"><strong><?= $value['outing_name']; ?></strong></div>
    <div class="exemples-outings__date">prévue le <?= date("d/m/Y", strtotime($value['date'])); ?></div>
    <div class="exemples-outings__sport">sortie <?= getPracticedSport($value['practiced_sport']); ?></div>
    <div class="exemples-outings__distance">parcours de <?= $value['distance']; ?> km</div>
  </div>
    <?php endforeach; ?>
  
  
  <div class="exemples-outings__subscribe">
    <h6>Nous n'attendons plus que vous pour partager ces moments conviviaux...</h6>
    <p class="exemples-outings__more">...alors n'hésitez pas, rejoignez-nous en créant votre compte !</p>
    <button type="button" class="btn btn-dark navbar__button"><a class="navbar__link" href="<?= get_bloginfo('url') . '/registration/' ?>">S'inscrire</a></button>
  </div>  
</div>