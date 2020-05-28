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

<!--
<form action="" method="post" enctype="multipart/form-data">
    <label for=""
    <label for="first_name">Prénom
        <input id="first_name" type="text" name="first_name" value="<?php echo $existing_firstname; ?>">
    </label>
    <label for="last_name">Nom
        <input id="first_name" type="text" name="first_name" value="<?php echo $existing_lastname; ?>">
    </label>
    <label for="user_age">Age
        <input id="user_age" type="number" name="user_age" value="<?php echo $existing_age; ?>">
    </label>
        <div class="existing-prof-pic-cont"><?php echo $profile_pic_img; ?></div>
    <label for="user_profile_pic">Profile pic
        <input type="file" name="user_profile_pic" id="user_profile_pic" />
    </label>
    <input type="submit" name="submit" value="Submit">
</form>
-->

<form id="wp_signup_form" action="" method="post" enctype="multipart/form-data">  

    
<div >
<label class="form-group connexion-infos" for="form-group-connexion-infos">Mes Informations de connexion
    <label for="first_name">Prénom
        <input type="text" name="first_name" id="first_name" value="<?php echo $existing_firstname; ?>"/>
    </label>

    <label for="last_name">Nom
        <input type="text" name="last_name" id="last_name" value="<?php echo $existing_lastname; ?>"/>
    </label>

    <div class="birthdate">
        <label for="birthdate">Date de naissance
            <label for="day_birth"> Jour
                <input type="text" name="day_birth" id="day_birth" value="<?php echo $existing_daybirth; ?>">
            </label>
            <label for="month_birth"> Mois
                <input type="text" name="month_birth" id="month_birth" value="<?php echo $existing_monthbirth; ?>">
            </label>
            <label for="year_birth"> Année
                <input type="text" name="year_birth" id="year_birth" value="<?php echo $existing_yearbirth; ?>">
            </label>
        </label>
    </div>

    <div class="existing-prof-pic-cont"><?php echo $profile_pic_img; ?></div>
    <label for="user_profile_pic">Avatar
        <input type="file" name="user_profile_pic" id="user_profile_pic" />
    </label>
    
    <label for="email">Adresse Email
        <input type="email" name="email" id="email" value="<?php echo $existing_email; ?>"/>
    </label>

    <label for="password"> Mot de Passe
        <input type="password" name="password" id="password"/>  
    </label>

    <label for="password_confimation"> Confirmation du mot de passe
        <input type="password" name="password_confirmation" id="password_confirmation"/>
    </label>

    <label for="address"> Adresse Postale
        <textarea name="address" id="address" value="<?php echo $existing_address; ?>""></textarea>
    </label>

    <label for="postcode"> Code Postal
        <input type="text" name="postcode" id="postcode" value="<?php echo $existing_postcode; ?>"/>
    </label>

    <label for="city"> Ville
        <input type="text" name='city' id="city" value="<?php echo $existing_city; ?>"/>
    </label>
</label>
<label class="form-group sport-profile" for="form-group-sport-profile">Mon Profil Sportif

    <div class="custom-control custom-switch">
        <input type="checkbox" name="cycling" value="cycling" class="custom-control-input" id="cycling">
        <label class="custom-control-label" for="cycling">Vélo</label>
        <label class="mr-sm-2 sr-only" for="cycling-level">Mon Niveau
            <select class="custom-select mr-sm-2" name="cycling_level" id="cycling_level_select">
                <option value="" selected>Choisir</option>
                <option value="loisirs">Loisirs (inferieur à 15km/sortie)</option>
                <option value="regulier">Régulier (15-30 km)</option>
                <option value="avance">Avancé (30-60 km)</option>
                <option value="intensif">Intensif (+60 km)</option>
            </select>
        </label>
    </div>
    <div class="custom-control custom-switch">
        <input type="checkbox" name="running" value="running" class="custom-control-input" id="running">
        <label class="custom-control-label" for="running">Running</label>
        <label class="mr-sm-2 sr-only" for="running_level">Mon Niveau
            <select class="custom-select mr-sm-2" name="running_level" id="running_level_select">
                <option value="" selected>Choisir</option>
                <option value="loisirs">Loisirs (inferieur à 15km/sortie)</option>
                <option value="regulier">Régulier (15-30 km)</option>
                <option value="avance">Avancé (30-60 km)</option>
                <option value="intensif">Intensif (+60 km)</option>
            </select>
        </label>
    </div>
</label>

    <input name="terms" id="terms" type="checkbox" value="Yes">  
    <label for="terms">J'ai lu et j'accepte les <a href="#">Conditions Générales d'Utilisation</a></label>  

    <input type="submit" id="submitbtn" name="submit" value="S'inscrire"/>  

