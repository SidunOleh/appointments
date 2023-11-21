<?php

namespace Appointments\Controllers\Api;

use Appointments\Controllers\Controller;

abstract class ApiController extends Controller
{
    protected string $namespace;

    public function __construct()
    {
        $this->namespace = 'appointments/v1';
    }
}