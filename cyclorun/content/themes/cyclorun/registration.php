<?php
/**
 * Template Name: Registration Page
 */

get_header();

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

if (isset($_POST['submit'])) {
        
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

    //*PASSWORD
    if(!empty($_POST['password'])){
        if(strlen($_POST['password']) >= 8){
            if(!empty($_POST['password_confirmation'])){
            
                if($_POST['password'] == $_POST['password_confirmation']){
                    $password= sanitize_text_field($_POST['password']);
                }else{
                    $errors+=['password_confirmation_failed'=> "Veuillez saisir 2 mots de passe identiques"];
                }
            } else {
                $errors+= ['password_confirmation' => "Veuillez confirmer votre mot de passe"];
            }

        }else {
            $errors+= ['password_length' => "Veuillez saisir un mot de passe de 8 caractères minimum"];
           
        }
    } else {
        $errors+= ['password'=> 'Veuillez saisir un mot de passe'];
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
    

    } else {
        $picture = get_bloginfo('url') . '/content/themes/cyclorun/public/images/logo-o.png';
    }

    //*SPORT
    if(array_key_exists('cycling', $_POST) || array_key_exists('running', $_POST)){
        if(array_key_exists('cycling', $_POST)){
            $sport=$_POST['cycling'];
        }

        if(array_key_exists('running', $_POST)){
            $sport=$_POST['running'];
        }

        if(array_key_exists('cycling', $_POST) && array_key_exists('running', $_POST)){
            $cycling=$_POST['cycling'];
            $running=$_POST['running'];
        }

    } else{
        $errors+=['sport' => "Veuillez renseigner un sport"];
    }
    

    //*CYCLING LEVEL
    if (array_key_exists('cycling', $_POST)) {

        if(array_key_exists('cycling_level', $_POST)){
            $cyclinglevel = $_POST['cycling_level'];
        }else{
            $errors += [
                'cyclingLevel' => "Veuillez renseigner votre niveau de cyclisme"
            ];
        }
    }

    //*RUNNING LEVEL
    if (array_key_exists('running',$_POST)) {
        
        if(array_key_exists('running_level',$_POST)){
            $runninglevel = $_POST['running_level'];
        }else{
            $errors += [
                'runningLevel' => "Veuillez renseigner votre niveau de running"
            ];
        }
    }

    //*TERMS
    if(empty($_POST['terms'])){
        $errors +=[
            'terms' => "Veuillez lire et accepter les Conditions Générales d'Utilisation"
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

        if (isset($cycling) && isset($running)) {
            wf_insert_update_user_meta($new_user_id, 'cycling', $cycling);
            wf_insert_update_user_meta($new_user_id, 'running', $running);
        } elseif (isset($sport)) {
            wf_insert_update_user_meta($new_user_id, 'sport', $sport);
        }

        if (isset($cyclinglevel)) {
            wf_insert_update_user_meta($new_user_id, 'cycling_level', $cyclinglevel);
        }

        if (isset($runninglevel)) {
            wf_insert_update_user_meta($new_user_id, 'running_level', $runninglevel);
        }
         
        function displaySuccess(){
            echo '<div class="success">';
                echo '<p class="success__text">Inscription reussie ! <br/> Vous pouvez maintenant vous connecter <br/>';
                echo '<button type="button" class="btn btn-dark navbar__button"><a class="navbar__link" href="' . get_bloginfo('url') . '/login/">Connexion</a></button>';
            echo '</div>';
          }


    } else {
    
        function displayErrors($errors){
          echo '<div class="errors">';
            echo '<ul class="errors__list">';
            foreach($errors as $key){
                echo '<li class="errors__list__item">' . $key . '</li>';
            }  
            echo '</ul>';
            echo '</div>';
        }
            
    }
     

} 
    


?>

<main class="inscription">

    <div class="inscription__page">
      <form class="inscription__form" id="wp_signup_form" action="" method="post" enctype="multipart/form-data">  
            <div class="inscription__form__subsection__left">
                <label class="inscription__form__label__title" for="form-group-connexion-infos">Mes Informations de connexion</label> 
                
                <div class="advise">
                <img class="advise__img" src="https://img.icons8.com/metro/26/000000/box-important.png"/>
                <p>
                    Afin de pouvoir bénéficier de tous les services, tous les champs ci-dessous doivent être renseignés. Seul l'avatar est facultatif.
                </p>
                </div>
                
                <!-- <label>Nom</label> -->
                <input class="inscription__form__input" type="text" name="first_name" id="first_name" value="" placeholder="Prénom"/>
                
                
                
               
                    <!-- <label>Prenom</label> -->
                <input class="inscription__form__input" type="text" name="last_name" id="last_name" value="" placeholder="Nom"/>
                
                
                
                <label class="birthdate" for="birthdate">Date de naissance</label>
                    <input class=" input__birthdate" type="number"  min="01" max="31" name="day_birth" id="day_birth" placeholder="JJ" />
                    <input class=" input__birthdate" type="number"  min="01" max="12" name="month_birth" id="month_birth" placeholder="MM"/>
                    <input class=" input__birthdate" type="number"  min="1950" max="2002" name="year_birth" id="year_birth" placeholder="AAAA"/>

                <!--TODO: create a function to retrieve dynamically max year attribute. Ex: currentYear= 2020-18(min user age) = 2002 -->
                
             
                
                    <label class="avatar" for="picture">Avatar</label>
                    <input class="avatar__input" type="file" name="picture" id="picture" />
                    
             
                

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
                 <div class="advise">
                <img class="advise__img" src="https://img.icons8.com/metro/26/000000/box-important.png"/>
                <p>
                    Veuillez choisir 1 sport au minimum.
                </p>
                </div>
                <div class="inscription__form__selects">
                    <div class="custom-control custom-switch inscription__form__select">
                        <input class="inscription__form__input custom-control-input" type="checkbox" name="cycling" value="cycling" id="cycling">
                         <label class="inscription__form__label__cycling custom-control-label" for="cycling">Vélo</label> 
                         <label class="inscription__form__label mr-sm-2 sr-only" for="cycling-level">Mon Niveau</label> 
                            <select class="custom-select" name="cycling_level" id="cycling_level_select">
                                <option value="" selected>Choisir</option>
                                <option value="Loisirs">Loisirs (inferieur à 15km/sortie)</option>
                                <option value="Régulier">Régulier (15-30 km)</option>
                                <option value="Avancé">Avancé (30-60 km)</option>
                                <option value="Intensif">Intensif (+60 km)</option>
                            </select>
                            
                        
                    </div>
                    <div class="custom-control custom-switch inscription__form__select">
                        <input class="inscription__form__input custom-control-input" type="checkbox" name="running" value="running" id="running">
                        <label class="inscription__form__label custom-control-label" for="running">Running</label> 
                        <label class="inscription__form__label mr-sm-2 sr-only" for="running_level">Mon Niveau </label>
                        <select class="custom-select mr-sm-2" name="running_level" id="running_level_select">
                            <option value="" selected>Choisir</option>
                            <option value="Loisirs">Loisirs (-5km)</option>
                            <option value="Régulier">Régulier (5-10km)</option>
                            <option value="Avancé">Avancé (10-15km)</option>
                            <option value="Intensif">Avancé (+15km)</option>
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

                    if(function_exists('displaySuccess')){
                        displaySuccess();
                    }
                ?>

        </form>

       
        
    </div>




<?php
get_footer();
?>