<?php

namespace Appointments\Controllers\Api;

use WP_REST_Request;

class SyncCredentialsController extends ApiController
{
    public function registerRoutes()
    {
        register_rest_route( $this->namespace, '/sync/credentials', [
            'methods' => 'GET',
            'permission_callback' => permission_callback( 'manage_options' ),
            'callback' => [ $this, 'getSyncCredentials' ],
        ] );

        register_rest_route( $this->namespace, '/sync/credentials/service-account-jwt', [
            'methods' => 'POST',
            'permission_callback' => permission_callback( 'manage_options' ),
            'callback' => [ $this, 'saveServiceAccountJWT' ],
        ] );
    }

    public function getSyncCredentials()
    {
        $credentials = [];

        $serviceAccountJWTPath = APPOINTMENTS_ROOT . '/src/storage/credentials/service-account-jwt.json';
        if ( file_exists( $serviceAccountJWTPath ) ) {
            $credentials[ 'service_account_jwt' ] = file_get_contents( $serviceAccountJWTPath );
        }

        $this->sendSuccess( $credentials );
    }

    public function saveServiceAccountJWT( WP_REST_Request $req )
    {
        if ( ! isset( $req->get_file_params()[ 'service-account-jwt' ] ) ) {
            $this->sendError( [ 'message' => __( 'File not found.', 'appointments' ) ] );
        }

        $file = $req->get_file_params()[ 'service-account-jwt' ];
        if ( $file[ 'type' ] != 'application/json' ) {
            $this->sendError( [ 'message' => __( 'File has to be in json format.', 'appointments' ) ] );
        }

        $content = json_decode( file_get_contents( $file[ 'tmp_name' ] ), true );
        if ( ! isset( $content[ 'client_email' ] ) ) {
            $this->sendError( [ 'message' => __( 'File is invalid.', 'appointments' ) ] );
        }

        move_uploaded_file( 
            $file[ 'tmp_name' ],
            APPOINTMENTS_ROOT . '/src/storage/credentials/service-account-jwt.json' 
        );
    }
}