<?php

/*
Template Name: Participation Outing
*/

require 'template-parts/participation_outing_form.php';

?>        
        
    

<?php


//?STEP 1: On recupere les value des filtres
//recovery of user id
$id = get_current_user_id();
// recovery of postcode user id
$postcodeId = get_user_meta($id, 'postcode');
// recovery of the 2 first numbers of postcode
$department = substr($postcodeId[0], 0, -3);

// recovery of inputs values and add filters
$practicedSport = filter_input(INPUT_POST, 'practicedSport');
$level = filter_input(INPUT_POST, 'level');
$date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_NUMBER_FLOAT);

//? STEP 2 : CALL DB pour retrouver les sorties filtrées

// function call 'getOUtingFilteredResults' to have the correct sql request with filters
$results = getOutingFilteredResults($practicedSport, $level, $date, $department);




$userId = intval(filter_input(INPUT_POST, 'userId'));
$outingId = intval(filter_input(INPUT_POST, 'outingId'));

    if (!empty($userId) && !empty($outingId)) {
        $wpdb->insert(
            $wpdb->prefix . 'participations',
            array(
            'user_id' => $userId,
            'outing_id' => $outingId
            )
        );

        // if the request failed, the $wpdb->show_errors return 'false'
        $wpError = $wpdb->show_errors();

        // the $wpdb->insert_id allows th recovery the last id
        $participationID = $wpdb->insert_id;

    
        function displayMessageParticipation($wpError)
        {
            if ($wpError !== false) {
                echo '<div class="message">';
                echo '<p class="message__ok">Inscription réussie ! </br> Vous pouvez maintenant retrouver la sortie sur votre page profil :</p>';
                echo '<a class="btn btn-primary outing__button" href="' . get_bloginfo('url') . '/profile-page/' . '">Retour sur mon profil</a>';
                echo '</div>';
            } else {
                echo '<div class="message">';
                echo '<p class="message__ko">Une erreur a eu lieu, veuillez cliquer de nouveau sur le bouton "je participe"</p>';
                echo '</div>';
            } // ==== Fermeture du else
        } // Fermeture de la fonction
    } // fermeture du if



//? STEP 3: trouver le nombre de participants pour chaque sortie
if(function_exists('displayMessageParticipation')){
    displayMessageParticipation($wpError);
} 
?> 
<div class="articles-list"> 
<?php

if (empty($results)) {
    echo '<div class="messageEmpty">';
      echo '<div class="messageEmpty__content">Ah mince ! Personne n\'a encore proposé de sortie correspondant à votre recherche ! Pourquoi ne pas être le(la) premier(e) à en proposer une ?</div>';
      echo '<a class="btn btn-primary message__button" style="text-align:center;" href="' . get_bloginfo('url') . '/outing-registration/' . '">Organiser une sortie</a>';
    echo '</div>';
} else {
    foreach ($results as $key=> $filteredValue) {
        // The current outing id
        $currentOutingId = $filteredValue['outing_id'];

        $wp_participations = $wpdb->prefix . 'participations';
        $wp_users = $wpdb->prefix . 'users';
        $currentDateTime = date('Y-m-d');

        //  récupération du nombre de participants
        $numberParticipants = $wpdb->get_results(
            "SELECT COUNT(*)
            FROM $wp_participations
            WHERE `outing_id` = $currentOutingId",
            ARRAY_A
        );


        $wp_outings = $wpdb->prefix . 'outings';

        // récupération des participants (limité à 3)
        $outings_participations = $wpdb->get_results(
            "SELECT *
            FROM $wp_users
            INNER JOIN $wp_participations
            ON $wp_users.`ID` = $wp_participations.`user_id`
            INNER JOIN $wp_outings
            ON $wp_outings.`outing_id` = $wp_participations.`outing_id`
            WHERE $wp_outings.`outing_id` = $currentOutingId
            LIMIT 3",
            ARRAY_A
        ); ?> 


        <div class="single-article">
         
            <div class="outing__article__image">
                <img class="outing__article__img" src="images/logo-o.png" alt="">
            </div>
            
            <h3 class="outing__article__title"><?php echo $filteredValue['outing_name']; ?></h3>

            <div class="date-hour">
                <div class="date-hour-left">
                    <p class="outing__article__date"><span class="font-weight">Date :</span> <?php echo date("d-m-Y", strtotime($filteredValue['date'])); ?></p>
                    <p class="outing__article__sport"><span class="font-weight">Activité :</span> <?php echo getPracticedSport($filteredValue['practiced_sport']); ?></p>
                    <p class="outing__article__location"><span class="font-weight">Lieu de rendez-vous :</span> <?php echo $filteredValue['address']; ?></p>
                </div>
                <div class="date-hour-right">
                    <p class="outing__article__time"><span class="font-weight">Heure :</span> <?php echo substr($filteredValue['time'], 0, -3); ?></p>
                    <p class="outing__article__level"><span class="font-weight">Niveau :</span> <?php echo getLevel($filteredValue['level'], $filteredValue['practiced_sport']); ?></p>
                    <p class="outing__article__distance"><span class="font-weight">Distance :</span> <?php echo $filteredValue['distance']; ?>km</p>
                </div>   
            </div>

            <h4 class="participation-h4">Organisateur de la sortie</h4>

                <?php $user = new WP_User($filteredValue['author']);
                    $author = $user->display_name;
                    $modifiedAuthor = str_replace("_", " ", $author); ?>
            <div class="outing-organisator">
                <img class="outing__article__img" src="<?php echo $user->picture; ?>" alt="author's avatar">
                <p class="outing__article__author"><?php echo $modifiedAuthor; ?></p>
            </div>

            <?php  foreach ($numberParticipants as $key => $nbRows) : ?>                
                <h4 class="participation-h4">Participants : <?= $nbRows['COUNT(*)']; ?></h4>            
            <?php endforeach; ?>

            <div class="participants-list">
                <?php foreach ($outings_participations as $key => $currentParticipant): ?>
                    <div class="participants-list__item">
                        <?php $participantId = get_user_meta($currentParticipant['user_id']); ?>
                            <div class="participants-list__avatar">
                                <img src="<?= $participantId['picture'][0]; ?>" alt="" class="participants-list__img">
                            </div>
                        
                            <p class="details__participants__div__content__name "><?= str_replace("_", " ", $currentParticipant['display_name']) ?></p>
                       
                    </div>
                <?php endforeach; ?>  
            </div>  
            <div class="bottom-buttons">
                <a class="btn btn-primary details-link"type="button" href="<?= get_bloginfo('url') . '/outing-details/?outingId=' . $filteredValue['outing_id']; ?>">Détails</a>
                <form action="" method="post">
                    <input type="hidden" id="userId" name="userId" value="<?php echo $id; ?>">
                    <input type="hidden" id="outingId" name="outingId" value="<?php echo $filteredValue['outing_id']; ?>">
                    <button class="btn btn-primary details-link" type="submit">Je participe</button>
                </form>
            </div>                  
        </div>
<?php
    } // ====> fermeture du foreach

} // ====> fermeture du else avant foreach $results
?>

</div>

<?php

get_footer();





?>