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
?>

<main class="inscription">
        <div class="inscription__page">
          <h1 class="inscription__title">Inscription</h1>
    
          <form class="inscription__form" id="wp_signup_form" action="" method="post" enctype="multipart/form-data">  
                <div class="inscription__form__subsection__left">
                    <label class="inscription__form__label__title" for="form-group-connexion-infos">Mes Informations de connexion</label> 
                    
                    
                    <!-- <label>Nom</label> -->
                    <input class="inscription__form__input" type="text" name="first_name" id="first_name" value="" placeholder="Prénom" required/>
                    
                    
                    
                   
                        <!-- <label>Prenom</label> -->
                    <input class="inscription__form__input" type="text" name="last_name" id="last_name" value="" placeholder="Nom" required/>
                    
                    
                    
                    
                    
                    <!-- <label class="inscription__form__label__birthdate" for="birthdate">Date de naissance</label> -->
                    <!--<div class="birthdate">
                    <input type="date"
                       id="birthdate"
                       name="birthdate"
                       value=" "
                       title="Please use YYYY-MM-DD as the date format."
                       pattern="(19[0-9][0-9]|20[0-9][0-9])-(1[0-2]|0[1-9])-(3[01]|[21][0-9]|0[1-9])"
                       required>
                    </div>-->
                    <div class="birthdate">   
                    <input class="inscription__form__input__birthdate" type="text" name="day_birth" id="day_birth" value="<?php echo $existing_daybirth; ?>"/>
                    <input class="inscription__form__input__birthdate" type="text" name="month_birth" id="month_birth" value="<?php echo $existing_monthbirth; ?>"/>
                    <input class="inscription__form__input__birthdate" type="text" name="year_birth" id="year_birth" value="<?php echo $existing_yearbirth; ?>"/>
                </div>
                    
                    
                    
                    
                    <div class="existing-prof-pic-cont">
                    <!-- <label class="inscription__form__label" for="user_profile_pic">Avatar</label> -->
                        <input type="file" name="picture" id="picture" />
                    </div>
                    
    
                    <!-- <label class="inscription__form__label" for="email">Adresse Email</label> -->
                        <input class="inscription__form__input" type="email" name="email" id="email" value="" placeholder="email" required/>
                    
                    
    
                   
                    <!-- <label class="inscription__form__label" for="password"> Mot de Passe</label> -->
                        <input class="inscription__form__input" type="password" name="password" id="password" placeholder="Mot de passe" required/>  
                    
                    
    
                    
                    <!-- <label class="inscription__form__label" for="password_confimation"> Confirmation du mot de passe</label> -->
                        <input class="inscription__form__input" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmation du mot de passe" required/>
                    
                    
    
                    
                    <!-- <label class="inscription__form__label" for="address"> Adresse Postale</label> -->
                        <textarea class="inscription__form__input" name="address" id="address" value="" placeholder="Adresse" required></textarea>
                    
                   
                    
                    <!-- <label class="inscription__form__label" for="postcode"> Code Postal</label> -->
                        <input class="inscription__form__input" type="text" name="postcode" id="postcode" value="" placeholder="Code postal" required/>
                    
                    
    
                    
                    <!-- <label class="inscription__form__label" for="city"> Ville</label> -->
                        <input class="inscription__form__input" type="text" name="city" id="city" value="" placeholder="Ville" required/>
                    
                    
                </div>
                <div class="form__subsection__right">
                     <label class="inscription__form__label__title form-group sport-profile" for="form-group-sport-profile">Mon Profil Sportif</label>
                    <div class="inscription__form__selects">
                        <div class="custom-control custom-switch inscription__form__select">
                            <input class="inscription__form__input custom-control-input" type="checkbox" name="cycling" value="cycling" id="cycling">
                             <label class="inscription__form__label custom-control-label" for="cycling">Vélo</label> 
                             <label class="inscription__form__label mr-sm-2 sr-only" for="cycling-level">Mon Niveau</label> 
                                <select class="custom-select mr-sm-2" name="cycling_level" id="cycling_level_select">
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
                        <input class="inscription__form__input" name="terms" id="terms" type="checkbox" value="Yes">  
                        <!-- <label class="inscription__form__label" for="terms">J'ai lu et j'accepte les <a href="#">Conditions Générales d'Utilisation</a></label>   -->
                    </div>
                    <input class="inscription__form__submit" type="submit" id="submitbtn" name="submit" value="S'inscrire"/>
                </div>
            </form>
        </div>
      </main>



<?php
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
$errors=[];
if (isset($_POST['submit'])) {
    // Get form values.
    $firstname = (! empty($_POST['first_name'])) ? sanitize_text_field($_POST['first_name']) : '';
    $lastname = (! empty($_POST['last_name'])) ? sanitize_text_field($_POST['last_name']) : '';
    $username= $firstname . '_' . $lastname;
    $password = (! empty($_POST['password'])) ? sanitize_text_field($_POST['password']) : '';
    $daybirth = (! empty($_POST['day_birth'])) ? intval($_POST['day_birth'], 10) : '';
    $monthbirth = (! empty($_POST['month_birth'])) ? intval($_POST['month_birth'], 10) : '';
    $yearbirth = (! empty($_POST['year_birth'])) ? intval($_POST['year_birth'], 10) : '';
    $email = (! empty($_POST['email'])) ? sanitize_text_field($_POST['email']) : '';
    $address = (! empty($_POST['address'])) ? sanitize_text_field($_POST['address']) : '';
    $postcode = (! empty($_POST['postcode'])) ? intval($_POST['postcode'], 10) : '';
    $city = (! empty($_POST['city'])) ? sanitize_text_field($_POST['city']) : '';

    if (!empty($_POST)) {
        $pictureData = $_FILES['picture']['name'];
        //var_dump($picture);
        if (! function_exists('wp_handle_upload')) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }
        $files = $_FILES['picture'];
        $upload_overrides = array(
            'test_form' => false
        );
        $action = wp_handle_upload($files, $upload_overrides);
        if ($action && !isset($action['error'])) {
            'Le fichier est valide et a été correctement téléchargé';
        //var_dump($action);
        } else {
            echo $action['error'];
        }
        $picture = $action['url'];

        if ($_POST['cycling'] && $_POST['running']) {
            $cycling = sanitize_text_field($_POST['cycling']);
            $running= sanitize_text_field($_POST['running']);
        } elseif ($_POST['cycling']) {
            $sport= sanitize_text_field($_POST['cycling']);
        } elseif ($_POST['running']) {
            $sport= sanitize_text_field($_POST['running']);
        }

        if ($_POST['cycling_level']) {
            $cyclinglevel = $_POST['cycling_level'];
        }

        if ($_POST['running_level']) {
            $runninglevel = $_POST['running_level'];
        }
    }
    //TODO : Others checks

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
}
get_footer();
?>