</form>




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
if ( ! function_exists( 'wf_create_update_user_post' ) ) {
    function wf_create_update_user_post( $user_id, $user_display_name, $post_status ) {
        $post_id = get_user_meta( $user_id, 'user_custom_post', true );
        if ( $post_id ) {
            // The custom post already exists , we just update .
            $my_post = array(
                'ID'           => $post_id,
                'post_title'   => sanitize_text_field( $user_display_name ),
                'post_status'   => $post_status,
                'post_content'   => '',
                'post_name' => sanitize_text_field( $user_display_name )
            );
            wp_update_post( $my_post, false );
        } else {
            // Custom post does not exist for this user
            $my_post = array(
                'post_author' => $user_id,
                'post_title'   => sanitize_text_field( $user_display_name ),
                'post_status'   => 'pending',
                'post_content'   => 'test',
                'post_name' => sanitize_text_field( $user_display_name ),
                'post_type' => 'post'
            );
            $post_id = wp_insert_post( $my_post ); // It will return the new inserted $post_id
            $meta_existed = wf_insert_update_user_meta( $user_id, 'user_custom_post', $post_id );
        }
        return $post_id;
    }
}
if ( ! function_exists( 'wf_move_attach_to_upload_dir' ) ) {
    /**
     * Uses wordpress function wp_handle_upload() to move the uploaded file into
     * wordpress upload's directory.
     *
     * @param {string} $file_input_name File name.
     *
     * @return {array} $movefile Array containing the path, url and other uploaded file info.
     */
    function wf_move_attach_to_upload_dir( $file_input_name ) {
        if ( ! function_exists( 'wp_handle_upload' ) ) {
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
        }
        $uploadedfile = $_FILES[ $file_input_name ];
        $upload_overrides = array( 'test_form' => false );
        $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
        if ( $movefile && ! isset( $movefile['error'] ) ) {
//          return "File is valid, and was successfully uploaded.\n";
            return $movefile;
        } else {
            /**
             * Error generated by _wp_handle_upload()
             * @see _wp_handle_upload() in wp-admin/includes/file.php
             */
            return $movefile['error'];
        }
    }
}
if ( ! function_exists( 'wf_save_profile_media' ) ) {
    /**
     * @param {string} $file_input_name File name.
     *
     * @return {array|bool} $inserted_file_obj or false File object containing file info.
     */
    function wf_save_profile_media( $file_input_name ) {
        $errors= array();
        $file_size = ( ! empty( $_FILES[ $file_input_name ]['size'] ) ) ? $_FILES[ $file_input_name ]['size'] : '';
        $file_type = ( ! empty( $_FILES[ $file_input_name ]['type'] ) ) ? $_FILES[ $file_input_name ]['type'] : '';
        $file_ext_arr = explode( '/', $file_type );
        $file_ext = ( ! empty( $file_ext_arr[1] ) ) ? $file_ext_arr[1] : '';
        $expensions= array( "jpeg", "jpg", "png", "pdf" );
        // Check if the file has the required format.
        if( false === in_array( $file_ext, $expensions ) ){
            $errors[]="Extension not allowed, please choose a JPEG or PNG file.";
        }
        // Check if the file has the required size . Below unit is in Bytes ( 2097152 = 2 Mb )
        if( $file_size > 2097152 ){
            $errors[]='File size must be exactly 2 MB';
        }
        // If there are no errors and the file is of the type and size we permit.
        if ( empty( $errors ) ) {
            $inserted_file_obj = wf_move_attach_to_upload_dir( $file_input_name );
            return $inserted_file_obj;
        } else {
            return false;
        }
    }
}
if ( ! function_exists( 'wf_update_post_with_attach' ) ) {
    /**
     * @param {string} $filename Absolute path of file up until WordPress upload's directory
     * @param {int} $post_id Post Id.
     * @param {int} $user_id User id.
     * @param {string} $pic_type Profile or work file.
     */
    function wf_update_post_with_attach( $filename, $post_id, $user_id, $pic_type ) {
        // $filename should be the path to a file in the upload directory.
        // The ID of the post this attachment is for.
        $parent_post_id = $post_id;
        // Check the type of file. We'll use this as the 'post_mime_type'.
        $filetype = wp_check_filetype( basename( $filename ), null );
        // Get the path to the upload directory.
        $wp_upload_dir = wp_upload_dir();
        // Prepare an array of post data for the attachment.
        $attachment = array(
            'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ),
            'post_mime_type' => $filetype['type'],
            'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
            'post_content'   => '',
            'post_status'    => 'inherit'
        );
        if ( 'profile-pic' === $pic_type ) {
            // Insert the attachment.
            $attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );
            wf_insert_update_user_meta( $user_id, 'user_prfl_img_post_id', $attach_id );
        }
        // Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
    }
}
if ( ! function_exists( 'wf_handle_profile_media' ) ) {
    /**
     * Handles media upload.
     * Checks if the media is uploaded, uses custom functions to move the media to WordPress uploads directory,
     * deletes previous uploaded media from uploads dir and the attachment post and creates/updates the new one.
     *
     * @param {int} $post_id Post Id.
     * @param {int} $user_id User Id.
     */
    function wf_handle_profile_media( $post_id, $user_id ) {
        if( ! empty( $_FILES ) ){
            // Profile Pic
            if ( ! empty( $_FILES['user_profile_pic'] ) ) {
                $inserted_file_obj = wf_save_profile_media( 'user_profile_pic' );
                $file_path = ( ! empty( $inserted_file_obj ) ) ? $inserted_file_obj['file'] : '';
                // If any new file is inserted only then add the file path.
                if ( ! empty( $file_path ) ) {
                    // Get existing attach post id for this user first, delete img from the uploads folder and the existing post attach from wp_posts and then save the new one.
//                  unlink( $file_path);
                    $profile_attach_post_id = ( get_user_meta( $user_id, 'user_prfl_img_post_id', true ) ) ? get_user_meta( $user_id, 'user_prfl_img_post_id', true ) : '';
                    wp_delete_post( $profile_attach_post_id, true );
                    wf_update_post_with_attach( $file_path, $post_id, $user_id, 'profile-pic' );
                }
            }
        }
        unset( $_FILES );
    }
}
// If the form is submitted
if ( isset( $_POST['submit'] ) ) {
    // Get form values.
    $firstname = ( ! empty( $_POST['first_name'] ) ) ? sanitize_text_field( $_POST['first_name'] ) : '';
    $lastname = ( ! empty( $_POST['last_name'] ) ) ? sanitize_text_field( $_POST['last_name'] ) : '';
    $username= $firstname . '_' . $lastname;
    $password = ( ! empty( $_POST['password'] ) ) ? sanitize_text_field( $_POST['password'] ) : '';
    $daybirth = ( ! empty( $_POST['day_birth'] ) ) ? intval( $_POST['day_birth'], 10 ) : '';
    $monthbirth = ( ! empty( $_POST['month_birth'] ) ) ? intval( $_POST['month_birth'], 10 ) : '';
    $yearbirth = ( ! empty( $_POST['year_birth'] ) ) ? intval( $_POST['year_birth'], 10 ) : '';
    $email = ( ! empty( $_POST['email'] ) ) ? sanitize_text_field( $_POST['email'] ) : '';
    $address = ( ! empty( $_POST['address'] ) ) ? sanitize_text_field( $_POST['address'] ) : '';
    $postcode = ( ! empty( $_POST['postcode'] ) ) ? intval( $_POST['postcode'], 10 ) : '';
    $city = ( ! empty( $_POST['city'] ) ) ? sanitize_text_field( $_POST['city'] ) : '';

    

    if ($_POST['cycling'] && $_POST['running']){
        $cycling = sanitize_text_field($_POST['cycling']);
        $running= sanitize_text_field($_POST['running']);
    } elseif ($_POST['cycling']){
        $sport= sanitize_text_field($_POST['cycling']);
    }elseif ($_POST['running']){
        $sport= sanitize_text_field($_POST['running']);
    }

    if ($_POST['cycling_level']) {
        $cyclinglevel = $_POST['cycling_level'];
    }

    if ($_POST['running_level']) {
        $runninglevel = $_POST['running_level'];
    }

    //TODO : Others checks

    $new_user_id = wp_create_user($username, $password, $email);

    // Insert/Update the form values to user_meta table.

    wf_insert_update_user_meta($new_user_id, 'first_name', $firstname );
    wf_insert_update_user_meta($new_user_id, 'last_name', $lastname );
    wf_insert_update_user_meta($new_user_id, 'day_birth', $daybirth );
    wf_insert_update_user_meta($new_user_id, 'month_birth', $monthbirth );
    wf_insert_update_user_meta($new_user_id, 'year_birth', $yearbirth );
    wf_insert_update_user_meta($new_user_id, 'address', $address );
    wf_insert_update_user_meta($new_user_id, 'postcode', $postcode );
    wf_insert_update_user_meta($new_user_id, 'city', $city);

    if($cycling && $running) {
        wf_insert_update_user_meta($new_user_id, 'cycling', $cycling );
        wf_insert_update_user_meta($new_user_id, 'running', $running );
    } elseif($sport) {
        wf_insert_update_user_meta($new_user_id, 'sport', $sport );
    }

    if($cyclinglevel) {
        wf_insert_update_user_meta($new_user_id, 'cycling_level', $cyclinglevel );
    }

    if($runninglevel){
        wf_insert_update_user_meta($new_user_id, 'running_level', $runninglevel );
    }

    // Get current username.
    $user_display_name = wp_get_current_user()->display_name;
    // Create or update post for the current user and get the new/existing post id.
    $post_id = wf_create_update_user_post( $user_id, $user_display_name, 'pending' );
    // Update/upload media/attachment.
    wf_handle_profile_media( $post_id, $user_id );
    // Once everything is done redirect the user back to the same page
    $location = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    wp_safe_redirect( $location );
    exit;
}
get_footer();
?>
