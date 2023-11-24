<?php

namespace Appointments\Models;

class Customer extends Model
{
    protected $table = 'appointments_customers';

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];
}