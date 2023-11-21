<?php

namespace Appointments\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Provider extends Model
{
    protected $table = 'appointments_providers';

    protected $fillable = [
        'name',
        'email',
        'description',
        'name_ua',
        'description_ua',
        'name_ru',
        'description_ru',
        'sync_google_calendar',
        'google_calendar_id',
    ];

    protected $casts = [
        'sync_google_calendar' => 'bool',
    ];

    public function getName( string $lang ): string
    {
        if ( $lang == 'uk' ) {
            return $this->name_ua;
        }

        if ( $lang == 'ru' ) {
            return $this->name_ru;
        }

        return $this->name;
    }

    public function getDescription( string $lang ): string
    {
        if ( $lang == 'uk'  ) {
            return $this->description_ua;
        }

        if ( $lang == 'ru' ) {
            return $this->description_ru;
        }

        return $this->description;
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany( 
            Service::class,
            'appointments_provider_service'
        )->withTimestamps();
    }

    public function workingDays(): HasMany
    {
        return $this->hasMany( WorkingDay::class );
    }

    public function appointments(): HasMany
    {
        return $this->hasMany( Appointment::class );
    }

    public function hasService( int $serviceId ): bool
    {
        return ( bool ) $this->services()
            ->where( 'appointments_services.id', $serviceId )
            ->count();
    }

    public function hasWorkingDay( string $date )
    {
        return ( bool ) $this->workingDays()
            ->where( 'date', $date )
            ->count();
    }

    public function hasAppointment( string $date, string $hour ): bool
    {
        return ( bool ) $this->appointments()
            ->where( 'start', $date . ' ' . $hour )
            ->count();
    }
}