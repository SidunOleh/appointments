<?php

namespace Appointments\Controllers\Api;

use Appointments\Models\Provider;
use Appointments\Models\Service;
use WP_REST_Request;

class ServicesController extends ApiController
{
    public function registerRoutes()
    {
        $validateProviders = function ( $providersIds ) {
            if ( ! is_array( $providersIds ) ) {
                $this->sendError( [ 'message' => __( 'Providers are invalid.' ), ] );
            }

            $providers = Provider::whereIn( 'id', $providersIds )->get();
            if ( count( $providersIds ) != $providers->count() ) {
                $this->sendError( [ 'message' => __( 'Providers not found.' ), ] );
            }

            return true;
        };

        register_rest_route( $this->namespace, '/services', [
            'methods' => 'POST',
            'permission_callback' => permission_callback( 'manage_options' ),
            'args' => [
                'name' => [
                    'type' => 'string',
                    'required' => true,
                    'minLength' => 1,
                ],
                'duration' => [
                    'type' => 'number',
                    'required' => true,
                ],
                'price' => [
                    'type' => 'number',
                    'required' => true,
                ],
                'description' => [
                    'type' => 'string',
                ],
                'providers_ids' => [
                    'type' => 'array',
                    'items' => [
                        'type' => 'number',  
                    ],
                    'uniqueItems' => true,
                    'validate_callback' => $validateProviders,
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
            ],
            'callback' => [ $this, 'create' ],
        ] );

        register_rest_route( $this->namespace, '/services', [
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

        register_rest_route( $this->namespace, '/services/(?P<id>\d+)', [
            'methods' => 'PUT',
            'permission_callback' => permission_callback( 'manage_options' ),
            'args' => [
                'name' => [
                    'type' => 'string',
                    'required' => true,
                    'minLength' => 1,
                ],
                'duration' => [
                    'type' => 'number',
                    'required' => true,
                ],
                'price' => [
                    'type' => 'number',
                    'required' => true,
                ],
                'description' => [
                    'type' => 'string',
                ],
                'providers_ids' => [
                    'type' => 'array',
                    'items' => [
                        'type' => 'number',  
                    ],
                    'uniqueItems' => true,
                    'validate_callback' => $validateProviders,
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
            ],
            'callback' => [ $this, 'update' ],
        ] );

        register_rest_route( $this->namespace, '/services/(?P<id>\d+)', [
            'methods' => 'DELETE',
            'permission_callback' => permission_callback( 'manage_options' ),
            'callback' => [ $this, 'delete' ],
        ] );
    }

    public function create( WP_REST_Request $req )
    {   
        $service = Service::create( [
            'name' => $req[ 'name' ],
            'duration' => $req[ 'duration' ],
            'price' => $req[ 'price' ],
            'description' => $req[ 'description' ],
            'name_ua' => $req[ 'name_ua' ],
            'description_ua' => $req[ 'description_ua' ],
            'name_ru' => $req[ 'name_ru' ],
            'description_ru' => $req[ 'description_ru' ],
        ] );
    
        $service->providers()->attach( $req[ 'providers_ids' ] );

        $this->sendSuccess( $service->toArray() );
    }
    
    public function index()
    {
        $services = Service::index(
            $req[ 'current' ] ?? 1,
            $req[ 'pageSize' ] ?? 15,
            $req[ 'orderby' ] ?? 'created_at',
            $req[ 'order' ] ?? 'DESC',
        );

        $this->sendSuccess( $services );
    }

    public function update( WP_REST_Request $req )
    {
        if ( ! $service = Service::find( $req[ 'id' ] ) ) {
            $this->sendError( [ 'message' => __( 'Service not found.', 'appointments' ), ] );
        }

        $service->name = $req[ 'name' ];
        $service->duration = $req[ 'duration' ];
        $service->price = $req[ 'price' ];
        $service->description = $req[ 'description' ];
        $service->name_ua = $req[ 'name_ua' ];
        $service->description_ua = $req[ 'description_ua' ];
        $service->name_ru = $req[ 'name_ru' ];
        $service->description_ru = $req[ 'description_ru' ];
        $service->save();

        $service->providers()->sync( $req[ 'providers_ids' ] );

        $this->sendSuccess( $service->toArray() );
    }

    public function delete( WP_REST_Request $req )
    {
        if ( ! $service = Service::find( $req[ 'id' ] ) ) {
            $this->sendError( [ 'message' => __( 'Service not found.', 'appointments' ), ] );
        }

        $service->delete();

        $this->sendSuccess( $service->toArray() );
    }
}