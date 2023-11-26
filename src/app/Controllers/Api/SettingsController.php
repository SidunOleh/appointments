<?php

namespace Appointments\Controllers\Api;

use WP_REST_Request;

class SettingsController extends ApiController
{
    public function registerRoutes()
    {
        register_rest_route( $this->namespace, '/settings', [
            'methods' => 'GET',
            'permission_callback' => permission_callback( 'manage_options' ),
            'callback' => [ $this, 'get' ],
        ] );

        register_rest_route( $this->namespace, '/settings', [
            'methods' => 'PUT',
            'permission_callback' => permission_callback( 'manage_options' ),
            'args' => [
                'settings' => [
                    'type' => 'object',
                    'required' => true,
                    'properties' => [
                        'enable_restrictions_for_ip' => [
                            'type' => 'boolean',
                            'required' => true,
                        ],
                        'max_appointments_for_ip' => [
                            'type' => 'integer',
                            'required' => true,
                        ],
                    ],
                ],
            ],
            'callback' => [ $this, 'update' ],
        ] );
    }

    public function get()
    {
        $this->sendSuccess( get_appointemnts_option( 'settings', [] ) );
    }

    public function update( WP_REST_Request $req )
    {
        update_appointemnts_option( 'settings', $req[ 'settings' ] );

        $this->sendSuccess();
    }
}