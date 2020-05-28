<?php

/*

    Template Name: Login Page


*/




if(! is_user_logged_in()) {




    $login_form_arg= array(
        
            'echo'           => true,
            // Default 'redirect' value takes the user back to the request URI.
            'redirect'       => 'http://localhost/Projets/projet-cycl-o-run/cyclorun/custom-home/',
            'form_id'        => 'loginform',
            'label_username' => __( 'Email' ),
            'label_password' => __( 'Mot de passe' ),
            'label_remember' => __( 'Se souvenir de moi'),
            'label_log_in'   => __( 'Se Connecter' ),
            'id_username'    => 'email',
            'id_password'    => 'password',
            'id_remember'    => 'rememberme',
            'id_submit'      => 'wp-submit',
            'remember'       => true,
            'value_username' => '',
            // Set 'value_remember' to true to default the "Remember me" checkbox to checked.
            'value_remember' => false,
        );

        if(isset($_GET['login']) && $_GET['login'] == 'failed'){
            
            echo '<div id="login-error">';
            echo '<p>Echec d\'authentification, verifiez votre email et/ou votre mot de passe </p>';
            echo '</div>';
            
        } 

        wp_login_form( $login_form_arg);

       
            
           


}else {
    wp_loginout(home_url());
}




       



?>



