<?php

if (!function_exists('getOutingFilteredResults')) {
    function age($date)
    {
        $age = date('Y') - $date;
        if (date('md') < date('md', strtotime($date))) {
            return $age - 1;
        }
        return $age;
    }
}