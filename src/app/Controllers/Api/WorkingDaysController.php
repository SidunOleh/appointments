<?php

namespace Appointments\Controllers\Api;

use Appointments\Models\Provider;
use Appointments\Models\WorkingDay;
use DateTime;
use WP_REST_Request;

class WorkingDaysController extends ApiController
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

        $validateDate = function ( $date ) {
            $datetime = DateTime::createFromFormat( 'Y-m-d', $date );

            if ( ! $datetime or $datetime->format( 'Y-m-d' ) != $date  ) {
                $this->sendError( [ 'message' => __( 'Date is invalid.', 'appointments' ), ] );
            }
        
            return true;
        };

        $validateProvider = function ( $providerId ) {
            if ( ! Provider::find( $providerId ) ) {
                $this->sendError( [ 'message' => __( 'Provider not found.', 'appointments' ), ] );
            }

            return true;
        };

        register_rest_route( $this->namespace, '/working-days', [
            'methods' => 'POST',
            'permission_callback' => permission_callback( 'manage_options' ),
            'args' => [
                'date' => [
                    'type' => 'string',
                    'required' => true,
                    'format' => 'date',
                    'validate_callback' => $validateDate,
                ],
                'working_hours' => [
                    'type' => 'array',
                    'uniqueItems' => true,
                    'validate_callback' => $validateHours,
                ],
                'provider_id' => [
                    'type' => 'number',
                    'required' => true,
                    'validate_callback' => $validateProvider,
                ],
            ],
            'callback' => [ $this, 'createOrUpdate' ],
        ] );

        register_rest_route( $this->namespace, '/working-days', [
            'methods' => 'GET',
            'permission_callback' => permission_callback( 'manage_options' ),
            'args' => [
                'provider_id' => [
                    'type' => 'number',
                    'required' => true,
                    'validate_callback' => $validateProvider,
                ],
                'year' => [
                    'type' => 'number',
                    'required' => true,
                ],
                'month' => [
                    'type' => 'number',
                    'required' => true,
                ],
            ],
            'callback' => [ $this, 'getForMonth' ],
        ] );

        register_rest_route( $this->namespace, '/working-days/free', [
            'methods' => 'GET',
            'permission_callback' => fn() => true,
            'args' => [
                'provider_id' => [
                    'type' => 'number',
                    'required' => true,
                    'validate_callback' => $validateProvider,
                ],
                'year' => [
                    'type' => 'number',
                    'required' => true,
                ],
                'month' => [
                    'type' => 'number',
                    'required' => true,
                ],
            ],
            'callback' => [ $this, 'getFreeDaysForMonth' ],
        ] );

        register_rest_route( $this->namespace, '/working-days', [
            'methods' => 'DELETE',
            'permission_callback' => permission_callback( 'manage_options' ),
            'args' => [
                'date' => [
                    'type' => 'string',
                    'required' => true,
                    'format' => 'date',
                    'validate_callback' => $validateDate,
                ],
                'provider_id' => [
                    'type' => 'number',
                    'required' => true,
                    'validate_callback' => $validateProvider,
                ],
            ],
            'callback' => [ $this, 'delete' ],
        ] );
    }

    public function createOrUpdate( WP_REST_Request $req )
    {
        $defaultHours = get_appointemnts_option( 'settings', [] )[ 'default_hours' ] ?? [];
        $workingHours = $req[ 'working_hours' ] ?? $defaultHours;

        $workingDay = WorkingDay::updateOrCreate( [
            'date' => $req[ 'date' ],
            'provider_id' => $req[ 'provider_id' ],
        ], [
            'working_hours' => $workingHours,
        ] );
        $workingDay->refresh();

        $this->sendSuccess( $workingDay->toArray() );
    }

    public function getForMonth( WP_REST_Request $req )
    {
        $workingDays = WorkingDay::getForMonth(
            $req[ 'provider_id' ],
            $req[ 'year' ],
            $req[ 'month' ]
        );

        $this->sendSuccess( $workingDays );
    }

    public function getFreeDaysForMonth( WP_REST_Request $req )
    {
        $freeWorkingDays = WorkingDay::getFreeDaysForMonth( 
            $req[ 'provider_id' ],
            $req[ 'year' ],
            $req[ 'month' ]
        );

        $this->sendSuccess( $freeWorkingDays );
    }

    public function delete( WP_REST_Request $req )
    {
        $workingDay = WorkingDay::where( [
            'date' => $req[ 'date' ],
            'provider_id' => $req[ 'provider_id' ],
        ] )->first();

        if ( $workingDay ) $workingDay->delete(); 

        $this->sendSuccess( $workingDay->toArray() );
    }
}