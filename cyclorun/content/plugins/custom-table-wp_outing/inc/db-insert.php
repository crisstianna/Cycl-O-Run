<?php

function outing_insert_bdd(){

    global $wpdb;
    $table_name = $wpdb->prefix.'outing';
    if (isset($_POST['BtnSubmit'])) {
        $data_array = [
        'nom' => $_POST['nom'],
        'fait_par' => $_POST['fait_par'],
        'address' => $_POST['address'],
        'lat' => $_POST['lat'],
        'long' => $_POST['long'],
        'level' => $_POST['level'],
        'date' => $_POST['date'],
        'time' => $_POST['time'],
        'distance' => $_POST['distance'],
        'practiced_sport' => $_POST['practiced_sport'],
        'picture' => $_POST['picture'],
        'course' => $_POST['course']
       
    ];

     
        $wpdb->insert($table_name, $data_array, array('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s' ));
    };
}