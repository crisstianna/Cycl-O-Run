<?php

<<<<<<< HEAD
=======
/*
Template Name: Outing Registration
*/

>>>>>>> 0c79283dbcf43434709a6a86eb6082cca17d6558
require 'template-parts/outing_creation_form.php';

//var_dump($_POST);
$id = get_current_user_id();
//var_dump($id);

global $wpdb;

$outingName = filter_input(INPUT_POST, 'outing_name');
$address = filter_input(INPUT_POST, 'address');
$date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_NUMBER_FLOAT);
$time = filter_input(INPUT_POST, 'time');
$distance = filter_input(INPUT_POST, 'distance', FILTER_SANITIZE_NUMBER_INT);
$practicedSport = filter_input(INPUT_POST, 'practicedSport', FILTER_SANITIZE_NUMBER_INT);
$level = filter_input(INPUT_POST, 'level', FILTER_SANITIZE_NUMBER_INT);
$picture = filter_input(INPUT_POST, 'picture', FILTER_SANITIZE_URL);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);

//var_dump($practicedSport);
//var_dump($level);


if (empty($outingName && $address && $date && $time && $distance && $practicedSport && $level)) {
    echo 'Veuillez remplir tous les champs requis';
    // todo : afficher la bordure rouge pour notifier les champs obligatoires
}
else {
    if(empty($picture)) {
        $picture = 'arbre.jpg';
    }
    $wpdb->insert(
        $wpdb->prefix . 'outings',
        array(
            'outing_name' => $outingName,
            'author' => $id,
            'address' => $address,                
            'date' => $date,
            'time' => $time,
            'distance' => $distance,
            'practiced_sport' => $practicedSport,
            'level' => $level,
            'picture' => $picture,
            'description' => $description
        )
    );

    $outingId = $wpdb->insert_id;

    if (!empty($id && $outingId)) {
        $wpdb->insert(
            $wpdb->prefix . 'participations',
            array(
                'user_id' => $id,
                'outing_id' => $outingId
            )
        );
    }

    // todo : Afficher un message de succès pour l'utilisateur

    // todo : redirection vers la page détails

    
}


