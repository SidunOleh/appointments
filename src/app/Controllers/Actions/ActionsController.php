<?php

namespace Appointments\Controllers\Actions;

use Appointments\Controllers\Controller;
use Appointments\Models\Appointment;
use Appointments\Models\Service;

class ActionsController extends Controller
{
    public function registerActions()
    {
        ajax_callback( 'service_providers', [ $this, 'serviceProviders' ], true );    
        ajax_callback( 'cancel', [ $this, 'cancelAppointment' ], true );    
    }

    public function serviceProviders()
    {
        $serviceId = ( int ) $_GET[ 'service_id' ];

        if ( ! $service = Service::find( $serviceId ) ) {
            $this->sendError( [ 'message' => __( 'Service not found.', 'appointments' ) ] );
        }

        $providers = $service->providers;
        $providersHtml = template_read( APPOINTMENTS_ROOT . '/src/views/public/providers.php', [
            'providers' => $providers,
        ] );

        return $this->sendSuccess( [ 'providers_html' => $providersHtml, ] );
    }

    public function cancelAppointment()
    {
        $deleteToken = $_GET[ 'token' ] ?? '';

        if ( $appointment = Appointment::where( 'delete_token', $deleteToken )->first() ) {
            $appointment->delete();
        }

        $this->redirect( '/cancel' );
    }
}