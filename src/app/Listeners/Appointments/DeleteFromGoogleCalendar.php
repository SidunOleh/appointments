<?php

namespace Appointments\Listeners\Appointments;

use Appointments\Models\Appointment;
use Appointments\Services\Calendar\GoogleCalendar;
use Exception;

class DeleteFromGoogleCalendar
{
    public function __invoke( Appointment $appointment ): void
    {
        try {
            if (
                $appointment->provider->sync_google_calendar and
                $appointment->google_calendar_event_id 
            ) {
                ( new GoogleCalendar )->removeAppointment( 
                    $appointment->google_calendar_event_id, 
                    $appointment->provider->google_calendar_id
                );
            }
        } catch ( Exception $e ) {
            logger( [
                'code' => $e->getCode(),
                'message' => $e->getMessage(), 
            ] );
        }
    }
}