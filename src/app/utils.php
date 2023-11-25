<?php

/**
 * Permission callback
 */
function permission_callback( string $permission ) {
    return function () use( $permission ) {
        return is_user_logged_in() and current_user_can( $permission );
    };
}

/**
 * Get option
 */
function get_appointemnts_option( string $option, $default = null ) {
    $options = get_option( 'appointments', [] );
    if ( ! isset( $options[ $option ] ) ) {
        return $default;
    }

    return $options[ $option ];
}

/**
 * Update option
 */
function update_appointemnts_option( string $option, $value ): bool {
    $options = get_option( 'appointments', [] );
    $options[ $option ] = $value;

    return update_option( 'appointments', $options );
}

/**
 * Read template
 */
function template_read( $template_path, $data = [] ): string {
    extract( $data );

    ob_start();
    require $template_path;
    $template_data = ob_get_clean();

    return $template_data;
}

/**
 * Register ajax callback
 */
function ajax_callback( 
    string $action, 
    callable $callback, 
    bool $nopriv = false 
) {
    add_action( "wp_ajax_{$action}", $callback );

    if ( $nopriv ) {
        add_action( "wp_ajax_nopriv_{$action}", $callback ); 
    }
}

/**
 * Current language
 */
function curr_lang(): string {
    if ( function_exists( 'pll_current_language' ) ) {
        return pll_current_language();
    }

    return 'en';
}

/**
 * Get timezone
 */
function get_timezone(): DateTimeZone {
    return new DateTimeZone( 'America/New_York' );
}

/**
 * Logger
 */
function logger( array $data ): void {
    $time = ( new DateTime( 'now', get_timezone() ) )
        ->format( 'Y-m-d H:i:s' );
    $data = [ 'time' => $time, ] + $data;
    file_put_contents(
        APPOINTMENTS_ROOT . '/src/storage/logs/appointments.log',
        json_encode( $data ) . "\n",
        FILE_APPEND
    );
}

/**
 * Get ip
 */
function get_ip() {
    return $_SERVER[ 'REMOTE_ADDR' ];
}