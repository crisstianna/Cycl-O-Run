<?php


/**
* Redirect non-admin users to home page
*
* This function is attached to the ‘admin_init’ action hook.
*/
if(!function_exists('redirect_non_admin_users')){
    function redirect_non_admin_users() {
        if ( !current_user_can( 'manage_options' ) && ('/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF']) ) {
            wp_redirect( home_url(). '/custom-home' );
        exit;
        }
    }
}

add_action( 'admin_init', 'redirect_non_admin_users' );