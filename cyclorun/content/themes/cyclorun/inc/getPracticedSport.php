<?php

if (!function_exists('getPracticedSport')) {
    function getPracticedSport($idSport) {
        $practicedSport = '';

        if($idSport === '1') {

            $practicedSport = 'vélo';
            //return $practicedSport;
        }
        else if($idSport === '2') {

            $practicedSport = 'course à pieds';
            //return $practicedSport;
        }
        echo $practicedSport;
    }
}