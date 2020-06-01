<?php

/*
Template Name: Participation Outing
*/

require 'template-parts/participation-outing.php';

$id = get_current_user_id();
$postcodeId = get_user_meta($id, 'postcode');
$department = substr($postcodeId[0], 0, -3);

$practicedSport = filter_input(INPUT_POST, 'practicedSport');
$level = filter_input(INPUT_POST, 'level');
$date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_NUMBER_FLOAT);

// var_dump($practicedSport);
// var_dump($level);
// var_dump($date);

function getOutingFilteredResults($practicedSport, $level, $date, $department) {

    global $wpdb;
    $wp_outings = $wpdb->prefix . 'outings';
    $sql = "SELECT * 
        FROM $wp_outings
        WHERE `address` LIKE '%$department%'
    ";

    if(!empty($practicedSport) || !empty($level) || !empty($date)) {
        $sql .= " AND ";
    }

    $condition = "";
    $values = [];

    if(!empty($practicedSport)) {
        $condition .= "`practiced_sport` = %s ";
        $values[] = $practicedSport;
    }

    if(!empty($level)) {
        if($condition !== '') {
            $condition .= " AND ";
        }
        $condition .= "`level` = %s ";
        $values[] = $level;
    }

    if(!empty($date)) {
        if($condition !== '') {
            $condition .= " AND ";
        }
        $condition .= "`date` = %s ";
        $values[] = $date;
    }

    $sql .= $condition;

    if(!empty($practicedSport) || !empty($level) || !empty($date)) {
        $preparedStatement = $wpdb->prepare($sql, $values);
        return $wpdb->get_results($preparedStatement, ARRAY_A);
    }
    else {
        return $wpdb->get_results($sql, ARRAY_A);
    }
};

$results = getOutingFilteredResults($practicedSport, $level, $date, $department);

//var_dump($results);

foreach($results as $key => $filteredValue) : ?>

        <article class="outing__article">
            <div class="outing__article__image">
                <img class="outing__article__img" src="images/logo-o.png" alt="">
            </div>
            <div>
            <h3 class="outing__article__title"><?php echo $filteredValue['outing_name']; ?></h3>
            <p class="outing__article__date"><?php echo date("d-m-Y", strtotime($filteredValue['date'])); ?></p>
            <p class="outing__article__time"><?php echo substr($filteredValue['time'], 0, -3); ?></p>
            <p class="outing__article__sport"><?php echo $filteredValue['practiced_sport']; ?></p>
            <p class="outing__article__level"><?php echo $filteredValue['level']; ?></p>
            <p class="outing__article__location"><?php echo $filteredValue['address']; ?></p>
            <p class="outing__article__distance"><?php echo $filteredValue['distance']; ?></p>
            <h4>Organisateur de la sortie</h4>
            <img class="outing__article__img" src="images/logo-o.png" alt="AVATAR DE L'AUTEUR">
            <p class="outing__article__author"><?php echo $filteredValue['author']; ?></p>
<?php 

$currentOutingId = $filteredValue['outing_id'];
//var_dump($currentOutingId);

endforeach;

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
                    <p class="outing__article__author"><?= $currentParticipant['display_name']; ?></p>
                </li>
                <?php endforeach; ?>               
            </ul>    
      
            <button class="outing__article__button" type="button">Détails de la sortie</button>
            <button class="outing__article__button" type="button">Je participe</button>
            </div>';                 
        </article>
    </section> -->
</body>

<?php
get_footer();
