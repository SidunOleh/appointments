<?php

namespace Appointments\Models;

use WP_Error;

class Customer extends Model
{
    protected $table = 'appointments_customers';

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];
}