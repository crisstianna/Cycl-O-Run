<?php

require 'template-parts/outing_creation_form.php';

//var_dump($_POST);
$id = get_current_user_id();

// TODO récupérer l'id de l'auteur et ajouter le textarea dans la table

global $wpdb;

$outingName = filter_input(INPUT_POST, 'outing_name');
$address = filter_input(INPUT_POST, 'address');
$date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_NUMBER_FLOAT);
$time = filter_input(INPUT_POST, 'time');
$distance = filter_input(INPUT_POST, 'distance', FILTER_SANITIZE_NUMBER_INT);
$practicedSport = filter_input(INPUT_POST, 'practicedSport');
$level = filter_input(INPUT_POST, 'level');
$picture = filter_input(INPUT_POST, 'picture', FILTER_SANITIZE_URL);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);

//var_dump($description);

$errors = [];


if (empty($outingName)) {
    $errors['outing_name'] = 'Veuillez entrer un nom pour votre sortie';
}
if (empty($address)) {
    $errors['address'] = 'Veuillez entrer une adresse pour votre sortie';
}    
if (empty($date)) {
    $errors['date'] = 'Veuillez renseigner la date de votre sortie';
}
if (empty($time)) {
    $errors['time'] = 'Veuillez saisir l\'heure de rendez-vous pour votre sortie';
}
if (empty($distance)) {
    $errors['distance'] = 'Veuillez entrer la distance prévue pour le parcours';
}   
if (empty($practicedSport)) {
    $errors['practiced_sport'] = 'Veuillez choisir le type de sport pour la sortie';
} 
if (empty($level)) {
    $errors['level'] = 'Veuillez sélectionner le niveau de votre sortie';
}
if (empty($picture)) {
    // TODO $picture = 'A déterminer';
}
if (empty($description)) {
    $errors['course'] = 'Veuillez donner une description du parcours';
}
else {
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

    var_dump($wpdb);
    // header("Location: ");
    // exit;
}