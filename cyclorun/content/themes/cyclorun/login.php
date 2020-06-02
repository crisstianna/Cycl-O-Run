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

<form class="connexion" name="loginform" id="loginform" action="<?= get_bloginfo('url') . '/wp/wp-login.php'; ?>" method="post">
            <p class="login-username connexion__email">
                <label class="connexion__label" for="user_login">Identifiant ou adresse e-mail</label>
                <input type="text" name="log" id="user_login" class="input connexion__input__email" value="" size="20" />
            </p>
            <p class="login-password connexion__password">
                <label class="connexion__label" for="user_pass">Mot de passe</label>
                <input type="password" name="pwd" id="user_pass" class="input connexion__input__password" value="" size="20" />
            </p>
            <p class="login-remember"><label><input name="rememberme" type="checkbox" id="rememberme" value="forever" /> Se souvenir de moi</label></p>
            <p class="login-submit  connexion__page__buttons">
                <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary connexion__page__buttons__connexion" value="Se connecter" />
                <input type="hidden"  class="connexion__page__buttons__inscription" name="redirect_to" value=<?= get_bloginfo('url') . '/custom-home/'?>" />
            </p>

            <button type="button" class="btn btn-dark connexion-button"><a href="<?= get_bloginfo('url') . '/registration/'?>">S'inscrire</a></button>
</form>


