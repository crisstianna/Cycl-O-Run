<?php
/**
 * Template Name: Registration Page
 */

ob_start();
get_header();
$user_id = get_current_user_id();
$existing_firstname = ( get_user_meta( $user_id, 'first_name', true ) ) ? get_user_meta( $user_id, 'first_name', true ) : '';
$existing_lastname = ( get_user_meta( $user_id, 'last_name', true ) ) ? get_user_meta( $user_id, 'last_name', true ) : '';
$existing_daybirth = ( get_user_meta( $user_id, 'day_birth', true ) ) ? get_user_meta( $user_id, 'day_birth', true ) : '';
$existing_monthbirth = ( get_user_meta( $user_id, 'month_birth', true ) ) ? get_user_meta( $user_id, 'month_birth', true ) : '';
$existing_yearbirth = ( get_user_meta( $user_id, 'year_birth', true ) ) ? get_user_meta( $user_id, 'year_birth', true ) : '';
$existing_email = ( get_user_meta( $user_id, 'email', true ) ) ? get_user_meta( $user_id, 'email', true ) : '';
$existing_address = ( get_user_meta( $user_id, 'adress', true ) ) ? get_user_meta( $user_id, 'adress', true ) : '';
$existing_postcode = ( get_user_meta( $user_id, 'postcode', true ) ) ? get_user_meta( $user_id, 'postcode', true ) : '';
$existing_city = ( get_user_meta( $user_id, 'city', true ) ) ? get_user_meta( $user_id, 'city', true ) : '';


// Attachment for profile image.
$attachment_id = ( get_user_meta( $user_id, 'user_prfl_img_post_id', true ) ) ? get_user_meta( $user_id, 'user_prfl_img_post_id', true ) : '';
$attachment_id = intval( $attachment_id );
$profile_pic_img =  wp_get_attachment_image( $attachment_id, array('700', '600'), "", array( "class" => "wf-profile-page-prof-img" ) );

if ( ! function_exists( 'wf_insert_update_user_meta' ) ) {
    /**
     * Creates a meta key and inserts the meta value.
     * If the passed meta key already exists then updates the meta value.
     *
     * @param {int} $user_id User Id.
     * @param {string} $meta_key Meta Key.
     * @param {string} $meta_value Meta value.
     *
     * @return bool
     */
    function wf_insert_update_user_meta( $user_id, $meta_key, $meta_value ) {
        // Add data in the user meta field.
        $meta_key_not_exists = add_user_meta( $user_id, $meta_key, $meta_value, true );
        // If meta key already exists then just update the meta value for and return true
        if ( ! $meta_key_not_exists ) {
            update_user_meta( $user_id, $meta_key, $meta_value );
            return true;
        }
    }
}

// If the form is submitted

