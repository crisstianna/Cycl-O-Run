<?php

/*
Template Name: Outing Details 
*/

get_header();

// check if the  user is logged in
if(! is_user_logged_in()){
    // retrieving the id of the custom home page
    $login = get_permalink(5);
    //automatic redirection
    header("Location: $login");
}

// current outing
$outing_id = intval($_GET['outingId']);
// current user
$id = get_current_user_id();
// recovery of the differents tables we need to display informationsfrom the database
$wp_outings = $wpdb->prefix . 'outings';
$wp_participations = $wpdb->prefix . 'participations';
$wp_users = $wpdb->prefix . 'users';

// request to retieve all informations about the current outing
$outingQueries = $wpdb->get_results(
  "SELECT *
  FROM $wp_outings  
  WHERE $wp_outings.`outing_id` = $outing_id
  ",
  ARRAY_A
);

//! 

$adressePostale = $outingQueries[0]['address'];
$address = str_replace(" ", "+", $adressePostale);
//var_dump($address);
$url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . $address . '&key=AIzaSyBmSOdXll4S7xEjhUhMzhOk7wCIarU30Ek';
$response = file_get_contents($url);
$json = json_decode($response,TRUE);
	// Latitude
	$latitude = ($json['results'][0]['geometry']['location']['lat']) ? $json['results'][0]['geometry']['location']['lat'] : '--';
	// Longitude
	$longitude = ($json['results'][0]['geometry']['location']['lng']) ? $json['results'][0]['geometry']['location']['lng'] : '--';
//var_dump($latitude);
//var_dump($longitude);

//! 

// author id, usefull for the next request (to display the name instead of the id)
$authorId = $outingQueries[0]['author'];
// change the date format
$date = date("d/m/Y", strtotime($outingQueries[0]['date']));

// request to retrieve the name of the outing's author
$authorName = $wpdb->get_results(
  "SELECT *
  FROM $wp_users
  WHERE `ID` = $authorId",
  ARRAY_A
);

// request to retrieve the number of participants
$numberParticipants = $wpdb->get_results(
  "SELECT COUNT(*)
    FROM $wp_participations
    WHERE `outing_id` = $outing_id",
    ARRAY_A
  );
  // change the result type (from string to integer)
  $numberParticipants = intval($numberParticipants[0]['COUNT(*)']);  

?>

