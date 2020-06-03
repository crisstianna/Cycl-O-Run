<?php

/*
Template Name: Profile Page
*/

get_header();

if(! is_user_logged_in()){
    // retrieving the id of the custom home page
    $login = get_permalink(5);
    //automatic redirection
    header("Location: $login");
}

$id = get_current_user_id();
$userData = get_userdata($id);
$userMeta = get_user_meta($id);

// todo manque la récupération de la date de naissance au format AAAA-MM-JJ pour appeler la fonction qui va calculer l'âge automatiquement

// $dayBirth = get_user_meta($id, 'day_birth');
// $monthBirth = get_user_meta($id, 'month_birth');
// $yearBirth = get_user_meta($id, 'year_birth');

// if(get_user_meta($id, 'day_birth')[0] < 10) {
//     $dayBirth = intval(str_pad($dayBirth[0], 2, "0", STR_PAD_LEFT));
// }else {
//     $dayBirth = intval($dayBirth[0]);
// }

// if(get_user_meta($id, 'month_birth')[0] < 10) {
//     $monthBirth = str_pad($monthBirth[0], 2, "0", STR_PAD_LEFT);
//     // $monthBirth = intval($monthBirth);
// }else {
//     //$monthBirth = intval($monthBirth[0]);
// }

// $birthdate = $yearBirth[0] . '-' . $monthBirth . '-' . $dayBirth;

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
          <img src="" alt="Here comes the user avatar"/>
        </div>
        <div class="profile__infos__content">
          <p>28 ans</p>
        </div>
        <div class="profile__infos__sports">
          <div class="profile__infos__sports__practice">
              <h3>Mon profil sportif</h3>
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

?>
                <img class="profile__infos__sports__practice__svg" src="images/Cycling.svg" alt="">

                <img class="profile__infos__sports__practice__svg" src="images/Running.svg" alt="">
          </div>
        </div>
    </div>
    <div class="profile__outings">
        <div class="profile__outings__created">
            <h3 class="profile__outings__created__title">Mes prochaines sorties en tant qu'organisateur(trice)</h3>

<?php
$wp_outings = $wpdb->prefix . 'outings';
$wp_participations = $wpdb->prefix . 'participations';
$wp_users = $wpdb->prefix . 'users';
$currentDateTime = date('Y-m-d');

global $wpdb;

$outingUserAuthor = $wpdb->get_results(
    "SELECT *
    FROM $wp_outings
    INNER JOIN $wp_participations
        ON $wp_outings.`outing_id` = $wp_participations.`outing_id`
    WHERE $wp_outings.`author` = $id AND $wp_outings.`date` >= $currentDateTime
    ORDER BY `date` ASC",
    ARRAY_A
);
//var_dump($outingUserAuthor);

?>


            <div class="profile__outings_created__content">
                <?php foreach($outingUserAuthor as $key => $currentouting) : ?>
                    <div>  <!-- en liste ça pourrait être pas mal + lien vers la page détail-->
                        <img src="" alt="logo vélo ou running">  
                        <p><strong><?php echo $currentouting['outing_name']; ?></strong></p>
                        <p> prévue le <?php echo date("d-m-Y", strtotime($currentouting['date'])); ?></p>
                        <p> à <?php echo substr($currentouting['time'], 0, -3); ?></p>
                        <a href="lien vers la page détail" id="<?php echo $currentouting['outing_id']; ?>">Voir le détail</a>
                    </div>                    
                <?php endforeach; ?>
                
            </div>
        </div>
        <div class="profile__outings__future">
            <h3 class="profile__outings__future__title">Mes futures sorties en tant que participant(e)</h3>

<?php

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
//var_dump($outingUserParticipant);

?>
            <div class="profile__outings_future__content">
                <?php foreach($outingUserParticipant as $index => $currentParticipation) : ?>
                    <div>  <!-- en liste ça pourrait être pas mal + lien vers la page détail-->
                        <img src="" alt="logo vélo ou running">  
                        <p><strong><?php echo $currentParticipation['outing_name']; ?></strong></p>
                        <p> prévue le <?php echo date("d-m-Y", strtotime($currentParticipation['date'])); ?></p>
                        <p> à <?php echo substr($currentParticipation['time'], 0, -3); ?></p>
                        <a href="lien vers la page détail" id="<?php echo $currentParticipation['outing_id']; ?>">Voir le détail</a>
                    </div>                    
                <?php endforeach; ?>
            </div>
        </div>
    </div>
  </main>