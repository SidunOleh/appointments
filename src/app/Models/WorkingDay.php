<?php

namespace Appointments\Models;

use DateTime;
use Illuminate\Database\Capsule\Manager as Capsule;

class WorkingDay extends Model
{
    protected $table = 'appointments_working_days';

    protected $fillable = [
        'date',
        'working_hours',
        'provider_id',
    ];

    protected $casts = [
        'working_hours' => 'array',
    ];

    public static function getForMonth( int $providerId, int $year, int $month ): array
    {
        $workignDays = self::where( 'provider_id', $providerId )
            ->whereRaw( 'YEAR(`date`) = ?', [ $year ] )
            ->whereRaw( 'MONTH(`date`) = ?', [  $month ] )
            ->get()
            ->toArray();

        return $workignDays;
    }

    public static function getFreeDaysForMonth( int $providerId, int $year, int $month ): array
    {
        global $wpdb;
        $freeDays = Capsule::select( "
            WITH RECURSIVE numbers AS (
                SELECT
                    0 AS n
                UNION ALL
                SELECT 
                    n + 1 
                FROM 
                    numbers 
                WHERE 
                    n < 99
            ), working_days(provider_id, date, hour) AS (
                SELECT 
                    provider_id, date, JSON_UNQUOTE(JSON_EXTRACT(working_hours, CONCAT('$[', numbers.n, ']'))) AS hour
                FROM 
                    {$wpdb->base_prefix}appointments_working_days
                JOIN 
                    numbers
                WHERE 
                    provider_id = :provider_id AND
                    YEAR(date) = :year AND
                    MONTH(date) = :month AND
                    JSON_EXTRACT(working_hours, CONCAT('$[', numbers.n, ']')) IS NOT NULL	
            )
            
            SELECT 
                d.date, GROUP_CONCAT(d.hour) AS working_hours
            FROM 
                working_days AS d 
            LEFT JOIN 
                {$wpdb->base_prefix}appointments_appointments AS a
            ON 
                d.provider_id = a.provider_id AND
                CONCAT(d.date, ' ', d.hour) = a.start
            WHERE
                a.id IS NULL AND
                CONCAT(d.date, ' ', d.hour) >= '" . ( new DateTime( 'now', get_timezone() ) )->format( 'Y-m-d H:i' ) . "'
            GROUP BY 
                d.date
        ", [
            'provider_id' => $providerId,
            'year' => $year,
            'month' => $month,
        ] );

        return $freeDays;
    }

    public function hasHour( string $hour ): bool
    {
        return in_array( $hour, $this->working_hours );
    }
}