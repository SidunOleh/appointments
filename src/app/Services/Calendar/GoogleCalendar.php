<?php

namespace Appointments\Services\Calendar;

use Appointments\Models\Appointment;
use Exception;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google\Service\Calendar\Event;

class GoogleCalendar
{
    private Google_Service_Calendar $calendar;

    public function __construct( array $authConfig ) 
    {
        $client = new Google_Client();
        $client->setAuthConfig( $authConfig );
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

        $googleEvent = $this->calendar->events->insert( $calendarId, $event );

        return $googleEvent;
    }

    public function removeAppointment( string $eventId, string $calendarId = 'primary' ): bool
    {
        $res = $this->calendar->events->delete( $calendarId, $eventId );

        if ( $res->getStatusCode() != 200 ) {
            throw new Exception( $res->getBody()->getContents(), $res->getStatusCode() );
        }

        return true;
    }
}