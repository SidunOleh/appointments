<?php

namespace Appointments\Controllers;

abstract class Controller
{
    protected function sendSuccess( array|null $data = null, int $status = 200 )
    {
        wp_send_json_success( $data, $status );
    }

    protected function sendError( array|null $data = null, int $status = 400 )
    {
        wp_send_json_error( $data, $status );
    }

    protected function redirect( string $url, int $status = 302 )
    {
        wp_redirect( $url, $status );
        die;
    }
}