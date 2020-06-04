<?php


if(!function_exists('my_login_logo')){
    function my_login_logo() {
        echo '<style type="text/css">';
        echo '#login h1 a, .login h1 a'; 
        echo '{';
        echo 'background-image: url(' . get_stylesheet_directory_uri() . '/images/site-login-logo.png);'; //! A MODIFIER LORSQUE TOUT SERA PRET
        echo 'height:65px;';
        echo 'width:320px;';
        echo 'background-size: 320px 65px;';
        echo 'background-repeat: no-repeat;';
        echo 'padding-bottom: 30px;';
        echo '}';
        echo '</style>';
   
    }
}

add_action( 'login_enqueue_scripts', 'my_login_logo' );


?>


          