if (!empty($_POST)) {
        
    $errors=[];

    //*FIRSTNAME
    if(!empty($_POST['first_name'])){
        $firstname = sanitize_text_field($_POST['first_name']);
    } else {
        $errors += [
            'firstname' => "Veuillez renseigner votre prénom"
        ];
    }

    //*LASTNAME
    if(!empty($_POST['last_name'])){
        $lastname = sanitize_text_field($_POST['last_name']);
        $username= $firstname . '_' . $lastname;
    } else {
        $errors += [
            'lastname' => "Veuillez renseigner votre nom"
        ];
    }

    //*BIRTHDATE
    if(!empty($_POST['day_birth']) && !empty($_POST['month_birth']) && !empty($_POST['year_birth'])){
        $daybirth = intval($_POST['day_birth'], 10);
        $monthbirth = intval($_POST['month_birth'], 10);
        $yearbirth = intval($_POST['year_birth'], 10);
    } else {
        $errors += [
            'birthdate' => "Veuillez renseigner votre date de naissance complète"
        ];
    }

    //*EMAIL
    if(!empty($_POST['email'])){
        $email=$_POST['email'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors += [
                'wrongEmail' => "L'email renseigné est invalide"
            ];
        }

    } else {
        $errors += [
            'emptyEmail' => "Veuillez renseigner votre adresse e-mail"
        ];
    }

    //*ADDRESS
    if(!empty($_POST['address'])){
        $address = sanitize_text_field($_POST['address']);
    } else {
        $errors += [
            'address' => "Veuillez renseigner votre adresse postale: N°, type et libellé de la voie"
        ];
    }

    //*POSTCODE
    if(!empty($_POST['postcode'])){
        $postcode = intval($_POST['postcode'], 10);
    } else {
        $errors +=  [
            'postcode' => "Veuillez renseigner votre code postal"
        ];
    }

    //*CITY
    if(!empty($_POST['city'])){
        $city = sanitize_text_field($_POST['city']);
    } else {
        $errors += [
            'city' => "Veuillez renseigner votre ville"
        ];
    }

    //*AVATAR
    if(!empty($_FILES)){
        $pictureData = $_FILES['picture']['name'];

        if (! function_exists('wp_handle_upload')) {
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

            if($action['error'] !== "No file was uploaded."){
                $errors += [
                    'picture' => $action['error']
                ];
            }
        }

      

    }

    //*SPORT
    if (!empty($_POST['cycling']) && !empty($_POST['running'])) {
        $cycling = sanitize_text_field($_POST['cycling']);
        $running= sanitize_text_field($_POST['running']);
    } else{
        $errors += [
            'sport' => "Veuillez choisir un sport"
        ];
    }

    //*CYCLING LEVEL
    if (!empty($_POST['cycling']) && !empty($_POST['cycling_level'])) {
        $cyclinglevel = $_POST['cycling_level'];
    } else {
        $errors += [
            'cyclingLevel' => "Veuillez renseigner votre niveau de cyclisme"
        ];
    }

    //*RUNNING LEVEL
    if (!empty($_POST['running']) && !empty($_POST['running_level'])) {
        $runninglevel = $_POST['running_level'];
    } else {
        $errors += [
            'runningLevel' => "Veuillez renseigner votre niveau de course à pied"
        ];
    }

    //* SEND DATA TO DB
    if(empty($errors)){
        $new_user_id = wp_create_user($username, $password, $email);

        // Insert/Update the form values to user_meta table.

        wf_insert_update_user_meta($new_user_id, 'first_name', $firstname);
        wf_insert_update_user_meta($new_user_id, 'last_name', $lastname);
        wf_insert_update_user_meta($new_user_id, 'day_birth', $daybirth);
        wf_insert_update_user_meta($new_user_id, 'month_birth', $monthbirth);
        wf_insert_update_user_meta($new_user_id, 'year_birth', $yearbirth);
        wf_insert_update_user_meta($new_user_id, 'picture', $picture);
        wf_insert_update_user_meta($new_user_id, 'email', $email);
        wf_insert_update_user_meta($new_user_id, 'address', $address);
        wf_insert_update_user_meta($new_user_id, 'postcode', $postcode);
        wf_insert_update_user_meta($new_user_id, 'city', $city);

        if ($cycling && $running) {
            wf_insert_update_user_meta($new_user_id, 'cycling', $cycling);
            wf_insert_update_user_meta($new_user_id, 'running', $running);
        } elseif ($sport) {
            wf_insert_update_user_meta($new_user_id, 'sport', $sport);
        }

        if ($cyclinglevel) {
            wf_insert_update_user_meta($new_user_id, 'cycling_level', $cyclinglevel);
        }

        if ($runninglevel) {
            wf_insert_update_user_meta($new_user_id, 'running_level', $runninglevel);
        }
         
        // Once everything is done redirect the user back to the same page
        $location =  get_bloginfo('url') . '/login/';
        wp_safe_redirect($location);


        exit;

    } else {
    
        function displayErrors($errors){
          echo '<div class="errors">';
            echo '<ul class="errors__list">';
            foreach($errors as $key){
                echo '<li>' . $key . '</li>';
            }  
            echo '</ul>';
            echo '</div>';
        }
            
    }
     

} else {
    $errors =['formulaire' => 'Le formulaire ne peut être vide'];
}
    


?>

