<?php

namespace Appointments;

use Appointments\Controllers\Actions\ActionsController;
use Appointments\Controllers\Api\AppointmentsController;
use Appointments\Controllers\Api\ProvidersController;
use Appointments\Controllers\Api\ServicesController;
use Appointments\Controllers\Api\SyncCredentialsController;
use Appointments\Controllers\Api\WorkingDaysController;
use Appointments\Controllers\Api\WorkingHoursController;
use Appointments\Pages\MainPage;
use Appointments\Shortcodes\AppointmentShortcode;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class Core
{
    public function run()
    {
        $this->db();
        $this->pages();
        $this->shortcodes();
        add_action( 'init', [ $this, 'httpMethodSpoofing' ] );
        add_filter( 'rest_request_after_callbacks', [ $this, 'changeErrorApiResponse' ]);
        add_action( 'rest_api_init', [ $this, 'api' ] );
        $this->actions();
        add_action( 'plugins_loaded', [ $this, 'translation' ] );
    }

    private function db()
    {
        global $wpdb;
        $capsule = new Capsule;
        $connParams = [
            'driver' => 'mysql',
            'host' => DB_HOST,
            'database' => DB_NAME,
            'username' => DB_USER,
            'password' => DB_PASSWORD,
            'prefix' => $wpdb->base_prefix,
        ];
        if ( defined( 'DB_CHARSET' ) ) 
            $params[ 'charset' ] = DB_CHARSET;
        if ( defined( 'DB_COLLATE' ) ) 
            $params[ 'collation' ] = DB_COLLATE;
        $capsule->addConnection( $connParams );
        $capsule->setEventDispatcher( new Dispatcher( new Container ) );
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

    private function pages()
    {
        ( new MainPage )->create();
    }

    private function shortcodes()
    {
        ( new AppointmentShortcode )->create();
    }

    public function httpMethodSpoofing() 
    {
        if ( 
            isset( $_SERVER[ 'CONTENT_TYPE' ] ) and 
            $_SERVER[ 'CONTENT_TYPE' ] == 'application/json' 
        ) {
            $method = json_decode( file_get_contents( 'php://input' ), true )[ '_method' ] ?? null;
        } else {
            $method = $_POST[ '_method' ] ?? null;
        }

        if ( 
            isset( $method ) and 
            in_array( strtoupper( $method ), [ 'PUT', 'DELETE', 'PATCH', ] ) 
        ) {
            $_SERVER[ 'REQUEST_METHOD' ] = strtoupper( $method );
        }
    }

    public function changeErrorApiResponse( $response ) 
    {
        if ( 
            preg_match( '/^\/wp-json\/appointments/', $_SERVER[ 'REQUEST_URI' ] ) and 
            is_wp_error( $response ) 
        ) {
            $data = $response->get_error_data();
            wp_send_json_error( [ 'message' => $response->get_error_message(), ], $data[ 'status' ] );
        }
    
        return $response;
    }

    public function api()
    {
        ( new WorkingHoursController )->registerRoutes();
        ( new ProvidersController )->registerRoutes();
        ( new WorkingDaysController )->registerRoutes();
        ( new ServicesController )->registerRoutes();
        ( new AppointmentsController )->registerRoutes();
        ( new SyncCredentialsController )->registerRoutes();
    }

    private function actions()
    {
        ( new ActionsController )->registerActions();
    }

    public function translation()
    {
        load_textdomain( 'appointments', APPOINTMENTS_ROOT . '/src/langs/'. get_locale() . '.mo' );
    }
}