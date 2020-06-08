<?php

/*
Plugin Name: Outing
Description: Custom table management plugin and associated Custom Post Type
Version: 1.0
Author: Les cycl'o'runiens
*/

// securing the plugin
if (!defined('WPINC')) {
    die;
}

// require of differents classes
require plugin_dir_path(__FILE__) . 'inc/CustomTablesInstall.php';


$customTables = new CustomTablesInstall();
// Install custom table
register_activation_hook(__FILE__, [$customTables, 'custom_tables_activate']);
register_deactivation_hook(__FILE__, [$customTables, 'custom_tables_deactivate']);
