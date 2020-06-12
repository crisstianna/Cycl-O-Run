<?php

if (!function_exists('cyclorun_setup')) {

        function cyclorun_setup() {
            add_theme_support('title-tag');
            add_theme_support('post-thumbnails');

            register_nav_menus([
                'main-menu' => 'Menu de Navigation Login'
            ]);
        }
}

add_action('after_setup_theme', 'cyclorun_setup');

if(!function_exists('remove_admin_bar')){
    function remove_admin_bar() {
        if (!current_user_can('administrator') && !is_admin()) {
            show_admin_bar(false);
        }
    }
}

add_action('after_setup_theme', 'remove_admin_bar');