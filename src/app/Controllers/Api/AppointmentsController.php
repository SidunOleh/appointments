<?php

namespace Appointments\Controllers\Api;

use Appointments\Models\Appointment;
use Appointments\Models\Customer;
use Appointments\Models\Provider;
use Appointments\Models\Service;
use Appointments\Models\WorkingDay;
use DateTime;
use WP_REST_Request;

class AppointmentsController extends ApiController
{
    public function registerRoutes()
    {
        $validateService = function ( $serviceId ) {
            if ( ! Service::find( $serviceId ) ) { 
                $this->sendError( [ 'message' => __( 'Service not found.', 'appointments' ), ] );
            }

            return true;
        };

        $validateProvider = function ( $providerId, WP_REST_Request $req ) {
            if ( ! $provider = Provider::find( $providerId ) ) { 
                $this->sendError( [ 'message' => __( 'Provider not found.', 'appointments' ), ] );
            }

            if ( ! $provider->hasService( $req[ 'service_id' ] ) ) {
                $this->sendError( [ 'message' => __( 'Service does not have a specified provider.', 'appointments' ), ] );
            }

            return true;
        };

        $validateDate = function ( $date, WP_REST_Request $req ) {
            $datetime = DateTime::createFromFormat( 'Y-m-d', $date );

            if ( ! $datetime or $datetime->format( 'Y-m-d' ) != $date  ) {
                $this->sendError( [ 'message' => __( 'Date is invalid.', 'appointments' ), ] );
            }

            $provider = Provider::find( $req[ 'provider_id' ] );
            if ( ! $provider->hasWorkingDay( $date ) ) {
                $this->sendError( [ 'message' => __( 'Date is not available.', 'appointments' ), ] );
            }

            return true;
        };

        $validateHour = function ( $hour, WP_REST_Request $req ) {
            $datetime = DateTime::createFromFormat( 'H:i', $hour );
            if ( ! $datetime or $datetime->format( 'H:i' ) != $hour ) {
                $this->sendError( [ 'message' => __( 'Hour is invalid.', 'appointments' ), ] );
            }

            $workingDay = WorkingDay::where( [ 'date' => $req[ 'date' ], 'provider_id' => $req[ 'provider_id' ], ] )
                ->first();
            if ( ! $workingDay->hasHour( $hour ) ) { 
                $this->sendError( [ 'message' => __( 'Hour is not available.', 'appointments' ), ] );
            }

            $provider = Provider::find( $req[ 'provider_id' ] );
            if ( $provider->hasAppointment( $req[ 'date' ], $hour ) ) {
                $this->sendError( [ 'message' => __( 'Hour is reserved.', 'appointments' ), ] );
            }

            return true;
        };

        register_rest_route( $this->namespace, '/appointments', [
            'methods' => 'POST',
            'permission_callback' => fn() => true,
            'args' => [
                'service_id' => [
                    'type' => 'number',
                    'required' => true,
                    'validate_callback' => $validateService,
                ],
                'provider_id' => [
                    'type' => 'number',
                    'required' => true,
                    'validate_callback' => $validateProvider,
                ],
                'date' => [
                    'type' => 'string',
                    'required' => true,
                    'validate_callback' => $validateDate,
                ],
                'hour' => [
                    'type' => 'string',
                    'required' => true,
                    'validate_callback' => $validateHour,
                ],
                'name' => [
                    'type' => 'string',
                    'required' => true,
                    'minLength' => 1,
                ],
                'email' => [
                    'type' => 'string',
                    'required' => true,
                    'format' => 'email',
                ],
                'phone' => [
                    'type' => 'string',
                    'required' => true,
                    'minLength' => 1,
                ],
                'comment' => [
                    'type' => 'string',
                ],
            ],
            'callback' => [ $this, 'create' ],
        ] );

        register_rest_route( $this->namespace, '/appointments', [
            'methods' => 'GET',
            'args' => [
                'current' => [
                    'type' => 'integer',
                ],
                'pageSize' => [
                    'type' => 'integer',
                ],
                'orderby' => [
                    'type' => 'string',
                ],
                'order' => [
                    'type' => 'string',
                ],
                'pay_status' => [
                    'type' => 'array',
                    'items' => [
                        'type' => 'boolean',  
                    ],
                ],
            ],
            'permission_callback' => permission_callback( 'manage_options' ),
            'callback' => [ $this, 'index' ],
        ] );

        register_rest_route( $this->namespace, '/appointments/(?P<id>\d+)/pay-status', [
            'methods' => 'PATCH',
            'permission_callback' => permission_callback( 'manage_options' ),
            'args' => [
                'status' => [
                    'type' => 'boolean',
                    'required' => true,
                ],
            ],
            'callback' => [ $this, 'changePayStatus' ],
        ] );

        register_rest_route( $this->namespace, '/appointments/(?P<id>\d+)', [
            'methods' => 'DELETE',
            'permission_callback' => permission_callback( 'manage_options' ),
            'callback' => [ $this, 'delete' ],
        ] );
    }

    public function create( WP_REST_Request $req )
    {   
        $customer = Customer::create( [
            'name' => $req[ 'name' ],
            'email' => $req[ 'email' ],
            'phone' => $req[ 'phone' ],
        ] );

        $appointment = Appointment::create( [
            'start' => $req[ 'date' ] . ' ' . $req[ 'hour' ],
            'comment' => $req[ 'comment' ],
            'service_id' => $req[ 'service_id' ],
            'provider_id' => $req[ 'provider_id' ],
            'customer_id' => $customer->id,
            'delete_token' => Appointment::deleteToken(),
        ] );

        $this->sendSuccess( $appointment->toArray() );
    }

    public function index( WP_REST_Request $req )
    {
        $filters = [];
        if ( $req[ 'pay_status' ] ) $filters[ 'pay_status' ] = $req[ 'pay_status' ];

        $appointments = Appointment::index(
            $req[ 'current' ] ?? 1,
            $req[ 'pageSize' ] ?? 15,
            $req[ 'orderby' ] ?? 'created_at',
            $req[ 'order' ] ?? 'DESC',
            $filters
        );

        $this->sendSuccess( $appointments );
    }

    public function changePayStatus( WP_REST_Request $req )
    {
        if ( ! $appointment = Appointment::find( $req[ 'id' ] ) ) {
            $this->sendError( [ 'message' => __( 'Appointment not found.' ), ] );
        }

        $appointment->pay_status = $req[ 'status' ];
        $appointment->save();

        $this->sendSuccess( $appointment->toArray() );
    }

    public function delete( WP_REST_Request $req )
    {
        if ( ! $appointment = Appointment::find( $req[ 'id' ] ) ) {
            $this->sendError( [ 'message' => __( 'Appointment not found.' ), ] );
        }

        $appointment->delete();

        $this->sendSuccess( $appointment->toArray() );
    }
}