<?php

/*
Template Name: Outing Registration

*/

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
$practicedSport = filter_input(INPUT_POST, 'practiced_sport', FILTER_SANITIZE_NUMBER_INT);
$cycling_level = filter_input(INPUT_POST, 'cycling_level', FILTER_SANITIZE_NUMBER_INT);
$running_level = filter_input(INPUT_POST, 'running_level', FILTER_SANITIZE_NUMBER_INT);
$picture = filter_input(INPUT_POST, 'picture');
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);

//var_dump($picture);
//var_dump($cycling_level);
//var_dump($running_level);



if (empty($outingName) && empty($address) && empty($date) && empty($time) && empty($distance) && empty($practicedSport)) {
    if(!empty($_POST)) {
        $errors = [];

        if (empty($outingName)) {
            $errors += [
                'outingName' => 'Veuillez renseigner un titre',
            ];
        }
        if (empty($address)) {
            $errors += [
                'address' => 'Veuillez renseigner le point de rencontre <small>(sans oublier le code postal)</small>',
            ];
        }
        if (empty($date)) {
            $errors += [
                'date' => 'Veuillez renseigner la date',
            ];
        }
        if (empty($time)) {
            $errors += [
                'time' => 'Veuillez renseigner l\'heure',
            ];
        }
        if (empty($distance)) {
            $errors += [
                'distance' => 'Veuillez renseigner la distance',
            ];
        }
        if (empty($practicedSport)) {
            $errors += [
                'practicedSport' => 'Veuillez renseigner le sport pratiqué ainsi que le niveau de celui-ci',
            ];
        }
        //var_dump($errors);
        if (!empty($errors)) {
            echo '<div style="font-size:24px;color:red;margin-top:40px;">Veuillez renseigner : ';
            echo '<ul>';

            foreach($errors as $errorKey) {
                echo '<li style="font-size:1rem;color:red;margin-top:40px;">' . $errorKey . '</li>';
            }
            echo '</ul>';
            echo '</div>';            
        }
        // todo l'affichage des erreurs pourait-il se faire sur la droite du formulaire ?
    }    
}

else {
    if(empty($picture)) {
        $picture = '/public/images/logo-o.png.jpg';
    }

    if ($practicedSport === 1 && empty($cycling_level) || $practicedSport === 2 && empty($running_level)) {
        echo 'Veuillez renseigner le niveau associé au sport choisi';
        exit;
    }
    else {
        if (!empty($cycling_level)) {
            $level = $cycling_level;
        }
        if (!empty($running_level)) {
            $level = $running_level;
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
    }    

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

    if ($id && $outingId) {
        echo '<div style="font-size:24px;color:#00757f;margin-top:40px;">Félicitations ! Votre sortie a bien été ajoutée !</div>';
        echo '<button type="button" class="btn btn-dark navbar__button"><a class="navbar__link" href="' . get_bloginfo('url') . '/outing-details/' . '">Voir ma sortie en détails</a></button>';
        echo '<button type="button" class="btn btn-dark navbar__button"><a class="navbar__link" href="' . get_bloginfo('url') . '/profile-page/' . '">Retour sur mon profil</a></button>';
    }    
}

get_footer();



