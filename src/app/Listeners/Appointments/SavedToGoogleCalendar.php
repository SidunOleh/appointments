<?php

namespace Appointments\Listeners\Appointments;

use Appointments\Models\Appointment;
use Appointments\Services\Calendar\GoogleCalendar;
use Exception;

class SavedToGoogleCalendar
{
    public function __invoke( Appointment $appointment ): void
    {
        try {
            if ( $appointment->provider->sync_google_calendar ) {
                $event = ( new GoogleCalendar )->addAppointment( 
                    $appointment, 
                    $appointment->provider->google_calendar_id
                );
    
                $appointment->google_calendar_event_id = $event->getId();
                $appointment->save();
            }
        } catch ( Exception $e ) {
            logger( [
                'code' => $e->getCode(),
                'message' => $e->getMessage(), 
            ] );
        }
    }
}