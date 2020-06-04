<?php

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
