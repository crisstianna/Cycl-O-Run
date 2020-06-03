
<?php
//? PROCESSING REGISTRATION FORM
    //? STEP 1: if form is submitted, retrieve all values of all inputs and check them
    $errors= [];
    if($_POST['submit']){
        if($_POST['first_name']){
            $firstName = sanitize_text_field($_POST['first_name']);
        } else {
            $errors[]= 'Veuillez renseigner votre prénom';
        }
        if($_POST['last_name']){
            $lastName = sanitize_text_field($_POST['last_name']);
        } else{
            $errors[]= 'Veuillez renseigner votre nom';
        }
        if($_POST['day_birth'] && $_POST['month_birth'] && $_POST['year_birth']){
            $dayBirth = filter_input(INPUT_POST, 'day_birth', FILTER_VALIDATE_INT);
            $monthBirth = filter_input(INPUT_POST, 'month_birth', FILTER_VALIDATE_INT);
            $yearBirth = filter_input(INPUT_POST, 'year_birth', FILTER_VALIDATE_INT );
            $birthDate = $dayBirth . '/' . $monthBirth . '/' . $yearBirth
            $age = Age($birthDate);
            if($age < 18){
                $errors[]= "Pour des raisons de sécurité, il faut être majeur pour s'inscrire sur Cycl'O'Run";
            }
        } else{
            $errors[]= 'Veuillez renseigner votre date de naissance complète';
        }
        if($_POST['address']){
            $address = sanitize_text_field($_POST['address']);
        } else{
            $errors[]= "Veuillez reseigner votre adresse postale"
        }
        if($_POST['postcode']){
            $postcode = filter_input(INPUT_POST, 'postcode', FILTER_VALIDATE_INT);
        } else {
            $errors[] = 'Veuillez renseigner votre code postal'
        }
        if($_POST['city']){
        $city= sanitize_text_field($_POST['city']);
        } else {
            $errors[] = 'Veuillez renseigner votre ville'
        }
        if($_POST['cycling'] && $_POST['running']){
            $cycling= sanitize_text_field($_POST['cycling']);
            $running= sanitize_text_field($_POST['running']);
        } elseif($_POST['cycling']){
            $sport= sanitize_text_field($_POST['cycling']);
        } elseif($_POST['running']) {
            $sport = sanitize_text_field($_POST['running']);
        } else {
            $errors[]= "Veuillez choisir au minimum un sport";
        }
        if($cycling || $sport == 'cycling'){
            $cyclingLevel = sanitize_text_field($_POST['cycling_level']);
        } else {
            $errors[] = 'Veuillez renseigner votre niveau de cyclisme';
        }
        if($running || $sport == 'running'){
            $runningLevel = sanitize_text_field($_POST['running_level']);
        } else {
            $errors[] = 'Veuillez renseigner votre niveau de running';
        }
    } else {
        $errors[]= "Veuillez remplir le formulaire";
    }
    //? STEP 2: If there are no errors, send the data to the database in the corresponding tables (wp_users & wp_usermeta)
    if (empty($errors)){
    }
?>