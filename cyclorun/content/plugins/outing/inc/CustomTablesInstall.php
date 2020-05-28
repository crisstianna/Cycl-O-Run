<?php

class CustomTablesInstall
{
    public function __construct()
    {
        add_action('init', [$this, 'custom_table_wp_outings_install']);
        add_action('init', [$this, 'intermediate_table_wp_participation_install']);
    }

    public function custom_table_wp_outings_install()
    {
        //WordPress Database Access Abstraction Object
        global $wpdb;
        

        // Creating the table
        $sql = "CREATE TABLE IF NOT EXISTS `{$wpdb->base_prefix}outings` (        
            `outing_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            `outing_name` varchar(64) NOT NULL,
            `author` varchar(64) NOT NULL,
            `address` varchar(255) NOT NULL,
            `level` varchar(64) NOT NULL,
            `date` DATE NOT NULL,
            `time` TIME NOT NULL,
            `distance` int(6) NOT NULL,
            `practiced_sport` varchar(64) NOT NULL,
            `picture` varchar(255),
            `description` varchar(255),
            `created_at` TIMESTAMP NOT NULL,
            `updated_at` TIMESTAMP NOT NULL,
            PRIMARY KEY  (`outing_id`)
        ) ";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    public function intermediate_table_wp_participation_install()
    {
        //WordPress Database Access Abstraction Object
        global $wpdb;

        // Creation the table
        $sql = "CREATE TABLE IF NOT EXISTS `{$wpdb->base_prefix}participations` (
            `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            `user_id` bigint(20) unsigned NOT NULL,
            `outing_id` int(20) unsigned NOT NULL,
            PRIMARY KEY  (`id`),
            FOREIGN KEY  (`user_id`) REFERENCES `wp_users` (`ID`) ON DELETE RESTRICT,
            FOREIGN KEY  (`outing_id`) REFERENCES `wp_outings` (`outing_id`) ON DELETE RESTRICT
          )";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    function custom_tables_activate()
    {
        $this->custom_table_wp_outings_install();
        $this->intermediate_table_wp_participation_install();
        flush_rewrite_rules();
    }

    function custom_tables_deactivate()
    {
        flush_rewrite_rules();
    } 
}