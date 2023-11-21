<?php

namespace Appointments\Shortcodes;

use Appointments\Models\Service;

class AppointmentShortcode extends Shortcode
{
    protected string $name = 'appointment';

    public function render( $attr ): string
    {
        $html = template_read( APPOINTMENTS_ROOT . '/src/views/public/appointment.php', [
            'services' => Service::all(),
        ] );

        return $html;
    }
}