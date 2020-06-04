<?php

/*

    Template Name: Custom Home

*/

get_header();


if(! is_user_logged_in()){
  // retrieving the id of the custom home page
  $login = get_permalink(5);
  //automatic redirection
  header("Location: $login");
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
// TODO rajouter un filtre aussi pour ne pas prendre le numéro de la rue
//var_dump($postcodeId);
//var_dump($department); 

// We want to see the 3 last outings registered in database where the postcode is the same as th current user

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

if(!empty($outings_query)){
  foreach ($outings_query as $key => $value) {
      echo '<div>';
      echo '<img src="/' . $value['picture'] . '"alt="image du parcours"/>';
      echo '<h3 class="outing__article__title">' . $value['outing_name'] . '</h3>';
      echo '<p class="outing__article__date">date : ' . date("d-m-Y", strtotime($value['date'])) . '</p>';
      echo '<p class="outing__article__time">heure de rdv : ' . substr($value['time'], 0, -3) . '</p>';
      echo '<p class="outing__article__location">lieu de rdv : ' . $value['address'] . '</p>';
      echo '<p class="outing__article__distance">distance : ' . $value['distance'] . 'km</p>';
      echo '<p class="outing__article__level">niveau : ' . getLevel($value['level'], $value['practiced_sport']) . '</p>';
      echo '<button class="outing__article__button" type="button">Etat de la sortie</button>';
      echo '</div>';
  }
}else {
  echo 'Aucune sortie aupès de chez vous n\'est prévue pour le moment. Et si vous étiez la première personne à en proposer une ?';
  echo '<a href="' . get_permalink(16) . '">Ajouter une sortie</a>';
}

?>           
        </article>        
      </div>
    </section>
    <!-- Participation section -->
    <section class="outing">
      <h2 class="outing__title">Les prochaines sorties auxquelles je participe</h2>
      <div class="outing__section">
        <article class="outing__article">
          <div class="outing__article__image">
            <img class="outing__article__img" src="images/logo-o.png" alt="">
          </div>

<?php

$wp_participations = $wpdb->prefix . 'participations';
$wp_users = $wpdb->prefix . 'users';
$currentDateTime = date('Y-m-d');
//var_dump($currentDateTime); 

$outings_participations = $wpdb->get_results(
  "SELECT *
  FROM $wp_outings
  INNER JOIN $wp_participations
    ON $wp_outings.`outing_id` = $wp_participations.`outing_id`
  INNER JOIN $wp_users
    ON $wp_users.`ID` = $wp_participations.`user_id`
  WHERE $wp_users.`ID` = $id AND $wp_outings.`date` >= $currentDateTime
  ORDER BY `date` ASC
  LIMIT 3",
  ARRAY_A  
);

//var_dump($outings_participations);

foreach ($outings_participations as $index => $currentValue) {

  $currentOutingId = $currentValue['outing_id'];
  //var_dump($currentOutingId);

  $numberParticipants = $wpdb->get_results(
  "SELECT COUNT(*)
    FROM $wp_participations
    WHERE `outing_id` = $currentOutingId",
    ARRAY_A
  );
  
    echo '<div>';
    echo '<h3 class="outing__article__title">' . $currentValue['outing_name'] . '</h3>';
    echo '<p class="outing__article__date">date : ' . date("d-m-Y", strtotime($currentValue['date'])) . '</p>';
    echo '<p class="outing__article__time">heure de rdv : ' . substr($currentValue['time'], 0, -3) . '</p>';
    echo '<p class="outing__article__location">lieu de rdv : ' . $currentValue['address'] . '</p>';
    echo '<p class="outing__article__distance">distance : ' . $currentValue['distance'] . 'km</p>';
    echo '<p class="outing__article__level">niveau : ' . getLevel($currentValue['level'], $currentValue['practiced_sport']) . '</p>';
    foreach($numberParticipants as $key => $nbRows) {
      echo '<p class="outing__article__number-participants">nombre de participants : ' . $nbRows['COUNT(*)'] . '</p>';
    }    
    echo '<button class="outing__article__button" type="button">Etat de la sortie</button>';
    echo '</div>';
}
?>
        </article>
      </div>
    </section>
  </main>

  <?php

get_footer();