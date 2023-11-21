<?php

namespace Appointments\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $table = 'appointments_services';

    protected $fillable = [
        'name',
        'price',
        'duration',
        'description',
        'name_ua',
        'description_ua',
        'name_ru',
        'description_ru',
    ];

    protected $with = [ 'providers', ];

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

    protected function price(): Attribute
    {
        return Attribute::make(
            get: function ( float $value ) {
                if ( $value == round( $value ) ) {
                    return round( $value );
                } else {
                    return number_format( $value, 1 );
                }
            },
        );
    }

    public function providers(): BelongsToMany
    {
        return $this->belongsToMany( 
            Provider::class,
            'appointments_provider_service'
        )->withTimestamps();
    }

    public function appointments(): HasMany
    {
        return $this->hasMany( Appointment::class );
    }
}