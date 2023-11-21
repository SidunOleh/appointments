<?php

namespace Appointments\Listeners\Appointments;

use Appointments\Models\Appointment;
use Appointments\Services\Email\Email;

class CreatedSendEmails
{
    public function __invoke( Appointment $appointment ): void
    {
        // to provider
        $message = template_read(
            APPOINTMENTS_ROOT . '/src/views/admin/emails/new-appointment-to-provider.php',
            [ 'appointment' => $appointment, ]
        );
        ( new Email )
            ->to( $appointment->provider->email )
            ->subject( __( 'New appointment', 'appointments' ) )
            ->message( $message )
            ->send();

        // to customer
        $message = template_read(
            APPOINTMENTS_ROOT . '/src/views/admin/emails/new-appointment-to-customer.php',
            [ 'appointment' => $appointment, ]
        );
        ( new Email )
            ->to( $appointment->customer->email )
            ->subject( __( 'New appointment', 'appointments' ) )
            ->message( $message )
            ->send();
    }
}