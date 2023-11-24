<style>

* {
    padding: 0;
    margin: 0;
    border: 0;
}

*,
*:before,
*:after {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

:focus,
:active {
    outline: none;
}

a:focus,
a:active {
    outline: none;
}

nav,
footer,
header,
aside {
    display: block;
}

html,
body {
    height: 100%;
    width: 100%;
    font-size: 100%;
    line-height: 1;
    font-size: 14px;
    -ms-text-size-adjust: 100%;
    -moz-text-size-adjust: 100%;
    -webkit-text-size-adjust: 100%;
}

input,
button,
textarea {
    font-family: inherit;
}

input::-ms-clear {
    display: none;
}

button {
    cursor: pointer;
}

button::-moz-focus-inner {
    padding: 0;
    border: 0;
}

a,
a:visited {
    text-decoration: none;
}

a:hover {
    text-decoration: none;
}

ul li {
    list-style: none;
}

img {
    vertical-align: top;
}

h1,
h2,
h3,
h4,
h5,
h6 {
    font-size: inherit;
    font-weight: inherit;
}

.btn {
    padding: 16px;
    background-color: #A49561;
    text-align: center;
    font-size: 18px;
    font-weight: 700;
    font-family: sans-serif;
    letter-spacing: 0.44px;
    text-transform: uppercase;
    color: white;
    cursor: pointer;
}

.btn:hover {
    background-color: #514315;
}

.title {
    font-size: 24px;
    font-weight: 700;
    text-align: center;
}

.appointment-btn {
    display: inline-block;
}

.appointment-modal__wrapper {
    opacity: 0;
    visibility: hidden;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    padding: 0 75px;
    overflow: auto;
    background-color: #1716167d;
    font-family: sans-serif;
}

@media (max-width: 768px) {
    .appointment-modal__wrapper {
        padding: 0 10px;
    }
}

.appointment-modal__wrapper.open {
    -webkit-transition: all 0.1s linear;
    transition: all 0.1s linear;
    opacity: 1 !important;
    visibility: visible;
}

.appointment-modal__close {
    position: absolute;
    top: 0;
    right: -14px;
    -webkit-transform: translate(100%, 0);
    transform: translate(100%, 0);
    padding: 16px 16px 14px 16px;
    background-color: white;
    font-size: 20px;
    color: #A49561;
    cursor: pointer;
}

.appointment-modal__close:hover {
    color: #514315;
}

@media (max-width: 768px) {
    .appointment-modal__close {
        top: -10px;
        right: 0;
        -webkit-transform: translate(0, -100%);
        transform: translate(0, -100%);
        padding: 8px 8px 6px 8px;
    }
}

.appointment-modal__body {
    position: relative;
    max-width: 1140px;
    margin: 95px auto;
}

.appointment-modal__content {
    padding: 48px;
    background-color: white;
}

@media (max-width: 768px) {
    .appointment-modal__content {
        padding: 24px;
    }
}

.services {
    text-align: center;
}

.services__title {
    margin: 4px 0 8px 0;
    font-size: 20px;
    font-weight: 700;
    text-transform: uppercase;
}

.services__text {
    max-width: 450px;
    margin: 0 auto;
    text-align: justify;
    font-size: 16px;
    font-weight: 500;
    line-height: 20px;
}

.services__items {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-top: 32px;
}

@media (max-width: 768px) {
    .services__items {
        grid-template-columns: 1fr;      
    }
}

.service {
    -webkit-box-flex: 1;
    -ms-flex-positive: 1;
    flex-grow: 1;
    padding: 24px;
    background-color: #F5F5F5;
    cursor: pointer;
}

.service:hover {
    background-color: #ffffff;
}

.service__top {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
}

@media (max-width: 425px) {
    .service__top {
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
    }
}

.service__title {
    font-size: 20px;
    font-weight: 700;
}

.service__middle {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
}

@media (max-width: 425px) {
    .service__middle {
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
    }
}

.service__ammount {
    font-size: 20px;
    font-weight: 700;
}

.service__bottom {
    padding-top: 16px;
    border-top: 1px solid #D9D9D9;
}

.service__text {
    font-size: 16px;
    font-weight: 500;
}

.providers {
    text-align: center;
}

.providers__title {
    margin: 4px 0 8px 0;
    font-size: 20px;
    font-weight: 700;
    text-transform: uppercase;
}

.providers__text {
    max-width: 450px;
    margin: 0 auto;
    text-align: justify;
    font-size: 16px;
    font-weight: 500;
    line-height: 20px;
}

.providers__items {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-top: 32px;
}

@media (max-width: 768px) {
    .providers__items {
        grid-template-columns: 1fr;      
    }
}


.provider {
    -webkit-box-flex: 1;
    -ms-flex-positive: 1;
    flex-grow: 1;
    padding: 24px;
    background-color: #F5F5F5;
    cursor: pointer;
}

.provider:hover {
    background-color: #ffffff;
}

.provider__top {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
}

@media (max-width: 425px) {
    .provider__top {
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
    }
}

.provider__title {
    font-size: 20px;
    font-weight: 700;
}

.provider__bottom {
    padding-top: 16px;
    border-top: 1px solid #D9D9D9;
}

.provider__text {
    font-size: 16px;
    font-weight: 500;
}

.datetime__content {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    gap: 24px;
}

@media (max-width: 1440px) {
    .datetime__content {
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
    }
}

.datetime__left {
    flex-basis: 60%;
    padding-right: 24px;
    border-right: 1px solid #DFD7B9;
}

@media (max-width: 1440px) {
    .datetime__left {
        padding-right: 0px;
        border-right: none;
    }
}

.datetime__right {
    flex-basis: 40%;
}

.datetime__datehours {
    flex-grow: 1;
    display: flex;
}

@media (max-width: 768px) {
    .datetime__datehours {
        flex-direction: column;
    }
}

.datetime__datehours > .date {
    flex-grow: 1;
}

.selected-service__title {
    margin: 8px 0 24px 0;
    text-align: left;
    font-size: 20px;
    font-weight: 700;
    text-transform: uppercase;
}

.selected-service__text {
    margin-bottom: 24px;
    font-size: 16px;
    font-weight: 500;
}

.selected-service__title2 {
    margin-bottom: 8px;
    font-size: 16px;
    font-weight: 700;
    color: #8A8A8A;
}

.selected-service__name {
    margin-bottom: 8px;
    font-size: 24px;
    font-weight: 700;
}

.selected-service__time {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    gap: 8px;
    padding: 16px 0;
    border-bottom: 1px solid #D9D9D9;
    font-size: 16px;
    font-weight: 500;
}

.selected-service__time img {
    width: 25px;
}

.selected-service__desc {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    gap: 8px;
    padding: 16px 0;
    border-bottom: 1px solid #D9D9D9;
    font-size: 16px;
    font-weight: 500;
}

.selected-service__desc img {
    width: 25px;
}

.selected-service__amount {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    gap: 8px;
    padding: 16px 0;
    font-size: 16px;
    font-weight: 500;
}

.selected-service__amount img {
    width: 25px;
}

.date__title {
    margin-bottom: 24px;
}

.hours__date {
    margin-bottom: 24px;
    text-align: center;
    font-size: 16px;
    font-weight: 500;
}

.hour {
    margin-bottom: 24px;
    padding: 16px 60px;
    border: 1px solid #DFD7B9;
    text-align: center;
    font-size: 18px;
    font-weight: 500;
    color: #A49561;
    cursor: pointer;
}

.hour:last-child {
    margin-bottom: 0px;
}

.hour:hover {
    border: 1px solid #A49561;
}

.hour.selected {
    background-color: #DFD7B9;
}

.calendar {
    padding: 24px;
    background-color: #F5F5F5;
    font-size: 16px;
    color: #7E7E7E;
}

@media (max-width: 425px) {
    .calendar {
        padding: 16px;
    }
}

.calendar__top {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: space-around;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    padding-bottom: 10px;
    border-bottom: 1px solid #D9D9D9;
    text-align: center;
}

@media (max-width: 425px) {
    .calendar__top {
        padding-bottom: 7px;
    }
}


.calendar__top .date {
    font-weight: 500;
    color: #3E3E3E;
}


.calendar__week {
    display: -ms-grid;
    display: grid;
    -ms-grid-columns: (1fr)[7];
    grid-template-columns: repeat(7, 1fr);
    gap: 5px;
    margin-top: 16px;
}

.calendar__week span {
    text-align: center;
    font-size: 12px;
    font-weight: 500;
    color: #3E3E3E;
}

.calendar__days {
    display: -ms-grid;
    display: grid;
    -ms-grid-columns: 1fr 10px 1fr 10px 1fr 10px 1fr 10px 1fr 10px 1fr 10px 1fr;
    grid-template-columns: repeat(7, 1fr);
    gap: 8px;
    margin-top: 20px;
}

.calendar__days span {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    aspect-ratio: 1/1;
    border-radius: 50%;
    background-color: #F5F5F5;
    text-align: center;
}

.calendar .arrow {
    padding: 13px 14px;
    border-radius: 50%;
    color: #A49561;
    cursor: pointer;
}

.calendar .arrow:hover {
    background-color: #DFD7B9;
}

.calendar .curr-day {
    cursor: pointer;
}

.calendar .curr-day:hover {
    background-color: #A49561;
    font-weight: 700;
    color: white;
}

.calendar .curr-day.selected {
    background-color: #A49561;
    font-weight: 700;
    color: white;
}

.curr-day.free {
    background-color: white;
    font-weight: 700;
    color: #A49561;
}

.curr-day:not(.free) {
    pointer-events: none;
}

.appointment-form__content {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    gap: 24px;
}

@media (max-width: 1440px) {
    .appointment-form__content {
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
    }
}

.appointment-form__left {
    flex-basis: 40%;
    padding-right: 24px;
    border-right: 1px solid #DFD7B9;
}

@media (max-width: 1440px) {
    .appointment-form__left {
        border-right: none;
    }
}

.appointment-form__right {
    flex-basis: 60%;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
}

.appointment-form__title {
    margin-bottom: 24px;
}

.appointment-form__form {
    -webkit-box-flex: 1;
    -ms-flex-positive: 1;
    flex-grow: 1;
    margin-bottom: 24px;
}

.appointment-form__inputs {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    gap: 16px;
    margin-bottom: 24px;
}

.appointment-form__inputs input {
    -ms-flex-preferred-size: 45%;
    flex-basis: 45%;
    -webkit-box-flex: 1;
    -ms-flex-positive: 1;
    flex-grow: 1;
    padding: 16px;
    background-color: #F5F5F5;
}

.appointment-form__comment textarea {
    width: 100%;
    padding: 16px;
    background-color: #F5F5F5;
}

.appointment-form__text {
    margin-bottom: 16px;
    color: #272727;
}

.step {
    display: none;
}

.step.current {
    display: initial;
}

.loading {
    position: relative;
}

.loading::before {
    content: "";
    position: absolute;
    z-index: 10;
    top: 0;
    left: 0;
    background: -webkit-gradient(linear, left top, right bottom, color-stop(40%, #eeeeee), color-stop(50%, #dddddd), color-stop(60%, #eeeeee));
    background: linear-gradient(to bottom right, #eeeeee 40%, #dddddd 50%, #eeeeee 60%);
    background-size: 200% 200%;
    background-repeat: no-repeat;
    -webkit-animation: placeholderShimmer 2s infinite linear;
    animation: placeholderShimmer 2s infinite linear;
    height: 100%;
    width: 100%;
    opacity: 0.6;
}

@-webkit-keyframes placeholderShimmer {
    0% {
        background-position: 100% 100%;
    }
    100% {
        background-position: 0 0;
    }
}

@keyframes placeholderShimmer {
    0% {
        background-position: 100% 100%;
    }
    100% {
        background-position: 0 0;
    }
}

.hours {
    width: 0;
    height: 0;
    opacity: 0;
    position: relative;
    left: 20px;
    transition: opacity,left 0.5s linear;
}

.hours.show {
    width: auto;
    height: auto;
    opacity: 1;
    left: 0;
    margin: 0 0 0 24px;
}

@media (max-width: 768px) {
    .hours.show {
        margin: 24px 0 0 0;
    }
}

.next-btn {
    display: none;
    margin-top: 24px;
}

@media (min-width: 768px) {
    .next-btn_2.show {
        display: none !important;
    }
}

@media (max-width: 768px) {
    .next-btn_1.show {
        display: none !important;
    }
}

.next-btn.show {
    display: block;
}

.services__logo {
    text-align: center;
}

.providers__logo {
    text-align: center;
}

.appointment-form__btn {
    width: 100%;
    margin-top: 24px;
}

.back-arrow {
    position: absolute;
    top: 48px;
    left: 16px;
    cursor: pointer;
    transition: all 0.1s linear;
}

.back-arrow:hover {
    transform: scale(1.1);
}

@media (max-width: 768px) {
    .back-arrow {
        top: 24px;
        left: 3px;
        transform: scale(0.8);
    }
}

.thank-you__text {
    text-align: center;
    font-size: 24px;
    font-weight: 700;
}

.text {
    font-size: 20px;
    font-weight: 700;
    text-align: center;
}

</style>

<div class="appointment-btn btn">
    <?php _e( 'schedule a consultation', 'appointments' ) ?>
</div>

<div class="appointment-modal__wrapper">

    <div class="appointment-modal__body">

        <div class="appointment-modal__close">
            ✕
        </div>

        <div class="appointment-modal__content">

            <div class="step services current" id="step-1">

                <div class="services__logo">
                    <img src="<?php echo wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ) ) ?>" alt="">
                </div>

                <div class="services__title">
                    <?php bloginfo( 'name' ) ?>
                </div>

                <div class="services__text">
                    <?php echo apply_filters( 'appoitments_services_text', '' ) ?>
                </div>

                <div class="services__items">

                    <?php if ( $services->count() ): ?>
                    <?php foreach ( $services as $service ): ?>
                    <div 
                        class="services__item service" 
                        service-id="<?php echo $service->id ?>" 
                        service-data="<?php echo htmlspecialchars( json_encode( $service ) ) ?>">

                        <div class="service__top">
                            <img src="<?php echo plugin_dir_url( APPOINTMENTS_ROOT . '/appointments.php' ) ?>/src/assets/public/img/service.svg" alt="">
                            <div class="service__title">
                                <?php echo $service->getName( curr_lang() ) ?>
                            </div>
                        </div>

                        <div class="service__middle">
                            <img src="<?php echo plugin_dir_url( APPOINTMENTS_ROOT . '/appointments.php' ) ?>/src/assets/public/img/ammount.svg" alt="">
                            <div class="service__ammount">
                                <?php echo $service->price ?>$
                            </div>
                        </div>

                        <div class="service__bottom">
                            <div class="service__text">
                                <?php echo $service->getDescription( curr_lang() ) ?>
                            </div>
                        </div>

                    </div>
                    <?php endforeach ?>
                    <?php else: ?>
                        <div class="text">
                            <?php _e( 'No services were found.', 'appointments' ) ?>
                        </div>
                        <div class="text">
                            <?php _e( 'Try again later.', 'appointments' ) ?>
                        </div>
                    <?php endif ?>
                    
                </div>

            </div>

            <div class="step providers" id="step-2">

                <img
                    title="<?php _e( 'Back to previous step', 'appointments' ) ?>"
                    class="back-arrow" 
                    src="<?php echo plugin_dir_url( APPOINTMENTS_ROOT . '/appointments.php' ) ?>/src/assets/public/img/back-arrow.svg" alt="">

                <div class="providers__logo">
                    <img src="<?php echo wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ) ) ?>" alt="">
                </div>

                <div class="providers__title">
                    <?php bloginfo( 'name' ) ?>
                </div>

                <div class="providers__text">
                    <?php echo apply_filters( 'appoitments_providers_text', '' ) ?>
                </div>

                <div class="providers__items">

                </div>

            </div>

            <div class="step datetime" id="step-3">

                <img
                    title="<?php _e( 'Back to previous step', 'appointments' ) ?>"
                    class="back-arrow" 
                    src="<?php echo plugin_dir_url( APPOINTMENTS_ROOT . '/appointments.php' ) ?>/src/assets/public/img/back-arrow.svg" alt="">
                
                <div class="datetime__content">

                    <div class="datetime__left">

                        <?php require APPOINTMENTS_ROOT . '/src/views/public/selected-service.php' ?>

                    </div>

                    <div class="datetime__right">

                        <div class="datetime__datehours">

                            <div class="date">
                                <div class="date__title title">
                                    <?php _e( 'Select a date & time', 'appointments' ) ?>
                                </div>

                                <div class="date__calendar">

                                </div>

                                <div class="next-btn next-btn_1 btn">
                                    <?php _e( 'Next step', 'appointments' ) ?>
                                </div>
                            </div>

                            <div class="hours">
                                <div class="hours__date">
                                </div>

                                <div class="hours__items">
                                </div>
                            </div>

                            <div class="next-btn next-btn_2 btn">
                                <?php _e( 'Next step', 'appointments' ) ?>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="step appointment-form" id="step-4">

                <img
                    title="<?php _e( 'Back to previous step', 'appointments' ) ?>"
                    class="back-arrow" 
                    src="<?php echo plugin_dir_url( APPOINTMENTS_ROOT . '/appointments.php' ) ?>/src/assets/public/img/back-arrow.svg" alt="">

                <div class="appointment-form__content">

                    <div class="appointment-form__left">

                        <?php require APPOINTMENTS_ROOT . '/src/views/public/selected-service.php' ?>

                    </div>

                    <div class="appointment-form__right">

                        <div class="appointment-form__title title">
                            <?php _e( 'Enter details', 'appointments' ) ?>
                        </div>

                        <form class="appointment-form__form" id="appointment-form">

                            <div class="appointment-form__inputs">
                                <input 
                                    type="text" 
                                    name="name" 
                                    required
                                    placeholder="<?php _e( 'Name*', 'appointments' ) ?>">
                                <input 
                                    type="text" 
                                    name="phone" 
                                    required
                                    placeholder="<?php _e( 'Phone number*', 'appointments' ) ?>">
                                <input 
                                    type="email" 
                                    name="email" 
                                    required
                                    placeholder="<?php _e( 'E-mail*', 'appointments' ) ?>">
                            </div>

                            <div class="appointment-form__comment">
                                <div class="appointment-form__text">
                                    <?php _e( 'Please provide your message', 'appointments' ) ?>
                                </div>
                                <textarea 
                                    style="resize:none;"
                                    name="comment" 
                                    placeholder="<?php _e( 'Message', 'appointments' ) ?>" 
                                    rows="10"></textarea>
                            </div>

                            <button class="appointment-form__btn btn">
                                <?php _e( 'Schedule event', 'appointments' ) ?>
                            </button>

                        </form>
                    </div>

                </div>

            </div>

            <div class="step thank-you" id="step-5">
                <div class="thank-you__text">
                    ✅ <?php _e( 'Successfully created. Thank you.', 'appointments' ) ?>
                </div>
            </div>

        </div>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="<?php echo plugin_dir_url( APPOINTMENTS_ROOT . '/appointmentss.php' )  ?>/src/assets/public/js/calendar.js"></script>
<script>
const lang = '<?php echo curr_lang() ?>'

/**
 * Popup
 */
$('.appointment-btn').click(e => {
    if ($('#step-5.current').length) step(1)
    $('.appointment-modal__wrapper').addClass('open')
    $('body').css('overflow', 'hidden')
})
$('.appointment-modal__close').click(e => {
    $('.appointment-modal__wrapper').removeClass('open')
    $('body').css('overflow', 'auto')
})

/**
 * Data
 */
let serviceId = null
let providerId = null
let date = null
let hour = null

const months = {
    en: [
        'January', 'February', 'March',
        'April', 'May', 'June',
        'July', 'August', 'September',
        'October', 'November', 'December'
    ],
    uk: [
        'Січень', 'Лютий', 'Березень',
        'Квітень', 'Травень', 'Червень',
        'Липень', 'Серпень', 'Вересень',
        'Жовтень', 'Листопад', 'Грудень'
    ],
    ru: [
        'Январь', 'Февраль', 'Март',
        'Апрель', 'Май', 'Июнь',
        'Июль', 'Август', 'Сентябрь',
        'Октябрь', 'Ноябрь', 'Декабрь'
    ],
}
const week = {
    en: [
        'SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'
    ],
    uk: [
        'НД', 'ПН', 'ВТ', 'СР', 'ЧТ', 'ПТ', 'СБ'
    ],
    ru: [
        'ВС', 'ПН', 'ВТ', 'СР', 'ЧТ', 'ПТ', 'СБ'
    ],
}

/**
 * Calendar
 */
let freeDays = []
let calendar = new Calendar({
    months: months[lang],
    week: week[lang],
    container: '.date__calendar',
    renderDay(day) {
        freeDays.forEach(freeDay => {
            if (
                freeDay.date == dateStr(this.current.year, this.current.month, day.value)
            ) {
                day.class = `${day.class} free`
            }
        })

        return day
    },
    changeMonth(date) {
        freeDays = getFreeDays(providerId, date.year, date.month)
    },
    select(selected) {
        date = selected
        freeDays.forEach(day => {
            if (
                day.date == dateStr(selected.year, selected.month, selected.day)
            ) {
                renderHours(day.date, day.working_hours.split(',').sort())
            }
        })
    },
})

/**
 * Select service
 */
$(document).on('click', '.service', selectService)

async function selectService(e) {
    loading('.appointment-modal__body')
    serviceId = $(e.currentTarget).attr('service-id')
    serviceData = JSON.parse($(e.currentTarget).attr('service-data'))
    renderService(serviceData)
    const res = await fetch(`/wp-admin/admin-ajax.php?action=service_providers&service_id=${serviceId}&lang=${lang}`)
    const data = await res.json()
    if (data.data.hasOwnProperty('providers_html')) {
        $('.providers__items').html(data.data.providers_html)
        step(2)
        loading('.appointment-modal__body', false)
    } else {
        alert('Error. Try again.')
        loading('.appointment-modal__body', false)
    }
} 

/**
 * Select provider
 */
$(document).on('click', '.provider', selectProvider)

function selectProvider(e) {
    loading('.appointment-modal__body')
    providerId = $(e.currentTarget).attr('provider-id')
    freeDays = getFreeDays(
        providerId, 
        calendar.current.year, 
        calendar.current.month
    )
    calendar.selected = {
        year: null,
        month: null,
        day: null,
    }
    calendar.renderMonth()
    $('.hours').removeClass('show')
    $('.next-btn').removeClass('show')
    $('.datetime__left').css('flex-basis', '60%')
    $('.datetime__right').css('flex-basis', '40%')
    step(3)
    loading('.appointment-modal__body', false)
}

/**
 * Get free days
 */
function getFreeDays(providerId, year, month) {
    const req = new XMLHttpRequest()
    req.open(
        'GET', 
        `/wp-json/appointments/v1/working-days/free?action=free_days&provider_id=${providerId}&year=${year}&month=${month+1}`, 
        false
    )
    req.send()
    if (req.status == 200) {
        const data = JSON.parse(req.responseText)

        return data.data
    } else {
        return []
    }
}

/**
 * Select hour
 */
$(document).on('click', '.hour', selectHour)

function selectHour(e) {
    hour = $(e.currentTarget).text().trim()
    $('.hour.selected').removeClass('selected')
    $(e.currentTarget).addClass('selected')
    $('.next-btn').addClass('show')
}

/**
 * Next
 */
$(document).on('click', '.next-btn', () => {
    loading('.appointment-modal__body')
    setTimeout(() => step(4), 250)
    loading('.appointment-modal__body', false)
})

/**
 * Form
 */
$('#appointment-form').submit(sendForm)

async function sendForm(e) {
    e.preventDefault()
    const form = e.currentTarget
    const data = new FormData(form)
    data.append('action', 'make_appointment')
    data.append('service_id', serviceId)
    data.append('provider_id', providerId)
    data.append('date', dateStr(date.year, date.month, date.day))
    data.append('hour', hour)
    loading('.appointment-modal__body')
    const res = await fetch('/wp-json/appointments/v1/appointments', {
        method: 'POST',
        body: data,
    })
    const resData = await res.json()
    if (res.status == 200) {
        step(5)
        form.reset()
    } else {
        if (resData?.data?.message) {
            alert(resData.data.message)
        } else {
            alert('Error. Try again.')
        }
    }
    loading('.appointment-modal__body', false)
}

/**
 * Show step
 */
function step(step) {
    $('.step.current').removeClass('current')
    $(`#step-${step}`).addClass('current')
}

/**
 * Go back
 */
$(document).on('click', '.back-arrow', goBack)

function goBack() {
    const current = $('.step.current')
    current.removeClass('current')
    current.prev().addClass('current')
}

/**
 * Render function
 */
function renderService(service) {
    let serviceLang = lang
    if (lang == 'en') {
        serviceLang = ''
    } else if (lang == 'uk') {
        serviceLang = '_ua'
    } else {
        serviceLang = '_'  + serviceLang
    }
    $('.selected-service__name').text(service[`name${serviceLang}`])
    $('.selected-service__time span').text(service.duration)
    $('.selected-service__desc span').text(service[`description${serviceLang}`])
    $('.selected-service__amount span').text(service.price + '$')
}

function renderHours(date, hours) {
    $('.hours__date').text(
        new Date(date).toLocaleString(lang, { 
            year: 'numeric',
            month: 'long',
            day: 'numeric',
        })
    )

    let hoursHtml = ''
    hours.forEach(hour => {
        hoursHtml += `<div class="hours__item hour">
                        ${hour}
                    </div>`
    })

    $('.hours__items').html(hoursHtml)

    $('.hours').addClass('show')
    $('.next-btn').removeClass('show')
    $('.datetime__left').css('flex-basis', '40%')
    $('.datetime__right').css('flex-basis', '60%')
}

/**
 * Loading
 */
function loading(selector, bool = true) {
    if (bool) {
        $(selector).addClass('loading')
    } else {
        setTimeout(() => $(selector).removeClass('loading'), 500)
    }
}

/**
 * Date string
 */
function dateStr(year, month, day) {
    return `${year}-${String(month+1).padStart(2, 0)}-${String(day).padStart(2, 0)}`
}
</script>