<?php

/*

    Template Name: Login Page


*/

get_header();

//? PROCESSING LOGIN FORM

$errors= [];

?>

<form class="connexion" name="loginform" id="loginform" action="<?= get_bloginfo('url') . '/wp/wp-login.php'; ?>" method="post">
            <div class="connexion__page__logo">
                <img src="<?= get_stylesheet_directory_uri() . '/public/images/logo-o.png'?>" alt="">
            </div>

            <div class="connexion__page__errors">
                <?php
                    if($errors){
                        foreach($errors as $key => $error){
                            echo '<p>' . $error . '</p>';
                        }
                    }
                ?>
            </div>
            <div class="connexion__page__inputs">
                <div class="login-username connexion__email">
                    <label class="connexion__label" for="user_login">Adresse e-mail</label>
                    <input type="text" name="log" id="user_login" class="input connexion__input__email" value="" size="20" />
                </div>
           
                <div class="login-password connexion__password">
                    <label class="connexion__label" for="user_pass">Mot de passe</label>
                    <input type="password" name="pwd" id="user_pass" class="input connexion__input__password" value="" size="20" />
                </div>
                <div class="login-remember"><label><input name="rememberme" type="checkbox" id="rememberme" value="forever" /> Se souvenir de moi</label></div>
            </div>
            <div class="login-submit  connexion__page__buttons">
                <button type="submit" name="wp-submit" id="wp-submit" class="button button-primary connexion__page__buttons__connexion"/>Se connecter</button>
                <input type="hidden" name="redirect_to" value=<?= get_bloginfo('url') . '/custom-home/'?>" />
                <button type="button" class="connexion__page__buttons__inscription"><a class="connexion__page__buttons__inscription__link" href="<?= get_bloginfo('url') . '/registration/'?>">S'inscrire</a></button>
            </div>        
</form>


<?php 




get_footer() ?>


