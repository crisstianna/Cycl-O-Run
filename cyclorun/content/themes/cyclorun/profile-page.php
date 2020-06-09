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
//var_dump($userdata);
//var_dump($userMeta);
// todo manque la récupération de la date de naissance au format AAAA-MM-JJ pour appeler la fonction qui va calculer l'âge automatiquement

$dayBirth = get_user_meta($id, 'day_birth');
$monthBirth = get_user_meta($id, 'month_birth');
$yearBirth = get_user_meta($id, 'year_birth');

//if(get_user_meta($id, 'day_birth')[0] < 10) {
   //  $dayBirth = intval(str_pad($dayBirth[0], 2, "0", STR_PAD_LEFT));
 //}else {
   //$dayBirth = intval($dayBirth[0]);
 //}
//f(get_user_meta($id, 'month_birth')[0] < 10) {
//$monthBirth = str_pad($monthBirth[0], 2, "0", STR_PAD_LEFT);
//     // $monthBirth = intval($monthBirth);
 //}else {
//}

 //$birthdate = $yearBirth . '-' . $monthBirth . '-' . $dayBirth;

//var_dump ($userMeta);
// var_dump($dayBirth);
// var_dump($monthBirth);
// var_dump($yearBirth);
// var_dump($birthdate);



?>



<main class="profile">
    
    <h1 class="profile__title">Mon Profil</h1>
    <div class="profile__infos">
      <div class="profile__infos__personal">
        <h2 class="profile__infos__title"><?php echo str_replace("_", " ", $userData->display_name) ;?></h2>
        <div class="profile__infos__personal__avatar"></div>
        <img src="<?php echo $userMeta['picture'][0]  ?>" alt="">
        <i class="fa fa-user" aria-hidden="true"></i>
        </div>
        <div class="profile__infos__content">
          <p>Date de naissance:<?php echo $userMeta['day_birth'][0] . '/' . $userMeta['month_birth'][0] . '/'. $userMeta['year_birth'][0] ?></p>
        </div>
        <div class="profile__infos__sports">
          <div class="profile__infos__sports__practice">
              <h3>Mon profil sportif</h3>
              <p>Niveau Velo: <?php echo $userMeta['cycling_level'][0]?></p>
              <p>Niveau Course a pied: <?php echo $userMeta['running_level'][0]?></p>

<?php
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
