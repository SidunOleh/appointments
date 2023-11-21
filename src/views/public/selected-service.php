<div class="selected-service">
    <img src="<?php echo wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ) ) ?>" alt="">

    <div class="selected-service__title">
        <?php bloginfo( 'name' ) ?>
    </div>

    <div class="selected-service__text">
        <?php _e( 'Welcome to our consultation', 'appointments' ) ?>
    </div>

    <div class="selected-service__title2">
        <?php bloginfo( 'name' ) ?>
    </div>

    <div class="selected-service__name">
    </div>

    <div class="selected-service__time">
        <img src="<?php echo plugin_dir_url( APPOINTMENTS_ROOT . '/appointments.php' ) ?>/src/assets/public/img/time.svg" alt="">
        <span></span> <?php _e( 'minutes', 'appointments' ) ?>
    </div>

    <div class="selected-service__desc">
        <img src="<?php echo plugin_dir_url( APPOINTMENTS_ROOT . '/appointments.php' ) ?>/src/assets/public/img/desc.svg" alt="">
        <span></span>
    </div>

    <div class="selected-service__amount">
        <img src="<?php echo plugin_dir_url( APPOINTMENTS_ROOT . '/appointments.php' ) ?>/src/assets/public/img/ammount.svg" alt="">
        <span></span>
    </div>
</div>