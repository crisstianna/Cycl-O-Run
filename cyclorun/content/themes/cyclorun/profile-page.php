<?php

/*
Template Name: Profile Page
*/

get_header();

//? IF USER IS NOT LOGGED, REDIRECTION TO LOGIN PAGE

if(! is_user_logged_in()){
    // retrieving the id of the custom home page
    $login = get_permalink(5);
    //automatic redirection
    header("Location: $login");
}

//? "ELSE" WE RETRIEVE HIS DATAS   

$id = get_current_user_id();
$userData = get_userdata($id);
$userMeta = get_user_meta($id);

// todo manque la récupération de la date de naissance au format AAAA-MM-JJ pour appeler la fonction qui va calculer l'âge automatiquement


// todo Voir pour la gestion de l'affichage du profil sportif
$sport = get_user_meta($id, 'sport');
//var_dump($sport);

if(empty($sport[0])) {
    $cycling = get_user_meta($id, 'cycling');
    $running = get_user_meta($id, 'running');
}else {
    echo '<img class="profile__infos__sports__practice__svg" src="images/Cycling.svg" alt="">'; //? img du sport associé
    // todo à voir comment faire pour afficher le niveau dans le sport sélectionné
}

//? DB CALLS:

global $wpdb;

$wp_outings = $wpdb->prefix . 'outings';
$wp_participations = $wpdb->prefix . 'participations';
$wp_users = $wpdb->prefix . 'users';
$currentDateTime = date('Y-m-d');

//? FIND OUTINGS WICH USER IS CREATOR

$outingUserAuthor = $wpdb->get_results(
    "SELECT *
    FROM $wp_outings
    INNER JOIN $wp_participations
        ON $wp_outings.`outing_id` = $wp_participations.`outing_id`
    WHERE $wp_outings.`author` = $id AND $wp_outings.`date` >= $currentDateTime
    ORDER BY `date` ASC",
    ARRAY_A
);

//? FIND OUTINGS WICH USER IS PARTICIPANT

$outingUserParticipant = $wpdb->get_results(
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

?>

<!----------------VIEW------------------->

  <main class="profile">
    <div class="profile__infos">
      <div class="profile__infos__personal__avatar">
          <img class="avatar__img" src="images/avatar.png" alt="Here comes the user avatar"/>
      </div>
      <h1 class="profile__title">Mon Profil</h1>
      <div class="profile__infos__personal">
        <h2 class="profile__infos__title">Eddy Murphy</h2>
        <div class="profile__infos__content">
          <p class="user__infos">25 ans</p>
          <p class="user__infos">Paris</p>
        </div>
        <div class="profile__infos__sports">
          <div class="profile__infos__sports__practice">
            <div class="my__practice__level">
              <input class="profile__infos__sports__practice__svg" type="checkbox" id="profile__cycling" name="practicedSport" value="vélo">
              <img class="profile__infos__sports__practice__svg" src="images/Cycling.svg" alt="">
              <p class="selected__practice__level">Avancé</p>
            </div>
            <div class="my__practice__level">
              <input class="outing__input" type="checkbox" id="profile__running" name="practicedSport" value="course à pieds">
              <img class="profile__infos__sports__practice__svg" src="images/Running.svg" alt="">
              <p class="selected__practice__level">Avancé</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="profile__outings">
        <div class="profile__outings__created">
            <h3 class="profile__outings__created__title">Liste de mes sorties</h3>
            <div class="profile__outings_created__content">
                <p class="profile__outings__list">nom sortie</p>
                <p class="profile__outings__list">nom sortie</p>
                <p class="profile__outings__list">nom sortie</p>
            </div>
        </div>
        <div class="profile__outings__future">
            <h3 class="profile__outings__future__title">Les sorties auxquelles je participe</h3>
            <div class="profile__outings_future__content">
                <p class="profile__outings__list">nom sortie</p>
                <p class="profile__outings__list">nom sortie</p>
                <p class="profile__outings__list">nom sortie</p>
            </div>
        </div>
    </div>
