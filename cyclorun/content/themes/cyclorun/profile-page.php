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

//? "ELSE" WE RETRIEVE CURRENT USER DATA  

$id = get_current_user_id();
$userData = get_userdata($id);
$userMeta = get_user_meta($id);
// todo récupérer la date de naissance au format AAAA-MM-JJ pour appeler la fonction qui va calculer l'âge automatiquement

$dayBirth = intval(get_user_meta($id, 'day_birth')[0]);
$monthBirth = intval(get_user_meta($id, 'month_birth')[0]);
$yearBirth = intval(get_user_meta($id, 'year_birth')[0]);


// to display a date with the format : jj/mm/aaaa, we change the days and/or months under 10 and add a "0" before the number
// if day_birth <10
if($dayBirth < 10) {
    $dayBirth = 0 . $dayBirth;
}
// if month_birth <10
if($monthBirth < 10) {
  $monthBirth = 0 . $monthBirth;
}

// we call the wordpress database
global $wpdb;

// we put the tables name in variables for using them
$wp_outings = $wpdb->prefix . 'outings';
$wp_participations = $wpdb->prefix . 'participations';
$wp_users = $wpdb->prefix . 'users';
// we recover the current date to display only the next outings
$currentDateTime = date('Y-m-d');


//? FIND OUTINGS WICH USER IS CREATOR
$outingUserAuthor = $wpdb->get_results(
    "SELECT *
    FROM $wp_outings
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
    WHERE $wp_participations.`user_id` = $id AND $wp_outings.`date` >= $currentDateTime
    ORDER BY `date` ASC",
    ARRAY_A 
);

?>

<!----------------VIEW------------------->



<main class="profile">
    <div class="profile__infos">
      <h1 class="profile__title">Mon Profil</h1>
      <div class="profile__infos__personal__avatar">
          <img class="avatar__img" src="<?= $userMeta['picture'][0]; ?>" alt="Here comes the user avatar"/>
      </div>
      <div class="profile__infos__personal">
        <h2 class="profile__infos__title"><?php echo str_replace("_", " ", $userData->display_name) ;?></h2>
        <div class="profile__infos__content">
        Date de naissance : <?php echo $dayBirth . '/' . $monthBirth . '/'. $yearBirth ?>
          <p class="user__infos"><?= $userMeta['city'][0] ;?></p>
        </div>
        <div class="profile__infos__sports">
          <div class="profile__infos__sports__practice">
            <?php if(array_key_exists('sport', $userMeta)) : ?> 
              <?php if (array_key_exists('cycling_level', $userMeta)) : ?>             
              <div class="my__practice__level">
                <img class="profile__infos__sports__practice__svg" src="<?php echo get_bloginfo('url') . '/content/themes/cyclorun/app/assets/images/cycling.svg;' ?>" alt="cycling">
                <p class="selected__practice__level"><?php echo $userMeta['cycling_level'][0]  ?></p>
              </div> 
              
              <?php elseif (array_key_exists('running_level', $userMeta)) :?> 
              <div class="my__practice__level">
                <img class="profile__infos__sports__practice__svg" src="<?php echo get_bloginfo('url') . '/content/themes/cyclorun/app/assets/images/running.svg;' ?>" alt="running">
                <p class="selected__practice__level"><?php echo $userMeta['running_level'][0]  ?></p>
              </div>
              <?php endif; ?>
              <?php else : ?>
              <div class="my__practice__level">
                <img class="profile__infos__sports__practice__svg" src="<?php echo get_bloginfo('url') . '/content/themes/cyclorun/app/assets/images/cycling.svg;' ?>" alt="cycling">
                <p class="selected__practice__level"><?php echo $userMeta['cycling_level'][0]  ?></p>
              </div>
              <div class="my__practice__level">
                <img class="profile__infos__sports__practice__svg" src="<?php echo get_bloginfo('url') . '/content/themes/cyclorun/app/assets/images/running.svg;' ?>" alt="running">
                <p class="selected__practice__level"><?php echo $userMeta['running_level'][0]  ?></p>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <div class="profile__outings">
        <div class="profile__outings__created">
            <h3 class="profile__outings__created__title">Mes prochaines sorties</h3>
            <h4 class="profile__outings__created__title__author">dont je suis l'auteur : </h4>
            <div class="profile__outings_created__content">
              <?php if (empty($outingUserAuthor)): ?>
                <p class="profile__outings__list">Vous n'avez pas encore proposé de sortie .... très bientôt peut-être</p>
              <?php else : ?>
                  <?php foreach($outingUserAuthor as $key=> $currentOuting): ?>
                  <div class="profile__outings__list__item">
                  <?php if($currentOuting['practiced_sport'] == 1) :?>
                  <img class="profile__infos__sports__practice__svg__right" src="<?php echo get_bloginfo('url') . '/content/themes/cyclorun/app/assets/images/cycling.svg;' ?>" alt="cycling">
                  <?php endif; ?>
                  <?php if($currentOuting['practiced_sport'] == 2) : ?>
                    <img class="profile__infos__sports__practice__svg__right" src="<?php echo get_bloginfo('url') . '/content/themes/cyclorun/app/assets/images/running.svg;' ?>" alt="running">
                  <?php endif; ?>
                  <p class="profile__outings__list"><strong><?= $currentOuting['outing_name']; ?></strong> prévue le : <?= date("d-m-Y", strtotime($currentOuting['date'])); ?> à <?= substr($currentOuting['time'], 0, -3);?></p>
                  <a class="link__to__details" href="<?= get_bloginfo('url') . '/outing-details/?outingId=' . $currentOuting['outing_id']; ?>">Voir le détail</a>
                  </div>
                  <?php endforeach; ?>
              <?php endif; ?>              
            </div>        
            <h4 class="profile__outings__created__title__participant">en tant que participant(e) : </h4>
            <div class="profile__outings__future__content">
            <?php if (empty($outingUserParticipant)) : ?>
                <p class="profile__outings__list">Vous n'êtes pas encore inscrit sur une sortie</p>
              <?php else: ?>
                  <?php foreach($outingUserParticipant as $key=> $currentParticipation): ?>
                  <div class="profile__outings__list__item">
                  <?php if($currentParticipation['practiced_sport'] == 1) :?>
                  <img class="profile__infos__sports__practice__svg__right" src="<?php echo get_bloginfo('url') . '/content/themes/cyclorun/app/assets/images/cycling.svg;' ?>" alt="cycling">
                  <?php endif; ?>
                  <?php if($currentParticipation['practiced_sport'] == 2) : ?>
                    <img class="profile__infos__sports__practice__svg__right" src="<?php echo get_bloginfo('url') . '/content/themes/cyclorun/app/assets/images/running.svg;' ?>" alt="running">
                  <?php endif; ?>
                  <p class="profile__outings__list"><strong><?= $currentParticipation['outing_name']; ?></strong> prévue le : <?= date("d/m/Y", strtotime($currentParticipation['date'])); ?> à <?= substr($currentParticipation['time'], 0, -3);?></p>
                  <a class="link__to__details" href="<?= get_bloginfo('url') . '/outing-details/?outingId=' . $currentParticipation['outing_id']; ?>">Voir le détail</a>
                  </div>
                  <?php endforeach; ?>
                <?php endif; ?> 
            </div>
        </div>
    </div>
