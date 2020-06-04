<?php

// Redirection after success login
if (!function_exists('login_redirect')) {
    
    function login_redirect($redirect_to, $request, $user) {

        return home_url() . '/custom-home/';
    }
}

add_filter("login_redirect", "login_redirect", 10, 3);