<main class="inscription">

    <div class="inscription__page">
      <form class="inscription__form" id="wp_signup_form" action="" method="post" enctype="multipart/form-data">  
            <div class="inscription__form__subsection__left">
                <label class="inscription__form__label__title" for="form-group-connexion-infos">Mes Informations de connexion</label> 
                
                
                <!-- <label>Nom</label> -->
                <input class="inscription__form__input" type="text" name="first_name" id="first_name" value="" placeholder="Prénom"/>
                
                
                
               
                    <!-- <label>Prenom</label> -->
                <input class="inscription__form__input" type="text" name="last_name" id="last_name" value="" placeholder="Nom"/>
                
                
                
                <label class="birthdate" for="birthdate">Date de naissance</label>
                    <input class=" input__birthdate" type="number" pattern="[0-9]*" min="01" max="31" name="day_birth" id="day_birth" placeholder="JJ" />
                    <input class=" input__birthdate" type="number" pattern="[0-9]*" min="01" max="12" name="month_birth" id="month_birth" placeholder="MM"/>
                    <input class=" input__birthdate" type="number" pattern="[0-9]*" min="1950" max="2002" name="year_birth" id="year_birth" placeholder="AAAA"/>

                <!--TODO: create a function to retrieve dynamically max year attribute. Ex: currentYear= 2020-18(min user age) = 2002 -->
                
             
                <div class="existing-prof-pic-cont">
                <!-- <label class="inscription__form__label" for="user_profile_pic">Avatar</label> -->
                    <input class="inscription__form__input" type="file" name="picture" id="picture" />
                </div>
                

                <!-- <label class="inscription__form__label" for="email">Adresse Email</label> -->
                    <input class="inscription__form__input" type="email" name="email" id="email" value="" placeholder="email"/>
                
                

               
                <!-- <label class="inscription__form__label" for="password"> Mot de Passe</label> -->
                    <input class="inscription__form__input" type="password" name="password" id="password" placeholder="Mot de passe"/>  
                
                

                
                <!-- <label class="inscription__form__label" for="password_confimation"> Confirmation du mot de passe</label> -->
                    <input class="inscription__form__input" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmation du mot de passe"/>
                
                

                
                <!-- <label class="inscription__form__label" for="address"> Adresse Postale</label> -->
                    <textarea class="inscription__form__input" name="address" id="address" value="" placeholder="Adresse"></textarea>
                
               
                
                <!-- <label class="inscription__form__label" for="postcode"> Code Postal</label> -->
                    <input class="inscription__form__input" type="text" name="postcode" id="postcode" value="" placeholder="Code postal"/>
                
                

                
                <!-- <label class="inscription__form__label" for="city"> Ville</label> -->
                    <input class="inscription__form__input" type="text" name="city" id="city" value="" placeholder="Ville"/>
                
                
            </div>
            <div class="inscription__form__subsection__right">
                 <label class="inscription__form__label__title form-group sport-profile" for="form-group-sport-profile">Mon Profil Sportif</label>
                <div class="inscription__form__selects">
                    <div class="custom-control custom-switch inscription__form__select">
                        <input class="inscription__form__input custom-control-input" type="checkbox" name="cycling" value="cycling" id="cycling">
                         <label class="inscription__form__label custom-control-label" for="cycling">Vélo</label> 
                         <label class="inscription__form__label mr-sm-2 sr-only" for="cycling-level">Mon Niveau</label> 
                            <select class="custom-select" name="cycling_level" id="cycling_level_select">
                                <option value="" selected>Choisir</option>
                                <option value="loisirs">Loisirs (inferieur à 15km/sortie)</option>
                                <option value="regulier">Régulier (15-30 km)</option>
                                <option value="avance">Avancé (30-60 km)</option>
                                <option value="intensif">Intensif (+60 km)</option>
                            </select>
                            
                        
                    </div>
                    <div class="custom-control custom-switch inscription__form__select">
                        <input class="inscription__form__input custom-control-input" type="checkbox" name="running" value="running" id="running">
                        <label class="inscription__form__label custom-control-label" for="running">Running</label> 
                        <label class="inscription__form__label mr-sm-2 sr-only" for="running_level">Mon Niveau </label>
                        <select class="custom-select mr-sm-2" name="running_level" id="running_level_select">
                            <option value="" selected>Choisir</option>
                            <option value="loisirs">Loisirs (inferieur à 15km/sortie)</option>
                            <option value="regulier">Régulier (15-30 km)</option>
                            <option value="avance">Avancé (30-60 km)</option>
                            <option value="intensif">Intensif (+60 km)</option>
                        </select>
                    </div>
                </div>
                <div class="inscription__form__conditions">
                    <input class="input-checkbox" name="terms" id="terms" type="checkbox" value="Yes">  
                    <label class="inscription__form__label  terms" for="terms">J'ai lu et j'accepte les <a href="#">Conditions Générales d'Utilisation</a></label>
                </div>
                
                <input class="inscription__form__submit" type="submit" id="submitbtn" name="submit"/>

                <?php 

                    if(function_exists('displayErrors')){
                        displayErrors($errors);
                    } 
                ?>

        </form>

       
        
    </div>




<?php
get_footer();
?>