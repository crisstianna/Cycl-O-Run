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
require plugin_dir_path(__FILE__) . 'inc/Outing_cpt.php';
require plugin_dir_path(__FILE__) . 'inc/outing_registration.php';



$customTables = new CustomTablesInstall();
$outingCpt = new Outing_cpt();

// Install custom table
register_activation_hook(__FILE__, [$customTables, 'custom_tables_activate']);
register_deactivation_hook(__FILE__, [$customTables, 'custom_tables_deactivate']);

// CPT Outing_cpt
register_activation_hook(__FILE__, [$outingCpt, 'custom_tables_activate']);
register_deactivation_hook(__FILE__, [$outingCpt, 'custom_tables_deactivate']);