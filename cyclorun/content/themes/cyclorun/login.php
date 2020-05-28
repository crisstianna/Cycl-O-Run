<?php

/*

    Template Name: Login Page


*/




if(! is_user_logged_in()) {




   

        if(isset($_GET['login']) && $_GET['login'] == 'failed'){
            
            echo '<div id="login-error">';
            echo '<p>Echec d\'authentification, verifiez votre email et/ou votre mot de passe </p>';
            echo '</div>';
            
        } 
 
            
}else {
    wp_loginout(home_url());
}
   

?>

<form name="loginform" id="loginform" action="<?= get_bloginfo('url') . '/wp/wp-login.php'; ?>" method="post">
            <p class="login-username">
                <label for="user_login">Identifiant ou adresse e-mail</label>
                <input type="text" name="log" id="user_login" class="input" value="" size="20" />
            </p>
            <p class="login-password">
                <label for="user_pass">Mot de passe</label>
                <input type="password" name="pwd" id="user_pass" class="input" value="" size="20" />
            </p>
            <p class="login-remember"><label><input name="rememberme" type="checkbox" id="rememberme" value="forever" /> Se souvenir de moi</label></p>
            <p class="login-submit">
                <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary" value="Se connecter" />
                <input type="hidden" name="redirect_to" value=<?= get_bloginfo('url') . '/custom-home/'?>" />
            </p>

            <button type="button" class="btn btn-dark connexion-button"><a href="<?= get_bloginfo('url') . '/registration/'?>">S'inscrire</a></button>
</form>


