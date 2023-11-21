<?php

/**
 * Plugin Name: Appointments
 * Description: Plugin for making appointments
 * Author: Sidun Oleh
 */

use Appointments\Activator;
use Appointments\Core;
use Appointments\Deactivator;

defined( 'ABSPATH' ) or die;

/**
 * Plugin root
 */
const APPOINTMENTS_ROOT = __DIR__;

/**
 * Composer autoloader
 */
require_once APPOINTMENTS_ROOT . '/vendor/autoload.php';

/**
 * Plugin activation
 */
$activator = new Activator;
register_activation_hook( 
    __FILE__,
    [ $activator, 'activate' ]
);
add_action(
    'activated_plugin',
    [ $activator, 'activated' ]
);

/**
 * Plugin deactivation
 */
register_deactivation_hook( 
    __FILE__,
    [ new Deactivator, 'deactivate' ]
);

/**
 * Run plugin
 */
( new Core )->run();