<main class="details">
    <div class="details__header">
      <img class="details__header__img" src="images/avatar.png" alt="">
      <h2 class="details__header__title">Détails de la sortie</h2>
    </div>
    <div class="details__content">
      <section class="details__content__informations">
        <h3 class="details__content__informations__title"><?= $outingQueries[0]['outing_name']; ?></h3>
        <p class="details__content__informations__date">Date de la sortie : <?= date("d/m/Y", strtotime($outingQueries[0]['date'])); ?></p>
        <p class="details__content__informations__time">à <?= substr($outingQueries[0]['time'], 0, -3); ?></p>
        <div class="details__content__informations__author">
          <h3 class="details__content__informations__author__title">Sortie proposée par :</h3>
          <img src="images/avatar.png" alt="" class="details__content__informations__author__img">
          <p class="details__content__informations__author__pseudo"><?= str_replace("_", " ", $authorName[0]['display_name']); ?></p>
        </div>
        <div class="details__content__informations__practice">
          <div class="details__content__informations__practice__div">
            <h4 class="details__content__informations__practice__div__choice">Activité</h4>
            <img src="images/Running.svg" alt="" class="details__content__informations__practice__div__svg">
            <?= getPracticedSport($outingQueries[0]['practiced_sport']); ?>
            <img src="images/Cycling.svg" alt="" class="details__content__informations__practice__div__svg">
          </div> 
          <div class="details__content__informations__level">
            <h4 class="details__content__informations__level__choice">Niveau</h4>
            <p class="details__content__informations__level_selected"><?= getLevel($outingQueries[0]['level'], $outingQueries[0]['practiced_sport']); ?></p>
          </div>  
        </div>
        <div class="details__content__informations__rdv">
          <h4 class="details__content__informations__rdv__title">Lieu de Rendez-vous</h4>
          <p class="details__content__informations__rdv__adress"><?= $outingQueries[0]['address']; ?></p>
        </div>
        <div class="details__content__informations__description">
          <h4 class="details__content__informations__description__title">DESCRIPTION</h4>
          <?php if (!empty($currentValue['description'])) { ?>
            <p class="details__content__informations__description__text"><?= $outingQueries[0]['description']; ?></p>
          <?php
          }else { ?>
          <p class="details__content__informations__description__text">Aucune description n'a été ajoutée mais il est certain qu'elle sera sympathique </p>
        <?php } ?>
        </div>
        <div class="details__content__informations__participants">
          <h4 class="details__content__informations__participants__title">PARTICIPANTS</h4>
          <p class="details__content__informations__participants__number">Actuellement, <?= $numberParticipants; ?> personne(s) est(sont) inscrite(s) :</p>
            <?php
              // request to retrieve the participations name
                $outings_participations = $wpdb->get_results(
                  "SELECT *
                  FROM $wp_users
                  INNER JOIN $wp_participations
                  ON $wp_users.`ID` = $wp_participations.`user_id`
                  INNER JOIN $wp_outings
                  ON $wp_outings.`outing_id` = $wp_participations.`outing_id`
                  WHERE $wp_outings.`outing_id` = $outing_id",
                  ARRAY_A  
              );
              // display the names liste
              foreach($outings_participations as $key => $currentParticipant) {
                echo '<p class="details__content__informations__participants__name">' . str_replace("_", " ", $currentParticipant['display_name']) . '</p>';
                // todo : faut-il en faire une liste ou autre ? (pour le moment, ils sont dans une balise <p>)
              }

            ?>
            
        </div>
      </section>
      <aside class="details__content__map">
        <div id="map" data-lat="<?php echo $latitude; ?>" data-lgt="<?php  echo $longitude; ?>" style="width:600px; height:600px">
      
        </div>
        <form action="" method="post">
                    <input type="hidden" id="userId" name="userId" value="<?php echo $id; ?>">
                    <input type="hidden" id="outingId" name="outingId" value="<?php echo $outing_id; ?>">
                    <button class="details__content__map__button details__content__map__button__content" type="submit">Je participe</button>
                </form>
      </aside>
    </div>
  
  </main>

  <?php
// change the result type (from string to integer)
$userId = intval(filter_input(INPUT_POST, 'userId'));
$outingId = intval(filter_input(INPUT_POST, 'outingId'));

// if the form has been successfully submitted
if (!empty($_POST)) {
    // if there is well user id and user outing
    if (!empty($userId) && !empty($outingId)) {
        // request to insert the new partticipant with the current outing
        $wpdb->insert(
            $wpdb->prefix . 'participations',
            array(
            'user_id' => $userId,
            'outing_id' => $outingId
            )
        );
    }

    // if the request failed, the $wpdb->show_errors return 'false'
    $wpError = $wpdb->show_errors();

    // the $wpdb->insert_id allows th recovery the last id
    $participationID = $wpdb->insert_id;

    // display if everything worked or not
    if ($wpError !== false) {
        echo '<div style="font-size:24px;color:#00757f;margin-top:40px;">Vous êtes maintenant inscrit sur cette sortie !</br> Vous pouvez maintenant la retrouver sur votre page profil :</div>';
        echo '<button type="button" class="btn btn-dark navbar__button"><a class="navbar__link" href="' . get_bloginfo('url') . '/profile-page/' . '">Retour sur mon profil</a></button>';
    } else {
        echo 'Une erreur a eu lieu, veuillez cliquer de nouveau sur le bouton " je participe"';
    }
}


get_footer();

?>

    

