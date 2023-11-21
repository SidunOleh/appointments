<?php

namespace Appointments;

use Illuminate\Database\Capsule\Manager as Capsule;

class Activator
{
    public function activate()
    {
        $this->createTables();
    }

    public function activated( $plugin )
    {
        if ( $plugin != 'appointments/appointments.php' ) return;

        wp_redirect( admin_url( 'admin.php?page=appointments' ) );
        die;
    }

    private function createTables()
    {
        if ( ! Capsule::schema()->hasTable( 'appointments_providers' ) ) {
            Capsule::schema()->create(
                'appointments_providers',
                function ( $table ) {
                    $table->increments( 'id' );
                    $table->string( 'name' );
                    $table->string( 'email' );
                    $table->text( 'description' )->nullable();
                    $table->string( 'name_ua' )->nullable();
                    $table->text( 'description_ua' )->nullable();
                    $table->string( 'name_ru' )->nullable();
                    $table->text( 'description_ru' )->nullable();
                    $table->boolean( 'sync_google_calendar' )->default( false );
                    $table->string( 'google_calendar_id' )->nullable();
                    $table->timestamps();
                }
            );
        }

        if ( ! Capsule::schema()->hasTable( 'appointments_working_days' ) ) {
            Capsule::schema()->create( 
                'appointments_working_days', 
                function ( $table ) {
                    $table->increments( 'id' );
                    $table->date( 'date' );
                    $table->json( 'working_hours' );
                    $table->unsignedInteger( 'provider_id' );
                    $table->foreign( 'provider_id' )
                        ->references( 'id' )
                        ->on( 'appointments_providers' )
                        ->onDelete( 'cascade' );
                    $table->timestamps();
                } 
            );
        }

        if ( ! Capsule::schema()->hasTable( 'appointments_services' ) ) {
            Capsule::schema()->create( 
                'appointments_services', 
                function ( $table ) {
                    $table->increments( 'id' );
                    $table->string( 'name' );
                    $table->integer( 'duration' );
                    $table->decimal( 'price', 15, 2 );
                    $table->text( 'description' )->nullable();
                    $table->string( 'name_ua' )->nullable();
                    $table->text( 'description_ua' )->nullable();
                    $table->string( 'name_ru' )->nullable();
                    $table->text( 'description_ru' )->nullable();
                    $table->timestamps();
                } 
            );
        }

        if ( ! Capsule::schema()->hasTable( 'appointments_provider_service' ) ) {
            Capsule::schema()->create( 
                'appointments_provider_service', 
                function ( $table ) {
                    $table->increments( 'id' );
                    $table->unsignedInteger( 'provider_id' );
                    $table->foreign( 'provider_id' )
                        ->references( 'id' )
                        ->on( 'appointments_providers' )
                        ->onDelete( 'cascade' );
                    $table->unsignedInteger( 'service_id' );
                    $table->foreign( 'service_id' )
                        ->references( 'id' )
                        ->on( 'appointments_services' )
                        ->onDelete( 'cascade' );  
                    $table->timestamps(); 
                } 
            );
        }

        if ( ! Capsule::schema()->hasTable( 'appointments_customers' ) ) {
            Capsule::schema()->create( 
                'appointments_customers', 
                function ( $table ) {
                    $table->increments( 'id' );
                    $table->string( 'name' );
                    $table->string( 'email' );
                    $table->string( 'phone' );
                    $table->timestamps();
                } 
            );
        }

        if ( ! Capsule::schema()->hasTable( 'appointments_appointments' ) ) {
            Capsule::schema()->create( 
                'appointments_appointments', 
                function ( $table ) {
                    $table->increments( 'id' );
                    $table->datetime( 'start' )->nullable();
                    $table->text( 'comment' )->nullable();
                    $table->boolean( 'pay_status' )->default( false );
                    $table->unsignedInteger( 'service_id' );
                    $table->foreign( 'service_id' )
                        ->references( 'id' )
                        ->on( 'appointments_services' )
                        ->onDelete( 'cascade' );  
                    $table->unsignedInteger( 'provider_id' );
                    $table->foreign( 'provider_id' )
                        ->references( 'id' )
                        ->on( 'appointments_providers' )
                        ->onDelete( 'cascade' );  
                    $table->unsignedInteger( 'customer_id' );
                    $table->foreign( 'customer_id' )
                        ->references( 'id' )
                        ->on( 'appointments_customers' )
                        ->onDelete( 'cascade' ); 
                    $table->string( 'delete_token' )->nullable();
                    $table->string( 'google_calendar_event_id' )->nullable();
                    $table->timestamps();
                    $table->index( [ 'provider_id', 'start', ] );
                } 
            );
        }
    }
}