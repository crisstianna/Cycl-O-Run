<?php

/*

    Template Name: Login Page


*/

get_header();



?>


<form class="connexion" name="loginform" id="loginform" action="<?= get_bloginfo('url') . '/wp/wp-login.php'; ?>" method="post">
            <div class="connexion__page__logo">
                <img src="<?= get_stylesheet_directory_uri() . '/public/images/logo-o.png'?>" alt="">
            </div>
            <?php 
            $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
            if (strpos($url, 'login/?user=empty')!==false) {
                echo "<div class='login_failed' style=\"color:red;font-weight:bold; margin-bottom:1.5rem; margin-bottom:1.5rem; margin-left: 2rem;\">Veuillez renseigner l'Adresse mail !</div>"; // style a intégrer
            }
            if (strpos($url, 'login/?pwd=empty')!==false) {
                echo "<div class='login_failed' style=\"color:red;font-weight:bold; margin-bottom:1.5rem; margin-left: 2rem;\">Veuillez renseigner le Mot de passe !</div>"; // style à intégrer
            }
            if (strpos($url, 'login/?login=empty')!==false) {
                echo "<div class='login_failed' style=\"color:red;font-weight:bold; margin-bottom:1.5rem;\">Les champs \"Adresse E-mail\" et \"Mot de passe\" sont vides !</div>"; // style à intégrer
            }
            if (strpos($url,'login/?login=failed') !== false) {
                echo "<div class='login_failed' style=\"color:red;font-weight:bold; margin-bottom:1.5rem;\">Adresse E-mail et/ou  Mot de passe incorrect(s) !</div>"; // style à intégrer
            } 
            ?>
            <div class="connexion__page__errors"></div>
            <div class="connexion__page__inputs">
                <div class="login-username connexion__email">
                    <label class="connexion__label" for="user_login">Adresse E-mail</label>
                    <input type="text" name="log" id="user_login" class="input connexion__input__email" value="" size="20" />
                </div>
                <div class="login-password connexion__password">
                    <label class="connexion__label" for="user_pass">Mot de passe</label>
                    <input type="password" name="pwd" id="user_pass" class="input connexion__input__password" value="" size="20" />
                </div>
                <div class="login-remember">
                    <label><input name="rememberme" type="checkbox" id="rememberme" value="forever" /> Se souvenir de moi</label>
                </div>
                <a class="password_lost"href="<?= get_bloginfo('url') . '/wp/wp-login.php?action=lostpassword'?>">Mot de passe oublié</a>
            </div>
            <div class="login-submit  connexion__page__buttons">
                <button type="submit" name="wp-submit" id="wp-submit" class="button button-primary connexion__page__buttons__connexion">Se connecter</button>
                <button type="button" class="connexion__page__buttons__inscription"><a class="connexion__page__buttons__inscription__link" href="<?= get_bloginfo('url') . '/registration/'?>">S'inscrire</a></button>
            </div>   
</form>



<?php 


get_footer() 

?>


