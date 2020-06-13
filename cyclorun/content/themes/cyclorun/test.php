<?php
/*
Template Name: Outing Registration
*/
require 'template-parts/outing_creation_form.php';

//recovery the user id
$id = get_current_user_id();

global $wpdb;

// add filters on the inputs
$outingName = filter_input(INPUT_POST, 'outing_name');
$address = filter_input(INPUT_POST, 'address');
$date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_NUMBER_FLOAT);
$time = filter_input(INPUT_POST, 'time');
$distance = filter_input(INPUT_POST, 'distance', FILTER_SANITIZE_NUMBER_INT);
$practicedSport = filter_input(INPUT_POST, 'practiced_sport', FILTER_SANITIZE_NUMBER_INT);
$cycling_level = filter_input(INPUT_POST, 'cycling_level', FILTER_SANITIZE_NUMBER_INT);
$running_level = filter_input(INPUT_POST, 'running_level', FILTER_SANITIZE_NUMBER_INT);
$description = filter_input(INPUT_POST, 'description');

// if the form was submit
if (!empty($_POST)) {
    $pictureData = $_FILES['picture']['name'];

    $errors = [];

    if (!function_exists('wp_handle_upload')) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
    }

    $files = $_FILES['picture'];

    $upload_overrides = array(
        'test_form' => false
    );

    $action = wp_handle_upload($files, $upload_overrides);

    if ($action && !isset($action['error'])) {
        $picture = $action['url'];
    } else {
        if($action['error']) {
            $errors += [
                'pictureError' => 'Une image valide'
            ];
        }
    }
  
    if (empty($outingName) && empty($address) && empty($date) && empty($time) && empty($distance) && empty($practicedSport)) {
        

        if (empty($outingName)) {
            $errors += [
                'outingName' => 'un titre',
            ];
        }
        if (empty($address)) {
            $errors += [
                'address' => 'le point de rencontre <small>(sans oublier le code postal)</small>',
            ];
        }
        if (empty($date)) {
            $errors += [
                'date' => 'la date',
            ];
        }
        if (empty($time)) {
            $errors += [
                'time' => 'l\'heure',
            ];
        }
        if (empty($distance)) {
            $errors += [
                'distance' => 'la distance',
            ];
        }
        if (empty($practicedSport)) {
            $errors += [
                'practicedSport' => 'le sport pratiqué ainsi que le niveau de celui-ci',
            ];
        }

        if (!empty($errors)) {
            echo '<div class ="outing-reg__errors">Veuillez renseigner : ';
            echo '<ul class ="outing-reg__errors__ul">';
            foreach ($errors as $errorKey) {
                echo '<li class ="outing-reg__errors__li">' . $errorKey . '</li>';
            }
            echo '</ul>';
            echo '</div>';
        }
    } else {
        if (empty($picture)) {
            $picture = get_bloginfo('url') . '/content/themes/public/images/logo-o.png';
        }
        if ($practicedSport) {
            if ($practicedSport === 1 && empty($cycling_level) || $practicedSport === 2 && empty($running_level)) {
                echo 'Veuillez renseigner le niveau associé au sport choisi';
                exit;
            } else {
                if (!empty($cycling_level)) {
                    $level = $cycling_level;
                }
                if (!empty($running_level)) {
                    $level = $running_level;
                }
            }
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
    
    // function who returns false if he insert didn't work
    $wpError = $wpdb->show_errors();
    //recovery of the last insert
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
    if ($wpError !== false && $id && $outingId) {
        echo '<div class ="outing-reg__ok">Votre sortie a bien été créée !! ';
        echo '<button type="button" class="btn btn-dark navbar__button"><a class="navbar__link" href="' . get_bloginfo('url') . '/outing-details/?outingId=' . $outingId . '">Voir ma sortie en détails</a></button>';
        echo '<button type="button" class="btn btn-dark navbar__button"><a class="navbar__link" href="' . get_bloginfo('url') . '/profile-page/' . '">Retour sur mon profil</a></button>';
        echo '</div>';
    }if ($wpError === false) {
        echo '<div style="font-size:24px;color:#00757f;margin-top:40px;">Quelque chose s\'est mal passé, veuillez recommencer</div>';
    }    
}
get_footer();