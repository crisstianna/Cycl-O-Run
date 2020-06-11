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

//var_dump($outingQueries);

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
  
// author id, usefull for the next request (to display the name instead of the id)
$authorId = $outingQueries[0]['author'];
// change the date format
$date = date("d/m/Y", strtotime($outingQueries[0]['date']));

$userMeta = get_user_meta($authorId);

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
  
      function displayMessage($wpError){
        if ($wpError !== false) {
          
            echo '<div class="message">';
            echo '<p class="message__ok">Vous êtes maintenant inscrit sur cette sortie !</br> Vous pouvez maintenant la retrouver sur votre page profil :</p>';
            echo '<a class="btn btn-primary message__button" href="' . get_bloginfo('url') . '/profile-page/' . '">Retour sur mon profil</a>';
            echo '</div>';
          
          } else {
            echo '<div class="message">';
            echo '<p class="message__ko">Une erreur a eu lieu, veuillez cliquer de nouveau sur le bouton "je participe"</p>';
            echo '</div>';
        }
      }
  }
  
?>

<main class="details">
    <div class="details__header">
      <!-- <img class="details__header__img" src="images/avatar.png" alt=""> -->
      <h2 class="details__header__title">Détails de la sortie</h2>
    </div>
    <div class="details__content">
      <section class="details__content__informations">
        <embed  src="<?= $outingQueries[0]['picture']; ?>" class="details__content__informations__img" alt="...">
        <h3 class="details__content__informations__title"><?= $outingQueries[0]['outing_name']; ?></h3>
        <p class="details__content__informations__date">Date de la sortie : <?= date("d/m/Y", strtotime($outingQueries[0]['date'])); ?></p>
        <p class="details__content__informations__time">à <?= substr($outingQueries[0]['time'], 0, -3); ?></p>
        <div class="details__content__informations__author">
          <h3 class="details__content__informations__author__title">Sortie proposée par :</h3>
          <img src="<?php echo $userMeta['picture'][0]; ?>" alt="" class="details__content__informations__author__img">
          <p class="details__content__informations__author__pseudo"><?= str_replace("_", " ", $authorName[0]['display_name']); ?></p>
        </div>
        <div class="details__content__informations__practice">
          <div class="details__content__informations__practice__sport">
            <h4 class="details__content__informations__practice__sport__choice">Activité</h4>
            <?php if($outingQueries[0]['practiced_sport'] == 2) :?>
            <img src="<?php echo get_bloginfo('url') . '/content/themes/cyclorun/app/assets/images/running.svg'; ?>" alt="" class="details__content__informations__practice__sport__svg">   
            <?php endif; ?>
            <?php if($outingQueries[0]['practiced_sport'] == 1) : ?>         
            <img src="<?php echo get_bloginfo('url') . '/content/themes/cyclorun/app/assets/images/cycling.svg;?>' ?>" alt="" class="details__content__informations__practice__sport__svg">
            <?php endif; ?>
            <p class="details__content__informations__practice__sport__name"><?= getPracticedSport($outingQueries[0]['practiced_sport']); ?></p>
          </div>
          <div class="details__content__informations__practice__level">
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
        
      </section>
      <aside class="details__content__map">
        <div id="map" data-lat="<?php echo $latitude; ?>" data-lgt="<?php  echo $longitude; ?>" style="width:600px; height:600px">
      
        </div>
        <form class="participeForm" action="" method="post">
            <input type="hidden" id="userId" name="userId" value="<?php echo $id; ?>">
            <input type="hidden" id="outingId" name="outingId" value="<?php echo $outing_id; ?>">
            <button class="details__content__map__button details__content__map__button__content" type="submit">Je participe</button>            
        </form>
        <?php 
              if ($_POST) {
                displayMessage($wpError);
              }
        ?>
      </aside>
    </div>
    <div class="details__participants">
          <h4 class="details__participants__title">PARTICIPANTS</h4>
          <p class="details__participants__number">Actuellement, <?= $numberParticipants; ?> personne(s) est(sont) inscrite(s) :</p>
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

              // display the names list
              ?>
          <div class="details__participants__div">
                <?php
              foreach($outings_participations as $key => $currentParticipant) : ?>
              <div class="details__participants__div__content">
                <?php $participantId = get_user_meta($currentParticipant['user_id']); 
                //var_dump($participantId);?>
                <img src="<?= $participantId['picture'][0]; ?>" alt="" class="details__participants__div__content__img">
                <p class="details__participants__div__content__name"><?= str_replace("_", " ", $currentParticipant['display_name']) ?></p>
              </div>
              <?php endforeach; ?>  
              </div>          
        </div>
  




<?php

get_footer();

?>

    

