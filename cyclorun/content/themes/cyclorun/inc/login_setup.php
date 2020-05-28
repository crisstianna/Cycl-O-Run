<?php

add_action( 'wp_login_failed', 'my_front_end_login_fail' );  // hook failed login

if(!function_exists('my_front_end_login_fail')){
   function my_front_end_login_fail( $username ) {
      $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
      // if there's a valid referrer, and it's not the default log-in screen
      if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
         wp_redirect( $referrer . '?login=failed' );  // let's append some information (login=failed) to the URL for the theme to use
         exit;
      }
   }
}

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


          