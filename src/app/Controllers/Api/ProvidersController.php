<?php

namespace Appointments\Controllers\Api;

use Appointments\Models\Provider;
use WP_REST_Request;

class ProvidersController extends ApiController
{
    public function registerRoutes()
    {
        register_rest_route( $this->namespace, '/providers', [
            'methods' => 'POST',
            'permission_callback' => permission_callback( 'manage_options' ),
            'args' => [
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
                'description' => [
                    'type' => 'string',
                ],
                'name_ua' => [
                    'type' => 'string',
                ],
                'description_ua' => [
                    'type' => 'string',
                ],
                'name_ru' => [
                    'type' => 'string',
                ],
                'description_ru' => [
                    'type' => 'string',
                ],
                'sync_google_calendar' => [
                    'type' => 'boolean',
                    'required' => true,
                ],
                'google_calendar_id' => [
                    'type' => 'string',
                ],
            ],
            'callback' => [ $this, 'create' ],
        ] );

        register_rest_route( $this->namespace, '/providers', [
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
            ],
            'permission_callback' => permission_callback( 'manage_options' ),
            'callback' => [ $this, 'index' ],
        ] );

        register_rest_route( $this->namespace, '/providers/(?P<id>\d+)', [
            'methods' => 'PUT',
            'permission_callback' => permission_callback( 'manage_options' ),
            'args' => [
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
                'description' => [
                    'type' => 'string',
                ],
                'name_ua' => [
                    'type' => 'string',
                ],
                'description_ua' => [
                    'type' => 'string',
                ],
                'name_ru' => [
                    'type' => 'string',
                ],
                'description_ru' => [
                    'type' => 'string',
                ],
                'sync_google_calendar' => [
                    'type' => 'boolean',
                    'required' => true,
                ],
                'google_calendar_id' => [
                    'type' => 'string',
                ],
            ],
            'callback' => [ $this, 'update' ],
        ] );

        register_rest_route( $this->namespace, '/providers/(?P<id>\d+)', [
            'methods' => 'DELETE',
            'permission_callback' => permission_callback( 'manage_options' ),
            'callback' => [ $this, 'delete' ],
        ] );
    }

    public function create( WP_REST_Request $req )
    {   
        $provider = Provider::create( [
            'name' => $req[ 'name' ],
            'email' => $req[ 'email' ],
            'description' => $req[ 'description' ],
            'name_ua' => $req[ 'name_ua' ],
            'description_ua' => $req[ 'description_ua' ],
            'name_ru' => $req[ 'name_ru' ],
            'description_ru' => $req[ 'description_ru' ],
            'sync_google_calendar' => $req[ 'sync_google_calendar' ],
            'google_calendar_id' => $req[ 'google_calendar_id' ],
        ] );

        $this->sendSuccess( $provider->toArray() );
    }
    
    public function index( WP_REST_Request $req )
    {
        $providers = Provider::index(
            $req[ 'current' ] ?? 1,
            $req[ 'pageSize' ] ?? 15,
            $req[ 'orderby' ] ?? 'created_at',
            $req[ 'order' ] ?? 'DESC',
        );

        $this->sendSuccess( $providers );
    }

    public function update( WP_REST_Request $req )
    {
        if ( ! $provider = Provider::find( $req[ 'id' ] ) ) {
            $this->sendError( [ 'message' => __( 'Provider not found.', 'appointments' ), ] );
        }

        $provider->name = $req[ 'name' ];
        $provider->email = $req[ 'email' ];
        $provider->description = $req[ 'description' ];
        $provider->name_ua = $req[ 'name_ua' ];
        $provider->description_ua = $req[ 'description_ua' ];
        $provider->name_ru = $req[ 'name_ru' ];
        $provider->description_ru = $req[ 'description_ru' ];
        $provider->sync_google_calendar = $req[ 'sync_google_calendar' ];
        $provider->google_calendar_id = $req[ 'google_calendar_id' ];
        $provider->save();

        $this->sendSuccess( $provider->toArray() );
    }

    public function delete( WP_REST_Request $req )
    {
        if ( ! $provider = Provider::find( $req[ 'id' ] ) ) {
            $this->sendError( [ 'message' => __( 'Provider not found.', 'appointments' ), ] );
        }

        $provider->delete();

        $this->sendSuccess( $provider->toArray() );
    }
}