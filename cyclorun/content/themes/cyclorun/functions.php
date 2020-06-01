<?php

require('inc/enqueue.php');
require('inc/theme-setup.php');
require('inc/login_setup.php');


//! Essai mais $level est non défini  !?!?!
/* if (!function_exists('getPracticesSport')) {
    function getPracticedSport($idSport) {
        if($idSport === 1) {

            $practicedSport = 'vélo';
            return $practicedSport;
        }
        else if($idSport === 2) {

            $practicedSport = 'course à pieds';
            return $practicedSport;
        }
    }
}

if (!function_exists('getLevel')) {
    function getLevel($idLevel, $idSport) {
        if($idSport === 1) {

            if($idLevel === 1) {
                return $level = 'Loisirs (-15km)';
            }
            else if($idLevel === 2) {
                return $level = 'Régulier (15-30km)';
            }
            else if ($idLevel === 3) {
                return $level = 'Avancé (30-60km)';
            }
            else if ($idLevel === 4) {
                return $level = 'Avancé (30-60km)';
            }
        }
        else if($idSport === 2) {

            if($idLevel === 1) {
                return $level = 'Loisirs (-5km)';
            }
            else if($idLevel === 2) {
                return $level = 'Régulier (5-10km)';
            }
            else if ($idLevel === 3) {
                return $level = 'Avancé (10-50km)';
            }
            else if ($idLevel === 4) {
                return $level = 'Avancé (+15km)';
            }
        }        
    }
} */