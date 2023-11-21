<?php

namespace Appointments\Models;

use Illuminate\Database\Eloquent\Model as ELoquentModel;

abstract class Model extends ELoquentModel
{
    public static function index( int $page = 1, int $perPage = 15, string $orderby = 'created_at', string $order = 'DESC', array $filters = [] ): array
    {
        $query = static::orderBy( $orderby, $order );

        foreach ( $filters as $field => $values ) {
            $query->whereIn( $field, $values );
        }

        return $query->paginate( $perPage, [ '*' ], 'page', $page )->toArray();
    }
}