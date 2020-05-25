<?php

/*
Plugin Name: Custom table "wp_outing"
Description: This plugin create automatically the database table "wp_outing"
Version: 1.0
Author: Céline Augendre
*/

if (!defined('WPINC')) {
    die;
}


class CustomTableWpOutingInstall
{
    public function __construct()
    {
        add_action('init', [$this, 'custom_table_wp_outing_install']);
    }

    public function custom_table_wp_outing_install() 
    {
        //WordPress Database Access Abstraction Object
        global $wpdb;

        // Creating the table
        $sql = "CREATE TABLE `{$wpdb->base_prefix}outing` (        
            `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` varchar(64) NOT NULL,
            `author` varchar(64) NOT NULL,
            `address` varchar(255) NOT NULL,
            `lat` float(10.6) NOT NULL,
            `long` float(10.6) NOT NULL,
            `level` int(6) UNSIGNED NOT NULL,
            `date` DATE NOT NULL,
            `time` TIME NOT NULL,
            `distance` int(6) NOT NULL,
            `practiced_sport` int(6) NOT NULL,
            `picture` varchar(255),
            `course` varchar(255) NOT NULL,
            `user_id` int(20) NOT NULL,
            `created_at` TIMESTAMP NOT NULL,
            `updated_at` TIMESTAMP NOT NULL,
            PRIMARY KEY  (id)
        ) ";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    public function customTableWpOuting_activate()
    {
        $this->custom_table_wp_outing_install();
        flush_rewrite_rules();
    }

    public function custom_table_wp_outing_install_deactivate()
    {
        flush_rewrite_rules();
    }

}

$customTableWpOuting = new CustomTableWpOutingInstall();

register_deactivation_hook(__FILE__, [$customTableWpOuting, 'customTableWpOuting_activate']);

register_deactivation_hook(__FILE__, [$customTableWpOuting, 'custom_table_wp_outing_install_deactivate']);

