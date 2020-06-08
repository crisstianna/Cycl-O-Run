
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
            $birthDate = $dayBirth . '/' . $monthBirth . '/' . $yearBirth;
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
<main class="inscription">
    <div class="inscription__page">
      <h1 class="inscription__title">Inscription</h1>

      <form class="inscription__form" id="wp_signup_form" action="" method="post" enctype="multipart/form-data">  
            <div class="inscription__form__subsection__left">
                <label class="inscription__form__label__title" for="form-group-connexion-infos">Mes Informations de connexion</label>
                
                <div class="form-control ">
                <label>Nom</label>
                <input class="inscription__form__input" type="text" name="first_name" id="first_name" value="<?php echo $existing_firstname; ?>" placeholder="Prénom"/>
                <i class="fa fa-check-circle"></i>
                <i class="fa fa-exclamation-circle"></i>
                <small>Error Message</small>
                </div>
                
                <div class="form-control error">
                    <label>Prenom</label>
                <input class="inscription__form__input" type="text" name="last_name" id="last_name" value="<?php echo $existing_lastname; ?>" placeholder="Nom"/>
                <i class="fa fa-check-circle"></i>
                <i class="fa fa-exclamation-circle"></i>
                <small>Error Message</small>
                </div>
                
                
                <div class="form-control">
                <label class="inscription__form__label__birthdate" for="birthdate">Date de naissance</label>
                <div class="birthdate">
                    <input class="inscription__form__input__birthdate" type="date" name="birthdate" id="birthdate" value=""/>
                </div>
                <i class="fa fa-check-circle"></i>
                <i class="fa fa-exclamation-circle"></i>
                <small>Error Message</small>
                </div>
                
                
                <div class="from-control">
                <div class="existing-prof-pic-cont"><?php echo $profile_pic_img; ?></div>
                <label class="inscription__form__label" for="user_profile_pic">Avatar</label>
                    <input type="file" name="user_profile_pic" id="user_profile_pic" />
                
                <i class="fa fa-check-circle"></i>
                <i class="fa fa-exclamation-circle"></i>
                <small>Error Message</small>
                </div>

                <div class="form-control">
                <label class="inscription__form__label" for="email">Adresse Email</label>
                    <input class="inscription__form__input" type="email" name="email" id="email" value="<?php echo $existing_email; ?>"/>
                
                <i class="fa fa-check-circle"></i>
                <i class="fa fa-exclamation-circle"></i>
                <small>Error Message</small>
                </div>

                <div class="form-control">
                <label class="inscription__form__label" for="password"> Mot de Passe</label>
                    <input class="inscription__form__input" type="password" name="password" id="password"/>  
                
                <i class="fa fa-check-circle"></i>
                <i class="fa fa-exclamation-circle"></i>
                <small>Error Message</small>
                </div>

                <div class="form-control">
                <label class="inscription__form__label" for="password_confimation"> Confirmation du mot de passe</label>
                    <input class="inscription__form__input" type="password" name="password_confirmation" id="password_confirmation"/>
                
                <i class="fa fa-check-circle"></i>
                <i class="fa fa-exclamation-circle"></i>
                <small>Error Message</small>
                </div>

                <div class="form-control">
                <label class="inscription__form__label" for="address"> Adresse Postale</label>
                    <textarea class="inscription__form__input" name="address" id="address" value="<?php echo $existing_address; ?>"></textarea>
                
                <i class="fa fa-check-circle"></i>
                <i class="fa fa-exclamation-circle"></i>
                <small>Error Message</small>
                </div>

                <div class="form-control">
                <label class="inscription__form__label" for="postcode"> Code Postal</label>
                    <input class="inscription__form__input" type="text" name="postcode" id="postcode" value="<?php echo $existing_postcode; ?>"/>
                
                <i class="fa fa-check-circle"></i>
                <i class="fa fa-exclamation-circle"></i>
                <small>Error Message</small>
                </div>

                <div class="form-control">
                <label class="inscription__form__label" for="city"> Ville</label>
                    <input class="inscription__form__input" type="text" name="city" id="city" value="<?php echo $existing_city; ?>"/>
                
                <i class="fa fa-check-circle"></i>
                <i class="fa fa-exclamation-circle"></i>
                <small>Error Message</small>
                </div>
            </div>
            <div class="form__subsection">
                <label class="inscription__form__label__title form-group sport-profile" for="form-group-sport-profile">Mon Profil Sportif</label>
                <div class="inscription__form__selects">
                    <div class="custom-control control-form custom-switch inscription__form__select">
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
                            <i class="fa fa-check-circle"></i>
                            <i class="fa fa-exclamation-circle"></i>
                            <small>Error Message</small>
                        
                    </div>
                    <div class="custom-control control-form custom-switch inscription__form__select">
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
                    <label class="inscription__form__label" for="terms">J'ai lu et j'accepte les <a href="#">Conditions Générales d'Utilisation</a></label>  
                </div>
                <input class="inscription__form__submit" type="submit" id="submitbtn" name="submit" value="S'inscrire"/>
            </div>
        </form>
    </div>
  </main>
