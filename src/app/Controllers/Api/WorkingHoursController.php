<?php

namespace Appointments\Controllers\Api;

use DateTime;
use WP_REST_Request;

class WorkingHoursController extends ApiController
{
    public function registerRoutes()
    {
        $validateHours = function ( $hours ) {
            if ( ! is_array( $hours ) ) {
                $this->sendError( [ 'message' => __( 'Working hours are invalid.', 'appointments' ), ] );
            }

            foreach ( $hours as $hour ) {
                $datetime = DateTime::createFromFormat( 'H:i', $hour );
                
                if ( ! $datetime or $datetime->format( 'H:i' ) != $hour ) {
                    $this->sendError( [ 'message' => __( 'Working hours are invalid.', 'appointments' ), ] );
                }
            }

            return true;
        };

        register_rest_route( $this->namespace, '/working-hours', [
            'methods' => 'GET',
            'permission_callback' => permission_callback( 'manage_options' ),
            'callback' => [ $this, 'getDefaultWorkingHours' ],
        ] );

        register_rest_route( $this->namespace, '/working-hours', [
            'methods' => 'POST',
            'permission_callback' => permission_callback( 'manage_options' ),
            'args' => [
                'default_working_hours' => [
                    'type' => 'array',
                    'required' => true,
                    'items' => [
                        'type' => 'string',  
                    ],
                    'uniqueItems' => true,
                    'validate_callback' => $validateHours,
                ],
            ],
            'callback' => [ $this, 'setDefaultWorkingHours' ],
        ] );
    }

    public function getDefaultWorkingHours()
    {
        $this->sendSuccess( get_appointemnts_option( 'default_working_hours', [] ) );
    }

    public function setDefaultWorkingHours( WP_REST_Request $req )
    {
        update_appointemnts_option( 'default_working_hours', $req[ 'default_working_hours' ] );

        $this->sendSuccess( get_appointemnts_option( 'default_working_hours', [] ) );
    }
}