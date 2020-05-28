<?php

/*

    Template Name: Custom Home

*/

if(is_user_logged_in()){
    wp_loginout(home_url());
} else {
    header('Location: http://localhost/Projets/projet-cycl-o-run/cyclorun/login/');
}

echo 'Je suis la Home Personalisé';


?>