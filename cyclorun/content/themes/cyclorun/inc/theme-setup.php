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