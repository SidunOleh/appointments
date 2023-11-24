<?php

namespace Appointments\Models;

use Appointments\Listeners\Appointments\DeleteFromGoogleCalendar;
use Appointments\Listeners\Appointments\CreatedSendEmails;
use Appointments\Listeners\Appointments\SavedToGoogleCalendar;
use DateTime;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    protected $table = 'appointments_appointments';

    protected $fillable = [
        'start',
        'comment',
        'service_id',
        'provider_id',
        'customer_id',
        'delete_token',
        'ip',
    ];

    protected $casts = [
        'pay_status' => 'bool',
    ];

    protected $with = [ 'service', 'provider', 'customer', ];

    public function service(): BelongsTo
    {
        return $this->belongsTo( Service::class );
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo( Provider::class );
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo( Customer::class );
    }

    public static function deleteToken(): string
    {
        return bin2hex( random_bytes( 20 ) );
    }

    public function getDescription(): string
    {
        $desc = <<<DESC
        Service: {$this->service->name}
        Name: {$this->customer->name}
        E-mail: {$this->customer->email}
        Phone: {$this->customer->phone}
        DESC;

        if ( $this->comment ) $desc .= "\nMessage: {$this->comment}";

        return $desc;
    }

    public function getStart(): DateTime
    {
        return new DateTime( $this->start, get_timezone() );
    }

    public function getEnd(): DateTime
    {
        $start = new DateTime( $this->start, get_timezone() );

        return $start->modify( "+{$this->service->duration} minutes" );
    }

    public static function canCreateWithIp( string $ip ): bool
    {
        $date = ( new DateTime( 'now', get_timezone() ) )
            ->modify( '-1 month' )
            ->format( 'Y-m-d H:i:s' );
        $appointments = self::where( 'ip', $ip )
            ->where( 'created_at', '>', $date )
            ->get();

        if ( $appointments->count() >= 3 ) {
            return false;
        }

        return true;
    }

    protected static function booted(): void
    {
        static::created( new CreatedSendEmails );
        static::created( new SavedToGoogleCalendar );
        static::deleted( new DeleteFromGoogleCalendar );
    }
}