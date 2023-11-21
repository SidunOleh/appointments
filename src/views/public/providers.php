<?php if ( $providers->count() ): ?>
<?php foreach ( $providers as $provider ): ?>
<div class="providers__item provider" provider-id="<?php echo $provider->id ?>">

    <div class="provider__top">
        <img src="<?php echo plugin_dir_url( APPOINTMENTS_ROOT . '/appointments.php' ) ?>/src/assets/public/img/provider.svg" alt="">
        <div class="provider__title">
            <?php echo $provider->getName( curr_lang() ) ?>
        </div>
    </div>

    <div class="provider__bottom">
        <div class="provider__text">
            <?php echo $provider->getDescription( curr_lang() ) ?>
        </div>
    </div>

</div>
<?php endforeach ?>
<?php else: ?>
<div class="text">
    <?php _e( 'No providers were found.', 'appointments' ) ?>
</div>
<div class="text">
    <?php _e( 'Choose another service.', 'appointments' ) ?>
</div>
<?php endif ?>