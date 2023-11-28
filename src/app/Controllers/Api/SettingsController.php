<?php

namespace Appointments\Controllers\Api;

use WP_REST_Request;

class SettingsController extends ApiController
{
    public function registerRoutes()
    {
        $validateTimePeriod = function ( $value ) {
            $isValid = in_array( $value, [
                'all', 'year', 'month',
                'week', 'day',
            ] );
            if ( ! $isValid ) {
                $this->sendError( [ 'message' => __( 'Time period is invalid.', 'appointments' ), ] );
            }

            return true;
        };

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
                        'default_hours' => [
                            'type' => 'array',
                            'required' => true,
                        ],
                        'service_account_jwt' => [
                            'type' => 'string',
                            'required' => true,
                        ],
                        'enable_restrictions_for_ip' => [
                            'type' => 'boolean',
                            'required' => true,
                        ],
                        'max_appointments_for_ip' => [
                            'type' => 'integer',
                            'required' => true,
                        ],
                        'time_period' => [
                            'type' => 'string',
                            'required' => true,
                            'validate_callback' => $validateTimePeriod,
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