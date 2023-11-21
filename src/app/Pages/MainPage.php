<?php

namespace Appointments\Pages;

class MainPage extends Page
{
    public function addPage()
    {
        add_menu_page(
            __( 'Appointments', 'appointments' ),
            __( 'Appointments', 'appointments' ),
            'manage_options',
            'appointments',
            [ $this, 'renderPage' ],
            'dashicons-calendar-alt',
            65
        );
    }

    public function renderPage()
    {
        require_once APPOINTMENTS_ROOT . '/src/views/admin/main.php';
    }

    public function enqueueStyles()
    {
        if ( ! in_array( $_GET[ 'page' ] ?? '', [ 'appointments', ] ) ) return;

        // wp_enqueue_style(
        //     'main',
        //     plugin_dir_url( APPOINTMENTS_ROOT . '/appointments.php' ) . '/src/assets/admin/css/style.css'
        // );
    }

    public function enqueueScripts()
    {
        if ( ! in_array( $_GET[ 'page' ] ?? '', [ 'appointments', ] ) ) return;

        wp_enqueue_script( 
            'main', 
            plugin_dir_url( APPOINTMENTS_ROOT . '/appointments.php' ) . '/src/assets/admin/js/bundle.js',
            [],
            false,
            true
        );

        wp_localize_script( 'main', 'wpApiSettings', [ 'nonce' => wp_create_nonce( 'wp_rest' ), ] );
    }
}