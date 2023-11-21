<?php

namespace Appointments\Services\Calendar;

use Appointments\Models\Appointment;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google\Service\Calendar\Event;

class GoogleCalendar
{
    private Google_Service_Calendar $calendar;

    public function __construct() 
    {
        $client = new Google_Client();
        $client->setAuthConfig( APPOINTMENTS_ROOT . '/src/storage/credentials/service-account-jwt.json' );
        $client->addScope( Google_Service_Calendar::CALENDAR );
        $this->calendar = new Google_Service_Calendar( $client );
    }

    public function addAppointment( Appointment $appointment, string $calendarId = 'primary' ): Event
    {
        $event = new Google_Service_Calendar_Event( [
            'summary' => get_bloginfo( 'name' ),
            'description' => $appointment->getDescription(),
            'start' => [
                'dateTime' => $appointment->getStart()->format( 'Y-m-d\TH:i:s' ),
                'timeZone' => $appointment->getStart()->getTimezone()->getName(),
            ],
            'end' => [
                'dateTime' => $appointment->getEnd()->format( 'Y-m-d\TH:i:s' ),
                'timeZone' => $appointment->getEnd()->getTimezone()->getName(),
            ],
        ] );

        return $this->calendar->events->insert( $calendarId, $event );
    }

    public function removeAppointment( string $eventId, string $calendarId = 'primary' ): bool
    {
        $response = $this->calendar->events->delete( $calendarId, $eventId );

        return $response->getStatusCode() == 200;
    }
}