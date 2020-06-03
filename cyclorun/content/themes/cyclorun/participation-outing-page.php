<?php

/*
Template Name: Participation Outing
*/

require 'template-parts/participation_outing_form.php';

?>        


        <article class="outing__article">


<?php

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

// function call 'getOUtingFilteredResults' to have the correct sql request with filters
$results = getOutingFilteredResults($practicedSport, $level, $date, $department);
//var_dump($results);

foreach($results as $key => $filteredValue) { ?>

            <div class="outing__article__image">
                <img class="outing__article__img" src="images/logo-o.png" alt="">      <!-- VOIR POUR LE LOGO -->
            </div>
            <div>
                <h3 class="outing__article__title"><?php echo $filteredValue['outing_name']; ?></h3>
                <p class="outing__article__date"><?php echo date("d-m-Y", strtotime($filteredValue['date'])); ?></p>
                <p class="outing__article__time"><?php echo substr($filteredValue['time'], 0, -3); ?></p>
                <p class="outing__article__sport"><?php getPracticedSport($filteredValue['practiced_sport']); ?></p>
                <p class="outing__article__level"><?php getLevel($filteredValue['level'], $filteredValue['practiced_sport']); ?></p>
                <p class="outing__article__location"><?php echo $filteredValue['address']; ?></p>
                <p class="outing__article__distance"><?php echo $filteredValue['distance']; ?></p>
                <h4>Organisateur de la sortie</h4>
                    <?php $user = new WP_User( $filteredValue['author']); 
                    $author = $user->display_name;
                    $modifiedAuthor = str_replace("_", " ", $author);?>
                <img class="outing__article__img" src="images/logo-o.png" alt="AVATAR DE L'AUTEUR">
                <p class="outing__article__author"><?php echo $modifiedAuthor; ?></p>


    <?php 
    
    
    $currentOutingId = $filteredValue['outing_id'];
    //var_dump($currentOutingId);
    $wp_participations = $wpdb->prefix . 'participations';
    $wp_users = $wpdb->prefix . 'users';
    $currentDateTime = date('Y-m-d');

    $numberParticipants = $wpdb->get_results(
        "SELECT COUNT(*)
        FROM $wp_participations
        WHERE `outing_id` = $currentOutingId",
        ARRAY_A
    );
    //var_dump($numberParticipants);
    
    foreach($numberParticipants as $key => $nbRows) : ?>
                <h4>Participants : <?= $nbRows['COUNT(*)']; ?></h4>
    <?php endforeach; 


    $wp_outings = $wpdb->prefix . 'outings';

    $outings_participations = $wpdb->get_results(
        "SELECT *
        FROM $wp_users
        INNER JOIN $wp_participations
        ON $wp_users.`ID` = $wp_participations.`user_id`
        INNER JOIN $wp_outings
        ON $wp_outings.`outing_id` = $wp_participations.`outing_id`
        WHERE $wp_outings.`outing_id` = $currentOutingId AND $wp_outings.`date` >= $currentDateTime
        ORDER BY `date` ASC
        LIMIT 5",
        ARRAY_A  
    );
    //var_dump($outings_participations);

    

    ?>


                <ul>
                    <?php foreach ($outings_participations as $key => $currentParticipant) : ?>
                    <li>
                        <img class="outing__article__img" src="images/logo-o.png" alt="AVATAR DU PARTICIPANT">
                        <p class="outing__article__author"><?= str_replace("_", " ", $currentParticipant['display_name']); ?></p>
                    </li>
                    <?php endforeach; ?>               
                </ul>    
        
                
                <a class="outing__article__button"type="button" href="<?php echo get_permalink(74); ?>"value ="<?php echo $filteredValue['outing_id']; ?>">Détails de la sortie</a>
                <form action="" method="post">
                    <input type="hidden" id="userId" name="userId" value="<?php echo $id; ?>">
                    <input type="hidden" id="outingId" name="outingId" value="<?php echo $filteredValue['outing_id']; ?>">
                    <button class="outing__article__button" type="submit">Je participe</button>
                </form>
                

    <?php

    $userId = intval(filter_input(INPUT_POST, 'userId'));
    $outingId = intval(filter_input(INPUT_POST, 'outingId'));

    //var_dump($userId);
    //var_dump($outingId);
    if (!empty($userId) && !empty($outingId)) {
        $wpdb->insert(
            $wpdb->prefix . 'participations',
            array(
                'user_id' => $userId,
                'outing_id' => $outingId
            )
        );
    }

    
?>
                
            </div> 


<?php } ?>

               
        </article>
    </section> -->
</body>


<?php
get_footer();
