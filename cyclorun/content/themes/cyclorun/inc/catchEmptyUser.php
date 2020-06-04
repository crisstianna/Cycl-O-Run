<?php

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