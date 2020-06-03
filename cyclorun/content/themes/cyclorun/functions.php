<?php

require('inc/enqueue.php');
require('inc/theme-setup.php');
require('inc/login_setup.php');
require('inc/getOutingFilteredResults.php');
require('inc/getLevel.php');
require('inc/getPracticedSport.php');
require('inc/age.php');

function lost_password_link( $formbottom ) {
	$formbottom .= '<a href="' . wp_lostpassword_url() . '">Mot de passe perdu</a>';
	return $formbottom;
}
add_filter( 'login_form_bottom', 'lost_password_link' );



// messaeg d'erreur si erreur de connexion
add_action( 'wp_login_failed', 'pippin_login_fail' );  // hook failed login

function pippin_login_fail( $username ) {
     $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
     // if there's a valid referrer, and it's not the default log-in screen
     if ( !empty($referrer)) {
          wp_redirect(home_url() . '/test-login/?login=failed' );  // let's append some information (login=failed) to the URL for the theme to use
          exit;
     }
}

// message d'erreur si connexion vide
add_action( 'wp_authenticate', '_catch_empty_user', 1, 2 );

function _catch_empty_user( $username, $pwd ) {
  if (empty($pwd)&&empty($username)) {
    wp_safe_redirect(home_url().'/login/?login=empty');
    exit();
  }  if ( empty( $username )) {
    wp_safe_redirect(home_url() . '/login/?user=empty' );
    exit();
  }
  if (empty($pwd)) {
    wp_safe_redirect(home_url().'/login/?pwd=empty');
    exit();
  }
}

add_filter("login_redirect", "login_redirect", 10, 3);

function login_redirect($redirect_to, $request, $user) {

  return home_url() . '/custom-home/';
}