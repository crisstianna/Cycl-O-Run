<?php

if (!function_exists('getOutingFilteredResults')) {
    function getOutingFilteredResults($practicedSport, $level, $date, $department)
    {
        global $wpdb;
        $wp_outings = $wpdb->prefix . 'outings';
        $sql = "SELECT * 
            FROM $wp_outings
            WHERE `address` LIKE '%$department%'
        ";

        if (!empty($practicedSport) || !empty($level) || !empty($date)) {
            $sql .= " AND ";
        }

        $condition = "";
        $values = [];

        if (!empty($practicedSport)) {
            $condition .= "`practiced_sport` = %s ";
            $values[] = $practicedSport;
        }

        if (!empty($level)) {
            if ($condition !== '') {
                $condition .= " AND ";
            }
            $condition .= "`level` = %s ";
            $values[] = $level;
        }

        if (!empty($date)) {
            if ($condition !== '') {
                $condition .= " AND ";
            }
            $condition .= "`date` = %s ";
            $values[] = $date;
        }

        $sql .= $condition;

        if (!empty($practicedSport) || !empty($level) || !empty($date)) {
            $preparedStatement = $wpdb->prepare($sql, $values);
            return $wpdb->get_results($preparedStatement, ARRAY_A);
        } else {
            return $wpdb->get_results($sql, ARRAY_A);
        }
    }
}