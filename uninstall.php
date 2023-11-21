<?php

defined( 'WP_UNINSTALL_PLUGIN' ) or die;

global $wpdb;

// delete tables
$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->base_prefix}appointments_appointments" );
$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->base_prefix}appointments_working_days" );
$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->base_prefix}appointments_provider_service" );
$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->base_prefix}appointments_providers" );
$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->base_prefix}appointments_services" );
$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->base_prefix}appointments_customers" );

// delete options
delete_option( 'appointments' );