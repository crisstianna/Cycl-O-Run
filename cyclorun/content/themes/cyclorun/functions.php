<?php

require('inc/enqueue.php');
require('inc/theme-setup.php');
require('inc/login_setup.php');
require('inc/getOutingFilteredResults.php');
require('inc/getLevel.php');
require('inc/getPracticedSport.php');
require('inc/age.php');


// error message if failed connexion
if (!function_exists('pippin_login_fail')) {
    function pippin_login_fail($username) {
        $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from
        // if there's a valid referrer, and it's not the default log-in screen
        if (!empty($referrer)) {
            wp_redirect(home_url() . '/login/?login=failed');
            exit;
        }
    }
}
add_action('wp_login_failed', 'pippin_login_fail');

// function for lost password link
function lost_password_link( $formbottom ) {
	$formbottom .= '<a href="' . wp_lostpassword_url() . '">Mot de passe perdu</a>';
	return $formbottom;
}
add_filter('login_form_bottom', 'lost_password_link');

// Redirection after success login
if (!function_exists('login_redirect')) {
    function login_redirect($redirect_to, $request, $user) {

        //TODO: rajouter la condition "si l'utilsateur n'est pas admin"
        return home_url() . '/custom-home/';
    }
}
add_filter("login_redirect", "login_redirect", 10, 3);

// Error messages if empty inputs
if (!function_exists('catch_empty_user')) {
    function catch_empty_user($username, $pwd) {
        if (empty($pwd)&&empty($username)) {
            wp_safe_redirect(home_url().'/login/?login=empty');
            exit();
        }
        if (empty($username)) {
            wp_safe_redirect(home_url() . '/login/?user=empty');
            exit();
        }
        if (empty($pwd)) {
            wp_safe_redirect(home_url().'/login/?pwd=empty');
            exit();
        }
    }
}
add_action('wp_authenticate', 'catch_empty_user', 1, 2);