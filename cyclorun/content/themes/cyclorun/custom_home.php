<?php

/*

    Template Name: Custom Home

*/

get_header();

if(! is_user_logged_in()){
  
    header('Location: http://localhost/Projets/projet-cycl-o-run/cyclorun/login/');

}




?>

<main>
    <!-- Near outing section -->
    <section class="outing">
      <h2 class="outing__title">Les dernières sorties ajoutées près de chez moi</h2>
      <div class="outing__section">
        <article class="outing__article">
          <div class="outing__article__image">
            <img class="outing__article__img" src="images/logo-o.png" alt="">
          </div>
          <div>

<?php
/* 
require 'template-parts/home.php';
*/
$id = get_current_user_id();
$postcodeId = get_user_meta($id, 'postcode');
$department = substr($postcodeId[0], 0, -3);
//var_dump($postcodeId);
//var_dump($department); 


global $wpdb;

$wp_outings = $wpdb->prefix . 'outings';

$outings_query = $wpdb->get_results(
    "SELECT *
    FROM $wp_outings
    WHERE `address` LIKE '%$department%'
    ORDER BY created_at DESC
    LIMIT 3",
    $output = ARRAY_A   
);
 
foreach($outings_query as $key => $value) {
    echo '<div>';
    echo '<h3 class="outing__article__title">' . $value['outing_name'] . '</h3>';
    echo '<p class="outing__article__date">horaire : ' . date("d-m-Y", strtotime($value['date'])) . '</p>';
    echo '<p class="outing__article__location">lieu de rdv : ' . $value['address'] . '</p>';
    echo '<p class="outing__article__distance">distance : ' . $value['distance'] . 'km</p>';
    echo '<p class="outing__article__level">niveau : ' . $value['level'] . '</p>';
    echo '<button class="outing__article__button" type="button">Etat de la sortie</button>';
    echo '</div>';       
}
?>           
        </article>        
      </div>
    </section>
    <!-- Participation section -->
    <section class="outing">
      <h2 class="outing__title"><em>Prochainement ...... </em>Les sorties auxquelles je participe</h2>
      <div class="outing__section">
        <article class="outing__article">
          <div class="outing__article__image">
            <img class="outing__article__img" src="images/logo-o.png" alt="">
          </div>
          <div>
            <h3 class="outing__article__title">Nom de la sortie</h3>
            <p class="outing__article__date">date</p>
            <p class="outing__article__location">Lieu</p>
            <p class="outing__article__distance">Distance</p>
            <p class="outing__article__level">intensif</p>
            <button class="outing__article__button" type="button">Etat de la sortie</button>
          </div>
        </article>
        <article class="outing__article">
          <div class="outing__article__image">
            <img class="outing__article__img" src="images/logo-o.png" alt="">
          </div>
          <div>
            <h3 class="outing__article__title">Nom de la sortie</h3>
            <p class="outing__article__date">date</p>
            <p class="outing__article__location">Lieu</p>
            <p class="outing__article__distance">Distance</p>
            <p class="outing__article__level">intensif</p>
            <button class="outing__article__button" type="button">Etat de la sortie</button>
          </div>
        </article>
        <article class="outing__article">
          <div class="outing__article__image">
            <img class="outing__article__img" src="images/logo-o.png" alt="">
          </div>
          <div>
            <h3 class="outing__article__title">Nom de la sortie</h3>
            <p class="outing__article__date">date</p>
            <p class="outing__article__location">Lieu</p>
            <p class="outing__article__distance">Distance</p>
            <p class="outing__article__level">intensif</p>
            <button class="outing__article__button" type="button">Etat de la sortie</button>
          </div>
        </article>
      </div>
    </section>
  </main>

  <?php

get_footer();