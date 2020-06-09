<?php

if (!function_exists('getLevel')) {
    function getLevel($idLevel, $idSport) {
        $level = '';

        if($idSport === '1') {

            if($idLevel === '1') {
                $level = 'Loisirs (-15km)';
            }
            else if($idLevel === '2') {
                $level = 'Régulier (15-30km)';
            }
            else if ($idLevel === '3') {
                $level = 'Avancé (30-60km)';
            }
            else if ($idLevel === '4') {
                $level = 'Avancé (30-60km)';
            }
        }
        else if($idSport === '2') {

            if($idLevel === '11') {
                $level = 'Loisirs (-5km)';
            }
            else if($idLevel === '12') {
                $level = 'Régulier (5-10km)';
            }
            else if ($idLevel === '13') {
                $level = 'Avancé (10-15km)';
            }
            else if ($idLevel === '14') {
                $level = 'Avancé (+15km)';
            }
        }
        
        return $level;       
    }
}